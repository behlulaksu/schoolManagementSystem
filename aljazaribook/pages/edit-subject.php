<?php /* Template Name: Edit Subject */ ?>

<?php 
if (isset($_GET['subject'])){
	$subject = strip_tags($_GET["subject"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
?>
<?php get_header(); ?>
<!-- choices css -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.css">
<?php $current_user_id = get_current_user_id(); ?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?> / <?php echo get_the_title($subject); ?>
					</h4>
				</div>
			</div>
			<?php  
			if (get_user_access_write('list-subject')) {
				?>
				<div class="grid grid-cols-12 gap-5">
					<div class="col-span-12 xl:col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body"> 

								<div class="grid gap-12 mb-12 md:grid-cols-1">
									<h5 class="text-sm text-gray-700 dark:text-gray-100 mb-3">
										Subject Teacher 
									</h5>
									<div class="grid grid-cols-12 gap-5">
										<div class="col-span-12 lg:col-span-12">
											<select class="choice_place" data-trigger name="choices-multiple-default" id="subject-admins" multiple>
												<?php 
												$get_group_teachers = get_field("subject_admin",$subject);
												foreach ($get_group_teachers as $key => $value) {
													?>
													<option value="<?php echo $value['user_email']; ?>" selected>
														<?php echo $value['user_email']; ?>
													</option>
													<?php 
												}
												$args = array(
													'role__not_in' => ['student','studentaff','it']
												);
												$users = get_users($args);

												foreach ($users as $key => $value) {
													?>
													<option value="<?php echo $value->data->user_email; ?>">
														<?php echo $value->data->user_email; ?>
													</option>
													<?php 
												} 
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="mb-4">
									<div class="mb-3">
										<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
											Subject Category
										</label>
										<select id="subject-type" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
											<?php  
											$lesson_type_args = [
												'post_type'		=> 'lesson_type_function',
												'numberposts'	=> -1
											];
											$lesson_types = get_posts($lesson_type_args);
											$selected_lesson = get_field("select_lesson_type",$subject);
											foreach ($lesson_types as $key => $value) {
												if ($selected_lesson[0]->post_title == $value->post_title) {
													?>
													<option value="<?php echo $value->ID; ?>" selected>
														<?php echo $value->post_title; ?>
													</option>
													<?php 
												}else{
													?>
													<option value="<?php echo $value->ID; ?>">
														<?php echo $value->post_title; ?>
													</option>
													<?php 
												}

											}
											?>
										</select>

									</div>
								</div>
								<div class="mb-4">
									<div class="mb-3">
										<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
											Subject Assesment Type
										</label>
										<select id="gradebook_definition" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
											<?php  
											$lesson_type_args = [
												'post_type'		=> 'gradebook_function',
												'numberposts'	=> -1
											];
											$lesson_types = get_posts($lesson_type_args);
											$selected_lesson = get_field("select_gradebook_definition",$subject);
											foreach ($lesson_types as $key => $value) {
												if ($selected_lesson[0]->post_title == $value->post_title) {
													?>
													<option value="<?php echo $value->ID; ?>" selected>
														<?php echo $value->post_title; ?>
													</option>
													<?php 
												}else{
													?>
													<option value="<?php echo $value->ID; ?>">
														<?php echo $value->post_title; ?>
													</option>
													<?php 
												}

											}
											?>
										</select>
									</div>
								</div>
								<div class="mb-4">
									<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
										Description
									</label>
									<textarea id="subject_description" rows="2" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"><?php echo get_field("subject_description",$subject); ?></textarea>
								</div>

								<button id="update_subject" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
									Update Subject
								</button>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}else{
				echo access_denieded($current_user_id,'edit-subject','list-subject');
			}
			?>
			<div class="col-span-12 xl:col-span-6">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body pb-0">
						<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
							Subjcet Comments
						</h6>
					</div>
					<div class="card-body flex flex-wrap">
						<div class="nav-tabs tab-pill" style="width: 100%;">
							<ul style="justify-content: space-evenly;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500">
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-home" class="inline-block px-4 py-3 rounded-md active">
										Quarter 1
									</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-Profile" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">
										Quarter 2
									</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-setting" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">
										Quarter 3
									</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-contact" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">
										Quarter 4
									</a>
								</li>
							</ul>

							<div class="tab-content mt-5">
								<div class="tab-pane block" id="tab-pills-home">
									<div class="card-body"> 
										<div class="relative overflow-x-auto">
											<table class="w-full text-sm text-left text-gray-500 ">
												<thead class="text-sm text-gray-700 dark:text-gray-100">
													<tr class="border border-gray-50 dark:border-zinc-600">
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															#
														</th>
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															Comment
														</th>
													</tr>
												</thead>
												<tbody>
													<?php  
													if(have_rows('add_subject_comment_q1', $subject)): 
														while(have_rows('add_subject_comment_q1', $subject)): 
															the_row(); 
															?>
															<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	<?php echo get_row_index(); ?>
																</th>
																<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																	<?php echo get_sub_field("comment"); ?>
																</td>
															</tr>
															<?php  
														endwhile; 
													endif;
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane hidden" id="tab-pills-Profile">
									<div class="card-body"> 
										<div class="relative overflow-x-auto">
											<table class="w-full text-sm text-left text-gray-500 ">
												<thead class="text-sm text-gray-700 dark:text-gray-100">
													<tr class="border border-gray-50 dark:border-zinc-600">
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															#
														</th>
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															Comment
														</th>
													</tr>
												</thead>
												<tbody>
													<?php  
													if(have_rows('add_subject_comment_q2', $subject)): 
														while(have_rows('add_subject_comment_q2', $subject)): 
															the_row(); 
															?>
															<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	<?php echo get_row_index(); ?>
																</th>
																<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																	<?php echo get_sub_field("comment"); ?>
																</td>
															</tr>
															<?php  
														endwhile; 
													endif;
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane hidden" id="tab-pills-setting">
									<div class="card-body"> 
										<div class="relative overflow-x-auto">
											<table class="w-full text-sm text-left text-gray-500 ">
												<thead class="text-sm text-gray-700 dark:text-gray-100">
													<tr class="border border-gray-50 dark:border-zinc-600">
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															#
														</th>
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															Comment
														</th>
													</tr>
												</thead>
												<tbody>
													<?php  
													if(have_rows('add_subject_comment_q3', $subject)): 
														while(have_rows('add_subject_comment_q3', $subject)): 
															the_row(); 
															?>
															<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	<?php echo get_row_index(); ?>
																</th>
																<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																	<?php echo get_sub_field("comment"); ?>
																</td>
															</tr>
															<?php  
														endwhile; 
													endif;
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane hidden" id="tab-pills-contact">
									<div class="card-body"> 
										<div class="relative overflow-x-auto">
											<table class="w-full text-sm text-left text-gray-500 ">
												<thead class="text-sm text-gray-700 dark:text-gray-100">
													<tr class="border border-gray-50 dark:border-zinc-600">
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															#
														</th>
														<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
															Comment
														</th>
													</tr>
												</thead>
												<tbody>
													<?php  
													if(have_rows('add_subject_comment_q4', $subject)): 
														while(have_rows('add_subject_comment_q4', $subject)): 
															the_row(); 
															?>
															<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	<?php echo get_row_index(); ?>
																</th>
																<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																	<?php echo get_sub_field("comment"); ?>
																</td>
															</tr>
															<?php  
														endwhile; 
													endif;
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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

<script>
	function isInt(value) {
		return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
	}
	function update_subjects(){
		subject_admins = $("#subject-admins").val();
		subject_type = $("#subject-type").val();
		subject_description = $("#subject_description").val();
		gradebook_definition = $("#gradebook_definition").val();

		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_update_subjects',

				postID:<?php echo $subject; ?>,
				subject_admins:subject_admins,
				subject_type:subject_type,
				subject_description:subject_description,
				gradebook_definition:gradebook_definition,

			}),
			success: function(data){
				if (data.data === 'ture') {
					alert("calisti");
				}
				if (isInt(data.data)) {
					location.reload();
				}
				console.log(data.data);
			}

		});


	}

	$("#update_subject").click(function(){
		update_subjects();
	});
</script>