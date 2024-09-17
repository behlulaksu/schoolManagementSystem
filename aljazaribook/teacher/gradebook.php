<?php /* Template Name: Gradebook */ ?>

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

?>

<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">


			<?php 
			$selected_lesson = get_field("select_gradebook_definition",$subject);
			$gradebook_ID = $selected_lesson[0]->ID;
			$group_users = get_field("group_users",$group);
			$how_much_user = count($group_users);
			?>

			<?php 
			if (get_teacher_access($group,$subject) || $current_user_now->roles[0] === 'hod' || $current_user_now->roles[0] === 'administrator' || $current_user_now->roles[0] === 'viceprincipal' || $current_user_now->roles[0] === 'principal') {
				?>
				<div class="grid grid-cols-12 gap-5">     
					<div class="col-span-12 xl:col-span-12">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border: initial;">
							<div class="card-body flex flex-wrap">
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
											<a href="<?php echo get_site_url(); ?>/subject-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=1">
												<button style="margin-bottom: 7px;" type="button" class="btn bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													<span class="align-middle">
														Assessment Base Chart
													</span>
												</button>
											</a>
											<button style="margin-bottom: 7px;" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" data-tw-toggle="modal" data-tw-target="#student_list">
												<i style="margin-right: 5px;" class="dripicons-user group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												<span class="align-middle">
													Student Report
												</span>
											</button>
											<button quarter="1" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#student_list_commentq1">
												<i class="mdi mdi-draw-pen"></i>
												<span class="align-middle">
													Save Commnet
												</span>
											</button>
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
																							Marking Deadline
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Students
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
																								<td class="p-3 dark:text-zinc-100 deadline" data-field="to">
																									<div id="countdown_1_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>"></div>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="open_mode">
																									<?php 
																									if (get_sub_field("open_mode") === "Close") {
																										echo "Locked";
																									}else{
																										echo "Open";
																									}
																									?>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																									<button type="button" quarter="1" domain_id="<?php echo $data_id_counter; ?>" sub_domain_id="<?php echo get_row_index(); ?>" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#point_popup">
																										<i class="mdi mdi-clipboard-multiple-outline"></i>
																										<span class="align-middle">
																											Asst Marking
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
											<div class="remining_time">
												<h3>
													Remaining Time For Next Report Generation
												</h3>
												<div class="count-down-container">
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="days1">00</h1>
															<p>Days</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="hours1">00</h1>
															<p>Hours</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="minutes1">00</h1>
															<p>Minutes</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="seconds1">00</h1>
															<p>Seconds</p>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body"> 
												<h5 style="text-align: center; color: #8f1537 !important;" class="mb-1">Subject Comment</h5>
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Student Name
																</th>
																<th scope="col" class="px-6 py-3">
																	Subject Comment
																</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															foreach ($group_users as $keya => $valuess) {
																?>
																<tr class="bg-white border-b border-bordo-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<?php echo $valuess['display_name']; ?>
																	</td>
																	<?php  
																	$dolu = "";
																	$comment_control = get_subject_comment($subject, 1, $valuess['ID']);
																	if (!empty($comment_control)) {
																		$dolu = "dolu_comment";
																	}
																	?>
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<button type="button" class="<?php echo $dolu; ?> btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#q1_commetn_<?php echo $valuess['ID']; ?>">
																			Comment List
																		</button>
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
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="underline-icon-Profile">
											<a href="<?php echo get_site_url(); ?>/subject-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=2">
												<button style="margin-bottom: 7px;" type="button" class="popop_button btn bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													<span class="align-middle">
														Assessment Base Chart
													</span>
												</button>
											</a>
											<button style="margin-bottom: 7px;" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" data-tw-toggle="modal" data-tw-target="#student_list">
												<i style="margin-right: 5px;" class="dripicons-user group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												<span class="align-middle">
													Student Report
												</span>
											</button>
											<button quarter="2" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#student_list_commentq2">
												<i class="mdi mdi-draw-pen"></i>
												<span class="align-middle">
													Save Commnet
												</span>
											</button>
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
																							Marking Deadline
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Students
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
																								<td class="p-3 dark:text-zinc-100 deadline" data-field="from">
																									<div id="countdown_2_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>"></div>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="open_mode">
																									<?php 
																									if (get_sub_field("open_mode") === "Close") {
																										echo "Locked";
																									}else{
																										echo "Open";
																									}
																									?>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																									<button type="button" quarter="2" domain_id="<?php echo $data_id_counter; ?>" sub_domain_id="<?php echo get_row_index(); ?>" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#point_popup">
																										<i class="mdi mdi-clipboard-multiple-outline"></i>
																										<span class="align-middle">
																											Asst Marking
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
											<div class="remining_time">
												<h3>
													Remaining Time For Next Report Generation
												</h3>
												<div class="count-down-container">
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="days2">00</h1>
															<p>Days</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="hours2">00</h1>
															<p>Hours</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="minutes2">00</h1>
															<p>Minutes</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="seconds2">00</h1>
															<p>Seconds</p>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body"> 
												<h5 style="text-align: center; color: #8f1537 !important;" class="mb-1">Subject Comment</h5>
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Student Name
																</th>
																<th scope="col" class="px-6 py-3">
																	Subject Comment
																</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															foreach ($group_users as $keya => $valuess) {
																?>
																<tr class="bg-white border-b border-bordo-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<?php echo $valuess['display_name']; ?>
																	</td>
																	<?php  
																	$dolu = "";
																	$comment_control = get_subject_comment($subject, 2, $valuess['ID']);
																	if (!empty($comment_control)) {
																		$dolu = "dolu_comment";
																	}
																	?>
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<button type="button" class="<?php echo $dolu; ?> btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#q2_commetn_<?php echo $valuess['ID']; ?>">
																			Comment List
																		</button>
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
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="underline-icon-setting">
											<a href="<?php echo get_site_url(); ?>/subject-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=3">
												<button style="margin-bottom: 7px;" type="button" class="popop_button btn bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													<span class="align-middle">
														Assessment Base Chart
													</span>
												</button>
											</a>
											<button style="margin-bottom: 7px;" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" data-tw-toggle="modal" data-tw-target="#student_list">
												<i style="margin-right: 5px;" class="dripicons-user group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												<span class="align-middle">
													Student Report
												</span>
											</button>
											<button quarter="3" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#student_list_commentq3">
												<i class="mdi mdi-draw-pen"></i>
												<span class="align-middle">
													Save Commnet
												</span>
											</button>
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
																							Marking Deadline
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Students
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
																								<td class="p-3 dark:text-zinc-100 deadline" data-field="from">
																									<div id="countdown_3_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>"></div>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="open_mode">
																									<?php 
																									if (get_sub_field("open_mode") === "Close") {
																										echo "Locked";
																									}else{
																										echo "Open";
																									}
																									?>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																									<button type="button" quarter="3" domain_id="<?php echo $data_id_counter; ?>" sub_domain_id="<?php echo get_row_index(); ?>" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#point_popup">
																										<i class="mdi mdi-clipboard-multiple-outline"></i>
																										<span class="align-middle">
																											Asst Marking
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
											<div class="remining_time">
												<h3>
													Remaining Time For Next Report Generation
												</h3>
												<div class="count-down-container">
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="days3">00</h1>
															<p>Days</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="hours3">00</h1>
															<p>Hours</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="minutes3">00</h1>
															<p>Minutes</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="seconds3">00</h1>
															<p>Seconds</p>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body"> 
												<h5 style="text-align: center; color: #8f1537 !important;" class="mb-1">Subject Comment</h5>
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Student Name
																</th>
																<th scope="col" class="px-6 py-3">
																	Subject Comment
																</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															foreach ($group_users as $keya => $valuess) {
																?>
																<tr class="bg-white border-b border-bordo-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<?php echo $valuess['display_name']; ?>
																	</td>
																	<?php  
																	$dolu = "";
																	$comment_control = get_subject_comment($subject, 3, $valuess['ID']);
																	if (!empty($comment_control)) {
																		$dolu = "dolu_comment";
																	}
																	?>
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<button type="button" class="<?php echo $dolu; ?> btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#q3_commetn_<?php echo $valuess['ID']; ?>">
																			Comment List
																		</button>
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
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="underline-icon-contact">
											<a href="<?php echo get_site_url(); ?>/subject-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=4">
												<button style="margin-bottom: 7px;" type="button" class="popop_button btn bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													<span class="align-middle">
														Assessment Base Chart
													</span>
												</button>
											</a>
											<button style="margin-bottom: 7px;" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" data-tw-toggle="modal" data-tw-target="#student_list">
												<i style="margin-right: 5px;" class="dripicons-user group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												<span class="align-middle">
													Student Report
												</span>
											</button>
											<button quarter="4" type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#student_list_commentq4">
												<i class="mdi mdi-draw-pen"></i>
												<span class="align-middle">
													Save Commnet
												</span>
											</button>
											<button type="button" class="btn bg-neutral-500 border-neutral-500 text-white hover:bg-neutral-600 focus:ring ring-neutral-200 focus:bg-neutral-600" data-tw-toggle="modal" data-tw-target="#final_projesi">
												<i class="mdi mdi-arrow-projectile"></i>
												<span class="align-middle">
													Final Project
												</span>
											</button>
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
																							Marking Deadline
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Students
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
																								<td class="p-3 dark:text-zinc-100 deadline" data-field="from">
																									<div id="countdown_4_<?php echo $data_id_counter; ?>_<?php echo get_row_index(); ?>"></div>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="open_mode">
																									<?php 
																									if (get_sub_field("open_mode") === "Close") {
																										echo "Locked";
																									}else{
																										echo "Open";
																									}
																									?>
																								</td>
																								<td class="p-3 dark:text-zinc-100" data-field="student_lists">
																									<button type="button" quarter="4" domain_id="<?php echo $data_id_counter; ?>" sub_domain_id="<?php echo get_row_index(); ?>" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#point_popup">
																										<i class="mdi mdi-clipboard-multiple-outline"></i>
																										<span class="align-middle">
																											Asst Marking
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
											<div class="remining_time">
												<h3>
													Remaining Time For Next Report Generation
												</h3>
												<div class="count-down-container">
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="days4">00</h1>
															<p>Days</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="hours4">00</h1>
															<p>Hours</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="minutes4">00</h1>
															<p>Minutes</p>
														</div>
													</div>
													<div class="count-down-box">
														<div class="count-down">
															<h1 id="seconds4">00</h1>
															<p>Seconds</p>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body"> 
												<h5 style="text-align: center; color: #8f1537 !important;" class="mb-1">Subject Comment</h5>
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Student Name
																</th>
																<th scope="col" class="px-6 py-3">
																	Subject Comment
																</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															foreach ($group_users as $keya => $valuess) {
																?>
																<tr class="bg-white border-b border-bordo-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<?php echo $valuess['display_name']; ?>
																	</td>
																	<?php  
																	$dolu = "";
																	$comment_control = get_subject_comment($subject, 4, $valuess['ID']);
																	if (!empty($comment_control)) {
																		$dolu = "dolu_comment";
																	}
																	?>
																	<td class="px-6 py-3.5 dark:text-zinc-100">
																		<button type="button" class="<?php echo $dolu; ?> btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#q4_commetn_<?php echo $valuess['ID']; ?>">
																			Comment List
																		</button>
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
						</div>
					</div>  
				</div>
				<?php 
			}else{
				echo access_denieded(get_current_user_id(),"gradebook","gradebook");
			} 
			?>


		</div>
	</div>
</div>

<?php 

foreach ($group_users as $key => $value) {
	?>
	<div class="modal relative z-50 hidden" id="q1_commetn_<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-xl mx-auto" style="max-width: 80rem !important;">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo $value['display_name']; ?>
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 65vh; overflow-y: scroll;">
							<div class="flex items-center mb-4">
								<div>
									<?php 
									if(have_rows('add_subject_comment_q1', $subject)): 
										while(have_rows('add_subject_comment_q1', $subject)): 
											the_row(); 
											$subject_comments = "subject_comments";
											$comment_control = get_subject_comment($subject, 1, $value['ID']);
											$kontrol = intval($comment_control[0]->comment_order);
											?>
											<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
												<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="subject_1_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" type="radio" name="subject_com_1_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
												<label for="subject_1_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
													<?php 
													$metin = get_sub_field("comment"); 
													$eski = "[student-name]";
													$yeni = $value['display_name'];
													echo str_replace($eski, $yeni, $metin);
													?>
												</label>
											</div>
											<?php  
										endwhile; 
									endif;
									?>
								</div>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
							<button com_student_id="<?php echo $value['ID']; ?>" com_quarter_id="1" type="button" class="sava_select_comment btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 <?php if (get_field("active_quarter",$group) == 1){echo "calisan_buton";}?>">
								Save Comment
							</button>
							<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
foreach ($group_users as $key => $value) {
	?>
	<div class="modal relative z-50 hidden" id="q2_commetn_<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-xl mx-auto" style="max-width: 80rem !important;">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo $value['display_name']; ?>
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 65vh; overflow-y: scroll;">
							<div class="flex items-center mb-4">
								<div>
									<?php 
									if(have_rows('add_subject_comment_q2', $subject)): 
										while(have_rows('add_subject_comment_q2', $subject)): 
											the_row(); 
											$subject_comments = "subject_comments";
											$comment_control = get_subject_comment($subject, 2, $value['ID']);
											$kontrol = intval($comment_control[0]->comment_order);
											?>
											<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
												<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="subject_2_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" type="radio" name="subject_com_2_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
												<label for="subject_2_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
													<?php 
													$metin = get_sub_field("comment"); 
													$eski = "[student-name]";
													$yeni = $value['display_name'];
													echo str_replace($eski, $yeni, $metin);
													?>
												</label>
											</div>
											<?php  
										endwhile; 
									endif;
									?>
								</div>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
							<button com_student_id="<?php echo $value['ID']; ?>" com_quarter_id="2" type="button" class="sava_select_comment btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 <?php if (get_field("active_quarter",$group) == 2){echo "calisan_buton";}?>">
								Save Comment
							</button>
							<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
foreach ($group_users as $key => $value) {
	?>
	<div class="modal relative z-50 hidden" id="q3_commetn_<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-xl mx-auto" style="max-width: 80rem !important;">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo $value['display_name']; ?>
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 65vh; overflow-y: scroll;">
							<div class="flex items-center mb-4">
								<div>
									<?php 
									if(have_rows('add_subject_comment_q3', $subject)): 
										while(have_rows('add_subject_comment_q3', $subject)): 
											the_row(); 
											$subject_comments = "subject_comments";
											$comment_control = get_subject_comment($subject, 3, $value['ID']);
											$kontrol = intval($comment_control[0]->comment_order);
											?>
											<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
												<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="subject_3_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" type="radio" name="subject_com_3_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
												<label for="subject_3_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
													<?php 
													$metin = get_sub_field("comment"); 
													$eski = "[student-name]";
													$yeni = $value['display_name'];
													echo str_replace($eski, $yeni, $metin);
													?>
												</label>
											</div>
											<?php  
										endwhile; 
									endif;
									?>
								</div>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
							<button com_student_id="<?php echo $value['ID']; ?>" com_quarter_id="3" type="button" class="sava_select_comment btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 <?php if (get_field("active_quarter",$group) == 3){echo "calisan_buton";}?>">
								Save Comment
							</button>
							<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
foreach ($group_users as $key => $value) {
	?>
	<div class="modal relative z-50 hidden" id="q4_commetn_<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-xl mx-auto" style="max-width: 80rem !important;">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo $value['display_name']; ?>
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 65vh; overflow-y: scroll;">
							<div class="flex items-center mb-4">
								<div>
									<?php 
									if(have_rows('add_subject_comment_q4', $subject)): 
										while(have_rows('add_subject_comment_q4', $subject)): 
											the_row(); 
											$subject_comments = "subject_comments";
											$comment_control = get_subject_comment($subject, 4, $value['ID']);
											$kontrol = intval($comment_control[0]->comment_order);
											?>
											<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
												<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="subject_4_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" type="radio" name="subject_com_4_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
												<label for="subject_4_com-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
													<?php 
													$metin = get_sub_field("comment"); 
													$eski = "[student-name]";
													$yeni = $value['display_name'];
													echo str_replace($eski, $yeni, $metin);
													?>
												</label>
											</div>
											<?php  
										endwhile; 
									endif;
									?>
								</div>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
							<button com_student_id="<?php echo $value['ID']; ?>" com_quarter_id="4" type="button" class="sava_select_comment btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 <?php if (get_field("active_quarter",$group) == 4){echo "calisan_buton";}?>">
								Save Comment
							</button>
							<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
?>





<script>
	student_id = [];
</script>
<?php 
for ($i=1; $i < 5; $i++) { 
	?>
	<div class="modal relative z-50 hidden" id="student_list_commentq<?php echo $i; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								Subject Comment
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="overflow-y: scroll; max-height: 70vh;">
							<table class="w-full text-sm text-left text-gray-500 ">
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr style="background-color: #8f1537; color: rgb(215,154,42,1.0) !important;" class="border border-gray-50 dark:border-zinc-600">
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Student Number
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Stundet Name
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Student Commenet Area
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($group_users as $key => $value) {
										?>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
												<script>
													student_id[<?php echo $key; ?>] = <?php echo $value['ID']; ?>;
												</script>
											</td>
											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<?php echo $value['display_name']; ?>
											</td>
											<td style="background-color: #cfcfcf; width: 60%;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<textarea comment_student_id="<?php echo $value['ID']; ?>" commnet_subject_quarter='<?php echo $i; ?>' rows="4" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"><?php 
												echo get_student_comment($group,$subject,$i,$value['ID'],'subject_comment')[0]->comment;
											?></textarea>
										</td>
									</tr>
									<?php 
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
						<?php if (get_field("active_quarter",$group) == $i): ?>
							<button quarter="<?php echo $i; ?>" type="button" class="save_comment_subject btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
								Save Comments
							</button>
						<?php endif ?>
						<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
}
?>


<div class="modal relative z-50 hidden" id="final_projesi" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
						<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
							Final Project List
						</h3>
						<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
							<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
						</button>
					</div>
					<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="overflow-y: scroll; max-height: 70vh;">
						<table class="w-full text-sm text-left text-gray-500 ">
							<thead class="text-sm text-gray-700 dark:text-gray-100">
								<tr style="background-color: #8f1537; color: rgb(215,154,42,1.0) !important;" class="border border-gray-50 dark:border-zinc-600">
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Student Number
									</th>
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Stundet Name
									</th>
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Project
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$blog_id = get_current_blog_id();
								$bg_table_name = "final_project";
								global $wpdb;
								$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and class_id =".$group." and subject_id =".$subject."" );
								$project_control = $wpdb->get_results($query);
								// echo "<pre>";
								// print_r($project_control);
								// echo "<pre>";

								foreach ($group_users as $key => $value) {
									?>
									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php echo $value['display_name']; ?>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php 
											$kontrol = 0;
											foreach ($project_control as $keyler => $valueler) {
												if ($valueler->student_id == $value['ID'] && $valueler->did_project == 1) {
													?>
													<button student_project_id="<?php echo $value['ID']; ?>" type="button" class="didnt_project btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
														<i class="bx bx-check-double bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
														<span class="px-3 leading-[2.8]">
															Complete
														</span>
													</button>
													<?php 
													$kontrol = 1;
												}
											}
											if ($kontrol == 0) {
												?>
												<button student_project_id="<?php echo $value['ID']; ?>" type="button" class="did_project btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
													<i class="bx bx-check-double bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">
														Not Complete
													</span>
												</button>
												<?php 
											}
											?>
										</td>
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

<div class="modal relative z-50 hidden" id="point_popup" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
						<h3 id="sub_domain_name" class="text-xl font-semibold text-gray-900 dark:text-gray-100 "></h3>
						<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
							<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
						</button>
					</div>
					<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="overflow-y: scroll; max-height: 70vh;">
						<table class="w-full text-sm text-left text-gray-500 ">
							<thead class="text-sm text-gray-700 dark:text-gray-100">
								<tr style="background-color: #8f1537; color: rgb(215,154,42,1.0) !important;" class="border border-gray-50 dark:border-zinc-600">
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Student Number
									</th>
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Stundet Name
									</th>
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Mark
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Last Editor ID
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Date & Time
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($group_users as $key => $value) {
									?>
									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											<script>
												student_id[<?php echo $key; ?>] = <?php echo $value['ID']; ?>;
											</script>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php echo $value['display_name']; ?>
										</td>

										<td style="background-color: #cfcfcf;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<input value="" class="student_point w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" max="50" placeholder="Max Point 50" id="id_of_point" point_student_id="<?php echo $value['ID']; ?>">
										</td>
										<td style="text-align: center;" teacher_id="<?php echo $value['ID']; ?>" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100"></td>
										<td style="text-align: center;" style="text-align: center;" data_id="<?php echo $value['ID']; ?>" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100"></td>
									</tr>
									<?php 
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- Modal footer -->
					<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
						<button type="button" class="saveButton btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
							Save Mark
						</button>
						<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.bxs-bar-chart-alt-2:before{
		color: #fff !important;
	}
</style>
<div class="modal relative z-50 hidden" id="student_list" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
						<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
							Student List
						</h3>
						<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
							<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
						</button>
					</div>
					<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 70vh; overflow-y: scroll;">
						<table class="w-full text-sm text-left text-gray-500 ">
							<thead class="text-sm text-gray-700 dark:text-gray-100">
								<tr class="border border-gray-50 dark:border-zinc-600">
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Student Number
									</th>
									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Student Name
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Report <br> Q1
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Report <br> Q2
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Report <br> Q3
									</th>
									<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
										Report <br> Q4
									</th>
								</tr>
							</thead>
							<tbody>

								<?php  
								foreach ($group_users as $key => $value) {
									?>
									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
										</th>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php echo $value['display_name']; ?>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-detail-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=1&student=<?php echo $value['ID']; ?>">
												<button type="button" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
													<i style="color: #fff !important;" class="bx bxs-bar-chart-alt-2 h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-detail-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=2&student=<?php echo $value['ID']; ?>">
												<button type="button" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
													<i style="color: #fff !important;" class="bx bxs-bar-chart-alt-2 h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-detail-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=2&student=<?php echo $value['ID']; ?>">
												<button type="button" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
													<i style="color: #fff !important;" class="bx bxs-bar-chart-alt-2 h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-detail-report?group=<?php echo $group; ?>&subject=<?php echo $subject; ?>&quarter=2&student=<?php echo $value['ID']; ?>">
												<button type="button" class="point_popop_button btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
													<i style="color: #fff !important;" class="bx bxs-bar-chart-alt-2 h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
												</button>
											</a>
										</td>
									</tr>
									<?php 
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- Modal footer -->
					<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
						<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<style>
	.sava_select_comment{
		display: none;
	}
	.calisan_buton{
		display: block !important;
	}
	.dolu_comment{
		background-color: green !important;
		color: #fff !important;
	}
	.ring-red-200{
		background-color: #8f1537 !important;
	}
	.ring-red-200:hover{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.ring-red-200:focus{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.remining_time{
		padding: 15px;
		border-radius: 7px;
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.remining_time h3{
		text-align: center;
		color: #8f1537 !important;
		padding-bottom: 15px;
	}
	.count-down-container {
		border-radius: 10px;
		overflow: hidden;
		display: flex;
		width: 600px;
		height: 150px;
	}

	.count-down-box {
		text-shadow: 2px 2px rgba(0, 0, 0, 0.3);
		place-items: center;
		text-align: center;
		display: grid;
		height: 100%;
		width: 100%;
	}

	.count-down-box:nth-child(1) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(2) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(3) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(4) {
		background-color: #8f1537 !important;
	}

	.count-down-box h1 {
		font-size: 60px;
		color: white;
	}

	.count-down-box p {
		font-size: 13px;
		color: white;
	}
</style>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>

	$(document).ready(function(){
		$(".did_project").click(function(){
			student_project_id = $(this).attr('student_project_id');
			Swal.fire({
				title: "Are you sure?",
				text: "Approving the student project will change all of the student's grades, including previous semesters.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					/*ajax start*/
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_add_project',
							class_id:<?php echo $group; ?>,
							subject_id:<?php echo $subject; ?>,
							student_project_id:student_project_id,
						}),
						success: function(data){
							if (data.data === "tamam") {
								Swal.fire("Done", "", "success");
								$('[student_project_id="'+student_project_id+'"] i').css("color","green");
								$('[student_project_id="'+student_project_id+'"] span').text("Complete");
							}
							console.log(data.data);
						}
					});
					/*ajax end*/
				}
			});

		});

		$(".didnt_project").click(function(){
			student_project_id = $(this).attr('student_project_id');
			Swal.fire({
				title: "Are you sure?",
				text: "Canceling a student's project does not change the calculated project grade, if any. If you are unsure about the transaction, please contact your level manager.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					/*ajax start*/
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_cancel_project',
							class_id:<?php echo $group; ?>,
							subject_id:<?php echo $subject; ?>,
							student_project_id:student_project_id,
						}),
						success: function(data){
							if (data.data === "tamam") {
								Swal.fire("Done", "", "success");
								$('[student_project_id="'+student_project_id+'"] i').css("color","red");
								$('[student_project_id="'+student_project_id+'"] span').text("Not Complete");
							}
							console.log(data.data);
						}
					});
					/*ajax end*/
				}
			});
		});


	});


	$(document).ready(function(){
		$("#header_title").text("Gradebook <?php echo get_the_title($group); ?> - <?php echo get_the_title($subject); ?>");
		domain_div = $(".domain_div");
		for (var i = 0; i < domain_div.length; i++) {
			if (i % 2 === 0) {
				domain_div[i].style.backgroundColor = '#f2f2f2';
			}
		}



		$(".sava_select_comment").click(function(){
			com_student_id = $(this).attr('com_student_id');
			com_quarter_id = $(this).attr('com_quarter_id');
			secilen_normal_comment = "";
			pdp_normal = [];
			pdp_normal = $("[name='subject_com_"+com_quarter_id+"_"+com_student_id+"']");
			for (var i = 0; i < pdp_normal.length; i++) {
				if (pdp_normal[i].checked) {
					secilen_normal_comment = i+1;
				}
			}
			console.log(secilen_normal_comment);

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_subject_comment',

					subject_id:<?php echo $subject; ?>,
					com_student_id:com_student_id,
					com_quarter_id:com_quarter_id,
					secilen_normal_comment:secilen_normal_comment,
				}),
				success: function(data){
					console.log(data.data);
					if (data.data == "tamam") {
						Swal.fire(
						{
							title: 'Done',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});


		});

		$(".save_comment_subject").click(function(){
			group_id_comment = <?php echo $group; ?>;
			subject_id_commnet = <?php echo $subject; ?>;
			quarter_comment_btn = $(this).attr("quarter");
			comment_type = "subject_comment";

			studet_id_array = [];
			student_comment_array = [];
			gonderilecek_comment = $("[commnet_subject_quarter='"+quarter_comment_btn+"']");
			for (var i = 0; i < gonderilecek_comment.length; i++) {
				studet_id_array[i] = gonderilecek_comment[i].attributes.comment_student_id.value;
				student_comment_array[i] = gonderilecek_comment[i].value;
			}

			var values = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_comment_save',

					group_id_comment:group_id_comment,
					subject_id_commnet:subject_id_commnet,
					quarter_comment_btn:quarter_comment_btn,
					comment_type:comment_type,
					studet_id_array:studet_id_array,
					student_comment_array:student_comment_array,

				}),
				success: function(data){
					if (data.data != "problem") {
						Swal.fire(
						{
							title: 'Comments Saved',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}else{
						console.log(data.data);
						Swal.fire({
							title: "Didn't Work",
							text: "It looks like we have a projlem.",
							icon: "warning",
							showCancelButton: false,
							confirmButtonColor: "#8f1537",
						})
					}
				}

			});


		});

		how_much_users = <?php echo $how_much_user; ?>;
		$(".point_popop_button").click(function(){

			student_point_length = $('.student_point');
			for (var i = 0; i < student_point_length.length; i++) {
				$('.student_point')[i].value = "";
			}

			button_quarter = $(this).attr("quarter");
			button_domain_id = $(this).attr("domain_id");
			button_sub_domain_id = $(this).attr("sub_domain_id");

			this_class_id = <?php echo $group; ?>;
			this_subject_id = <?php echo $subject; ?>;
			gradebook_id = <?php echo $gradebook_ID; ?>;

			selected_td_this = $(this);
			selected_td = selected_td_this.parent().parent().find(".base_on_max")[0].textContent;
			selected_subdomain = selected_td_this.parent().parent().find("[data-field='sub_domain_name']")[0].textContent;
			selected_deadline = selected_td_this.parent().parent().find(".deadline")[0].innerText;
			if (selected_deadline === "EXPIRED") {
				$(".saveButton").css("display","none");
			}else{
				$(".saveButton").css("display","block");
			}

			var values = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_get_point',

					button_quarter:button_quarter,
					button_domain_id:button_domain_id,
					button_sub_domain_id:button_sub_domain_id,
					this_class_id:this_class_id,
					this_subject_id:this_subject_id,
					gradebook_id:gradebook_id,

				}),
				success: function(baska){
					console.log(baska);
					$("#sub_domain_name").text(selected_subdomain);
					$("[point_student_id]").attr("max",""+selected_td+"");
					$("[point_student_id]").attr("placeholder","Max Point "+selected_td+"");

					if (baska.data.length === 0) {
						for (var i = 0; i < how_much_users+1; i++) {
							$("[point_student_id]").val("");
							$("[teacher_id]").text("");
							$("[data_id]").text("");
						}
					}else{
						for (var i = 0; i < how_much_users+1; i++) {
							$("[point_student_id='"+baska.data[i]['gb_student_id']+"']").val(baska.data[i]['gb_point']);
							$("[teacher_id='"+baska.data[i]['gb_student_id']+"']").text(baska.data[i]['gb_teacher_id']);
							$("[data_id='"+baska.data[i]['gb_student_id']+"']").text(baska.data[i]['gb_update_date']+" "+baska.data[i]['gb_update_time']);
						}
					}

				}

			});



		});


		inputElement = $('.student_point');

		inputElement.on('input change', function() {
			const inputValue = event.target.value;

			const maxValue = $(this).attr("max");

			if (parseFloat(inputValue) > maxValue) {
				event.target.value = maxValue; 
			} 
		});


		/* Update Gradebook */
		$(".saveButton").click(function(){
			/*General Information*/
			group = <?php echo $group; ?>;
			subject = <?php echo $subject; ?>;
			current_user_id = <?php echo $current_user_now->data->ID; ?>;
			gradebook_ID = <?php echo $gradebook_ID; ?>;

			/*Student Information*/
			student_point = [];

			student_list = $("#point_popup").find(".student_point");
			for (var i = student_list.length - 1; i >= 0; i--) {
				student_point[i] = student_list[i].value;
			}

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_save_point',

					group:group,
					subject:subject,
					current_user_id:current_user_id,
					gradebook_ID:gradebook_ID,
					domainID:button_domain_id,
					subDomainID:button_sub_domain_id,
					quarterID:button_quarter,

					student_id:student_id,
					student_point:student_point,


				}),
				success: function(data){
					if (data.data != "problem") {
						Swal.fire(
						{
							title: 'Marking Saved',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}else{
						console.log(data.data);
						Swal.fire({
							title: "Didn't Work",
							text: "It looks like you didn't enter any notes to save.",
							icon: "warning",
							showCancelButton: false,
							confirmButtonColor: "#8f1537",
						})
					}
				}

			});
		});



	});




