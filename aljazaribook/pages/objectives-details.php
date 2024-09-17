<?php /* Template Name: Objectives Details */ ?>
<?php get_header(); ?>

<?php 
if (isset($_GET['classid'])){
	$classid = strip_tags($_GET["classid"]); 
	$args = array(
		'post_type' => 'newClass_add',
		'p'			=> $classid,
	);
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>/class-objectives";
	</script>
	<?php 
}

?>

<?php 
$my_posts = new WP_Query($args);
if ($my_posts->have_posts()) {
	while ($my_posts->have_posts()) {
		$my_posts->the_post();
		$categoryID = get_the_id(); 
		//edit_comment();
		?>
		<div class="main-content">
			<div class="page-content dark:bg-zinc-700">
				<div class="container-fluid px-[0.625rem]">
					<div class="grid grid-cols-1 mb-5">
						<div class="flex items-center justify-between" style="display: flex; justify-content: space-between;">
							<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
								<?php echo get_the_title(); ?> 
								<?php $deneme = get_student_objective(30,1,1,4,0); 
								print_r($deneme[0]->ob_comment);
								?>
							</h4>
							<a href="<?php echo get_site_url(); ?>/objective-report?classid=<?php echo $classid; ?>">
								<button type="button" class="btn text-white bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600">
									Class Report
								</button>
							</a>
						</div>
					</div>

					<div class="col-span-12 xl:col-span-6">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body pb-0">
								<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
									<?php  
									$select_objective = get_field("select_objective",$categoryID); 
									echo $select_objective[0]->post_title;
									?>
								</h6>
							</div>
							<div class="card-body flex flex-wrap">
								<div class="nav-tabs bar-tabs">
									<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full overflow-hidden">
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-home" class="inline-block w-full p-4 active">Quarter 1</a>
										</li>
										<li class="w-full border-x border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-Profile" class="inline-block w-full p-4">Quarter 2</a>
										</li>
										<li class="w-full ltr:border-r rtl:border-l border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-setting" class="inline-block w-full p-4">Quarter 3</a>
										</li>
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-contact" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg">Quarter 4</a>
										</li>
									</ul>

									<div class="tab-content mt-5">
										<div class="tab-pane block" id="bar-u-home">
											<?php 

											$newargs = array(
												'post_type' => 'class_objectives',
												'p'			=> $select_objective[0]->ID,
											);
											$my_posts_new = new WP_Query($newargs);
											if ($my_posts_new->have_posts()) {
												while ($my_posts_new->have_posts()) {
													$my_posts_new->the_post();
													$categoryID_objective = get_the_id(); 
													/**/

													if(have_rows('quarter_1_unites', $categoryID_objective)): 
														while(have_rows('quarter_1_unites', $categoryID_objective)): 
															the_row(); 
															?>

															<button style="width: 41vw; height: 50px; font-size: 1.3rem; margin-bottom: 10px;" type="button" class="btn bg-violet-500 border-violet-500 text-white hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600" data-tw-toggle="modal" data-tw-target="#modal_q1_<?php echo get_row_index(); ?>">
																<?php echo get_sub_field("unit_name"); ?> 
															</button>

															<div class="modal relative z-50 hidden" id="modal_q1_<?php echo get_row_index(); ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
																<div class="fixed inset-0 z-50 overflow-y-auto">
																	<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																	<div class="flex h-screen">
																		<div class="relative w-screen overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-800">
																			<div class="bg-white dark:bg-zinc-800">
																				<!--------------->
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 xl:col-span-12">
																						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																							<div class="card-body pb-0">
																								<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
																									<?php echo get_the_title(); ?> / Quarter 1 /
																									<?php echo get_sub_field("unit_name"); ?>
																								</h6>
																							</div>
																							<div class="card-body">
																								<div class="relative overflow-x-auto rounded" style="max-height: 84vh;">
																									<table class="w-full text-sm text-left text-gray-500 rounded">
																										<thead class="text-sm text-violet-500 border-b border-white dark:bg-violet-500/10 dark:border-transparent" style="background-color: rgb(143, 21, 55, 1.0);">
																											<tr>
																												<th style="color: rgb(215, 154, 42, 1.0);" scope="col" class="px-6 py-3 border-l border-gray-50">
																													Objectives
																													<hr style="margin-top: 15px; margin-bottom: 15px;">
																													Student Name
																												</th>
																												<?php  
																												$objectives = get_sub_field("add_objective");

																												foreach ($objectives as $key => $value) {
																													?>
																													<th style="text-orientation: mixed; writing-mode: vertical-rl; max-height: 230px; max-width: 170px; font-size: 13px; line-height: 1.2; color: rgb(215, 154, 42, 1.0); " scope="col" class="objectives px-6 py-3 border-l border-gray-50">
																														<p>
																															<?php echo $value['objective']; ?>
																														</p>
																													</th>
																													<?php 
																												}
																												?>
																												<th style="color: rgb(215, 154, 42, 1.0); font-weight: bold;" scope="col" class="px-6 py-3 border-l border-gray-50">
																													<p>
																														Total Evaluation Score
																													</p>
																												</th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php $add_class_students = get_field("add_class_students",$categoryID); 
																											if ($add_class_students != "") {
																												foreach ($add_class_students as $key => $value) {
																													?>

																													<tr student='<?php echo $value['ID']; ?>' class="border-b border-white font-medium text-green-600 bg-green-50/50 dark:bg-green-500/10 dark:border-transparent">
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo $value['display_name']; ?>
																														</td>
																														<?php 
																														$objective_sayma = 0;
																														$ojective_toplama = 0;
																														foreach ($objectives as $keys => $values) {
																															$unite = get_row_index();
																															$selected_objective = get_student_objective($classid,1,$unite,$value['ID'],$keys);
																															$rakam = $selected_objective[0]->ob_comment;

																															if ($rakam != 0) {
																																$objective_sayma = $objective_sayma + 1;
																																$ojective_toplama = $ojective_toplama + $rakam;
																															}

																															?>
																															<td style="background-color: #244b5a82; padding: 8px !important;" class="px-6 py-3.5 border-l border-gray-50">
																																<?php  
																																$select_color = "";
																																$select_text_color = "";
																																if ($rakam == 3) {
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(34 148 102 / var(--tw-bg-opacity))";
																																}elseif($rakam == 2){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(232 174 75 / var(--tw-bg-opacity))";
																																}elseif($rakam == 1){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(230 89 85 / var(--tw-bg-opacity))";
																																}

																																?>
																																<select style="background-color: <?php echo $select_color; ?>; color: <?php echo $select_text_color; ?>; " objectiveID="<?php echo $keys; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																																	<option value="0">Select</option>
																																	<option <?php if ($rakam == 3) {
																																		echo "selected";
																																	} ?> class="yesil" value="3">3</option>
																																	<option <?php if ($rakam == 2) {
																																		echo "selected";
																																	} ?> class="sari" value="2">2</option>
																																	<option <?php if ($rakam == 1) {
																																		echo "selected";
																																	} ?> class="kirmizi" value="1">1</option>
																																</select>
																															</td>
																															<?php 
																														}
																														?>
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo (($ojective_toplama)); ?>
																														</td>
																													</tr>
																													<?php 
																												}
																											}else{
																												echo "Class Is Empty";
																											}

																											?>
																										</tbody>
																									</table>
																								</div>
																							</div>

																						</div>
																					</div>
																				</div>




																				<div class="fixed p-5 right-0 bottom-0">
																					<button type="button" uniteID='<?php echo get_row_index(); ?>' class="quarter_1_popup btn inline-flex w-full justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm sm:ml-3 sm:w-auto sm:text-sm">Save</button>
																					<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<?php 

														endwhile; 
													endif;

													/**/
												}
											}

											?>
										</div>
										<div class="tab-pane hidden" id="bar-u-Profile">
											<?php 

											$newargs = array(
												'post_type' => 'class_objectives',
												'p'			=> $select_objective[0]->ID,
											);
											$my_posts_new = new WP_Query($newargs);
											if ($my_posts_new->have_posts()) {
												while ($my_posts_new->have_posts()) {
													$my_posts_new->the_post();
													$categoryID_objective = get_the_id(); 
													/**/

													if(have_rows('quarter_2_unites', $categoryID_objective)): 
														while(have_rows('quarter_2_unites', $categoryID_objective)): 
															the_row(); 
															?>

															<button style="width: 41vw; height: 50px; font-size: 1.3rem; margin-bottom: 10px;" type="button" class="btn bg-violet-500 border-violet-500 text-white hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600" data-tw-toggle="modal" data-tw-target="#modal_q2_<?php echo get_row_index(); ?>">
																<?php echo get_sub_field("unit_name"); ?>
															</button>

															<div class="modal relative z-50 hidden" id="modal_q2_<?php echo get_row_index(); ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
																<div class="fixed inset-0 z-50 overflow-y-auto">
																	<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																	<div class="flex h-screen">
																		<div class="relative w-screen overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-800">
																			<div class="bg-white dark:bg-zinc-800">
																				<!--------------->
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 xl:col-span-12">
																						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																							<div class="card-body pb-0">
																								<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
																									<?php echo get_the_title(); ?> / Quarter 2 /
																									<?php echo get_sub_field("unit_name"); ?>
																								</h6>
																							</div>
																							<div class="card-body">
																								<div class="relative overflow-x-auto rounded" style="max-height: 84vh;">
																									<table class="w-full text-sm text-left text-gray-500 rounded">
																										<thead class="text-sm text-violet-500 border-b border-white dark:bg-violet-500/10 dark:border-transparent" style="background-color: rgb(143, 21, 55, 1.0);">
																											<tr>
																												<th style="color: rgb(215, 154, 42, 1.0);" scope="col" class="px-6 py-3 border-l border-gray-50">
																													Objectives
																													<hr style="margin-top: 15px; margin-bottom: 15px;">
																													Student Name
																												</th>
																												<?php  
																												$objectives = get_sub_field("add_objective");

																												foreach ($objectives as $key => $value) {
																													?>
																													<th style="text-orientation: mixed; writing-mode: vertical-rl; max-height: 230px; max-width: 170px; font-size: 13px; line-height: 1.2; color: rgb(215, 154, 42, 1.0); " scope="col" class="objectives px-6 py-3 border-l border-gray-50">
																														<p>
																															<?php echo $value['objective']; ?>
																														</p>
																													</th>
																													<?php 
																												}
																												?>
																												<th style="color: rgb(215, 154, 42, 1.0); font-weight: bold;" scope="col" class="px-6 py-3 border-l border-gray-50">
																													<p>
																														Total Evaluation Score
																													</p>
																												</th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php $add_class_students = get_field("add_class_students",$categoryID); 
																											if ($add_class_students != "") {
																												foreach ($add_class_students as $key => $value) {
																													?>

																													<tr student='<?php echo $value['ID']; ?>' class="border-b border-white font-medium text-green-600 bg-green-50/50 dark:bg-green-500/10 dark:border-transparent">
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo $value['display_name']; ?>
																														</td>
																														<?php 
																														$objective_sayma = 0;
																														$ojective_toplama = 0;
																														foreach ($objectives as $keys => $values) {
																															$unite = get_row_index();
																															$selected_objective = get_student_objective($classid,2,$unite,$value['ID'],$keys);
																															$rakam = $selected_objective[0]->ob_comment;

																															if ($rakam != 0) {
																																$objective_sayma = $objective_sayma + 1;
																																$ojective_toplama = $ojective_toplama + $rakam;
																															}

																															?>
																															<td style="background-color: #244b5a82; padding: 8px !important;" class="px-6 py-3.5 border-l border-gray-50">
																																<?php  
																																$select_color = "";
																																$select_text_color = "";
																																if ($rakam == 3) {
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(34 148 102 / var(--tw-bg-opacity))";
																																}elseif($rakam == 2){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(232 174 75 / var(--tw-bg-opacity))";
																																}elseif($rakam == 1){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(230 89 85 / var(--tw-bg-opacity))";
																																}

																																?>
																																<select style="background-color: <?php echo $select_color; ?>; color: <?php echo $select_text_color; ?>; " objectiveID="<?php echo $keys; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																																	<option value="0">Select</option>
																																	<option <?php if ($rakam == 3) {
																																		echo "selected";
																																	} ?> class="yesil" value="3">3</option>
																																	<option <?php if ($rakam == 2) {
																																		echo "selected";
																																	} ?> class="sari" value="2">2</option>
																																	<option <?php if ($rakam == 1) {
																																		echo "selected";
																																	} ?> class="kirmizi" value="1">1</option>
																																</select>
																															</td>
																															<?php 
																														}
																														?>
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo (($ojective_toplama)); ?>
																														</td>
																													</tr>
																													<?php 
																												}
																											}else{
																												echo "Class Is Empty";
																											}

																											?>
																										</tbody>
																									</table>
																								</div>
																							</div>

																						</div>
																					</div>
																				</div>




																				<div class="fixed p-5 right-0 bottom-0">
																					<button type="button" uniteID='<?php echo get_row_index(); ?>' class="quarter_2_popup btn inline-flex w-full justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm sm:ml-3 sm:w-auto sm:text-sm">Save</button>
																					<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<?php 

														endwhile; 
													endif;

													/**/
												}
											}

											?>
										</div>
										<div class="tab-pane hidden" id="bar-u-setting">
											<?php 

											$newargs = array(
												'post_type' => 'class_objectives',
												'p'			=> $select_objective[0]->ID,
											);
											$my_posts_new = new WP_Query($newargs);
											if ($my_posts_new->have_posts()) {
												while ($my_posts_new->have_posts()) {
													$my_posts_new->the_post();
													$categoryID_objective = get_the_id(); 
													/**/

													if(have_rows('quarter_3_unites', $categoryID_objective)): 
														while(have_rows('quarter_3_unites', $categoryID_objective)): 
															the_row(); 
															?>

															<button style="width: 41vw; height: 50px; font-size: 1.3rem; margin-bottom: 10px;" type="button" class="btn bg-violet-500 border-violet-500 text-white hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600" data-tw-toggle="modal" data-tw-target="#modal_q3_<?php echo get_row_index(); ?>">
																<?php echo get_sub_field("unit_name"); ?>
															</button>

															<div class="modal relative z-50 hidden" id="modal_q3_<?php echo get_row_index(); ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
																<div class="fixed inset-0 z-50 overflow-y-auto">
																	<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																	<div class="flex h-screen">
																		<div class="relative w-screen overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-800">
																			<div class="bg-white dark:bg-zinc-800">
																				<!--------------->
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 xl:col-span-12">
																						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																							<div class="card-body pb-0">
																								<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
																									<?php echo get_the_title(); ?> / Quarter 3 /
																									<?php echo get_sub_field("unit_name"); ?>
																								</h6>
																							</div>
																							<div class="card-body">
																								<div class="relative overflow-x-auto rounded" style="max-height: 84vh;">
																									<table class="w-full text-sm text-left text-gray-500 rounded">
																										<thead class="text-sm text-violet-500 border-b border-white dark:bg-violet-500/10 dark:border-transparent" style="background-color: rgb(143, 21, 55, 1.0);">
																											<tr>
																												<th style="color: rgb(215, 154, 42, 1.0);" scope="col" class="px-6 py-3 border-l border-gray-50">
																													Objectives
																													<hr style="margin-top: 15px; margin-bottom: 15px;">
																													Student Name
																												</th>
																												<?php  
																												$objectives = get_sub_field("add_objective");

																												foreach ($objectives as $key => $value) {
																													?>
																													<th style="text-orientation: mixed; writing-mode: vertical-rl; max-height: 230px; max-width: 170px; font-size: 13px; line-height: 1.2; color: rgb(215, 154, 42, 1.0); " scope="col" class="objectives px-6 py-3 border-l border-gray-50">
																														<p>
																															<?php echo $value['objective']; ?>
																														</p>
																													</th>
																													<?php 
																												}
																												?>
																												<th style="color: rgb(215, 154, 42, 1.0); font-weight: bold;" scope="col" class="px-6 py-3 border-l border-gray-50">
																													<p>
																														Total Evaluation Score
																													</p>
																												</th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php $add_class_students = get_field("add_class_students",$categoryID); 
																											if ($add_class_students != "") {
																												foreach ($add_class_students as $key => $value) {
																													?>

																													<tr student='<?php echo $value['ID']; ?>' class="border-b border-white font-medium text-green-600 bg-green-50/50 dark:bg-green-500/10 dark:border-transparent">
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo $value['display_name']; ?>
																														</td>
																														<?php 
																														$objective_sayma = 0;
																														$ojective_toplama = 0;
																														foreach ($objectives as $keys => $values) {
																															$unite = get_row_index();
																															$selected_objective = get_student_objective($classid,3,$unite,$value['ID'],$keys);
																															$rakam = $selected_objective[0]->ob_comment;

																															if ($rakam != 0) {
																																$objective_sayma = $objective_sayma + 1;
																																$ojective_toplama = $ojective_toplama + $rakam;
																															}

																															?>
																															<td style="background-color: #244b5a82; padding: 8px !important;" class="px-6 py-3.5 border-l border-gray-50">
																																<?php  
																																$select_color = "";
																																$select_text_color = "";
																																if ($rakam == 3) {
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(34 148 102 / var(--tw-bg-opacity))";
																																}elseif($rakam == 2){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(232 174 75 / var(--tw-bg-opacity))";
																																}elseif($rakam == 1){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(230 89 85 / var(--tw-bg-opacity))";
																																}

																																?>
																																<select style="background-color: <?php echo $select_color; ?>; color: <?php echo $select_text_color; ?>; " objectiveID="<?php echo $keys; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																																	<option value="0">Select</option>
																																	<option <?php if ($rakam == 3) {
																																		echo "selected";
																																	} ?> class="yesil" value="3">3</option>
																																	<option <?php if ($rakam == 2) {
																																		echo "selected";
																																	} ?> class="sari" value="2">2</option>
																																	<option <?php if ($rakam == 1) {
																																		echo "selected";
																																	} ?> class="kirmizi" value="1">1</option>
																																</select>
																															</td>
																															<?php 
																														}
																														?>
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo (($ojective_toplama)); ?>
																														</td>
																													</tr>
																													<?php 
																												}
																											}else{
																												echo "Class Is Empty";
																											}

																											?>
																										</tbody>
																									</table>
																								</div>
																							</div>

																						</div>
																					</div>
																				</div>




																				<div class="fixed p-5 right-0 bottom-0">
																					<button type="button" uniteID='<?php echo get_row_index(); ?>' class="quarter_3_popup btn inline-flex w-full justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm sm:ml-3 sm:w-auto sm:text-sm">Save</button>
																					<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<?php 

														endwhile; 
													endif;

													/**/
												}
											}

											?>
										</div>
										<div class="tab-pane hidden" id="bar-u-contact">
											<?php 

											$newargs = array(
												'post_type' => 'class_objectives',
												'p'			=> $select_objective[0]->ID,
											);
											$my_posts_new = new WP_Query($newargs);
											if ($my_posts_new->have_posts()) {
												while ($my_posts_new->have_posts()) {
													$my_posts_new->the_post();
													$categoryID_objective = get_the_id(); 
													/**/

													if(have_rows('quarter_4_unites', $categoryID_objective)): 
														while(have_rows('quarter_4_unites', $categoryID_objective)): 
															the_row(); 
															?>

															<button style="width: 41vw; height: 50px; font-size: 1.3rem; margin-bottom: 10px;" type="button" class="btn bg-violet-500 border-violet-500 text-white hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600" data-tw-toggle="modal" data-tw-target="#modal_q4_<?php echo get_row_index(); ?>">
																<?php echo get_sub_field("unit_name"); ?>
															</button>

															<div class="modal relative z-50 hidden" id="modal_q4_<?php echo get_row_index(); ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
																<div class="fixed inset-0 z-50 overflow-y-auto">
																	<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																	<div class="flex h-screen">
																		<div class="relative w-screen overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-800">
																			<div class="bg-white dark:bg-zinc-800">
																				<!--------------->
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 xl:col-span-12">
																						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																							<div class="card-body pb-0">
																								<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
																									<?php echo get_the_title(); ?> / Quarter 4 /
																									<?php echo get_sub_field("unit_name"); ?>
																								</h6>
																							</div>
																							<div class="card-body">
																								<div class="relative overflow-x-auto rounded" style="max-height: 84vh;">
																									<table class="w-full text-sm text-left text-gray-500 rounded">
																										<thead class="text-sm text-violet-500 border-b border-white dark:bg-violet-500/10 dark:border-transparent" style="background-color: rgb(143, 21, 55, 1.0);">
																											<tr>
																												<th style="color: rgb(215, 154, 42, 1.0);" scope="col" class="px-6 py-3 border-l border-gray-50">
																													Objectives
																													<hr style="margin-top: 15px; margin-bottom: 15px;">
																													Student Name
																												</th>
																												<?php  
																												$objectives = get_sub_field("add_objective");

																												foreach ($objectives as $key => $value) {
																													?>
																													<th style="text-orientation: mixed; writing-mode: vertical-rl; max-height: 230px; max-width: 170px; font-size: 13px; line-height: 1.2; color: rgb(215, 154, 42, 1.0); " scope="col" class="objectives px-6 py-3 border-l border-gray-50">
																														<p>
																															<?php echo $value['objective']; ?>
																														</p>
																													</th>
																													<?php 
																												}
																												?>
																												<th style="color: rgb(215, 154, 42, 1.0); font-weight: bold;" scope="col" class="px-6 py-3 border-l border-gray-50">
																													<p>
																														Total Evaluation Score
																													</p>
																												</th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php $add_class_students = get_field("add_class_students",$categoryID); 
																											if ($add_class_students != "") {
																												foreach ($add_class_students as $key => $value) {
																													?>

																													<tr student='<?php echo $value['ID']; ?>' class="border-b border-white font-medium text-green-600 bg-green-50/50 dark:bg-green-500/10 dark:border-transparent">
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo $value['display_name']; ?>
																														</td>
																														<?php 
																														$objective_sayma = 0;
																														$ojective_toplama = 0;
																														foreach ($objectives as $keys => $values) {
																															$unite = get_row_index();
																															$selected_objective = get_student_objective($classid,4,$unite,$value['ID'],$keys);
																															$rakam = $selected_objective[0]->ob_comment;

																															if ($rakam != 0) {
																																$objective_sayma = $objective_sayma + 1;
																																$ojective_toplama = $ojective_toplama + $rakam;
																															}

																															?>
																															<td style="background-color: #244b5a82; padding: 8px !important;" class="px-6 py-3.5 border-l border-gray-50">
																																<?php  
																																$select_color = "";
																																$select_text_color = "";
																																if ($rakam == 3) {
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(34 148 102 / var(--tw-bg-opacity))";
																																}elseif($rakam == 2){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(232 174 75 / var(--tw-bg-opacity))";
																																}elseif($rakam == 1){
																																	$select_text_color = "#fff";
																																	$select_color = "rgb(230 89 85 / var(--tw-bg-opacity))";
																																}

																																?>
																																<select style="background-color: <?php echo $select_color; ?>; color: <?php echo $select_text_color; ?>; " objectiveID="<?php echo $keys; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																																	<option value="0">Select</option>
																																	<option <?php if ($rakam == 3) {
																																		echo "selected";
																																	} ?> class="yesil" value="3">3</option>
																																	<option <?php if ($rakam == 2) {
																																		echo "selected";
																																	} ?> class="sari" value="2">2</option>
																																	<option <?php if ($rakam == 1) {
																																		echo "selected";
																																	} ?> class="kirmizi" value="1">1</option>
																																</select>
																															</td>
																															<?php 
																														}
																														?>
																														<td class="px-6 py-3.5 border-l border-gray-50" style="color: rgb(215, 154, 42, 1.0); background-color: #244b5a;">
																															<?php echo (($ojective_toplama)); ?>
																														</td>
																													</tr>
																													<?php 
																												}
																											}else{
																												echo "Class Is Empty";
																											}

																											?>
																										</tbody>
																									</table>
																								</div>
																							</div>

																						</div>
																					</div>
																				</div>




																				<div class="fixed p-5 right-0 bottom-0">
																					<button type="button" uniteID='<?php echo get_row_index(); ?>' class="quarter_4_popup btn inline-flex w-full justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm sm:ml-3 sm:w-auto sm:text-sm">Save</button>
																					<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<?php 

														endwhile; 
													endif;

													/**/
												}
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
		<?php 
	}

}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>/wp-admin/admin.php?page=my_classes";
	</script>
	<?php 
}
wp_reset_query();
?>

