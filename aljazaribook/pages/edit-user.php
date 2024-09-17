<?php /* Template Name: Edit User */ ?>

<?php 
if (isset($_GET['user'])){
	$get_user_id = strip_tags($_GET["user"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$get_user_data = get_user_by('id',$get_user_id);
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



<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?>
						<?php print_r($get_user_data->roles[0]); ?>
					</h4>
				</div>
			</div>

			<?php $current_user_edit_meta = get_user_meta($get_user_id); ?>
			<?php  
			$kullanici = "";
			if ($get_user_data->roles[0] === "student") {
				$kullanici = "students";
			}else{
				$kullanici = "staff";
			}

			if (get_user_access_write($kullanici)) {
				?>
				<div class="grid grid-cols-12 gap-5">
					<div class="col-span-12 xl:col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body"> 
								<div class="grid gap-6 mb-6 md:grid-cols-2">
									<div>
										<label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											First name
										</label>
										<input type="text" id="first_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" required value="<?php echo $current_user_edit_meta['first_name'][0]; ?>">
									</div>
									<div>
										<label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											Last name
										</label>
										<input type="text" id="last_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" required value="<?php echo $current_user_edit_meta['last_name'][0]; ?>">
									</div>
									<div>
										<label for="tc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											TC
										</label>
										<input value="<?php echo get_field('tc', 'user_'.$get_user_data->data->ID); ?>" type="text" id="tc" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="TC" required>
									</div>  
									<div>
										<label for="schoolno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											School No (Eyotek)
										</label>
										<input value="<?php echo get_field('school_no', 'user_'.$get_user_data->data->ID); ?>" type="number" id="schoolno" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="School No" required>
									</div>
									<div>
										<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
											Gender
										</label>
										<select id="gender" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
											<?php  
											if (get_field('gender', 'user_'.$get_user_data->data->ID) === "Male") {
												?>
												<option selected>Male</option>
												<option>Fmale</option>
												<?php 
											}else{
												?>
												<option selected>Fmale</option>
												<option>Male</option>

												<?php 
											}
											?>
										</select>
									</div>
									<div>
										<label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											Birthday
										</label>
										<input value="<?php echo get_field('birthday', 'user_'.$get_user_data->data->ID); ?>" type="date" id="birthday" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Birthday" required>
									</div>
									<div>

										<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Grade</label>
										<select id="studentgrade" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
											<option selected>
												<?php echo get_field('grade', 'user_'.$get_user_data->data->ID); ?>
											</option>
											<option>KG -1</option>
											<option>KG -2</option>
											<option>KG -3</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
											<option>9</option>
											<option>10</option>
											<option>11</option>
											<option>12</option>
										</select>
									</div>
									<div>
										<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											Email
										</label>
										<input value="<?php echo $get_user_data->data->user_email; ?>" type="email" id="email" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Email" required disabled>
									</div>
									<div>
										<label for="asc_time_table_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											ASC Time Table ID
										</label>
										<input value="<?php echo $asc_time_table_id = get_field('asc_time_table_id', 'user_' .$get_user_data->data->ID); ?>" type="text" id="asc_time_table_id" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="ASC ID" required>
									</div>
									<div>
										<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											User Role
										</label>
										<?php 
										$user_info = get_userdata($get_user_data->data->ID);
										if ($user_info) {
											$user_roles = $user_info->roles[0];
											if (empty($user_roles)) {
												$user_roles = $user_info->roles[1];
											}
										} 
										?>
										<input value="<?php print_r($user_roles); ?>" type="text" id="user_role" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Role !" required disabled>
									</div>
									<!-- Get All Groups For This User -->
									<?php  
									$all_groups_args = [
										'post_type' 	=> 'user_groups',
										'meta_query'	=> [

											'key'		=> 'group_users',
											'value'		=> $get_user_id,
											'compare'	=> 'LIKE',

										]
									];
									$all_groups = get_posts($all_groups_args);
									?>

									<?php /* ?>
									<div>
										<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
											Assigned Classes
										</label>
										<?php  
										foreach ($all_groups as $key => $value) {
											?>
											<a target="_Blank" href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo $value->ID; ?>">
												<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
													<?php echo $value->post_title; ?>
												</button>
											</a>
											<?php 
										}
										?>
									</div>
									<?php */ ?>


									<div>
										<div class="col-span-12 lg:col-span-4">
											<div class="mb-3">
												<div class="mb-2">
													<label for="teacher_subject" class="form-label text-13 font-medium text-gray-500 dark:text-zinc-100">
														Subject
													</label>
												</div>
												<select class="choice_place" data-trigger name="teacher_subject" id="teacher_subject" placeholder="Select Subject"  multiple>
													<?php 
													$teacher_subject = get_field('subjects_' . $blog_id, 'user_' . $get_user_id);
													foreach ($teacher_subject as $key => $value) {
														?>
														<option selected value="<?php echo($value); ?>">
															<?php echo get_the_title($value); ?>
														</option>
														<?php 
													}

													$lesson_type_args = [
														'post_type'		=> 'lesson_type_function',
														'numberposts'	=> -1
													];
													$lesson_types = get_posts($lesson_type_args);
													foreach ($lesson_types as $key => $value) {
														?>
														<option value="<?php echo $value->ID; ?>">
															<?php echo $value->post_title; ?>
														</option>
														<?php 
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div>
										<div class="col-span-12 lg:col-span-4">
											<div class="mb-3">
												<label for="user_sites" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
													Authorization
												</label>
												<select class="choice_place" data-trigger name="choices-multiple-default" id="user_sites" multiple>
													<?php  
													$user_all_sites = get_blogs_of_user($get_user_id);
													foreach ($user_all_sites as $keys => $values) {
														?>
														<option value="<?php echo $values->path; ?>" selected>
															<?php echo $values->path; ?>
														</option>
														<?php 
													}


													$all_multi_sites = get_sites();
													foreach ($all_multi_sites as $key => $value) {
														?>
														<option value="<?php echo $value->path; ?>">
															<?php echo $value->path; ?>
														</option>
														<?php 
													}
													?>
												</select>
											</div>

										</div>
									</div>
									<div>
										<div class="col-span-12 lg:col-span-4">
											<div class="mb-3">
												<label for="user_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
													User Image
												</label>
												<input id="user_image" type="file" accept=".jpg, .jpeg, .png" size="2000000">
												<img style="max-width: 400px;" class="mt-2" id="user_image_now" src="<?php echo get_field("user_image",'user_'.$get_user_data->data->ID); ?>" alt="">
											</div>
											
										</div>
									</div>

								</div>


							</div>
							<button id="update_user" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
								Update
							</button>

							<div class="onaybutonu" style="margin-top: 50px;"></div>

						</div>
					</div>
				</div>
			</div>
			<?php 
		}else{
			echo access_denieded($get_user_id,"edit-user",$kullanici);
		}
		?>

		<?php  
		$blog_id = get_current_blog_id();
		$custom_meta_value = get_field('subjects_' . $blog_id, 'user_' . $get_user_id);
		print_r($custom_meta_value);
		?>

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


<script src="<?php echo get_template_directory_uri(); ?>/assets/js/add-user.js"></script>

<script>
	$('#user_image').change(function() {
		var formData = new FormData();
		var user_image = $('#user_image')[0].files[0];
		console.log(user_image);
		if (user_image) {
			formData.append('user_image', user_image);
		}
		formData.append('action', 'my_ajax_upload_user_image');
		formData.append('user_id', <?php echo $get_user_data->data->ID; ?>);


		$.ajax({
			url: get_site_url+'/wp-admin/admin-ajax.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data.data);
				$("#user_image_now").attr("src",""+data.data+"");
				Swal.fire(
				{
					title: 'Image Updated',
					text: '',
					icon: 'success',
					showCancelButton: false,
					confirmButtonColor: '#2ab57d',
				}
				)
			},
			error: function(data) {

			}
		});

	});
</script>

