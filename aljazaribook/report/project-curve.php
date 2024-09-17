<?php /* Template Name: Project Curve */ ?>

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

get_header();

?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php $current_user_now = wp_get_current_user(); ?>
<?php $current_user_id = get_current_user_id(); ?>
<?php  

$blog_id = get_current_blog_id();
$bg_table_name = "final_project";
global $wpdb;
$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and did_project = 1 and subject_id =".$subject."" );
$project_control = $wpdb->get_results($query);


$bg_table_name = "student_avarages";
$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and subjecet_id =".$subject."" );
$sonuclar1 = $wpdb->get_results($query);

$quarter_1 = 0;
$quarter_2 = 0;
$quarter_3 = 0;
$quarter_4 = 0;
$project_curve = 0;
$project_highest = 100;
$not_curv_finals = [];
$curv_finals = [];
$ogrenci_total_curved = [];
$ogrenci_curved_difference = [];

$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;

if(have_rows('add_quarter_1_domains', $gradebook_ID)): 
	while(have_rows('add_quarter_1_domains', $gradebook_ID)): 
		the_row(); 
		$quarter_1 = $quarter_1 + get_sub_field("domain_percentage");
	endwhile; 
endif;
if(have_rows('add_quarter_2_domains', $gradebook_ID)): 
	while(have_rows('add_quarter_2_domains', $gradebook_ID)): 
		the_row(); 
		$quarter_2 = $quarter_2 + get_sub_field("domain_percentage");
	endwhile; 
endif;
if(have_rows('add_quarter_3_domains', $gradebook_ID)): 
	while(have_rows('add_quarter_3_domains', $gradebook_ID)): 
		the_row(); 
		$quarter_3 = $quarter_3 + get_sub_field("domain_percentage");
	endwhile; 
endif;
if(have_rows('add_quarter_4_domains', $gradebook_ID)): 
	while(have_rows('add_quarter_4_domains', $gradebook_ID)): 
		the_row(); 
		$quarter_4 = $quarter_4 + get_sub_field("domain_percentage");
	endwhile; 
endif;
function sifirlariCikar($dizi) {
	$dizi0Haric = array_filter($dizi, function($deger) {
		return $deger != 0;
	});
	return $dizi0Haric;
}

$bg_table_name = "curve_base";
$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and quarter_id = 5 and class_id = 9999999999 and subjecet_id =".$subject."" );
$get_curve = $wpdb->get_results($query);
if ($get_curve[0]->curve_point) {
	$project_curve = $get_curve[0]->curve_point;
}
if ($get_curve[0]->highest_mark) {
	$project_highest = $get_curve[0]->highest_mark;
}
?>
<style>
	.yesil_yapma{
		background-color: green;
		color: #fff;
		text-align: center;
	}
	.kirmizi_yapma{
		background-color: red;
		color: #fff;
		text-align: center;
	}
	.mavi_yapma{
		background-color: blue;
		color: #fff;
	}
