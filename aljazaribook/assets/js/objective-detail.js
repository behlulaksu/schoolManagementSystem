$(".quarter_1_popup").click(function(){ 
	class_students = [];
	hersey = [];

	popupid = $(this).attr('uniteID');
	popupall = $('#modal_q1_'+popupid+' [student]');
	objective_length = $('#modal_q1_'+popupid+' thead .objectives');

	for (var i = popupall.length - 1; i >= 0; i--) {
		class_students[i] = $('#modal_q1_'+popupid+' [student]')[i].attributes.student.value;
	}
	
	for (var a = 0; a < class_students.length; a++) {
		hersey[a] = [];
		for (var i = 0; i < objective_length.length; i++) {
			hersey[a][i] = $('#modal_q1_'+popupid+' tbody [student="'+class_students[a]+'"] [objectiveID]')[i].value;
		}
	}




	//console.log(hersey);
	//console.log(class_students);
	//console.log(teacher_id);

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_studetn_objective_save',
			class_id:class_id,
			quarter_id:1,
			unite_id:popupid,
			teacher_id:teacher_id,


			hersey:hersey,
			class_students_id:class_students,

		}),
		success: function(data){
			console.log(data);
		}

	});



});



$(".quarter_2_popup").click(function(){ 
	class_students = [];
	hersey = [];

	popupid = $(this).attr('uniteID');
	popupall = $('#modal_q2_'+popupid+' [student]');
	objective_length = $('#modal_q2_'+popupid+' thead .objectives');

	for (var i = popupall.length - 1; i >= 0; i--) {
		class_students[i] = $('#modal_q2_'+popupid+' [student]')[i].attributes.student.value;
	}
	
	for (var a = 0; a < class_students.length; a++) {
		hersey[a] = [];
		for (var i = 0; i < objective_length.length; i++) {
			hersey[a][i] = $('#modal_q2_'+popupid+' tbody [student="'+class_students[a]+'"] [objectiveID]')[i].value;
		}
	}



	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_studetn_objective_save',
			class_id:class_id,
			quarter_id:2,
			unite_id:popupid,
			teacher_id:teacher_id,


			hersey:hersey,
			class_students_id:class_students,

		}),
		success: function(data){
			console.log(data);
		}

	});



});



$(".quarter_3_popup").click(function(){ 
	class_students = [];
	hersey = [];

	popupid = $(this).attr('uniteID');
	popupall = $('#modal_q3_'+popupid+' [student]');
	objective_length = $('#modal_q3_'+popupid+' thead .objectives');

	for (var i = popupall.length - 1; i >= 0; i--) {
		class_students[i] = $('#modal_q3_'+popupid+' [student]')[i].attributes.student.value;
	}
	
	for (var a = 0; a < class_students.length; a++) {
		hersey[a] = [];
		for (var i = 0; i < objective_length.length; i++) {
			hersey[a][i] = $('#modal_q3_'+popupid+' tbody [student="'+class_students[a]+'"] [objectiveID]')[i].value;
		}
	}



	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_studetn_objective_save',
			class_id:class_id,
			quarter_id:3,
			unite_id:popupid,
			teacher_id:teacher_id,


			hersey:hersey,
			class_students_id:class_students,

		}),
		success: function(data){
			console.log(data);
		}

	});



});


$(".quarter_4_popup").click(function(){ 
	class_students = [];
	hersey = [];

	popupid = $(this).attr('uniteID');
	popupall = $('#modal_q4_'+popupid+' [student]');
	objective_length = $('#modal_q4_'+popupid+' thead .objectives');

	for (var i = popupall.length - 1; i >= 0; i--) {
		class_students[i] = $('#modal_q4_'+popupid+' [student]')[i].attributes.student.value;
	}
	
	for (var a = 0; a < class_students.length; a++) {
		hersey[a] = [];
		for (var i = 0; i < objective_length.length; i++) {
			hersey[a][i] = $('#modal_q4_'+popupid+' tbody [student="'+class_students[a]+'"] [objectiveID]')[i].value;
		}
	}

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_studetn_objective_save',
			class_id:class_id,
			quarter_id:4,
			unite_id:popupid,
			teacher_id:teacher_id,


			hersey:hersey,
			class_students_id:class_students,

		}),
		success: function(data){
			console.log(data);
		}

	});



});