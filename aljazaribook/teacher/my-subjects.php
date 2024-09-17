<?php /* Template Name: My Subjects */ ?>

<?php 
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

<?php $current_user_now = wp_get_current_user(); ?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?> - <?php echo get_the_title($group); ?>
					</h4>
					<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600" data-tw-toggle="modal" data-tw-target="#studentlistforteacher">
						<i class="bx bx-user bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
						<span class="px-3 leading-[2.8]">Student List</span>
					</button>
				</div>
			</div>


			<div class="modal relative z-50 hidden" id="studentlistforteacher" aria-labelledby="modal-title" role="dialog" aria-modal="true">
				<div class="fixed inset-0 z-50 overflow-y-auto">
					<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
					<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
						<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600" style="max-height: 85vh !important; overflow-y: scroll !important;">
							<div class="bg-white dark:bg-zinc-700">
								<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
									<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
										Student List - <?php echo get_the_title($group); ?>
									</h3>
									<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
										<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
									</button>
								</div>
								<div class="p-6 space-y-6 ltr:text-left rtl:text-right">

									<div class="card-body">
										<div class="relative overflow-x-auto">
											<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
												<thead>
													<tr>
														<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
															Image
														</th>
														<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
															School No (Eyotek)
														</th>
														<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
															Student Name
														</th>
														<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
															Student Email
														</th>
														<th class="p-4 pr-8 border rtl:border-l border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
															Counselling Notes
														</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$group_users = get_field("group_users",$group);
													foreach ($group_users as $key => $value) {
														?>
														<tr>
															<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
																<img src="<?php echo get_field('user_image', 'user_'.$value['ID']); ?>" alt="">
															</td>
															<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
																<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
															</td>
															<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
																<?php echo $value['display_name']; ?>
															</td>
															<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
																<a href="mailto:<?php echo $value['user_email']; ?>">
																	<?php echo $value['user_email']; ?>
																</a>
															</td>
															<td class="p-4 pr-8 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
																<a href="<?php echo get_site_url(); ?>/counselling-notes?student=<?php echo $value['ID']; ?>&group=<?php echo $group; ?>">
																	<button type="button" class="btn text-white bg-green-700 border-green-700 hover:bg-green-700 hover:border-green-700 focus:bg-green-700 focus:border-green-700 focus:ring focus:ring-green-700/30 active:bg-gray-700 active:border-green-700">
																		Notes
																	</button>
																</a>
															</td>
														</tr>
														<?php 
													}
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


			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<?php $gruoup_subjects = get_field("subject_for_group",$group); ?>
						<div class="card-body">
							<div class="relative overflow-x-auto">
								<table class="text-sm text-left text-gray-500 w-full dark:bg-zinc-700 dark:border-zinc-600">
									<thead class="text-sm text-gray-700 dark:text-gray-100 ">
										<tr>
											<th scope="col" class="px-6 py-3">
												Subject ID
											</th>
											<th scope="col" class="px-6 py-3">
												Subject Name
											</th>
											<th scope="col" class="px-6 py-3" style="text-align: center;">
												Examination
											</th>
											<th scope="col" class="px-6 py-3">
												Subject Type
											</th>
											<th scope="col" class="px-6 py-3">
												Gradebook
											</th>
											<th scope="col" class="px-6 py-3" style="text-align: center;">
												Curriculum Breakdown
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  
										foreach ($gruoup_subjects as $key => $value) {
											$subject_admin = get_field("subject_admin",$value->ID);
											foreach ($subject_admin as $keys => $values) {
												//echo $values['ID'];
												if ($current_user_now->ID === $values['ID']) {
													?>
													<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
														<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
															<?php echo $value->ID; ?>
														</th>
														<td class="px-6 py-3.5 dark:text-zinc-100">
															<?php echo get_the_title($value->ID); ?>
														</td>
														<td class="px-6 py-3.5 dark:text-zinc-100" style="display: flex; justify-content: center;">
															<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900"  data-tw-toggle="modal" data-tw-target="#upload_fiels_<?php echo $key; ?>">
																Browse Exams
																<i class="mdi mdi-upload block text-lg" style="margin-left: 7px;"></i>
															</button>
														</td>
														<td class="px-6 py-3.5 dark:text-zinc-100">
															<button type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900">
																<?php 

																$subject_type = get_field("select_lesson_type",$value->ID);
																if (empty($subject_type)) {
																	echo "Select";
																}else{
																	echo $subject_type[0]->post_title;
																}

																?>
															</button>
														</td>
														<td class="px-6 py-3.5 dark:text-zinc-100">
															<a href="<?php echo get_site_url(); ?>/gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																	Edit
																</button>
															</a>
														</td>
														<!-- curriculum-breakdown -->
														<td class="px-6 py-3.5 dark:text-zinc-100" style="text-align: center;">
															<a href="<?php echo get_site_url(); ?>/curriculum-breakdown?grade=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																	<i class="mdi mdi-book-open-page-variant"></i>
																</button>
															</a>
														</td>
													</tr>
													<?php 
												}
											}

										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php  
			$class_advisors = get_field("class_advisors", $group);
			$kontrol = false;
			foreach ($class_advisors as $key => $value) {
				if ($current_user_now->ID == $value['ID']) {
					$kontrol = true;
				}
			}
			if ($kontrol) {
				$sub_Class = get_field("sub_class",$group);
				?>
				<div class="card-body">
					<div class="relative overflow-x-auto">
						<table class="text-sm text-left text-gray-500" style="width: 100%;">
							<thead class="text-sm text-gray-700 dark:text-gray-100">
								<tr>
									<th scope="col" class="px-6 py-3">
										School No (Eyotek)
									</th>
									<th scope="col" class="px-6 py-3">
										Student Name
									</th>
									<th scope="col" class="px-6 py-3">
										GRADE ADVISOR'S COMMENT
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if (!empty($group_users)) {
									foreach ($group_users as $key => $value) {
										?>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</td>
											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												<?php echo $value['display_name']; ?>
											</td>
											<?php  
											$comment_type = "grade_advisor_comment";
											$comment_control = get_long_comment($group, get_field("active_quarter", $group), $value['ID'],$comment_type);
											$pdp_comment_bg = " ";
											if (!empty($comment_control)) {
												$pdp_comment_bg = "background-color: green !important;";
											}
											?>
											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												<button style="width: 100%; <?php echo $pdp_comment_bg; ?>" type="button" class="btn text-white bg-red-500" data-tw-toggle="modal" data-tw-target="#advisor_comment-<?php echo $value['ID']; ?>">
													GRADE ADVISOR
												</button>
											</td>
										</tr>
										<?php 
									}
								}

								?>
							</tbody>
						</table>
					</div>
				</div>
				<?php 
			}
			?>

		</div>
	</div>
</div>

<?php  
foreach ($gruoup_subjects as $key => $value) {
	$subject_admin = get_field("subject_admin",$value->ID);
	foreach ($subject_admin as $keys => $values) {
		if ($current_user_now->ID === $values['ID']) {
			?>
			<div class="modal relative z-50 hidden" id="upload_fiels_<?php echo $key; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
				<div class="fixed inset-0 z-50 overflow-y-auto">
					<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
					<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
						<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
							<div class="bg-white dark:bg-zinc-700">
								<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
									<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
										<?php echo get_the_title($value->ID); ?>
									</h3>
									<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
										<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
									</button>
								</div>
								<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 80vh; overflow-y: scroll;">
									<div class="card-body flex flex-wrap">
										<div class="nav-tabs border-b-tabs" style="width: 100%;">
											<ul class="nav text-sm font-medium text-center block w-full sm:flex">
												<li class="w-full">
													<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-home-<?php echo $key ?>" class="inline-block w-full p-4 active">
														Quarter 1
													</a>
												</li>
												<li class="w-full">
													<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-Profile-<?php echo $key ?>" class="inline-block w-full p-4">
														Quarter 2
													</a>
												</li>
												<li class="w-full">
													<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-setting-<?php echo $key ?>" class="inline-block w-full p-4">
														Quarter 3
													</a>
												</li>
												<li class="w-full">
													<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-contact-<?php echo $key ?>" class="inline-block w-full p-4">
														Quarter 4
													</a>
												</li>
											</ul>

											<div class="tab-content mt-5">
												<div class="tab-pane block" id="tab-full-u-home-<?php echo $key; ?>">
													<?php  
													$campus_id = get_current_blog_id();
													$file_type = 'exam';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,1,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Examinations
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 1): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 1): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="1" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
													<hr>
													<?php 
													$file_type = 'answer';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,1,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Marking Key (Answer Sheet)
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 1): ?>

																			<?php endif ?>
																			<?php if ($access_delete): ?>
																				<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																						<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																						<span class="">
																							Delete
																						</span>
																					</button>
																				</td>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 1): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="1" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
												</div>
												<div class="tab-pane hidden" id="tab-full-u-Profile-<?php echo $key; ?>">
													<?php  
													$campus_id = get_current_blog_id();
													$file_type = 'exam';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,2,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Examinations
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 2): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 2): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="2" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
													<hr>
													<?php 
													$file_type = 'answer';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,2,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Marking Key (Answer Sheet)
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 2): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 2): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="2" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
												</div>
												<div class="tab-pane hidden" id="tab-full-u-setting-<?php echo $key; ?>">
													<?php  
													$campus_id = get_current_blog_id();
													$file_type = 'exam';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,3,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Examinations
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 3): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>

																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 3): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="3" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
													<hr>
													<?php 
													$file_type = 'answer';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,3,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Marking Key (Answer Sheet)
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 3): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 3): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="3" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
												</div>
												<div class="tab-pane hidden" id="tab-full-u-contact-<?php echo $key; ?>">
													<?php  
													$campus_id = get_current_blog_id();
													$file_type = 'exam';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,4,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Examinations
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 4): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 4): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="4" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
														</div>
													</div>
													<hr>
													<?php 
													$file_type = 'answer';
													$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,4,$file_type);
													?>
													<div class="card-body"> 
														<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
															<table class="w-full text-sm text-left text-gray-500 ">
																<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<h4 style="color: #244b5a;">
																		Marking Key (Answer Sheet)
																	</h4>
																</div>
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			File Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Teacher
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Date
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			View
																		</th>
																		<?php if ($access_delete): ?>
																			<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																				Delete
																			</th>
																		<?php endif ?>
																	</tr>
																</thead>
																<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
																	<?php  
																	foreach ($target_files as $file_number => $files_data) {
																		?>
																		<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																			<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $files_data->file_name; ?>
																			</th>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php 
																				$current_user_edit_meta = get_user_meta($files_data->user_id); 
																				echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																				?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<?php echo $files_data->date; ?>
																			</td>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																					<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																						<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																					</button>
																				</a>
																			</td>
																			<?php if (get_field("active_quarter",$group) == 4): ?>
																				<?php if ($access_delete): ?>
																					<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																						<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																							<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">
																								Delete
																							</span>
																						</button>
																					</td>
																				<?php endif ?>
																			<?php endif ?>
																		</tr>
																		<?php 
																	}
																	?>
																</tbody>
															</table>
															<?php if (get_field("active_quarter",$group) == 4): ?>
																<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																	<form id="pdf-upload-form" style="width: 100%;">
																		<input style="width: 45%;" class="pdf-name4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																		<input class="pdf-file4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																		<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="4" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																			<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																			Upload File
																		</button>
																	</form>
																</div>
															<?php endif ?>
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
			</div>
			<?php 
		}
	}
}
?>

