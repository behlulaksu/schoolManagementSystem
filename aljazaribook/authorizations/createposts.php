<?php 


$variable = get_sites();
foreach ($variable as $key => $value) {

	switch_to_blog($value->blog_id);




	/* Assessment */
	/* Assessment */
	/* Assessment */

	$posttitle = 'Assessment Menu';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Assessment Menu',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'assessment-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}

	$posttitle = 'Create Module';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Create Module',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'assessment-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'See Module';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'See Module',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'assessment-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Edit Module';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit Module',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'assessment-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	/* Classes */
	/* Classes */
	/* Classes */


	$posttitle = 'Classes Menu';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Classes Menu',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}

	$posttitle = 'See All Classes';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'See All Classes',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Create New Class';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Create New Class',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Class Roster';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Roster',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	$posttitle = 'Class Subject';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Subject',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	$posttitle = 'Class Settings';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Settings',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	$posttitle = 'Class Contacts';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Contacts',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Class Files';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Files',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}

	$posttitle = 'Class Curve';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Class Curve',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'classes-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}




	/* Subject */
	/* Subject */
	/* Subject */

	$posttitle = 'Subject Menu';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Subject Menu',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'subject-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}

	$posttitle = 'Add New Subject';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Add New Subject',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'subject-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'List Subject';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'List Subject',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'subject-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Edit Subject';// bu neden gelmiyor anlamadim
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Edit Subject',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'subject-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	/* Users */
	/* Users */
	/* Users */


	$posttitle = 'Users Menu';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Users Menu',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'users-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'Upload User as Bulk';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Upload User as Bulk',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'users-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'All Users';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'All Users',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'users-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	$posttitle = 'Staff';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Staff',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'users-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}



	$posttitle = 'Students';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Students',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'users-category-slug';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	/* Academic Recorde */
	/* Academic Recorde */
	/* Academic Recorde */



	$posttitle = 'Grade Advisor';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'Grade Advisor',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'academicrecorde-slug	';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	$posttitle = 'PDP Comment';
	$postid = $wpdb->get_var( "SELECT * FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );

	if (empty($postid)) {
		$pagedata = array(
			'post_title'    => 'PDP Comment',
			'post_type'     => 'author_functions',
			'post_status'   => 'publish',

		);
		$add_post = wp_insert_post($pagedata);

		if (!is_wp_error($add_post)) {
			$category_slug = 'academicrecorde-slug	';
			$category = get_term_by('slug', $category_slug, 'category');
			if ($category) {
				wp_set_post_categories($add_post, array($category->term_id));
			}
		}

	}


	restore_current_blog();


}