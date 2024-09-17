<?php /* Template Name: Curve Settings */ ?>

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

?>


<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<?php  
$selected_lesson = get_field("select_gradebook_definition",$subject);
$gradebook_ID = $selected_lesson[0]->ID;
$group_users = get_field("group_users",$group);


$quarter_1_domainler = []; 
$domain_toplama = [];


/* get student not start */
$book_objective = "book_".get_current_blog_id()."_gradebook";
global $wpdb;
$query = $wpdb->prepare("SELECT * from $book_objective where gb_subject_id =".$subject." and gb_quarter_id =".$quarter."" );
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
						if ($valueler->gb_group_id == $group && $valueler->gb_gradebook_id == $gradebook_ID && $valueler->gb_domain_id == $data_id_counter && $valueler->gb_subdomain_id == $subDomainID && $valueler->gb_student_id == $value['ID']) {
							$point_control = $valueler->gb_point;

						}
					}


					if (empty($point_control)) {
						$point_control = 0;
					}
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
							<h3 style="text-align: center;" class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo get_the_title($group); ?> <br> <?php echo get_the_title($subject); ?>
							</h3>
							<h3 style="text-align: center;" class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								Quarter <?php echo $quarter; ?> <br> Average
							</h3>
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
							<div class="flex items-center">
								<label for="curve_1" style="padding-right: 7px; text-align: center;"> Curve Base </label>
								<input value="<?php echo $curve_point; ?>" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" id="curve_1">
								<label for="curve_max_1" style="padding-right: 7px; text-align: center; margin-left: 7px;"> Highest Mark </label>
								<input value="<?php echo $highest_mark; ?>" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" id="curve_max_1">
								<button style="margin-left: 15px;" type="button" max_curve="curve_max_1" curve="curve_1" class="change_curve btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
									Save Curve
								</button>
							</div>
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
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Difference
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
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100 student_id">
												<?php 
												if ($bunuyaz <= 0) {
													echo "0";
												}else{
													echo number_format($curved_mark - $domain_toplama[$value['ID']], 2, '.', '');
													$sayma = $sayma + 1;
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
											<?php 
											$blog_id = get_current_blog_id();
											$bg_table_name = "student_avarages";
											$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$subject." and quarter_id = ".$quarter."" );
											$sonuclar2 = $wpdb->get_results($query);
											if (!empty($sonuclar2)) {
												$color_bg = "green";
											}
											?>
											<button quarter_id="<?php echo $quarter; ?>" style="width: 100%; background-color: <?php echo $color_bg ; ?>!important;" type="button" class="save_avarages btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
												Ready To Print
											</button>
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
		$("#header_title").text("<?php echo get_the_title($group); ?> - <?php echo get_the_title($subject); ?> Curve");
	});


	$(".save_avarages").click(function(){
		class_avarage = [];
		class_curve = [];

		class_avarage_total = $("[class_avarage]").attr("class_avarage");
		class_curve_total = $("[curve_avarage]").attr("curve_avarage");
		console.log(class_curve_total);

		quarter_id = <?php echo $quarter; ?>;
		group = <?php echo $group; ?>;
		subject = <?php echo $subject; ?>;

		class_avarage = avarage_q1;
		class_curve = curve_q1;
		quarter_id = <?php echo $quarter; ?>;

		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_class_avarage',

				students_subject:students_subject,
				class_avarage:class_avarage,
				class_curve:class_curve,

				group:group,
				subject:subject,
				quarter_id:quarter_id,

				class_avarage_total:class_avarage_total,
				class_curve_total:class_curve_total,

			}),
			success: function(data){
				if (data.data === "tamam") {
					Swal.fire(
					{
						title: 'Average Uploaded',
						text: '',
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#8f1537',
					}
					)
				}else{
					Swal.fire({
						title: "Didn't Work",
						text: "It looks like we have a problem.",
						icon: "warning",
						showCancelButton: false,
						confirmButtonColor: "#8f1537",
					})
				}
			}

		});

	});


	/* Update Curve */
	$(".change_curve").click(function(){
		button_value = $(this).attr("curve");
		button_value_max = $(this).attr("max_curve");
		input_value = $("#"+button_value+"").val();
		input_value_max = $("#"+button_value_max+"").val();


		group = <?php echo $group; ?>;
		subject = <?php echo $subject; ?>;
		quarter_id = <?php echo $quarter ?>;

		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_curve',

				curve:input_value,
				input_value_max:input_value_max,
				group:group,
				subject:subject,
				quarter_id:quarter_id,


			}),
			success: function(data){
				if (data.data === "tamam") {
					location.reload();
				}
			}

		});


	});

</script>