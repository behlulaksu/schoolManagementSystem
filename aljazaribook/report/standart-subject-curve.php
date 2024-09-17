<?php /* Template Name: Standart Subject Curve */ ?>

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
$not_curv_finals = [];
$curv_finals = [];

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
		text-align: center;
	}
</style>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]" style="position: relative;">

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
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 1) {
													echo $valueler->stundent_curve;
													$student_final = $student_final + $valueler->stundent_curve;
													$kontrol = 1;
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
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 2) {
													echo $valueler->stundent_curve;
													$student_final = $student_final + $valueler->stundent_curve;
													$kontrol = 1;
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
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 3) {
													echo $valueler->stundent_curve;
													$student_final = $student_final + $valueler->stundent_curve;
													$kontrol = 1;
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
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 4) {
													echo $valueler->stundent_curve;
													$student_final = $student_final + $valueler->stundent_curve;
													$kontrol = 1;
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

			<div style="width: 42%; position: absolute; top: 0; right: 0;"> 
				<div class="relative overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 ">
						<thead class="text-sm text-gray-700 dark:text-gray-100">
							<tr class="border border-gray-50 dark:border-zinc-600">
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
									<td new_not_quarter1 class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 1) {
													if ($quarter_1 == 100) {
														echo number_format((($valueler->stundent_curve*70/100)+30),2);
														$student_final = $student_final + (($valueler->stundent_curve*70/100)+30);
													}else{
														echo number_format((($valueler->stundent_curve*70/100)+30*$quarter_1/100),2);
														$student_final = $student_final + ((($valueler->stundent_curve*70/100)+30*$quarter_1/100));
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
									<td new_not_quarter2 class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 2) {
													if ($quarter_1 == 100) {
														echo number_format((($valueler->stundent_curve*70/100)+30),2);
														$student_final = $student_final + (($valueler->stundent_curve*70/100)+30);
													}else{
														echo number_format((($valueler->stundent_curve*70/100)+30*$quarter_2/100),2);
														$student_final = $student_final + ((($valueler->stundent_curve*70/100)+30*$quarter_2/100));
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
									<td new_not_quarter3 class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 3) {
													if ($quarter_1 == 100) {
														echo number_format((($valueler->stundent_curve*70/100)+30),2);
														$student_final = $student_final + (($valueler->stundent_curve*70/100)+30);
													}else{
														echo number_format((($valueler->stundent_curve*70/100)+30*$quarter_3/100),2);
														$student_final = $student_final + ((($valueler->stundent_curve*70/100)+30*$quarter_3/100));
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
									<td new_not_quarter4 class="kirmizi_yapma px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
										<?php  
										$kontrol = 0;
										foreach ($sonuclar1 as $keyler => $valueler) {
											if ($kontrol == 0) {
												if ($valueler->student_id == $value->student_id && $valueler->quarter_id == 4) {
													if ($quarter_1 == 100) {
														echo number_format((($valueler->stundent_curve*70/100)+30),2);
														$student_final = $student_final + (($valueler->stundent_curve*70/100)+30);
													}else{
														echo number_format((($valueler->stundent_curve*70/100)+30*$quarter_4/100),2);
														$student_final = $student_final + ((($valueler->stundent_curve*70/100)+30*$quarter_4/100));
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

			<button style="width: 100%; margin-top: 50px;" type="button" class="save_avarages btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
				Improve Marks
			</button>

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
		$("#header_title").text("<?php echo get_the_title($subject); ?> - Improve Marks");
	});

	$(".save_avarages").click(function(){
		new_not_quarter1_array = [];
		new_not_quarter2_array = [];
		new_not_quarter3_array = [];
		new_not_quarter4_array = [];

		new_not_quarter1 = $("[new_not_quarter1]");
		for (var i = 0; i < new_not_quarter1.length; i++) {
			new_not_quarter1_array[i] = $("[new_not_quarter1]")[i].innerText;
			new_not_quarter2_array[i] = $("[new_not_quarter2]")[i].innerText;
			new_not_quarter3_array[i] = $("[new_not_quarter3]")[i].innerText;
			new_not_quarter4_array[i] = $("[new_not_quarter4]")[i].innerText;
		}
		console.log(new_not_quarter1_array);
		console.log(new_not_quarter2_array);
		console.log(new_not_quarter3_array);
		console.log(new_not_quarter4_array);

	});

</script>