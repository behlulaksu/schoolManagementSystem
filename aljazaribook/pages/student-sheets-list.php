<?php /* Template Name: Student Sheets List Page */ ?>
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

if (isset($_GET['user'])){
	$student = strip_tags($_GET["user"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}


$get_user_data = get_user_meta($student);
$gruoup_subjects = get_field("subject_for_group",$group);
?>
<?php $current_user_id = get_current_user_id(); ?>
<?php $book_objective = "book_".get_current_blog_id()."_gradebook"; ?>

<?php get_header(); ?>


<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center;">
						Student Academic Records - <?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
					</h4>
				</div>
			</div>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
								Class Subject List

								<?php  
								global $wpdb;
								$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$group." and gb_student_id =".$student."" );
								$sonuclar_main = $wpdb->get_results($query);

								$args = array(
									'post_type' => 'user_groups',
									'meta_query' => array(
										array(
											'key' => 'group_users',
											'value' => $student,
											'compare' => 'LIKE',
										),
										array(
											'key' => 'sub_class',
											'value' => 'Yes',
											'compare' => '=',
										)
									)
								);
								$sub_gruoup_subjects = [];
								$sub_gruoup_domain = [];
								$my_query = new WP_Query($args);
								$my_query = $my_query->get_posts();
								foreach ($my_query as $keys => $values) {
									$sub_gruoup_domain[$keys] = $values->ID;
									$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
								}

								?>
							</h6>
						</div>
						<div class="card-body flex flex-wrap">
							<div class="nav-tabs border-b-tabs" style="width: 100%;">
								<ul class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
									<?php  
									$lessons_final_points = [];
									if (!empty($gruoup_subjects)) {
										foreach ($gruoup_subjects as $key => $value) {
											if ($key === 0) {
												$active_class = "active";
											}else{
												$active_class = "";
											}
											?>
											<li>
												<div class="subject-<?php echo $key; ?>"></div>
												<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="subject-<?php echo $key; ?>" class="inline-block p-4 <?php echo $active_class; ?>">
													<?php echo get_the_title($value->ID); ?> <br>
												</a>
											</li>
											<?php 
										}  
									}
									foreach ($sub_gruoup_subjects as $key => $value) {
										?>
										<li>
											<div class="subject-<?php echo $sayma; ?>"></div>
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="subject-<?php echo $value[0]->ID; ?>" class="inline-block p-4">
												<?php echo get_the_title($value[0]->ID); ?> <br>
											</a>
										</li>
										<?php 
									}
									?>
								</ul>
								<div class="mt-5 tab-content">
									<?php  
									if (!empty($gruoup_subjects)) {
										foreach ($gruoup_subjects as $key => $value) {
											if ($key === 0) {
												$active_class = "block";
											}else{
												$active_class = "hidden";
											}
											?>
											<div class="tab-pane <?php echo $active_class; ?>" id="subject-<?php echo $key; ?>">

												<div data-tw-accordion="collapse">
													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600 active">
																<span class="text-15">
																	Quarter 1
																</span>
																<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
																<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
															</button>
														</h2>

														<div class="accordion-body block">
															<?php 
															$selected_lesson = get_field("select_gradebook_definition",$value->ID); 
															$subject_toplam = 0;
															?>
															<?php  if(have_rows('add_quarter_1_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_1_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage"); 
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 1) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>

													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
																<span class="text-15">
																	Quarter 2
																</span>
																<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
																<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
															</button>
														</h2>
														<div class="accordion-body hidden">
															<?php 
															$selected_lesson = get_field("select_gradebook_definition",$value->ID); 
															$subject_toplam = 0;
															?>
															<?php  if(have_rows('add_quarter_2_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_2_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage"); 
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 2) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>

													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
																<span class="text-15">
																	Quarter 3
																</span>
																<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
																<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
															</button>
														</h2>
														<div class="accordion-body hidden">
															<?php 
															$selected_lesson = get_field("select_gradebook_definition",$value->ID); 
															$subject_toplam = 0;
															?>
															<?php  if(have_rows('add_quarter_3_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_3_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage"); 
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 3) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>

													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
																<span class="text-15">
																	Quarter 4
																</span>
																<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
																<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
															</button>
														</h2>
														<div class="accordion-body hidden">
															<?php 
															$selected_lesson = get_field("select_gradebook_definition",$value->ID); 
															$subject_toplam = 0;
															?>
															<?php  if(have_rows('add_quarter_4_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_4_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage"); 
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 4) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>

												</div>

											</div>
											<?php 
										} 
									}
									
									foreach ($sub_gruoup_subjects as $key => $value) {
										global $wpdb;
										$query = $wpdb->prepare("SELECT * from $book_objective where gb_subject_id =".$value[0]->ID." and gb_student_id =".$student."" );
										$sonuclar_main = $wpdb->get_results($query);
										?>
										<div class="tab-pane <?php echo $active_class; ?>" id="subject-<?php echo $value[0]->ID; ?>">
											<div data-tw-accordion="collapse">
												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600 active">
															<span class="text-15">
																Quarter 1 
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>

													<div class="accordion-body block">
														<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">
															<?php $selected_lesson = get_field("select_gradebook_definition",$value[0]->ID); 
															$domainPercentage = [];
															?>
															<?php  if(have_rows('add_quarter_1_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_1_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage");
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value[0]->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 1) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>
												</div>

												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
															<span class="text-15">
																Quarter 2
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>
													<div class="accordion-body hidden">
														<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">
															<?php $selected_lesson = get_field("select_gradebook_definition",$value[0]->ID); 
															$domainPercentage = [];
															?>
															<?php  if(have_rows('add_quarter_2_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_2_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage");
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value[0]->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 2) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>
												</div>

												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
															<span class="text-15">
																Quarter 3
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>
													<div class="accordion-body hidden">
														<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">
															<?php $selected_lesson = get_field("select_gradebook_definition",$value[0]->ID); 
															$domainPercentage = [];
															?>
															<?php  if(have_rows('add_quarter_3_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_3_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage");
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value[0]->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 3) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>
												</div>

												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left hover:bg-gray-50/50 border border-b-0 border-gray-100 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
															<span class="text-15">
																Quarter 4
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>
													<div class="accordion-body hidden">
														<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">
															<?php $selected_lesson = get_field("select_gradebook_definition",$value[0]->ID); 
															$domainPercentage = [];
															?>
															<?php  if(have_rows('add_quarter_4_domains', $selected_lesson[0]->ID)): 
																while(have_rows('add_quarter_4_domains', $selected_lesson[0]->ID)): 
																	the_row(); 
																	$data_id_counter = get_row_index();	
																	?>
																	<div class="col-span-12 xl:col-span-6 domain-box">
																		<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border-color: rgb(143, 21, 55) !important;">
																			<div class="card-body"> 
																				<div class="relative overflow-x-auto">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Assesment Type
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Quarterly Percentage
																								</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="border border-gray-50 dark:border-zinc-600 bg-neutral-50/20 dark:bg-zinc-700/50">
																								<th style="color: #d79a2a !important; font-weight: bold;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																									<?php echo get_sub_field("domain_name"); ?>
																								</th>
																								<td style="color: #d79a2a !important; font-weight: bold;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php 
																									echo get_sub_field("domain_percentage"); 
																									$domain_percantage = get_sub_field("domain_percentage");
																									?>
																								</td>
																							</tr>
																							<?php 
																							$student_point_all = [];
																							$base_on_all = [];
																							$percentage_all = [];
																							if(have_rows('add_sub_domains')): 
																								while(have_rows('add_sub_domains')): 
																									the_row(); 
																									$subDomainID = get_row_index();
																									?>
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<td colspan="4" class="p-2">
																											<table class="table w-full text-sm text-left text-gray-500 ">
																												<thead class="text-sm text-gray-700 dark:text-gray-100">
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
																															Sub Domain Name
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Percentage
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Based On
																														</th>
																														<th scope="col" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-gray-100">
																															Student Point
																														</th>
																													</tr>
																												</thead>
																												<tbody>
																													<tr class="border border-gray-50 dark:border-zinc-600">
																														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																															<?php echo get_sub_field("sub_domain_name"); ?>
																														</th>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("sub_domain_percentage"); 
																															$percentage_all[$subDomainID] = get_sub_field("sub_domain_percentage");
																															?>
																														</td>
																														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php 
																															echo get_sub_field("based_on"); 
																															$base_on_all[$subDomainID] = get_sub_field("based_on");
																															?>
																														</td>
																														<td style="background-color: #d79a2a !important;     color: #fff !important;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																															<?php  
																															$tamam = true;
																															foreach ($sonuclar_main as $key => $items) {
																																if ($items->gb_subject_id == $value[0]->ID && $items->gb_domain_id == $data_id_counter && $items->gb_subdomain_id == $subDomainID && $items->gb_quarter_id == 4) {
																																	if ($tamam === true) {
																																		print_r($items->gb_point);
																																	}
																																	$tamam = false;
																																}
																															}
																															?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								<?php endwhile; 
																							endif;
																							?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php 
																endwhile; 
															endif; ?>
														</div>
													</div>
												</div>

											</div>

										</div>
										<?php 
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







<?php get_footer(); ?>

<style>
	.domain-box:hover{
		background-color: #fff;
	}
	h4{
		margin-top: 50px;
	}


	.accordion-header:hover{
		background-color: rgb(143, 21, 55) !important;
		color: #fff !important;
	}
	.accordion-header{
		color: #d79a2a !important;
	}
	.accordion-item .active{
		background-color: rgb(143, 21, 55) !important;
		color: #fff !important;
	}
</style>