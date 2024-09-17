<?php 


function get_user_access_read($nereye){
	$current_user_id = get_current_user_id();
	$post_all_modules = get_page_by_path($nereye, OBJECT, 'author_functions'); 
	if ($post_all_modules) {
		$post_all_modules_acf = get_field('read', $post_all_modules->ID);
		if ($post_all_modules_acf) {
			if (in_array($current_user_id, $post_all_modules_acf)) {
				return in_array($current_user_id, $post_all_modules_acf);
			}
		}
	}
}


function get_user_access_write($nereye){
	$current_user_id = get_current_user_id();
	$post_all_modules = get_page_by_path($nereye, OBJECT, 'author_functions'); 
	if ($post_all_modules) {
		$post_all_modules_acf = get_field('write_users', $post_all_modules->ID);
		if ($post_all_modules_acf) {
			if (in_array($current_user_id, $post_all_modules_acf)) {
				return in_array($current_user_id, $post_all_modules_acf);
			}
		}
	}
}


function get_user_access_delete($nereye){
	$current_user_id = get_current_user_id();
	$post_all_modules = get_page_by_path($nereye, OBJECT, 'author_functions'); 
	if ($post_all_modules) {
		$post_all_modules_acf = get_field('delete', $post_all_modules->ID);
		if ($post_all_modules_acf) {
			if (in_array($current_user_id, $post_all_modules_acf)) {
				return in_array($current_user_id, $post_all_modules_acf);
			}
		}
	}
}


function get_teacher_access($class,$subject){
	$current_user_id = get_current_user_id();
	$group_admin = get_field("group_admin",$class);
	if ($group_admin) {
		$group_admin_id = [];
		foreach ($group_admin as $key => $value) {
			$group_admin_id[$key] = $value['ID'];
		}
		if (in_array($current_user_id, $group_admin_id)) {
			$subject_admin = get_field("subject_admin",$subject);
			$subject_admin_id = [];
			foreach ($subject_admin as $keys => $values) {
				$subject_admin_id[$keys] = $values['ID'];
			}
			if (in_array($current_user_id, $subject_admin_id)) {
				return true;
			}
		}
	}
}


