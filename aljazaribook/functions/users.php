<?php 
//Disable admin bar for specific user roles
add_action('after_setup_theme', 'remove_admin_bar_for_subs');
function remove_admin_bar_for_subs() {
	if (current_user_can('subscriber') && !is_admin()) {
		show_admin_bar(false);
	}
}

add_action('init', function(){

	add_role('principal','Principal');
	//remove_role('principal');
	$principal = get_role('principal');
	
	/*$pdp->add_cap('read');
	$pdp->add_cap('edit_newClassCaps');
	$pdp->add_cap('edit_newClassCap');
	$pdp->add_cap('edit_others_newClassCap');
	$pdp->add_cap('edit_others_newClassCaps');
	$pdp->remove_cap('edit_newClassCaps');*/

});


add_action('init', function(){

	add_role('viceprincipal','Vice Principal');
	//remove_role('viceprincipal');
	$viceprincipal = get_role('viceprincipal');
	
	/*$pdp->add_cap('read');
	$pdp->add_cap('edit_newClassCaps');
	$pdp->add_cap('edit_newClassCap');
	$pdp->add_cap('edit_others_newClassCap');
	$pdp->add_cap('edit_others_newClassCaps');
	$pdp->remove_cap('edit_newClassCaps');*/

});


add_action('init', function(){

	add_role('hod','HOD');
	//remove_role('hod');
	$hod = get_role('hod');
	
	/*$pdp->add_cap('read');
	$pdp->add_cap('edit_newClassCaps');
	$pdp->add_cap('edit_newClassCap');
	$pdp->add_cap('edit_others_newClassCap');
	$pdp->add_cap('edit_others_newClassCaps');
	$pdp->remove_cap('edit_newClassCaps');*/

});


add_action('init', function(){

	add_role('pdp','PDP');
	//remove_role('pdp');
	$pdp = get_role('pdp');
	
	/*$pdp->add_cap('read');
	$pdp->add_cap('edit_newClassCaps');
	$pdp->add_cap('edit_newClassCap');
	$pdp->add_cap('edit_others_newClassCap');
	$pdp->add_cap('edit_others_newClassCaps');
	$pdp->remove_cap('edit_newClassCaps');*/

});

add_action('init', function(){

	add_role('studentaff','Student Affairs');
	//remove_role('pdp');
	$studentaff = get_role('studentaff');
	
	/*$pdp->add_cap('read');
	$pdp->add_cap('edit_newClassCaps');
	$pdp->add_cap('edit_newClassCap');
	$pdp->add_cap('edit_others_newClassCap');
	$pdp->add_cap('edit_others_newClassCaps');
	$pdp->remove_cap('edit_newClassCaps');*/

});

add_action('init', function(){

	add_role('it','IT');
	//remove_role('it');
	$it = get_role('it');
	
	/*$student->add_cap('read');
	$student->add_cap('edit_newClassCaps');
	$student->add_cap('edit_newClassCap');
	$student->add_cap('edit_others_newClassCap');
	$student->add_cap('edit_others_newClassCaps');
	$student->remove_cap('edit_newClassCaps');*/

});

add_action('init', function(){

	add_role('teacher','Teacher');
	//remove_role('teacher');
	$teacher = get_role('teacher');
	
	/*$teacher->add_cap('read');
	$teacher->add_cap('edit_newClassCaps');
	$teacher->add_cap('edit_newClassCap');
	$teacher->add_cap('edit_others_newClassCap');
	$teacher->add_cap('edit_others_newClassCaps');
	$teacher->remove_cap('edit_newClassCaps');*/

});


add_action('init', function(){

	add_role('student','Student');
	//remove_role('student');
	$student = get_role('student');
	
	/*$student->add_cap('read');
	$student->add_cap('edit_newClassCaps');
	$student->add_cap('edit_newClassCap');
	$student->add_cap('edit_others_newClassCap');
	$student->add_cap('edit_others_newClassCaps');
	$student->remove_cap('edit_newClassCaps');*/

});





