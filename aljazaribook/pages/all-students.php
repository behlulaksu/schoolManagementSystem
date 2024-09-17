<?php /* Template Name: All Students Page */ ?>
<?php get_header(); ?>
<?php $current_user_id = get_current_user_id(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 


<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?>
					</h4>
					<a href="<?php echo get_site_url(); ?>/create-user?stundet=true">
						<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
							<i class="bx bx-user-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
							<span class="px-3 leading-[2.8]">
								New Student
							</span>
						</button>
					</a>
				</div>
			</div>
			<!-- Main Page Content Comes After This Area -->

			<div>
				<?php 
				if (get_user_access_read('students')) {
					?>
					<div class="col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body relative overflow-x-auto">
								<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
									<thead>
										<tr>
											<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
												Portal ID
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												School No
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Name Surname
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Authorization
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Grade
											</th>
											<?php if (get_user_access_write('students')): ?>
												<th class="p-4 pr-8 border rtl:border-l border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Edit
												</th>
											<?php endif ?>

										</tr>
									</thead>
									<tbody>
										<?php 
										$args = array(
											'role' => 'student',
										);
										$users = get_users($args);

										foreach ($users as $key => $value) {
											?>
											<tr>

												<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
													<?php echo $value->data->ID; ?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<?php echo get_field('school_no', 'user_'.$value->data->ID); ?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<a href="mailto:<?php echo $value->data->user_email; ?>">
														<?php echo $value->data->display_name; ?>
													</a>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<?php  
													$user_all_sites = get_blogs_of_user($value->data->ID);
													foreach ($user_all_sites as $keys => $values) {
														?>
														<a site-id="<?php echo $values->userblog_id; ?>" href="<?php echo $values->siteurl; ?>">
															<button style="margin-bottom: 5px;" type="button" class="btn rounded-full text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
																<?php echo $values->blogname; ?>
															</button>
														</a>
														<?php 
													}
													?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<?php echo get_field('grade', 'user_'.$value->data->ID); ?>
												</td>
												<?php if (get_user_access_write('students')): ?>
													<td class="p-4 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
														<a href="<?php echo get_site_url(); ?>/edit-user?user=<?php echo $value->data->ID; ?>">
															<button style="width: 100%;" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																View
															</button>
														</a>
													</td>
												<?php endif ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
					<?php 
				}else{
					echo access_denieded($current_user_id,'all-students','students');
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
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