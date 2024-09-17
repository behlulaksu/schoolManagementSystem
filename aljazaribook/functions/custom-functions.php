<?php 




function get_student_objective($class_id,$quarter_id,$unite_id,$student_id,$objective_comment_id){
	$book_objective = "book_".get_current_blog_id()."_objectives";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where ob_class =".$class_id." and ob_quarter =".$quarter_id." and ob_unite_id =".$unite_id." and ob_student_id =".$student_id." and ob_comment_id =".$objective_comment_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


function get_student_objective_unit($class_id,$quarter_id,$unite_id,$student_id){
	$book_objective = "book_".get_current_blog_id()."_objectives";

	global $wpdb;
	$query = $wpdb->prepare("SELECT sum(ob_comment) from $book_objective where ob_class =".$class_id." and ob_quarter =".$quarter_id." and ob_unite_id =".$unite_id." and ob_student_id =".$student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}

function get_student_objective_class($class_id,$student_id){
	$book_objective = "book_".get_current_blog_id()."_objectives";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where ob_class =".$class_id." and ob_student_id =".$student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


function get_objective_by_unit($class_id,$quarter_id,$unite_id){
	$book_objective = "book_".get_current_blog_id()."_objectives";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where ob_class =".$class_id." and ob_quarter =".$quarter_id." and ob_unite_id =".$unite_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}

function get_objective_by_unit_sum($class_id,$quarter_id,$unite_id){
	$book_objective = "book_".get_current_blog_id()."_objectives";

	global $wpdb;
	$query = $wpdb->prepare("SELECT sum(ob_comment) as ob_comment from $book_objective where ob_class =".$class_id." and ob_quarter =".$quarter_id." and ob_unite_id =".$unite_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


/**************** Stundet Points ********************/

function get_student_one_point($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_gradebook_id,$gb_domain_id, $gb_subdomain_id, $gb_student_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_domain_id =".$gb_domain_id." and gb_subdomain_id =".$gb_subdomain_id." and gb_student_id =".$gb_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


function get_student_one_not($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_gradebook_id,$gb_domain_id, $gb_subdomain_id, $gb_student_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT gb_point from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_domain_id =".$gb_domain_id." and gb_subdomain_id =".$gb_subdomain_id." and gb_student_id =".$gb_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar[0]->gb_point;

}
function get_subject_subdomain_point($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_gradebook_id,$gb_domain_id, $gb_subdomain_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_domain_id =".$gb_domain_id." and gb_subdomain_id =".$gb_subdomain_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


function get_student_one_not_editor($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_gradebook_id,$gb_domain_id, $gb_subdomain_id, $gb_student_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT gb_teacher_id from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_domain_id =".$gb_domain_id." and gb_subdomain_id =".$gb_subdomain_id." and gb_student_id =".$gb_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar[0]->gb_teacher_id;

}

function get_student_one_not_editor_date($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_gradebook_id,$gb_domain_id, $gb_subdomain_id, $gb_student_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT gb_update_date from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_domain_id =".$gb_domain_id." and gb_subdomain_id =".$gb_subdomain_id." and gb_student_id =".$gb_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar[0]->gb_update_date;

}


function get_student_point_by_subject($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_student_id,$gb_gradebook_id){
	$book_objective = "book_".get_current_blog_id()."_gradebook";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$gb_group_id." and gb_subject_id =".$gb_subject_id." and gb_quarter_id =".$gb_quarter_id." and gb_gradebook_id =".$gb_gradebook_id." and gb_student_id =".$gb_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}



function get_uploaded_file($blogid,$class_id,$subject_id){
	$book_objective = "book_files_information";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where campus_id =".$blogid." and class_id =".$class_id." and subjecet_id =".$subject_id." and file_active = 1" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}



function get_uploaded_file_quarter($blogid,$class_id,$subject_id,$quarter_id,$file_type){
	$book_objective = "book_files_information";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where campus_id =".$blogid." and class_id =".$class_id." and subjecet_id =".$subject_id." and quarter_id =".$quarter_id." and file_type = '".$file_type."' and file_active = 1" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


function get_uploaded_file_user($blogid,$user_id){
	$book_objective = "book_files_information";

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where campus_id =".$blogid." and user_id =".$user_id." and file_active = 1" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}

/* Get Student Comment */
function get_student_comment($gb_group_id,$gb_subject_id,$gb_quarter_id,$gb_student_id,$type_comment){
	$book_objective = "student_comments";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where blog_id =".$blog_id." and class_id =".$gb_group_id." and subjecet_id =".$gb_subject_id." and quarter_id =".$gb_quarter_id." and student_id =".$gb_student_id." and type_comment = '".$type_comment."'" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


/* Get Student Comment */
function get_student_comment_easy($gb_subject_id,$gb_quarter_id,$gb_student_id,$type_comment){
	$book_objective = "student_comments";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $book_objective where blog_id =".$blog_id." and subjecet_id =".$gb_subject_id." and quarter_id =".$gb_quarter_id." and student_id =".$gb_student_id." and type_comment = '".$type_comment."'" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


/* Get PDP Select Comment */
function get_pdp_select_comment($class_id,$quarter_id,$student_id,$comment_order){
	$student_comments = "pdp_section_comments";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $student_comments where blog_id =".$blog_id." and class_id =".$class_id." and quarter_id =".$quarter_id." and student_id =".$student_id." and comment_order = '".$comment_order."'" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}

/* Get Long Countent Comments */
function get_long_comment($class_id,$quarter_id,$student_id,$comment_type){
	$student_comments = "long_countent_comments";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $student_comments where blog_id =".$blog_id." and class_id =".$class_id." and quarter_id =".$quarter_id." and student_id =".$student_id." and comment_type = '".$comment_type."'" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}

function get_attandance($class_id,$quarter_id,$student_id){
	$student_comments = "student_attandance";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $student_comments where bloog_id =".$blog_id." and class_id =".$class_id." and quarter_id =".$quarter_id." and student_id =".$student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


/* Get Subject Comment */
function get_subject_comment($subject_id,$com_quarter_id,$com_student_id){
	$subject_comments = "subject_comments";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $subject_comments where subject_id =".$subject_id." and quarter_id =".$com_quarter_id." and student_id =".$com_student_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}


add_action('wp_ajax_nopriv_get_student_display', 'get_student_display');
add_action('wp_ajax_get_student_display', 'get_student_display');

function get_student_display(){

	global $wpdb;
	$user_id = $_REQUEST["user_id"];

	$sonuc = get_userdata($user_id)->data->display_name;

	wp_send_json_success( $sonuc);

	wp_die();

}



/* Get Subject Comment */
function get_credit($class_id,$subject_id){
	$subject_credit = "subject_credit";
	$blog_id = get_current_blog_id();

	global $wpdb;
	$query = $wpdb->prepare("SELECT * from $subject_credit where bloog_id =".$blog_id." and class_id =".$class_id." and subjecet_id	 =".$subject_id."" );
	$sonuclar = $wpdb->get_results($query);
	return $sonuclar;

}