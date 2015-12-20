@extends('layouts.client')

@section('title', 'Profil')

@section('content')
<style type="text/css">
table, th, td {
		    border: 3px solid;
		    border-collapse: collapse;
		}
		table{
			border:3px solid;
			width:40%;
			margin:auto;
			font-size:1.5em;
			border-radius: 10px;
			overflow:hidden;
			margin-top:50px;
			margin-bottom:50px;
		}
		th, td {
		    padding: 5px;
		}
</style>
	<div class="col-md-9">
		<div class="profile-content">
			@if(Session::has('message'))
				<div class="alert alert-{{ Session::get('alert') }}">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('message') }}
				</div>
			@endif
			@if ($card) 
				@if ($user['checkCard']) 
					Votre abonnement commence le : {{$card->date_start}} et fini le : {{$card->date_end}}

					<a href="mdr.com" class="btn btn-primary">Renouvelez mon adonnement.</a>
				@endif
			@else
				Vous n'avez pas encore soucrit d'abonnements
			@endif
			<table>
	            	<tr>
						<th style="width: 50%;"><i class="fa fa-credit-card"></i></th>
						<th style="width: 50%;"><i class="fa fa-hourglass-o"></i></th>
						<th style="width: 50%;"><i class="fa fa-hourglass-o"></i></th>		
					</tr>
			@foreach ($offres as $offre)
					<form action="" method="POST">
						<input type="hidden" name="id_offre" value="{{$offre->id}}">
						<input name="_token" value="{{ csrf_token() }}" type="hidden">
						<tr>
							<td>{{$offre->price}}€</td>
							<td>{{$offre->nb_days}} Jours</td>
							<td><input type="submit" class="btn btn-primary" value="Souscrire"></td>
						</tr>
					</form>
	        @endforeach
	        </table>
		</div>
	</div>
@endsection