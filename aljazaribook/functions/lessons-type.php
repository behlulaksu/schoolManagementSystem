<?php 

/*****************************************************************************/
function lesson_type_function() {
	$args = array(
		'label' => 'Lesson Type',
		'public' => true,
		'hierarchical' => true,
        'publicly_queryable'  => true, //sayfalama olayını kapat.
        'menu_position' => 2,
        'rewrite' => array('slug' => 'lesson_type_function'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array(
        	'title',
        ),
      );
	register_post_type( 'lesson_type_function', $args );



}
  //add_theme_support( 'post-thumbnails' );
add_action( 'init', 'lesson_type_function' );

/********************************************************************************/