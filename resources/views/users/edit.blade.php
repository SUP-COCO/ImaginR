@extends('layouts.client')

@section('title', 'Paramètre')

@section('content')
<div class="col-md-9">
	<div class="profile-content">
		@if(Session::has('message'))
			<div class="alert alert-{{ Session::get('alert') }}">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('message') }}
			</div>
		@endif

		<ul id="myTabs" class="nav nav-tabs">
			<li role="presentation" class="active">
				<a href="#avatar" id="avatar-tab" role="tab" data-toggle="tab" aria-controls="avatar" aria-expanded="true">Avatar</a>
			</li>
			<li role="presentation">
				<a href="#password" id="password-tab" role="tab" data-toggle="tab" aria-controls="password" aria-expanded="true">Mot de passe</a>
			</li>
		</ul>

		<div id="myTabContent" class="tab-content" style="margin-top:30px">
			<div role="tabpanel" class="tab-pane fade active in" id="avatar" aria-labelledby="avatar-tab">
				@if(Session::has('message_avatar'))
					<div class="alert alert-{{ Session::get('alert') }}">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{ Session::get('message_avatar') }}
					</div>
				@endif
				@if ($errors->has('avatarProfil'))
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ $errors->first('avatarProfil') }}
					</div>
				@endif
				<form method="POST" action="{{ route('post.edit') }}" enctype="multipart/form-data" accept-charset="UTF-8">
					<div class="form-group">
						<input class="form-control" name="first_name" value="{{ $user->first_name }}" type="text" disabled>
					</div>

					<div class="form-group">
						<input class="form-control" name="last_name" value="{{ $user->last_name }}" type="text" disabled>
					</div>

					<div class="form-group">
						<input class="form-control" name="email" type="text" value="{{ $user->email }}" disabled>
					</div>

					<div class="form-group">
						<label>Inscrit le :</label>
						<input class="form-control" name="email" type="text" value="{{ $user->created_at }}" disabled>
					</div>

					<div class="form-group">
						<div class="kv-avatar center-block" style="width:200px">
							<input id="avatar-icon" name="avatarProfil" type="file" class="file-loading">
						</div>
					</div>
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input name="_check" value="edit_avatar" type="hidden">
					<input type="submit" class="btn btn-primary" value="Mise à jour">
				</form>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="password" aria-labelledby="password-tab">
				@if(Session::has('message_password'))
					<div class="alert alert-{{ Session::get('alert') }}">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{ Session::get('message_password') }}
					</div>
				@endif
				@if ($errors->has('old_password') || $errors->has('password') || $errors->has('password_confirmation'))
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							@if ($errors->first('old_password'))
								{{ $errors->first('old_password') }}<br>
							@endif
							@if ($errors->first('password'))
								{{ $errors->first('password') }}<br>
							@endif
							@if ($errors->first('password_confirmation'))
								{{ $errors->first('password_confirmation') }}
							@endif
					</div>
				@endif
				<form method="POST" action="{{ route('post.edit') }}" enctype="multipart/form-data" accept-charset="UTF-8">
					<div class="form-group {{ ($errors->has('old_password')) ? 'has-error' : '' }}">
						<input class="form-control" name="old_password" placeholder="Mot de passe actuelle" type="password">
					</div>

					<div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
						<input class="form-control" name="password" placeholder="Nouveau mot de passe" type="password">
					</div>

					<div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
						<input class="form-control" name="password_confirmation" type="password" placeholder="Confirmation">
					</div>

					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input name="_check" value="edit_password" type="hidden">
					<input type="submit" class="btn btn-primary" value="Mise à jour">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $("#avatar-icon").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Supprimer la photo',
            elErrorContainer: '#kv-avatar-errors',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="./profilPictures/{{ $user->avatar }}" alt="Your Avatar" style="width:100%">',
            layoutTemplates: {main2: '{preview} '  + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

        var url = document.location.toString();
		if (url.match('#')) {
			$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show');
		}

        $('#myTabs a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});
    </script>
@endsection