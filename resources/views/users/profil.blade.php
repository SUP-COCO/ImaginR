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

			<div class="alert alert-success" id="success_div">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span id="success_msg"></span>
			</div>

			<div class="alert alert-danger" id="error_div">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span id="error_msg"></span>
			</div>

			<h2>Voici la liste des Gare </h2>
			<div id="getMaps" style="width:100%;height:300px"></div>
			<br>
			<div class="container" style="padding-left:0">
			<form method="POST" action="{{URL::to('api/validCard')}}">
				<div class="col-xs-6" style="padding-left:0">
					<label>Choisissez votre Gare :</label>
					<div class="form-group">
					<select class="form-control" id="station_key" name="station_key">
						@foreach ($stations as $station)
							<option value="{{$station->key}}">{{$station->name}}</option>
						@endforeach
					</select>
					</div>
					<div class="form-group" class="col-xs-6">
						<input name="user_id" id="user_id" value="{{ $user->id }}" type="hidden">
						<input name="_token" value="{{ csrf_token() }}" type="hidden">
						<input type="submit" id="ValidCard" value="Validez ma carte" class="btn btn-primary">
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4fNHvth9UcU0R2QTgqgNEQBhp-__R_As&libraries=places"></script>
	<script type="text/javascript">
		var stations = <?php echo json_encode($stations); ?>;
	</script>
	<script type="text/javascript">
		$('#success_div').hide();
		$('#error_div').hide();

		$("#ValidCard").click(function(e){
			e.preventDefault();
			var user_id = $('#user_id').val();
			var station_key = $('#station_key').val();

			$.ajax({
				url: "{{URL::to('api/validCard')}}",
				type : 'POST',
				data: {user_id: user_id, api_key: station_key},
				success: function(result){
					if (result['error']) {
						$('#error_msg').html(result['error']);
						$('#success_div').hide();
						$('#error_div').show();
					} else if (result['success']) {
						$('#success_msg').html(result['success']);
						$('#error_div').hide();
						$('#success_div').show();
					} else {
						$('#error_msg').html('Une erreur est survenue lors de la validation.');
					}
				},
				error: function(xhr, ajaxOptions, thrownError){
					console.log(xhr.status);
					console.log(thrownError);
					console.log(ajaxOptions);
				}
			});
		});
	</script>
	<script type="text/javascript" src="{{URL::asset('js/maps/getMaps.js')}}"></script>
@endsection