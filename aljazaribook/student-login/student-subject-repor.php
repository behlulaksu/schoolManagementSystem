<?php /* Template Name: Student Subject Report */ ?>

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

	if ($quarter == 1) {
		$domain_getir = 'add_quarter_1_domains';
	}elseif ($quarter == 2) {
		$domain_getir = 'add_quarter_2_domains';
	}elseif ($quarter == 3) {
		$domain_getir = 'add_quarter_3_domains';
	}elseif ($quarter == 4) {
		$domain_getir = 'add_quarter_4_domains';
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

<?php include 'header.php';?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php 
$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;
$group_users = get_field("group_users",$group);
?>
<div class="page-content dark:bg-zinc-700">
	<div class="container-fluid px-[0.625rem]">
		<div class="col-span-12 xl:col-span-6">
			<div class="card dark:bg-zinc-800 dark:border-zinc-600">
				<div class="card-body">
					<div id="student_report" data-colors='["#8f1537", "#d79a2a", "#2ab57d"]' class="apex-charts w-full" dir="ltr"></div>
					<?php  
					$book_objective = "book_".get_current_blog_id()."_gradebook";

					global $wpdb;
					$query = $wpdb->prepare("SELECT * from $book_objective where gb_group_id =".$group." and gb_subject_id =".$subject." and gb_quarter_id =".$quarter." and gb_gradebook_id =".$gradebook_ID."" );
					$sonuclar = $wpdb->get_results($query);
					// echo "<pre>";
					// print_r($sonuclar);
					// echo "<pre>";

					?>
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
<?php include 'footer.php';?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- apexcharts js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>
<script>
	$(document).ready(function(){
		$("#header_title").text("<?php echo $user_data->display_name; ?> - <?php echo get_the_title($subject); ?> Student Report");
	});
</script>

<?php 



$sayac = 0;
$assessments_avarage = [];
$max_point = [];
$assessments_name = [];
$student_point = [];




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
					$point_array = []; 
					foreach ($group_users as $key => $value) {

						foreach ($sonuclar as $keyler => $valueler) {
							if ($valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == $subDomainID && $valueler->gb_student_id == $value['ID']) {
								$point_control = $valueler->gb_point;
								break;
							}else{
								$point_control = "";
							}
						}
						//$point_control = get_student_one_not($group,$subject,$quarter,$gradebook_ID,$data_id_counter,$subDomainID,$value['ID']);
						if (!empty($point_control)) {
							$point_array[$key] = $point_control;
						}else{
							$point_array[$key] = 0;
						}
					}

					foreach ($sonuclar as $keyler => $valueler) {
						if ($valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == $subDomainID && $valueler->gb_student_id == $student) {
							$student_point[$sayac] = $valueler->gb_point;
						}
					}
					//$student_point[$sayac] = get_student_one_not($group,$subject,$quarter,$gradebook_ID,$data_id_counter,$subDomainID,$student);

					$deneme_sum = array_sum($point_array);
					$deneme_count = count($point_array);

					$class_avarage_subdomain = ($deneme_sum/$deneme_count);
					$class_avarage_subdomain = round($class_avarage_subdomain);
					
					$assessments_avarage[$sayac] = $class_avarage_subdomain;
					$max_point[$sayac] = get_sub_field("based_on");
					$assessments_name[$sayac] = get_sub_field("sub_domain_name");

					$sayac = $sayac + 1;
				endwhile; 
			endif; 
		}
	endwhile; 
endif; 

?>

<script>
	$(document).ready(function(){
		var columnColors = getChartColorsArray("#student_report");
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
					columnWidth: '45%',
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
				name: 'Max Point',
				data: [
					<?php 
					foreach ($max_point as $key => $value) {
						echo "'";
						echo $value;
						echo "',";
					}
					?>
					]
			}, {
				name: 'Class Avarage',
				data: [
					<?php 
					foreach ($assessments_avarage as $key => $value) {
						echo "'";
						echo $value;
						echo "',";
					}
					?>
					]
			}, {
				name: '<?php echo $user_data->display_name; ?>',
				data: [
					<?php 
					foreach ($student_point as $key => $value) {
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
					foreach ($assessments_name as $key => $value) {
						echo "'";
						echo $value;
						echo "',";
					}
					?>
					],
			},
			yaxis: {
				title: {
					text: 'Point',
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
						return "" + val + " "
					}
				}
			}
		}

		var chart = new ApexCharts(
			document.querySelector("#student_report"),
			options
			);

		chart.render();




	});
</script>
