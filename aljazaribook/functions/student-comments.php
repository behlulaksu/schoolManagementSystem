<?php 

/* AJAX Student Academic Comment Callback */
add_action('wp_ajax_nopriv_my_ajax_comments', 'my_ajax_comments');
add_action('wp_ajax_my_ajax_comments', 'my_ajax_comments');

function my_ajax_comments(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$student_id = $_REQUEST["student_id"];
	$student_content = $_REQUEST["student_content"];
	$class_id = $_REQUEST["class_id"];
	$quarter_id = $_REQUEST["quarter_id"];
	$secili_id = $_REQUEST["secili_id"];
	$blog_id = get_current_blog_id();

	$bg_table_name = "academic_pdp_comment";


	$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and type_comment = 'advisor_comment' and quarter_id =".$quarter_id." and class_id =".$class_id." and student_id =".$student_id."" );
	$sonuclar1 = $wpdb->get_results($query);


	if (empty($sonuclar1)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'blog_id' => $blog_id,
				'quarter_id' => $quarter_id,
				'class_id' => $class_id,
				'student_id' => $student_id,
				'teacher_id' => $current_user,
				'comment' => $student_content,
				'secili_id' => $secili_id,
				'type_comment' => 'advisor_comment',
				'date' => $registerdate,
				'time_register' => $registertime,
				'ip' => $ip,
			))
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}else{
		$wpdb->update( 'academic_pdp_comment', 
			array( 
				'teacher_id' => $current_user,
				'comment' => $student_content,
				'secili_id' => $secili_id,
				'date' => $registerdate,
				'time_register' => $registertime,
				'ip' => $ip,
			), 
			array( 'id' => $sonuclar1[0]->id )
		);
		$sonuclar = "tamam";
	}



	wp_send_json_success( $sonuclar);

	wp_die();


}



/* AJAX Student PDP Comment Callback */
add_action('wp_ajax_nopriv_my_ajax_comments_pdp_comment', 'my_ajax_comments_pdp_comment');
add_action('wp_ajax_my_ajax_comments_pdp_comment', 'my_ajax_comments_pdp_comment');

function my_ajax_comments_pdp_comment(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$student_id = $_REQUEST["student_id"];
	$student_content = $_REQUEST["student_content"];
	$class_id = $_REQUEST["class_id"];
	$quarter_id = $_REQUEST["quarter_id"];
	$secili_id = $_REQUEST["secili_id"];
	$blog_id = get_current_blog_id();

	$bg_table_name = "academic_pdp_comment";


	$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and type_comment = 'pdp_comment' and quarter_id =".$quarter_id." and class_id =".$class_id." and student_id =".$student_id."" );
	$sonuclar1 = $wpdb->get_results($query);


	if (empty($sonuclar1)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'blog_id' => $blog_id,
				'quarter_id' => $quarter_id,
				'class_id' => $class_id,
				'student_id' => $student_id,
				'teacher_id' => $current_user,
				'comment' => $student_content,
				'secili_id' => $secili_id,
				'type_comment' => 'pdp_comment',
				'date' => $registerdate,
				'time_register' => $registertime,
				'ip' => $ip,
			))
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}else{
		$wpdb->update( 'academic_pdp_comment', 
			array( 
				'teacher_id' => $current_user,
				'comment' => $student_content,
				'secili_id' => $secili_id,
				'date' => $registerdate,
				'time_register' => $registertime,
				'ip' => $ip,
			), 
			array( 'id' => $sonuclar1[0]->id )
		);
		$sonuclar = "tamam";
	}



	wp_send_json_success( $sonuclar);

	wp_die();


}





/* AJAX Counsilling Comments Callback */
add_action('wp_ajax_nopriv_my_ajax_new_counsilling_note', 'my_ajax_new_counsilling_note');
add_action('wp_ajax_my_ajax_new_counsilling_note', 'my_ajax_new_counsilling_note');

function my_ajax_new_counsilling_note(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$note_type = $_REQUEST["note_type"];
	$interviewed = $_REQUEST["interviewed"];
	$visivle_type = $_REQUEST["visivle_type"];
	$private_type = $_REQUEST["private_type"];
	$counselling_note = $_REQUEST["counselling_note"];
	$stundet_id = $_REQUEST["stundet_id"];
	$blog_id = get_current_blog_id();

	$bg_table_name = "counselling_note";


	$wpdb->insert($bg_table_name, array(
		'domain_id' => $blog_id,
		'student_id' => $stundet_id,
		'teacher_id' => $current_user,
		'teacher_ip' => $ip,
		'update_time' => $registertime,
		'update_date' => $registerdate,
		'note_type' => $note_type,
		'interview' => $interviewed,
		'visible' => $visivle_type,
		'private' => $private_type,
		'note' => $counselling_note,
	));


	wp_send_json_success( $wpdb);

	wp_die();


}








/* AJAX Counsilling Comments Delete Callback */
add_action('wp_ajax_nopriv_my_ajax_new_counsilling_delete', 'my_ajax_new_counsilling_delete');
add_action('wp_ajax_my_ajax_new_counsilling_delete', 'my_ajax_new_counsilling_delete');

function my_ajax_new_counsilling_delete(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$commnet_id = $_REQUEST["commnet_id"];




	$wpdb->update( 'counselling_note', 
		array( 
			'teacher_id' => $current_user,
			'teacher_ip' => $ip,
			'update_time' => $registertime,
			'update_date' => $registerdate,
			'delete_status' => 1,
		), 
		array( 'id' => $commnet_id )
	);

	wp_send_json_success( $wpdb);

	wp_die();


}





/* AJAX Counsilling Comments Delete Callback */
add_action('wp_ajax_nopriv_my_ajax_new_counsilling_restore', 'my_ajax_new_counsilling_restore');
add_action('wp_ajax_my_ajax_new_counsilling_restore', 'my_ajax_new_counsilling_restore');

function my_ajax_new_counsilling_restore(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$commnet_id = $_REQUEST["commnet_id"];


	$wpdb->update( 'counselling_note', 
		array( 
			'delete_status' => 0,
		), 
		array( 'id' => $commnet_id )
	);

	wp_send_json_success( $wpdb);

	wp_die();


}