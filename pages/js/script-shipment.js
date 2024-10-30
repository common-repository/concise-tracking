    function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
$("#shipment").hide();
$(".bubblingG").show();
if(phpInfo.concise_company_slug!=''){
  var companySlug = phpInfo.concise_company_slug;
}else{
  var companySlug = 'goldrush';
}
$.get( "https://api.concise.io/public/"+companySlug+"/shipment/"+getUrlParameter('id'), function( data ) {
   shipment = data.data;

  if(shipment) {
    $(".bubblingG").hide();
    $("#shipment").show();
      $( "#current_status" ).html( shipment.current_status );
      $( "#shipment_number" ).html( shipment.shipment );
      $( "#service" ).html( shipment.service );
      $( "#driver" ).html( shipment.driver );
      $( "#route" ).html( shipment.route );
      $( "#due_time" ).html( shipment.dates.due_time ? new Date(shipment.dates.due_time*1000).toUTCString().split(' ').slice(1, 5).join(' ') : null );

      $( "#ship_time" ).html( shipment.dates.ship_time ? new Date(shipment.dates.ship_time*1000).toUTCString().split(' ').slice(1, 5).join(' ') : null );
      $( "#pickup_time" ).html( shipment.dates.pickup_time ? new Date(shipment.dates.pickup_time*1000).toUTCString().split(' ').slice(1, 5).join(' ') : null );
      $( "#dispatch_time" ).html( shipment.dates.dispatch_time ? new Date(shipment.dates.dispatch_time*1000).toUTCString().split(' ').slice(1, 5).join(' ') : null );
      $( "#deliver_time" ).html( shipment.dates.deliver_time ? new Date(shipment.dates.deliver_time*1000).toUTCString().split(' ').slice(1, 5).join(' ') : null );

      $( "#sender_company" ).html( shipment.sender.company );
      $( "#sender_address" ).html( shipment.sender.address );
      $( "#sender_city" ).html( shipment.sender.city );
      $( "#sender_state" ).html( shipment.sender.state );
      $( "#sender_zip" ).html( shipment.sender.zip );

      $( "#recipient_company" ).html( shipment.recipient.company );
      $( "#recipient_address" ).html( shipment.recipient.address );
      $( "#recipient_city" ).html( shipment.recipient.city );
      $( "#recipient_state" ).html( shipment.recipient.state );
      $( "#recipient_zip" ).html( shipment.recipient.zip );

      if (shipment.delivery.pod_proof.length > 0) {
        $( "#pod_proof" ).html( "<img src='https://s3-us-west-2.amazonaws.com/concise-pod/"+companySlug+"/" + shipment.delivery.pod_proof[0] + "'>"); 
      } else {
        $("#pod_proof_header").hide();
      }


      if (shipment.delivery.pod_name !== null) {
        $( "#pod_name" ).html( shipment.delivery.pod_name );
      } else {
        $("#pod_name_header").hide();
      }

      if (shipment.delivery.deliver_time !== null) {


      var geocoder;
      var map;

      if (!shipment.delivery.pod_gps.latitude && !shipment.delivery.pod_gps.latitude) {
        var address = shipment.recipient.address + ", " + shipment.recipient.city + ", " + shipment.recipient.state + " " + shipment.recipient.zip;
      } else {
        var address = shipment.delivery.pod_gps.latitude + " " + shipment.delivery.pod_gps.longitude
      }

      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(0,0);
      var myOptions = {
        zoom: 16,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      if (geocoder) {
        geocoder.geocode({
          'address': address
        }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
              map.setCenter(results[0].geometry.location);

              var infowindow = new google.maps.InfoWindow({
                content: '<b>' + address + '</b>',
                size: new google.maps.Size(150, 50)
              });

              var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title: address
              });
              google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
              });

            } else {
              alert("No results found");
            }
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }
      } else {
        $("#map_header").hide();
      }





  } else {
    $(".bubblingG").hide();
    $("#shipment").show();
  $( "#shipment" ).html( "<h3>Shipment not found</h3>" );

  }

});