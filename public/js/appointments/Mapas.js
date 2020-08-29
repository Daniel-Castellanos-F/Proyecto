function iniciarMap(){
	var coord = {lat:-34.5956145, log:-58.4431949};
	var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 10,
		center: coord
		
	});
}