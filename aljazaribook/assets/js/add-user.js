$(document).ready(function(){
	function useraddedsussess(e){
		onaybutonuMetin = '<div class="px-5 py-2 flex items-center bg-green-50 rounded alert-dismissible"><p class="text-green-600"><i class="bx bx-check-circle text-xl align-middle ltr:mr-2 rtl:ml-2"></i><span class="align-middle">New User Added. You can see the details</span></p><a href="'+get_site_url+'/edit-user?user='+e+'" style="margin-left: auto;" ><button class="alert-close ltr:ml-auto rtl:mr-auto text-green-600 align-middle mt-1 font-semibold">Details<i class="bx bx-right-arrow-alt align-middle text-lg ml-1"></i></button></a></div>';
		$('.onaybutonu').append(onaybutonuMetin);
		
	}
	function user_update_sussess(e){
		onaybutonuMetin = '<div class="px-5 py-2 flex items-center bg-green-50 rounded alert-dismissible"><p class="text-green-600"><i class="bx bx-check-circle text-xl align-middle ltr:mr-2 rtl:ml-2"></i><span class="align-middle">The User Updated.</span></p></div>';
		$('.onaybutonu').append(onaybutonuMetin);
		
	}

	function userRegisterFunction(){
		function isInt(value) {
			return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
		}

		first_name = $("#first_name").val();
		last_name = $("#last_name").val();
		tc = $("#tc").val();
		schoolno = $("#schoolno").val();
		gender = $("#gender").val();
		birthday = $("#birthday").val();
		studentgrade = $("#studentgrade").val();
		email = $("#email").val();
		userpassword = $("#userpassword").val();
		userrole = $("#userrole").val();


		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_create_users_manuel',


				first_name:first_name,
				last_name:last_name,
				tc:tc,
				schoolno:schoolno,
				gender:gender,
				birthday:birthday,
				studentgrade:studentgrade,
				email:email,
				userpassword:userpassword,
				userrole:userrole,

			}),
			success: function(data){
				console.log(data);
				if (isInt(data.data)) {
					useraddedsussess(data.data);
					console.log("yeni kisi eklendi ve id si"+data.data);
				}else{
					alert("User is exist");
				}

			}

		});
	}

	function userUpdateFunction(){
		function isInt(value) {
			return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
		}

		first_name = $("#first_name").val();
		last_name = $("#last_name").val();
		tc = $("#tc").val();
		schoolno = $("#schoolno").val();
		gender = $("#gender").val();
		registerdate = $("#registerdate").val();
		birthday = $("#birthday").val();
		studentgrade = $("#studentgrade").val();
		email = $("#email").val();
		user_sites = $("#user_sites").val();
		user_role = $("#user_role").val();
		asc_time_table_id = $("#asc_time_table_id").val();
		teacher_subject = $("#teacher_subject").val();
		console.log(teacher_subject);
		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_update_users_manuel',


				first_name:first_name,
				last_name:last_name,
				tc:tc,
				schoolno:schoolno,
				gender:gender,
				registerdate:registerdate,
				birthday:birthday,
				studentgrade:studentgrade,
				email:email,
				user_role:user_role,
				user_sites:user_sites,
				asc_time_table_id:asc_time_table_id,
				teacher_subject:teacher_subject

			}),
			success: function(data){
				console.log(data);
				if (isInt(data.data)) {
					user_update_sussess(data.data);
				}else{
					alert("There is a problem, please countact with IT.");
				}
			}

		});
	}


	$("#create_user").click(function(){
		userRegisterFunction();
	});
	$("#update_user").click(function(){
		userUpdateFunction();
	});
});


