<?php 

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(

		'page_title'  => 'Campus Settings',

		'menu_title'  => 'Campus Settings',

		'menu_slug'   => 'campus-settings',

		'capability'  => 'manage_options',

		'redirect'    => false

	));


}


if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_6592d6ff36853',
		'title' => 'Campus Settings',
		'fields' => array(
			array(
				'key' => 'field_6592d6ff7a75d',
				'label' => 'Lock Campus Q1',
				'name' => 'lock_campus_q1',
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
				'key' => 'field_6592d78a479ef',
				'label' => 'Lock Campus Q2',
				'name' => 'lock_campus_q2',
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
				'key' => 'field_6592d794479f0',
				'label' => 'Lock Campus Q3',
				'name' => 'lock_campus_q3',
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
				'key' => 'field_6592d79e479f1',
				'label' => 'Lock Campus Q4',
				'name' => 'lock_campus_q4',
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
				'key' => 'field_6592d7ae16938',
				'label' => 'Active Campus Quarter',
				'name' => 'active_campus_quarter',
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
				'default_value' => false,
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
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'campus-settings',
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