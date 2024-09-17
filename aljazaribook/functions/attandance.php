<?php 
/* AJAX Set Class PDP Selectable Settings Callback */
add_action('wp_ajax_nopriv_my_ajax_student_attandance', 'my_ajax_student_attandance');
add_action('wp_ajax_my_ajax_student_attandance', 'my_ajax_student_attandance');

function my_ajax_student_attandance(){
	global $wpdb;

	$sonuclar = 'problem';
	$registerdate = date('d/m/Y l');
	$registertime = date('G:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$current_user = get_current_user_id();
	$blog_id = get_current_blog_id();

	$class_id = $_POST["class_id"];
	$attandance_quarter = $_POST["attandance_quarter"];
	$student_list_class = $_POST["student_list_class"];

	$absent_student_array = $_POST["absent_student_array"];
	$late_student_array = $_POST["late_student_array"];
	$permitted_array = $_POST["permitted_array"];


	foreach ($student_list_class as $key => $value) {
		$attandence = get_attandance($class_id, $attandance_quarter, $value);
		$table_name = "student_attandance";
		if (empty($attandence)) {
			if(
				$wpdb->insert($table_name, array(
					'bloog_id' => $blog_id,
					'class_id' => $class_id,
					'quarter_id' => $attandance_quarter,
					'student_id' => $value,
					'teacher_id' => $current_user,
					'absent' => $absent_student_array[$key],
					'late' => $late_student_array[$key],
					'permitted' => $permitted_array[$key],
					'date' => $registerdate,
					'time' => $registertime,
					'ip' => $ip,

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
						'absent' => $absent_student_array[$key],
						'late' => $late_student_array[$key],
						'permitted' => $permitted_array[$key],
						'date' => $registerdate,
						'time' => $registertime,
						'ip' => $ip,
					), 
					array( 'id' => $attandence[0]->id )
				)
			) {
				$sonuclar="tamam";
			}
		}

	}



	wp_send_json_success($sonuclar);

	wp_die();

}



if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'  => 'ASC',
		'menu_title'  => 'ASC',
		'menu_slug'   => 'asc-settings',
		'capability'  => 'manage_options',
		'icon_url'    => 'dashicons-calendar-alt',
		'redirect'    => false
	));
}

