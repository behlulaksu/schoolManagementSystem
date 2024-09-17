<?php /* Template Name: Class All Marks */ ?>

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
<?php $current_user_now = wp_get_current_user(); ?>
<?php $group_users = get_field("group_users",$group); ?>
<?php $active_quarter = get_field("active_quarter",$group); ?>
<?php $book_objective = "book_".get_current_blog_id()."_gradebook"; ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<?php  
global $wpdb;
$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$group." and gb_quarter_id =".$active_quarter." ORDER BY gb_subject_id DESC" );
$sonuclar = $wpdb->get_results($query);

?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between" style="font-weight: bold;">
					Quarter <?php echo $active_quarter; ?>
				</div>
			</div>
			<?php $gruoup_subjects = get_field("subject_for_group",$group); 
			if (!empty($gruoup_subjects)) {
				foreach ($gruoup_subjects as $key => $value) {
					?>
					<div report_subject_id="<?php echo $value->ID; ?>" style="margin-top: 20px;" class="relative overflow-x-auto">
						<h6 style="text-align: center; background-color: #8e1838; color: #fff; position: sticky; left: 0; z-index: 9;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
							<?php echo get_field("select_lesson_type",$value->ID)[0]->post_title; ?>
						</h6>
						<table class="w-full text-sm text-left text-gray-500 ">
							<thead class="text-sm text-gray-700 dark:text-gray-100">
								<tr class="border border-gray-50 dark:border-zinc-600">
									<th style="position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Assesment
									</th>
									<?php foreach ($group_users as $key => $values) {
										?>
										<th scope="col" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600">
											<?php echo $values['display_name']; ?>
										</th>
										<?php 
									} ?>
								</tr>
							</thead>
							<tbody>
								<?php 
								$quarter = get_field("active_quarter",$group);

								if ($quarter == 1) {
									$domain_getir = 'add_quarter_1_domains';
								}elseif ($quarter == 2) {
									$domain_getir = 'add_quarter_2_domains';
								}elseif ($quarter == 3) {
									$domain_getir = 'add_quarter_3_domains';
								}elseif ($quarter == 4) {
									$domain_getir = 'add_quarter_4_domains';
								}
								$gradebook_id = get_field("select_gradebook_definition",$value->ID)[0]->ID;   
								if(have_rows($domain_getir, $gradebook_id)): 
									while(have_rows($domain_getir, $gradebook_id)): 
										the_row(); 
										$domain_percentage = get_sub_field("domain_percentage");
										$data_id_counter = get_row_index();	
										if(have_rows('add_sub_domains')): 
											while(have_rows('add_sub_domains')): 
												the_row();
												$subDomainID = get_row_index(); 
												if ($domain_percentage != 0) {
													?>
													<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
														<th style="position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
															<span style="color: green;">
																<?php echo get_sub_field("sub_domain_name"); ?>

															</span> 
															/ Max Point: <?php echo get_sub_field("based_on"); ?>
														</th>
														<?php foreach ($group_users as $keys => $values) { ?>
															<th gradebook_th="<?php echo $gradebook_id; ?>" not_girileck subject_th="<?php echo $value->ID; ?>" domain_th="<?php echo $data_id_counter; ?>" subdomain_th="<?php echo $subDomainID; ?>" studetn_th="<?php echo $values['ID']; ?>" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																<?php  
																$tamam = true;
																foreach ($sonuclar as $key => $items) {
																	if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_student_id == $values['ID']) {
																		if ($tamam === true) {
																			print_r($items->gb_point);
																		}
																		$tamam = false;
																	}

																}
																?>
															</th>
														<?php } ?>
													</tr>
													<?php 
												}
											endwhile; 
										endif;
									endwhile; 
								endif;
								?>

							</tbody>
						</table>
					</div>
					<?php 
				}
			}
			?>
		</div>
	</div>
</div>


<?php get_footer(); ?>

