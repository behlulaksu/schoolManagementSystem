<?php 


add_action('wp_insert_site', function($site) {/*yeni site eklerken arada yapilmasi gereken islemler*/
	create_table();
});



function create_table() {
	global $wpdb;

	$variable = get_sites();
	foreach ($variable as $key => $value) {
		$table_name = $wpdb->prefix .$value->blog_id.'_'.'gradebook';

		$query = $wpdb->prepare( 'SHOW TABLES LIKE', $wpdb->esc_like( $table_name ) );

		if ( ! $wpdb->get_var( $query ) == $table_name ) {

			$sql = "CREATE TABLE " . $table_name . " (
				gb_id INT(11) NOT NULL AUTO_INCREMENT,
				gb_student_id VARCHAR(255) NOT NULL,
				gb_group_id VARCHAR(255) NOT NULL,
				gb_subject_id VARCHAR(255) NOT NULL,
				gb_quarter_id VARCHAR(255) NOT NULL,
				gb_gradebook_id VARCHAR(255) NOT NULL,
				gb_domain_id VARCHAR(255) NOT NULL,
				gb_subdomain_id VARCHAR(255) NOT NULL,
				gb_teacher_ip VARCHAR(255) NOT NULL,
				gb_teacher_id VARCHAR(255) NOT NULL,
				gb_update_time VARCHAR(255) NOT NULL,
				gb_update_date VARCHAR(255) NOT NULL,
				gb_point VARCHAR(255) NOT NULL,
				PRIMARY KEY  (gb_id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

				//add_option( EmailLog::DB_OPTION_NAME, EmailLog::DB_VERSION );
		}
	}


	foreach ($variable as $key => $value) {
		$table_name = $wpdb->prefix .$value->blog_id.'_'.'object_asset';

		$query = $wpdb->prepare( 'SHOW TABLES LIKE', $wpdb->esc_like( $table_name ) );

		if ( ! $wpdb->get_var( $query ) == $table_name ) {

			$sql = "CREATE TABLE " . $table_name . " (
				gb_id INT(11) NOT NULL AUTO_INCREMENT,
				lesson_id INT(10) NOT NULL,
				gb_student_id VARCHAR(255) NOT NULL,
				gb_group_id VARCHAR(255) NOT NULL,
				gb_subject_id VARCHAR(255) NOT NULL,
				gb_teacher_ip VARCHAR(255) NOT NULL,
				gb_teacher_id VARCHAR(255) NOT NULL,
				gb_update_time VARCHAR(255) NOT NULL,
				gb_update_date VARCHAR(255) NOT NULL,
				gb_point VARCHAR(255) NOT NULL,
				PRIMARY KEY  (gb_id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

				//add_option( EmailLog::DB_OPTION_NAME, EmailLog::DB_VERSION );
		}
	}



}






//create_pages();



function create_pages(){


$variable = get_sites();
foreach ($variable as $key => $value) {

	switch_to_blog($value->blog_id);

	/* Gradebook Definitions Edit */
	$posttitle = 'Gradebook Definitions Edit';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Gradebook Definitions Edit',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/gradebook-definitions-edit.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* All Gradebook Definitions */
	$posttitle = 'All Gradebook Definitions';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Gradebook Definitions',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/gradebook-definitions-all.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Edit Subject */
	$posttitle = 'Edit Subject';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit Subject',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/edit-subject.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Edit Groups */
	$posttitle = 'Edit Groups';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit Groups',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/edit-groups.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* All Groups */
	$posttitle = 'All Groups';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Groups',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/all-groups.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Sub Classes */
	$posttitle = 'Sub Classes';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Sub Classes',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/sub-classes.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Create Group */
	$posttitle = 'Create Group';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Create Group',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/create-group.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Edit User */
	$posttitle = 'Edit User';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit User',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/edit-user.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Upload Users Bulk */
	$posttitle = 'Upload Users Bulk';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Upload Users Bulk',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/upload-user-bulk.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Create User */
	$posttitle = 'Create User';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Create User',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/create-user.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* All Users */
	$posttitle = 'All Users';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Users',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/all-users.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* User Profile */
	$posttitle = 'User Profile';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'User Profile',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/user-profile.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Dashboard */
	$posttitle = 'Dashboard';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Dashboard',
			'post_type'     => 'page',
			'post_status'   => 'publish',

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Lessons */
	$posttitle = 'Lessons';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Lessons',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/all-subjects.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Create Gradebook */
	$posttitle = 'Create Gradebook';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Create Gradebook',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/create-gradebook.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Student Sheets List */
	$posttitle = 'Student Sheets List';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Sheets List',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/student-sheets-list.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* All Students */
	$posttitle = 'All Students';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Students',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/all-students.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* All Staff */
	$posttitle = 'All Staff';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Staff',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/all-staff.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Point All Students */
	$posttitle = 'Point All Students';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Point All Students',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/point-all-student.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Student All Points */
	$posttitle = 'Student All Points';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student All Points',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/student-all-points.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}



	/* Authorizations */
	$posttitle = 'Authorizations';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Authorizations',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'authorizations/authorizations-list.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Authorization Who */
	$posttitle = 'Authorization Who';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Authorization Who',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'authorizations/authorizationswho.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Authorizations Edit*/
	$posttitle = 'Authorizations Edit';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Authorizations Edit',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'authorizations/authorizations-edit.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/********************** For Teachers ****************************/
	/* My Subjects */
	$posttitle = 'My Subjects';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'My Subjects',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'teacher/my-subjects.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Gradebook */
	$posttitle = 'Gradebook';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Gradebook',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'teacher/gradebook.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Report Card */
	$posttitle = 'Report Card';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Report Card',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student/repord-card.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Report Card */
	$posttitle = 'Subject Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Subject Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/subject-report.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Student Detail Report */
	$posttitle = 'Student Detail Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Detail Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/student-detail-report.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Curve Settings */
	$posttitle = 'Curve Settings';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Curve Settings',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/curve-settings.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Yearly Report */
	$posttitle = 'Yearly Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Yearly Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/yearly-report.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Campus Settings */
	$posttitle = 'Campus Settings';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Campus Settings',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'authorizations/campus-settings.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* PDP Settings */
	$posttitle = 'PDP Settings';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'PDP Settings',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'authorizations/pdp-settings.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Class All Marks */
	$posttitle = 'Class All Marks';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class All Marks',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/class-all-marks.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Semester 1 Report Card 2 */
	$posttitle = 'Semester 1 Report Card 2';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Semester 1 Report Card 2',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student/semester-1-report2.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Semester 1 Report KG */
	$posttitle = 'Semester 1 Report KG';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Semester 1 Report KG',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student/semester-1-report-kg.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Semester 1 Report KG  TR*/
	$posttitle = 'Semester 1 Report KG TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Semester 1 Report KG TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student/semester-1-report-kg-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Semester 1 Report Card TR */
	$posttitle = 'Semester 1 Report Card TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Semester 1 Report Card TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student/semester-1-report-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Class All Marks For All Quarters */
	$posttitle = 'Class All Marks For All Quarters';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class All Marks For All Quarters',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/class-all-marks-q4.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* One Page Report */
	$posttitle = 'One Page Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'One Page Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/one-page.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* One Paper ATAR Report */
	$posttitle = 'One Paper ATAR Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'One Paper ATAR Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/one-atar-page.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* KG Quarter */
	$posttitle = 'KG Quarter';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'KG Quarter',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/kg-quarter.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* KG Quarter TR */
	$posttitle = 'KG Quarter TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'KG Quarter TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/kg-quarter-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* One Page Report TR */
	$posttitle = 'One Page Report TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'One Page Report TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/one-page-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}



	/* Student Home */
	$posttitle = 'Student Home';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Home',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student-login/student-dashbord.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}



	/* Student Home */
	$posttitle = 'Unauthorized Access';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Unauthorized Access',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'alerts/unauthorized-access.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Student Class Detail */
	$posttitle = 'Student Class Detail';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Class Detail',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student-login/class-detail.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Student Subject Report */
	$posttitle = 'Student Subject Report';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Subject Report',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student-login/student-subject-repor.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Student Gradebook */
	$posttitle = 'Student Gradebook';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Gradebook',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student-login/student-gradebook.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Student Profile */
	$posttitle = 'Student Profile';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Student Profile',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'student-login/profile.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Counselling Notes */
	$posttitle = 'Counselling Notes';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Counselling Notes',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/counselling-notes.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Subject Curve */
	$posttitle = 'Subject Curve';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Subject Curve',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'pages/subject-curve.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Class List Report By Subject */
	$posttitle = 'Class List Report By Subject';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class List Report By Subject',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/class-list-by-subject.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Middle Semester */
	$posttitle = 'Middle Semester';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Middle Semester',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/middle-semester.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Project Curve */
	$posttitle = 'Project Curve';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Project Curve',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/project-curve.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Middle Semester TR */
	$posttitle = 'Middle Semester TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Middle Semester TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/middle-semester-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Primary Semester */
	$posttitle = 'Primary Semester';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Primary Semester',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/primary-semester.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Standart Subject Curve */
	$posttitle = 'Standart Subject Curve';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Standart Subject Curve',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'report/standart-subject-curve.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}



	/* Atar Semester */
	$posttitle = 'Atar Semester';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Atar Semester',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/atar-semester.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Atar Semester TR */
	$posttitle = 'Atar Semester TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Atar Semester TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/atar-semester-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Atar Semester TR */
	$posttitle = 'Primary Semester TR';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Primary Semester TR',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/primary-semester-tr.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* KG Only Semester */
	$posttitle = 'KG Only Semester';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'KG Only Semester',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/kg-semester.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Sertifikalar */
	$posttitle = 'Sertifikalar';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Sertifikalar',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'print/sertifikalar.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Objectives Settings */
	$posttitle = 'Objectives Settings';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Objectives Settings',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/objectives-settings.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Add New Objective */
	$posttitle = 'Add New Objective';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Add New Objective',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/add-new-objective.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}
	
	
	/* Edit Objective */
	$posttitle = 'Edit Objective';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit Objective',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/edit-objective.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* Objectives Details */
	$posttitle = 'Objectives Details';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Objectives Details',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/objective-details.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}


	/* Upload Objectives */
	$posttitle = 'Upload Objectives';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Upload Objectives',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/upload-objectives.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}
	

	/* curriculum-breakdown */
	$posttitle = 'curriculum-breakdown';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'curriculum-breakdown',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'objectives/curriculum-breakdown.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* User Login Log */
	$posttitle = 'User Login Log';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'User Login Log',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'logs/user-login-log.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}

	/* All User Login Log */
	$posttitle = 'All User Login Log';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All User Login Log',
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'page_template'  => 'logs/all-login-log.php'

		);
		$sonuclar = wp_insert_post($pagedata);
	}



	
	restore_current_blog();


}

}

