<?php

function update_global_asc_time_table_id( $user_id ) {

    // ACF alanını al
	$asc_time_table_id = get_field('asc_time_table_id', 'user_' . $user_id);

    // Global meta alanını güncelle
	if ( $asc_time_table_id ) {
		update_user_meta( $user_id, 'asc_time_table_id', $asc_time_table_id );
	}
}
add_action('acf/save_post', 'update_global_asc_time_table_id', 20);

/* AJAX Crate User Callback */
add_action('wp_ajax_nopriv_my_ajax_create_users_manuel', 'my_ajax_create_users_manuel');
add_action('wp_ajax_my_ajax_create_users_manuel', 'my_ajax_create_users_manuel');

function my_ajax_create_users_manuel(){

	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$first_name = $_REQUEST["first_name"];
	$last_name = $_REQUEST["last_name"];
	$tc = $_REQUEST["tc"];
	$schoolno = $_REQUEST["schoolno"];
	$gender = $_REQUEST["gender"];
	$birthday = $_REQUEST["birthday"];
	$studentgrade = $_REQUEST["studentgrade"];
	$email = $_REQUEST["email"];
	$userpassword = $_REQUEST["userpassword"];
	$userrole = $_REQUEST["userrole"];


	$userdata = array(
		'user_pass' 	=> $userpassword,
		'user_login' 	=> $email,
		'user_nicename' => $first_name,
		'user_email' 	=> $email,
		'last_name' 	=> $last_name,
		'first_name' 	=> $first_name,
		'role' 			=> $userrole,
		'meta_input' 	=> array(
			'tc' 			=> $tc,
			'school_no'		=> $schoolno,
			'gender'		=> $gender,
			'birthday'		=> $birthday,
			'grade'			=> $studentgrade,
		),
	);

	$userKontrol = get_user_by( 'email', $email );
	
	if (empty($userKontrol)) {
		$sonuclar = wp_insert_user($userdata);
	}else{
		$sonuclar = "exist";
	}


	wp_send_json_success( $sonuclar);

	wp_die();

}



/* AJAX Crate User Bulk Callback */
add_action('wp_ajax_nopriv_my_ajax_create_users_bulk', 'my_ajax_create_users_bulk');
add_action('wp_ajax_my_ajax_create_users_bulk', 'my_ajax_create_users_bulk');

function my_ajax_create_users_bulk(){

	global $wpdb;
	$jsonData= array(
		'filename_error' 	=> '',
		'added_users'		=> array(),
	);
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$veri = $_REQUEST["veri"];
	//$jsonData = $veri[0][0];

	if ($veri[0][0] === "Name" && $veri[0][1] === "Surname" && $veri[0][2] === "TC" && $veri[0][3] === "Schoool No (Eyotek)" && $veri[0][4] === "Gender" && $veri[0][5] === "School Register Date" && $veri[0][6] === "Grade" && $veri[0][7] === "Birthday" && $veri[0][8] === "Email" && $veri[0][9] === "Password" && $veri[0][10] === "User Site" && $veri[0][11] === "User Role") {
		/*if excel file is correct*/
		foreach ($veri as $key => $value) {
			if ($key != 0) {
				$all_multi_sites = get_sites();

				$userKontrol = get_user_by( 'email', $value[8] );
				if (empty($userKontrol)) {
					$userdata = array(
						'user_pass' 	=> $value[9],
						'user_login' 	=> $value[8],
						'user_nicename' => $value[0],
						'user_email' 	=> $value[8],
						'last_name' 	=> $value[1],
						'first_name' 	=> $value[0],
						'role' 			=> $value[11],
						'meta_input' 	=> array(
							'tc' 			=> $value[2],
							'school_no'		=> $value[3],
							'gender'		=> $value[4],
							'register_date'	=> $value[5],
							'birthday'		=> $value[7],
							'grade'			=> $value[6],
						),
					);
					$sonuc = wp_insert_user($userdata);
					$jsonData['added_users'][$key] = "New User System Id = ".$sonuc;
					foreach ($all_multi_sites as $keys => $values) {
						if ($value[10] === $values->path) {
							add_user_to_blog($values->blog_id,$sonuc,$value[11]);
						}
					}
				}else{
					$jsonData['added_users'][$key] = 'Added to New Year';
					$sonuc = $userKontrol->ID;
					foreach ($all_multi_sites as $keys => $values) {
						if ($value[10] === $values->path) {
							add_user_to_blog($values->blog_id,$sonuc,$value[11]);
						}
					}
				}

				/*user site register*/


			}else{
				$jsonData['added_users'][$key] = 'Result';
			}


		}
		
	}else{
		$jsonData['filename_error'] = "degismis";
	}




	wp_send_json_success($jsonData);

	wp_die();

}


