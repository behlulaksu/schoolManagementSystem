<?php 

/*****************************************************************************/
function add_new_class() {
	$args = array(
		'label' => 'Classes / Subjects',
		'public' => true,
    'capability_type' => 'newClassCap',
    'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 2,
        'rewrite' => array('slug' => 'newClass_add'),
        'query_var' => true,
        'menu_icon' => 'dashicons-cover-image',
        'supports' => array(
        	'title',
          //'editor',
        	'thumbnail'
        ),
      );
	register_post_type( 'newClass_add', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'add_new_class' );
current_user_can( 'newClass_add' );
/********************************************************************************/





if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_648c491f70464',
    'title' => 'Class-Subject Roster',
    'fields' => array(
      array(
        'key' => 'field_648c491f50029',
        'label' => 'Add an Admin',
        'name' => 'add_class_admin',
        'aria-label' => '',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'return_format' => 'array',
        'multiple' => 1,
        'allow_null' => 0,
      ),
      array(
        'key' => 'field_648c4b57301da',
        'label' => 'Add teachers',
        'name' => 'add_class_teachers',
        'aria-label' => '',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'return_format' => 'array',
        'multiple' => 1,
        'allow_null' => 0,
      ),
      array(
        'key' => 'field_648c4b6f301db',
        'label' => 'Add Students',
        'name' => 'add_class_students',
        'aria-label' => '',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'return_format' => 'array',
        'multiple' => 1,
        'allow_null' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'newclass_add',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));


/*put the code before endif, important!*/
endif;    
