
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ Config::get('goonauth.title') }}</title>
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/auth.css') }}
    {{ HTML::script('assets/js/jquery-1.9.0.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}">{{ Config::get('goonauth.title') }} Auth</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            @if (Session::has('authenticated'))
              <li{{ Request::is('/') || Request::is('link') ? ' class="active"' : '' }}><a href="{{ URL::to('/') }}">Link Account</a></li>
              <li{{ Request::is('characters') || Request::is('character/*') ? ' class="active"' : '' }}><a href="{{ URL::to('characters') }}">Add Characters</a></li>
              @if (!Session::get('auth')->is_sponsored)
                <li{{ Request::is('sponsors') || Request::is('sponsor/*') ? ' class="active"' : '' }}><a href="{{ URL::to('sponsors') }}">Sponsors</a></li>
              @endif
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Session::has('authenticated'))
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Session::get('displayUsername') }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  @if (Session::get('auth')->is_admin)
                  <li><a href="{{ URL::to('admin') }}">Admin</a></li>
                  @endif
                  <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                </ul>
              </li>
              <li><a href="{{ Config::get('goonauth.forumUrl') }}">{{ Config::get('goonauth.title') }}</a></li>
            @else
              <li><a href="{{ URL::to('login') }}">Login</a></li>
              <li><a href="{{ Config::get('goonauth.forumUrl') }}">{{ Config::get('goonauth.title') }}</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


    <div class="container">
      @yield('content')

    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12 footer">
        GoonAuth v{{ AUTH_VERSION }} - Created by {{ HTML::link('https://github.com/sct', 'sct', array('target' => '_blank')) }} - {{ HTML::link('https://github.com/sct/GoonAuth', 'GitHub', array('target' => '_blank')) }}
        </div>
      </div>
    </div>

  </body>
</html>
