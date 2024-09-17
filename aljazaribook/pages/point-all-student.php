<?php /* Template Name: Point All Students List */ ?>
<?php get_header(); ?>

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
				</div>
			</div>
			<!-- Main Page Content Comes After This Area -->

			<div>
				<div class="col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body relative overflow-x-auto">
							<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
								<thead>
									<tr>
										<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
											School No
										</th>
										<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Name Surname
										</th>
										<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Grade
										</th>
										<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Q1
										</th>
										<th style="text-align: center;" class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Semester Report <br> Card KG-4 <br> EN
										</th>
										<th style="text-align: center;" class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Semester Report <br> Card KG-4 <br> TR
										</th>
										<th style="text-align: center;" class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Semester Report <br> Card 5-10 <br> EN
										</th>
										<th style="text-align: center;" class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Semester Report <br> Card 5-10 <br> TR
										</th>
										<th style="text-align: center;" class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
											Semester Report <br> Card 11-12 <br> EN
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$args = array(
										'role' => 'student',
									);
									$users = get_users($args);

									foreach ($users as $key => $value) {
										$kontrol = intval($value->data->ID);

										$args = array(
											'post_type' => 'user_groups',
											'meta_query' => array(
												array(
													'key' => 'group_users',
													'value' => '"' . $kontrol . '"',
													'compare' => 'LIKE',
												),
												array(
													'key' => 'sub_class',
													'value' => 'No',
													'compare' => '=',
												)
											),
										);
										$my_query = new WP_Query($args);
										$my_query = $my_query->get_posts();
										?>
										<tr>
											<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
												<?php echo get_field('school_no', 'user_'.$value->data->ID); ?>
											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<a href="mailto:<?php echo $value->data->user_email; ?>">
													<?php echo $value->data->display_name; ?>
												</a>
											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php echo get_field('grade', 'user_'.$value->data->ID); ?>
											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/report-card?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>
											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/semester-1-report-kg?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>

											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/semester-1-report-kg-tr?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>

											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/semester-1-report-card?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>

											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/semester-1-report-card-tr?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>

											</td>
											<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
												<?php  
												foreach ($my_query as $keys => $values) {
													?>
													<a target="_Blank" href="<?php echo get_site_url(); ?>/semester-1-report-card-2?user=<?php echo $value->data->ID; ?>&group=<?php echo $values->ID; ?>">
														<button style="margin-bottom: 3px; background-color: #8f1537 !important;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $values->post_title; ?>
														</button>
													</a>
													<?php 
												}
												?>

											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
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