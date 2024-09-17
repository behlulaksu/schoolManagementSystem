<?php 


/****************************Filter**************************************/

function wp_remove_menus(){

    remove_menu_page( 'index.php' );                  //Dashboard

    remove_menu_page( 'jetpack' );                    //Jetpack* 

    remove_menu_page( 'edit.php' );                   //Posts

    //remove_menu_page( 'upload.php' );                 //Media

    //remove_menu_page( 'edit.php?post_type=page' );    //Pages

    remove_menu_page( 'edit-comments.php' );          //Comments

    //remove_menu_page( 'themes.php' );                 //Appearance

    //remove_menu_page( 'plugins.php' );                //Plugins

    //remove_menu_page( 'users.php' );                  //Users

    remove_menu_page( 'tools.php' );                  //Tools

    //remove_menu_page( 'options-general.php' );        //Settings

}

add_action( 'admin_menu', 'wp_remove_menus' );

function allow_xml_uploads($mime_types) {
    $mime_types['xml'] = 'text/xml'; // XML dosya türünü ekler
    return $mime_types;
}
add_filter('upload_mimes', 'allow_xml_uploads');

/*****************thema sport*********************/
function ilktemam_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'ilktemam_setup' );


/*****************thema sport*********************/

/*************kucuk resim baslangic******************/
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
    // for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );

	function AddThumbColumn($cols) {

		$cols['thumbnail'] = __('Thumbnail');

		return $cols;
	}

	function AddThumbValue($column_name, $post_id) {

		$width = (int) 150;
		$height = (int) 150;

		if ( 'thumbnail' == $column_name ) {
                // thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
			if ( isset($thumb) && $thumb ) {
				echo $thumb;
			} else {
				echo __('None');
			}
		}
	}

    // for posts
	add_filter( 'manage_posts_columns', 'AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );

    // for pages
	add_filter( 'manage_pages_columns', 'AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}

// function admin_default_page() {
// 	return "/proje/atakent-2-2023-2024/";
// }

// add_filter('login_redirect', 'admin_default_page');



/************Ana giris ekrani duzenleme************************************/ 
function main_panel_edit(){
	?>
	<style type="text/css">
		#toplevel_page_cptui_main_menu, #dashboard-widgets-wrap, #wp-admin-bar-wp-logo, #footer-thankyou, #footer-upgrade, #wp-admin-bar-ilightbox_general, #wp-admin-bar-comments, #wp-admin-bar-new-content, #tagsdiv-sektor, #asp_metadata, #wp-admin-bar-wpseo-menu #se-top-global-notice, #wp-admin-bar-wpseo-menu, #tagsdiv-ilantipi, #ilankategoridiv, #ililcediv, #tagsdiv-oda, #tagsdiv-binayasi, #tagsdiv-binakatsayisi, #tagsdiv-bulundugukat, #tagsdiv-isitma, #tagsdiv-banyo, #tagsdiv-esya, #tagsdiv-kullanim, #tagsdiv-sitedurumu, #tagsdiv-kredi, #tagsdiv-kimden, #tagsdiv-takas,#tagsdiv-cephe,#tagsdiv-icozellik,#acentediv{
			display: none;}

			#contextual-help-wrap{
				display: none;
			}

			#screen-options-wrap ,#screen-meta-links ,#wp-admin-bar-updates{
				display: none;
			}

		</style>
		<?php 
	}
	add_action('admin_head','main_panel_edit');




	function log_user_login( $user_login, $user ) {
		global $wpdb;
		$current_user = wp_get_current_user();
		$user_id = $user->ID;
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$login_time = current_time( 'mysql' );
		$site_id = get_current_blog_id(); 

		$user_login_logs = "user_login_logs";
		$wpdb->insert(
			$user_login_logs,
			array(
				'user_id'    => $user_id,
				'ip_adress' => $ip_address,
				'login_time' => $login_time,
				'site_id'    => $site_id,
			)
		);
	}
	add_action( 'wp_login', 'log_user_login', 10, 2 );



	/************Login screen edit************************************/ 
	function login_panel_edit(){
		include('style-login.php');
	}
	add_action('login_enqueue_scripts','login_panel_edit');

	/*Custom functions*/
	include('functions/custom-functions.php');





	/**************************************************************/
	/*PDP Page functions*/
	include('functions/pdp.php');

	/**************************************************************/


	/*Create User*/
	include('functions/createuser.php');
	/*user control functions*/
	include('functions/users.php');
	/*user groups */
	include('functions/user-groups.php');

	/*****************************************************************/
	/*Subject functions */
	include('functions/subject-functions.php');
	/*Lesson functions */
	include('functions/lessons-type.php');
	/*Gradebook functions */
	include('functions/gradebook-definition.php');
	/*Gradebook Save functions */
	include('functions/gradebook-save.php');
	/*Gradebook Get functions */
	include('functions/gradebook_get_point.php');




	/******************** Custom Fileds ***********************/
	/*Groups Custom Fileds */
	include('custom-field/user-groups.php');
	/*User Informations Custom Fileds */
	include('custom-field/user-informations.php');
	/*User Subjects Custom Fileds */
	include('custom-field/subjects.php');
	/*Lesson Type Custom Fileds */
	include('custom-field/lesson-type.php');
	/*Gradebook Definitions Custom Fileds */
	include('custom-field/gradebook-definitions.php');
	/*Authorizations Custom Fileds */
	include('custom-field/authorizations.php');
	/*Campus Settings Custom Fileds */
	include('custom-field/campus-settings.php');
	/*PDP Custom Fileds */
	include('custom-field/pdp.php');
	/*Subject Comment Custom Fileds */
	include('custom-field/subject-comment.php');
	/*Grade Advisor Comment Custom Fileds */
	include('custom-field/grade-advisor-comments.php');
	/*Attandance Custom Fileds */
	include('custom-field/attandance.php');



	/******************** wp_insert_site ***********************/
	include('insert-site-functions.php');





	/******************** Authorizations ***********************/
	include('functions/authorizations-general.php');
	include('authorizations/createposts.php');
	include('authorizations/access-denied.php');
	include('authorizations/get-access.php');




	/******************** Report ***********************/
	include('report/report-function.php');




	/******************** Upload File ***********************/
	include('functions/uoload_files_callback.php');



	/******************** Student Comment ***********************/
	include('functions/student-comments.php');
	/******************** Student Comment Subject ***************/
	include('functions/subject-commetn-save.php');




	/******************** Curve ***********************/
	include('functions/curve.php');
	include('functions/campus-settings.php');



	/******************* Attandance *******************/
	include('functions/attandance.php');



	/******************* Objectives *******************/
	include('functions/objectives-function.php');

?>