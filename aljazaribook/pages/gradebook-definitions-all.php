<?php /* Template Name: Gradebook All List */ ?>

<?php get_header(); ?>

<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
<?php $current_user_id = get_current_user_id(); ?>

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

			<div>
				<?php 
				if (get_user_access_read('see-module')) {
					?>
					<div class="col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body relative overflow-x-auto">
								<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
									<thead>
										<tr>
											<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
												Module ID
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Module Title
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Used By
											</th>
											<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
												Creator
											</th>
											<?php if (get_user_access_write('see-module')): ?>
												<th class="p-4 pr-8 border rtl:border-l border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Edit
												</th>
											<?php endif ?>
											<?php if (get_user_access_write('see-module')): ?>
												<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
													Delete
												</th>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<!-- Get All Groups For This User -->
										<?php  
										$all_groups_args = [
											'post_type' 	=> 'gradebook_function',
											'numberposts'	=> -1
										];
										$all_groups = get_posts($all_groups_args);

										foreach ($all_groups as $key => $value) {
											?>
											<tr id="<?php echo $value->ID; ?>">
												<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
													<?php echo $value->ID; ?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<?php echo $value->post_title; ?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">

													<?php  

													$args = array(
														'post_type' => 'subject_function',
														'meta_query' => array(
															array(
																'key' => 'select_gradebook_definition',
																'value' => $value->ID,
																'compare' => 'LIKE',
															)
														)
													);

													$my_query = new WP_Query($args);
													$my_query = $my_query->get_posts();
													foreach ($my_query as $keys => $values) {
														?>
														<a target="_Blank" href="<?php echo get_site_url(); ?>/edit-subject?subject=<?php echo $values->ID; ?>">
															<button style="margin-bottom: 3px;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
																<?php echo $values->post_title; ?>
															</button>
														</a>
														<?php 
													}
													?>
												</td>
												<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
													<?php $get_user_data = get_user_by('id',$values->post_author); ?>

													<a target="_Blank" href="mailto:<?php echo $get_user_data->data->user_email; ?>">
														<button type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
															<?php echo $get_user_data->data->user_email; ?>
														</button>
													</a>
												</td>
												<?php if (get_user_access_write('see-module')): ?>
													<td class="p-4 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
														<a target="_Blank" href="<?php echo get_site_url(); ?>/gradebook-definitions-edit?id=<?php echo $value->ID; ?>">
															<button style="width: 100%;" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																Edit
															</button>
														</a>
													</td>
												<?php endif ?>
												<?php if (get_user_access_write('see-module')): ?>
													<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
														<button delete_id="<?php echo $value->ID; ?>" type="button" class="delete_button btn border-0 bg-red-400 text-white px-5">
															<i class="mdi mdi-trash-can block text-lg"></i>
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

							</div>
						</div>
					</div>
					<?php 
				}else{
					echo access_denieded($current_user_id,'see-module','authorizations-edit');
				}

				?>
			</div>

		</div>
	</div>
</div>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>

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


<script>
	$(".delete_button").click(function(){
		delete_button = $(this).attr("delete_id");
		console.log(delete_button);

		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_delete_assessment',

				delete_button:delete_button,

			}),
			success: function(data){
				$("#"+delete_button).remove();
			}

		});

		

	});
</script>