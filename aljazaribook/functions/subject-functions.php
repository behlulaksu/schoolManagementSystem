<?php 

/*****************************************************************************/
function subject_function() {
	$args = array(
		'label' => 'Subjects',
		'public' => true,
		'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 2,
        'rewrite' => array('slug' => 'subject_function'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array(
        	'title',
        ),
      );
	register_post_type( 'subject_function', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'subject_function' );

/********************************************************************************/




/* AJAX Edit User Users Callback */
add_action('wp_ajax_nopriv_my_ajax_update_subjects', 'my_ajax_update_subjects');
add_action('wp_ajax_my_ajax_update_subjects', 'my_ajax_update_subjects');

function my_ajax_update_subjects(){

  global $wpdb;
  $sonuclar = '';
  $registerdate = date('d/m/Y l');
  $registertime = date('G:i:s');
  $ip = $_SERVER['REMOTE_ADDR'];
  $current_user = get_current_user_id();


  $postID = $_REQUEST["postID"];
  $subject_admins = $_REQUEST["subject_admins"];
  $subject_type = $_REQUEST["subject_type"];
  $gradebook_definition = $_REQUEST["gradebook_definition"];
  $subject_description = $_REQUEST["subject_description"];

  $group_admin_id = array();
  $group_stundet_id = array();
  $group_stundet_remove_id = array();

  foreach ($subject_admins as $key => $value) {
    $userKontrol = get_user_by( 'email', $value );
    $group_admin_id[$key] = $userKontrol->data->ID;
  }
  foreach ($additional_users as $key => $value) {
    $userKontrol = get_user_by( 'email', $value );
    $group_stundet_id[$key] = $userKontrol->data->ID;
  }

  foreach ($removed_users as $key => $value) {
    $userKontrol = get_user_by( 'email', $value );
    $group_stundet_remove_id[$key] = $userKontrol->data->ID;
  }


  $userdata = array(
    'ID'          => $postID,
    'post_status' => 'publish',
    'meta_input'  => array(
      'subject_admin' => $group_admin_id,
      'subject_description' => $subject_description,
      'select_lesson_type' => $subject_type,
      'select_gradebook_definition' => $gradebook_definition,
    ),
  );

  
  $sonuclar = wp_update_post($userdata);


  wp_send_json_success( $sonuclar);

  wp_die();

}
