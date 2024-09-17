<?php 

/* AJAX Edit Campus Settings */
add_action('wp_ajax_nopriv_my_ajax_campus_settings', 'my_ajax_campus_settings');
add_action('wp_ajax_my_ajax_campus_settings', 'my_ajax_campus_settings');

function my_ajax_campus_settings(){

	$sonuclar = '';

	$lock_date_q1 = $_POST["lock_date_q1"];
	$lock_date_q2 = $_POST["lock_date_q2"];
	$lock_date_q3 = $_POST["lock_date_q3"];
	$lock_date_q4 = $_POST["lock_date_q4"];

	$active_quarter = $_POST["active_quarter"];



	update_field('lock_campus_q1', $lock_date_q1, 'options');
	update_field('lock_campus_q2', $lock_date_q2, 'options');
	update_field('lock_campus_q3', $lock_date_q3, 'options');
	update_field('lock_campus_q4', $lock_date_q4, 'options');

	update_field('active_campus_quarter', $active_quarter, 'options');

	$posts = get_posts(array(
		'post_type' => 'user_groups', 
		'posts_per_page' => -1,
	));
	foreach ($posts as $post) {
		update_field('lock_date_q1', $lock_date_q1, $post->ID);
		update_field('lock_date_q2', $lock_date_q2, $post->ID);
		update_field('lock_date_q3', $lock_date_q3, $post->ID);
		update_field('lock_date_q4', $lock_date_q4, $post->ID);
		update_field('active_quarter', $active_quarter, $post->ID);
	}

	$sonuclar = "tamam";



	wp_send_json_success($sonuclar);

	wp_die();

}