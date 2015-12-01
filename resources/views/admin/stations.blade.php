@extends('layouts.admin')

@section('title', 'Gestion des Stations')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Gestion des Stations
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
              <h3 class="box-title">Visualisation des Stations</h3>

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
                      <h5 class="description-header">{{count($stations)}}</h5>
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
              <h3 class="box-title">Edition des Stations</h3>

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
						<th>Description</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th></th>
						<th></th>
					</tr>
					@foreach ($stations as $station)
							<tr>
								<form method="POST" action="{{URL::to('admin/stations/update')}}">
									<input type="hidden" value="{{ $station->id }}" name="update_id">
									<input name="_token" value="{{ csrf_token() }}" type="hidden">
									<td>{{ $station->id }}</td>
									<td><input type="text" class="form-control" value="{{ $station->name }}" name="update_name"</td>
									<td><input type="text" class="form-control" value="{{ $station->description }}" name="update_description"></td>
									<td><input type="text" class="form-control" value="{{ $station->LatLng->lat }}" name="update_latitude"></td>
									<td><input type="text" class="form-control" value="{{ $station->LatLng->lng }}" name="update_longitude"></td>
									<td><input type="submit" class="btn btn-primary" value="Modifier"></td>
								</form>
								<form method="POST" action="{{URL::to('admin/stations/delete')}}">
									<input type="hidden" value="{{ $station->id }}" name="update_id">
									<input name="_token" value="{{ csrf_token() }}" type="hidden">
									<!-- <td><span class="badge bg-red">coco@mysphr.com</span></td> -->
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
                  <h3 class="box-title">Création d'une Station</h3>
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
				@if ($errors->has('station_name') || $errors->has('description') || $errors->has('latitude') || $errors->has('longitude'))
					<div class="box-body">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								@if ($errors->first('station_name'))
									{{ $errors->first('station_name') }}<br>
								@endif
								@if ($errors->first('description'))
									{{ $errors->first('description') }}<br>
								@endif
								@if ($errors->first('latitude'))
									{{ $errors->first('latitude') }}<br>
								@endif
								@if ($errors->first('longitude'))
									{{ $errors->first('longitude') }}
								@endif
						</div>
					</div>
				@endif
                <form role="form" method="POST" action="{{URL::to('admin/stations/create')}}">
                  <div class="box-body">
                    <div class="form-group {{ ($errors->has('station_name')) ? 'has-error' : '' }}">
                      <label for="exampleInputEmail1">Nom de la Station</label>
                      <input type="text" name="station_name" class="form-control" id="exampleInputEmail1" placeholder="Nom de la Station">
                    </div>

                    <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" name="description" class="form-control" placeholder="Description">
                    </div>

                    <div class="form-group {{ ($errors->has('latitude')) ? 'has-error' : '' }}">
		                <div class="col-xs-6" style="padding-left:0;">
		                  <input type="text" class="form-control" name="latitude" id="lat" placeholder="Latitude">
		                </div> 
		                <div class="col-xs-6 {{ ($errors->has('longitude')) ? 'has-error' : '' }}" style="padding-left:0;padding-right:0">
		                  <input type="text" class="form-control" name="longitude" id="lng" placeholder="Longitude">
		                </div> 
                	</div>
                	<br><br>
                	<hr>
                	<div class="form-group">
                    	<input type="text" class="form-control" id="searchBox">
                    </div>

                    <div class="form-group">
                    	<div id="new-map" style="width:100%;height:250px"></div>
                    </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <button type="submit" class="btn btn-primary">Créer cette Station</button>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>
          </div>
	</section>
</div>
@endsection
@section('script')
	<script type="text/javascript">
		// CONFIG GENERAL
		var ParisPosition = {lat: 48.85661400000001, lng: 2.3522219000000177};

		// AFFICHAGE DES GARE
		var map = new google.maps.Map(document.getElementById('world-map-markers'), {
			center: ParisPosition,
			zoom: 11
		});

		var stations = <?php echo json_encode($stations); ?>;
		var locations = [];

		for (var i = 0; i < stations.length; i++) {
			var coordonnees = JSON.parse(stations[i].location);
			locations.push([stations[i].description, coordonnees.lat, coordonnees.lng, stations[i].name]);
		};

		var infowindow = new google.maps.InfoWindow();

		var marker, i;

		for (i = 0; i < locations.length; i++) {
			marker3 = new google.maps.Marker({
				position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				map: map,
				title: locations[i][3]
			});

			google.maps.event.addListener(marker3, 'click', (function(marker3, i) {
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker3);
				}
			})(marker3, i));
		}

		// var contentString = '<div id="content">'+
		// 	'<div id="siteNotice">'+
		// 	'</div>'+
		// 	'<h1 id="firstHeading" class="firstHeading"><i class="fa fa-train"></i> <b> St. Lazare</b></h1>'+
		// 	'<div id="bodyContent">'+
		// 	'<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
		// 	'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
		// 	'(last visited June 22, 2009).</p>'+
		// 	'</div>'+
		// 	'</div>';

		// var infowindow = new google.maps.InfoWindow({
		// 	content: contentString
		// });

		// var marker2 = new google.maps.Marker({
		// 	position: myLatLng,
		// 	map: map,
		// 	title: 'Uluru (Ayers Rock)',
		// 	draggable: true
		// });

		// marker2.addListener('click', function() {
		// 	infowindow.open(map, marker2);
		// });

		// CREATION D'UNE GARE
		

		var map2 = new google.maps.Map(document.getElementById('new-map'), {
			center: ParisPosition,
			zoom: 11
		});

		var marker = new google.maps.Marker({
			position: ParisPosition,
			map: map2,
			title: 'Uluru (Ayers Rock)',
			draggable: true
		});

		var searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));

		google.maps.event.addListener(searchBox, 'places_changed', function(){
			var places = searchBox.getPlaces();
			var bounds = new google.maps.LatLngBounds();
			var i, place;

			for (i = 0; place= places[i]; i++) {
				bounds.extend(place.geometry.location);
				marker.setPosition(place.geometry.location);
			};

			map2.fitBounds(bounds);
			map2.setZoom(15);
		});

		google.maps.event.addListener(marker, 'position_changed', function(){
			var lat = marker.getPosition().lat();
			var lng = marker.getPosition().lng();

			$('#lat').val(lat);
			$('#lng').val(lng);
		});
	</script>
@endsection