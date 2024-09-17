<?php 

add_action('wp_ajax_nopriv_my_ajax_upload_file', 'my_ajax_upload_file');
add_action('wp_ajax_my_ajax_upload_file', 'my_ajax_upload_file');

function my_ajax_upload_file(){
	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$call_back_final = [];


	$pdf_name = $_REQUEST["pdf_name"];
	$class_id = $_REQUEST["class_id"];
	$subject_id = $_REQUEST["subject_id"];
	$quarter_id = $_REQUEST["quarter_id"];
	$file_type = $_REQUEST["file_type"];

	if (isset($_FILES['pdf_file'])) {
		$file = $_FILES['pdf_file'];
		$uploaded_file = wp_handle_upload($file, array('test_form' => false));

		if (isset($uploaded_file['file'])) {

			$wpdb->insert("book_files_information", array(
				'campus_id' => get_current_blog_id(),
				'class_id' => $class_id,
				'subjecet_id' => $subject_id,
				'user_id' => $current_user,
				'file_name' => $pdf_name,
				'file_path' => $uploaded_file['url'],
				'file_active' => 1,
				'quarter_id' => $quarter_id,
				'file_type' => $file_type,

				'ip' => $ip,
				'time' => $registertime,
				'date' => $registerdate,
			));
			$call_back_final = array(
				"file_name" => $pdf_name,
				"date"		=> $registerdate,
				"link"		=> $uploaded_file['url']
			);

			$sonuclar = $call_back_final;
		} else {
			$sonuclar = "error";
		}
	} else {
		$sonuclar = "error";
	}


	wp_send_json_success( $sonuclar);
	wp_die();


}



add_action('wp_ajax_nopriv_my_ajax_delete_file', 'my_ajax_delete_file');
add_action('wp_ajax_my_ajax_delete_file', 'my_ajax_delete_file');

function my_ajax_delete_file(){
	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$silinecek_file = $_REQUEST["silinecek_file"];

	$wpdb->update( "book_files_information", 
		array( 
			'file_active' => 0,
		), 
		array( 'id' => $silinecek_file )
	);


	wp_send_json_success( $wpdb);
	wp_die();


}



add_action('wp_ajax_nopriv_my_ajax_ready_print', 'my_ajax_ready_print');
add_action('wp_ajax_my_ajax_ready_print', 'my_ajax_ready_print');

function my_ajax_ready_print(){
	global $wpdb;
	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$file_id = $_REQUEST["file_id"];

	$wpdb->update( "book_files_information", 
		array( 
			'ready_print' => 1,
		), 
		array( 'id' => $file_id )
	);


	wp_send_json_success( $wpdb);
	wp_die();


}