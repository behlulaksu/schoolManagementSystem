<?php /* Template Name: Class All Marks For All Quarters */ ?>

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
$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$group." ORDER BY gb_subject_id DESC" );
$sonuclar = $wpdb->get_results($query);

$blog_id = get_current_blog_id();
$bg_table_name = "student_avarages";
$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group."" );
$sonuclar1 = $wpdb->get_results($query);
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">

			<?php  
			$bg_table_name = "final_project";
			global $wpdb;
			$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and did_project = 1 and class_id =".$group."" );
			$project_control = $wpdb->get_results($query);
			?>

			<?php $gruoup_subjects = get_field("subject_for_group",$group); 
			if (!empty($gruoup_subjects)) {
				foreach ($gruoup_subjects as $key => $value) {
					?>
					<div report_subject_id="<?php echo $value->ID; ?>" style="margin-top: 20px;" class="relative overflow-x-auto">
						<h6 style="text-align: center; background-color: #8e1838; color: #fff;position: sticky; left: 0; z-index: 9;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
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
								<tr style="border-top: 3px solid !important; " class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #8e1838 !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 1
									</th>
								</tr>
								<?php 
								$doluluk_kontrol = [];
								$gradebook_id = get_field("select_gradebook_definition",$value->ID)[0]->ID;   
								if(have_rows('add_quarter_1_domains', $gradebook_id)): 
									while(have_rows('add_quarter_1_domains', $gradebook_id)): 
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
														<th scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100" style="position: sticky; left: 0; background-color: #fff;">
															<span style="color: green;">
																<?php echo get_sub_field("sub_domain_name"); ?>

															</span> 
															/ Max Point: <?php echo get_sub_field("based_on"); ?>
														</th>
														<?php foreach ($group_users as $keys => $values) { ?>
															<th gradebook_th="<?php echo $gradebook_id; ?>" not_girileck subject_th="<?php echo $value->ID; ?>" domain_th="<?php echo $data_id_counter; ?>" subdomain_th="<?php echo $subDomainID; ?>" studetn_th="<?php echo $values['ID']; ?>" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																<?php  
																$tamam = true;
																$dolu = 0;
																$doluluk_kontrol[$values['ID']] = 1;
																foreach ($sonuclar as $key => $items) {
																	if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_student_id == $values['ID'] && $items->gb_quarter_id == 1) {
																		if ($tamam === true) {
																			echo $basilan_deger = $items->gb_point;
																			$dolu = 1;
																			
																		}
																		$tamam = false;
																	}

																}
																if ($dolu == 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
																}
																if (empty($basilan_deger) && $basilan_deger != 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu">
																		<?php print_r($basilan_deger); ?>
																	</div>
																	<?php 
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
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 1 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 1) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->student_avarage);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 1 Avarage Curve
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 1) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->stundent_curve);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>

								<tr style="border-top: 3px solid !important;" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #8e1838 !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 2
									</th>
								</tr>
								<?php 
								$doluluk_kontrol = [];
								if(have_rows('add_quarter_2_domains', $gradebook_id)): 
									while(have_rows('add_quarter_2_domains', $gradebook_id)): 
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
																$dolu = 0;
																$doluluk_kontrol[$values['ID']] = 1;
																foreach ($sonuclar as $key => $items) {
																	if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_student_id == $values['ID'] && $items->gb_quarter_id == 2) {
																		if ($tamam === true) {
																			echo $basilan_deger = $items->gb_point;
																			$dolu = 1;
																			
																		}
																		$tamam = false;
																	}

																}
																if ($dolu == 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
																}
																if (empty($basilan_deger) && $basilan_deger != 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
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
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 2 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 2) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->student_avarage);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 2 Avarage Curve
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 2) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->stundent_curve);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="font-weight: bold !important; color: #8e1838 !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Semester 1 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="font-weight: bold !important; color: #8e1838 !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 1) {
													$quarter_1 = ($items->stundent_curve);
												}
											}
											$quarter_2 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 2) {
													$quarter_2 = ($items->stundent_curve);
												}
											}
											if ($doluluk_kontrol[$values['ID']] != 0) {
												$atar = get_field("atar",$value->ID);
												if ($atar === "Yes") {
													echo ($quarter_1 + $quarter_2);
												}else{
													echo ($quarter_1 + $quarter_2)/2;
												}
											}
											
											?>
										</th>
									<?php } ?>
								</tr>

								<tr style="border-top: 3px solid !important;" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #8e1838 !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 3
									</th>
								</tr>
								<?php 
								$doluluk_kontrol = [];
								if(have_rows('add_quarter_3_domains', $gradebook_id)): 
									while(have_rows('add_quarter_3_domains', $gradebook_id)): 
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
																$doluluk_kontrol[$values['ID']] = 1;
																$tamam = true;
																$dolu = 0;
																foreach ($sonuclar as $key => $items) {
																	if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_student_id == $values['ID'] && $items->gb_quarter_id == 3) {
																		if ($tamam === true) {
																			echo $basilan_deger = $items->gb_point;
																			$dolu = 1;
																		}
																		$tamam = false;
																	}

																}
																if ($dolu == 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
																}
																if (empty($basilan_deger) && $basilan_deger != 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
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
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 3 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {

												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 3) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->student_avarage);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 3 Avarage Curve
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 3) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->stundent_curve);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr style="border-top: 3px solid !important;" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #8e1838 !important; font-weight: bold !important; position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 4
									</th>
								</tr>
								<?php 
								$doluluk_kontrol = [];
								if(have_rows('add_quarter_4_domains', $gradebook_id)): 
									while(have_rows('add_quarter_4_domains', $gradebook_id)): 
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
																$dolu = 0;
																$doluluk_kontrol[$values['ID']] = 1;
																foreach ($sonuclar as $key => $items) {
																	if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_student_id == $values['ID'] && $items->gb_quarter_id == 4) {
																		if ($tamam === true) {
																			echo $basilan_deger = $items->gb_point;
																			$dolu = 1;
																		}
																		$tamam = false;
																	}

																}
																if ($dolu == 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
																}
																if (empty($basilan_deger) && $basilan_deger != 0) {
																	$doluluk_kontrol[$values['ID']] = 0;
																	?>
																	<div class="kirmizi_kutu"></div>
																	<?php 
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
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important;position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 4 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 4) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->student_avarage);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="color: #d79a2a !important; font-weight: bold !important;position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Quarter 4 Avarage Curve
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="color: #d79a2a !important; font-weight: bold !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 4) {
													if ($doluluk_kontrol[$values['ID']] != 0) {
														echo $quarter_1 = ($items->stundent_curve);
													}
												}
											}
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="font-weight: bold !important; color: #8e1838 !important;position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										Semester 2 Avarage
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="font-weight: bold !important; color: #8e1838 !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 3) {
													$quarter_1 = ($items->stundent_curve);
												}
											}
											$quarter_2 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 4) {
													$quarter_2 = ($items->stundent_curve);
												}
											}
											if ($doluluk_kontrol[$values['ID']] != 0) {
												$atar = get_field("atar",$value->ID);
												if ($atar === "Yes") {
													echo ($quarter_1 + $quarter_2);
												}else{
													echo ($quarter_1 + $quarter_2)/2;
												}
											}
											
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="font-weight: bold !important; color: #8e1838 !important;position: sticky; left: 0; background-color: #fff; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										End Of Year Avarage:
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="font-weight: bold !important; color: #8e1838 !important;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 1) {
													$quarter_1 = ($items->stundent_curve);
												}
											}
											$quarter_2 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 2) {
													$quarter_2 = ($items->stundent_curve);
												}
											}
											$quarter_3 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 3) {
													$quarter_3 = ($items->stundent_curve);
												}
											}
											$quarter_4 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 4) {
													$quarter_4 = ($items->stundent_curve);
												}
											}
											if ($doluluk_kontrol[$values['ID']] != 0) {
												$atar = get_field("atar",$value->ID);
												if ($atar === "Yes") {
													echo ($quarter_1 + $quarter_2 + $quarter_3 + $quarter_4);
												}else{
													echo ($quarter_1 + $quarter_2 + $quarter_3 + $quarter_4)/4;
												}
											}
											
											?>
										</th>
									<?php } ?>
								</tr>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th style="font-weight: bold !important; color: #fff !important;position: sticky; left: 0; background-color: green; z-index: 9;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										End Of Year Project:
									</th>
									<?php foreach ($group_users as $keys => $values) { ?>
										<th style="font-weight: bold !important; color: #fff !important; background-color: green;" scope="row" class="px-3 py-2 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php 
											$pro_cont = 0;
											foreach ($project_control as $keypro => $valuepro) {
												if ($valuepro->subject_id == $value->ID && $valuepro->student_id == $values['ID']) {
													$pro_cont = 1;
												}
											}

											$quarter_1 = 0; 
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 1) {
													$quarter_1 = ($items->stundent_curve);
												}
											}
											$quarter_2 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 2) {
													$quarter_2 = ($items->stundent_curve);
												}
											}
											$quarter_3 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 3) {
													$quarter_3 = ($items->stundent_curve);
												}
											}
											$quarter_4 = 0;
											foreach ($sonuclar1 as $key => $items) {
												if ($items->subjecet_id == $value->ID && $items->student_id == $values['ID'] && $items->quarter_id == 4) {
													$quarter_4 = ($items->stundent_curve);
												}
											}
											
											if ($pro_cont == 1) {
												$atar = get_field("atar",$value->ID);
												if ($atar === "Yes") {
													echo number_format((($quarter_1 + $quarter_2 + $quarter_3 + $quarter_4)*70/100)+30,1);
												}else{
													echo number_format((($quarter_1 + $quarter_2 + $quarter_3 + $quarter_4)/4*70/100)+30,1);
												}
											}

											
											?>
										</th>
									<?php } ?>
								</tr>
							</tbody>

						</table>
					</div>
					<?php 
				}
			}
			?>

			<?php 
			// echo "<pre>";
			// print_r($sonuclar1);
			// echo "<pre>";
			?>
		</div>
	</div>
</div>


<?php get_footer(); ?>

<style>
	.kirmizi_kutu{
		padding: 16%;
		background-color: red;
	}
</style>