@extends('layouts.client')

@section('title', 'Profil')

@section('content')
	<div class="col-md-9">
		<div class="profile-content">
			@if(Session::has('message'))
				<div class="alert alert-{{ Session::get('alert') }}">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('message') }}
				</div>
			@endif
			Some user ...
		</div>
	</div>
@endsection