<?php /* Template Name: All User Login Log */ ?>

<?php 
global $wpdb;
$book_objective = "user_login_logs";
$query = $wpdb->prepare("SELECT * from $book_objective");
$sonuclar = $wpdb->get_results($query);
?>

<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<h4 class="display_name">
				All Users Log
			</h4>
			<div class="col-span-12" style="margin-top: 20px;">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body relative overflow-x-auto">
						<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
							<thead>
								<tr>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">Log ID</th>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">User</th>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">IP</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Date/Time</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Campus - Year</th>
								</tr>
							</thead>
							<tbody>
								<?php  
								foreach ($sonuclar as $key => $value) {
									?>
									<tr>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->id; ?>
										</td>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<a href="<?php echo get_site_url(); ?>/user-login-log?userID=<?php echo $value->user_id; ?>">
												<?php
												$user = get_user_by('ID', $value->user_id);
												echo $user->display_name;;
												?>
											</a>
										</td>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->ip_adress; ?>
										</td>
										<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->login_time; ?>
										</td>
										<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php
											$site_details = get_blog_details($value->site_id);
											echo $site_details->blogname; 
											?>
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

<style>
	.display_name{
		background-color: #8e1838;
		color: #fff;
		padding: 10px;
		border-radius: 10px;
	}
</style>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var userID = <?php echo $userID; ?>
</script>
<?php get_footer(); ?>

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