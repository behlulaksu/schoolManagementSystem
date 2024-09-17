<?php 

/* AJAX New Objective Callback */
add_action('wp_ajax_nopriv_my_ajax_add_new_objective', 'my_ajax_add_new_objective');
add_action('wp_ajax_my_ajax_add_new_objective', 'my_ajax_add_new_objective');

function my_ajax_add_new_objective(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();


	$object_title = $_REQUEST["object_title"];
	$object_code = $_REQUEST["object_code"];
	$object_code_2 = $_REQUEST["object_code_2"];
	$select_grade = $_REQUEST["select_grade"];
	$select_subject = $_REQUEST["select_subject"];
	$object_content = $_REQUEST["object_content"];
	$object_curricullum = $_REQUEST["object_curricullum"];
	$object_skill = $_REQUEST["object_skill"];

	$bg_table_name = "objectives_define";
	$wpdb->insert($bg_table_name, array(
		'add_campus' => $blog_id,
		'code1' => $object_code,
		'code2' => $object_code_2,
		'objecttive_title' => $object_title,
		'object_curricullum' => $object_curricullum,
		'object_skill' => $object_skill,
		'objecttive_content' => $object_content,
		'add_campus' => $blog_id,
		'grade' => $select_grade,
		'subject' => $select_subject,
		'creator_id' => $current_user,
		'create_time' => $new_time,
		'create_date' => $registerdate,
		'creator_ip' => $ip,
		'last_editor_id' => $current_user,
		'edit_time' => $new_time,
		'edit_date' => $registerdate,
		'editor_ip' => $ip,
	));


	wp_send_json_success( $wpdb);

	wp_die();


}



/* AJAX New Objective Callback */
add_action('wp_ajax_nopriv_my_ajax_edit_objective', 'my_ajax_edit_objective');
add_action('wp_ajax_my_ajax_edit_objective', 'my_ajax_edit_objective');

function my_ajax_edit_objective(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();


	$object_title = $_REQUEST["object_title"];
	$select_grade = $_REQUEST["select_grade"];
	$select_subject = $_REQUEST["select_subject"];
	$object_content = $_REQUEST["object_content"];
	$object_curricullum = $_REQUEST["object_curricullum"];
	$object_skill = $_REQUEST["object_skill"];
	$object_id = $_REQUEST["object_id"];


	/*log alma alani baslangic*/
	$bg_table_name = "objectives_define";
	$query = $wpdb->prepare("SELECT * from $bg_table_name where id=".$object_id);
	$sonuclar1 = $wpdb->get_results($query)[0];

	$bg_table_name_log = "objectives_logs";
	$wpdb->insert($bg_table_name_log, array(
		'obj_id' => $object_id,
		'objecttive_title' => $sonuclar1->objecttive_title,
		'object_curricullum' => $sonuclar1->object_curricullum,
		'object_skill' => $sonuclar1->object_skill,
		'objecttive_content' => $sonuclar1->objecttive_content,
		'grade' => $sonuclar1->grade,
		'subject' => $sonuclar1->subject,
		'user_id' => $sonuclar1->last_editor_id,
		'user_ip' => $sonuclar1->editor_ip,
		'date' => $sonuclar1->edit_date,
		'time' => $sonuclar1->edit_time,
	));
	// log alama alani bitis




	$bg_table_name = "objectives_define";

	$data = array(
		'objecttive_title' => $object_title,
		'object_curricullum' => $object_curricullum,
		'object_skill' => $object_skill,
		'objecttive_content' => $object_content,
		'grade' => $select_grade,
		'subject' => $select_subject,
		'last_editor_id' => $current_user,
		'edit_time' => $new_time,
		'edit_date' => $registerdate,
		'editor_ip' => $ip,
	);

	$where = array(
		'id' => $object_id,
	);
	$wpdb->update($bg_table_name, $data, $where);

	wp_send_json_success( $wpdb);

	wp_die();


}




/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_upload_objectives', 'my_ajax_upload_objectives');
add_action('wp_ajax_my_ajax_upload_objectives', 'my_ajax_upload_objectives');