/****************************Timer Baslangic Alani*****************************************/

/*Q1*/
const remDays1 = document.getElementById("days1");
const remHours1 = document.getElementById("hours1");
const remMinutes1 = document.getElementById("minutes1");
const remSeconds1 = document.getElementById("seconds1");


var countDownDate1 = new Date("<?php echo get_field("lock_date_q1",$group); ?>").getTime();
var currentTime = new Date().getTime();
controlDate = countDownDate1 - currentTime;
if (controlDate > 0) {
	const formatTime = (time) => (time < 10 ? `0${time}` : time);

	const countdown = () => {
		const lastDayDate = new Date(countDownDate1);
		const currentDate = new Date();

		const totalSeconds = (lastDayDate - currentDate) / 1000;

		const days = Math.floor(totalSeconds / 3600 / 24);
		const hours = Math.floor(totalSeconds / 3600) % 24;
		const mins = Math.floor(totalSeconds / 60) % 60;
		const seconds = Math.floor(totalSeconds) % 60;

		remDays1.innerHTML = days;
		remHours1.innerHTML = formatTime(hours);
		remMinutes1.innerHTML = formatTime(mins);
		remSeconds1.innerHTML = formatTime(seconds);
	};
	countdown();

	setInterval(countdown, 1000);	
}


/*Q2*/
const remDays2 = document.getElementById("days2");
const remHours2 = document.getElementById("hours2");
const remMinutes2 = document.getElementById("minutes2");
const remSeconds2 = document.getElementById("seconds2");


var countDownDate2 = new Date("<?php echo get_field("lock_date_q2",$group); ?>").getTime();
var currentTime = new Date().getTime();
controlDate = countDownDate2 - currentTime;
if (controlDate > 0) {
	const formatTime = (time) => (time < 10 ? `0${time}` : time);

	const countdown = () => {
		const lastDayDate = new Date(countDownDate2);
		const currentDate = new Date();

		const totalSeconds = (lastDayDate - currentDate) / 1000;

		const days = Math.floor(totalSeconds / 3600 / 24);
		const hours = Math.floor(totalSeconds / 3600) % 24;
		const mins = Math.floor(totalSeconds / 60) % 60;
		const seconds = Math.floor(totalSeconds) % 60;

		remDays2.innerHTML = days;
		remHours2.innerHTML = formatTime(hours);
		remMinutes2.innerHTML = formatTime(mins);
		remSeconds2.innerHTML = formatTime(seconds);
	};
	countdown();

	setInterval(countdown, 1000);	
}

/*Q3*/
const remDays3 = document.getElementById("days3");
const remHours3 = document.getElementById("hours3");
const remMinutes3 = document.getElementById("minutes3");
const remSeconds3 = document.getElementById("seconds3");


var countDownDate3 = new Date("<?php echo get_field("lock_date_q3",$group); ?>").getTime();
var currentTime = new Date().getTime();
controlDate = countDownDate3 - currentTime;
if (controlDate > 0) {
	const formatTime = (time) => (time < 10 ? `0${time}` : time);

	const countdown = () => {
		const lastDayDate = new Date(countDownDate3);
		const currentDate = new Date();

		const totalSeconds = (lastDayDate - currentDate) / 1000;

		const days = Math.floor(totalSeconds / 3600 / 24);
		const hours = Math.floor(totalSeconds / 3600) % 24;
		const mins = Math.floor(totalSeconds / 60) % 60;
		const seconds = Math.floor(totalSeconds) % 60;

		remDays3.innerHTML = days;
		remHours3.innerHTML = formatTime(hours);
		remMinutes3.innerHTML = formatTime(mins);
		remSeconds3.innerHTML = formatTime(seconds);
	};
	countdown();

	setInterval(countdown, 1000);	
}


/*Q4*/
const remDays4 = document.getElementById("days4");
const remHours4 = document.getElementById("hours4");
const remMinutes4 = document.getElementById("minutes4");
const remSeconds4 = document.getElementById("seconds4");


var countDownDate4 = new Date("<?php echo get_field("lock_date_q4",$group); ?>").getTime();
var currentTime = new Date().getTime();
controlDate = countDownDate4 - currentTime;
if (controlDate > 0) {
	const formatTime = (time) => (time < 10 ? `0${time}` : time);

	const countdown = () => {
		const lastDayDate = new Date(countDownDate4);
		const currentDate = new Date();

		const totalSeconds = (lastDayDate - currentDate) / 1000;

		const days = Math.floor(totalSeconds / 3600 / 24);
		const hours = Math.floor(totalSeconds / 3600) % 24;
		const mins = Math.floor(totalSeconds / 60) % 60;
		const seconds = Math.floor(totalSeconds) % 60;

		remDays4.innerHTML = days;
		remHours4.innerHTML = formatTime(hours);
		remMinutes4.innerHTML = formatTime(mins);
		remSeconds4.innerHTML = formatTime(seconds);
	};
	countdown();

	setInterval(countdown, 1000);	
}


</script>
