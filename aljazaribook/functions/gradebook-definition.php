<?php 


/*****************************************************************************/
function gradebook_function() {
	$args = array(
		'label' => 'Gradebook Definitions',
		'public' => true,
		'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 4,
        'rewrite' => array('slug' => 'gradebook_function'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array(
        	'title',
        ),
      );
	register_post_type( 'gradebook_function', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'gradebook_function' );

/********************************************************************************/



/* AJAX Edit Gradebook Definitions Callback */
add_action('wp_ajax_nopriv_my_ajax_update_gradebook', 'my_ajax_update_gradebook');
add_action('wp_ajax_my_ajax_update_gradebook', 'my_ajax_update_gradebook');

function my_ajax_update_gradebook(){

  global $wpdb;
  $sonuclar = '';
  $registerdate = date('d/m/Y l');
  $registertime = date('G:i:s');
  $ip = $_SERVER['REMOTE_ADDR'];
  $current_user = get_current_user_id();


  $domainID = $_REQUEST["domainID"];
  $subDomainID = $_REQUEST["subDomainID"];
  $sub_domain_name = $_REQUEST["sub_domain_name"];
  $sub_domain_percentage = $_REQUEST["sub_domain_percentage"];
  $based_on = $_REQUEST["based_on"];
  $from = $_REQUEST["from"];
  $to = $_REQUEST["to"];
  $open_mode = $_REQUEST["open_mode"];
  $gradebookID = $_REQUEST["gradebookID"];
  $quarterID = $_REQUEST["quarterID"];

  $add_quarter = "add_quarter_1_domains";

  if ($quarterID == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarterID == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarterID == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarterID == 4) {

    $add_quarter = "add_quarter_4_domains";
    
  }

  
  if(have_rows($add_quarter, $gradebookID)): 
    while(have_rows($add_quarter, $gradebookID)): 
      the_row(); 

      if ($domainID == get_row_index()) {

        if(have_rows('add_sub_domains',$gradebookID)): 
          while(have_rows('add_sub_domains',$gradebookID)): 
            the_row(); 

            if ($subDomainID == get_row_index()) {
              $sonuclar = update_sub_field("sub_domain_name",$sub_domain_name);
              $sonuclar = update_sub_field("sub_domain_percentage",$sub_domain_percentage);
              $sonuclar = update_sub_field("based_on",$based_on);
              $sonuclar = update_sub_field("from",$from);
              $sonuclar = update_sub_field("to",$to);
              $sonuclar = update_sub_field("open_mode",$open_mode);
              $sonuclar = update_sub_field("gradebookID",$gradebookID);
            }

          endwhile; 
        endif; 

      }

    endwhile; 
  endif; 



  wp_send_json_success( $sonuclar);

  wp_die();

}



/* AJAX Add New Domain Callback */
add_action('wp_ajax_nopriv_my_ajax_add_domain', 'my_ajax_add_domain');
add_action('wp_ajax_my_ajax_add_domain', 'my_ajax_add_domain');

function my_ajax_add_domain(){

  global $wpdb;
  $sonuclar = '';
  $registerdate = date('d/m/Y l');
  $registertime = date('G:i:s');
  $ip = $_SERVER['REMOTE_ADDR'];
  $current_user = get_current_user_id();


  $gradebookID = $_REQUEST["gradebookID"];
  $quarteradd = $_REQUEST["quarteradd"];

  $add_quarter = "add_quarter_1_domains";

  if ($quarteradd == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarteradd == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarteradd == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarteradd == 4) {

    $add_quarter = "add_quarter_4_domains";
    
  }


  $value = array(
    'domain_name' => "New Domain",
    'domain_percentage' => "0",
  );
  $sonuclar = add_row($add_quarter, $value, $gradebookID);



  wp_send_json_success( $sonuclar);

  wp_die();

}




/* AJAX Add New Sub Domain Callback */
add_action('wp_ajax_nopriv_my_ajax_add_sub_domain', 'my_ajax_add_sub_domain');
add_action('wp_ajax_my_ajax_add_sub_domain', 'my_ajax_add_sub_domain');

function my_ajax_add_sub_domain(){

  global $wpdb;
  $sonuclar = '';
  $registerdate = date('d/m/Y l');
  $registertime = date('G:i:s');
  $ip = $_SERVER['REMOTE_ADDR'];
  $current_user = get_current_user_id();


  $gradebookID = $_REQUEST["gradebookID"];
  $quarteradd = $_REQUEST["quarteradd"];
  $domainId = $_REQUEST["domainId"];

  $add_quarter = "add_quarter_1_domains";

  if ($quarteradd == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarteradd == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarteradd == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarteradd == 4) {

    $add_quarter = "add_quarter_4_domains";
    
  }

  if(have_rows($add_quarter, $gradebookID)): 
    while(have_rows($add_quarter, $gradebookID)): 
      the_row(); 

      if ($domainId == get_row_index()) {
        $value = array(
          'sub_domain_name' => "New Sub Domain",
        );
        $sonuclar = add_sub_row("add_sub_domains", $value,$gradebookID);
      }

    endwhile; 
  endif; 




  wp_send_json_success( $sonuclar);

  wp_die();

}




/* AJAX Update Domain Info Callback */
add_action('wp_ajax_nopriv_my_ajax_update_domain', 'my_ajax_update_domain');
add_action('wp_ajax_my_ajax_update_domain', 'my_ajax_update_domain');

function my_ajax_update_domain(){

  global $wpdb;
  $sonuclar = '';
  $registerdate = date('d/m/Y l');
  $registertime = date('G:i:s');
  $ip = $_SERVER['REMOTE_ADDR'];
  $current_user = get_current_user_id();


  $gradebookID = $_REQUEST["gradebookID"];
  $domainId = $_REQUEST["domainID"];
  $quarterID = $_REQUEST["quarterID"];

  $domain_name = $_REQUEST["domain_name"];
  $domain_percentage = $_REQUEST["domain_percentage"];


  $add_quarter = "add_quarter_1_domains";

  if ($quarterID == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarterID == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarterID == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarterID == 4) {

    $add_quarter = "add_quarter_4_domains";
    
  }


  $value = array(
    'domain_name' => $domain_name,
    'domain_percentage' => $domain_percentage,
  );
  $sonuclar = update_row($add_quarter, $domainId, $value, $gradebookID);





  wp_send_json_success( $sonuclar);

  wp_die();

}





/* AJAX Create Gradebook Definition Callback */
add_action('wp_ajax_nopriv_my_ajax_create_gradebook', 'my_ajax_create_gradebook');
add_action('wp_ajax_my_ajax_create_gradebook', 'my_ajax_create_gradebook');

function my_ajax_create_gradebook(){

  global $wpdb;
  $sonuclar = '';

  $gradebookName = $_REQUEST["group_name"];
  $current_user = get_current_user_id();
  $userdata = array(
    'post_title'  => $gradebookName,
    'post_type'   => 'gradebook_function',
    'post_status' => 'publish',
    'post_author' => $current_user
  );  

  
  $sonuclar = wp_insert_post($userdata);


  wp_send_json_success( $sonuclar);

  wp_die();

}


/* AJAX Create Gradebook Definition Callback */
add_action('wp_ajax_nopriv_my_ajax_delete_assessment', 'my_ajax_delete_assessment');
add_action('wp_ajax_my_ajax_delete_assessment', 'my_ajax_delete_assessment');

function my_ajax_delete_assessment(){

  global $wpdb;
  $sonuclar = '';

  $delete_button = $_REQUEST["delete_button"];

  $sonuclar = wp_trash_post($delete_button);

  wp_send_json_success( $sonuclar);

  wp_die();

}



/* AJAX Delete Subdomain Callback */
add_action('wp_ajax_nopriv_my_ajax_delete_subdomain', 'my_ajax_delete_subdomain');
add_action('wp_ajax_my_ajax_delete_subdomain', 'my_ajax_delete_subdomain');

function my_ajax_delete_subdomain(){

  global $wpdb;
  $sonuclar = '';

  $gradebookID = $_REQUEST["gradebookID"];
  $quarteradd = $_REQUEST["quarteradd"];
  $domainId = $_REQUEST["domainId"];
  $subDomainId = $_REQUEST["subDomainId"];


  $add_quarter = "add_quarter_1_domains";

  if ($quarteradd == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarteradd == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarteradd == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarteradd == 4) {

    $add_quarter = "add_quarter_4_domains";

  }

  if( have_rows($add_quarter,$gradebookID) ) {
    while( have_rows($add_quarter,$gradebookID) ) {
      the_row();

      if (get_row_index() == $domainId) {
        $silme = delete_sub_row('add_sub_domains', $subDomainId);
      }

    }
  }

  // if ($silme === true) {
  //   //we will delete all nots releated to this subdomain
  //   $bg_table_name = "book_".get_current_blog_id()."_gradebook";

  //   $query = $wpdb->query($wpdb->prepare("DELETE from $bg_table_name where gb_gradebook_id =".$gradebookID." and gb_quarter_id =".$quarteradd." and gb_domain_id =".$domainId." and gb_subdomain_id =".$subDomainId."" ));
  //   $sonuclar = $wpdb->get_results($query);
  // }

  wp_send_json_success( $sonuclar);

  wp_die();

}



/* AJAX Delete Subdomain Callback */
add_action('wp_ajax_nopriv_my_ajax_delete_domain', 'my_ajax_delete_domain');
add_action('wp_ajax_my_ajax_delete_domain', 'my_ajax_delete_domain');

function my_ajax_delete_domain(){

  global $wpdb;
  $sonuclar = '';

  $gradebookID = $_REQUEST["gradebookID"];
  $quarteradd = $_REQUEST["quarteradd"];
  $domainId = $_REQUEST["domainId"];


  $add_quarter = "add_quarter_1_domains";

  if ($quarteradd == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($quarteradd == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($quarteradd == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($quarteradd == 4) {

    $add_quarter = "add_quarter_4_domains";

  }



  $sonuclar = delete_row($add_quarter,$domainId,$gradebookID);



  wp_send_json_success( $sonuclar);

  wp_die();

}





/* AJAX Update Domain Info Callback */
add_action('wp_ajax_nopriv_my_ajax_update_gradebook_open', 'my_ajax_update_gradebook_open');
add_action('wp_ajax_my_ajax_update_gradebook_open', 'my_ajax_update_gradebook_open');

function my_ajax_update_gradebook_open(){

  global $wpdb;
  $sonuclar = '';

  $quarter_id = $_REQUEST["quarter_id_open"];
  $gradebook_id_open = $_REQUEST["gradebook_id_open"];


  $quarter_id_open = "add_quarter_1_domains";

  if ($quarter_id == 1) {

    $quarter_id_open = "add_quarter_1_domains";

  }elseif ($quarter_id == 2) {

    $quarter_id_open = "add_quarter_2_domains";

  }elseif ($quarter_id == 3) {

    $quarter_id_open = "add_quarter_3_domains";
    
  }elseif ($quarter_id == 4) {

    $quarter_id_open = "add_quarter_4_domains";
    
  }



  if(have_rows($quarter_id_open, $gradebook_id_open)): 
    while(have_rows($quarter_id_open, $gradebook_id_open)): 
      the_row(); 
      if(have_rows('add_sub_domains')): 
        while(have_rows('add_sub_domains')): 
          the_row();
          $sonuclar = update_sub_field("open_mode","Open");
        endwhile; 
      endif;
    endwhile; 
  endif;


  wp_send_json_success( $sonuclar);

  wp_die();

}



/* AJAX Update Domain Info Callback */
add_action('wp_ajax_nopriv_my_ajax_update_gradebook_close', 'my_ajax_update_gradebook_close');
add_action('wp_ajax_my_ajax_update_gradebook_close', 'my_ajax_update_gradebook_close');

function my_ajax_update_gradebook_close(){

  global $wpdb;
  $sonuclar = '';

  $quarter_id = $_REQUEST["quarter_id_open"];
  $gradebook_id_open = $_REQUEST["gradebook_id_open"];


  $quarter_id_open = "add_quarter_1_domains";

  if ($quarter_id == 1) {

    $quarter_id_open = "add_quarter_1_domains";

  }elseif ($quarter_id == 2) {

    $quarter_id_open = "add_quarter_2_domains";

  }elseif ($quarter_id == 3) {

    $quarter_id_open = "add_quarter_3_domains";
    
  }elseif ($quarter_id == 4) {

    $quarter_id_open = "add_quarter_4_domains";
    
  }



  if(have_rows($quarter_id_open, $gradebook_id_open)): 
    while(have_rows($quarter_id_open, $gradebook_id_open)): 
      the_row(); 
      if(have_rows('add_sub_domains')): 
        while(have_rows('add_sub_domains')): 
          the_row();
          $sonuclar = update_sub_field("open_mode","Close");
        endwhile; 
      endif;
    endwhile; 
  endif;


  wp_send_json_success($quarter_id_open);

  wp_die();

}




/*****************************************************************************/
function definitions_function() {
  $args = array(
    'label' => 'Definitions Bank',
    'public' => true,
    'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 4,
        'rewrite' => array('slug' => 'definitions_function'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array(
          'title',
        ),
      );
  register_post_type( 'definitions_function', $args );



}
add_action( 'init', 'definitions_function' );




/* AJAX Delete Subdomain Callback */
add_action('wp_ajax_nopriv_my_ajax_chance_definition', 'my_ajax_chance_definition');
add_action('wp_ajax_my_ajax_chance_definition', 'my_ajax_chance_definition');

function my_ajax_chance_definition(){

  global $wpdb;
  $sonuclar = '';

  $gradebookID = $_REQUEST["gradebookID"];
  $definition_bank_quarter = $_REQUEST["definition_bank_quarter"];
  $definition_select_id = $_REQUEST["definition_select_id"];


  $add_quarter = "add_quarter_1_domains";

  if ($definition_bank_quarter == 1) {

    $add_quarter = "add_quarter_1_domains";

  }elseif ($definition_bank_quarter == 2) {

    $add_quarter = "add_quarter_2_domains";

  }elseif ($definition_bank_quarter == 3) {

    $add_quarter = "add_quarter_3_domains";
    
  }elseif ($definition_bank_quarter == 4) {

    $add_quarter = "add_quarter_4_domains";

  }

  // var onali silme alani baslangic
  $silinecek_rowlar = array();
  if(have_rows($add_quarter, $gradebookID)): 
    while(have_rows($add_quarter, $gradebookID)): 
      the_row(); 

      array_push($silinecek_rowlar, get_row_index());

    endwhile; 
  endif;

  foreach ($silinecek_rowlar as $key => $value) {
    delete_row($add_quarter,1,$gradebookID);
  }

  foreach ($silinecek_rowlar as $key => $value) {
    delete_row($add_quarter,2,$gradebookID);
  }
  // var onali silme alani bitis



  // secili olani yukleme alani baslangic
  $sub_domain_name = [];
  $sub_domain_percentage = [];
  $based_on = [];
  $from = [];
  $to = [];
  $open_mode = [];
  if(have_rows('add_quarter_domains', $definition_select_id)): 
    while(have_rows('add_quarter_domains', $definition_select_id)): 
      the_row(); 
      $domain_row = get_row_index();

      $domain_name = get_sub_field("domain_name");
      $domain_percentage = get_sub_field("domain_percentage");

      $value = array(
        'domain_name' => $domain_name,
        'domain_percentage' => $domain_percentage,
      );
      $sonuclar = add_row($add_quarter, $value, $gradebookID);
      
      // sub domain ekleme baslangic
      if(have_rows('add_sub_domains')): 
        while(have_rows('add_sub_domains')): 
          the_row(); 
          $sub_domain_row = get_row_index();

          $sub_domain_name[$domain_row][$sub_domain_row] = get_sub_field("sub_domain_name");
          $sub_domain_percentage[$domain_row][$sub_domain_row] = get_sub_field("sub_domain_percentage");
          $based_on[$domain_row][$sub_domain_row] = get_sub_field("based_on");
          $from[$domain_row][$sub_domain_row] = get_sub_field("from");
          $to[$domain_row][$sub_domain_row] = get_sub_field("to");
          $open_mode[$domain_row][$sub_domain_row] = get_sub_field("open_mode");
        endwhile; 
      endif;
      // sub domain ekleme bitis

    endwhile; 
  endif;

  if(have_rows($add_quarter, $gradebookID)): 
    while(have_rows($add_quarter, $gradebookID)): 
      the_row(); 
      $domain_row = get_row_index();

      foreach ($sub_domain_name[$domain_row] as $key => $value) {
        $value = array(
          'sub_domain_name' => $sub_domain_name[$domain_row][$key],
          'sub_domain_percentage' => $sub_domain_percentage[$domain_row][$key],
          'based_on' => $based_on[$domain_row][$key],
          'from' => $from[$domain_row][$key],
          'to' => $to[$domain_row][$key],
          'open_mode' => $open_mode[$domain_row][$key],
        );
        add_sub_row('add_sub_domains', $value);
      }


        // $value = array(
        //   'sub_domain_name' => $sub_domain_name[1][1],
        //   'sub_domain_percentage' => $sub_domain_percentage[1][1],
        //   'based_on' => $based_on[1][1],
        //   'from' => $from[1][1],
        //   'to' => $to[1][1],
        //   'open_mode' => $open_mode[1][1],
        // );
        // add_sub_row('add_sub_domains', $value);

    endwhile; 
  endif;

  // secili alani yukleme alani bitis

  wp_send_json_success($sub_domain_name);

  wp_die();

}

/********************************************************************************/