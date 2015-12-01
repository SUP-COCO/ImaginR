@extends('layouts.master')

@section('title', 'Inscription')

@section('content')
    <div id="login">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                <h1>Inscription Imagin'R</h1>
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

                    <form method="POST" action="{{ route('sentinel.register.user') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="register-form">

                        <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Luke" name="first_name" value="{{ Input::old('first_name') }}" type="text">
                        </div>

                        <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Skywalker" name="last_name" value="{{ Input::old('last_name') }}" type="text">
                        </div>

                        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ Input::old('email') }}">
                        </div>

                        <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="********" name="password" type="password">
                        </div>

                        <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Confirmation" name="password_confirmation" type="password">
                        </div>

                        <div class="form-group {{ ($errors->has('avatarProfil')) ? 'has-error' : '' }}">
                            <div class="kv-avatar center-block" style="width:200px">
                                <input id="avatar" name="avatarProfil" type="file" class="file-loading">
                            </div>
                        </div>

                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Inscription">

                    </form>
                    <a href="login" class="forget">Déjà inscrit? Connectez-vous!</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#avatar").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Supprimez la photo',
            elErrorContainer: '#kv-avatar-errors',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="./profilPictures/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
            layoutTemplates: {main2: '{preview} '  + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
    </script>
@endsection