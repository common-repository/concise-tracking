<?php
function concise_set(){
	if (isset($_REQUEST['save_settings'])) {
		if(wp_verify_nonce($_REQUEST['submit_post'], 'test_action')){
		 $companySlug = esc_html(trim($_REQUEST['concise_company_slug']));
		 $headerColor = esc_html(trim($_REQUEST['concise_header_color']));
		 $buttonColors = esc_html(trim($_REQUEST['concise_button_colors']));
		 $searchFormImg = esc_url(trim($_REQUEST['concise_search_form_img']));
		 $jQueryTheme = esc_html(trim($_REQUEST['concise_jquery_theme']));
		 $gmApiKey = esc_html(trim($_REQUEST['concise_gm_api_key']));
		 update_option('concise_company_slug', $companySlug); 
		 update_option('concise_header_color',$headerColor);
		 update_option('concise_button_colors',$buttonColors);
		 update_option('concise_search_form_img',$searchFormImg);
		 update_option('concise_jquery_theme',$jQueryTheme);
		 update_option('concise_gm_api_key',$gmApiKey);
		 
		 echo __('<div class="notice notice-success is-dismissible">
             <p>Setting has been saved successfully!.</p>
         </div>','concise-settings');
		}else{
			echo __('<div class="notice notice-success is-dismissible">
             <p>Setting could not be saved successfully!.</p>
         </div>','concise-settings');
		}
	}
	?>
    <div class="wrap">
	<h2><?php echo __('Concise Settings','concise-settings')?></h2>
		<div id="poststuff">
			<div id="post-body">
			 <form action="" method="post">
			 	<?php wp_nonce_field('test_action', 'submit_post'); ?>
				<table class="form-table"> 
					<tr>
						<th><?php echo __('Company Slug','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('Company slug','concise-settings')?>" name="concise_company_slug" value="<?php echo esc_attr( get_option('concise_company_slug') ); ?>" required style="width:214px"/></td>
					</tr>
					<tr>
						<th><?php echo __('Header Color','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('For Ex: #ffffff','concise-settings')?>" name="concise_header_color" value="<?php echo esc_attr( get_option('concise_header_color') ); ?>" required size="30" /></td>
					</tr>
					<tr>
						<th><?php echo __('Button Colors','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('For Ex: #ffffff','concise-settings')?>" name="concise_button_colors" value="<?php echo esc_attr( get_option('concise_button_colors') ); ?>" required size="30" /></td>
					</tr>
					<tr>
						<th><?php echo __('Search Form Image','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('Enter image url','concise-settings')?>" name="concise_search_form_img" value="<?php echo esc_attr( get_option('concise_search_form_img') ); ?>" required size="30" /></td>
					</tr>
					<tr>
						<th><?php echo __('jQuery Theme','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('jQuery theme','concise-settings')?>" name="concise_jquery_theme" value="<?php echo esc_attr( get_option('concise_jquery_theme') ); ?>" required size="30" /></td>
					</tr>
					<tr>
						<th><?php echo __('Google Map Api Key','concise-settings')?></th>
						<td><input type="text" placeholder="<?php echo __('Google map api key','concise-settings')?>" name="concise_gm_api_key" value="<?php echo esc_attr( get_option('concise_gm_api_key') ); ?>" required size="30" /></td>
					</tr>
					<tr>
						<td><p class="submit">
            <input type="submit" name="save_settings" value="Update Setting" class="button-primary" />
        </p></td>
					</tr>
				</table>
			  </form>
		  </div>
	  </div>
    </div>
	<?php
}
?>
