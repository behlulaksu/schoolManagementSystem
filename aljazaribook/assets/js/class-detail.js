
$(".save_student_nots").click(function(){
	this_button = $(this);
	button_id = this_button.attr("button_filed_id");

	/************************************ Quarter 1 **********************************/
	quarte1_pointArry = [];
  	const quarter1_inputs = $("#quarter1_user_"+button_id+" input");//selected inputs in quarter 1
  	for (var i = quarter1_inputs.length - 1; i >= 0; i--) {
  		quarte1_pointArry[i] = quarter1_inputs[i].value;
  	}

  /************************************ Quarter 2 **********************************/
  	quarte2_pointArry = [];
  const quarter2_inputs = $("#quarter2_user_"+button_id+" input");//selected inputs in quarter 1
  for (var i = quarter2_inputs.length - 1; i >= 0; i--) {
  	quarte2_pointArry[i] = quarter2_inputs[i].value;
  }

  /************************************ Quarter 3 **********************************/
  quarte3_pointArry = [];
  const quarter3_inputs = $("#quarter3_user_"+button_id+" input");//selected inputs in quarter 1
  for (var i = quarter3_inputs.length - 1; i >= 0; i--) {
  	quarte3_pointArry[i] = quarter3_inputs[i].value;
  }

  /************************************ Quarter 4 **********************************/
  quarte4_pointArry = [];
  const quarter4_inputs = $("#quarter4_user_"+button_id+" input");//selected inputs in quarter 1
  for (var i = quarter4_inputs.length - 1; i >= 0; i--) {
  	quarte4_pointArry[i] = quarter4_inputs[i].value;
  }




  var value = $.ajax({
  	method: "POST",
  	url: get_site_url+'/wp-admin/admin-ajax.php',
  	data: ({action:'my_ajax_studetn_point_save',
  		class_id:class_id,
  		button_id:button_id,


  		quarte1_pointArry:quarte1_pointArry,
  		quarte2_pointArry:quarte2_pointArry,
  		quarte3_pointArry:quarte3_pointArry,
  		quarte4_pointArry:quarte4_pointArry,

  	}),
  	success: function(data){
  		console.log(data);
  	}

  });


});