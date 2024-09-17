<?php 

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_650ae94db86f5',
		'title' => 'Lesson Type',
		'fields' => array(
			array(
				'key' => 'field_650ae94e3bd9c',
				'label' => 'Responsible Users',
				'name' => 'responsible_users',
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
					'value' => 'lesson_type_function',
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

endif;		

