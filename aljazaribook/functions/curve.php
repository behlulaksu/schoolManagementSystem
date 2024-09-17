<?php 

/* AJAX Curve Callback */
add_action('wp_ajax_nopriv_my_ajax_curve', 'my_ajax_curve');
add_action('wp_ajax_my_ajax_curve', 'my_ajax_curve');

function my_ajax_curve(){
	global $wpdb;

	$sonuclar = '';


	$highest_mark = $_REQUEST["input_value_max"];
	$curve = $_REQUEST["curve"];
	$class_id = $_REQUEST["group"];
	$subjecet_id = $_REQUEST["subject"];
	$quarter_id = $_REQUEST["quarter_id"];
	$blog_id = get_current_blog_id();

	$bg_table_name = "curve_base";


	$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and quarter_id =".$quarter_id." and class_id =".$class_id." and subjecet_id =".$subjecet_id."" );
	$sonuclar1 = $wpdb->get_results($query);


	if (empty($sonuclar1)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'blog_id' => $blog_id,
				'class_id' => $class_id,
				'subjecet_id' => $subjecet_id,
				'quarter_id' => $quarter_id,
				'curve_point' => $curve,
				'highest_mark' => $highest_mark,
			))
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}else{
		$wpdb->update( 'curve_base', 
			array( 
				'curve_point' => $curve,
				'highest_mark' => $highest_mark,
			), 
			array( 'id' => $sonuclar1[0]->id )
		);
		$sonuclar = "tamam";
	}



	wp_send_json_success( $sonuclar);

	wp_die();


}



/* AJAX Subject Grade Avarage Save Callback */
add_action('wp_ajax_nopriv_my_class_avarage', 'my_class_avarage');
add_action('wp_ajax_my_class_avarage', 'my_class_avarage');

function my_class_avarage(){
	global $wpdb;
	$sonuclar = '';


	$students = $_REQUEST["students_subject"];
	$class_avarage = $_REQUEST["class_avarage"];
	$class_curve = $_REQUEST["class_curve"];
	$group = $_REQUEST["group"];
	$subject = $_REQUEST["subject"];
	$quarter_id = $_REQUEST["quarter_id"];

	$class_avarage_total = $_REQUEST["class_avarage_total"];
	$class_curve_total = $_REQUEST["class_curve_total"];

	$blog_id = get_current_blog_id();


	$bg_table_name = "student_avarages";
	foreach ($students as $key => $value) {
		$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$subject." and quarter_id =".$quarter_id." and student_id =".$value."" );
		$sonuclar1 = $wpdb->get_results($query);
		if (empty($sonuclar1)) {
			if(
				$wpdb->insert($bg_table_name, array(
					'bloog_id' => $blog_id,
					'group_id' => $group,
					'subjecet_id' => $subject,
					'quarter_id' => $quarter_id,
					'student_id' => $value,
					'student_avarage' => $class_avarage[$key],
					'stundent_curve' => $class_curve[$key],
				))
			){
				$sonuclar="tamam";
			}else{
				$sonuclar="problem";
			}
		}else{
			$wpdb->update( 'student_avarages', 
				array( 
					'student_avarage' => $class_avarage[$key],
					'stundent_curve' => $class_curve[$key],
				), 
				array( 'id' => $sonuclar1[0]->id )
			);
			$sonuclar = "tamam";
		}
	}

	/************************************************************************/

	$bg_table_name = "quarter_avarage";
	$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$subject." and quarter_id =".$quarter_id."" );
	$sonuclar1 = $wpdb->get_results($query);
	if (empty($sonuclar1)) {
		if(
			$wpdb->insert($bg_table_name, array(
				'bloog_id' => $blog_id,
				'group_id' => $group,
				'subjecet_id' => $subject,
				'quarter_id' => $quarter_id,
				'class_avarage' => $class_avarage_total,
				'class_curve' => $class_curve_total,
			))
		){
			$sonuclar="tamam";
		}else{
			$sonuclar="problem";
		}
	}else{
		$wpdb->update( 'quarter_avarage', 
			array( 
				'class_avarage' => $class_avarage_total,
				'class_curve' => $class_curve_total,
			), 
			array( 'id' => $sonuclar1[0]->id )
		);
		$sonuclar = "tamam";
	}



	wp_send_json_success( $sonuclar);

	wp_die();


}



/* AJAX Subject Base Avarage Save Callback */
add_action('wp_ajax_nopriv_my_subject_avarage', 'my_subject_avarage');
add_action('wp_ajax_my_subject_avarage', 'my_subject_avarage');

function my_subject_avarage(){
	global $wpdb;
	$sonuclar = '';


	$students_grades = $_REQUEST["students_grades"];
	$students = $_REQUEST["students_subject"];
	$class_avarage = $_REQUEST["class_avarage"];
	$class_curve = $_REQUEST["class_curve"];
	$subject = $_REQUEST["subject"];
	$quarter_id = $_REQUEST["quarter_id"];

	$class_avarage_total = $_REQUEST["class_avarage_total"];
	$class_curve_total = $_REQUEST["class_curve_total"];

	$blog_id = get_current_blog_id();


	$bg_table_name = "student_avarages";
	foreach ($students as $key => $value) {
		$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$students_grades[$key]." and subjecet_id =".$subject." and quarter_id =".$quarter_id." and student_id =".$value."" );
		$sonuclar1 = $wpdb->get_results($query);
		if (empty($sonuclar1)) {
			if(
				$wpdb->insert($bg_table_name, array(
					'bloog_id' => $blog_id,
					'group_id' => $students_grades[$key],
					'subjecet_id' => $subject,
					'quarter_id' => $quarter_id,
					'student_id' => $value,
					'student_avarage' => $class_avarage[$key],
					'stundent_curve' => $class_curve[$key],
				))
			){
				$sonuclar="tamam";
			}else{
				$sonuclar="problem";
			}
		}else{
			$wpdb->update( 'student_avarages', 
				array( 
					'student_avarage' => $class_avarage[$key],
					'stundent_curve' => $class_curve[$key],
				), 
				array( 'id' => $sonuclar1[0]->id )
			);
			$sonuclar = "tamam";
		}
	}

	/************************************************************************/

	// $bg_table_name = "quarter_avarage";
	// foreach ($students as $key => $value) {
	// 	$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$subject." and quarter_id =".$quarter_id."" );
	// 	$sonuclar1 = $wpdb->get_results($query);
	// 	if (empty($sonuclar1)) {
	// 		if(
	// 			$wpdb->insert($bg_table_name, array(
	// 				'bloog_id' => $blog_id,
	// 				'group_id' => $group,
	// 				'subjecet_id' => $subject,
	// 				'quarter_id' => $quarter_id,
	// 				'class_avarage' => $class_avarage_total,
	// 				'class_curve' => $class_curve_total,
	// 			))
	// 		){
	// 			$sonuclar="tamam";
	// 		}else{
	// 			$sonuclar="problem";
	// 		}
	// 	}else{
	// 		$wpdb->update( 'quarter_avarage', 
	// 			array( 
	// 				'class_avarage' => $class_avarage_total,
	// 				'class_curve' => $class_curve_total,
	// 			), 
	// 			array( 'id' => $sonuclar1[0]->id )
	// 		);
	// 		$sonuclar = "tamam";
	// 	}
	// }



	wp_send_json_success( $sonuclar);

	wp_die();


}
