<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-6">
				<h1 class="page-header">Current Outlets</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Outlet</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" method="post" action="<?php echo base_url() ?>home/update">
							<input type="hidden" name="id" value="<?php echo $query->id?>">
								<div class="form-group">
									<label>Outlet Name</label>
									<input class="form-control" id="name" name="name" value="<?php echo $query->name?>" required>
								</div>
								<div class="form-group">
									<label>Manager Name</label>
									<input class="form-control" name="mgr_name" value="<?php echo $query->mgr_name?>" required >
								</div>
								<div class="form-group">
									<label>Manager phone</label>
									<input class="form-control" name="mgr_phno" value="<?php echo $query->mgr_phno?>" required pattern=".{10,10}">
								</div>
								<div class="form-group">
									<label>Latitude</label>
									<input class="form-control" name="lat" id="lat" value="<?php echo $query->lat?>" onchange="onchangevalue()" required min="-90" max="90">
								</div>
								<div class="form-group">
									<label>Longitude</label>
									<input class="form-control" id = "lon" name="lon" value="<?php echo $query->lon?>" onchange="onchangevalue()" required min="-180" max="180">
								</div>
								<div class="form-group">
									<label>Area Covered</label>
									<input class="form-control" name="area_covered" value="<?php echo $query->area_covered?>" id="rad" onchange="onchangevalue()" required min="1">
								</div>
								<div class="form-group">
								<button type="submit" class="btn btn-primary">Submit Button</button>
								</div>
							</form>
						</div>
						<div class="col-md-6">
								<div id="map-canvas">
								</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			
		</div>

 <script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script>
var markers= [];
var map;
var circle;
var marker;
      function initialize()
    {
	var lati=document.getElementById("lat").value;
	var long=document.getElementById("lon").value;
	var radius=document.getElementById("rad").value*1000;
        var mapOptions = {
            center: new google.maps.LatLng(lati,long),
            zoom: 11,
            mapTypeControlOptions: {
                position: google.maps.ControlPosition.TOP_LEFT
            }
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	var nelocation = new google.maps.LatLng(lati,long);
	addMarker(nelocation);
	circlecreate(radius);	
   }

	function circlecreate(rad)
	{
		circle = new google.maps.Circle({
  		map: map,
  		radius: rad,
  		fillColor: '#30A5FF'
		});
		circle.bindTo('center',marker, 'position');
	}


function addMarker(location) {

        marker = new google.maps.Marker({
	  draggable: true,
          position: location,
          map: map,
	  title: "<?php echo $query->name ?>"
        });

        markers.push(marker);

	google.maps.event.addListener(marker, 'click', function (event) {
    		document.getElementById("lat").value = this.getPosition().lat();
   		document.getElementById("lon").value = this.getPosition().lng();
		circle.bindTo('center',marker, 'position');
	});
	google.maps.event.addListener(marker, 'dragend', function (event) {
    		document.getElementById("lat").value = this.getPosition().lat();
    		document.getElementById("lon").value = this.getPosition().lng();
		circle.bindTo('center',marker, 'position');
	});

}

function onchangevalue()
{
	initialize();
}
	//google.maps.event.addDomListener(window, 'load', initialize);
    window.onload = function () { initialize(); }
 </script>
