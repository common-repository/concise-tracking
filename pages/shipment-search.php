<?php
function cs_create_shipment_search_shortcode(){
?>
<div class="container" >
    <div class="large-4" >
      <h3><?php echo __('Track a Shipment','concise-settings')?></h3>

      <form method="get" action="concise-shipment" accept-charset="UTF-8" id="form" name="form">
        <input placeholder="<?php echo __('Tracking Number','concise-settings')?>" required="true" name="id" type="text"  /> <button data-type="submit" class="button2"><?php echo __('Track Shipment','concise-settings')?></button>
      </form>

      <h3><?php echo __('Account Tracking','concise-settings')?></h3>

      <form method="get" action="concise-grid" accept-charset="UTF-8" id="form" name="form">
        <input placeholder="<?php echo __('Account Number','concise-settings')?>" required="true" name="id" type="text" /> <button data-type="submit" class="button2"><?php echo __('Track Account','concise-settings')?></button>
      </form>
    </div>

    <div class="large-8" >
      <div class="image-section">
        <img src="<?php echo esc_url( get_option( 'concise_search_form_img' ) ); ?>" alt="_" width="100%">

      
      </div>
    </div>
  </div>
  <?php }
   add_shortcode('shipment-search','cs_create_shipment_search_shortcode');
   function cs_shipmet_search_styles_scripts() {
        wp_enqueue_style( 'style-search', plugin_dir_url(__FILE__).'/css/style-search.css' );
    }
add_action( 'wp_enqueue_scripts', 'cs_shipmet_search_styles_scripts' );
   ?>