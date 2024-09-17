<?php /* Template Name: Semester 1 Report Card TR */ ?>
<?php get_header(); ?>


<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/tr/5-10-sayfa1.png" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa2.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa3-1.jpg" as="image">


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

if (isset($_GET['user'])){
	$student = strip_tags($_GET["user"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}

$blog_id = get_current_blog_id();
$get_user_data = get_user_meta($student);
$gruoup_subjects = get_field("subject_for_group",$group);

$args = array(
	'post_type' => 'user_groups',
	'meta_query' => array(
		array(
			'key' => 'group_users',
			'value' => '"' .$student. '"',
			'compare' => 'LIKE',
		),
		array(
			'key' => 'sub_class',
			'value' => 'Yes',
			'compare' => '=',
		)
	)
);

$sub_gruoup_subjects = [];
$sub_gruoup_domain = [];
$my_query = new WP_Query($args);
$my_query = $my_query->get_posts();
foreach ($my_query as $keys => $values) {
	$sub_gruoup_domain[$keys] = $values->ID;
	$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
}

?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center;">
						Student Academic Records - <?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
					</h4>
				</div>
			</div>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div id="printableArea" style="position: relative; height: 70vh; overflow-y: scroll;">
							<div class="ilk_sayfa">
								<img style="width: 100vw; height:100vh; " src="<?php echo get_template_directory_uri(); ?>/images/tr/5-10-sayfa1.png" alt="5-10 Giris Resmi">
								<div class="ilk_sayfa_isimlar">
									<h3 class="font_gbook"><?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?></h3>
									<h3 class="font_gbook"><?php echo get_the_title($group); ?></h3>
									<h3 class="font_gbook"><?php echo get_field('school_no', 'user_'.$student); ?></h3>
									<h3 class="font_gbook">2023/2024</h3>
								</div>
							</div>
							<div class="ikinci_sayfa">
								<img style="width: 100vw; height:100vh;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa2.jpg" alt="5-10 Giris Resmi">
								<div class="sayfalar_ust_isim">
									<h5 style="color: #818285;" class="font_gl">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
									</h5>
									<h5 style="color: #818285;" class="font_gl">
										<?php echo get_field('school_no', 'user_'.$student); ?>
									</h5>
								</div>
							</div>
							<div class="ucuncu_sayfa">
								<div class="sayfalar_ust_isim">
									<h5 style="color: #818285;" class="font_gl">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
									</h5>
									<h5 style="color: #818285;" class="font_gl">
										<?php echo get_field('school_no', 'user_'.$student); ?>
									</h5>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 9%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa3-1.jpg" alt="5-10 Giris Resmi">
								<div class="ucuncu_sayfa_table_header font_gb">
									<div class="font_gb dis_flex" style="width: 50%; color: #fff; font-weight: bold;">
										COURSES
									</div>
									<div style="width: 25%; font-weight: bold;">
										<div class="border_table font_gb" style="width: 85.5%; padding: 12px; font-size: 10px; text-align: center;color: #fff;">
											SEMESTER 1
										</div>
										<div style="display: flex;">
											<div class="border_table" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;color: #fff; font-family:'Gotham Bold','Gotham Book',sans-serif;">
												MARK
											</div>
											<div class="border_table" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;color: #fff;font-family:'Gotham Bold','Gotham Book',sans-serif;">
												GRADE
											</div>
										</div>
									</div>
									<div style="width: 25%; font-weight: bold;">
										<div class="border_table font_gb" style="width: 85.5%; padding: 12px; font-size: 10px; text-align: center;color: #fff;">
											SEMESTER 2
										</div>
										<div style="display: flex;">
											<div class="border_table" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;color: #fff; font-family:'Gotham Bold','Gotham Book',sans-serif;">
												MARK
											</div>
											<div class="border_table" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;color: #fff;font-family:'Gotham Bold','Gotham Book',sans-serif;">
												GRADE
											</div>
										</div>
									</div>
								</div>

								<!-- Sayma baslangic yeri -->
								<?php  
								$toplam_credit = 0;
								$credit_not_toplama = 0;
								$ders_isimleri = [];
								$ogrenci_all_marks = [];
								$sayma = 0;
								foreach ($gruoup_subjects as $key => $value) {
									$select_lesson_type = get_field("select_lesson_type",$value->ID);
									$bg_table_name = "student_avarages";
									$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 2 and student_id =".$student."" );
									$sonuclar1 = $wpdb->get_results($query);
									$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 1 and student_id =".$student."" );
									$sonuclar2 = $wpdb->get_results($query);
									$student_curv_point = $sonuclar1[0]->stundent_curve;
									if (!empty($sonuclar2[0]->stundent_curve)) {
										$student_curv_point = ($sonuclar2[0]->stundent_curve + $sonuclar1[0]->stundent_curve)/2;
									}		

									$rakam_karsiligi = "N/A";
									$subject_credit = get_credit($group,$value->ID)[0]->credit;
									if ($student_curv_point != 0) {
										$toplam_credit = $toplam_credit + $subject_credit;
									}
									if (!empty($student_curv_point)) {
										if ($student_curv_point < 50) {
											$rakam_karsiligi = "E";
										}elseif($student_curv_point < 60 && $student_curv_point > 49){
											$rakam_karsiligi = "D";
										}elseif($student_curv_point < 70 && $student_curv_point > 59){
											$rakam_karsiligi = "C";
										}elseif($student_curv_point < 77 && $student_curv_point > 69){
											$rakam_karsiligi = "C+";
										}elseif($student_curv_point < 86 && $student_curv_point > 76){
											$rakam_karsiligi = "B";
										}elseif($student_curv_point < 90 && $student_curv_point > 85){
											$rakam_karsiligi = "B+";
										}elseif($student_curv_point < 97 && $student_curv_point > 89){
											$rakam_karsiligi = "A";
										}elseif($student_curv_point > 96){
											$rakam_karsiligi = "A+";
										}
									}
									?>
									<div class="ucuncu_sayfa_table_body">
										<div class="not_alanlari" style="display: flex;">
											<div class="dis_flex border_left" style="width: 47.7%; font-weight: 500; font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; justify-content: flex-start; padding-left: 15px; font-size: 13px;">
												<?php 
												echo $ders_isimleri[$sayma] = $select_lesson_type[0]->post_title;
												$sayma = $sayma + 1;
												?>
											</div>
											<div class="dis_flex" style="width: 25%;">
												<div style="display: flex; width: 100%;">
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">
														<?php echo $rakam_karsiligi; ?>
													</div>
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">
														<?php $ogrenci_all_marks[$sayma] = number_format($student_curv_point, 2, '.', ''); 
														echo ceil($ogrenci_all_marks[$sayma]);
														$credit_not_toplama = $credit_not_toplama + ($student_curv_point * $subject_credit)
														?>
													</div>
												</div>
											</div>
											<div class="dis_flex" style="width: 25%;">
												<div style="display: flex; width: 100%;">
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">

													</div>
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">

													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
								}

								foreach ($my_query as $keys => $values) {
									$sub_gruoup_subjects = get_field("subject_for_group",$values->ID);
									$select_lesson_type = get_field("select_lesson_type",$sub_gruoup_subjects[0]->ID);
									$bg_table_name = "student_avarages";
									$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and subjecet_id =".$sub_gruoup_subjects[0]->ID." and quarter_id = 2 and student_id =".$student."" );
									$sonuclar1 = $wpdb->get_results($query);
									$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and subjecet_id =".$sub_gruoup_subjects[0]->ID." and quarter_id = 1 and student_id =".$student."" );
									$sonuclar2 = $wpdb->get_results($query);
									$student_curv_point = $sonuclar1[0]->stundent_curve;
									if (!empty($sonuclar2[0]->stundent_curve)) {
										$student_curv_point = ($sonuclar2[0]->stundent_curve + $sonuclar1[0]->stundent_curve)/2;
									}


									$rakam_karsiligi = "N/A";
									$subject_credit = get_credit($values->ID,$sub_gruoup_subjects[0]->ID)[0]->credit;
									if ($student_curv_point != 0) {
										$toplam_credit = $toplam_credit + $subject_credit;
									}
									if (!empty($student_curv_point)) {
										if ($student_curv_point < 50) {
											$rakam_karsiligi = "E";
										}elseif($student_curv_point < 60 && $student_curv_point > 49){
											$rakam_karsiligi = "D";
										}elseif($student_curv_point < 70 && $student_curv_point > 59){
											$rakam_karsiligi = "C";
										}elseif($student_curv_point < 77 && $student_curv_point > 69){
											$rakam_karsiligi = "C+";
										}elseif($student_curv_point < 86 && $student_curv_point > 76){
											$rakam_karsiligi = "B";
										}elseif($student_curv_point < 90 && $student_curv_point > 85){
											$rakam_karsiligi = "B+";
										}elseif($student_curv_point < 97 && $student_curv_point > 89){
											$rakam_karsiligi = "A";
										}elseif($student_curv_point > 96){
											$rakam_karsiligi = "A+";
										}
									}
									?>
									<div class="ucuncu_sayfa_table_body">
										<div class="not_alanlari" style="display: flex;">
											<div class="dis_flex border_left" style="width: 47.7%; font-weight: 500; font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; justify-content: flex-start; padding-left: 15px; font-size: 13px;">
												<?php 
												echo $ders_isimleri[$sayma] = $select_lesson_type[0]->post_title;
												$sayma = $sayma + 1;
												?>
											</div>
											<div class="dis_flex" style="width: 25%;">
												<div style="display: flex; width: 100%;">
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">
														<?php echo $rakam_karsiligi; ?>
													</div>
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">
														<?php $ogrenci_all_marks[$sayma] = number_format($student_curv_point, 2, '.', ''); 
														echo ceil($ogrenci_all_marks[$sayma]);
														$credit_not_toplama = $credit_not_toplama + ($student_curv_point * $subject_credit)
														?>
													</div>
												</div>
											</div>
											<div class="dis_flex" style="width: 25%;">
												<div style="display: flex; width: 100%;">
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">

													</div>
													<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Bold','Gotham Book',sans-serif; min-height: 12px; font-weight: bold;">

													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
								}
								?>
								<div class="ucuncu_sayfa_table_footer">
									<div class="not_alanlari" style="display: flex; border-bottom: 5px solid #d79a2a !important;">
										<div class="dis_flex border_left font_gb" style="width: 47.7%; background-color: #244b5a !important; color: #fff; font-weight: bold; justify-content: flex-start !important; padding-left: 15px; height: 35px;">
											SEMESTER GRADE POINT AVERAGE
										</div>
										<?php $sonuc_not = ($credit_not_toplama / $toplam_credit); ?>
										<div class="dis_flex" style="width: 25%;">
											<div style="display: flex; width: 100%;">
												<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; background-color: #244b5a !important; color: #fff; font-weight: bold; min-height: 12px; font-weight: bold;">
													<?php  
													if ($sonuc_not < 50) {
														$rakam_karsiligi = "E";
													}elseif($sonuc_not < 60 && $sonuc_not > 49){
														$rakam_karsiligi = "D";
													}elseif($sonuc_not < 70 && $sonuc_not > 59){
														$rakam_karsiligi = "C";
													}elseif($sonuc_not < 77 && $sonuc_not > 69){
														$rakam_karsiligi = "C+";
													}elseif($sonuc_not < 86 && $sonuc_not > 76){
														$rakam_karsiligi = "B";
													}elseif($sonuc_not < 90 && $sonuc_not > 85){
														$rakam_karsiligi = "B+";
													}elseif($sonuc_not < 97 && $sonuc_not > 89){
														$rakam_karsiligi = "A";
													}elseif($sonuc_not > 96){
														$rakam_karsiligi = "A+";
													}
													echo $rakam_karsiligi;
													?>
												</div>
												<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; background-color: #244b5a !important; color: #fff; font-weight: bold; min-height: 12px; font-weight: bold;">
													<?php echo ceil(number_format($sonuc_not, 2, '.', '')); ?>
												</div>
											</div>
										</div>
										<div class="dis_flex" style="width: 25%;">
											<div style="display: flex; width: 100%;">
												<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; background-color: #244b5a !important; color: #fff; font-weight: bold; min-height: 12px; font-weight: bold;">
													
												</div>
												<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; background-color: #244b5a !important; color: #fff; font-weight: bold; min-height: 12px; font-weight: bold;">
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="ucuncu_sayfa_table_footer" style="margin-top: 6px;">
									<div class="not_alanlari" style="display: flex; border: initial !important; align-items: end; min-height: initial; height: initial; flex-direction: column;">
										<h4 style="font-family:'Gotham Bold','Gotham Book',sans-serif; color: #a41f36 !important; font-weight: 800; padding-right: 17px; margin-top: 3px; font-size: 13px; margin-bottom: 10px;">
											CUMMULATIVE GPA
										</h4>
										<div class="dis_flex" style="width: 25%;">
											<div style="display: flex; width: 100%;">
												<div class="border_left font_gb" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center; background-color: #244b5a !important; color: #fff; min-height: 12px; font-weight: 800; border: 1px solid #d79a2a !important;">
													
												</div>
												<div class="border_left" style="width: 50%; text-align: center; padding: 12px; font-size: 10px; text-align: center;font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif; background-color: #244b5a !important; color: #fff; font-weight: bold; min-height: 12px; font-weight: bold; border: 1px solid #d79a2a !important;">
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 3%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa3-2.jpg" alt="5-10 Giris Resmi">
								<!-- grafik alani baslangic -->
								<div class="grid grid-cols-1 xl:grid-cols-12 gap-5" style="width: 95.5%; margin-left: 3.5%;">
									<div class="col-span-6">
										<div id="student_report" data-colors='["#d69929", "#244b5a"]' class="apex-charts w-full" dir="ltr"></div>
									</div>
								</div>
								<!-- grafik alani bitis -->
								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3-footer.png" alt="5-10 Giris Resmi">


							</div>
							<div class="dorduncu_sayfa">
								<div class="sayfalar_ust_isim">
									<h5 style="color: #818285;" class="font_gl">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
									</h5>
									<h5 style="color: #818285;" class="font_gl">
										<?php echo get_field('school_no', 'user_'.$student); ?>
									</h5>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 7%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-1.jpg" alt="5-10 Giris Resmi">
								<div class="pdp_alani">
									<div style="width: 100%; display: flex;">
										<div class="border_table font_gb" style="width: 75%; padding-top: 40px; padding-bottom: 40px; padding-left:10px; font-weight: bold; color: #a41f36 !important; font-size: 20px;">
											Performance Indicators
										</div>
										<div class="border_table" style="width: 5%;">
											<p style="transform: rotate(-90deg) translateX(-55px); color: #244b5a; font-family:'Gotham Bold','Gotham Book',sans-serif; font-weight: bold; font-size: 12px;">
												Consistently
											</p>
										</div>
										<div class="border_table" style="width: 5%;">
											<p style="transform: rotate(-90deg) translateX(-55px); color: #244b5a; font-family:'Gotham Bold','Gotham Book',sans-serif; font-weight: bold; font-size: 12px;">
												Often
											</p>
										</div>
										<div class="border_table" style="width: 5%;">
											<p style="transform: rotate(-90deg) translateX(-55px); color: #244b5a; font-family:'Gotham Bold','Gotham Book',sans-serif; font-weight: bold; font-size: 12px;">
												Sometimes
											</p>
										</div>
										<div class="border_table" style="width: 5%;">
											<p style="transform: rotate(-90deg) translateX(-55px); color: #244b5a; font-family:'Gotham Bold','Gotham Book',sans-serif; font-weight: bold; font-size: 12px;">
												Seldom
											</p>
										</div>
										<div class="border_table" style="width: 5%;">
											<p style="transform: rotate(-90deg) translateX(-32px) translateY(-22px); color: #244b5a; font-family:'Gotham Bold','Gotham Book',sans-serif; font-weight: bold; font-size: 12px; width: 80px;">
												Not Assessed
											</p>
										</div>
									</div>
									<!-- tekrarlanacak alan baslangic -->
									<?php 
									if(have_rows('pdp_select_comments_q2', $group)): 
										while(have_rows('pdp_select_comments_q2', $group)): 
											the_row(); 
											$sayac_buraya = get_row_index();
											$kaydedilmis = get_pdp_select_comment($group, 2, $student, $sayac_buraya)[0]->comment_number;
											?>
											<div style="width: 100%; display: flex; height: 35px;">
												<div class="border_table font_gbook" style="width: 73%;padding-left:10px; font-weight: bold; color: #244b5a !important; display: flex; align-items: center; font-size: 13px; font-weight: 400;">
													<?php echo get_sub_field('comment'); ?>
												</div>
												<div class="border_table pdp_ic">
													<?php if($kaydedilmis == 1){echo "&#10003;";} ?>
												</div>
												<div class="border_table pdp_ic">
													<?php if($kaydedilmis == 2){echo "&#10003;";} ?>
												</div>
												<div class="border_table pdp_ic">
													<?php if($kaydedilmis == 3){echo "&#10003;";} ?>
												</div>
												<div class="border_table pdp_ic">
													<?php if($kaydedilmis == 4){echo "&#10003;";} ?>
												</div>
												<div class="border_table pdp_ic">
													<?php if($kaydedilmis == 5){echo "&#10003;";} ?>
												</div>
											</div>
											<?php 
										endwhile; 
									endif;
									?>

									<!-- tekrarlanacak alan bitis -->
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 15px;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-2.jpg" alt="5-10 Giris Resmi">
								<div class="advisor_comment" class="font_gl">
									<?php  
									$comment_type = "grade_advisor_comment";
									$comment_control = get_long_comment($group, 2, $student,$comment_type);
									$kontrol = intval($comment_control[0]->comment);

									if(have_rows('grade_advisor_comment_q2', $group)): 
										while(have_rows('grade_advisor_comment_q2', $group)): 
											the_row(); 
											if ($kontrol == get_row_index()) {
												$metin = get_sub_field("comment"); 
												$eski = "[student-name]";
												$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
												echo str_replace($eski, $yeni, $metin);
											}
										endwhile; 
									endif;
									?>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 15px;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-3.jpg" alt="5-10 Giris Resmi">
								<div class="advisor_comment" class="font_gl">
									<?php  
									$comment_type = "pdp_long_comment";
									$comment_control = get_long_comment($group, 2, $student,$comment_type);
									$kontrol = intval($comment_control[0]->comment);

									if(have_rows('pdp_normal_comments_q2', $group)): 
										while(have_rows('pdp_normal_comments_q2', $group)): 
											the_row(); 
											if ($kontrol == get_row_index()) {
												$metin = get_sub_field("comment"); 
												$eski = "[student-name]";
												$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
												echo str_replace($eski, $yeni, $metin);
											}
										endwhile; 
									endif;
									?>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 25px;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-4.jpg" alt="5-10 Giris Resmi">

								<?php  
								$get_attandance = get_attandance($group, 2, $student);
								$toplam_gun = 90;
								$absent_yuzde = number_format((100*$get_attandance[0]->absent)/$toplam_gun);
								$late_yuzde = number_format((100*$get_attandance[0]->late)/$toplam_gun);
								$permitted_yuzde = number_format((100*$get_attandance[0]->permitted)/$toplam_gun);
								$toplam_gun_geldi = number_format($toplam_gun - ($get_attandance[0]->absent + $get_attandance[0]->late + $get_attandance[0]->permitted));
								$geldi_yuzde = number_format((100*$toplam_gun_geldi)/$toplam_gun);

								?>
								<div style="margin-top: 25px; margin-bottom: 25px; width: 50.5%; height: 100px;margin-left: 6%;">
									<div class="attandance_bar">
										<div style="width: <?php echo $geldi_yuzde; ?>%;" class="attanadance_bar_red"></div>
										<div style="width: <?php echo $absent_yuzde; ?>%;" class="attanadance_bar_yellow"></div>
										<div style="width: <?php echo $late_yuzde; ?>%;" class="attanadance_bar_late"></div>
										<div style="width: <?php echo $permitted_yuzde; ?>%;" class="attanadance_bar_blue"></div>
									</div>
									<div class="attandance_aciklama">
										<div class="aciklama">
											<div class="kutu" style="background-color: #a41f36;"></div>
											<div>
												<div style="font-weight: 800; font-family:'Gotham Bold','Gotham Book',sans-serif;">Present <?php echo $geldi_yuzde; ?>%</div>
												<div style="font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;">
													Days <?php echo $toplam_gun_geldi; ?>
												</div>
											</div>
										</div>
										<div class="aciklama">
											<div class="kutu" style="background-color: #eca920;"></div>
											<div>
												<div style="font-weight: 800; font-family:'Gotham Bold','Gotham Book',sans-serif;">Absent <?php echo $absent_yuzde; ?>%</div>
												<div style="font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;">
													Days <?php echo $get_attandance[0]->absent; ?>
												</div>
											</div>
										</div>
										<div class="aciklama">
											<div class="kutu" style="background-color: #244b5a;"></div>
											<div>
												<div style="font-weight: 800; font-family:'Gotham Bold','Gotham Book',sans-serif;">Late <?php echo $late_yuzde; ?>%</div>
												<div style="font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;">
													Days <?php echo $get_attandance[0]->late; ?>
												</div>
											</div>
										</div>
										<div class="aciklama">
											<div class="kutu" style="background-color: #4580c2;"></div>
											<div>
												<div style="font-weight: 800; font-family:'Gotham Bold','Gotham Book',sans-serif;">Permitted <?php echo $permitted_yuzde; ?>%</div>
												<div style="font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;">
													Days <?php echo $get_attandance[0]->permitted; ?>
												</div>
											</div>
										</div>

									</div>
								</div>

								<img style="width: 28%; position: absolute; bottom: 10%; right: 6%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-6.jpg" alt="5-10 Giris Resmi">
								<img style="width: 100%; position: absolute; bottom: 0; left: 0;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-5.jpg" alt="5-10 Giris Resmi">
							</div>
							
							<style>
								@media screen, print{
									.apexcharts-tooltip-y-group{
										display: none;
									}
									.apexcharts-text{
										font-size: 7px !important;
									}
									#SvgjsG1100 text{
										font-size: 10px !important; 
									}
									.kutu{
										width: 15px; height: 15px;
										margin-right: 7px;
									}
									.aciklama{
										display: flex;
										font-size: 11px;
										margin-right: 10px;
									}
									.attandance_aciklama{
										width: 100%;
										display: flex;
										margin-top: 15px;
									}
									.attandance_bar{
										display: flex;
										width: 100%;
									}
									.attandance_bar div{
										height: 40px;
									}
									.attanadance_bar_red{
										background-color: #a41f36;
									}
									.attanadance_bar_yellow{
										background-color: #eca920;
									}
									.attanadance_bar_late{
										background-color: #244b5a;
									}
									.attanadance_bar_blue{
										background-color: #4580c2;
									}
									.advisor_comment{
										padding: 12px; color: #244b5a; min-height: 50px;
										border: 1px solid #d79a2a !important;
										width: 85%; margin-left: 6%;
										font-size: 12px;
										font-weight: 400;
										font-family:'Gotham Book','Gotham Light','Gotham Bold',sans-serif;
										margin-top: 10px;
									}
									.pdp_ic{
										width: 5%;
										display: flex; align-items: center; justify-content: center;
									}
									.pdp_alani{
										width: 88%; margin-left: 6%;
										margin-top: 10px;
									}
									.dorduncu_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.not_alanlari{
										width: 88%; 
										height: 32px; 
										border: 1px solid #d79a2a !important;
										margin-left: 6%;
									}
									.ucuncu_sayfa_table_body{

									}
									.dis_flex{
										display: flex;align-items: center; justify-content: center;
									}
									.border_left{
										border-left: 1px solid #d79a2a !important;
										font-family:'Gotham Bold','Gotham Book',sans-serif;
									}
									.border_table{
										border: 1px solid #d79a2a !important;
									}
									.ucuncu_sayfa_table_header{
										display: flex;
										width: 88%;
										margin-left: 6%;
										margin-top: 20px;
										border: 1px solid #d79a2a !important;
										background-color: #a41f36 !important;
									}
									.ucuncu_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.ikinci_sayfa{
										position: relative;
									}
									.ilk_sayfa{
										position: relative;
									}
									.ilk_sayfa_isimlar{
										position: absolute;
										top: 68.2vh;
										left: 37%;
									}
									.ilk_sayfa_isimlar h3{
										color: #000;
									}
									.sayfalar_ust_isim{
										position: absolute;
										top: 2%;
										right: 6%;
									}
									.sayfalar_ust_isim h5{
										margin: initial;
										text-align: right;

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
							</style>
						</div>

					</div>
					<button style="width: 100% !important;" id="printButton" type="button" class="btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 sm:w-auto sm:text-sm">
						Print
					</button>
				</div>
			</div>
		</div>
	</div>
</div>




<?php get_footer(); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>

<script>
	$(document).ready(function(){
		var columnColors = getChartColorsArray("#student_report");
		var options = {
			chart: {
				height: 300,
				type: 'bar',
				toolbar: {
					show: false,
				}
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '20%',
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 0,
				colors: ['transparent']
			},
			series: [{
				name: 'Semester 1',
				data: [
					<?php  
					foreach ($ogrenci_all_marks as $key => $value) {
						echo "'";
						echo $value;
						echo "',";
					}
					?>
					]
			}, {
				name: 'Semester 2',
				data: [
					
					]
			}],
			colors: columnColors,
			xaxis: {
				categories: [
					<?php  
					foreach ($ders_isimleri as $key => $value) {
						echo "'";
						echo $value;
						echo "',";
					}
					?>
					],
			},
			yaxis: {
				title: {
					text: '',
					style: {
						fontWeight:  '800',
					},
				},
				min: 0,
				max: 100
			},
			grid: {
				borderColor: '#fff',
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

	document.getElementById('printButton').addEventListener('click', function() {
		var printableArea = document.getElementById('printableArea');

		if (printableArea) {
			var printWindow = window.open('', '', 'width=800,height=700');
			printWindow.document.open();
			printWindow.document.write('<html><head><title>Print</title></head><body style="padding-left: 0%; padding-right: 0%; margin:0;">');
			printWindow.document.write(printableArea.innerHTML);
			printWindow.document.close();
			printWindow.print();
			//printWindow.close();
		} else {
			alert('Printable area not found.');
		}
	});




</script>