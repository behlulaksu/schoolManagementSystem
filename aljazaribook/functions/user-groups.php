<?php 

/*****************************************************************************/
function user_groups() {
	$args = array(
		'label' => 'User Groups',
		'public' => true,
		'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 2,
        'rewrite' => array('slug' => 'user_groups'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array(
        	'title',
        ),
      );
	register_post_type( 'user_groups', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'user_groups' );

/********************************************************************************/


/* AJAX Crate Group Callback */
add_action('wp_ajax_nopriv_my_ajax_create_new_group', 'my_ajax_create_new_group');
add_action('wp_ajax_my_ajax_create_new_group', 'my_ajax_create_new_group');

function my_ajax_create_new_group(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$group_name = $_REQUEST["group_name"];
	$group_admin_email = $_REQUEST["group_admin_email"];

	$userKontrol = get_user_by( 'email', $group_admin_email );
	$admin_user_id = $userKontrol->data->ID;

	$userdata = array(
		'post_title' 	=> $group_name,
		'post_type'		=> 'user_groups',
		'post_status'	=> 'publish',
		'meta_input'	=> array(
			'group_admin'	=> $admin_user_id,
		),
	);

	
	$sonuclar = wp_insert_post($userdata);


	wp_send_json_success( $sonuclar);

	wp_die();

}



/* AJAX Edit User Users Callback */
add_action('wp_ajax_nopriv_my_ajax_edit_group', 'my_ajax_edit_group');
add_action('wp_ajax_my_ajax_edit_group', 'my_ajax_edit_group');

function my_ajax_edit_group(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$postID = $_REQUEST["postID"];
	$group_name = $_REQUEST["group_name"];
	$group_admin_email = $_REQUEST["group_admin_email"];
	$group_stundet_email = $_REQUEST["group_stundet_email"];

	$group_admin_id = array();
	$group_stundet_id = array();

	foreach ($group_admin_email as $key => $value) {
		$userKontrol = get_user_by( 'email', $value );
		$group_admin_id[$key] = $userKontrol->data->ID;
	}
	foreach ($group_stundet_email as $key => $value) {
		$userKontrol = get_user_by( 'email', $value );
		$group_stundet_id[$key] = $userKontrol->data->ID;
	}

	$userdata = array(
		'ID'					=> $postID,
		'post_title' 	=> $group_name,
		'post_status'	=> 'publish',
		'meta_input'	=> array(
			'group_admin'	=> $group_admin_id,
		),
	);

	
	$sonuclar = wp_update_post($userdata);


	wp_send_json_success( $sonuclar);

	wp_die();

}



/* AJAX Edit Class Settings */
add_action('wp_ajax_nopriv_my_ajax_class_settings', 'my_ajax_class_settings');
add_action('wp_ajax_my_ajax_class_settings', 'my_ajax_class_settings');

function my_ajax_class_settings(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$postID = $_REQUEST["postID"];

	$lock_date_q1 = $_REQUEST["lock_date_q1"];
	$lock_date_q2 = $_REQUEST["lock_date_q2"];
	$lock_date_q3 = $_REQUEST["lock_date_q3"];
	$lock_date_q4 = $_REQUEST["lock_date_q4"];
	$active_quarter = $_REQUEST["active_quarter"];


	$choices_multiple_advisor = $_REQUEST["choices_multiple_advisor"];
	$choices_multiple_pdp = $_REQUEST["choices_multiple_pdp"];

	$group_supervisor_id = array();
	$group_pdp_id = array();

	foreach ($choices_multiple_advisor as $key => $value) {
		$userKontrol = get_user_by( 'email', $value );
		$group_supervisor_id[$key] = $userKontrol->data->ID;
	}
	foreach ($choices_multiple_pdp as $key => $value) {
		$userKontrol = get_user_by( 'email', $value );
		$group_pdp_id[$key] = $userKontrol->data->ID;
	}

	$userdata = array(
		'ID'					=> $postID,
		'post_status'	=> 'publish',
		'meta_input'	=> array(
			'class_advisors'	=> $group_supervisor_id,
			'class_pdp'	=> $group_pdp_id,
			'lock_date_q1' => $lock_date_q1,
			'lock_date_q2' => $lock_date_q2,
			'lock_date_q3' => $lock_date_q3,
			'lock_date_q4' => $lock_date_q4,
			'active_quarter' => $active_quarter,
		),
	);

	
	$sonuclar = wp_update_post($userdata);

	$subjecet_credit = $_REQUEST["subjecet_credit"];
	$subject_credit_array = $_REQUEST["subject_credit_array"];
	$subject_lesson_hourse_array = $_REQUEST["subject_lesson_hourse_array"];

	$bg_table_name = "subject_credit";
	$blog_id = get_current_blog_id();
	foreach ($subjecet_credit as $key => $value) {
		$kontrol = get_credit($postID,$value);
		if (empty($kontrol)) {
			if(
				$wpdb->insert($bg_table_name, array(
					'bloog_id' => $blog_id,
					'class_id' => $postID,
					'subjecet_id' => $value,
					'credit' => $subject_credit_array[$key],
					'teacher_id' => $current_user,
					'date' => $registerdate,
					'time' => $registertime,
					'ip' => $ip,
				))
			){
				
			}
		}else{
			if (
				$wpdb->update( $bg_table_name, 
					array( 
						'credit' => $subject_credit_array[$key],
						'teacher_id' => $current_user,
						'date' => $registerdate,
						'time' => $registertime,
						'ip' => $ip,
					), 
					array( 'id' => $kontrol[0]->id )
				)
			) {
				
			}
		}
	}


	$bg_table_name_name = "subject_hours";
	foreach ($subjecet_credit as $key => $value) {
		
		$query = $wpdb->prepare("SELECT * from $bg_table_name_name where blog_id =".$blog_id." and class_id =".$postID." and subject_id =".$value."" );
		$sonuclarlar = $wpdb->get_results($query);

		if (empty($sonuclarlar)) {
			if(
				$wpdb->insert($bg_table_name_name, array(
					'blog_id' => $blog_id,
					'class_id' => $postID,
					'subject_id' => $value,
					'subject_hours' => $subject_lesson_hourse_array[$key],
					'editor_id' => $current_user,
					'date' => $registerdate,
					'time' => $registertime,
					'ip' => $ip,
				))
			){
				
			}
		}else{
			if (
				$wpdb->update( $bg_table_name_name, 
					array( 
						'subject_hours' => $subject_lesson_hourse_array[$key],
						'editor_id' => $current_user,
						'date' => $registerdate,
						'time' => $registertime,
						'ip' => $ip,
					), 
					array( 'id' => $sonuclarlar[0]->id )
				)
			) {
				
			}
		}
	}



	wp_send_json_success($sonuclar);

	wp_die();

}




/* AJAX Edit Subjects Callback */
add_action('wp_ajax_nopriv_my_ajax_edit_subjects', 'my_ajax_edit_subjects');
add_action('wp_ajax_my_ajax_edit_subjects', 'my_ajax_edit_subjects');

function my_ajax_edit_subjects(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$postID = $_REQUEST["postID"];
	$choices_multiple_subject = $_REQUEST["choices_multiple_subject"];




	
	$sonuclar = update_field("subject_for_group",$choices_multiple_subject,$postID);


	wp_send_json_success( $sonuclar);

	wp_die();

}





/* AJAX Delete Class Callback */
add_action('wp_ajax_nopriv_my_ajax_delete_class', 'my_ajax_delete_class');
add_action('wp_ajax_my_ajax_delete_class', 'my_ajax_delete_class');

function my_ajax_delete_class(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$delete_class_id = $_REQUEST["classid"];




	
	$sonuclar = wp_trash_post($delete_class_id);


	wp_send_json_success( $sonuclar);

	wp_die();

}




/* AJAX Get Student Point */
add_action('wp_ajax_nopriv_my_ajax_get_student_not', 'my_ajax_get_student_not');
add_action('wp_ajax_my_ajax_get_student_not', 'my_ajax_get_student_not');

function my_ajax_get_student_not(){

	global $wpdb;
	$sonuclar = '';
	$current_user = get_current_user_id();

	$class_th = $_REQUEST["class_th"];
	$subdomain_th = $_REQUEST["subdomain_th"];
	$domain_th = $_REQUEST["domain_th"];
	$subject_th = $_REQUEST["subject_th"];
	$studetn_th = $_REQUEST["studetn_th"];
	$quarter_th = $_REQUEST["quarter_th"];
	$gradebook_th = $_REQUEST["gradebook_th"];

	$sonuclar = get_student_one_not($class_th,$subject_th,$quarter_th,$gradebook_th,$domain_th,$subdomain_th,$studetn_th);


	


	wp_send_json_success($sonuclar);

	wp_die();

}

/************************ V2 Burdan Asagiya *****************************/
/* AJAX Add Student To Class */
add_action('wp_ajax_nopriv_my_ajax_add_new_student', 'my_ajax_add_new_student');
add_action('wp_ajax_my_ajax_add_new_student', 'my_ajax_add_new_student');

function my_ajax_add_new_student(){

	global $wpdb;
	$sonuclar = array();
	$current_user = get_current_user_id();
	$users_id_arry = array();

	$new_student_add = $_REQUEST["new_student_add"];
	$class_id = $_REQUEST["class_id"];

	$userKontrol = get_user_by( 'email', $new_student_add );
	$new_student_id = $userKontrol->data->ID;

	$sonuclar[1] = "hata";

	if (!empty($new_student_id)) {
		/*update array for new list*/
		$group_users = get_field("group_users",$class_id);
		foreach ($group_users as $key => $value) {
			$users_id_arry[$key] = $value['ID'];
		}
		array_push($users_id_arry,$new_student_id); //ogrenciyi ekledigimiz yer
		/*update post*/
		$userdata = array(
			'ID'					=> $class_id,
			'post_status'	=> 'publish',
			'meta_input'	=> array(
				'group_users'	=> $users_id_arry,
			),
		);

		$sonuclar[1] = wp_update_post($userdata);
		if (is_numeric($sonuclar[1])) {
			$user_info = get_userdata($new_student_id);
			$sonuclar[2] = $user_info->display_name;
			$sonuclar[3] = get_field('school_no', 'user_'.$user_info->ID);
		}


	}

	wp_send_json_success($sonuclar);

	wp_die();

}

/* AJAX Remove Student From Class */
add_action('wp_ajax_nopriv_my_ajax_remove_student', 'my_ajax_remove_student');
add_action('wp_ajax_my_ajax_remove_student', 'my_ajax_remove_student');

function my_ajax_remove_student(){

	global $wpdb;
	$sonuclar = array();
	$current_user = get_current_user_id();
	$users_id_arry = array();

	$remove_student_id = intval($_REQUEST["delete_student_id"]);
	$class_id = $_REQUEST["class_id"];


	$sonuclar[1] = "hata";

	if (!empty($remove_student_id)) {
		/*update array for new list*/
		$group_users = get_field("group_users",$class_id);
		foreach ($group_users as $key => $value) {
			$users_id_arry[$key] = $value['ID'];
		}

		$keyler = array_search($remove_student_id, $users_id_arry);//arrayda arama yapiyoruz
		if ($keyler !== false) {
			unset($users_id_arry[$keyler]);//buldugumuz yerden ID yi siliyoruz
		}
		/*update post*/
		$userdata = array(
			'ID'					=> $class_id,
			'post_status'	=> 'publish',
			'meta_input'	=> array(
				'group_users'	=> $users_id_arry,
			),
		);

		$sonuclar[1] = wp_update_post($userdata);
		if (is_numeric($sonuclar[1])) {
			$user_info = get_userdata($remove_student_id);
			$sonuclar[2] = $user_info->display_name;
		}


	}

	wp_send_json_success($sonuclar);

	wp_die();

}


/* AJAX Add Student To Class */
add_action('wp_ajax_nopriv_my_ajax_move_student', 'my_ajax_move_student');
add_action('wp_ajax_my_ajax_move_student', 'my_ajax_move_student');

function my_ajax_move_student(){

	global $wpdb;
	$sonuclar = array();
	$current_user = get_current_user_id();
	$users_id_arry = array();
	$users_id_arry2 = array();

	$move_selected_student_id = $_REQUEST["move_selected_student_id"];
	$target_class_id = $_REQUEST["target_class_id"];
	$current_class_id = $_REQUEST["current_class_id"];


	$sonuclar[1] = "hata";

	if (!empty($move_selected_student_id)) {

		$book_objective = "book_".get_current_blog_id()."_gradebook";
		global $wpdb;
		$update_query = "UPDATE $book_objective SET gb_group_id = ".$target_class_id." WHERE gb_student_id =".$move_selected_student_id." and gb_group_id =".$current_class_id."";
		$sonuclar[2] = $wpdb->query($update_query);

		$update_query2 = "UPDATE student_avarages SET group_id = ".$target_class_id." WHERE student_id =".$move_selected_student_id." and group_id =".$current_class_id."";
		$sonuclar[2] = $wpdb->query($update_query2);

		/* add new student to target class start */
		$group_users = get_field("group_users",$target_class_id);
		foreach ($group_users as $key => $value) {
			$users_id_arry[$key] = $value['ID'];
		}
		array_push($users_id_arry,$move_selected_student_id);
		$userdata = array(
			'ID'					=> $target_class_id,	
			'post_status'	=> 'publish',
			'meta_input'	=> array(
				'group_users'	=> $users_id_arry,
			),
		);
		$sonuclar[1] = wp_update_post($userdata);
		/* add new student to target class end */

		/* remove student from this class start*/
		$group_users2 = get_field("group_users",$current_class_id);
		foreach ($group_users2 as $key => $value) {
			$users_id_arry2[$key] = $value['ID'];
		}

		$move_selected_student_id = intval($move_selected_student_id);
		$index = array_search($move_selected_student_id, $users_id_arry2);
		if ($index !== false) {
			unset($users_id_arry2[$index]);
		}
		/*update post*/
		$userdata = array(
			'ID'					=> $current_class_id,
			'post_status'	=> 'publish',
			'meta_input'	=> array(
				'group_users'	=> $users_id_arry2,
			),
		);
		$sonuclar[2] = wp_update_post($userdata);
		/* remove student from this class end*/


	}

	wp_send_json_success($sonuclar);

	wp_die();

}