</style>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]" style="position: relative;">
			<?php  
			// echo "<pre>";
			// print_r($sonuclar1);
			// echo "<pre>";
			?>

			<div style="width: 55%;"> 
				<div class="relative overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 ">
						<thead class="text-sm text-gray-700 dark:text-gray-100">
							<tr class="border border-gray-50 dark:border-zinc-600">
								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Student Name
								</th>
								<th scope="col" class="yesil_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q1 <br> ( <?php echo $quarter_1; ?> )
								</th>
								<th scope="col" class="yesil_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q2 <br> ( <?php echo $quarter_2; ?> )
								</th>
								<th scope="col" class="yesil_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q3 <br> ( <?php echo $quarter_3; ?> )
								</th>
								<th scope="col" class="yesil_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q4 <br> ( <?php echo $quarter_4; ?> )
								</th>
								<th scope="col" class="yesil_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Final
								</th>
							</tr>
						</thead>
						<tbody>
							<?php  
							foreach ($project_control as $key => $value) {
								$student_final = 0;
								?>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
										<?php echo $display_name = get_the_author_meta('display_name', $value->student_id); ?>
									</th>
									<td class="yesil_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 1) {
												echo $valueler->stundent_curve;
												$kontrol = 1;
												if ($quarter_1 == 100) {
													$student_final = (($quarter_1 * $valueler->stundent_curve)/100) + $student_final;
												}else{
													$student_final = $student_final + $valueler->stundent_curve;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="yesil_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 2) {
												echo $valueler->stundent_curve;
												$kontrol = 1;
												if ($quarter_1 == 100) {
													$student_final = (($quarter_2 * $valueler->stundent_curve)/100) + $student_final;
												}else{
													$student_final = $student_final + $valueler->stundent_curve;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="yesil_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 3) {
												echo $valueler->stundent_curve;
												$kontrol = 1;
												if ($quarter_1 == 100) {
													$student_final = (($quarter_3 * $valueler->stundent_curve)/100) + $student_final;
												}else{
													$student_final = $student_final + $valueler->stundent_curve;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="yesil_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 4) {
												echo $valueler->stundent_curve;
												$kontrol = 1;
												if ($quarter_1 == 100) {
													$student_final = (($quarter_4 * $valueler->stundent_curve)/100) + $student_final;
												}else{
													$student_final = $student_final + $valueler->stundent_curve;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="yesil_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php
										if ($quarter_1 == 100) {
											echo $not_curv_finals[$key] = $student_final/4; 
										}else{
											echo $not_curv_finals[$key] = $student_final; 
										}
										?>
									</td>
								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-body"> 
				<div class="relative overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 ">
						<thead class="text-sm text-gray-700 dark:text-gray-100">
							<tr class="border border-gray-50 dark:border-zinc-600">
								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Class Min
								</th>
								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Class Max
								</th>
								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Min mark
								</th>
								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Highest Mark
								</th>
								<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									CURVE BASE
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
									<?php 
									$not_curv_finals = sifirlariCikar($not_curv_finals);
									echo $min_not_curve = min($not_curv_finals);
									?>
								</td>
								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
									<?php  
									echo $max_not_curve = max($not_curv_finals);
									?>
								</td>
								<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
									<?php  
									echo $min_mark = $project_curve+$min_not_curve;
									?>
								</th>
								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
									<input id="value_max" value="<?php echo $project_highest; ?>" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" max="100">
								</td>
								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
									<input value="<?php echo $project_curve; ?>" id="curve_input" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" max="100">
								</td>
								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
									<button type="button" class="change_curve btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
										Save Curve
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div style="width: 42%; position: absolute; top: 0; right: 0;"> 
				<div class="relative overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 ">
						<thead class="text-sm text-gray-700 dark:text-gray-100">
							<tr class="border border-gray-50 dark:border-zinc-600">
								<th style="background-color: #000; color: #fff; text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Total <br> (Curved)
								</th>
								<th style="background-color: #00000085; color: #fff; text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Difference
								</th>
								<th style="text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q1 <br>
									(<?php echo $quarter_1; ?>)
								</th>
								<th style="text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q2 <br>
									(<?php echo $quarter_2; ?>)
								</th>
								<th style="text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q3 <br>
									(<?php echo $quarter_3; ?>)
								</th>
								<th style="text-align: center;" scope="col" class="kirmizi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Q4 <br>
									(<?php echo $quarter_4; ?>)
								</th>
								<th style="text-align: center;" scope="col" class="mavi_yapma px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
									Final
								</th>
							</tr>
						</thead>
						<tbody>
							<?php  
							foreach ($project_control as $key => $value) {
								$student_final = 0;
								?>
								<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
									<td style="background-color: #000; color: #fff; " class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										echo $ogrenci_total_curved[$key] = number_format(($min_mark+($project_highest-$min_mark)/($max_not_curve-$min_not_curve)*($not_curv_finals[$key] - $min_not_curve)),2);
										?>
									</td>
									<td style="background-color: #00000085; color: #fff;" class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										echo $ogrenci_curved_difference[$key] = number_format($ogrenci_total_curved[$key] - $not_curv_finals[$key],2);
										?>
									</td>
									<td class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 1) {
												if ($valueler->stundent_curve + $ogrenci_curved_difference[$key] > 99.99) {
													$student_final = $student_final + 100;
													echo "100";
													$kontrol = 1;
												}else{
													if ($quarter_1 == 100) {
														echo $valueler->stundent_curve + $ogrenci_curved_difference[$key];
														$student_final = $student_final + ($quarter_1*($valueler->stundent_curve + $ogrenci_curved_difference[$key]))/100;
													}else{
														if (($valueler->stundent_curve + $ogrenci_curved_difference[$key]/4) > $quarter_1) {
															echo $quarter_1;
															$student_final = $student_final + $quarter_1;
														}else{
															echo $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
															$student_final = $student_final + $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
														}
													}
													$kontrol = 1;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 2) {
												if ($valueler->stundent_curve + $ogrenci_curved_difference[$key] > 99.99) {
													$student_final = $student_final + 100;
													echo "100";
													$kontrol = 1;
												}else{
													if ($quarter_1 == 100) {
														echo $valueler->stundent_curve + $ogrenci_curved_difference[$key];
														$student_final = $student_final + ($quarter_2*($valueler->stundent_curve + $ogrenci_curved_difference[$key]))/100;
													}else{
														if (($valueler->stundent_curve + $ogrenci_curved_difference[$key]/4) > $quarter_2) {
															echo $quarter_2;
															$student_final = $student_final + $quarter_2;
														}else{
															echo $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
															$student_final = $student_final + $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
														}
													}
													$kontrol = 1;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 3) {
												if ($valueler->stundent_curve + $ogrenci_curved_difference[$key] > 99.99) {
													$student_final = $student_final + 100;
													echo "100";
													$kontrol = 1;
												}else{
													if ($quarter_1 == 100) {
														echo $valueler->stundent_curve + $ogrenci_curved_difference[$key];
														$student_final = $student_final + ($quarter_3*($valueler->stundent_curve + $ogrenci_curved_difference[$key]))/100;
													}else{
														if (($valueler->stundent_curve + $ogrenci_curved_difference[$key]/4) > $quarter_3) {
															echo $quarter_3;
															$student_final = $student_final + $quarter_3;
														}else{
															echo $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
															$student_final = $student_final + $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
														}
													}
													$kontrol = 1;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 4) {
												if ($valueler->stundent_curve + $ogrenci_curved_difference[$key] > 99.99) {
													$student_final = $student_final + 100;
													echo "100";
													$kontrol = 1;
												}else{
													if ($quarter_1 == 100) {
														echo $valueler->stundent_curve + $ogrenci_curved_difference[$key];
														$student_final = $student_final + ($quarter_4*($valueler->stundent_curve + $ogrenci_curved_difference[$key]))/100;
													}else{
														if (($valueler->stundent_curve + $ogrenci_curved_difference[$key]/4) > $quarter_4) {
															echo $quarter_4;
															$student_final = $student_final + $quarter_4;
														}else{
															echo $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
															$student_final = $student_final + $valueler->stundent_curve + $ogrenci_curved_difference[$key]/4;
														}
													}
													$kontrol = 1;
												}
											}
										}
										if ($kontrol == 0) {
											echo "X";
										}
										?>
									</td>
									<td class="mavi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php
										if ($quarter_1 == 100) {
											echo $curv_finals[$key] = number_format(($student_final/4),2); 
										}else{
											echo $curv_finals[$key] = number_format($student_final,2); 
										}
										?>
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



<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>
<style>
	.main-content th, .main-content td{
		padding: 7px !important;
		padding-top: 13px !important;
		padding-bottom: 13px !important;
	}
</style>
<script>
	$(document).ready(function(){
		$("#header_title").text("<?php echo get_the_title($subject); ?> - Project Base Curve");
	});

	$(".change_curve").click(function(){
		input_value = $("#curve_input").val();
		input_value_max = $("#value_max").val();


		subject = <?php echo $subject; ?>;
		quarter_id = 5;
		group = 9999999999;
		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_curve',

				curve:input_value,
				input_value_max:input_value_max,
				subject:subject,
				group:group,
				quarter_id:quarter_id,

			}),
			success: function(data){
				console.log(data);
				if (data.data === "tamam") {
					location.reload();
				}
			}

		});


	});
</script>