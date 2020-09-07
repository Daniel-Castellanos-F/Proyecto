function getCoords(){

var geocoder = new google.maps.Geocoder();

address = document.getElementById('search').value;

if(address!='')
  {
    // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
    geocoder.geocode({ 'address': address}, function(results, status)
      {
        if (status == 'OK')
          {
            // Mostramos las coordenadas obtenidas en el p con id coordenadas
            document.getElementById("latitud").innerHTML='Latitud:   '+results[0].geometry.location.lat();
            document.getElementById("longitud").innerHTML='Longitud: '+results[0].geometry.location.lng();
            // mio
            map = document.getElementById('map-canvas');
            lat = results[0].geometry.location.lat();
            lng = results[0].geometry.location.lng();

            var myLatlng = new google.maps.LatLng(lat, lng);
                var mapOptions = {
                    zoom: 16,
                    scrollwheel: true,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":color},{"visibility":"on"}]}]
                }

                map = new google.maps.Map(map, mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: 'Escenario deportivo'
                });

            //Mio
          }
      });
  }    
}