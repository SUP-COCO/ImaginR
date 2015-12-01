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
			<div id="getMaps" style="width:100%;height:300px"></div>
		</div>
	</div>
@endsection
@section('script')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4fNHvth9UcU0R2QTgqgNEQBhp-__R_As&libraries=places"></script>
	<script type="text/javascript">
		var stations = <?php echo json_encode($stations); ?>;
	</script>
	<script type="text/javascript" src="{{URL::asset('js/maps/getMaps.js')}}"></script>
@endsection