<?php /* Template Name: Objective Report */ ?>
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
		window.location.href = "<?php echo get_site_url(); ?>/my-all-classes";
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
		$add_class_students = get_field("add_class_students",$categoryID);
		$student_number_for_class = count($add_class_students);
		?>
		<div class="main-content">
			<div class="page-content dark:bg-zinc-700">
				<div class="container-fluid px-[0.625rem]">
					<div class="grid grid-cols-1 mb-5">
						<div class="flex items-center justify-between" style="display: flex; justify-content: space-between;">
							<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
								<?php echo get_the_title(); ?> Class Report
							</h4>
							<button type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600" data-tw-toggle="modal" data-tw-target="#modal-idextralargemodal">
								Class General Report
							</button>
						</div>
					</div>

					<!---------- Class General Report -------------->
					<div class="modal relative z-50 hidden" id="modal-idextralargemodal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
						<div class="fixed inset-0 z-50 overflow-y-auto">
							<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
							<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
								<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
									<div class="bg-white dark:bg-zinc-700">
										<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
											<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
												Class General Report
											</h3>
											<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
												<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
											</button>
										</div>
										<div class="p-6 space-y-6 ltr:text-left rtl:text-right">
											<div class="card dark:bg-zinc-800 dark:border-zinc-600">
												<div class="card-body flex flex-wrap gap-3">
													<div id="column_chart" data-colors='["#8f1537"]' class="apex-charts w-full" dir="ltr"></div>           
												</div>
											</div>
										</div>
										<!-- Modal footer -->
										<div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
											<button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php  
					$select_objective = get_field("select_objective",$categoryID); 
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
							$class_units_all = array();
							$class_units_name = array();
							/*************************** Quarter 1 unite avarage **********************************/
							$quarter_1_sayma = array();
							if(have_rows('quarter_1_unites', $categoryID_objective)): 
								while(have_rows('quarter_1_unites', $categoryID_objective)): 
									the_row(); 
									$unite = get_row_index();
									$class_units_name[1][$unite] = get_sub_field('unit_name');
									if(have_rows('add_objective')): 
										while(have_rows('add_objective')): 
											the_row(); 
											$quarter_1_sayma[$unite] = $quarter_1_sayma[$unite] + 1;
										endwhile; 
									endif;
								endwhile; 
							endif;
										//print_r($quarter_1_sayma);
										//echo "<br>";
							$class_units_q1 = array();
							if(have_rows('quarter_1_unites', $categoryID_objective)): 
								while(have_rows('quarter_1_unites', $categoryID_objective)): 
									the_row(); 
									$i = get_row_index();

									$class_units_q1[$i] = get_objective_by_unit_sum($classid,1,$i);
									$class_units_q1[$i] = $class_units_q1[$i][0]->ob_comment;
												//echo '<br>';

									$class_units_q1[$i] = ($class_units_q1[$i] / $quarter_1_sayma[$i]) / $student_number_for_class;
									//echo "<br>";

								endwhile; 
							endif;

							/*************************** Quarter 2 unite avarage **********************************/
							$quarter_2_sayma = array();
							if(have_rows('quarter_2_unites', $categoryID_objective)): 
								while(have_rows('quarter_2_unites', $categoryID_objective)): 
									the_row(); 
									$unite = get_row_index();
									$class_units_name[2][$unite] = get_sub_field('unit_name');
									if(have_rows('add_objective')): 
										while(have_rows('add_objective')): 
											the_row(); 
											$quarter_2_sayma[$unite] = $quarter_2_sayma[$unite] + 1;
										endwhile; 
									endif;
								endwhile; 
							endif;
										//print_r($quarter_2_sayma);
										//echo "<br>";
							$class_units_q2 = array();
							if(have_rows('quarter_2_unites', $categoryID_objective)): 
								while(have_rows('quarter_2_unites', $categoryID_objective)): 
									the_row(); 
									$i = get_row_index();

									$class_units_q2[$i] = get_objective_by_unit_sum($classid,2,$i);
									$class_units_q2[$i] = $class_units_q2[$i][0]->ob_comment;
												//echo '<br>';

									$class_units_q2[$i] = ($class_units_q2[$i] / $quarter_2_sayma[$i]) / $student_number_for_class;
									//echo "<br>";

								endwhile; 
							endif;

							/*************************** Quarter 3 unite avarage **********************************/
							$quarter_3_sayma = array();
							if(have_rows('quarter_3_unites', $categoryID_objective)): 
								while(have_rows('quarter_3_unites', $categoryID_objective)): 
									the_row(); 
									$unite = get_row_index();
									$class_units_name[3][$unite] = get_sub_field('unit_name');
									if(have_rows('add_objective')): 
										while(have_rows('add_objective')): 
											the_row(); 
											$quarter_3_sayma[$unite] = $quarter_3_sayma[$unite] + 1;
										endwhile; 
									endif;
								endwhile; 
							endif;
										//print_r($quarter_3_sayma);
										//echo "<br>";
							$class_units_q3 = array();
							if(have_rows('quarter_3_unites', $categoryID_objective)): 
								while(have_rows('quarter_3_unites', $categoryID_objective)): 
									the_row(); 
									$i = get_row_index();

									$class_units_q3[$i] = get_objective_by_unit_sum($classid,3,$i);
									$class_units_q3[$i] = $class_units_q3[$i][0]->ob_comment;
												//echo '<br>';

									$class_units_q3[$i] = ($class_units_q3[$i] / $quarter_3_sayma[$i]) / $student_number_for_class;
									//echo "<br>";

								endwhile; 
							endif;

							/*************************** Quarter 4 unite avarage **********************************/
							$quarter_4_sayma = array();
							if(have_rows('quarter_4_unites', $categoryID_objective)): 
								while(have_rows('quarter_4_unites', $categoryID_objective)): 
									the_row(); 
									$unite = get_row_index();
									$class_units_name[4][$unite] = get_sub_field('unit_name');
									if(have_rows('add_objective')): 
										while(have_rows('add_objective')): 
											the_row(); 
											$quarter_4_sayma[$unite] = $quarter_4_sayma[$unite] + 1;
										endwhile; 
									endif;
								endwhile; 
							endif;
										//print_r($quarter_4_sayma);
										//echo "<br>";
							$class_units_q4 = array();
							if(have_rows('quarter_4_unites', $categoryID_objective)): 
								while(have_rows('quarter_4_unites', $categoryID_objective)): 
									the_row(); 
									$i = get_row_index();

									$class_units_q4[$i] = get_objective_by_unit_sum($classid,4,$i);
									$class_units_q4[$i] = $class_units_q4[$i][0]->ob_comment;
												//echo '<br>';

									$class_units_q4[$i] = ($class_units_q4[$i] / $quarter_4_sayma[$i]) / $student_number_for_class;
									//echo "<br>";

								endwhile; 
							endif;
							$class_units_all[0] = $class_units_q1;
							$class_units_all[1] = $class_units_q2;
							$class_units_all[2] = $class_units_q3;
							$class_units_all[3] = $class_units_q4;

							// echo "<pre>";
							// print_r($class_units_all);
							// echo "<pre>";

							//print_r($class_units_name);
						}
					}
					?>
					<div class=" grid grid-cols-1">
						<div class="grid grid-cols-12 gap-5">

							<?php  
							if ($add_class_students != "") {
								$student_class_point = array();
								foreach ($add_class_students as $key => $value) {
									?>
									<!------------------------------->
									<div studentID="<?php echo $value['ID']; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
											<div class="card-body">
												<div class="mb-4">
													<img src="<?php echo get_field("user_image","user_".$value['ID'])['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
												</div>
												<div class="text-center">
													<h5 class="text-16 text-gray-700 mb-1">
														<a href="#" class="dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</a>
													</h5>
													<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
														<?php echo $value['user_email']; ?>
													</a>
												</div>
											</div>
											<div class="inline-flex rounded-md w-full" role="group">
												<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $value['ID']; ?>">
													Profile
												</button>
												<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton-studentpoint<?php echo $value['ID']; ?>">
													Student Report
												</button>
											</div>
										</div>
									</div>
									<!------------------------------->
									<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
										<div class="fixed inset-0 z-50 overflow-hidden">
											<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
											<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
												<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
													<div class="bg-white p-5 text-center dark:bg-zinc-700">
														<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
															<img src="<?php echo get_field("user_image","user_".$value['ID'])['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
														</div>
														<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</h2>
														<div class="card-body">
															<div class="grid grid-cols-12 gap-5">
																<div class="col-span-12 lg:col-span-6">
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['display_name']; ?>" id="user-display-name">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['user_registered']; ?>" id="user-registered">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$value['ID']); ?>" id="user-eyotek-id">
																	</div>
																</div>
																<div class="col-span-12 lg:col-span-6">
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['user_email']; ?>" id="user-email">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																			Gender
																		</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$value['ID']); ?>" id="user-gender">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																			Subject
																		</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$value['ID']); ?>" id="user-gender">
																	</div>
																</div>
															</div>
														</div>

														<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
															<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal relative z-50 hidden" id="modal-id_wideButton-studentpoint<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
										<div class="fixed inset-0 z-50 overflow-hidden">
											<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
											<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
												<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
													<div class="bg-white p-5 text-center dark:bg-zinc-700">
														<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</h2>
														<div class="col-span-12 xl:col-span-6">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																<div class="card-body flex flex-wrap">
																	<div class="nav-tabs bar-tabs" style="width: 100%;">
																		<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full overflow-hidden">
																			<li class="w-full">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter1_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4 active">
																					Quarter 1
																				</a>
																			</li>
																			<li class="w-full border-x border-gray-50">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter2_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4">
																					Quarter 2
																				</a>
																			</li>
																			<li class="w-full ltr:border-r rtl:border-l border-gray-50">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter3_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4">
																					Quarter 3
																				</a>
																			</li>
																			<li class="w-full">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter4_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg">
																					Quarter 4
																				</a>
																			</li>
																		</ul>

																		<div class="tab-content mt-5">
																			<div class="tab-pane block" id="quarter1_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">

																						<div class="grid grid-cols-1 xl:grid-cols-12 gap-5" style="width: 100%; max-height: 55vh; overflow-y: scroll;">
																							<div class="col-span-12">
																								<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																									<div class="card-body pb-0">
																										<h6 class="mb-1 text-15 text-gray-600 dark:text-gray-100">
																											Comparative
																										</h6>
																									</div>
																									<div class="card-body flex flex-wrap gap-3" style="overflow-y: 50vh; max-height: vh;">
																										<div id="line_chart_student_<?php echo $value['ID']; ?>" data-colors='["#8e1537", "#d79a2a"]' class="apex-charts w-full" dir="ltr"></div>

																										<?php 
																										$student_notlari = array();
																										foreach ($class_units_q1 as $keys => $values) {
																											$deneme = get_student_objective_unit($classid,1,$keys,$value['ID']);
																											$student_notlari[1][$keys] = $deneme;
																										}
																										foreach ($class_units_q2 as $keys => $values) {
																											$deneme = get_student_objective_unit($classid,2,$keys,$value['ID']);
																											$student_notlari[2][$keys] = $deneme;
																										}
																										foreach ($class_units_q3 as $keys => $values) {
																											$deneme = get_student_objective_unit($classid,3,$keys,$value['ID']);
																											$student_notlari[3][$keys] = $deneme;
																										}
																										foreach ($class_units_q4 as $keys => $values) {
																											$deneme = get_student_objective_unit($classid,4,$keys,$value['ID']);
																											echo "<pre>";
																											print_r($deneme[0]);
																											echo "<pre>";
																											$student_notlari[4][$keys] = $deneme;
																										}
																										// echo "<pre>";
																										// print_r($student_notlari[1][1][0]);
																										// echo "<pre>";

																										?>   

																									</div>
																								</div>
																							</div>
																						</div>

																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter2_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">


																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter3_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">


																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter4_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">


																					</div>
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
															<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
								}
							}else{
								echo "Class Is Empty";
							}

							?>

							<?php /* ?>
							<?php echo "<pre>"; ?>
							<?php print_r($add_class_students); ?>
							<?php echo "<pre>"; ?>
							<?php */ ?>


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


