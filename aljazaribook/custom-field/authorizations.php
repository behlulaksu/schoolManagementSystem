<?php 

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_6522fb1f22b48',
		'title' => 'Authorizations',
		'fields' => array(
			array(
				'key' => 'field_6522fb1f17cfb',
				'label' => 'Read',
				'name' => 'read',
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
				'return_format' => 'id',
				'multiple' => 1,
				'allow_null' => 0,
			),
			array(
				'key' => 'field_6523ad49fd620',
				'label' => 'Write Users',
				'name' => 'write_users',
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
				'return_format' => 'id',
				'multiple' => 1,
				'allow_null' => 0,
			),
			array(
				'key' => 'field_6522fe528a30f',
				'label' => 'Delete',
				'name' => 'delete',
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
				'return_format' => 'id',
				'multiple' => 1,
				'allow_null' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'author_functions',
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