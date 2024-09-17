<?php /* Template Name: Objectives Details */ ?>
<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
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
$bg_table_name = "objectives_logs";
$query = $wpdb->prepare("SELECT * from $bg_table_name where obj_id=".$obj);
$sonuclar1 = $wpdb->get_results($query);
?>


<div class="main-content">
	<div class="page-content dark:bg-zinc-700"  style="width: 100%; height: 100%;">
		<div class="container-fluid px-[0.625rem]"  style="width: 100%; height: 100%;">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex;">
						Detail of objective <span style="color: #8f1537 !important; padding-left: 10px;"><?php echo $sonuclar1->objecttive_title; ?></span>
					</h4>
				</div>
			</div>


			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
								Objective previous versions
							</h6>
						</div>
						<div class="card-body"> 
							<div class="relative overflow-x-auto">
								<table class="w-full text-sm text-left text-gray-500 ">
									<thead class="text-sm text-gray-700 dark:text-gray-100">
										<tr class="border border-gray-50 dark:border-zinc-600">
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Editor
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Date & Time
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Curriculum
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Skill
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Grade
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Subject
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Content
											</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($sonuclar1 as $key => $value): ?>
											<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
												<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php  
													$user_info = get_userdata($value->user_id);
													if ($user_info) {
														echo $user_info->display_name;
													}
													?>
												</th>
												<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php  
													echo $value->time;
													echo "<br>";
													echo $value->date;
													?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php echo $value->object_curricullum; ?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php echo $value->object_skill; ?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php echo $value->grade; ?>
												</td>
												<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php echo $value->subject; ?>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<?php echo $value->objecttive_content; ?>
												</td>
											</tr>
										<?php endforeach ?>
										
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