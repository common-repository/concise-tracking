<?php
if(get_option('concise_jquery_theme')){
    $jqueryTheme = get_option('concise_jquery_theme');
}else{
    $jqueryTheme = 'flick';
}
function cs_create_shipment_grid_shortcode(){
?>
<div class="grid-upper" >

    <div class="large-3 columns " ><span class="count-det" id="countTotal"><?php echo __('0','concise-settings')?></span><br/><?php echo __('Orders','concise-settings')?>
    </div>
    <div class="large-3 columns" ><span class="count-det" id="countDelivered"><?php echo __('0','concise-settings')?></span><br/><?php echo __('Delivered','concise-settings')?>
    </div>
    <div class="large-3 columns" ><span class="count-det" id="countUndelivered"><?php echo __('0','concise-settings')?></span><br/><?php echo __('Undelivered','concise-settings')?>
    </div>
    <div class="large-3 columns" ><span class="count-det" id="onTimePercent"><?php echo __('?','concise-settings')?></span><br/><?php echo __('On Time','concise-settings')?>
    </div>
</div>
<br style="clear:both">
<br style="clear:both">

<div class="grid-header">
    <div class="show-det" style=""><?php echo __('Show:','concise-settings')?></div>
    <div class="btn-group show-btn" style="">
        <button type="button" class="controlButtons" onClick="showAll();"><?php echo __('All','concise-settings')?>
            </button>
        <button type="button" class="controlButtons" onClick="showDelivered();"><?php echo __('Delivered','concise-settings')?>
            </button>
        <button type="button" class="controlButtons" onClick="showUndelivered();"><?php echo __('Undelivered','concise-settings')?>
            </button>
    </div>
    <div class="text-abs"><?php echo __('on','concise-settings')?></div>
    <div class="btn controlButtons date-pick-gr" id="calendarFilter"><?php echo __('2017-01-01','concise-settings')?>
    </div>
</div>

<table border="0" id="orderTable"></table>

<?php }
add_shortcode('shipment-grid','cs_create_shipment_grid_shortcode');
function cs_wpdocs_theme_name_scripts() {
  global $jqueryTheme;
    wp_enqueue_style( 'style-grid', plugin_dir_url(__FILE__).'/css/style-grid.css' );
    wp_enqueue_style( 'zebra-datepicker', 'https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.4/css/default.min.css' );
    wp_enqueue_script( 'jquery-min', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery-dataTables', '//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'moment-min', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'zebra-datepicker', 'https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.4/javascript/zebra_datepicker.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jqueryui-dataTables', '//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js', array(), '1.0.0', true );
    wp_enqueue_style( 'jqueryui-dataTables', '//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.css' );
    wp_enqueue_style( 'jqueryui-theme', '//code.jquery.com/ui/1.12.1/themes/'.$jqueryTheme.'/jquery-ui.css' );
    wp_enqueue_script( 'script-grid', plugin_dir_url(__FILE__).'/js/script-grid.js', array(), '1.0.0', true );
    $phpInfo = array(
        'concise_company_slug' => get_option( 'concise_company_slug' )
    );
    wp_localize_script( 'script-grid', 'phpInfo', $phpInfo );
}

add_action( 'wp_enqueue_scripts', 'cs_wpdocs_theme_name_scripts' );
 ?>