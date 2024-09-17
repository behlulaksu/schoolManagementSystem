<?php /* Template Name: One Paper ATAR Report */ ?>
<?php get_header(); ?>
<?php 
if (isset($_GET['class'])){
	$class = strip_tags($_GET["class"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}

if (isset($_GET['quarter'])){
	$quarter = strip_tags($_GET["quarter"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}

$gruoup_subjects = get_field("subject_for_group",$class);
$blog_id = get_current_blog_id();

$quarter_domains = "add_quarter_1_domains";
$grade_advisor_comment = "grade_advisor_comment_q1";
if ($quarter == 1) {
	$grade_advisor_comment = "grade_advisor_comment_q1";
	$quarter_domains = "add_quarter_1_domains";
}elseif ($quarter == 2) {
	$grade_advisor_comment = "grade_advisor_comment_q2";
	$quarter_domains = "add_quarter_2_domains";
}elseif ($quarter == 3) {
	$grade_advisor_comment = "grade_advisor_comment_q3";
	$quarter_domains = "add_quarter_3_domains";
}elseif ($quarter == 4) {
	$grade_advisor_comment = "grade_advisor_comment_q4";
	$quarter_domains = "add_quarter_4_domains";
}
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center;">
						<?php echo get_the_title($class); ?> 
					</h4>
					<button onclick="printContent()" type="button" class=" btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:bg-red-500 hover:bg-gray-600">
						<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
						<span class="px-3 leading-[2.8]">
							Print
						</span>
					</button>
				</div>
			</div>
			<?php  
			$bg_table_name = "student_avarages";
			$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$class." and quarter_id = ".$quarter."" );
			$sonuclar1 = $wpdb->get_results($query);


			foreach ($sonuclar1 as $student) {
				$student_id = $student->student_id;
				if (!array_key_exists($student_id, $grouped_students)) {
					$grouped_students[$student_id] = array();
				}
				$grouped_students[$student_id][] = $student;
			}

			?>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div id="printArea" class="card dark:bg-zinc-800 dark:border-zinc-600">
						<?php $group_users = get_field("group_users",$class); ?>
						<?php 
						if (!empty($group_users)) {
							foreach ($group_users as $key => $value) {
								$get_user_data = get_user_meta($value['ID']);
								?>
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/one-atar-page.jpg" />
									<div class="quarter_number font_gb">
										<?php echo $quarter; ?>
									</div>
									<div class="stundet_info font_gb">
										<div class="stundet_info_1">
											<div class="stundet_info_1_a">
												PR<?php echo $quarter; ?>-2324<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
											<div style="width: 27%;">
												<?php echo get_field('grade', 'user_'.$value['ID']); ?>
											</div>
											<div>
												<?php echo $currentDate = date("d-m-Y"); ?>
											</div>
										</div>
										<div class="stundet_info_2">
											<div class="stundet_info_2_1">
												<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
											</div>
											<div style="width: 27%;">
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
											<div>
												<?php echo get_the_title($class); ?>
											</div>
										</div>
									</div>
									<div class="subject_info">
										<?php 
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											$atar = get_field("atar",$values->subjecet_id);
											if ($atar === "Yes") {
												$selected_lesson = get_field("select_gradebook_definition",$values->subjecet_id);
												$domain_percentage_toplam = 0;
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$domain_percentage_toplam = $domain_percentage_toplam + get_sub_field("domain_percentage");
													endwhile; 
												endif;
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_description">
														<?php echo $domain_percentage_toplam; ?>
													</div>
													<div class="subject_point font_gb">
														<div style="padding: 10px; width: 50%;">
															<?php echo $values->stundent_curve; ?>
														</div>
														<div style="padding: 10px; width: 50%; border-left: 1px solid #f1ba46;">
															<?php 
															$sonuclar = (($values->stundent_curve) * 100) / $domain_percentage_toplam;
															?>
															<?php 
															if ($sonuclar >= 95) {
																echo "A+";
															}elseif ($sonuclar >= 87) {
																echo "A";
															}elseif ($sonuclar >= 81) {
																echo "B+";
															}elseif ($sonuclar >= 73) {
																echo "B";
															}elseif ($sonuclar >= 65) {
																echo "C+";
															}elseif ($sonuclar >= 55) {
																echo "C";
															}elseif ($sonuclar >= 50) {
																echo "D";
															}elseif ($sonuclar < 50) {
																echo "E";
															}
															?>
														</div>
													</div>
												</div>
												<?php 
											}
										}
										// subclass cagirma alani
										$args = array(
											'post_type' => 'user_groups',
											'meta_query' => array(
												array(
													'key' => 'group_users',
													'value' => '"' .$value['ID']. '"',
													'compare' => 'LIKE',
												),
												array(
													'key' => 'sub_class',
													'value' => 'Yes',
													'compare' => '=',
												)
											)
										);
										$my_query = new WP_Query($args);
										$my_query = $my_query->get_posts();
										foreach ($my_query as $keys => $values) {
											$sub_gruoup_subjects = get_field("subject_for_group",$values->ID);
											$select_lesson_type = get_field("select_lesson_type",$sub_gruoup_subjects[0]->ID);
											$atar = get_field("atar",$sub_gruoup_subjects[0]->ID);
											if ($atar === "Yes") {
												$selected_lesson = get_field("select_gradebook_definition",$sub_gruoup_subjects[0]->ID);
												$domain_percentage_toplam = 0;
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$domain_percentage_toplam = $domain_percentage_toplam + get_sub_field("domain_percentage");
													endwhile; 
												endif;
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_description">
														<?php echo $domain_percentage_toplam; ?>
													</div>
													<div class="subject_point font_gb">
														<?php  
														$bg_table_name = "student_avarages";
														$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and quarter_id = ".$quarter." and student_id =".$value['ID']."" );
														$sonuclar1 = $wpdb->get_results($query);
														?>
														<div style="padding: 10px; width: 50%;">
															<?php echo ($sonuclar1[0]->stundent_curve); ?>
														</div>
														<div style="padding: 10px; width: 50%; border-left: 1px solid #f1ba46;">
															<?php 
															$sonuclar = (($sonuclar1[0]->stundent_curve) * 100) / $domain_percentage_toplam;
															?>
															<?php 
															if ($sonuclar >= 95) {
																echo "A+";
															}elseif ($sonuclar >= 87) {
																echo "A";
															}elseif ($sonuclar >= 81) {
																echo "B+";
															}elseif ($sonuclar >= 73) {
																echo "B";
															}elseif ($sonuclar >= 65) {
																echo "C+";
															}elseif ($sonuclar >= 55) {
																echo "C";
															}elseif ($sonuclar >= 50) {
																echo "D";
															}elseif ($sonuclar < 50) {
																echo "E";
															}
															?>
														</div>
													</div>
												</div>
												<?php 
											}
										}
										?>
										<div class="not-atar">
											<img src="<?php echo get_template_directory_uri(); ?>/print/img/atar-commen.svg" alt="">
										</div>
										<?php 
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											$atar = get_field("atar",$values->subjecet_id);
											if ($atar != "Yes") {
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_description" style="border: initial;">
														
													</div>
													<div class="subject_point font_gb">
														<div style="padding: 10px; text-align: center; width: 100%;">
															<?php echo $values->stundent_curve; ?>
														</div>
													</div>
												</div>
												<?php 
											}
										}
										// subclass cagirma alani
										$args = array(
											'post_type' => 'user_groups',
											'meta_query' => array(
												array(
													'key' => 'group_users',
													'value' => '"' .$value['ID']. '"',
													'compare' => 'LIKE',
												),
												array(
													'key' => 'sub_class',
													'value' => 'Yes',
													'compare' => '=',
												)
											)
										);
										$my_query = new WP_Query($args);
										$my_query = $my_query->get_posts();
										foreach ($my_query as $keys => $values) {
											$sub_gruoup_subjects = get_field("subject_for_group",$values->ID);
											$select_lesson_type = get_field("select_lesson_type",$sub_gruoup_subjects[0]->ID);
											$atar = get_field("atar",$sub_gruoup_subjects[0]->ID);
											if ($atar != "Yes") {
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_description" style="border: initial;">
														
													</div>
													<div class="subject_point font_gb">
														<?php  
														$bg_table_name = "student_avarages";
														$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and quarter_id = ".$quarter." and student_id =".$value['ID']."" );
														$sonuclar1 = $wpdb->get_results($query);
														?>
														<div style="padding: 10px; text-align: center; width: 100%;">
															<?php echo ($sonuclar1[0]->stundent_curve); ?>
														</div>
														
													</div>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="grade_advisor font_gb">
										<?php  
										if ($quarter == 1) {
											$bg_table_name = "academic_pdp_comment";
											$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and quarter_id = 1 and type_comment = 'pdp_comment' and class_id =".$class." and student_id =".$value['ID']."" );
											$sonuclar1 = $wpdb->get_results($query);

											if (empty($sonuclar1)) {
												$bg_table_name = "academic_pdp_comment";
												$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and quarter_id = 1 and type_comment = 'advisor_comment' and class_id =".$class." and student_id =".$value['ID']."" );
												$sonuclar1 = $wpdb->get_results($query);
											}
											$removedText = str_replace('\\', '', $sonuclar1[0]->comment);
											echo $removedText;
										}else{
											$comment_type = "grade_advisor_comment";
											$comment_control = get_long_comment($class, $quarter, $value['ID'],$comment_type);
											$kontrol = intval($comment_control[0]->comment);

											if(have_rows($grade_advisor_comment, $class)): 
												while(have_rows($grade_advisor_comment, $class)): 
													the_row(); 
													if ($kontrol == get_row_index()) {
														$metin = get_sub_field("comment"); 
														$eski = "[student-name]";
														$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
														echo str_replace($eski, $yeni, $metin);
													}
												endwhile; 
											endif;
										}
										?>
									</div>
								</div>

								<?php 
							}
						}
						?>



						<style>
							@media screen, print{
								.not-atar{
									width: 87.6%;
									margin: auto;
									margin-top: 40px;
								}
								.subject_description{
									border-left: 1px solid #f1ba46;
									padding: 10px;
									width: 18.5%;
									text-align: center;
								}
								.grade_advisor{
									position: absolute;
									left: 6%;
									top: 82%;
									max-width: 87.7%;
									font-size: 13px;
								}
								.subject_title{
									padding: 10px;
									width: 54.4%;
								}
								.subject_point{
									display: flex;
									text-align: center;
									border-left: 1px solid #f1ba46;
									width: 20.9%;
								}
								.subject_row{
									display: flex;
									width: 87.6%;
									margin-left: 48px;
									border: 1px solid #f1ba46;
									border-top: initial;
									font-size: 12px;
								}
								.subject_info{
									position: absolute;
									left: 0;
									width: 100%;
									top: 27.3%;
								}
								.quarter_number{
									position: absolute;
									left: 6%;
									top: 7.3%;
									font-size: 23px;
									color: #eca100;
									font-weight: bold;
								}
								.stundet_info_2_1{
									width: 43%; padding-left: 95px;
								}
								.stundet_info_1_a{
									width: 43%; padding-left: 45px;
								}
								.stundet_info_1{
									display: flex; max-width: 725px; margin: auto;
								}
								.stundet_info_2{
									display: flex; max-width: 725px; margin: auto; margin-top: 14px;
								}
								.stundet_info{
									position: absolute;
									top: 16.8%;
									left: 0;
									width: 100%;
									font-size: 11px;
								}
								.card_div{
									width: 100%;
									position: relative;
								}
								#printArea{
									width: 1240px;
									position: relative;
								}
								@font-face{
									font-family: "Gotham Book";
									src: url("../font/GOTHAM-BOOK.eot");
									src: url("../font/GOTHAM-BOOK.eot?#iefix") format("embedded-opentype"),
									url("../font/GOTHAM-BOOK.otf") format("opentype"),
									url("../font/GOTHAM-BOOK.svg") format("svg"),
									url("../font/GOTHAM-BOOK.ttf") format("truetype"),
									url("../font/GOTHAM-BOOK.woff") format("woff"),
									url("../font/GOTHAM-BOOK.woff2") format("woff2");
									font-weight: normal;
									font-style: normal;
								}
								@font-face{
									font-family: "Gotham Bold";
									src: url("../font/GOTHAM-BOLD.eot");
									src: url("../font/GOTHAM-BOLD.eot?#iefix") format("embedded-opentype"),
									url("../font/GOTHAM-BOLD.otf") format("opentype"),
									url("../font/GOTHAM-BOLD.svg") format("svg"),
									url("../font/GOTHAM-BOLD.ttf") format("truetype"),
									url("../font/GOTHAM-BOLD.woff") format("woff"),
									url("../font/GOTHAM-BOLD.woff2") format("woff2");
									font-weight: normal;
									font-style: normal;
								}
								@font-face{
									font-family: "Gotham Light";
									src: url("../font/Gotham-Light.eot");
									src: url("../font/Gotham-Light.eot?#iefix") format("embedded-opentype"),
									url("../font/Gotham-Light.otf") format("opentype"),
									url("../font/Gotham-Light.svg") format("svg"),
									url("../font/Gotham-Light.ttf") format("truetype"),
									url("../font/Gotham-Light.woff") format("woff"),
									url("../font/Gotham-Light.woff2") format("woff2");
									font-weight: normal;
									font-style: normal;
								}
								.font_gl{
									font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;
								}
								.font_gb{
									font-family:'Gotham Bold','Gotham Book',sans-serif;
								}
								.font_gbook{
									font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;
								}
							}
						</style>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<style>
	.not-atar{
		width: 1086px;
		margin: auto;
		margin-top: 40px;
	}
	.subject_description{
		border-left: 1px solid #f1ba46;
		padding: 10px;
		width: 21.4%;
	}
	.grade_advisor{
		position: absolute;
		left: 6%;
		top: 82%;
		max-width: 87.7%;
		font-size: 15px;
	}
	.subject_title{
		padding: 10px;
		width: 57.3%;
	}
	.subject_point{
		border-left: 1px solid #f1ba46;
		width: 21.3%;
	}
	.subject_row{
		display: flex;
		width: 1086px;
		margin-left: 75px;
		border: 1px solid #f1ba46;
		border-top: initial;
		font-size: initial;
	}
	.subject_info{
		position: absolute;
		left: 0;
		width: 100%;
		top: 27.3%;
	}
	.quarter_number{
		position: absolute;
		left: 6%;
		top: 7%;
		font-size: 30px;
		color: #eca100;
		font-weight: bold;
	}
	.stundet_info_2_1{
		width: 57%; padding-left: 120px;
	}
	.stundet_info_1_a{
		width: 50%; padding-left: 45px;
	}
	.stundet_info{
		position: absolute;
		top: 16.6%;
		left: 0;
		width: 100%;
		font-size: 15px;
	}
	.stundet_info_1{
		display: flex; max-width: 1080px; margin: auto;
	}
	.stundet_info_2{
		display: flex; max-width: 1080px; margin: auto; margin-top: 20px;
	}
</style>









<?php get_footer(); ?>



<script>
	function printContent() {
    var printWindow = window.open('', '', 'width=810,height=877'); // Yeni bir pencere aç
    var printDocument = printWindow.document;
    var printContent = document.getElementById('printArea').innerHTML; // Yazdırılacak içeriği al

    // Yazdırılacak içeriği yeni pencereye aktar
    printDocument.write('<html><head><title>Print</title>');
    printDocument.write('<link rel="stylesheet" type="text/css" href="styles.css">'); // CSS dosyasını bağlayın
    printDocument.write('</head><body style="margin:initial">');
    printDocument.write(printContent);
    printDocument.write('</body></html>');

    // Yeni pencereyi yazdır
    printWindow.document.close(); // Dokümanı kapat
    printWindow.print(); // Yazdır
}


</script>



