<?php /* Template Name: Yearly Report */ ?>

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
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">

			<div class="col-span-12 xl:col-span-6">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body">
						<div data-tw-accordion="collapse">
							Class Average
							<div id="column_chart" data-colors='["#5156c4", "#8f1537", "#d79a2a", "#2ab57d"]' class="apex-charts w-full" dir="ltr"></div>  
							<?php  
							$student_avarage_q1 = [];
							$student_avarage_q2 = [];
							$student_avarage_q3 = [];
							$student_avarage_q4 = [];

							$blog_id = get_current_blog_id();
							$bg_table_name = "student_avarages";
							$gruoup_subjects = get_field("subject_for_group",$group); 


							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_avarage from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 1" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_avarage_q1[$key] = $values->class_avarage;
									}
								}else{
									$student_avarage_q1[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_avarage from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 2" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_avarage_q2[$key] = $values->class_avarage;
									}
								}else{
									$student_avarage_q2[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_avarage from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 3" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_avarage_q3[$key] = $values->class_avarage;
									}
								}else{
									$student_avarage_q3[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_avarage from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 4" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_avarage_q4[$key] = $values->class_avarage;
									}
								}else{
									$student_avarage_q4[$key] = 0;
								}

							}

							?>

						</div>
					</div>
				</div>
			</div>

			<div class="col-span-12 xl:col-span-6">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body">
						<div data-tw-accordion="collapse">
							Class Curve Average
							<div id="column_chart_curve" data-colors='["#5156c4", "#8f1537", "#d79a2a", "#2ab57d"]' class="apex-charts w-full" dir="ltr"></div>  
							<?php  
							$student_curve_q1 = [];
							$student_curve_q2 = [];
							$student_curve_q3 = [];
							$student_curve_q4 = [];

							$blog_id = get_current_blog_id();
							$bg_table_name = "student_avarages";
							$gruoup_subjects = get_field("subject_for_group",$group); 


							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_curve from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 1" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_curve_q1[$key] = $values->class_curve;
									}
								}else{
									$student_curve_q1[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_curve from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 2" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_curve_q2[$key] = $values->class_curve;
									}
								}else{
									$student_curve_q2[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_curve from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 3" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_curve_q3[$key] = $values->class_curve;
									}
								}else{
									$student_curve_q3[$key] = 0;
								}

							}
							foreach ($gruoup_subjects as $key => $value) {
								$table_name = "quarter_avarage";
								$query = $wpdb->prepare("SELECT class_curve from $table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 4" );
								$sonuclar1 = $wpdb->get_results($query);
								if (!empty($sonuclar1)) {
									foreach ($sonuclar1 as $keys => $values) {
										$student_curve_q4[$key] = $values->class_curve;
									}
								}else{
									$student_curve_q4[$key] = 0;
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
		$("#header_title").text("<?php echo get_the_title($group); ?> - <?php echo get_the_title($subject); ?> Yearly Report");
	});


	var columnColors = getChartColorsArray("#column_chart");
	var options = {
		chart: {
			height: 500,
			type: 'bar',
			toolbar: {
				show: true,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '70%',
			},
		},
		dataLabels: {
			enabled: true
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		series: [{
			name: 'Quarter 1',
			data: [
				<?php 
				foreach ($student_avarage_q1 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 2',
			data: [
				<?php 
				foreach ($student_avarage_q2 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 3',
			data: [
				<?php 
				foreach ($student_avarage_q3 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 4',
			data: [
				<?php 
				foreach ($student_avarage_q4 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}],
		colors: columnColors,
		xaxis: {
			categories: [
				<?php  
				foreach ($gruoup_subjects as $key => $value) {
					echo "'";
					echo $value->post_title;
					echo "',";
				}
				?>
				],
		},
		yaxis: {
			title: {
				text: 'Avarage',
				style: {
					fontWeight:  '800',
				},
			},
			min: 0,
			max: 100
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
					return val;
				}
			}
		}
	}

	var chart = new ApexCharts(
		document.querySelector("#column_chart"),
		options
		);

	chart.render();



	var columnColors = getChartColorsArray("#column_chart_curve");
	var options = {
		chart: {
			height: 500,
			type: 'bar',
			toolbar: {
				show: true,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '70%',
			},
		},
		dataLabels: {
			enabled: true
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		series: [{
			name: 'Quarter 1',
			data: [
				<?php 
				foreach ($student_curve_q1 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 2',
			data: [
				<?php 
				foreach ($student_curve_q2 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 3',
			data: [
				<?php 
				foreach ($student_curve_q3 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}, {
			name: 'Quarter 4',
			data: [
				<?php 
				foreach ($student_curve_q4 as $key => $value) {
					echo "'";
					echo $value;
					echo "',";
				}
				?>
				]
		}],
		colors: columnColors,
		xaxis: {
			categories: [
				<?php  
				foreach ($gruoup_subjects as $key => $value) {
					echo "'";
					echo $value->post_title;
					echo "',";
				}
				?>
				],
		},
		yaxis: {
			title: {
				text: 'Avarage',
				style: {
					fontWeight:  '800',
				},
			},
			min: 0,
			max: 100
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
					return val;
				}
			}
		}
	}

	var chart = new ApexCharts(
		document.querySelector("#column_chart_curve"),
		options
		);

	chart.render();

</script>