<?php 
if ($sub_Class === "No") {
	if (!empty($group_users)) {
		foreach ($group_users as $key => $value) {
			?>
			<div class="modal relative z-50 hidden" id="advisor_comment-<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
				<div class="fixed inset-0 z-50 overflow-y-auto">
					<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
					<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
						<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
							<div class="bg-white dark:bg-zinc-700">
								<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
									<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
										<?php echo $value['display_name']; ?>
									</h3>
									<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
										<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
									</button>
								</div>
								<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="padding: initial !important;max-height: 69vh; overflow-y: scroll !important;">
									<div class="col-span-12 xl:col-span-6">
										<div class="card-body flex flex-wrap">
											<div class="nav-tabs border-tab" style="width: 100%;">
												<ul style="justify-content: space-around;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
													<li>
														<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q1-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 1){echo "active";} ?>">
															Quarter 1
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q2-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 2){echo "active";} ?>">
															Quarter 2
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q3-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 3){echo "active";} ?>">
															Quarter 3
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q4-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 4){echo "active";} ?>">
															Quarter 4
														</a>
													</li>
												</ul>
												<style>
													.class_advisor label{
														font-weight: 300 !important;
														padding: 15px;
														border: 1px solid #d79a2a;
													}
												</style>
												<div class="mt-5 tab-content">
													<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1){echo "block";}else{echo "hidden";} ?>" id="q1-advisor-<?php echo $value['ID']; ?>-pdp_comment">
														<div class="relative overflow-x-auto">
															<div class="mb-3">
																<?php 
																$comment_type = "grade_advisor_comment";
																$comment_control = get_long_comment($group, 1, $value['ID'],$comment_type);
																$kontrol = intval($comment_control[0]->comment);
																if(have_rows('grade_advisor_comment_q1', $group)): 
																	while(have_rows('grade_advisor_comment_q1', $group)): 
																		the_row(); 
																		?>
																		<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																			<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_1" type="radio" name="advisor_1_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																			<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_1" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																				<?php 
																				$metin = get_sub_field("comment"); 
																				$eski = "[student-name]";
																				$yeni = $value['display_name'];
																				echo str_replace($eski, $yeni, $metin);
																				?>
																			</label>
																		</div>
																		<?php 
																	endwhile; 
																endif;
																?>
															</div>
														</div>
													</div>
													<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="q2-advisor-<?php echo $value['ID']; ?>-pdp_comment">
														<div class="relative overflow-x-auto">
															<div class="mb-3">
																<?php 
																$comment_type = "grade_advisor_comment";
																$comment_control = get_long_comment($group, 2, $value['ID'],$comment_type);
																$kontrol = intval($comment_control[0]->comment);
																if(have_rows('grade_advisor_comment_q2', $group)): 
																	while(have_rows('grade_advisor_comment_q2', $group)): 
																		the_row(); 
																		?>
																		<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																			<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" type="radio" name="advisor_2_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																			<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																				<?php 
																				$metin = get_sub_field("comment"); 
																				$eski = "[student-name]";
																				$yeni = $value['display_name'];
																				echo str_replace($eski, $yeni, $metin);
																				?>
																			</label>
																		</div>
																		<?php 
																	endwhile; 
																endif;
																?>
															</div>
														</div>
													</div>
													<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="q3-advisor-<?php echo $value['ID']; ?>-pdp_comment">
														<div class="relative overflow-x-auto">
															<div class="mb-3">
																<?php 
																$comment_type = "grade_advisor_comment";
																$comment_control = get_long_comment($group, 3, $value['ID'],$comment_type);
																$kontrol = intval($comment_control[0]->comment);
																if(have_rows('grade_advisor_comment_q3', $group)): 
																	while(have_rows('grade_advisor_comment_q3', $group)): 
																		the_row(); 
																		?>
																		<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																			<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" type="radio" name="advisor_3_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																			<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																				<?php 
																				$metin = get_sub_field("comment"); 
																				$eski = "[student-name]";
																				$yeni = $value['display_name'];
																				echo str_replace($eski, $yeni, $metin);
																				?>
																			</label>
																		</div>
																		<?php 
																	endwhile; 
																endif;
																?>
															</div>
														</div>
													</div>
													<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="q4-advisor-<?php echo $value['ID']; ?>-pdp_comment">
														<div class="relative overflow-x-auto">
															<div class="mb-3">
																<?php 
																$comment_type = "grade_advisor_comment";
																$comment_control = get_long_comment($group, 4, $value['ID'],$comment_type);
																$kontrol = intval($comment_control[0]->comment);
																if(have_rows('grade_advisor_comment_q4', $group)): 
																	while(have_rows('grade_advisor_comment_q4', $group)): 
																		the_row(); 
																		?>
																		<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																			<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" type="radio" name="advisor_4_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																			<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																				<?php 
																				$metin = get_sub_field("comment"); 
																				$eski = "[student-name]";
																				$yeni = $value['display_name'];
																				echo str_replace($eski, $yeni, $metin);
																				?>
																			</label>
																		</div>
																		<?php 
																	endwhile; 
																endif;
																?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div style="justify-content: flex-end;" class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
									<h5>
										You can save only Quarter <?php echo get_field("active_quarter",$group); ?>
									</h5>
									<button active_quarter="<?php echo get_field("active_quarter",$group); ?>" comment_type="grade_advisor_comment" student="<?php echo $value['ID']; ?>" type="button" class="advisor_comment_select btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
										Save Comment
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
		}
	}

}

