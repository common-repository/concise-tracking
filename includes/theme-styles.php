<?php
add_action( 'wp_head', 'cs_customizer_css');
function cs_customizer_css()
{ ?>
    <style type="text/css">
 .custom-header a, .custom-header p{ color: <?php echo get_option('concise_header_color'); ?>!important; }
 .controlButtons{
  background-color: <?php echo get_option('concise_button_colors'); ?>!important
 }
</style>
<?php } ?>