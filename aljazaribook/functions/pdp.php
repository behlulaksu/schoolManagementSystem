<?php 

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'  => 'PDP Settings',
		'menu_title'  => 'PDP Settings',
		'menu_slug'   => 'pdp-settings',
		//'parent_slug' => '',
		'capability'  => 'manage_options',
		'redirect'    => false
	));

}


/* AJAX Edit PDP Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_pdp_add_comment_domain', 'my_ajax_pdp_add_comment_domain');
add_action('wp_ajax_my_ajax_pdp_add_comment_domain', 'my_ajax_pdp_add_comment_domain');

function my_ajax_pdp_add_comment_domain(){

	$sonuclar = 'problem';

	$new_comment = $_POST["new_comment"];
	$new_comment_group_id = $_POST["new_comment_group_id"];





	if (have_rows('add_pdp_content_group', 'options')) {
		while (have_rows('add_pdp_content_group', 'options')) {
			the_row();
			if ($new_comment_group_id == get_row_index()) {
				$new_inner_row = array(
					'comment' => $new_comment,
				);
				$sonuclar = add_sub_row('add_group_field', $new_inner_row, 'options');
			}
		}
	}


	wp_send_json_success($sonuclar);

	wp_die();

}

/* AJAX Edit PDP Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_create_comment_group', 'my_ajax_create_comment_group');
add_action('wp_ajax_my_ajax_create_comment_group', 'my_ajax_create_comment_group');

function my_ajax_create_comment_group(){

	$sonuclar = 'problem';

	$group_name_input = $_POST["group_name_input"];

	$new_inner_row = array(
		'group_name' => $group_name_input,
	);
	$sonuclar = add_row('add_pdp_content_group', $new_inner_row, 'options');


	wp_send_json_success($sonuclar);

	wp_die();

}


/* AJAX Edit PDP Settings Delete Comment Callback */
add_action('wp_ajax_nopriv_my_ajax_pdp_delete_comment_domain', 'my_ajax_pdp_delete_comment_domain');
add_action('wp_ajax_my_ajax_pdp_delete_comment_domain', 'my_ajax_pdp_delete_comment_domain');

function my_ajax_pdp_delete_comment_domain(){

	$sonuclar = 'problem';

	$group_id = $_POST["group_id"];
	$commnet_id = $_POST["commnet_id"];





	if (have_rows('add_pdp_content_group', 'options')) {
		while (have_rows('add_pdp_content_group', 'options')) {
			the_row();
			if ($group_id == get_row_index()) {
				$sonuclar = delete_sub_row('add_group_field', $commnet_id);
			}
		}
	}


	wp_send_json_success($sonuclar);

	wp_die();

}