function my_ajax_upload_objectives(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$tableData = $_REQUEST["tableData"];

	$bg_table_name = "objectives_define";


	foreach ($tableData as $key => $value) {
		$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE code2 = %s", $value[3]);
		$sonuclar1= $wpdb->get_results($query);

		if (empty($sonuclar1)) {
			if ($key != 0) {
				$wpdb->insert($bg_table_name, array(
					'add_campus' => $blog_id,
					'code1' => $value[0],
					'code2' => $value[3],
					'objecttive_title' => "--",
					'object_curricullum' => $value[4],
					'object_skill' => $value[2],
					'objecttive_content' => esc_html($value[1]),
					'add_campus' => $blog_id,
					'grade' => $value[5],
					'subject' => $value[6],
					'object_order' => $value[8],
					'creator_id' => $current_user,
					'create_time' => $new_time,
					'create_date' => $registerdate,
					'creator_ip' => $ip,
					'last_editor_id' => $current_user,
					'edit_time' => $new_time,
					'edit_date' => $registerdate,
					'editor_ip' => $ip,
				));
			}
		}

	}




	wp_send_json_success($sonuclar);

	wp_die();


}

/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_objectives', 'my_ajax_get_objectives');
add_action('wp_ajax_my_ajax_get_objectives', 'my_ajax_get_objectives');

function my_ajax_get_objectives(){
	global $wpdb;
	$sonuclar = "";

	$grade = $_REQUEST["grade"];
	$subject = $_REQUEST["subject"];

	$bg_table_name = "objectives_define";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE grade = %s AND subject = %s", $grade, $subject);
	$sonuclar = $wpdb->get_results($query);


	wp_send_json_success($sonuclar);

	wp_die();


}





/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_new_lesson', 'my_ajax_new_lesson');
add_action('wp_ajax_my_ajax_new_lesson', 'my_ajax_new_lesson');

function my_ajax_new_lesson(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');

	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();


	$lesson_title = $_REQUEST["lesson_title"];
	$lesson_unite = $_REQUEST["lesson_unite"];
	$lesson_chapter = $_REQUEST["lesson_chapter"];
	$lesson_grade = $_REQUEST["lesson_grade"];
	$lesson_subject = $_REQUEST["lesson_subject"];
	$objectives_list = $_REQUEST["objectives_list"];
	$objectives_list_string = implode(',',$objectives_list);

	$select_perion = $_REQUEST["select_perion"];
	$semester = $_REQUEST["semester"];
	$class_id = $_REQUEST["class_id"];
	$subject_id = $_REQUEST["subject_id"];
	$new_lesson_order = $_REQUEST["new_lesson_order"];


	$bg_table_name = "curriculum_breakdown";
	$wpdb->insert($bg_table_name, array(
		'campus_id' => $blog_id,
		'semester' => $semester,
		'class_id' => $class_id,
		'subject_id' => $subject_id,
		'object_save' => $objectives_list_string,
		'periods' => $select_perion,
		'lesson_title' => $lesson_title,
		'unit' => $lesson_unite,
		'chapter' => $lesson_chapter,
		'lesson_grade' => $lesson_grade,
		'lesson_subject' => $lesson_subject,
		'lesson_order' => $new_lesson_order,
		'last_editor_id' => $current_user,
		'last_editor_ip' => $ip,
		'date' => $registerdate,
		'time' => $new_time,
	));


	wp_send_json_success($objectives_list_string);

	wp_die();


}



/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_lesson_details', 'my_ajax_get_lesson_details');
add_action('wp_ajax_my_ajax_get_lesson_details', 'my_ajax_get_lesson_details');

