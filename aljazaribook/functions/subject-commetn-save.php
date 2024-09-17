<?php 
/* AJAX Set Class PDP Selectable Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_subject_comment', 'my_ajax_subject_comment');
add_action('wp_ajax_my_ajax_subject_comment', 'my_ajax_subject_comment');

function my_ajax_subject_comment(){
	global $wpdb;

	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$subject_id = $_POST["subject_id"];
	$com_student_id = $_POST["com_student_id"];
	$com_quarter_id = $_POST["com_quarter_id"];
	$secilen_normal_comment = $_POST["secilen_normal_comment"];

	$bg_table_name = "subject_comments";


	$comment_control = get_subject_comment($subject_id, $com_quarter_id, $com_student_id);
	if (empty($comment_control)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'blog_id' => $blog_id,
				'subject_id' => $subject_id,
				'quarter_id' => $com_quarter_id,
				'student_id' => $com_student_id,
				'comment_order' => $secilen_normal_comment,
				'teacher_id' => $current_user,
				'ip' => $ip,
				'time' => $registertime,
				'date' => $registerdate,
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
					'ip' => $ip,
					'time' => $registertime,
					'date' => $registerdate,

					'comment_order' => $secilen_normal_comment,
				), 
				array( 'id' => $comment_control[0]->id )
			)
		) {
			$sonuclar="tamam";
		}
	}





	wp_send_json_success($sonuclar);

	wp_die();

}