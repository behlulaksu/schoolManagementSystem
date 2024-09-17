<?php 


/* AJAX Gradebook Save Point Callback */
add_action('wp_ajax_nopriv_my_ajax_save_point', 'my_ajax_save_point');
add_action('wp_ajax_my_ajax_save_point', 'my_ajax_save_point');

function my_ajax_save_point(){

	global $wpdb;
	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$group = $_REQUEST["group"];
	$subject = $_REQUEST["subject"];
	$current_user_id = $_REQUEST["current_user_id"];
	$gradebook_ID = $_REQUEST["gradebook_ID"];
	$domainID = $_REQUEST["domainID"];
	$subDomainID = $_REQUEST["subDomainID"];
	$quarterID = $_REQUEST["quarterID"];
	$student_id = $_REQUEST["student_id"];
	$student_point = $_REQUEST["student_point"];

	$bg_table_name = "book_".get_current_blog_id()."_gradebook";


	foreach ($student_id as $key => $value) {
		$point_control = get_student_one_point($group,$subject,$quarterID,$gradebook_ID,$domainID,$subDomainID,$value);
		if (empty($point_control)) {
			if ($student_point[$key] != "") {
				if(
					$wpdb->insert($bg_table_name, array(
						'gb_student_id' => $value,
						'gb_group_id' => $group,
						'gb_subject_id' => $subject,
						'gb_quarter_id' => $quarterID,
						'gb_gradebook_id' => $gradebook_ID,
						'gb_domain_id' => $domainID,
						'gb_subdomain_id' => $subDomainID,
						'gb_teacher_ip' => $ip,
						'gb_teacher_id' => $current_user,
						'gb_update_time' => $registertime,
						'gb_update_date' => $registerdate,

						'gb_point' => $student_point[$key],

					))
				){
					$sonuclar="tamam";
				}else{
					$sonuclar="problem";
				}
			}
		}else{
			/*here we ganna make update for point*/
			$sonuclar = "bu not zaten var";
			if ($point_control[0]->gb_point != $student_point[$key]) {
				$wpdb->update( $bg_table_name, 
					array( 
						'gb_teacher_ip' => $ip,
						'gb_teacher_id' => $current_user,
						'gb_update_time' => $registertime,
						'gb_update_date' => $registerdate,

						'gb_point' => $student_point[$key],
					), 
					array( 'gb_id' => $point_control[0]->gb_id ) //$objective_control[0]->ob_id
				);
			}
			$sonuclar = "ayni puan bu";

		}

	}






	wp_send_json_success( $sonuclar);

	wp_die();

}



/* AJAX Gradebook Save Point Callback */
add_action('wp_ajax_nopriv_my_ajax_comment_save', 'my_ajax_comment_save');
add_action('wp_ajax_my_ajax_comment_save', 'my_ajax_comment_save');

function my_ajax_comment_save(){

	global $wpdb;
	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$group_id_comment = $_REQUEST["group_id_comment"];
	$subject_id_commnet = $_REQUEST["subject_id_commnet"];
	$quarter_comment_btn = $_REQUEST["quarter_comment_btn"];
	$comment_type = $_REQUEST["comment_type"];
	$studet_id_array = $_REQUEST["studet_id_array"];
	$student_comment_array = $_REQUEST["student_comment_array"];

	$blog_id = get_current_blog_id();
	$bg_table_name = "student_comments";

	foreach ($studet_id_array as $key => $value) {
		$comment_control = get_student_comment($group_id_comment,$subject_id_commnet,$quarter_comment_btn,$value,$comment_type);
		if (empty($comment_control)) {
			if ($student_comment_array[$key] != "") {
				if(
					$wpdb->insert($bg_table_name, array(
						'blog_id' => $blog_id,
						'class_id' => $group_id_comment,
						'subjecet_id' => $subject_id_commnet,
						'quarter_id' => $quarter_comment_btn,
						'student_id' => $value,
						'teacher_id' => $current_user,
						'type_comment' => $comment_type,
						'comment' => $student_comment_array[$key],
						'date' => $registerdate,
						'time_register' => $registertime,
						'ip' => $ip,
					))
				){
					$sonuclar="tamam";
				}else{
					$sonuclar="problem";
				}
			}
		}else{
			if (
				$wpdb->update( $bg_table_name, 
					array( 
						'teacher_id' => $current_user,
						'date' => $registerdate,
						'time_register' => $registertime,
						'ip' => $ip,

						'comment' => $student_comment_array[$key],
					), 
					array( 'id' => $comment_control[0]->id )
				)
			) {
				$sonuclar="tamam";
			}
			
		}

	}

	wp_send_json_success( $sonuclar);

	wp_die();

}



/* AJAX Student Final Project */
add_action('wp_ajax_nopriv_my_ajax_add_project', 'my_ajax_add_project');
add_action('wp_ajax_my_ajax_add_project', 'my_ajax_add_project');

function my_ajax_add_project(){

	global $wpdb;
	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$class_id = $_REQUEST["class_id"];
	$subject_id = $_REQUEST["subject_id"];
	$student_project_id = $_REQUEST["student_project_id"];

	$blog_id = get_current_blog_id();
	$bg_table_name = "final_project";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and class_id =".$class_id." and subject_id =".$subject_id." and student_id =".$student_project_id."" );
	$project_control = $wpdb->get_results($query);

	if (empty($project_control)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'blog_id' => $blog_id,
				'class_id' => $class_id,
				'subject_id' => $subject_id,
				'student_id' => $student_project_id,
				'did_project' => 1,
				'teacher_id' => $current_user,
				'teacher_ip' => $ip,
				'date' => $registerdate,
				'time' => $registertime,
			))
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}else{
		if(
			$wpdb->update( $bg_table_name, 
				array( 
					'blog_id' => $blog_id,
					'class_id' => $class_id,
					'subject_id' => $subject_id,
					'student_id' => $student_project_id,
					'did_project' => 1,
					'teacher_id' => $current_user,
					'teacher_ip' => $ip,
					'date' => $registerdate,
					'time' => $registertime,
				), 
				array( 'id' => $project_control[0]->id )
			)
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}


	wp_send_json_success($sonuclar);

	wp_die();

}	



/* AJAX Student Final Project Cancel */
add_action('wp_ajax_nopriv_my_ajax_cancel_project', 'my_ajax_cancel_project');
add_action('wp_ajax_my_ajax_cancel_project', 'my_ajax_cancel_project');

function my_ajax_cancel_project(){

	global $wpdb;
	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$class_id = $_REQUEST["class_id"];
	$subject_id = $_REQUEST["subject_id"];
	$student_project_id = $_REQUEST["student_project_id"];

	$blog_id = get_current_blog_id();
	$bg_table_name = "final_project";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and class_id =".$class_id." and subject_id =".$subject_id." and student_id =".$student_project_id."" );
	$project_control = $wpdb->get_results($query);

	if (!empty($project_control)) {
		if(
			$wpdb->update( $bg_table_name, 
				array( 
					'blog_id' => $blog_id,
					'class_id' => $class_id,
					'subject_id' => $subject_id,
					'student_id' => $student_project_id,
					'did_project' => 0,
					'teacher_id' => $current_user,
					'teacher_ip' => $ip,
					'date' => $registerdate,
					'time' => $registertime,
				), 
				array( 'id' => $project_control[0]->id )
			)
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}



	wp_send_json_success($sonuclar);

	wp_die();

}	