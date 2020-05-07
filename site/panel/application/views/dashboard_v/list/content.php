<?php $user = get_active_user();?>
<?php $settings = get_settings();?>
<div class="row">

    <div class="alert alert-info alert-custom alert-dismissible col-md-12">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <p>
            <?php echo $user->full_name?> sol taraftaki paneli kullanarak siteyi yönetebilirsin.</p>
    </div>
    <div class="col-md-12">
        <div class="widget p-md clearfix">
            <div class="pull-left">
                <h3 class="widget-title"><?php echo "Hoşgeldin ".$user->full_name?></h3>
            </div>
        </div><!-- .widget -->
    </div>

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Haritalarda Gezinin</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div id="google-streetview" style="width: 100%;height: 400px;"></div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->


</div>


<script>
    // Google maps
    var panorama;
    function initMap() {
        // street view panorama
        panorama = new google.maps.StreetViewPanorama(document.getElementById('google-streetview'), {
            position: { lat: <?php echo $settings->mapLat;?>, lng: <?php echo $settings->mapLong;?> },
            pov: { heading: 320, pitch: 0 },
            addressControlOptions: {
                position: google.maps.ControlPosition.TOP_LEFT
            },
            linksControl: true,
            panControl: true,
            enableCloseButton: true
        });

    }; // End initMap()
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $settings->googleMapsApi;?>&callback=initMap">
</script>