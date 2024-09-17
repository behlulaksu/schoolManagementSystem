<?php /* Template Name: Student Gradebook */ ?>
<?php include 'header.php';?>

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
if (isset($_GET['subject'])){
	$subject = strip_tags($_GET["subject"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}



if (isset($_GET['student'])){
	$student = strip_tags($_GET["student"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}


if ($student != get_current_user_id()) {
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}


$user_data = get_userdata($student);

$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;

?>

<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php 
$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;
$group_users = get_field("group_users",$group);
?>

<div class="page-content dark:bg-zinc-700">
	<div class="container-fluid px-[0.625rem]">

		<?php 
		$selected_lesson = get_field("select_gradebook_definition",$subject);
		$gradebook_ID = $selected_lesson[0]->ID;
		$group_users = get_field("group_users",$group);
		$how_much_user = count($group_users);

		$book_objective = "book_".get_current_blog_id()."_gradebook";

		global $wpdb;
		$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$group." and gb_subject_id =".$subject." and gb_student_id =".$student." and gb_gradebook_id =".$gradebook_ID."" );
		$sonuclar = $wpdb->get_results($query);

		$select_lesson_type = get_field("select_lesson_type",$value->ID);
		?>


		<div class="grid grid-cols-12 gap-5">     
			<div class="col-span-12 xl:col-span-12">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border: initial;">
					<div class="card-body flex flex-wrap">
						<a href="<?php echo get_site_url(); ?>/student-class-detail?group=<?php echo $group; ?>">
							<button style="margin-bottom: 20px;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
								<span class="align-middle">
									<?php echo get_the_title($group); ?>
								</span>
							</button>
						</a>
						<button style="margin-bottom: 20px; margin-left: 15px; background-color: #e3a72a !important;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
							<span class="align-middle">
								<?php echo $select_lesson_type[0]->post_title; ?>
							</span>
						</button>
						<div class="nav-tabs bar-tabs" style="width: 100%;">
							<ul style="width: 100% !important;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
								<li style="width: 25% !important; border-top-left-radius:20px; overflow: hidden; background-color: #f2f2f2; border: 1px solid #e3a72a;">
									<a style="width: 100%;" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-home" class="inline-block p-4 <?php if (get_field("active_quarter",$group) == 1){echo "active";} ?>">
										<i class="mdi mdi-weather-rainy ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
										Quarter 1
									</a>
								</li>
								<li style="width: 25% !important; background-color: #f2f2f2; border: 1px solid #e3a72a;">
									<a style="width: 100%;" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-Profile" class="inline-block p-4 <?php if (get_field("active_quarter",$group) == 2){echo "active";} ?>">
										<i class="mdi mdi-snowflake ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
										Quarter 2
									</a>
								</li>
								<li style="width: 25% !important; background-color: #f2f2f2; border: 1px solid #e3a72a;">
									<a style="width: 100%;" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-setting" class="inline-block p-4 <?php if (get_field("active_quarter",$group) == 3){echo "active";} ?>">
										<i class="mdi mdi-flower ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
										Quarter 3
									</a>
								</li>
								<li style="width: 25% !important; border-top-right-radius:20px; overflow: hidden; background-color: #f2f2f2; border: 1px solid #e3a72a;">
									<a style="width: 100%;" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-contact" class="inline-block p-4 <?php if (get_field("active_quarter",$group) == 4){echo "active";} ?>">
										<i class="mdi mdi-white-balance-sunny ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
										Quarter 4
									</a>
								</li>
							</ul>
							<style>
								.edit-table input{
									width: 100% !important;
								}
								h6{
									font-weight: bold;
								}
							</style>
							<div class="tab-content mt-5">
								<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1){echo "block";}else{echo "hidden";} ?>" id="underline-icon-home">
									<div class="grid grid-cols-12 gap-5">
										<?php  if(have_rows('add_quarter_1_domains', $gradebook_ID)): 
											while(have_rows('add_quarter_1_domains', $gradebook_ID)): 
												the_row(); 
												if (get_sub_field("domain_percentage") != 0) {

													$data_id_counter = get_row_index();	
													?>
													<div class="col-span-12">
														<div class="card dark:bg-zinc-800 dark:border-zinc-600 domain_div">
															<div class="card-body pb-0" style="display: flex; justify-content: space-between;">
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	<?php echo get_sub_field("domain_name"); ?>
																</h6>
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	Overall Weight : <?php echo get_sub_field("domain_percentage"); ?>(%)
																</h6>
															</div>
															<div class="card-body">
																<div class="table-responsive">
																	<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																		<thead>
																			<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																				<th class="p-3">
																					Sub Assesment
																				</th>
																				<th class="p-3">
																					Weight
																				</th>
																				<th class="p-3">
																					Rubric (Out of)
																				</th>
																				
																				<th class="p-3">
																					Marks
																				</th>
																			</tr>
																		</thead>
																		<tbody class="text-gray-600">
																			<?php  if(have_rows('add_sub_domains')): 
																				while(have_rows('add_sub_domains')): 
																					the_row(); 
																					?>
																					<tr class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_percentage">
																							<?php echo get_sub_field("sub_domain_percentage"); ?>
																						</td>
																						<td class="p-3 dark:text-zinc-100 base_on_max" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																						
																						<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																							<button style="width: 100%;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																								<span class="align-middle">
																									<?php  
																									foreach ($sonuclar as $keyler => $valueler) {
																										if ($valueler->gb_quarter_id == 1 && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == get_row_index()) {
																											echo $valueler->gb_point;
																										}
																									}
																									?>
																								</span>
																							</button>
																						</td>
																					</tr>
																					<script>
																						function updateCountdown() {
																							var countDownDate = new Date("<?php echo get_field("lock_date_q1",$group); ?>").getTime();

																							function update() {
																								var now = new Date().getTime();
																								var distance = countDownDate - now;

																								if (distance > 0) {
																									var days = Math.floor(distance / (1000 * 60 * 60 * 24));

																									document.getElementById("countdown_1_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = days+" Days ";
																									requestAnimationFrame(update);
																								} else {
																									document.getElementById("countdown_1_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = "EXPIRED";
																								}
																							}

																							update();
																						}

																						updateCountdown();
																					</script>
																				<?php endwhile; 
																			endif; ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php endwhile; 
										endif; ?>
									</div>
								</div>
								<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="underline-icon-Profile">
									<div class="grid grid-cols-12 gap-5">
										<?php  if(have_rows('add_quarter_2_domains', $gradebook_ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_ID)): 
												the_row(); 
												if (get_sub_field("domain_percentage") != 0) {

													$data_id_counter = get_row_index();	
													?>
													<div class="col-span-12">
														<div class="card dark:bg-zinc-800 dark:border-zinc-600 domain_div">
															<div class="card-body pb-0" style="display: flex; justify-content: space-between;">
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	<?php echo get_sub_field("domain_name"); ?>
																</h6>
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	Overall Weight : <?php echo get_sub_field("domain_percentage"); ?>(%)
																</h6>
															</div>
															<div class="card-body">
																<div class="table-responsive">
																	<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																		<thead>
																			<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																				<th class="p-3">
																					Sub Assesment
																				</th>
																				<th class="p-3">
																					Weight
																				</th>
																				<th class="p-3">
																					Rubric (Out of)
																				</th>
																				
																				<th class="p-3">
																					Marks
																				</th>
																			</tr>
																		</thead>
																		<tbody class="text-gray-600">
																			<?php  if(have_rows('add_sub_domains')): 
																				while(have_rows('add_sub_domains')): 
																					the_row(); 
																					?>
																					<tr class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_percentage">
																							<?php echo get_sub_field("sub_domain_percentage"); ?>
																						</td>
																						<td class="p-3 dark:text-zinc-100 base_on_max" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																					
																						<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																							<button style="width: 100%;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																								<span class="align-middle">
																									<?php  
																									foreach ($sonuclar as $keyler => $valueler) {
																										if ($valueler->gb_quarter_id == 2 && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == get_row_index()) {
																											echo $valueler->gb_point;
																										}
																									}
																									?>
																								</span>
																							</button>
																						</td>
																					</tr>
																					<script>
																						function updateCountdown() {
																							var countDownDate = new Date("<?php echo get_field("lock_date_q2",$group); ?>").getTime();

																							function update() {
																								var now = new Date().getTime();
																								var distance = countDownDate - now;

																								if (distance > 0) {
																									var days = Math.floor(distance / (1000 * 60 * 60 * 24));

																									document.getElementById("countdown_2_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = days + " Days ";
																									requestAnimationFrame(update);
																								} else {
																									document.getElementById("countdown_2_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = "EXPIRED";
																								}
																							}

																							update();
																						}

																						updateCountdown();
																					</script>
																				<?php endwhile; 
																			endif; ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php endwhile; 
										endif; ?>
									</div>
								</div>
								<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="underline-icon-setting">
									<div class="grid grid-cols-12 gap-5">
										<?php  if(have_rows('add_quarter_3_domains', $gradebook_ID)): 
											while(have_rows('add_quarter_3_domains', $gradebook_ID)): 
												the_row(); 
												if (get_sub_field("domain_percentage") != 0) {

													$data_id_counter = get_row_index();	
													?>
													<div class="col-span-12">
														<div class="card dark:bg-zinc-800 dark:border-zinc-600 domain_div">
															<div class="card-body pb-0" style="display: flex; justify-content: space-between;">
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	<?php echo get_sub_field("domain_name"); ?>
																</h6>
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	Overall Weight : <?php echo get_sub_field("domain_percentage"); ?>(%)
																</h6>
															</div>
															<div class="card-body">
																<div class="table-responsive">
																	<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																		<thead>
																			<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																				<th class="p-3">
																					Sub Assesment
																				</th>
																				<th class="p-3">
																					Weight
																				</th>
																				<th class="p-3">
																					Rubric (Out of)
																				</th>
																				
																				<th class="p-3">
																					Marks
																				</th>
																			</tr>
																		</thead>
																		<tbody class="text-gray-600">
																			<?php  if(have_rows('add_sub_domains')): 
																				while(have_rows('add_sub_domains')): 
																					the_row(); 
																					?>
																					<tr class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_percentage">
																							<?php echo get_sub_field("sub_domain_percentage"); ?>
																						</td>
																						<td class="p-3 dark:text-zinc-100 base_on_max" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																						
																						<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																							<button style="width: 100%;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																								<span class="align-middle">
																									<?php  
																									foreach ($sonuclar as $keyler => $valueler) {
																										if ($valueler->gb_quarter_id == 3 && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == get_row_index()) {
																											echo $valueler->gb_point;
																										}
																									}
																									?>
																								</span>
																							</button>
																						</td>
																					</tr>
																					<script>
																						function updateCountdown() {
																							var countDownDate = new Date("<?php echo get_field("lock_date_q3",$group); ?>").getTime();

																							function update() {
																								var now = new Date().getTime();
																								var distance = countDownDate - now;

																								if (distance > 0) {
																									var days = Math.floor(distance / (1000 * 60 * 60 * 24));

																									document.getElementById("countdown_3_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = days + " Days ";
																									requestAnimationFrame(update);
																								} else {
																									document.getElementById("countdown_3_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = "EXPIRED";
																								}
																							}

																							update();
																						}

																						updateCountdown();
																					</script>
																				<?php endwhile; 
																			endif; ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php endwhile; 
										endif; ?>
									</div>
								</div>
								<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="underline-icon-contact">
									<div class="grid grid-cols-12 gap-5">
										<?php  if(have_rows('add_quarter_4_domains', $gradebook_ID)): 
											while(have_rows('add_quarter_4_domains', $gradebook_ID)): 
												the_row(); 
												if (get_sub_field("domain_percentage") != 0) {

													$data_id_counter = get_row_index();	
													?>
													<div class="col-span-12">
														<div class="card dark:bg-zinc-800 dark:border-zinc-600 domain_div">
															<div class="card-body pb-0" style="display: flex; justify-content: space-between;">
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	<?php echo get_sub_field("domain_name"); ?>
																</h6>
																<h6 style="color:rgb(215,154,42,1.0) !important;" class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	Overall Weight : <?php echo get_sub_field("domain_percentage"); ?>(%)
																</h6>
															</div>
															<div class="card-body">
																<div class="table-responsive">
																	<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																		<thead>
																			<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																				<th class="p-3">
																					Sub Assesment
																				</th>
																				<th class="p-3">
																					Weight
																				</th>
																				<th class="p-3">
																					Rubric (Out of)
																				</th>
																				
																				<th class="p-3">
																					Marks
																				</th>
																			</tr>
																		</thead>
																		<tbody class="text-gray-600">
																			<?php  if(have_rows('add_sub_domains')): 
																				while(have_rows('add_sub_domains')): 
																					the_row(); 
																					?>
																					<tr class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																						<td class="p-3 dark:text-zinc-100" data-field="sub_domain_percentage">
																							<?php echo get_sub_field("sub_domain_percentage"); ?>
																						</td>
																						<td class="p-3 dark:text-zinc-100 base_on_max" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																						
																						<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																							<button style="width: 100%;" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																								<span class="align-middle">
																									<?php  
																									foreach ($sonuclar as $keyler => $valueler) {
																										if ($valueler->gb_quarter_id == 4 && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == get_row_index()) {
																											echo $valueler->gb_point;
																										}
																									}
																									?>
																								</span>
																							</button>
																						</td>
																					</tr>
																					<script>
																						function updateCountdown() {
																							var countDownDate = new Date("<?php echo get_field("lock_date_q4",$group); ?>").getTime();

																							function update() {
																								var now = new Date().getTime();
																								var distance = countDownDate - now;

																								if (distance > 0) {
																									var days = Math.floor(distance / (1000 * 60 * 60 * 24));

																									document.getElementById("countdown_4_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = days + " Days ";
																									requestAnimationFrame(update);
																								} else {
																									document.getElementById("countdown_4_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>").innerHTML = "EXPIRED";
																								}
																							}

																							update();
																						}

																						updateCountdown();
																					</script>
																				<?php endwhile; 
																			endif; ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php endwhile; 
										endif; ?>
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




<?php include 'footer.php';?>