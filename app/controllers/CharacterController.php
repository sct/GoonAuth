<?php

class CharacterController extends BaseController
{
	public function showCharacters()
	{
		$auth = Session::get('auth');

		$include = array('auth' => $auth);

		return View::make('character.list', $include);
	}

	public function showAddForm()
	{
		$auth = Session::get('auth');

		$include = array('auth' => $auth);

		return View::make('character.add', $include);
	}

	public function doAddCharacter()
	{
		$auth = Session::get('auth');

		if ((!empty($auth->sa_username) && $auth->characters->count() >= Config::get('goonauth.characters')) ||
			($auth->is_sponsored && $auth->characters->count() >= Config::get('goonauth.sponsored'))) {
			Session::flash('error', 'You have exceeded your character limit.');
			return Redirect::back();
		}

		$character = new Character();
		$character->auth_id = $auth->id;
		$character->name = Input::get('name');

		if ($auth->characters->count() == 0) {
			$character->is_main = true;
		}
		$character->save();

		return Redirect::to('characters');
	}

	public function doSetMain(Character $character)
	{
		$auth = Session::get('auth');

		if ($auth->id != $character->auth_id) {
			App::abort(500, "Error processing request!");
		}

		$current = Character::where('auth_id', $auth->id)->where('is_main', true)->first();
		$current->is_main = false;
		$current->save();

		$character->is_main = true;
		$character->save();

		return Redirect::back();
	}

	public function doDelete(Character $character)
	{
		$auth = Session::get('auth');

		if ($auth->id != $character->auth_id) {
			App::abort(500, "Error processing request!");
		}

		$character->delete();

		return Redirect::back();
	}
}