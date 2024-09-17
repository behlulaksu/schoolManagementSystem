<?php 


/*****************************************************************************/
function author_functions() {
  $args = array(
    'label' => 'Authorizations',
    'public' => true,
    'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 5,
        'rewrite' => array('slug' => 'author_functions'),
        'query_var' => true,
        'menu_icon' => 'dashicons-products',
        'supports' => array(
          'title',
        ),
        'taxonomies' => array('author', 'category' ),
      );
  register_post_type( 'author_functions', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'author_functions' );

/********************************************************************************/


$variable = get_sites();
foreach ($variable as $key => $value) {
  switch_to_blog($value->blog_id);


  $new_category_name = 'users';
  $taxonomy = 'category';

  if (!term_exists($new_category_name, $taxonomy)) {
    $args = array(
        'description' => 'Authorizations Category', // Optional
        'slug' => 'users-category-slug', // Optional
        'parent' => 0, // Optional, set to 0 for top-level category
      );

    wp_insert_term($new_category_name, $taxonomy, $args);
    

  } 


  $new_category_name = 'classes';
  $taxonomy = 'category';

  if (!term_exists($new_category_name, $taxonomy)) {
    $args = array(
        'description' => 'Authorizations Category', // Optional
        'slug' => 'classes-category-slug', // Optional
        'parent' => 0, // Optional, set to 0 for top-level category
      );

    wp_insert_term($new_category_name, $taxonomy, $args);
    

  } 


  $new_category_name = 'assessment';
  $taxonomy = 'category';

  if (!term_exists($new_category_name, $taxonomy)) {
    $args = array(
        'description' => 'Authorizations Category', // Optional
        'slug' => 'assessment-category-slug', // Optional
        'parent' => 0, // Optional, set to 0 for top-level category
      );

    wp_insert_term($new_category_name, $taxonomy, $args);
    

  } 


  $new_category_name = 'subject';
  $taxonomy = 'category';

  if (!term_exists($new_category_name, $taxonomy)) {
    $args = array(
        'description' => 'Authorizations Category', // Optional
        'slug' => 'subject-category-slug', // Optional
        'parent' => 0, // Optional, set to 0 for top-level category
      );

    wp_insert_term($new_category_name, $taxonomy, $args);
    

  } 


  $new_category_name = 'academicrecorde';
  $taxonomy = 'category';

  if (!term_exists($new_category_name, $taxonomy)) {
    $args = array(
        'description' => 'Student Academic Records', // Optional
        'slug' => 'academicrecorde-slug', // Optional
        'parent' => 0, // Optional, set to 0 for top-level category
      );

    wp_insert_term($new_category_name, $taxonomy, $args);
    

  } 




  restore_current_blog();
}


/* AJAX Add New Domain Callback */
add_action('wp_ajax_nopriv_my_ajax_authorization_update', 'my_ajax_authorization_update');
add_action('wp_ajax_my_ajax_authorization_update', 'my_ajax_authorization_update');

function my_ajax_authorization_update(){

  global $wpdb;
  $sonuclar = '';

  $yetki_post_id = $_REQUEST["yetki_post_id"];
  $read_sonuc = $_REQUEST["read_sonuc"];
  $write_sonuc = $_REQUEST["write_sonuc"];
  $delete_sonuc = $_REQUEST["delete_sonuc"];
  $user_id = $_REQUEST["user_id"];

  $read_author = get_field("read", $yetki_post_id);
  if (!empty($read_author)) {
    if ($read_sonuc === "Open") {
      array_push($read_author,$user_id);
      update_field("read",$read_author,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }elseif ($read_sonuc === "Close") {
      $index = array_search($user_id, $read_author, true);
      unset($read_author[$index]);
      update_field("read",$read_author,$yetki_post_id);
      $sonuclar = "Cikarildi";
    }
  }else{
    if ($read_sonuc === "Open") {
      update_field("read",$user_id,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }
  }


  $write_author = get_field("write_users", $yetki_post_id);
  if (!empty($write_author)) {
    if ($write_sonuc === "Open") {
      array_push($write_author,$user_id);
      update_field("write_users",$write_author,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }elseif ($write_sonuc === "Close") {
      $index = array_search($user_id, $write_author, true);
      unset($write_author[$index]);
      update_field("write_users",$write_author,$yetki_post_id);
      $sonuclar = "Cikarildi";
    }
  }else{
    if ($write_sonuc === "Open") {
      update_field("write_users",$user_id,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }
  }


  $delete_author = get_field("delete", $yetki_post_id);
  if (!empty($delete_author)) {
    if ($delete_sonuc === "Open") {
      array_push($delete_author,$user_id);
      update_field("delete",$delete_author,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }elseif ($delete_sonuc === "Close") {
      $index = array_search($user_id, $delete_author, true);
      unset($delete_author[$index]);
      update_field("delete",$delete_author,$yetki_post_id);
      $sonuclar = "Cikarildi";
    }
  }else{
    if ($delete_sonuc === "Open") {
      update_field("delete",$user_id,$yetki_post_id);
      $sonuclar = "Ekleme islemi yapildi";
    }
  }


  wp_send_json_success( $sonuclar);

  wp_die();

}