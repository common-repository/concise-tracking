<?php
add_action('admin_menu', 'add_menu_concise');
function add_menu_concise(){
    add_menu_page(__('Concise Settings','concise-settings'), __('Concise Settings','concise-settings'), 'manage_options', 'concise-settings', 'concise_set', '');
}
?>