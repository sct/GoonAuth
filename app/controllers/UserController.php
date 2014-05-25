<?php

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
use Guzzle\Plugin\Cookie\Cookie;
use Guzzle\Plugin\Cookie\CookiePlugin;

class UserController extends BaseController
{

	public function showHome()
	{
		$auth = Session::get('auth');
		if (empty($auth->sa_username) && empty($auth->is_sponsored)) {
			return View::make('user.unlinked');
		}

		$include = array('auth' => $auth);

		return View::make('user.linked', $include);

	}

	public function showLink()
	{
		$auth = Session::get('auth');
		if (isset($auth) && !empty($auth->sa_username)) {
			return Redirect::to('/');
		}

		$token = AuthToken::where('xf_id', $auth->xf_id)->first();

		if (empty($token)) {
			$token = new AuthToken();
			$token->xf_id = $auth->xf_id;
			$token->token = uniqid(Config::get('goonauth.codePrefix').":");
			$token->save();
		}

		$include = array("token" => $token->token);

		return View::make('user.link', $include);
	}

	public function doLink()
	{
		$auth = Session::get('auth');
		if (isset($auth) && !empty($auth->sa_username)) {
			return Redirect::to('/');
		}

		$token = AuthToken::where('xf_id', $auth->xf_id)->first();

		if (empty($token)) {
			return Redirect::back();
		}

		$cookieJar = new ArrayCookieJar();

	    $bbpCookie = new Cookie();
	    $bbpCookie->setName('bbpassword');
	    $bbpCookie->setDomain('.forums.somethingawful.com');
	    $bbpCookie->setValue(Config::get('goonauth.bbpassword'));

	    $bbidCookie = new Cookie();
	    $bbidCookie->setName('bbuserid');
	    $bbidCookie->setDomain('.forums.somethingawful.com');
	    $bbidCookie->setValue(Config::get('goonauth.bbuserid'));

	    $cookieJar->add($bbpCookie);
	    $cookieJar->add($bbidCookie);

	    $cookiePlugin = new CookiePlugin($cookieJar);

	    $client = new Client('http://forums.somethingawful.com/member.php', array(
	        'request.options' => array(
	            'query' => array(
	                'action' => 'getinfo',
	                'username' => Input::get('sa_username'),
	            ),
	        ),
	    ));
	    $client->addSubscriber($cookiePlugin);
	    $request = $client->get(null, array(), array('allow_redirects' => false));



	    try {
	        $response = $request->send();
	        $body = $response->getBody(true);

	        preg_match("/<dt>Member Since<\/dt>([\s]+)?<dd>([A-Za-z,0-9\s]+)<\/dd>/i", $body, $matches);

	        $memberTime = strtotime($matches[2]);

	        $subTime = time() - (60 * 60 * 24 * 90);

	        if (stristr($body, $token->token) !== false && $memberTime < $subTime) {
	            $client = new Client(Config::get('goonauth.apiUrl'), array(
	                'request.options' => array(
	                    'query' => array(
	                        'action' => 'editUser',
	                        'hash' => Config::get('goonauth.apiKey'),
	                        'group' => Config::get('goonauth.authId'),
	                        'user' => Session::get('displayUsername'),
	                    ),
	                ),
	            ));

	            $request = $client->get();
	            $auth->sa_username = Input::get('sa_username');
	            $auth->linked_at = Carbon::now();

	            try {
	                $response = $request->send();

	                $auth->save();
	            } catch (ClientErrorResponseException $ex) {
	                $json = $ex->getResponse()->json();

	                // ignore
	                if ($json['error'] === 7) {
	                	$auth->save();

	                    return Redirect::to('/');
	                }

	                Session::flash('error', 'Unknown error occured. Please try again.');

	                return Redirect::back();
	            }

	            return Redirect::to('/');
	        } else {
	            Session::flash('error', 'Could not find token in profile or you have not been a member for at least 90 days.');

	            return Redirect::back();
	        }
	    } catch (ClientErrorResponseException $ex) {
	        Session::flash('error', 'Unknown error occured. Please try again.');

	        return Redirect::back();
	    }
	}

	public function doLogin()
	{
		$client = new Client(Config::get('goonauth.apiUrl'), array(
	        'request.options' => array(
	            'query' => array(
	                'action' => 'authenticate',
	                'username' => Input::get('username'),
	                'password' => Input::get('password'),
	            ),
	        ),
	    ));
	    $request = $client->get();

	    try {
	        $response = $request->send();
	        $json = $response->json();

	        Session::put('authUsername', Input::get('username'));
	        Session::put('authHash', $json['hash']);
	    } catch (ClientErrorResponseException $ex) {
	        $json = $ex->getResponse()->json();

	        if ($json['error'] === 4) {
	            Session::flash('error', 'Invalid username. Did you register on aagoons.com first?');
	        } else if ($json['error'] === 5) {
	            Session::flash('error', 'Invalid Username / Password. Please try again.');
	        } else {
	            Session::flash('error', 'Unknown error occurred. Please try again.');
	        }

	        return Redirect::back();
	    }

	    $client = new Client(Config::get('goonauth.apiUrl'), array(
	        'request.options' => array(
	            'query' => array(
	                'action' => 'getUser',
	                'hash' => Config::get('goonauth.apiKey'),
	                'value' => Input::get('username'),
	            ),
	        ),
	    ));

	    $request = $client->get();

	    try {
	        $response = $request->send();
	        $json = $response->json();

	        if (!isset($json['user_state']) || $json['user_state'] !== 'valid') {
	            Session::flash('error', 'You must verify your email address before you sign in.');

	            return Redirect::back();
	        }

	        Session::put('authenticated', true);
	        Session::put('xenforoId', $json['user_id']);
	        Session::put('displayUsername', $json['username']);
	    } catch (ClientErrorResponseException $ex) {
	        Session::flash('error', 'Unknown error occurred. Please try again.');

	        return Redirect::back();
	    }

	    $auth = User::where('xf_id', $json['user_id'])->first();

	    if (empty($auth) || !$auth->xf_username) {
	    	if (empty($auth)) {
	    		$auth = new User();
	    	}
	    	$auth->xf_id = $json['user_id'];
	    	$auth->xf_username = $json['username'];
	    	$auth->save();
	    }

	    return Redirect::to('/');
	}
}