<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>

<script>

	<?php  
	if ($add_class_students != "") {
		foreach ($add_class_students as $key => $value) {

			?>
			var lineDatalabelColors = getChartColorsArray("#line_chart_student_<?php echo $value['ID']; ?>");
			var options = {
				chart: {
					height: 380,
					type: 'line',
					zoom: {
						enabled: false
					},
					toolbar: {
						show: false
					}
				},
				colors: lineDatalabelColors,
				dataLabels: {
					enabled: false,
				},
				stroke: {
					width: [3, 3],
					curve: 'straight'
				},
				series: [{
					name: "Student",
					data: [1,2,3]
				},
				{
					name: "Class",
					data: [<?php
						foreach ($class_units_all as $keys => $values) {
							foreach ($values as $keyss => $valuess) {
								echo $valuess.",";
							}
						} 

						?>]
				}
				],
				title: {
					text: 'Comparative Grade With Class',
					align: 'left',
					style: {
						fontWeight:  '500',
					},
				},
				grid: {
					row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
    },
    borderColor: '#f1f1f1'
},
markers: {
	style: 'inverted',
	size: 0
},
xaxis: {
	categories: [<?php
		foreach ($class_units_name as $keys => $values) {
			foreach ($values as $keyss => $valuess) {
				echo "'".$valuess."',";
			}
		}
		?>],
	title: {
		text: 'Unites'
	}
},
yaxis: {
	title: {
		text: 'Point'
	},
	min: 1,
	max: 3
},
legend: {
	position: 'top',
	horizontalAlign: 'right',
	floating: true,
	offsetY: -25,
	offsetX: -5
},
responsive: [{
	breakpoint: 600,
	options: {
		chart: {
			toolbar: {
				show: false
			}
		},
		legend: {
			show: false
		},
	}
}]
}

var chart = new ApexCharts(
	document.querySelector("#line_chart_student_<?php echo $value['ID']; ?>"),
	options
	);

chart.render();

<?php 
}
}

?>



// column chart Class General Avarage
var columnColors = getChartColorsArray("#column_chart");
var options = {
	chart: {
		height: 375,
		type: 'bar',
		toolbar: {
			show: false,
		}
	},
	plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '35%',
		},
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		show: true,
		width: 2,
		colors: ['transparent']
	},
	series: [{
		name: 'Class Avarage',
		data: [<?php
			foreach ($class_units_all as $key => $value) {
				foreach ($value as $keys => $values) {
					echo $values.",";
				}
			} 

			?>]
	}],
	colors: columnColors,
	xaxis: {
		categories: [<?php
			foreach ($class_units_name as $key => $value) {
				foreach ($value as $keys => $values) {
					echo "'".$values."',";
				}
			}
			?>],
	},
	yaxis: {
		title: {
			text: 'Points',
			style: {
				fontWeight:  '500',
			},
		}
	},
	grid: {
		borderColor: '#f1f1f1',
	},
	fill: {
		opacity: 1

	},
	tooltip: {
		y: {
			formatter: function (val) {
				return "" + val + " Points"
			}
		}
	}
}

var chart = new ApexCharts(
	document.querySelector("#column_chart"),
	options
	);

chart.render();

</script>