<?php get_footer(); ?>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var class_id = '<?php echo $classid; ?>';
	<?php  $current_user_now = wp_get_current_user();?>
	var teacher_id = <?php echo $current_user_now->ID; ?>
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/objective-detail.js?ver=1"></script>
<style>
	.kirmizi{
		background-color: rgb(230 89 85 / var(--tw-bg-opacity));
		color: #fff;
	}
	.sari{
		background-color: rgb(232 174 75 / var(--tw-bg-opacity));
		color: #fff;
	}
	.yesil{
		background-color: rgb(34 148 102 / var(--tw-bg-opacity));
		color: #fff;
	}
</style>
<script>
	$(document).ready(function(){
		$("select").change(function(){
			selectedOne = this;
			if (selectedOne.value == 3) {
				$(this).css("backgroundColor", "rgb(34 148 102 / var(--tw-bg-opacity))");
				$(this).css("color", "rgb(255, 255, 255)");
			}else if(selectedOne.value == 2){
				$(this).css("backgroundColor", "rgb(232 174 75 / var(--tw-bg-opacity))");
				$(this).css("color", "rgb(255, 255, 255)");
			}else if (selectedOne.value == 1) {
				$(this).css("backgroundColor", "rgb(230 89 85 / var(--tw-bg-opacity))");
				$(this).css("color", "rgb(255, 255, 255)");
			}
		});
	});
</script>