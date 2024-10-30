<?php
  if(get_option('concise_gm_api_key')){
$GoogleMKey = get_option( 'concise_gm_api_key' );
}else{
  $GoogleMKey = 'AIzaSyA7KTlygMtdR1Orz76as4gPQTKOifL1B00';
}
function cs_create_single_shipment_shortcode(){
?>
<div class="large-12 ship-up" >
    <div class="row" id="shipment">
        <div class="large-6">
            <div class="large-12">
                <h3><?php echo __('Shipment Details','concise-settings')?></h3><br/>

                <table class="table ship-table">
                    <tbody>
                        <tr>
                            <td class="ship-td" >
                                <div><?php echo __('Status','concise-settings')?></div>
                            </td>
                            <td class="ship-td" >
                                <span id="current_status"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Tracking Number','concise-settings')?></td>
                            <td><span id="shipment_number"></span></td>
                        </tr>
                        <tr ng-show="service">
                            <td><?php echo __('Service Type','concise-settings')?></td>
                            <td><span id="service"></span></td>
                        </tr>
                        <tr ng-show="driver">
                            <td><?php echo __('Driver','concise-settings')?></td>
                            <td><span id="driver"></span></td>
                        </tr>
                        <tr ng-show="route">
                            <td><?php echo __('Route','concise-settings')?></td>
                            <td><span id="route"></span></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Expected Delivery','concise-settings')?></td>
                            <td><span id="due_time"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br style="clear:both;">
            <br style="clear:both;">

            <div class="large-12">
                <h3><?php echo __('Shipment Progress','concise-settings')?></h3><br/>
                <table class="table ship-table" >
                    <tbody>
                        <tr>
                            <td class="ship-td"><?php echo __('Ship Date','concise-settings')?></td>
                            <td class="ship-td"><span id="ship_time"></span></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Picked Up','concise-settings')?></td>
                            <td><span id="pickup_time"></span></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Dispatched','concise-settings')?></td>
                            <td><span id="dispatch_time"></span></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Delivered','concise-settings')?></td>
                            <td><span id="deliver_time"></span></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <br style="clear:both;">
            <br style="clear:both;">

            <div class="large-12" id="pod_name_header">
                <h3><?php echo __('Delivery Details','concise-settings')?></h3><br/>

                <table class="table">
                    <tbody>
                        <tr>
                            <td class="ship-td"><?php echo __('Signed By','concise-settings')?></td>
                            <td class="ship-td"><span id="pod_name"></span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="large-6">
            <div class="large-12">
                <h3><?php echo __('Pickup Address','concise-settings')?></h3>
                <span id="sender_company"></span><br/>
                <span id="sender_address"></span><br/>
                <span id="sender_city"></span>, <span id="sender_state"></span> <span id="sender_zip"></span>

                <br><br>

                <h3><?php echo __('Recipient Information','concise-settings')?></h3>

                <span id="recipient_company"></span><br/>
                <span id="recipient_address"></span><br/>
                <span id="recipient_city"></span>, <span id="recipient_state"></span> <span id="recipient_zip"></span>

                <br><br>

                <h3 id="pod_proof_header"><?php echo __('Proof of Delivery','concise-settings')?></h3>
                <span id="pod_proof"></span>

                <h3 id="map_header"><?php echo __('Delivery Location','concise-settings')?></h3>
                <div id="map_canvas"></div>



            </div>

        </div>
    </div>
    <div class="bubblingG" style="display: none;">
      <span id="bubblingG_1">
      </span>
      <span id="bubblingG_2">
      </span>
      <span id="bubblingG_3">
      </span>
    </div>
</div>
<?php }
add_shortcode('single-shipment','cs_create_single_shipment_shortcode');
function cs_single_shipment_styles_scripts() {
  global $GoogleMKey;
    wp_enqueue_style( 'style-shipment', plugin_dir_url(__FILE__).'css/style-shipment.css' );
    wp_enqueue_script( 'googleM-script', 'https://maps.googleapis.com/maps/api/js?key='.$GoogleMKey.'', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery-min', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script-shipment', plugin_dir_url(__FILE__).'js/script-shipment.js', array(), '1.0.0', true );
    $phpInfo = array(
        'concise_company_slug' => get_option( 'concise_company_slug' )
    );
    wp_localize_script( 'script-shipment', 'phpInfo', $phpInfo );
}

add_action( 'wp_enqueue_scripts', 'cs_single_shipment_styles_scripts' );
 ?>