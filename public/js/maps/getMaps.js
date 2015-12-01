// CONFIG GENERAL
var ParisPosition = {lat: 48.85661400000001, lng: 2.3522219000000177};

// AFFICHAGE DES GARE
var map = new google.maps.Map(document.getElementById('getMaps'), {
	center: ParisPosition,
	zoom: 11
});

var locations = [];

for (var i = 0; i < stations.length; i++) {
	var coordonnees = JSON.parse(stations[i].location);
	locations.push([stations[i].description, coordonnees.lat, coordonnees.lng, stations[i].name]);
};

var infowindow = new google.maps.InfoWindow();

var marker, i;

for (i = 0; i < locations.length; i++) {
	marker = new google.maps.Marker({
		position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		map: map,
		title: locations[i][3]
	});

	google.maps.event.addListener(marker, 'click', (function(marker, i) {
		return function() {
			infowindow.setContent(locations[i][0]);
			infowindow.open(map, marker);
		}
	})(marker, i));
}