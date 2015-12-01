@extends('layouts.master')

@section('title', 'Connexion')

@section('content')
    <div id="login">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                    <h1>Connexion Imagin'R</h1>
                    @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('alert') }}">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if($errors->has())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
               
                    <form method="POST" action="" accept-charset="UTF-8" id="register-form">
                        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ Input::old('email') }}">
                        </div>

                        <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="*********" name="password" value="" type="password">
                        </div>
                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Connexion">

                    </form>
                    <a href="register" class="forget">
                        Pas encore de compte? Inscrivez-vous!
                    </a>
                    <hr>
        	    </div>
    		</div>
    	</div>
    </div>
@endsection