/* AJAX Update User Callback */
add_action('wp_ajax_nopriv_my_ajax_update_users_manuel', 'my_ajax_update_users_manuel');
add_action('wp_ajax_my_ajax_update_users_manuel', 'my_ajax_update_users_manuel');

function my_ajax_update_users_manuel(){

	global $wpdb;

	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$first_name = $_REQUEST["first_name"];
	$last_name = $_REQUEST["last_name"];
	$tc = $_REQUEST["tc"];
	$schoolno = $_REQUEST["schoolno"];
	$gender = $_REQUEST["gender"];
	$registerdate = $_REQUEST["registerdate"];
	$birthday = $_REQUEST["birthday"];
	$studentgrade = $_REQUEST["studentgrade"];
	$email = $_REQUEST["email"];
	$user_sites = $_REQUEST["user_sites"];
	$user_role = $_REQUEST["user_role"];
	$asc_time_table_id = $_REQUEST["asc_time_table_id"];
	$teacher_subject = $_REQUEST["teacher_subject"];


	$userKontrol = get_user_by( 'email', $email );
	$group_admin_id = $userKontrol->data->ID;

	if (!empty($userKontrol)) {
		$userdata = array(
			'ID'			=> $group_admin_id,
			'last_name' 	=> $last_name,
			'first_name' 	=> $first_name,
			'role' 			=> $user_role,
			'meta_input' 	=> array(
				'tc' 			=> $tc,
				'school_no'		=> $schoolno,
				'gender'		=> $gender,
				'register_date'	=> $registerdate,
				'birthday'		=> $birthday,
				'grade'			=> $studentgrade,
				'asc_time_table_id'			=> $asc_time_table_id,
			),
		);
		$sonuc = wp_update_user($userdata);


		update_user_meta($group_admin_id, 'subjects_' . $blog_id, $teacher_subject);
		update_user_meta($group_admin_id, 'asc_time_table_id_' . $blog_id, $asc_time_table_id);

		$all_multi_sites = get_sites();
		foreach ($all_multi_sites as $key => $value) {
			remove_user_from_blog($group_admin_id,$value->blog_id);
		}

		foreach ($user_sites as $key => $value) {
			foreach ($all_multi_sites as $keys => $values) {
				if ($value === $values->path) {
					add_user_to_blog($values->blog_id,$group_admin_id,$user_role);
				}
			}
		}


	}else{
		$sonuc = "hata";
	}






	wp_send_json_success($sonuc);

	wp_die();

}



/* AJAX Upload Course Callback */
add_action('wp_ajax_nopriv_my_ajax_upload_user_image', 'my_ajax_upload_user_image');
add_action('wp_ajax_my_ajax_upload_user_image', 'my_ajax_upload_user_image');

function my_ajax_upload_user_image(){

	global $wpdb;
	$sonuclar = '';

	$user_id = $_REQUEST['user_id'];

	if (isset($_FILES['user_image'])) {
		$image_url = $_FILES['user_image'];
		$uploaded_file = wp_handle_upload($image_url, array('test_form' => false));
		if (isset($uploaded_file['file'])) {
			update_field( 'user_image', $uploaded_file['url'], 'user_'.$user_id );
		}

	}


	wp_send_json_success( $uploaded_file['url']);

	wp_die();

} 



/* AJAX Upload Course Callback */
add_action('wp_ajax_nopriv_my_ajax_user_asc_change', 'my_ajax_user_asc_change');
add_action('wp_ajax_my_ajax_user_asc_change', 'my_ajax_user_asc_change');

function my_ajax_user_asc_change(){

	global $wpdb;
	$sonuclar = '';

	$user_system_id = $_REQUEST['user_system_id'];
	$user_asc_id = $_REQUEST['user_asc_id'];

	if (!empty($user_asc_id)) {
		$sonuclar = update_field( 'asc_time_table_id', $user_asc_id, 'user_'.$user_system_id );		
	}else{
		$sonuclar = "problem";
	}


	wp_send_json_success( $uploaded_file['url']);

	wp_die();

} 