function my_ajax_get_lesson_details(){
	global $wpdb;
	$sonuclar = "";
	$deger = [];

	$lesson_id = $_REQUEST["lesson_id"];

	$bg_table_name = "curriculum_breakdown";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE id = %s", $lesson_id);
	$sonuclar = $wpdb->get_results($query)[0];

	$user_display_name = get_userdata($sonuclar->last_editor_id)->display_name;

	$deger[] = [
		"chapter" => $sonuclar->chapter,
		"date" => $sonuclar->date,
		"finished" => $sonuclar->finished,
		"lesson_order" => $sonuclar->lesson_order,
		"lesson_title" => $sonuclar->lesson_title,
		"periods" => $sonuclar->periods,
		"unit" => $sonuclar->unit,
		"lsat_editor" => $user_display_name,
		"time" => $sonuclar->time,
		"semester" => $sonuclar->semester,
		"id" => $sonuclar->id,
	];


	wp_send_json_success($deger);

	wp_die();


}



/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_update_lesson', 'my_ajax_get_update_lesson');
add_action('wp_ajax_my_ajax_get_update_lesson', 'my_ajax_get_update_lesson');

function my_ajax_get_update_lesson(){
	global $wpdb;
	$sonuclar = "";

	$sonuclar = '';
	$registerdate = date('d/m/Y l');

	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();


	$lesson_id = $_REQUEST["lesson_id"];
	$unit = $_REQUEST["lesson_detail_unite"];
	$periods = $_REQUEST["select_detail_perion"];
	$chapter = $_REQUEST["details_lesson_chapter"];
	$lesson_title = $_REQUEST["details_lesson_title"];


	$bg_table_name = "curriculum_breakdown";

	$data = array(
		'lesson_title' => $lesson_title,
		'unit' => $unit,
		'chapter' => $chapter,
		'periods' => $periods,
		'last_editor_id' => $current_user,
		'last_editor_ip' => $ip,
		'date' => $registerdate,
		'time' => $new_time,
	);

	$where = array(
		'id' => $lesson_id,
	);
	$wpdb->update($bg_table_name, $data, $where);

	wp_send_json_success($sonuclar);

	wp_die();


}




/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_activities_details', 'my_ajax_get_activities_details');
add_action('wp_ajax_my_ajax_get_activities_details', 'my_ajax_get_activities_details');

function my_ajax_get_activities_details(){
	global $wpdb;
	$sonuclar = "";
	$deger = [];

	$lesson_id = $_REQUEST["lesson_id"];

	$bg_table_name = "curriculum_breakdown";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE id = %s", $lesson_id);
	$curriculum_breakdown = $wpdb->get_results($query)[0];


	$bg_table_name = "lesson_activities";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE lesson_id = %s", $lesson_id);
	$sonuclar = $wpdb->get_results($query);


	$deger[0][] = [
		"periods" => $curriculum_breakdown->periods,
		"lesson_id" => $curriculum_breakdown->id,
		"lesson_title" => $curriculum_breakdown->lesson_title,
		"lesson_semester" => $curriculum_breakdown->semester,
		"lesson_objective_id" => $curriculum_breakdown->object_save,
	];

	$deger[1][] = $sonuclar;


	wp_send_json_success($deger);

	wp_die();


}





/* AJAX New Objective Callback */
add_action('wp_ajax_nopriv_my_ajax_update_activities_text', 'my_ajax_update_activities_text');
add_action('wp_ajax_my_ajax_update_activities_text', 'my_ajax_update_activities_text');

