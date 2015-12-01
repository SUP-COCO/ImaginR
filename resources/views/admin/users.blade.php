@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Blank page
			<small>it all starts here</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">Blank page</li>
		</ol>
	</section>

	<section class="content">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Striped Full Width Table</h3>
			</div><!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table table-striped">
					<tr>
						<th style="width: 10px">#</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Carte</th>
					</tr>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->last_name }}</td>
							<td>{{ $user->first_name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								@if (isset($user->card))
									<span class="badge bg-green">OUI</span>
								@else
									<span class="badge bg-red">NON</span>
								@endif
							</td>
							<!-- <td><span class="badge bg-red">coco@mysphr.com</span></td> -->
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</section>
</div>
@endsection