@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Gestion des Utilisateurs
			<!-- <small>it all starts here</small> -->
		</h1>
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">Blank page</li>
		</ol> -->
	</section>

	<section class="content">
		<div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Visualisation des Utilisateurs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-9 col-sm-8">
                  <div class="pad">
                    <!-- Map will be created here -->
                    <div id="world-map-markers" style="height: 325px;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-4">
                  <div class="pad box-pane-right bg-green" style="min-height: 280px">
                    <div class="description-block margin-bottom">
                      <!-- <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div> -->
                      <h5 class="description-header">{{count($users)}}</h5>
                      <span class="description-text">Stations</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block margin-bottom">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">30%</h5>
                      <span class="description-text">Referrals</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">70%</h5>
                      <span class="description-text">Organic</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Edition des Utilisateurs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				@if(Session::has('message_update') || Session::has('message_delete'))
					<div class="box-body">
						<div class="alert alert-{{ Session::get('alert') }}">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							@if (Session::has('message_update'))
								{{ Session::get('message_update') }}
							@endif
							@if (Session::has('message_delete'))
								{{ Session::get('message_delete') }}
							@endif
						</div>
					</div>
				@endif
				@if ($errors->has('update_name') || $errors->has('update_description') || $errors->has('update_latitude') || $errors->has('update_longitude'))
					<div class="box-body">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								@if ($errors->first('update_name'))
									{{ $errors->first('update_name') }}<br>
								@endif
								@if ($errors->first('update_description'))
									{{ $errors->first('update_description') }}<br>
								@endif
								@if ($errors->first('update_latitude'))
									{{ $errors->first('update_latitude') }}<br>
								@endif
								@if ($errors->first('update_longitude'))
									{{ $errors->first('update_longitude') }}
								@endif
						</div>
					</div>
				@endif
				<table class="table table-striped">
					<tr>
						<th style="width: 10px">#</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Carte</th>
						<th>Valide</th>
						<th></th>
						<th></th>
					</tr>
					@foreach ($users as $user)
							<tr>
								<form method="POST" action="{{URL::to('admin/users/update')}}">
									<input type="hidden" value="{{ $user->id }}" name="update_id">
									<input name="_token" value="{{ csrf_token() }}" type="hidden">
									<td>{{ $user->id }}</td>
									<td><input type="text" class="form-control" value="{{ $user->last_name }}" name="update_name"</td>
									<td><input type="text" class="form-control" value="{{ $user->first_name }}" name="update_description"></td>
									<td><input type="text" class="form-control" value="{{ $user->email }}" name="update_description"></td>
									@if ($user['card'])
										<td><span class="badge bg-green">OUI</span></td>
									@else
										<td><span class="badge bg-red">NON</span></td>
									@endif

									@if ($user['checkCard'])
										<td><span class="badge bg-green">OUI</span></td>
									@else
										<td><span class="badge bg-red">NON</span></td>
									@endif
									<td><input type="submit" class="btn btn-primary" value="Modifier"></td>
								</form>
								<form method="POST" action="{{URL::to('admin/users/delete')}}">
									<input type="hidden" value="{{ $user->id }}" name="update_id">
									<input name="_token" value="{{ csrf_token() }}" type="hidden">
									<td><input type="submit" class="btn btn-danger" value="X"></td>
								</form>
							</tr>
					@endforeach
				</table>
			</div>
            <!-- /.box-body -->
          </div>
          </div>

          <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Création d'un Utilisateur</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @if(Session::has('message_create'))
					<div class="box-body">
						<div class="alert alert-{{ Session::get('alert') }}">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('message_create') }}
						</div>
					</div>
				@endif
				@if ($errors->has('first_name') || $errors->has('last_name') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
					<div class="box-body">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								@if ($errors->first('first_name'))
									{{ $errors->first('first_name') }}<br>
								@endif
								@if ($errors->first('last_name'))
									{{ $errors->first('last_name') }}<br>
								@endif
								@if ($errors->first('email'))
									{{ $errors->first('email') }}<br>
								@endif
								@if ($errors->first('password'))
									{{ $errors->first('password') }}<br>
								@endif
								@if ($errors->first('password_confirmation'))
									{{ $errors->first('password_confirmation') }}
								@endif
						</div>
					</div>
				@endif
                <form role="form" method="POST" action="{{URL::to('admin/users/create')}}">
                  <div class="box-body">
                    <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                      <input type="text" name="first_name" class="form-control" placeholder="Nom">
                    </div>

                    <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                      <input type="text" name="last_name" class="form-control" placeholder="Prénom">
                    </div>

                    <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                      <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
		                <div class="col-xs-6" style="padding-left:0;">
		                  <input type="password" class="form-control" name="password" placeholder="Mot de passe">
		                </div> 
		                <div class="col-xs-6 {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}" style="padding-left:0;padding-right:0">
		                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation">
		                </div> 
                	</div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <button type="submit" class="btn btn-primary">Créer</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>
          </div>
	</section>
</div>
@endsection
@section('script')
@endsection