function my_ajax_update_activities_text(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();


	$lesson_class = $_REQUEST["lesson_class"];
	$lesson_subject = $_REQUEST["lesson_subject"];
	$lesson_semester = $_REQUEST["lesson_semester"];
	$lesson_id = $_REQUEST["lesson_id"];
	$lesson_objective_id = $_REQUEST["lesson_objective_id"];


	// var olanlari getirme alani baslangic
	$bg_table_name = "lesson_activities";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE lesson_id = %s", $lesson_id);
	$lesson_activities = $wpdb->get_results($query);
	// var olanlari getirme alani son

	$class_activities_textarea_array = $_REQUEST["class_activities_textarea_array"];

	foreach ($class_activities_textarea_array as $key => $value) {
		if ($lesson_activities[$key]->lesson_text === "" || empty($lesson_activities[$key]) ) {
			$wpdb->insert($bg_table_name, array(
				'lesson_id' => $lesson_id,
				'campus' => $blog_id,
				'semester' => $lesson_semester,
				'lesson_class' => $lesson_class,
				'lesson_subject' => $lesson_subject,
				'object_save' => $lesson_objective_id,
				'lesson_text' => $value,
				'user_id' => $current_user,
				'date' => $registerdate,
				'time' => $new_time,
				'ip' => $ip,
			));
		}else{
			/**/
			$data = array(
				'lesson_text' => $class_activities_textarea_array[$key],
				'user_id' => $current_user,
				'date' => $registerdate,
				'time' => $new_time,
				'ip' => $ip,
			);

			$where = array(
				'id' => $lesson_activities[$key]->id,
			);
			$wpdb->update($bg_table_name, $data, $where);
			/**/
		}
	}




	wp_send_json_success($class_activities_textarea_array);

	wp_die();


}






/* AJAX New Objective Callback */
add_action('wp_ajax_nopriv_my_ajax_update_resources_text', 'my_ajax_update_resources_text');
add_action('wp_ajax_my_ajax_update_resources_text', 'my_ajax_update_resources_text');

function my_ajax_update_resources_text(){
	global $wpdb;

	$sonuclar = '';
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();


	$lesson_id = $_REQUEST["lesson_id"];
	$semester = $_REQUEST["semester"];
	$lesson_class = $_REQUEST["lesson_class"];
	$lesson_subject = $_REQUEST["lesson_subject"];
	$resources_objective_id = $_REQUEST["resources_objective_id"];

	$resoruces_type_array = $_REQUEST["resoruces_type_array"];
	$class_resources_textarea_array = $_REQUEST["class_resources_textarea_array"];
	$resources_id_array = $_REQUEST["resources_id_array"];


	$bg_table_name = "lesson_resources";
	foreach ($class_resources_textarea_array as $key => $value) {
		if ($resources_id_array[$key] === "aaa") {
			// yeni eklenen degerler burda
			$wpdb->insert($bg_table_name, array(
				'lesson_id' => $lesson_id,
				'campus' => $blog_id,
				'semester' => $semester,
				'lesson_class' => $lesson_class,
				'lesson_subject' => $lesson_subject,
				'object_save' => $resources_objective_id,
				'resources_text' => $class_resources_textarea_array[$key],
				'resource_type' => $resoruces_type_array[$key],

				'user_id' => $current_user,
				'date' => $registerdate,
				'time' => $new_time,
				'ip' => $ip,
			));
		}else{
			$data = array(
				'resources_text' => $class_resources_textarea_array[$key],
				'resource_type' => $resoruces_type_array[$key],

				'user_id' => $current_user,
				'date' => $registerdate,
				'time' => $new_time,
				'ip' => $ip,
			);

			$where = array(
				'id' => $resources_id_array[$key],
			);
			$wpdb->update($bg_table_name, $data, $where);
		}

	}




	wp_send_json_success($sonuclar);

	wp_die();


}



/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_resources_details', 'my_ajax_get_resources_details');
add_action('wp_ajax_my_ajax_get_resources_details', 'my_ajax_get_resources_details');

function my_ajax_get_resources_details(){
	global $wpdb;
	$sonuclar = "";
	$deger = [];

	$lesson_id = $_REQUEST["lesson_id"];

	$bg_table_name = "curriculum_breakdown";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE id = %s", $lesson_id);
	$curriculum_breakdown = $wpdb->get_results($query)[0];


	$bg_table_name = "lesson_resources";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE lesson_id = %s", $lesson_id);
	$sonuclar = $wpdb->get_results($query);


	$deger[0][] = [
		"periods" => $curriculum_breakdown->periods,
		"lesson_id" => $curriculum_breakdown->id,
		"lesson_title" => $curriculum_breakdown->lesson_title,
		"lesson_semester" => $curriculum_breakdown->semester,
		"lesson_objective_id" => $curriculum_breakdown->object_save,
	];

	$deger[1][] = $sonuclar;


	wp_send_json_success($deger);

	wp_die();


}




