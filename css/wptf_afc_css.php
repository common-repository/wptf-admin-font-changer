<?php 
	global $current_user;
	$s_opt_wptf_afc_font_family = get_user_meta($current_user->ID, 'wptf-afc-font-family', true); 
	$s_opt_wptf_afc_font_size = get_user_meta($current_user->ID, 'wptf-afc-font-size', true); 
	$s_opt_wptf_afc_font_weight = get_user_meta($current_user->ID, 'wptf-afc-font-weight', true); 
?>
<?php
	if( 	isset($s_opt_wptf_afc_font_family) && !empty($s_opt_wptf_afc_font_family)  
		|| 	isset($s_opt_wptf_afc_font_size) && !empty($s_opt_wptf_afc_font_size)
		|| 	isset($s_opt_wptf_afc_font_weight) && !empty($s_opt_wptf_afc_font_weight)
	):
?>
<!-- wptf-afc-css-start -->
<style> body, div, a, span, td, button, input, select, p, li, strong { <?php if( isset($s_opt_wptf_afc_font_size) && !empty($s_opt_wptf_afc_font_size) ): ?>font-size: <?php echo $s_opt_wptf_afc_font_size; ?>px !important;<?php endif; ?> <?php if( isset($s_opt_wptf_afc_font_family) && !empty($s_opt_wptf_afc_font_family) ): ?>font-family: <?php echo $s_opt_wptf_afc_font_family; ?> !important;<?php endif; ?> <?php if( isset($s_opt_wptf_afc_font_weight) && !empty($s_opt_wptf_afc_font_weight) ): ?>font-weight: <?php echo $s_opt_wptf_afc_font_weight; ?> !important;<?php endif; ?> } </style>
<!-- wptf-afc-css-end -->
<?php
	endif;
?>