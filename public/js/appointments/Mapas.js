function iniciarMap(){
	var coord = {lat:-34.5956145, log:-58.4431949};
	var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 10,
		center: coord	
	});
	var marker = new google.maps.Marker({
		position: coord,
		map: map
	});
}

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRvfhIw8v2pzzfRU6ZLGM9j-kJdjAWVJw"></script>
    <script src="{{ asset('/js/appointments/Mapas.js')}}"></script>
@endsection-->