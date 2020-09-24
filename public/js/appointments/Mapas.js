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
            document.getElementById("latitud").value = results[0].geometry.location.lat();
            document.getElementById("longitud").value = results[0].geometry.location.lng();
            // mio
            map = document.getElementById('map-canvas');
            lat = results[0].geometry.location.lat();
            lng = results[0].geometry.location.lng();

            var myLatlng = new google.maps.LatLng(lat, lng);
                var mapOptions = {
                    zoom: 16,
                    scrollwheel: true,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
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