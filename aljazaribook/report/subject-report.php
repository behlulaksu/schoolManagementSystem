<?php /* Template Name: Subject Report */ ?>

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

if (isset($_GET['quarter'])){
	$quarter = strip_tags($_GET["quarter"]); 
	$baslik = "Quarter 1 Report";
	if ($quarter == 1) {
		$domain_getir = 'add_quarter_1_domains';
		$baslik = "Quarter 1 Report";

	}elseif ($quarter == 2) {
		$domain_getir = 'add_quarter_2_domains';
		$baslik = "Quarter 2 Report";

	}elseif ($quarter == 3) {
		$domain_getir = 'add_quarter_3_domains';
		$baslik = "Quarter 3 Report";

	}elseif ($quarter == 4) {
		$domain_getir = 'add_quarter_4_domains';
		$baslik = "Quarter 4 Report";

	}else{
		?>
		<script>
			window.location.href = "<?php echo get_site_url(); ?>";
		</script>
		<?php 
	}
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




<?php  
$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;
$group_users = get_field("group_users",$group);


$quarter_1_domainler = []; 
$domain_toplama = [];
$point_array = [];
$class_avarage_subdomain = [];
/* get student not start */
$book_objective = "book_".get_current_blog_id()."_gradebook";
global $wpdb;
$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id=".$group." and gb_subject_id =".$subject." and gb_quarter_id =".$quarter."" );
$subject_all_marks = $wpdb->get_results($query);

/* get student not end */
if(have_rows($domain_getir, $gradebook_ID)): 
	while(have_rows($domain_getir, $gradebook_ID)): 
		the_row(); 

		$data_id_counter = get_row_index();	
		$quarter_percentage = get_sub_field("domain_percentage");

		if(have_rows('add_sub_domains')): 
			while(have_rows('add_sub_domains')): 
				the_row(); 
				$subDomainID = get_row_index();

				$group_users = get_field("group_users",$group);
				foreach ($group_users as $key => $value) {

					foreach ($subject_all_marks as $keyler => $valueler) {
						if ($valueler->gb_gradebook_id == $gradebook_ID && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == $subDomainID && $valueler->gb_student_id == $value['ID']) {
							$point_control = $valueler->gb_point;
						}
					}

					if (empty($point_control)) {
						$point_control = 0;
						$point_array[$data_id_counter][$subDomainID][$key] = 0;
					}else{
						$point_array[$data_id_counter][$subDomainID][$key] = $point_control;
					}
					$deneme_sum = array_sum($point_array[$data_id_counter][$subDomainID]);
					$deneme_count = count($point_array[$data_id_counter][$subDomainID]);
					$class_avarage_subdomains = ($deneme_sum/$deneme_count);
					$class_avarage_subdomain[$data_id_counter][$subDomainID] = round($class_avarage_subdomains);

					$quarter_1_domainler[$data_id_counter][$subDomainID][$value['ID']] = ((intval($point_control) * intval(get_sub_field("sub_domain_percentage"))) / (intval(get_sub_field("based_on")))) / (100 / intval($quarter_percentage));

					$domain_toplama[$value['ID']] = $quarter_1_domainler[$data_id_counter][$subDomainID][$value['ID']] + $domain_toplama[$value['ID']];

				}
			endwhile; 
		endif;
	endwhile; 
endif;
?>


<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
				<div class="bg-white dark:bg-zinc-700">
					<div class="items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
						<div class="flex" style="justify-content: space-around;">
							<?php 
							$highest_mark = max($domain_toplama);
							$curve_point  = 0;
							$bg_table_name = "curve_base";
							$blog_id = get_current_blog_id();
							$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and quarter_id = ".$quarter." and class_id =".$group." and subjecet_id =".$subject."" );

							$sonuclar1 = $wpdb->get_results($query);
							if ($sonuclar1[0]->highest_mark) {
								$highest_mark = $sonuclar1[0]->highest_mark;
							}
							if ($sonuclar1[0]->curve_point) {
								$curve_point = $sonuclar1[0]->curve_point;
							}

							?>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right">
							<table class="w-full text-sm text-left text-gray-500 ">
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr class="border border-gray-50 dark:border-zinc-600">
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Stundet Number (Eyotek)
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Stundet Name
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Average
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											CURVE
										</th>
										
									</tr>
								</thead>
								<tbody>
									<script>
										avarage_q1 = [];
										curve_q1 = [];
										students_subject = [];
									</script>
									<?php 
									$sayma = 0;
									$total_normal = 0;
									$total_curve = 0;

									foreach ($group_users as $key => $value) {
										$sayma = $sayma + 1;
										?>
										<script>
											students_subject[<?php echo $key; ?>] = <?php echo $value['ID']; ?>
										</script>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</th>
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
												<?php echo $value['display_name']; ?>
											</th>
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
												<?php 
												$total_normal = number_format($domain_toplama[$value['ID']], 2, '.', '') + $total_normal;
												$bunuyaz = number_format($domain_toplama[$value['ID']], 2, '.', ''); 
												echo $bunuyaz;
												?>
												<script>
													avarage_q1[<?php echo $key; ?>] = <?php echo $bunuyaz; ?>
												</script>
											</th>
											<th style="background-color: #00800078;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
												<?php  
												if (empty($sonuclar1)) {
													$curve_base = 0;
												}else{
													$curve_base = $curve_point;
												}
												$unwantedItem = 0;
												$filteredArray = array_filter($domain_toplama, function ($item) use ($unwantedItem) {
													return $item != $unwantedItem;
												});

												$class_min_mark = min($filteredArray);
												$class_max_mark = max($domain_toplama);
												$min_mark = $class_min_mark + $curve_base;

												$curved_mark = $min_mark + (($highest_mark - $min_mark) / ($class_max_mark - $class_min_mark)) * ($domain_toplama[$value['ID']] - $class_min_mark);
												$total_curve = $total_curve + $curved_mark;

												$yazilacak_puan = number_format($curved_mark, 2, '.', '');
												if ($bunuyaz <= 0) {
													echo "0";
													?>
													<script>
														curve_q1[<?php echo $key; ?>] = 0;
													</script>
													<?php 
												}else{
													if ($yazilacak_puan === "nan") {
														echo $yazilacak_puan = 100;
													}else{
														echo $yazilacak_puan;
													}
													?>
													<script>
														curve_q1[<?php echo $key; ?>] = <?php echo $yazilacak_puan; ?>;
													</script>
													<?php 
												}
												?>
											</th>
											
										</tr>
										<?php 
									}
									?>
									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
											<?php echo get_the_title($group); ?> - <?php echo get_the_title($subject); ?>
										</th>
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
											
										</th>
										<th class_avarage="<?php echo number_format(($total_normal / $sayma), 2, '.', ''); ?>" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
											Point Average : <?php echo number_format(($total_normal / $sayma), 2, '.', ''); ?>
										</th>
										<th curve_avarage="<?php echo number_format(($total_curve / $sayma), 2, '.', ''); ?>" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
											CURVE Average : <?php echo number_format(($total_curve / $sayma), 2, '.', ''); ?>
										</th>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div style="margin-top: 50px;" class="col-span-12 xl:col-span-6">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<?php 
							if(have_rows($domain_getir, $gradebook_ID)): 
								while(have_rows($domain_getir, $gradebook_ID)): 
									the_row(); 
									$data_id_counter = get_row_index();	
									$quarter_percentage = get_sub_field("domain_percentage");
									if ($quarter_percentage != 0) {
										if(have_rows('add_sub_domains')): 
											while(have_rows('add_sub_domains')): 
												the_row(); 
												$subDomainID = get_row_index();
												?>
												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex border-b border-gray-100 dark:border-b-zinc-600 items-center justify-between w-full p-3 font-medium text-left rounded-t-lg">
															<span class="text-15">
																<?php echo get_sub_field("sub_domain_name"); ?>
															</span>
															<i class="mdi mdi-chevron-down text-2xl group-[.active]:rotate-180"></i>
														</button>
													</h2>
													<div class="accordion-body hidden">
														<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">
															<div id="line_<?php echo $data_id_counter; ?>_<?php echo $subDomainID ;?>" data-colors='["#8f1537", "#d79a2a"]' class="apex-charts w-full" dir="ltr"></div>
														</div>
													</div>
												</div>
												<?php 
											endwhile; 
										endif; 
									}
								endwhile; 
							endif; 
							?>
						</div>
					</div>
				</div>
			</div>



		</div>
	</div>
</div>




<style>
	.ring-red-200{
		background-color: #8f1537 !important;
	}
	.ring-red-200:hover{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.ring-red-200:focus{
		background-color: rgb(215,154,42,1.0) !important;
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
<!-- apexcharts js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>

<script>
	$(document).ready(function(){
		$("#header_title").text("<?php echo get_the_title($group); ?> <?php echo $baslik; ?> - <?php echo get_the_title($subject); ?>");
	});
</script>
<style>
	.add_sutdent_tab td{
		color: #000;
		font-weight: bold;
	}
</style>

<?php  
if(have_rows($domain_getir, $gradebook_ID)): 
	while(have_rows($domain_getir, $gradebook_ID)): 
		the_row(); 

		$data_id_counter = get_row_index();	
		$quarter_percentage = get_sub_field("domain_percentage");
		if ($quarter_percentage != 0) {
			if(have_rows('add_sub_domains')): 
				while(have_rows('add_sub_domains')): 
					the_row(); 
					$subDomainID = get_row_index();
					?>
					<script>
						$(document).ready(function(){

							var lineDatalabelColors = getChartColorsArray("#line_<?php echo $data_id_counter; ?>_<?php echo $subDomainID ;?>");
							var options = {
								chart: {
									height: 380,
									type: 'line',
									zoom: {
										enabled: true
									},
									toolbar: {
										show: true
									}
								},
								colors: lineDatalabelColors,
								dataLabels: {
									enabled: false,
								},
								stroke: {
									width: [3, 2],
									curve: 'straight'
								},
								series: [{
									name: "Class Avarage",
									data: [
										<?php 
										foreach ($point_array[$data_id_counter][$subDomainID] as $key => $value) {
											echo "'";
											echo $class_avarage_subdomain[$data_id_counter][$subDomainID];
											echo "',";
										}
										?>
										],
								},
								{
									name: "Student Avarage",
									data: [
										<?php 
										foreach ($point_array[$data_id_counter][$subDomainID] as $key => $value) {
											echo "'";
											echo $value;
											echo "',";
										}
										?>
										],								}
									],
								title: {
									text: '<?php echo get_sub_field("sub_domain_name"); ?>',
									align: 'left',
									style: {
										fontWeight:  '700',
									},
								},
								grid: {
									row: {
										colors: ['transparent', 'transparent'], 
										opacity: 0.2
									},
									borderColor: '#f1f1f1'
								},
								markers: {
									style: 'inverted',
									size: 0
								},
								xaxis: {
									categories: [
										<?php 
										foreach ($group_users as $key => $value) {
											echo "'";
											echo $value['display_name'];
											echo "',";
										}
										?>
										],
									title: {
										text: 'Student Name'
									}
								},
								yaxis: {
									title: {
										text: 'Grade'
									},
									min: 0,
									max: <?php echo get_sub_field("based_on"); ?>
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
								document.querySelector("#line_<?php echo $data_id_counter; ?>_<?php echo $subDomainID ;?>"),
								options
								);

							chart.render();

						});
					</script>

					<?php 
				endwhile; 
			endif; 
		}
	endwhile; 
endif; 
?>