/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_delete_resources', 'my_ajax_delete_resources');
add_action('wp_ajax_my_ajax_delete_resources', 'my_ajax_delete_resources');

function my_ajax_delete_resources(){
	global $wpdb;
	$sonuclar = "";
	$deger = [];

	$toDeleteResource = $_REQUEST["toDeleteResource"];
	$table_name = 'lesson_resources';
	$sonuclar = $wpdb->delete(
		$table_name,
		array('id' => $toDeleteResource)
	);

	wp_send_json_success($sonuclar);

	wp_die();


}



/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_get_lesson_objective', 'my_ajax_get_lesson_objective');
add_action('wp_ajax_my_ajax_get_lesson_objective', 'my_ajax_get_lesson_objective');

function my_ajax_get_lesson_objective(){
	global $wpdb;
	$sonuclar = "";
	$deger = [];

	$lesson_id = $_REQUEST["lesson_id"];

	$bg_table_name = "curriculum_breakdown";
	$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE id = %s", $lesson_id);
	$objective_id = $wpdb->get_results($query)[0]->object_save;

	$objective_id_array = $array = explode(',', $objective_id);

	$bg_table_name = "objectives_define";
	foreach ($objective_id_array as $key => $value) {
		$query = $wpdb->prepare("SELECT * FROM $bg_table_name WHERE id = %s", $value);
		$deger[$key] = $wpdb->get_results($query)[0];
	}








	wp_send_json_success($deger);

	wp_die();


}




/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_lesson_done', 'my_ajax_lesson_done');
add_action('wp_ajax_my_ajax_lesson_done', 'my_ajax_lesson_done');

function my_ajax_lesson_done(){
	global $wpdb;
	$sonuclar = "";
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$lesson_id = $_REQUEST["lesson_id"];
	$bg_table_name = 'curriculum_breakdown';


	$data = array(
		'finished' => 1,

		'last_editor_id' => $current_user,
		'date' => $registerdate,
		'time' => $new_time,
		'last_editor_ip' => $ip,
	);

	$where = array(
		'id' => $lesson_id,
	);
	$sonuclar = $wpdb->update($bg_table_name, $data, $where);


	wp_send_json_success($sonuclar);

	wp_die();


}




/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_new_lesson_order', 'my_ajax_new_lesson_order');
add_action('wp_ajax_my_ajax_new_lesson_order', 'my_ajax_new_lesson_order');

function my_ajax_new_lesson_order(){
	global $wpdb;
	$sonuclar = "";
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');

	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$listByOrder = $_REQUEST["listByOrder"];
	$bg_table_name = 'curriculum_breakdown';

	foreach ($listByOrder as $key => $value) {
		$data = array(
			'lesson_order' => $key,
			'last_editor_id' => $current_user,
			'date' => $registerdate,
			'time' => $new_time,
			'last_editor_ip' => $ip,
		);

		$where = array(
			'id' => $value,
		);
		$sonuclar = $wpdb->update($bg_table_name, $data, $where);
	}





	wp_send_json_success($sonuclar);

	wp_die();


}


/* AJAX Upload Objectives Callback */
add_action('wp_ajax_nopriv_my_ajax_new_delete_lesson', 'my_ajax_new_delete_lesson');
add_action('wp_ajax_my_ajax_new_delete_lesson', 'my_ajax_new_delete_lesson');

function my_ajax_new_delete_lesson(){
	global $wpdb;
	$sonuclar = "";
	$registerdate = date('d/m/Y l');
	
	$current_time = date('G:i:s');
	$datetime = new DateTime($current_time);
	$datetime->modify('+3 hours');
	$new_time = $datetime->format('G:i:s');


	$delete_lesson_id = $_REQUEST["delete_lesson_id"];


	$table_name = 'curriculum_breakdown';
	$sonuclar = $wpdb->delete(
		$table_name,
		array('id' => $delete_lesson_id)
	);




	wp_send_json_success($sonuclar);

	wp_die();


}