/* AJAX Set Class PDP Selectable Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_set_class_pdp_selectable', 'my_ajax_set_class_pdp_selectable');
add_action('wp_ajax_my_ajax_set_class_pdp_selectable', 'my_ajax_set_class_pdp_selectable');

function my_ajax_set_class_pdp_selectable(){

	$sonuclar = 'problem';
	$pdp_select_comments = "pdp_select_comments_q1";
	$set_group_id = $_POST["set_group_id"];
	$selected_class = $_POST["selected_class"];
	$selected_quarter = $_POST["selected_quarter"];
	$comment_array = [];

	if (have_rows('add_pdp_content_group', 'options')) {
		while (have_rows('add_pdp_content_group', 'options')) {
			the_row();
			if ($set_group_id == get_row_index()) {
				if(have_rows('add_group_field', 'options')): 
					while(have_rows('add_group_field', 'options')): 
						the_row(); 
						$comment_array[get_row_index()] = get_sub_field("comment");
					endwhile; 
				endif;
			}
		}
	}

	if ($selected_quarter == 1) {
		$pdp_select_comments = "pdp_select_comments_q1";
	}elseif ($selected_quarter == 2) {
		$pdp_select_comments = "pdp_select_comments_q2";
	}elseif ($selected_quarter == 3) {
		$pdp_select_comments = "pdp_select_comments_q3";
	}elseif ($selected_quarter == 4) {
		$pdp_select_comments = "pdp_select_comments_q4";
	}

	delete_field($pdp_select_comments, $selected_class);

	foreach ($comment_array as $key => $value) {
		$sonuclar = add_row($pdp_select_comments, array('comment' => $value), $selected_class);
	}

	wp_send_json_success($sonuclar);

	wp_die();

}


/* AJAX Set Class PDP Selectable Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_select_comment_save', 'my_ajax_select_comment_save');
add_action('wp_ajax_my_ajax_select_comment_save', 'my_ajax_select_comment_save');

function my_ajax_select_comment_save(){
	global $wpdb;

	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$class_id = $_POST["class_id"];
	$selected_student = $_POST["selected_student"];
	$selected_active_quarter = $_POST["selected_active_quarter"];
	$selected_comment_type = $_POST["selected_comment_type"];
	$comment_number = $_POST["comment_number"];

	$bg_table_name = "pdp_section_comments";


	foreach ($comment_number as $key => $value) {
		$comment_control = get_pdp_select_comment($class_id, $selected_active_quarter, $selected_student, $key+1);
		if (empty($comment_control)) {
			if(
				$wpdb->insert($bg_table_name, array(
					'blog_id' => $blog_id,
					'class_id' => $class_id,
					'quarter_id' => $selected_active_quarter,
					'student_id' => $selected_student,
					'teacher_id' => $current_user,
					'comment_order' => $key+1,
					'comment_number' => $value,
					'gb_teacher_ip' => $ip,
					'gb_update_time' => $registertime,
					'gb_update_date' => $registerdate,
				))
			){
				$sonuclar="tamam";
			}else{
				$sonuclar="problem";
			}
		}else{
			if (
				$wpdb->update( $bg_table_name, 
					array( 
						'teacher_id' => $current_user,
						'gb_update_date' => $registerdate,
						'gb_update_time' => $registertime,
						'gb_teacher_ip' => $ip,

						'comment_number' => $value,
					), 
					array( 'id' => $comment_control[0]->id )
				)
			) {
				$sonuclar="tamam";
			}
		}

	}


	$secilen_normal_comment = $_POST["secilen_normal_comment"];
	if (!empty($secilen_normal_comment)) {
		$comment_type = "pdp_long_comment";
		$comment_control = get_long_comment($class_id, $selected_active_quarter, $selected_student,$comment_type);

		$table_name = "long_countent_comments";
		if (empty($comment_control)) {
			if(
				$wpdb->insert($table_name, array(
					'blog_id' => $blog_id,
					'class_id' => $class_id,
					'quarter_id' => $selected_active_quarter,
					'student_id' => $selected_student,
					'teacher_id' => $current_user,
					'comment_type' => $comment_type,
					'comment' => $secilen_normal_comment,
					'teacher_ip' => $ip,
					'update_time' => $registertime,
					'update_date' => $registerdate,
				))
			){
				$sonuclar="tamam";
			}else{
				$sonuclar="problem";
			}
		}else{
			if (
				$wpdb->update( $table_name, 
					array( 
						'teacher_id' => $current_user,
						'update_date' => $registerdate,
						'update_time' => $registertime,
						'teacher_ip' => $ip,

						'comment' => $secilen_normal_comment,
					), 
					array( 'id' => $comment_control[0]->id )
				)
			) {
				$sonuclar="tamam";
			}
		}
	}



	wp_send_json_success($sonuclar);

	wp_die();

}



/* AJAX Set Class PDP Selectable Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_grade_advisor_save', 'my_ajax_grade_advisor_save');
add_action('wp_ajax_my_ajax_grade_advisor_save', 'my_ajax_grade_advisor_save');

function my_ajax_grade_advisor_save(){
	global $wpdb;

	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$class_id = $_POST["class_id"];
	$selected_student = $_POST["selected_student"];
	$selected_active_quarter = $_POST["selected_active_quarter"];
	$selected_comment_type = $_POST["selected_comment_type"];


	$secilen_normal_comment = $_POST["secilen_normal_comment"];
	if (!empty($secilen_normal_comment)) {
		$comment_type = "grade_advisor_comment";
		$comment_control = get_long_comment($class_id, $selected_active_quarter, $selected_student,$comment_type);

		$table_name = "long_countent_comments";
		if (empty($comment_control)) {
			if(
				$wpdb->insert($table_name, array(
					'blog_id' => $blog_id,
					'class_id' => $class_id,
					'quarter_id' => $selected_active_quarter,
					'student_id' => $selected_student,
					'teacher_id' => $current_user,
					'comment_type' => $comment_type,
					'comment' => $secilen_normal_comment,
					'teacher_ip' => $ip,
					'update_time' => $registertime,
					'update_date' => $registerdate,
				))
			){
				$sonuclar="tamam";
			}else{
				$sonuclar="problem";
			}
		}else{
			if (
				$wpdb->update( $table_name, 
					array( 
						'teacher_id' => $current_user,
						'update_date' => $registerdate,
						'update_time' => $registertime,
						'teacher_ip' => $ip,

						'comment' => $secilen_normal_comment,
					), 
					array( 'id' => $comment_control[0]->id )
				)
			) {
				$sonuclar="tamam";
			}
		}
	}



	wp_send_json_success($sonuclar);

	wp_die();

}