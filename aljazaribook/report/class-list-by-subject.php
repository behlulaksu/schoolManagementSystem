<?php /* Template Name: Class List Report By Subject */ ?>

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
<?php 
$current_user_now = wp_get_current_user(); 
$blog_id = get_current_blog_id();
$group_users = get_field("group_users",$group);
$sonuc_notlar_array = array();
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div id="degistirdim" data-colors='["#5156be", "#2ab57d", "#8e1838", "#d79a2a", "#74788d"]' class="apex-charts w-full" dir="ltr"></div>

			<?php  
			$bg_table_name = "student_avarages";
			foreach ($group_users as $key => $value) {
				$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and student_id=".$value['ID']." and group_id =".$group."" );
				$sonuclar1 = $wpdb->get_results($query);
				?>
				<table class="w-full text-sm text-left text-gray-500" style="margin-bottom: 50px;">
					<thead class="text-sm text-gray-700 dark:text-gray-100">
						<tr class="border border-gray-50 dark:border-zinc-600">
							<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								#
							</th>
							<th style="background-color: #5156be !important; color: #fff; " scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								Quarter 1
							</th>
							<th style="background-color: #2ab57d !important; color: #fff; " scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								Quarter 2
							</th>
							<th style="background-color: #8e1838 !important; color: #fff; " scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								Quarter 3
							</th>
							<th style="background-color: #d79a2a !important; color: #fff; " scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								Quarter 4
							</th>
							<th style="background-color: #74788d !important; color: #fff; " scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
								Final
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
							<th style="width: 40%;" scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
								<?php echo $value['display_name']; ?>
							</th>
							<td style="background-color: #5156be !important; color: #fff;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
								<?php 
								$ogrenci_toplama = 0;
								$kresi_sayar = 0;
								foreach ($sonuclar1 as $keyler => $valueler) {
									if ($valueler->quarter_id == 1) {
										$ogrenci_toplama = $ogrenci_toplama + ($valueler->stundent_curve * get_credit($group,$valueler->subjecet_id)[0]->credit);
										$kresi_sayar = get_credit($group,$valueler->subjecet_id)[0]->credit + $kresi_sayar;
									}
								}
								echo number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								$sonuc_notlar_array[1][$key] = number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								?>
							</td>
							<td style="background-color: #2ab57d !important; color: #fff; " class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
								<?php 
								$ogrenci_toplama = 0;
								$kresi_sayar = 0;
								foreach ($sonuclar1 as $keyler => $valueler) {
									if ($valueler->quarter_id == 2) {
										$ogrenci_toplama = $ogrenci_toplama + ($valueler->stundent_curve * get_credit($group,$valueler->subjecet_id)[0]->credit);
										$kresi_sayar = get_credit($group,$valueler->subjecet_id)[0]->credit + $kresi_sayar;
									}
								}
								echo number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								$sonuc_notlar_array[2][$key] = number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								?>
							</td>
							<td style="background-color: #8e1838 !important; color: #fff; " class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
								<?php 
								$ogrenci_toplama = 0;
								$kresi_sayar = 0;
								foreach ($sonuclar1 as $keyler => $valueler) {
									if ($valueler->quarter_id == 3) {
										$ogrenci_toplama = $ogrenci_toplama + ($valueler->stundent_curve * get_credit($group,$valueler->subjecet_id)[0]->credit);
										$kresi_sayar = get_credit($group,$valueler->subjecet_id)[0]->credit + $kresi_sayar;
									}
								}
								echo number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								$sonuc_notlar_array[3][$key] = number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								?>
							</td>
							<td style="background-color: #d79a2a !important; color: #fff; " class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
								<?php 
								$ogrenci_toplama = 1;
								$kresi_sayar = 1;
								foreach ($sonuclar1 as $keyler => $valueler) {
									if ($valueler->quarter_id == 4) {
										$ogrenci_toplama = $ogrenci_toplama + ($valueler->stundent_curve * get_credit($group,$valueler->subjecet_id)[0]->credit);
										$kresi_sayar = get_credit($group,$valueler->subjecet_id)[0]->credit + $kresi_sayar;
									}
								}
								echo number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								$sonuc_notlar_array[4][$key] = number_format(($ogrenci_toplama / $kresi_sayar), 2, ',', '.');
								?>
							</td>
							<td style="background-color: #74788d !important; color: #fff; " class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
								<?php 
								$ekrana_yaz = 0; 
								for ($i=1; $i < 5; $i++) { 
									$ekrana_yaz = $ekrana_yaz + $sonuc_notlar_array[$i][$key];
								}
								echo $sonuc_notlar_array[5][$key] = $ekrana_yaz/4;
								?>
							</td>
						</tr>

					</tbody>
				</table>
				<?php 
			}
			?>

		</div>
	</div>
</div>


<style>
	#degistirdim{
		margin-bottom: 50px;
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
		$("#header_title").text("<?php echo get_the_title($group); ?> - <?php echo get_the_title($subject); ?>");
	});
</script>


<script>
	$(document).ready(function(){

		var lineDatalabelColors = getChartColorsArray("#degistirdim");
		var options = {
			chart: {
				height: 600,
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
				enabled: true,
			},
			stroke: {
				width: [3, 3],
				curve: 'straight'
			},
			series: [
			{
				name: "Quarter 1",
				data: [
					<?php  
					foreach ($group_users as $key => $value) {
						echo "'";
						echo $sonuc_notlar_array[1][$key];
						echo "',";
					}
					?>
					]
			},
			{
				name: "Quarter 2",
				data: [
					<?php  
					foreach ($group_users as $key => $value) {
						echo "'";
						echo $sonuc_notlar_array[2][$key];
						echo "',";
					}
					?>
					]
			},
			{
				name: "Quarter 3",
				data: [
					<?php  
					foreach ($group_users as $key => $value) {
						echo "'";
						echo $sonuc_notlar_array[3][$key];
						echo "',";
					}
					?>
					]
			},
			{
				name: "Quarter 4",
				data: [
					<?php  
					foreach ($group_users as $key => $value) {
						echo "'";
						echo $sonuc_notlar_array[4][$key];
						echo "',";
					}
					?>
					]
			}
			,
			{
				name: "Final",
				data: [
					<?php  
					foreach ($group_users as $key => $value) {
						echo "'";
						echo $sonuc_notlar_array[5][$key];
						echo "',";
					}
					?>
					]
			}
			],
			title: {
				text: 'Students Comparison Table',
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
		text: 'Point'
	} 
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
	document.querySelector("#degistirdim"),
	options
	);

chart.render();

});
</script>