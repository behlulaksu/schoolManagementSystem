<?php 

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_65001c1d1bb00',
		'title' => 'User Groups',
		'fields' => array(
			array(
				'key' => 'field_65001c8ebb6a1',
				'label' => 'Group Admin',
				'name' => 'group_admin',
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
				'role' => array(
					0 => 'administrator',
					1 => 'teacher',
					2 => 'manager',
					3 => 'pdp',
					4 => 'supervisor',
				),
				'return_format' => 'array',
				'multiple' => 1,
				'allow_null' => 0,
			),
			array(
				'key' => 'field_65001cc3bb6a2',
				'label' => 'Group Users',
				'name' => 'group_users',
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
				'key' => 'field_65001d879ca1f',
				'label' => 'Group Image',
				'name' => 'gru',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_65075e62d3a3a',
				'label' => 'Subject For Group',
				'name' => 'subject_for_group',
				'aria-label' => '',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'subject_function',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
				),
				'return_format' => 'object',
				'min' => '',
				'max' => '',
				'elements' => array(
					0 => 'featured_image',
				),
			),
			array(
				'key' => 'field_6537d72aaedcc',
				'label' => 'Sub Class',
				'name' => 'sub_class',
				'aria-label' => '',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'No' => 'No',
					'Yes' => 'Yes',
				),
				'default_value' => array(
					'No' => 'No',
				),
				'return_format' => 'value',
				'allow_custom' => 0,
				'layout' => 'vertical',
				'toggle' => 0,
				'save_custom' => 0,
			),
			array(
				'key' => 'field_654e414de8269',
				'label' => 'Type Of Class',
				'name' => 'type_of_class',
				'aria-label' => '',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'No' => 'No',
					'Language' => 'Language',
					'ATAR' => 'ATAR',
				),
				'default_value' => 'No',
				'return_format' => 'value',
				'allow_null' => 0,
				'other_choice' => 0,
				'layout' => 'vertical',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_66ebfdd9cda6a',
				'label' => 'Class ASC ID',
				'name' => 'class_asc_id',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'user_groups',
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




if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_658d5653bb610',
		'title' => 'Class Settings',
		'fields' => array(
			array(
				'key' => 'field_658d56541687d',
				'label' => 'Lock Date Q1',
				'name' => 'lock_date_q1',
				'aria-label' => '',
				'type' => 'date_time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y g:i a',
				'return_format' => 'Y-m-d H:i',
				'first_day' => 1,
			),
			array(
				'key' => 'field_658d595a1687e',
				'label' => 'Lock Date Q2',
				'name' => 'lock_date_q2',
				'aria-label' => '',
				'type' => 'date_time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y g:i a',
				'return_format' => 'Y-m-d H:i',
				'first_day' => 1,
			),
			array(
				'key' => 'field_658d59c416881',
				'label' => 'Lock Date Q3',
				'name' => 'lock_date_q3',
				'aria-label' => '',
				'type' => 'date_time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y g:i a',
				'return_format' => 'Y-m-d H:i',
				'first_day' => 1,
			),
			array(
				'key' => 'field_658d59c816882',
				'label' => 'Lock Date Q4',
				'name' => 'lock_date_q4',
				'aria-label' => '',
				'type' => 'date_time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y g:i a',
				'return_format' => 'Y-m-d H:i',
				'first_day' => 1,
			),
			array(
				'key' => 'field_658d5b873ee4c',
				'label' => 'Class Advisors',
				'name' => 'class_advisors',
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
				'key' => 'field_658d5bdd12119',
				'label' => 'Class PDP',
				'name' => 'class_pdp',
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
				'key' => 'field_6592c1bf4a01d',
				'label' => 'Active Quarter',
				'name' => 'active_quarter',
				'aria-label' => '',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
				),
				'default_value' => 2,
				'return_format' => 'value',
				'multiple' => 0,
				'allow_null' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'user_groups',
				),
			),
		),
		'menu_order' => 9,
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