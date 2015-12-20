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

			<h2>Voici la liste de tes validation(s) </h2>
			<div class="content" style="padding-left:0">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Station</th>
							<th>Heure</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($validations as $num_row => $validation)
						<tr>
							<th scope="row">{{$num_row+1}}</th>
							<td>{{$validation->station->name}}</td>
							<td>{{ date('D M Y H:i', strtotime($validation->date)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection