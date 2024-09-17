<?php /* Template Name: curriculum-breakdown */ ?>
<?php get_header(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/icons.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind.css" />
<?php $current_user_id = get_current_user_id(); ?>
<?php 
if (isset($_GET['subject'])){
	$subject = strip_tags($_GET["subject"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
if (isset($_GET['grade'])){
	$group = strip_tags($_GET["grade"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$blog_id = get_current_blog_id();

$bg_table_name_name = "subject_hours";
$query = $wpdb->prepare("SELECT * from $bg_table_name_name where blog_id =".$blog_id." and class_id =".$group." and subject_id=".$subject );
$weeklyPeriods = $wpdb->get_results($query)[0]->subject_hours;



$results = $wpdb->get_results(
	$wpdb->prepare(
		"SELECT * FROM curriculum_breakdown WHERE class_id = %d AND subject_id = %d AND campus_id = %d ORDER BY lesson_order ASC",
		$group,
		$subject,
		$blog_id
	)
);
?>



<div class="main-content">
	<div class="page-content dark:bg-zinc-700"  style="width: 100%; height: 100%;">
		<div class="container-fluid px-[0.625rem]"  style="width: 100%; height: 100%;">
			<div class="grid grid-cols-1">
				<div class="flex items-center justify-between">
					<h4 class="text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center; color: #8f1537 !important;">
						<?php 
						echo get_the_title($group); 
						echo " ";
						echo get_the_title($subject);
						?>
					</h4>
				</div>
			</div>



			<div class="card-body flex flex-wrap">
				<div class="nav-tabs bar-tabs" style="width: 100%;">
					<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full">
						<li class="w-full">
							<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="barIcon-home" class="inline-block w-full p-4 ltr:rounded-l-lg rtl:rounded-r-lg focus:outline-none <?php if (get_field("active_quarter",$group) == 1 || get_field("active_quarter",$group) == 2){echo "active";} ?>">
								<i class="mdi mdi-snowflake-variant ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
								Semester 1
							</a>
						</li>
						<li class="w-full">
							<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="barIcon-contact" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg hover:text-gray-700 hover:bg-gray-50/50 <?php if (get_field("active_quarter",$group) == 3 || get_field("active_quarter",$group) == 4){echo "active";} ?>">
								<i class="mdi mdi-sun-thermometer-outline ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
								Semester 2
							</a>
						</li>
					</ul>

					<div class="tab-content mt-5">
						<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1 || get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="barIcon-home">
							<!-- burdan -->
							<?php
							$curriculums = [];

							if ($results) {
								foreach ($results as $row) {
									if ($row->semester == 1) {
										$curriculums[] = [
											"name" => $row->lesson_title,
											"periods" => $row->periods,
											"id" => $row->id,
											"finished" => $row->finished
										];
									}
								}
							}

							if (empty($curriculums)) {
								$curriculums[] = [
									"name" => "Empty subject",
									"periods" => $weeklyPeriods,
									"id" => 1,
									"finished" => 0
								];
								?>
								<script>
									curriculums = 0;
									semester_1_order_count = 0;
								</script>
								<?php 
							}else{
								?>
								<script>
									curriculums = <?php echo count($curriculums); ?>;
									semester_1_order_count = <?php echo count($curriculums); ?>;
								</script>
								<?php 

							}
							
							$weeks = [];
							for ($i = 1; $i <= 18; $i++) {
								$weeks[$i] = [];
							}

							$currentWeek = 1;
							$currentWeekPeriods = 0;

							foreach ($curriculums as $curriculum) {
								$remainingPeriods = $curriculum['periods'];
								while ($remainingPeriods > 0) {
									if ($currentWeek > 18) {
										break;
									}

									if (!isset($weeks[$currentWeek])) {
										$weeks[$currentWeek] = [];
									}

									$availablePeriods = $weeklyPeriods - $currentWeekPeriods;
									if ($remainingPeriods <= $availablePeriods) {
										$weeks[$currentWeek][] = [
											"name" => $curriculum['name'],
											"periods" => $remainingPeriods,
											"id" => $curriculum['id'],
											"finished" => $curriculum['finished']
										];
										$currentWeekPeriods += $remainingPeriods;
										$remainingPeriods = 0;
									} else {
										$weeks[$currentWeek][] = [
											"name" => $curriculum['name'],
											"periods" => $availablePeriods,
											"id" => $curriculum['id'],
											"finished" => $curriculum['finished']
										];
										$remainingPeriods -= $availablePeriods;
										$currentWeek++;
										$currentWeekPeriods = 0;
									}
								}
							}

							?>
							<table class="semester_table_1 w-full text-sm text-left text-gray-500">
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr class="border border-gray-900 dark:border-zinc-900">
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50">
											Week
										</th>
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50">
											Period
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50 flex items-center justify-between">
											<div>Curriculum</div>
											<div style="display: flex;">
												<button type="button" class="btn border-0 bg-gray-500 p-0 align-middle text-white focus:ring-2 focus:ring-gray-500/30 hover:bg-gray-600 mr-3" data-tw-toggle="modal" data-tw-target="#list_order_1">
													<i class="bx bx-list-ol bg-white bg-opacity-20 w-10 h-full text-19 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">Lesson Order</span>
												</button>
												<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600" data-tw-toggle="modal" semester_change="1" data-tw-target="#modal-id_form">
													<i class="bx bx-calendar-plus bg-white bg-opacity-20 w-10 h-full text-19 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">Add Lesson</span>
												</button>
											</div>
										</th>
									</tr>
								</thead>
								<tbody style="position: relative;">
									<?php  
									foreach ($weeks as $week => $curriculumList) { 
										?>
										<tr class="bg-white border border-gray-900 dark:border-zinc-50 dark:bg-transparent">
											<?php if ($week < 10) {
												?>
												<th style="width: 2%; text-align: center; background-color: #007f56d9; color: #fff !important;" scope="row" class="border-l border-gray-900 dark:border-zinc-50 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													<?php echo $week; ?>
												</th>
												<?php 
											}else{
												?>
												<th style="width: 2%; text-align: center; background-color: #7f0017d9; color: #fff !important;" scope="row" class="border-l border-gray-900 dark:border-zinc-50 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													<?php echo $week; ?>
												</th>
												<?php 
											} ?>
											
											<td style="width: 10%;" class="border-l border-gray-900 dark:border-zinc-50 dark:text-zinc-100">
												<table class="w-full text-sm text-left text-gray-500">
													<?php 
													for ($j = 1; $j <= $weeklyPeriods; $j++) { 
														?>
														<tr class="bg-white dark:bg-transparent">
															<td style="width: 100%; text-align: center; <?php echo $j != 1 ? 'border-top: 1px dashed #8f1537;' : ''; ?>" class="px-3 py-3 dark:text-zinc-100 perioad_alani">
																Period <?php echo $j; ?>
															</td>
														</tr>
														<?php 
													}
													?>
												</table>
											</td>
											<td style="width: 75%; vertical-align: initial; padding-top: 5px; align-content:center;" class="px-1 border-l border-gray-900 dark:border-zinc-50 dark:text-zinc-100">
												<?php 
												foreach ($curriculumList as $curriculum) {
													if ($curriculum['periods'] > 0) {
														$ders_bg_color = "background: #fff;";
														if ($curriculum['finished'] == 1) {
															$ders_bg_color = "background: linear-gradient(0deg, rgba(0,110,3,0.5327380952380952) 0%, rgba(255,255,255,1) 100%);";
														}
														?>
														<div lesson_id="<?= $curriculum['id']; ?>" style="border: 2px solid #d79a2a; margin-bottom: 5px; padding: 10px; <?= $ders_bg_color; ?>">
															<div style="height: <?= $curriculum['periods'] * 38; ?>px; border-left: 4px solid #8f1537; padding-left: 10px; position: relative; display: flex; justify-content: space-between;">
																<div>
																	<strong><?= $curriculum['name']; ?></strong> (<?= $curriculum['periods']; ?> periods)
																</div>

																<div class="lesson_buttons" style="display: flex;">
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-violet-100 dark:shadow-zinc-600 bg-violet-500 border-violet-500 text-white font-medium leading-tight hover:bg-violet-500 focus:ring focus:ring-violet-50 dark:focus:ring-violet-500/30 focus:bg-violet-600"  data-tw-toggle="modal" data-tw-target="#lesson_details">
																		Lesson Details
																	</button>
																	<button periods="<?= $curriculum['periods']; ?>" lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-green-100 dark:shadow-zinc-600 bg-green-500 border-green-500 text-white font-medium leading-tight hover:bg-green-600 focus:ring focus:ring-green-200 focus:bg-green-600 dark:focus:ring-green-500/30 focus:outline-none transition duration-150 ease-in-out" data-tw-toggle="modal" data-tw-target="#lesson_activities">
																		Lesson Activities
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-sky-100 dark:shadow-zinc-600 bg-sky-500 border-sky-500 text-white font-medium leading-tight hover:bg-sky-600 focus:ring focus:ring-sky-200 focus:bg-sky-600 dark:focus:ring-sky-500/30 focus:outline-none transition duration-150 ease-in-out" data-tw-toggle="modal" data-tw-target="#lesson_resources">
																		Resources
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-gray-100 dark:shadow-zinc-600 bg-gray-500 border-gray-500 text-white font-medium leading-tight hover:bg-gray-600 focus:ring focus:ring-gray-200 focus:bg-gray-600 dark:focus:ring-gray-500/30 focus:outline-none transition duration-150 ease-in-out">
																		Assessment
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn text-neutral-500 hover:text-white border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:text-white focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#lesson_objective_shows">
																		Objective
																	</button>
																	<?php  
																	$bg_color = "red";
																	if ($curriculum['finished'] == 1) {
																		$bg_color = "green";
																		?>
																		<button style="padding: 5px !important;color: <?= $bg_color; ?>;" lesson_id="<?= $curriculum['id']; ?>" type="button" class="finished_button btn border-neutral-800">
																			Complete
																		</button>
																		<?php
																	}else{
																		?>
																		<button style="padding: 5px !important;color: <?= $bg_color; ?>;2" lesson_id="<?= $curriculum['id']; ?>" type="button" class="finished_button btn border-neutral-800">
																			Complete
																		</button>
																		<?php 
																	}
																	?>
																	<button style="padding: 10px !important;" lesson_id="<?= $curriculum['id']; ?>" type="button" class="delete_lesson btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																		<i class="bx bx-trash text-16 align-middle "></i>
																	</button>
																</div>

															</div>
														</div>
														<?php 
													}
												}
												?>
											</td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>
							<!-- buraya kadar -->
						</div>
						<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3 || get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="barIcon-contact">
							<!-- burdan -->
							<?php
							$curriculums = [];
							if ($results) {
								foreach ($results as $row) {
									if ($row->semester == 2) {
										$curriculums[] = [
											"name" => $row->lesson_title,
											"periods" => $row->periods,
											"id" => $row->id,
											"finished" => $row->finished
										];
									}
								}
							}
							if (empty($curriculums)) {
								$curriculums[] = [
									"name" => "Empty subject",
									"periods" => $weeklyPeriods,
									"id" => 1,
									"finished" => 0
								];
								?>
								<script>
									curriculums = 0;
									semester_2_order_count = 0;
								</script>
								<?php 
							}else{
								?>
								<script>
									curriculums = <?php echo count($curriculums); ?>;
									semester_2_order_count = <?php echo count($curriculums); ?>;
								</script>
								<?php 

							}
							
							$weeks = [];
							for ($i = 1; $i <= 18; $i++) {
								$weeks[$i] = [];
							}

							$currentWeek = 1;
							$currentWeekPeriods = 0;

							foreach ($curriculums as $curriculum) {
								$remainingPeriods = $curriculum['periods'];
								while ($remainingPeriods > 0) {
									if ($currentWeek > 18) {
										break;
									}

									if (!isset($weeks[$currentWeek])) {
										$weeks[$currentWeek] = [];
									}

									$availablePeriods = $weeklyPeriods - $currentWeekPeriods;
									if ($remainingPeriods <= $availablePeriods) {
										$weeks[$currentWeek][] = [
											"name" => $curriculum['name'],
											"periods" => $remainingPeriods,
											"id" => $curriculum['id'],
											"finished" => $curriculum['finished']
										];
										$currentWeekPeriods += $remainingPeriods;
										$remainingPeriods = 0;
									} else {
										$weeks[$currentWeek][] = [
											"name" => $curriculum['name'],
											"periods" => $availablePeriods,
											"id" => $curriculum['id'],
											"finished" => $curriculum['finished']
										];
										$remainingPeriods -= $availablePeriods;
										$currentWeek++;
										$currentWeekPeriods = 0;
									}
								}
							}

							?>

							<table class="semester_table_2 w-full text-sm text-left text-gray-500">
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr class="border border-gray-900 dark:border-zinc-900">
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50">
											Week
										</th>
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50">
											Period
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-900 dark:border-zinc-50 flex items-center justify-between">
											<div>Curriculum</div>
											<div style="display: flex;">
												<button type="button" class="btn border-0 bg-gray-500 p-0 align-middle text-white focus:ring-2 focus:ring-gray-500/30 hover:bg-gray-600 mr-3" data-tw-toggle="modal" data-tw-target="#list_order_2">
													<i class="bx bx-list-ol bg-white bg-opacity-20 w-10 h-full text-19 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">Lesson Order</span>
												</button>
												<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600" data-tw-toggle="modal" semester_change="2" data-tw-target="#modal-id_form">
													<i class="bx bx-calendar-plus bg-white bg-opacity-20 w-10 h-full text-19 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">Add Lesson</span>
												</button>
											</div>
											
										</th>
									</tr>
								</thead>
								<tbody style="position: relative;">
									<?php  
									foreach ($weeks as $week => $curriculumList) { 
										?>
										<tr class="bg-white border border-gray-900 dark:border-zinc-50 dark:bg-transparent">
											<?php if ($week < 10) {
												?>
												<th style="width: 2%; text-align: center; background-color: #007f56d9; color: #fff !important;" scope="row" class="border-l border-gray-900 dark:border-zinc-50 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													<?php echo $week; ?>
												</th>
												<?php 
											}else{
												?>
												<th style="width: 2%; text-align: center; background-color: #7f0017d9; color: #fff !important;" scope="row" class="border-l border-gray-900 dark:border-zinc-50 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													<?php echo $week; ?>
												</th>
												<?php 
											} ?>
											<td style="width: 10%;" class="border-l border-gray-900 dark:border-zinc-50 dark:text-zinc-100">
												<table class="w-full text-sm text-left text-gray-500">
													<?php 
													for ($j = 1; $j <= $weeklyPeriods; $j++) { 
														?>
														<tr class="bg-white dark:bg-transparent">
															<td style="width: 100%; text-align: center; <?php echo $j != 1 ? 'border-top: 1px dashed #8f1537;' : ''; ?>" class="px-3 py-3 dark:text-zinc-100 perioad_alani">
																Period <?php echo $j; ?>
															</td>
														</tr>
														<?php 
													}
													?>
												</table>
											</td>
											<td style="width: 75%; vertical-align: initial; padding-top: 5px; align-content:center;" class="px-1 border-l border-gray-900 dark:border-zinc-50 dark:text-zinc-100">
												<?php 
												foreach ($curriculumList as $curriculum) {
													if ($curriculum['periods'] > 0) { ?>
														<div lesson_id="<?= $curriculum['id']; ?>" style="border: 2px solid #d79a2a; margin-bottom: 5px; padding: 10px;">
															<div style="height: <?= $curriculum['periods'] * 38; ?>px; border-left: 4px solid #8f1537; padding-left: 10px; position: relative; display: flex; justify-content: space-between;">
																<div>
																	<strong><?= $curriculum['name']; ?></strong> (<?= $curriculum['periods']; ?> periods)
																</div>

																<div class="lesson_buttons" style="display: flex;">
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-violet-100 dark:shadow-zinc-600 bg-violet-500 border-violet-500 text-white font-medium leading-tight hover:bg-violet-500 focus:ring focus:ring-violet-50 dark:focus:ring-violet-500/30 focus:bg-violet-600"  data-tw-toggle="modal" data-tw-target="#lesson_details">
																		Lesson Details
																	</button>
																	<button periods="<?= $curriculum['periods']; ?>" lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-green-100 dark:shadow-zinc-600 bg-green-500 border-green-500 text-white font-medium leading-tight hover:bg-green-600 focus:ring focus:ring-green-200 focus:bg-green-600 dark:focus:ring-green-500/30 focus:outline-none transition duration-150 ease-in-out" data-tw-toggle="modal" data-tw-target="#lesson_activities">
																		Lesson Activities
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-sky-100 dark:shadow-zinc-600 bg-sky-500 border-sky-500 text-white font-medium leading-tight hover:bg-sky-600 focus:ring focus:ring-sky-200 focus:bg-sky-600 dark:focus:ring-sky-500/30 focus:outline-none transition duration-150 ease-in-out" data-tw-toggle="modal" data-tw-target="#lesson_resources">
																		Resources
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn py-2.5 dropdown-toggle border shadow-md shadow-gray-100 dark:shadow-zinc-600 bg-gray-500 border-gray-500 text-white font-medium leading-tight hover:bg-gray-600 focus:ring focus:ring-gray-200 focus:bg-gray-600 dark:focus:ring-gray-500/30 focus:outline-none transition duration-150 ease-in-out">
																		Assessment
																	</button>
																	<button lesson_id="<?= $curriculum['id']; ?>" type="button" class="btn text-neutral-500 hover:text-white border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:text-white focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#lesson_objective_shows">
																		Objective
																	</button>
																	<?php  
																	$bg_color = "red";
																	if ($curriculum['finished'] == 1) {
																		$bg_color = "green";
																		?>
																		<button style="padding: 5px !important;color: <?= $bg_color; ?>;" lesson_id="<?= $curriculum['id']; ?>" type="button" class="finished_button btn border-neutral-800">
																			Done
																		</button>
																		<?php
																	}else{
																		?>
																		<button style="padding: 5px !important;color: <?= $bg_color; ?>;2" lesson_id="<?= $curriculum['id']; ?>" type="button" class="finished_button btn border-neutral-800">
																			Not Done
																		</button>
																		<?php 
																	}
																	?>
																</div>
															</div>
														</div>
														<?php 
													}
												}
												?>
											</td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>
							<!-- buraya kadar -->
						</div>
					</div>
				</div>
			</div>



		</div>
	</div>
</div>

<div class="modal relative z-50 hidden" id="list_order_1" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-hidden">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700">
				<div class="bg-white dark:bg-zinc-600">
					<div class="sm:flex sm:items-start p-5">
						<div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right">
							<h3 class="text-center text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
								Semester 1 Lesson List
							</h3>
							<div class="mt-2">
								<table id="sortable" class="w-full text-sm text-left text-gray-500 ">
									<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
										<tr>
											<th scope="col" class="px-6 py-3">
												Lesson Title
											</th>
											<th scope="col" class="px-6 py-3">
												Lesson periods
											</th>
											<th scope="col" class="px-6 py-3" style="text-align: center;">
												Arrow
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  
										foreach ($results as $keyler => $valueler) {
											if ($valueler->semester == 1) {
												?>
												<tr lesson_idsi="<?php echo $valueler->id; ?>" draggable="true" class="bg-white border border-gray-50 dark:bg-zinc-700 dark:border-zinc-600 border-gray-50 dark:border-zinc-600">
													<th scope="row" class="lesson_order_class px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<?php echo $valueler->lesson_title; ?>
													</th>
													<th style="text-align: center;" scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<?php echo $valueler->periods; ?>
													</th>
													<th style="text-align: center;" scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<button type="button" class="yukarisi btn px-2 py-1 text-sm ltr:rounded-r-none rtl:rounded-l-none font-medium text-green-500 bg-white border-t border border-green-500 hover:bg-green-500 hover:text-white focus:bg-green-500 focus:z-10 focus:ring-2 focus:ring-green-200 focus:text-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-green-500 dark:focus:text-white">
															<i class="bx bx-up-arrow-alt text-2xl"></i>
														</button>
														<button type="button" class="asagisi btn px-2 py-1 text-sm ltr:rounded-l-none rtl:rounded-r-none font-medium text-red-500 bg-white border border-red-500 rounded-r hover:bg-red-500 hover:text-white focus:z-10 focus:ring-2 focus:bg-red-500 focus:ring-red-200 focus:text-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-red-500 dark:focus:text-white">
															<i class="bx bx-down-arrow-alt text-2xl"></i>
														</button>
													</th>
												</tr>
												<?php 
											}
										}

										?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
						<button type="button" liste_semester="1" class="sirayi_kaydet btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">
							Save
						</button>
						<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal relative z-50 hidden" id="list_order_2" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-hidden">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700">
				<div class="bg-white dark:bg-zinc-600">
					<div class="sm:flex sm:items-start p-5">
						<div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right">
							<h3 class="text-center text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
								Semester 2 Lesson List
							</h3>
							<div class="mt-2">
								<table id="sortable" class="w-full text-sm text-left text-gray-500 ">
									<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
										<tr>
											<th scope="col" class="px-6 py-3">
												Lesson Title
											</th>
											<th scope="col" class="px-6 py-3">
												Lesson periods
											</th>
											<th scope="col" class="px-6 py-3" style="text-align: center;">
												Arrow
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  
										foreach ($results as $keyler => $valueler) {
											if ($valueler->semester == 2) {
												?>
												<tr lesson_idsi="<?php echo $valueler->id; ?>" draggable="true" class="bg-white border border-gray-50 dark:bg-zinc-700 dark:border-zinc-600 border-gray-50 dark:border-zinc-600">
													<th scope="row" class="lesson_order_class px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<?php echo $valueler->lesson_title; ?>
													</th>
													<th style="text-align: center;" scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<?php echo $valueler->periods; ?>
													</th>
													<th style="text-align: center;" scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 border-l border-gray-50 dark:border-zinc-600">
														<button type="button" class="yukarisi btn px-2 py-1 text-sm ltr:rounded-r-none rtl:rounded-l-none font-medium text-green-500 bg-white border-t border border-green-500 hover:bg-green-500 hover:text-white focus:bg-green-500 focus:z-10 focus:ring-2 focus:ring-green-200 focus:text-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-green-500 dark:focus:text-white">
															<i class="bx bx-up-arrow-alt text-2xl"></i>
														</button>
														<button type="button" class="asagisi btn px-2 py-1 text-sm ltr:rounded-l-none rtl:rounded-r-none font-medium text-red-500 bg-white border border-red-500 rounded-r hover:bg-red-500 hover:text-white focus:z-10 focus:ring-2 focus:bg-red-500 focus:ring-red-200 focus:text-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-red-500 dark:focus:text-white">
															<i class="bx bx-down-arrow-alt text-2xl"></i>
														</button>
													</th>
												</tr>
												<?php 
											}
										}

										?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
						<button type="button" liste_semester="2" class="sirayi_kaydet btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">
							Save
						</button>
						<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal relative z-50 hidden" id="lesson_objective_shows" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button type="button" style="z-index: 999;" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5" style="height: 80vh; position: relative; overflow-y: auto;">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100" style="text-align: center;">
							Objective Detail
						</h3>
						<div class="grid grid-cols-12 gap-5">
							<div id="objective_show_body" class="col-span-12 lg:col-span-12">
								<table class="w-full text-sm text-left text-gray-500 ">
									<tbody>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Curriculum
											</th>
											<td class="objective_curriculum px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Object Skill / Assessment category
											</th>
											<td class="objective_skill px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Object Code 1
											</th>
											<td class="objective_code_1 px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Object Code 2
											</th>
											<td class="objective_code_2 px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Grade
											</th>
											<td class="objective_grade px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Subject
											</th>
											<td class="objective_subject px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												Object Content
											</th>
											<td class="objective_content px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												
											</td>
										</tr>
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
<div class="modal relative z-50 hidden" id="lesson_resources" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay resources_kapat"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button type="button" style="z-index: 999;" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5" style="height: 80vh; position: relative; overflow-y: auto;">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100" style="text-align: center;">
							Lesson Resources - <span class="lesson_resources"></span>
						</h3>
						<div class="grid grid-cols-12 gap-5">
							<div class="col-span-12 lg:col-span-12">

								<table resources_objective_id="120" resources_lesson_id="1" resources_semester="1" class="resources_table w-full text-sm text-left text-gray-500 ">
									<thead class="text-sm text-gray-700 dark:text-gray-100">
										<tr class="border border-gray-50 dark:border-zinc-600">
											<th style="width: 250px;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Resources Type
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Resources Content
											</th>
											<th style="width: 75px;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												
											</th>
										</tr>
									</thead>
									<tbody id="resourcesBody"></tbody>
								</table>

								<div style="display: flex; justify-content: flex-end;" class="mt-3">
									<button type="button" id="addResourceBtn" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
										<i class="bx bx-bookmark-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
										<span class="px-3 leading-[2.8]">
											New Resource
										</span>
									</button>
								</div>

								<script>
									document.getElementById('addResourceBtn').addEventListener('click', function() {
										const tbody = document.getElementById('resourcesBody');
										const newRow = document.createElement('tr');
										newRow.classList.add('bg-white', 'border', 'border-gray-50', 'dark:border-zinc-600', 'dark:bg-transparent');
										newRow.innerHTML = `
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										<select class="resoruces_type dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option>Select</option>
										<option>Book</option>
										<option>Website</option>
										<option>Youtube</option>
										<option>Other</option>
										</select>
										</th>
										<td class="px-2 py-1 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<textarea resources_id="aaa" class="w-full px-2 py-1 border border-gray-300 dark:border-zinc-600 rounded-md class_resources_textarea" spellcheck="true"></textarea>
										</td>
										<td class="px-2 py-1 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<button type="button" class="btn border-0 bg-red-400 text-white px-5 deleteBtn">
										<i class="mdi mdi-trash-can block text-lg"></i>
										<span>Delete</span>
										</button>
										</td>
										`;
										tbody.appendChild(newRow);
										attachDeleteEvent(newRow.querySelector('.deleteBtn'));
									});

									function attachDeleteEvent(button) {
										button.addEventListener('click', function() {
											const row = button.closest('tr');
											row.remove();
										});
									}

									document.querySelectorAll('.deleteBtn').forEach(button => attachDeleteEvent(button));
								</script>
							</div>
						</div>
						<div class="mt-6">
							<button id="lesson_resources_save" type="submit" class="btn bg-green-600 text-white border-transparent w-full">
								Update Resources
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal relative z-50 hidden" id="lesson_activities" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button type="button" style="z-index: 999;" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5" style="height: 80vh; position: relative; overflow-y: auto;">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100" style="text-align: center;">
							Lesson Activities - <span style="color: #8f1537;" lesson_objective_id="" lesson_semester="" lesson_activity_id="" id="lesson_activities_title"></span>
						</h3>
						<div class="grid grid-cols-12 gap-5">
							<div class="col-span-12 lg:col-span-12">

								<table id="activities_table" class="w-full text-sm text-left text-gray-500">
									<thead class="text-sm text-gray-700 dark:text-gray-100">
										<tr class="border border-gray-50 dark:border-zinc-600">
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Session
											</th>
											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Activities Detail
											</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								
							</div>
						</div>
						<div class="mt-6">
							<button type="submit" class="update_activities btn bg-green-600 text-white border-transparent w-full">
								Update Activities
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal relative z-50 hidden" id="lesson_details" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button type="button" style="z-index: 999;" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5" style="min-height: 80vh; position: relative;">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100" style="text-align: center;">
							Lesson Details - <span id="lesson_details_title"></span>
						</h3>
						<div class="grid grid-cols-12 gap-5">
							<div class="col-span-12 lg:col-span-6">
								<div>
									<label for="details_lesson_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Lesson Title <span style="color: red;">*</span>
									</label>
									<input required type="text" name="lesson_title" id="details_lesson_title" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-" placeholder="Lesson Title *">
								</div>
								<div class="mt-3">
									<label for="lesson_detail_unite" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Unit</label>
									<select id="lesson_detail_unite" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
								<hr class="mt-3">
								<div class="mt-3">
									<label for="details_last_editor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Last Editor
									</label>
									<input disabled required type="text" name="lesson_title" id="details_last_editor" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-">
								</div>
								<div class="mt-3">
									<label for="details_semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Semester
									</label>
									<input disabled required type="text" name="lesson_title" id="details_semester" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-">
								</div>
								
							</div>
							<div class="col-span-12 lg:col-span-6">
								<div>
									<label for="select_detail_perion" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										Select Periods <span style="color: red;">*</span>
									</label>
									<select id="select_detail_perion" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</div>
								<div class="mt-3">
									<label for="details_lesson_chapter" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Lesson Chapter</label>
									<input required type="text" name="lesson_title" id="details_lesson_chapter" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-" placeholder="Lesson Chapter">
								</div>
								<hr class="mt-3">
								<div class="mt-3">
									<label for="details_last_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Last Edit Date
									</label>
									<input disabled required type="text" name="lesson_title" id="details_last_date" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-">
								</div>
								<div class="mt-3">
									<label for="details_last_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Last Edit Time
									</label>
									<input disabled required type="text" name="lesson_title" id="details_last_time" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-">
								</div>
							</div>
						</div>
						<div class="mt-6" style="position: absolute; bottom: 20px; width: 95%;">
							<button id="" type="submit" class="update_lesson_btn btn bg-green-600 text-white border-transparent w-full">
								Update Lesson
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal relative z-50 hidden" id="modal-id_form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<button type="button" style="z-index: 999;" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
						<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
					</button>
					<div class="p-5" style="min-height: 80vh; position: relative;">
						<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100" style="text-align: center;">Add New Lesson</h3>
						<div class="grid grid-cols-12 gap-5">
							<div class="col-span-12 lg:col-span-6">
								<div>
									<label for="lesson_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
										Lesson Title <span style="color: red;">*</span>
									</label>
									<input required type="text" name="lesson_title" id="lesson_title" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-" placeholder="Lesson Title *">
								</div>
								<div class="mt-3">
									<label for="lesson_unite" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Select Unit</label>
									<select id="lesson_unite" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
								<div class="mt-3">
									<label for="lesson_chapter" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Lesson Chapter</label>
									<input required type="text" name="lesson_chapter" id="lesson_chapter" class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 dark:text-" placeholder="Lesson Chapter">
								</div>
								<div class="mt-3">
									<label for="lesson_grade" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										Select Grade <span style="color: red;">*</span>
									</label>
									<select id="lesson_grade" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="1,2">1+2</option>
										<option value="3,4">3+4</option>
										<option value="5,6">5+6</option>
										<option value="7,8">7+8</option>
										<option value="9,10">9+10</option>
										<option value="11,12">11+12</option>
									</select>
								</div>
								<div class="mt-3">
									<label for="lesson_subject" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										Select Subject <span style="color: red;">*</span>
									</label>
									<select id="lesson_subject" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option value="">Select</option>
										<option value="En">English</option>
										<option value="EnP">English - PrepYear</option>
										<option value="Ma">Math</option>
										<option value="MaP">Math - PrepYear</option>
										<option value="Sc">Science</option>
										<option value="ScP">Science - PrepYear</option>
										<option value="SS">Social Studies</option>
										<option value="Phy">Physics</option>
										<option value="Che">Chemistry</option>
										<option value="Bio">Biology</option>
										<option value="Bus">Business</option>
										<option value="Eco">Economics</option>
										<option value="WH">World History</option>
										<option value="GP">Global Politics</option>
										<option value="DS">Dijital Society</option>
										<option value="Psy">Psychology</option>
										<option value="MaMtd">Math Methods</option>
										<option value="MaEss">Math Essentials</option>
										<option value="IS">Islamic Studies</option>
										<option value="Qur">Quraan</option>
										<option value="Eth">Ethics</option>
										<option value="ME">Moral Education</option>
										<option value="CS">Computer Science</option>
										<option value="ROB">Coding & Robotics</option>
										<option value="ArA1">Arabic A1</option>
										<option value="ArA2">Arabic A2</option>
										<option value="ArB1">Arabic B1</option>
										<option value="ArB2">Arabic B2</option>
										<option value="ASL">Arabic ASL</option>
										<option value="Fr">French</option>
										<option value="Ger">German</option>
										<option value="TrA1">Turkish A1</option>
										<option value="TrA2">Turkish A2</option>
										<option value="TrB1">Turkish B1</option>
										<option value="TrB2">Turkish B2</option>
										<option value="At">Art</option>
										<option value="PE">Physical Education</option>
										<option value="Mu">Music</option>
										<option value="FB">Football</option>
										<option value="BB">Basketball</option>
									</select>
								</div>
							</div>
							<div class="col-span-12 lg:col-span-6">
								<div class="">
									<!-- 
									<div class="mb-2">
										<label for="objectives_list" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
											Select Objective <span style="color: red;">*</span>	
										</label>
									</div>
									<select class="" name="objectives_list" id="objectives_list">
										<option value="">Select</option>
									</select>

								-->

								<div class="mb-2">
									<label for="objectives_list" class="form-label text-13 font-medium text-gray-500 dark:text-zinc-100">
										Select Objective <span style="color: red;">*</span>
									</label>
								</div>
								<select class="choice_place" data-trigger name="objectives_list" id="objectives_list" placeholder="This is a placeholder" multiple>

								</select>

							</div>
							<div class="mt-3">
								<label for="select_perion" class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
									Select Periods <span style="color: red;">*</span>
								</label>
								<select id="select_perion" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
									<option value="">Select</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							</div>
						</div>
					</div>
					<div class="mt-6" style="position: absolute; bottom: 20px; width: 95%;">
						<button semester="1" type="submit" class="save_new_lesson_btn btn bg-green-600 text-white border-transparent w-full">
							Save New Lesson
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<style>
	.semester_table_2 .border, .semester_table_1 .border{
		border-color: #8f1537 !important;
		border-width: 2px !important;
	}
	.lesson_buttons button{
		margin-left: 10px;
		font-size: 11px;
		font-weight: bold !important;
		padding: 3px !important;
	}
	#lesson_details_title{
		color: #8f1537;
	}
	.lesson_activities_th{
		width: 50px;
		max-width: 50px;
		text-align: center;
	}
	.lesson_buttons button{
		max-height: 40px;
	}
	.semester_table_2 thead, .semester_table_1 thead{
		background-color: #d79a2a;
		color: #fff !important;
	}
	#objective_show_body table {
		margin-top: 25px;
	}
	#objective_show_body tbody{
		border: 2px solid #8f1537 !important;
	}
	#objective_show_body tbody > :first-child{
		background-color: #d79a2a !important;
		color: #fff !important;
		font-weight: bold !important;
	}
</style>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>

<!-- choices js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- color picker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
<!-- datepicker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.js"></script>
<!-- init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
	$(".delete_lesson").click(function () {
		delete_lesson_id = $(this).attr("lesson_id");
		Swal.fire({
			title: "Delete Lesson",
			text: 'You will delete lesson!',
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#2ab57d",
			cancelButtonColor: "#fd625e",
			confirmButtonText: "Yes"
		}).then(function (result) {
			if (result.value) {
				var value = $.ajax({
					method: "POST",
					url: get_site_url+'/wp-admin/admin-ajax.php',
					data: ({action:'my_ajax_new_delete_lesson',
						delete_lesson_id:delete_lesson_id,
					}),
					success: function(data){
						Swal.fire("Done.").then(function (result) {
							if (result.value) {
								console.log(data);
								location.reload();
							}
						});
					}
				});


			}
		});

	});

	$(".sirayi_kaydet").click(function () {
		listByOrder = [];
		liste_semester = $(this).attr("liste_semester");
		list_order = $("#list_order_"+liste_semester+" tbody tr");
		for (var i = 0; i < list_order.length; i++) {
			listByOrder[i] = list_order[i].attributes.lesson_idsi.value;
		}
		console.log(listByOrder);
		Swal.fire({
			title: "Save New Order",
			text: 'Your course list will change completely!',
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#2ab57d",
			cancelButtonColor: "#fd625e",
			confirmButtonText: "Yes"
		}).then(function (result) {
			if (result.value) {
				var value = $.ajax({
					method: "POST",
					url: get_site_url+'/wp-admin/admin-ajax.php',
					data: ({action:'my_ajax_new_lesson_order',
						listByOrder:listByOrder,
					}),
					success: function(data){
						Swal.fire("Done.").then(function (result) {
							if (result.value) {
								console.log(data);
								location.reload();
							}
						});
					}
				});


			}
		});

	});

	$(document).ready(function() {
		$('.finished_button').on('click', function() {
			lesson_id = $(this).attr("lesson_id");
			Swal.fire({
				title: "The lesson is completed.",
				text: 'Are you sure you want to perform this action? Your lesson will be marked as completed and a notification will be sent.',
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_lesson_done',
							lesson_id:lesson_id,
						}),
						success: function(data){
							console.log(data);
							if (data.data == 1) {
								location.reload();
							}
						}
					});
				}
			});
		});
		$('[data-tw-target="#lesson_objective_shows"]').on('click', function() {
			lesson_id = $(this).attr("lesson_id");
			tbody = document.getElementById("objective_show_body");
			tbody.innerHTML = '';
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_get_lesson_objective',

					lesson_id:lesson_id,

				}),
				success: function(data){
					result = data.data;
					console.log(result);
					for (var i = 0; i < result.length; i++) {
						const newRow = document.createElement('table');
						newRow.classList.add('w-full', 'text-sm', 'text-left', 'text-gray-500');
						newRow.innerHTML = `<tbody><tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium whitespace-nowrap dark:text-zinc-100">
						Curriculum
						</th>
						<td class="objective_curriculum px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Object Skill / Assessment category
						</th>
						<td class="objective_skill px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Object Code 1
						</th>
						<td class="objective_code_1 px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Object Code 2
						</th>
						<td class="objective_code_2 px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Grade
						</th>
						<td class="objective_grade px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Subject
						</th>
						<td class="objective_subject px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
						Object Content
						</th>
						<td class="objective_content px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
						</td>
						</tr></tbody>
						`;
						tbody.appendChild(newRow);
						const objective_curriculum = newRow.querySelector('.objective_curriculum');
						objective_curriculum.innerHTML = result[i]['object_curricullum'];

						const objective_skill = newRow.querySelector('.objective_skill');
						objective_skill.innerHTML = result[i]['object_skill'];

						const objective_code_1 = newRow.querySelector('.objective_code_1');
						objective_code_1.innerHTML = result[i]['code1'];

						const objective_code_2 = newRow.querySelector('.objective_code_2');
						objective_code_2.innerHTML = result[i]['code2'];

						const objective_grade = newRow.querySelector('.objective_grade');
						objective_grade.innerHTML = result[i]['grade'];

						const objective_subject = newRow.querySelector('.objective_subject');
						objective_subject.innerHTML = result[i]['subject'];

						const objective_content = newRow.querySelector('.objective_content');
						objective_content.innerHTML = result[i]['objecttive_content'];
					}
				}
			});

});

$('[data-tw-target="#modal-id_form"]').on('click', function() {
	semester_change = $(this).attr("semester_change");
	$(".save_new_lesson_btn").attr("semester",semester_change);
});

		// resoruces_delete_btn
function delete_resources(button_id){
	toDeleteResource = button_id.attributes.resources_delete_id.value;
	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_delete_resources',

			toDeleteResource:toDeleteResource,

		}),
		success: function(data){
			console.log(data);
		}
	});
}


$('button[data-tw-target="#lesson_resources"]').on('click', function() {
	lesson_id = $(this).attr("lesson_id");

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_get_resources_details',

			lesson_id:lesson_id,

		}),
		success: function(data){
			response = data.data;

			response_content = response[1][0];
			response_info = response[0][0];
			const tbody = document.getElementById('resourcesBody');
			while (tbody.firstChild) {
				tbody.removeChild(tbody.firstChild);
			}
			for (var i = 0; i < response_content.length; i++) {
				const newRow = document.createElement('tr');
				newRow.classList.add('bg-white', 'border', 'border-gray-50', 'dark:border-zinc-600', 'dark:bg-transparent');
				newRow.innerHTML = `
				<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
				<select class="resoruces_type dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
				<option>Select</option>
				<option>Book</option>
				<option>Website</option>
				<option>Youtube</option>
				<option>Other</option>
				</select>
				</th>
				<td class="px-2 py-1 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
				<textarea resources_id="aaa" class="w-full px-2 py-1 border border-gray-300 dark:border-zinc-600 rounded-md class_resources_textarea" spellcheck="true"></textarea>
				</td>
				<td class="px-2 py-1 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
				<button type="button" class="btn border-0 bg-red-400 text-white px-5 deleteBtn">
				<i class="mdi mdi-trash-can block text-lg"></i>
				<span>Delete</span>
				</button>
				</td>
				`;
				tbody.appendChild(newRow);

				const selectElement = newRow.querySelector('.resoruces_type');
				const textareaElement = newRow.querySelector('.class_resources_textarea');
				const deleteButton = newRow.querySelector('.deleteBtn');

				selectElement.value = response_content[i]['resource_type'];
				textareaElement.value = response_content[i]['resources_text'];
				deleteButton.setAttribute('resources_delete_id', response_content[i]['id']);
				textareaElement.setAttribute('resources_id', response_content[i]['id']);

			}
			function attachDeleteEvent(button) {
				button.addEventListener('click', function() {
					delete_resources(button);
					const row = button.closest('tr');
					row.remove();
				});
			}
			document.querySelectorAll('.deleteBtn').forEach(button => attachDeleteEvent(button));

			$(".resources_table").attr("resources_semester", response_info['lesson_semester']);
			$(".resources_table").attr("resources_lesson_id", response_info['lesson_id']);
			$(".resources_table").attr("resources_objective_id", response_info['lesson_objective_id']);
			$(".lesson_resources").text(response_info['lesson_title']);

			console.log(response_info['lesson_objective_id']);

		}
	});

});


$('#lesson_resources_save').on('click', function() {
	resources_semester = $(".resources_table").attr("resources_semester");
	resources_lesson_id = $(".resources_table").attr("resources_lesson_id");
	resources_objective_id = $(".resources_table").attr("resources_objective_id");

	resoruces_type = $(".resoruces_type");
	class_resources_textarea = $(".class_resources_textarea");
	resources_id = $("[resources_id]");

	lesson_class = <?php echo $group; ?>;
	lesson_subject = <?php echo $subject; ?>;

	resoruces_type_array = [];
	class_resources_textarea_array = [];
	resources_id_array = [];

	for (var i = 0; i < resoruces_type.length; i++) {
		resoruces_type_array[i] = resoruces_type[i].value;
		class_resources_textarea_array[i] = class_resources_textarea[i].value;
		resources_id_array[i] = resources_id[i].attributes.resources_id.value;
	}

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_update_resources_text',

			lesson_id:resources_lesson_id,
			semester:resources_semester,
			lesson_class:lesson_class,
			lesson_subject:lesson_subject,
			resources_objective_id:resources_objective_id,

			resoruces_type_array:resoruces_type_array,
			class_resources_textarea_array:class_resources_textarea_array,
			resources_id_array:resources_id_array,

		}),
		success: function(data){
			console.log(data);
			Swal.fire("Done.").then(function (result) {
				if (result.value) {
					$(".resources_kapat").click();
					const tbody = document.getElementById('resourcesBody');
					while (tbody.firstChild) {
						tbody.removeChild(tbody.firstChild);
					}
				}
			});
		}
	});

});


$('.update_activities').on('click', function() {

	lesson_id = $("#lesson_activities_title").attr("lesson_activity_id");
	lesson_semester = $("#lesson_activities_title").attr("lesson_semester");
	lesson_objective_id = $("#lesson_activities_title").attr("lesson_objective_id");
	lesson_class = <?php echo $group; ?>;
	lesson_subject = <?php echo $subject; ?>;

	class_activities_textarea = $(".class_activities_textarea");
	class_activities_textarea_array = [];

	for (var i = 0; i < class_activities_textarea.length; i++) {
		class_activities_textarea_array[i] = class_activities_textarea[i].value;
	}
	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_update_activities_text',

			lesson_class:lesson_class,
			lesson_subject:lesson_subject,
			lesson_semester:lesson_semester,
			lesson_id:lesson_id,
			lesson_objective_id:lesson_objective_id,
			class_activities_textarea_array:class_activities_textarea_array,

		}),
		success: function(data){
			console.log(data);
			Swal.fire("Done.");
		}
	});



});

$('button[data-tw-target="#lesson_activities"]').on('click', function() {
	lesson_id = $(this).attr("lesson_id");
	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_get_activities_details',

			lesson_id:lesson_id,

		}),
		success: function(data){
			console.log(data);

			$("#lesson_activities_title").text(data.data[0][0]["lesson_title"]);
			$("#lesson_activities_title").attr('lesson_activity_id', data.data[0][0]["lesson_id"]);
			$("#lesson_activities_title").attr('lesson_semester', data.data[0][0]["lesson_semester"]);
			$("#lesson_activities_title").attr('lesson_objective_id', data.data[0][0]["lesson_objective_id"]);

			var tableBody = document.getElementById('activities_table').getElementsByTagName('tbody')[0];
			while (tableBody.firstChild) {
				tableBody.removeChild(tableBody.firstChild);
			}
			var numberOfRows = data.data[0][0]["periods"]; 
			for (var i = 1; i <= numberOfRows; i++) {
				var newRow = document.createElement('tr');
				newRow.className = 'bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent';

				var cell1 = document.createElement('th');
				cell1.scope = 'row';
				cell1.className = 'lesson_activities_th px-2 py-1 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100';
				cell1.textContent = i;

				var cell2 = document.createElement('td');
				cell2.className = 'px-2 py-1 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100';

				var textarea = document.createElement('textarea');
				textarea.className = 'w-full px-2 py-1 border border-gray-300 dark:border-zinc-600 rounded-md class_activities_textarea';

				try{
					textarea.value = data.data[1][0][i-1]['lesson_text'];
				} catch{
					textarea.placeholder = 'Enter activity details here';
				}




				cell2.appendChild(textarea);

				newRow.appendChild(cell1);
				newRow.appendChild(cell2);

				tableBody.appendChild(newRow);
			}
		}
	});

});

$('.update_lesson_btn').on('click', function() {
	lesson_id = $(this).attr("id");

	details_lesson_title = $("#details_lesson_title").val();
	lesson_detail_unite = $("#lesson_detail_unite").val();
	details_semester = $("#details_semester").val();
	select_detail_perion = $("#select_detail_perion").val();
	details_lesson_chapter = $("#details_lesson_chapter").val();

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_get_update_lesson',

			lesson_id:lesson_id,
			details_lesson_title:details_lesson_title,
			lesson_detail_unite:lesson_detail_unite,
			details_semester:details_semester,
			select_detail_perion:select_detail_perion,
			details_lesson_chapter:details_lesson_chapter,

		}),
		success: function(data){
			Swal.fire("Done.").then(function (result) {
				if (result.value) {
					location.reload();
				}
			});
		}
	});

});

$('button[data-tw-target="#lesson_details"]').on('click', function() {
	lesson_id = $(this).attr("lesson_id");

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_get_lesson_details',

			lesson_id:lesson_id,

		}),
		success: function(data){
			console.log(data);
			$("#lesson_details_title").text(data.data[0]["lesson_title"]);
			$("#details_lesson_title").val(data.data[0]["lesson_title"]);
			$("#lesson_detail_unite").val(data.data[0]["unit"]).change();
			$("#details_lesson_chapter").val(data.data[0]["chapter"]).change();
			$("#select_detail_perion").val(data.data[0]["periods"]).change();

			$("#details_last_date").val(data.data[0]["date"]).change();
			$("#details_last_time").val(data.data[0]["time"]).change();
			$("#details_last_editor").val(data.data[0]["lsat_editor"]).change();

			$("#details_semester").val(data.data[0]["semester"]).change();

			$(".update_lesson_btn").attr("id",data.data[0]["id"]);

		}
	});


	console.log(lesson_id);
});
});


$(".save_new_lesson_btn").click(function () {

	lesson_title = $("#lesson_title").val();
	lesson_unite = $("#lesson_unite").val();
	lesson_chapter = $("#lesson_chapter").val();
	lesson_grade = $("#lesson_grade").val();
	lesson_subject = $("#lesson_subject").val();
	objectives_list = $("#objectives_list").val();
	select_perion = $("#select_perion").val();
	semester = $(this).attr("semester");
	class_id = <?php echo $group; ?>;
	subject_id = <?php echo $subject; ?>;

	if (semester == 1) {
		new_lesson_order = semester_1_order_count + 1;
	}else{
		new_lesson_order = semester_2_order_count + 1;
	}


	console.log(objectives_list);
	if (lesson_title != "" && select_perion != "" && lesson_grade != "" && lesson_subject != "") {
		Swal.fire({
			title: "New Lesson",
			text: 'You are adding new lesson to your curriculum!',
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#2ab57d",
			cancelButtonColor: "#fd625e",
			confirmButtonText: "Yes"
		}).then(function (result) {
			if (result.value) {

				var value = $.ajax({
					method: "POST",
					url: get_site_url+'/wp-admin/admin-ajax.php',
					data: ({action:'my_ajax_new_lesson',

						lesson_title:lesson_title,
						lesson_unite:lesson_unite,
						lesson_chapter:lesson_chapter,
						lesson_grade:lesson_grade,
						lesson_subject:lesson_subject,
						objectives_list:objectives_list,
						select_perion:select_perion,
						semester:semester,
						class_id:class_id,
						subject_id:subject_id,
						new_lesson_order:new_lesson_order,

					}),
					success: function(data){
						console.log(data);
						Swal.fire("Done.").then(function (result) {
							if (result.value) {
								location.reload();
							}
						});
					}
				});


			}
		});
	}else{
		Swal.fire("Fill in all required fields!")
	}



});





	    // singleNoSearch
var singleNoSearch = new Choices('#objectives_list', {
	searchEnabled: true,
	removeItemButton: true,
	choices: [

		],
}).setChoices(
[

	],
'value',
'label',
false
);




document.getElementById('lesson_subject').addEventListener('focus', function() {
	var grade = document.getElementById('lesson_grade').value;
	if (!grade) {
		alert('Please select a grade first.');
		document.getElementById('lesson_grade').focus();
	}
});

document.getElementById('lesson_subject').addEventListener('change', function() {
	var grade = document.getElementById('lesson_grade').value;
	var subject = document.getElementById('lesson_subject').value;
	if (grade && subject) {
		subjectSelected(grade, subject);
	}
});

function subjectSelected(grade, subject) {
	$.ajax({
		method: "POST",
		url: get_site_url + '/wp-admin/admin-ajax.php',
		data: {
			action: 'my_ajax_get_objectives',
			grade: grade,
			subject: subject
		},
		success: function(data) {
			console.log(data);
			var newChoicess = [];
			singleNoSearch.setChoices(newChoicess, 'value', 'label', true);

			for (var i = 0; i < data.data.length; i++) {
				var newChoices = [
					{ value: data.data[i].id, label: data.data[i].objecttive_content },
					];
				singleNoSearch.setChoices(newChoices, 'value', 'label', false);
			}

		}
	});
}




document.addEventListener('DOMContentLoaded', function() {
	let draggingElement;

	function swapRows(row1, row2) {
		const parent = row1.parentNode;
		if (row1 && row2 && parent) {
			parent.insertBefore(row1, row2);
		}
	}

	function moveUp(row) {
		const prevRow = row.previousElementSibling;
		if (prevRow) {
			swapRows(row, prevRow);
		}
	}

	function moveDown(row) {
		const nextRow = row.nextElementSibling;
		if (nextRow) {
			swapRows(nextRow, row);
		}
	}

	function attachButtonListeners(row) {
		const upButton = row.querySelector('.yukarisi');
		const downButton = row.querySelector('.asagisi');

		if (upButton && !upButton.listenerAdded) {
			upButton.addEventListener('click', function() {
				moveUp(row);
			});
			upButton.listenerAdded = true;
		}

		if (downButton && !downButton.listenerAdded) {
			downButton.addEventListener('click', function() {
				moveDown(row);
			});
			downButton.listenerAdded = true;
		}
	}

	document.querySelectorAll('#sortable tbody tr').forEach(row => {
		row.addEventListener('dragstart', function(e) {
			draggingElement = this;
			e.dataTransfer.effectAllowed = 'move';
			e.dataTransfer.setData('text/html', this.innerHTML);
		});

		row.addEventListener('dragover', function(e) {
			e.preventDefault();
			e.dataTransfer.dropEffect = 'move';
		});

		row.addEventListener('drop', function(e) {
			e.preventDefault();
			if (draggingElement !== this) {
				draggingElement.innerHTML = this.innerHTML;
				this.innerHTML = e.dataTransfer.getData('text/html');

                // Yeniden butonlara olay dinleyicileri ekleyin
				attachButtonListeners(draggingElement);
				attachButtonListeners(this);
			}
		});

		attachButtonListeners(row);
	});
});



</script>
