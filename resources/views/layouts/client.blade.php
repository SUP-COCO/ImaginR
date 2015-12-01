<html>
    <head>
        <title>Imagin'R - @yield('title')</title>
        @section('style-script')
        	<link rel="stylesheet" type="text/css" href="../vendor/bower_dl/bootstrap/dist/css/bootstrap.css">
        	<link rel="stylesheet" type="text/css" href="{{ asset('css/profil.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="../vendor/bower_dl/jquery/dist/jquery.js"></script>
			<script type="text/javascript" src="../vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js"></script>
            <link rel="stylesheet" type="text/css" href="../vendor/bower_dl/bootstrap-fileinput/css/fileinput.min.css">
            <script type="text/javascript" src="../vendor/bower_dl/bootstrap-fileinput/js/fileinput.min.js"></script>
        @show
    </head>
    <body>
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            @if ($user->avatar == '')
                                <img src="{{ asset('profilPictures/default_avatar_male.jpg') }}" class="img-responsive" alt="Avatar Profil">
                            @else
                                @if(file_exists('profilPictures/'.$user->avatar)) 
                                  <img src="{{ asset('profilPictures/'.$user->avatar) }}" class="img-responsive" alt="Avatar Profil">
                                @else
                                  <img src="{{ asset('profilPictures/default_avatar_male.jpg') }}" class="img-responsive" alt="Avatar Profil">
                                @endif
                            @endif
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </div>
                            <!-- <div class="profile-usertitle-job">
                                Developer
                            </div> -->
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <!-- <div class="profile-userbuttons">
                            <button type="button" class="btn btn-success btn-sm">Follow</button>
                            <button type="button" class="btn btn-danger btn-sm">Message</button>
                        </div> -->
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="{{ Request::is('profil') ? 'active' : '' }}">
                                    <a href="{{ URL::to('') }}">
                                        <i class="glyphicon glyphicon-home"></i>
                                        Accueil
                                    </a>
                                </li>
                                <li class="{{ Request::is('editProfil') ? 'active' : '' }}">
                                    <a href="{{ URL::to('editProfil') }}">
                                        <i class="glyphicon glyphicon-user"></i>
                                        Mon compte
                                    </a>
                                </li>
                                <li class="{{ Request::is('abonnement') ? 'active' : '' }}">
                                    <a href="{{ URL::to('abonnement') }}">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                        Mon abonnement
                                    </a>
                                </li>
                                <li class="{{ Request::is('transactions') ? 'active' : '' }}">
                                    <a href="{{ URL::to('transactions') }}">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                        Mes Transactions
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="#" target="_blank">
                                        <i class="glyphicon glyphicon-ok"></i>
                                        Tasks
                                    </a>
                                </li> -->
                                @if (Sentinel::inRole('admin'))
                                <li>
                                    <a href="{{ URL::to('admin') }}">
                                        <i class="glyphicon glyphicon-flag"></i>
                                        Administration
                                    </a>
                                </li>
                                @endif
                                <li class="{{ Request::is('logout') ? 'active' : '' }}">
                                    <a href="{{ URL::to('logout') }}">
                                        <i class="glyphicon glyphicon-off"></i>
                                        Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
        @yield('script')
    </body>
</html>