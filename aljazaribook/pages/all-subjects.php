<?php /* Template Name: All Subjects */ ?>
<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
<?php $current_user_id = get_current_user_id(); ?>




<?php $current_user_now = wp_get_current_user(); ?>
<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						Subjects
					</h4>
				</div>
			</div>



			<div>
				<?php 
				if (get_user_access_read('list-subject')) {
					?>
					<div class="col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body relative overflow-x-auto">
								<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
									<thead>
										<tr>
											<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
												Subject Name
											</th>
											<!-- <th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Subject Teacher
											</th> -->
											<?php if (get_user_access_read('class-curve')): ?>
												<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Subject Curve
												</th>

												<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Project Curve
												</th>
											<?php endif ?>
											
											<?php if (get_user_access_write('list-subject')): ?>
												<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Edit Subject
												</th>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php 
										$args = array(
											'post_type' => 'subject_function',
										);
										$my_posts = new WP_Query($args);
										if ($my_posts->have_posts()) {
											while ($my_posts->have_posts()) {
												$my_posts->the_post();
												$categoryID = get_the_id(); 
												/************************************/  
												?>
												<tr>
													<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
														<b><?php echo get_the_title(); ?></b>
													</td>
													<!-- <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
														<?php  
														$subject_admin = get_field("subject_admin",$categoryID);
														foreach ($subject_admin as $keys => $values) {
															?>
															<a href="mailto:<?php print_r($values['user_email']); ?>">
																<button style="margin: 5px;" type="button" class="btn rounded-full text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
																	<?php print_r($values['user_email']); ?>
																</button>
															</a>
															<?php 
														}
														?>
													</td> -->
													

													<?php if (get_user_access_read('class-curve')): ?>
														<td style="display: flex;" class="subject_curve p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
															<a href="<?php echo get_site_url(); ?>/subject-curve?subject=<?php echo $categoryID; ?>&quarter=1">
																<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																	Quarter 1
																</button>
															</a>
															<a href="<?php echo get_site_url(); ?>/subject-curve?subject=<?php echo $categoryID; ?>&quarter=2">
																<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																	Quarter 2
																</button>
															</a>
															<a href="<?php echo get_site_url(); ?>/subject-curve?subject=<?php echo $categoryID; ?>&quarter=3">
																<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																	Quarter 3
																</button>
															</a>
															<a href="<?php echo get_site_url(); ?>/subject-curve?subject=<?php echo $categoryID; ?>&quarter=4">
																<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																	Quarter 4
																</button>
															</a>
														</td>

														<!-- <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
															<a href="<?php echo get_site_url(); ?>/project-curve?subject=<?php echo $categoryID; ?>">
																<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																	Curve
																</button>
															</a>
														</td> -->
														<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
															<a href="<?php echo get_site_url(); ?>/standart-subject-curve?subject=<?php echo $categoryID; ?>">
																<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																	Curve
																</button>
															</a>
														</td>
													<?php endif; ?>
													
													<?php if (get_user_access_write('list-subject')): ?>
														<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
															<a href="<?php echo get_site_url(); ?>/edit-subject?subject=<?php echo $categoryID; ?>">
																<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																	Edit Subject
																</button>
															</a>
														</td>
													<?php endif ?>
												</tr>
												<?php 
											}
										}else{
											echo "There is no Subject";
										}
										wp_reset_query();
										?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
					<?php
				}else{
					echo access_denieded($current_user_id,'lessons','list-subject');
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
<style>
	.subject_curve a{
		margin: 5px;
	}
</style>