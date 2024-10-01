<?php /* Template Name: Counselling Notes */ ?>
<?php $current_user_now = wp_get_current_user(); ?>
<?php $current_user_id = get_current_user_id(); ?>
<?php 
if (isset($_GET['student'])){
	$student = strip_tags($_GET["student"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}

if (isset($_GET['group'])){
	$group = strip_tags($_GET["group"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
?>
<?php $current_user_edit_meta = get_user_meta($student); ?>
<?php get_header(); ?>
<!-- choices css -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/icons.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind.css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="flex items-center justify-between" style="margin-bottom: 20px;">
				<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center; color: #8f1537 !important;">
					
					<img style="max-width: 50px; margin-right: 20px;" src="<?php echo get_field('user_image', 'user_'.$student); ?>" alt="">
					<?php echo get_the_title($group); ?>
					<?php 
					$class_advisors = get_field("class_advisors",$group);					
					if (!empty($class_advisors)) {
						?>
						<span style="color: #244b5a;">
							<?php 
							foreach ($class_advisors as $key => $value) {
								echo "- ";
								print_r($value['display_name']);
								echo " ";
							}
							?>
						</span>
						<?php 
					}
					?>
				</h4>
				<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600" data-tw-toggle="modal" data-tw-target="#modal-id_form">
					<i class="bx bx-add-to-queue bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
					<span class="px-3 leading-[2.8]">
						Add New
					</span>
				</button>
			</div>
			<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
				<thead>
					<tr>
						<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
							Date & Time
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Teacher
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Note Type
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Interview
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Visible
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Private
						</th>
						<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Counselling Note
						</th>
						<th class="p-4 pr-8 border rtl:border-l border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
							Delete
						</th>

					</tr>
				</thead>
				<tbody>
					<?php  
					$bg_table_name = "counselling_note";
					$blog_id = get_current_blog_id();
					$query = $wpdb->prepare("SELECT * from $bg_table_name where domain_id =".$blog_id." and student_id =".$student." and delete_status = 0 ORDER BY id DESC");
					$sonuclar1 = $wpdb->get_results($query);

					if ($current_user_now->roles[0] === "administrator" || $current_user_now->roles[0] === "pdp") {
						$query = $wpdb->prepare("SELECT * from $bg_table_name where domain_id =".$blog_id." and student_id =".$student." and delete_status = 0 ORDER BY id DESC");
						$sonuclar1 = $wpdb->get_results($query);
					}elseif($current_user_now->roles[0] === "teacher"){
						$grade_advisor_check = false;
						foreach ($class_advisors as $key => $value) {
							if ($value['ID'] == $current_user_id) {
								$grade_advisor_check = true;
							}
						}

						// for grade advisors
						if ($grade_advisor_check) {
							$query = $wpdb->prepare("SELECT * from $bg_table_name where domain_id =".$blog_id." and student_id =".$student." and delete_status = 0 ORDER BY id DESC");
							$sonuclar1 = $wpdb->get_results($query);
						}else{
							$query = $wpdb->prepare("SELECT * from $bg_table_name where domain_id =".$blog_id." and teacher_id =".$current_user_id." and student_id =".$student." and delete_status = 0 ORDER BY id DESC");
							$sonuclar1 = $wpdb->get_results($query);
						}
						
					}



					foreach ($sonuclar1 as $key => $value) {
						?>
						<tr>
							<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
								<span style="color: red; font-weight: bold; ">
									<?php echo $value->targete_day; ?>
								</span>
								<hr>
								<?php echo $value->update_date; ?> <br>
								<?php echo $value->update_time; ?>
							</td>
							<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php  
								$teacher = get_user_meta($value->teacher_id);
								echo $teacher['first_name'][0];
								echo " ";
								echo $teacher['last_name'][0];
								?>
							</td>
							<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php echo $value->note_type; ?>
							</td>
							<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php echo $value->interview; ?>
							</td>
							<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php echo $value->visible; ?>
							</td>
							<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php echo $value->private; ?>
							</td>
							<td style="text-align: left;" class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<?php echo $value->note; ?>
							</td>
							<td class="p-4 pr-8 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
								<button type="button" commnet_id="<?php echo $value->id; ?>" class="delete_counsilling_comment btn border-0 bg-red-400 text-white px-5">
									<i class="mdi mdi-trash-can block text-lg"></i>
									<span class="">Delete</span>
								</button>
							</td>
						</tr>
						<?php 
					}
					?>
				</tbody>
			</table>
			<?php  
			if ($current_user_now->roles[0] === 'administrator') {
				?>
				<h5 class="font-semibold text-red-700 dark:text-red-100 text-lg" style="margin-top: 60px;">Deleted Comments</h5>
				<table style="margin-top: 15px;" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
					<thead>
						<tr>
							<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
								ID
							</th>
							<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
								Deleted Date & Time
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Deleted By
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Note Type
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Interview
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Visible
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Private
							</th>
							<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Counselling Note
							</th>
							<th class="p-4 pr-8 border rtl:border-l border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
								Take It Back
							</th>

						</tr>
					</thead>
					<tbody>
						<?php  
						$bg_table_name = "counselling_note";
						$blog_id = get_current_blog_id();


						$query = $wpdb->prepare("SELECT * from $bg_table_name where domain_id =".$blog_id." and student_id =".$student." and delete_status = 1 ORDER BY id DESC");

						
						$sonuclar1 = $wpdb->get_results($query);
						foreach ($sonuclar1 as $key => $value) {
							?>
							<tr>
								<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->id; ?>
								</td>
								<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
									<span style="color: red; font-weight: bold; ">
										<?php echo $value->targete_day; ?>
									</span>
									<hr>
									<?php echo $value->update_date; ?> <br>
									<?php echo $value->update_time; ?>
								</td>
								<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php  
									$teacher = get_user_meta($value->teacher_id);
									echo $teacher['first_name'][0];
									echo " ";
									echo $teacher['last_name'][0];
									?>
								</td>
								<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->note_type; ?>
								</td>
								<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->interview; ?>
								</td>
								<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->visible; ?>
								</td>
								<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->private; ?>
								</td>
								<td style="text-align: left;" class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<?php echo $value->note; ?>
								</td>
								<td class="p-4 pr-8 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
									<button type="button" commnet_id="<?php echo $value->id; ?>" class="take_it_back btn border-0 bg-yellow-400 text-white px-5">
										<i class="mdi mdi-backup-restore block text-lg"></i>
										<span class="">Restore</span>
									</button>
								</td>
							</tr>
							<?php 
						}
						?>
					</tbody>
				</table>
				<?php 
			}

			?>

		</div>
	</div>
</div>


<div class="modal relative z-50 hidden" id="modal-id_form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-lg mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button id="close_main_popop" type="button" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
							<?php echo $current_user_edit_meta['first_name'][0]; ?> <?php echo $current_user_edit_meta['last_name'][0]; ?>
						</h3>
						<div class="mb-3" style="display: flex; justify-content: space-between;">
							<div style="width: 48%;">
								<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Private</label>
								<select id="private_type" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option value="Non Private">Non Private</option>
									<option value="Private">Private</option>
								</select>
							</div>
							<div style="width: 48%;">
								<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Note Type</label>
								<select id="note_type" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option value="Information note">Information note</option>
									<option value="Counsellor Opinion">Counsellor Opinion</option>
									<option value="Teacher Opinion">Teacher Opinion</option>
									<option value="Assist. Director Opinion">Assist. Director Opinion</option>
									<option value="Director Opinion">Director Opinion</option>
									<option value="Information note">Information note</option>
								</select>
							</div>
						</div>
						<div class="mb-3" style="display: flex; justify-content: space-between;">
							<div style="width: 48%;">
								<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Interviewed</label>
								<select id="interviewed" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option value="Student">Student</option>
									<option value="Parent">Parent</option>
									<option value="All">All</option>
								</select>
							</div>
							<div style="width: 48%;">
								<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Visible</label>
								<select id="visivle_type" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option value="None">None</option>
									<option value="Student">Student</option>
									<option value="Teachers">Teachers</option>
									<option value="All">All</option>
								</select>
							</div>
						</div>
						<div class="mb-3">
							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Counselling Time
							</label>
							<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" id="counselling_time">
						</div>
						<div class="mb-3">
							<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Counselling Note</label>
							<textarea rows="8" id="counselling_note" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"></textarea>
						</div>

						<div class="mt-6">
							<button id="add_new_counselling_note" type="submit" class="btn bg-green-600 text-white border-transparent w-full">
								Save Counselling Note
							</button>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	td{
		text-align: center;
	}
	#datatable-buttons td{
		padding: 10px !important;
		font-size: 13px !important;
	}
</style>


<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>

<!-- choices js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Required datatable js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/datatables.init.js"></script> 

<script>
	$(document).ready(function(){
		$("#header_title").text("Counselling Notes : <?php echo $current_user_edit_meta['first_name'][0]; ?> <?php echo $current_user_edit_meta['last_name'][0]; ?>");

		$(".take_it_back").click(function () {
			commnet_id = $(this).attr("commnet_id");
			Swal.fire({
				title: "Are you sure?",
				text: 'They can see it again',
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes, Restore it"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_new_counsilling_restore',
							commnet_id:commnet_id,
						}),
						success: function(data){
							location.reload();
						}
					});

				}
			});
		});

		$(".delete_counsilling_comment").click(function () {
			commnet_id = $(this).attr("commnet_id");
			Swal.fire({
				title: "Are you sure?",
				text: 'You can not take it back!',
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes, Delete!"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_new_counsilling_delete',
							commnet_id:commnet_id,
						}),
						success: function(data){
							location.reload();
						}
					});

				}
			});
		});

		$("#add_new_counselling_note").click(function () {
			note_type = $("#note_type").val();
			interviewed = $("#interviewed").val();
			visivle_type = $("#visivle_type").val();
			private_type = $("#private_type").val();
			counselling_note = $("#counselling_note").val();
			counselling_time = $("#counselling_time").val();
			alert_message = "You will be adding new comment as Note Type: '"+note_type+"', Visible: '"+visivle_type+"' and Private: '"+private_type+"'";

			if (counselling_note != "") {
				Swal.fire({
					title: "Are you sure?",
					text: alert_message,
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#2ab57d",
					cancelButtonColor: "#fd625e",
					confirmButtonText: "Yes, add"
				}).then(function (result) {
					if (result.value) {
						var value = $.ajax({
							method: "POST",
							url: get_site_url+'/wp-admin/admin-ajax.php',
							data: ({action:'my_ajax_new_counsilling_note',
								note_type:note_type,
								interviewed:interviewed,
								visivle_type:visivle_type,
								private_type:private_type,
								counselling_note:counselling_note,
								counselling_time:counselling_time,
								stundet_id:<?php echo $student; ?>,
							}),
							success: function(data){
								Swal.fire("Student moved to target class").then(location.reload());
							}
						});
						
					}
				});
			}else{
				Swal.fire({
					title: "Counselling Note is empty",
					icon: "warning",
					showCancelButton: false,
					confirmButtonColor: "#fd625e",
				})
			}


		});

	});
</script>