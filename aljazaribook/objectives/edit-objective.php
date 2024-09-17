<?php /* Template Name: Edit Objective */ ?>
<?php get_header(); ?>
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
<?php 
if (isset($_GET['obj'])){
	$obj = strip_tags($_GET["obj"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$bg_table_name = "objectives_define";
$query = $wpdb->prepare("SELECT * from $bg_table_name where id=".$obj);
$sonuclar1 = $wpdb->get_results($query)[0];
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700"  style="width: 100%; height: 100%;">
		<div class="container-fluid px-[0.625rem]"  style="width: 100%; height: 100%;">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center; color: #8f1537 !important;">
						Edit Objective
					</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="grid grid-cols-12 gap-5">
					<div class="col-span-12 lg:col-span-6">
						<div class="mb-4" style="display: none;">
							<label for="object_title" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Object Title
							</label>
							<input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" value="<?php echo $sonuclar1->objecttive_title; ?>" type="text" id="object_title">
						</div>
						<div class="mb-4">
							<label for="object_curricullum" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Curriculum
							</label>
							<input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" value="<?php echo $sonuclar1->object_curricullum; ?>" type="text" id="object_curricullum">
						</div>
						<div class="mb-4">
							<label for="object_skill" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Object Skill / Assessment category
							</label>
							<input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" value="<?php echo $sonuclar1->object_skill; ?>" type="text" id="object_skill">
						</div>
						<div class="mb-4">
							<label for="object_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Object Code 1
							</label>
							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" value="<?php echo $sonuclar1->code1; ?>" type="text" id="object_code">
						</div>
						<div class="mb-4">
							<label for="object_code_2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Object Code 2
							</label>
							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" value="<?php echo $sonuclar1->code2; ?>" type="text" id="object_code_2">
						</div>
						<div class="mb-4">
							<div class="mb-3">
								<label for="select_grade" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
									Grade
								</label>
								<select id="select_grade" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option <?php if($sonuclar1->grade === "KG 1"){echo "selected";} ?> value="KG 1">KG 1</option>
									<option <?php if($sonuclar1->grade === "KG 2"){echo "selected";} ?> value="KG 2">KG 2</option>
									<option <?php if($sonuclar1->grade === "1"){echo "selected";} ?> value="1">1</option>
									<option <?php if($sonuclar1->grade === "2"){echo "selected";} ?> value="2">2</option>
									<option <?php if($sonuclar1->grade === "3"){echo "selected";} ?> value="3">3</option>
									<option <?php if($sonuclar1->grade === "4"){echo "selected";} ?> value="4">4</option>
									<option <?php if($sonuclar1->grade === "5"){echo "selected";} ?> value="5">5</option>
									<option <?php if($sonuclar1->grade === "6"){echo "selected";} ?> value="6">6</option>
									<option <?php if($sonuclar1->grade === "7"){echo "selected";} ?> value="7">7</option>
									<option <?php if($sonuclar1->grade === "8"){echo "selected";} ?> value="8">8</option>
									<option <?php if($sonuclar1->grade === "9"){echo "selected";} ?> value="9">9</option>
									<option <?php if($sonuclar1->grade === "10"){echo "selected";} ?> value="10">10</option>
									<option <?php if($sonuclar1->grade === "11"){echo "selected";} ?> value="11">11</option>
									<option <?php if($sonuclar1->grade === "12"){echo "selected";} ?> value="12">12</option>
									<option <?php if($sonuclar1->grade === "General"){echo "selected";} ?> value="General">General</option>
								</select>
							</div>
						</div>
						<div class="mb-4">
							<div class="mb-3">
								<label for="select_subject" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
									Subject
								</label>
								<select id="select_subject" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<?php  

									$lesson_type_args = [
										'post_type'		=> 'lesson_type_function',
										'numberposts'	=> -1
									];
									$lesson_types = get_posts($lesson_type_args);
									foreach ($lesson_types as $key => $value) {
										?>
										<option <?php if($sonuclar1->subject === $value->post_title){echo "selected";} ?> value="<?php echo $value->post_title; ?>">
											<?php echo $value->post_title; ?>
										</option>
										<?php 
									}
									?>
								</select>
							</div>
						</div>


					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="mb-4">
							<label for="object_content" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
								Object Content
							</label>
							<textarea rows="12" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" name="" id="object_content"><?php echo $sonuclar1->objecttive_content; ?></textarea>
						</div>
						<div class="mb-4">
							<div class="card-body"> 
								<div class="relative overflow-x-auto">
									<table class="w-full text-sm text-left text-gray-500 ">
										<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
											<tr>
												<th scope="col" class="px-6 py-3">
													#
												</th>
												<th scope="col" class="px-6 py-3">
													Display Name
												</th>
												<th scope="col" class="px-6 py-3">
													Date & Time
												</th>
												<th scope="col" class="px-6 py-3">
													View
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
												<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Creator
												</th>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php  
													$user_info = get_userdata($sonuclar1->creator_id);
													if ($user_info) {
														echo $user_info->display_name;
													}
													?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 dark:text-zinc-100">
													<?php  
													echo $sonuclar1->create_time;
													echo "<br>";
													echo $sonuclar1->create_date;
													?>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>">
														<button type="button" class="btn text-white bg-yellow-500 border-yellow-500 hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600">
															Outhers
														</button>
													</a>
												</td>
											</tr>
											<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
												<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Last Editor
												</th>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php  
													$user_info = get_userdata($sonuclar1->last_editor_id);
													if ($user_info) {
														echo $user_info->display_name;
													}
													?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 dark:text-zinc-100">
													<?php  
													echo $sonuclar1->edit_time;
													echo "<br>";
													echo $sonuclar1->edit_date;
													?>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>">
														<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
															Outhers
														</button>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
			<button id="edit_objective" class="btn bg-violet-500 block w-full text-white py-3 border-transparent focus:ring focus:ring-violet-500/30 dark:border-zinc-600" type="submit">
				Edit Objective
			</button>



		</div>
	</div>
</div>

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
	$("#edit_objective").click(function () {
		object_title = "--";
		select_grade = $("#select_grade").val();
		select_subject = $("#select_subject").val();
		object_content = $("#object_content").val();
		object_curricullum = $("#object_curricullum").val();
		object_skill = $("#object_skill").val();

		if (object_content != "" && object_code != "" && select_grade != "" && select_subject != "" && object_content != "") {
			Swal.fire({
				title: "You are changeing the objective details",
				text: 'You cannot undo these changes!',
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_edit_objective',

							object_title:object_title,
							select_grade:select_grade,
							select_subject:select_subject,
							object_content:object_content,
							object_curricullum:object_curricullum,
							object_skill:object_skill,
							object_id:<?php echo $obj; ?>,

						}),
						success: function(data){
							Swal.fire("Done.")
						}
					});

				}
			});
		}else{
			alert("Fill in all fields!");
		}


	});
</script>