?>


<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var class_id = <?php echo $group; ?>
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
	jQuery(document).ready(function($) {


		$(".advisor_comment_select").click(async function () {
			selected_student = $(this).attr('student');
			selected_active_quarter = $(this).attr('active_quarter');
			selected_comment_type = $(this).attr('comment_type');



			secilen_normal_comment = "";
			pdp_normal = [];
			pdp_normal = $("[name='advisor_"+selected_active_quarter+"_"+selected_student+"']");
			for (var i = 0; i < pdp_normal.length; i++) {
				if (pdp_normal[i].checked) {
					secilen_normal_comment = i+1;
				}
			}

			console.log(secilen_normal_comment);


			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_grade_advisor_save',

					class_id:<?php echo $group; ?>,
					selected_student:selected_student,
					selected_active_quarter:selected_active_quarter,
					selected_comment_type:selected_comment_type,
					secilen_normal_comment:secilen_normal_comment,
				}),
				success: function(data){
					console.log(data.data);
					if (data.data == "tamam") {
						Swal.fire(
						{
							title: 'Done',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});



		});


		$('.upload-button').on('click', function(e) {
			e.preventDefault();
			console.log(this);
			var quarter_id = $(this).attr("quarter_id");
			var popup_id = $(this).attr("popup_id");
			var formData = new FormData();
			var subject_id = $(this).attr("subject_id");

			var file_type = $(this).attr("file_type");
			if (file_type === "exam") {
				var pdfFile = $('.pdf-file'+quarter_id+"_"+popup_id)[0].files[0];
				var pdfFile_name = $('.pdf-name'+quarter_id+"_"+popup_id)[0].value;
			}else{
				var pdfFile = $('.pdf-file'+quarter_id+"_"+popup_id)[1].files[0];
				var pdfFile_name = $('.pdf-name'+quarter_id+"_"+popup_id)[1].value;
			}
			sayac = 0;
			if (quarter_id == 1) {
				if (file_type === "exam") {
					sayac = 0;
				}else{
					sayac = 1;
				}
			}else if(quarter_id == 2){
				if (file_type === "exam") {
					sayac = 2;
				}else{
					sayac = 3;
				}
			}else if(quarter_id == 3){
				if (file_type === "exam") {
					sayac = 4;
				}else{
					sayac = 5;
				}
			}else if(quarter_id == 4){
				if (file_type === "exam") {
					sayac = 6;
				}else{
					sayac = 7;
				}
			}

			formData.append('action', 'my_ajax_upload_file');
			formData.append('pdf_file', pdfFile);
			formData.append('pdf_name', pdfFile_name);
			formData.append('class_id', class_id);
			formData.append('subject_id', subject_id);
			formData.append('quarter_id', quarter_id);
			formData.append('file_type', file_type);

			$.ajax({
				url: get_site_url+'/wp-admin/admin-ajax.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(data){
					if (data.data != "error") {
						call_back_final = data;
						$('[body_id="'+subject_id+'"]')[sayac].innerHTML += '<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent"><th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100"> '+call_back_final.data.file_name+' </th><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">---</td><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">'+call_back_final.data.date+'</td><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100"><a target="_Blank" href="'+call_back_final.data.link+'"><button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0"><i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i></button></a></td></tr>';
						console.log(data);
					}
				}
			});
		});

	});
</script>


<style>
	@media only screen and (min-width: 540px) {
		.sm\:max-w-4xl{
			max-width: 65rem !important;
		}
	}
</style>