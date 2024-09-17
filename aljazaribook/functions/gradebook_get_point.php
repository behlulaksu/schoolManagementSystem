<?php 

/* AJAX Gradebook Get Point Callback */
add_action('wp_ajax_nopriv_my_ajax_get_point', 'my_ajax_get_point');
add_action('wp_ajax_my_ajax_get_point', 'my_ajax_get_point');

function my_ajax_get_point(){

	global $wpdb;
	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$button_quarter = $_REQUEST["button_quarter"];
	$button_domain_id = $_REQUEST["button_domain_id"];
	$button_sub_domain_id = $_REQUEST["button_sub_domain_id"];
	$this_class_id = $_REQUEST["this_class_id"];
	$this_subject_id = $_REQUEST["this_subject_id"];
	$gradebook_id = $_REQUEST["gradebook_id"];


	$point_control = get_subject_subdomain_point($this_class_id,$this_subject_id,$button_quarter,$gradebook_id,$button_domain_id,$button_sub_domain_id);







	wp_send_json_success( $point_control);

	wp_die();

}

