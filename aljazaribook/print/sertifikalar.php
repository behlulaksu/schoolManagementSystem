<?php /* Template Name: Sertifikalar */ ?>
<?php get_header(); ?>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/11-12-semester-1.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/5-10-semester-2.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/11-12-semester-3.jpg" as="image">


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
$quarter = 4;


$quarter_yazisi = "";
if ($quarter == 2) {
	$quarter_yazisi = "1ST SEMESTER";
}elseif($quarter == 4){
	$quarter_yazisi = "End Of Year";
}

$blog_id = get_current_blog_id();
$school_year = "2023-24";
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

			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div id="printArea" class="card dark:bg-zinc-800 dark:border-zinc-600">
						<?php $group_users = get_field("group_users",$class); ?>
						<?php 
						$student_notlari_genel = [];
						$ogrenci_ders_isimleri = [];



						if (!empty($group_users)) {
							foreach ($group_users as $key => $value) {
								$bg_table_name = "final_project";
								global $wpdb;
								$query = $wpdb->prepare("SELECT * from $bg_table_name where blog_id =".$blog_id." and did_project = 1 and student_id =".$value['ID']."" );
								$project_control = $wpdb->get_results($query);

								$kredi_sayar = 0;
								$kredili_notlar = 0;
								$kredili_notlar_2 = 0;
								$get_user_data = get_user_meta($value['ID']);

								$bg_table_name = "student_avarages";
								$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and student_id =".$value['ID']."" );
								$sonuclar1 = $wpdb->get_results($query);


								$student_comments = "pdp_section_comments";
								$query = $wpdb->prepare("SELECT * from $student_comments where blog_id =".$blog_id." and class_id =".$class." and quarter_id =".$quarter."" );
								$select_comments_all = $wpdb->get_results($query);


								$student_comments = "long_countent_comments";
								$comment_type = "grade_advisor_comment";
								$query = $wpdb->prepare("SELECT * from $student_comments where blog_id =".$blog_id." and class_id =".$class." and quarter_id =".$quarter." and comment_type = '".$comment_type."'" );
								$grade_advisor_yorumlar = $wpdb->get_results($query);

								$comment_type = "pdp_long_comment";
								$student_comments = "long_countent_comments";
								$query = $wpdb->prepare("SELECT * from $student_comments where blog_id =".$blog_id." and class_id =".$class." and quarter_id =".$quarter." and comment_type = '".$comment_type."'" );
								$pdp_long_comment = $wpdb->get_results($query);

								?>
								<!-- Sayfa 1 -->
								<div class="card_div" style="display: none;">
									<div class="stundet_info font_gb">
										<div class="stundet_info_1">
											<div>
												<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
											</div>
											<div>
												<?php echo get_the_title($class); ?>
											</div>
											<div>
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
											<div>
												<?php echo $school_year; ?>
											</div>
										</div>
										<div class="student_info_2 font_gb">
											<div>
												<?php echo $school_year; ?>
											</div>
											<div>
												<?php echo $quarter_yazisi; ?>
											</div>
										</div>
									</div>
								</div>
								<!-- Sayfa 2 -->
								<div class="card_div" style="display: none;">
									<div class="sayfalar_ust_isim">
										<h5 style="color: #818285;" class="font_gl">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</h5>
										<h5 style="color: #818285;" class="font_gl">
											<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
										</h5>
									</div>
								</div>
								<!-- Sayfa 3 -->
								<div class="card_div" style="display: none;">
									
									
									<div class="subject_list">
										<?php 
										$basiliabilir = [];
										$sort_subjecets = [];
										foreach ($sonuclar1 as $subjectkon => $subjectlerkon) {
											if ($subjectlerkon->quarter_id == 4) {
												$sort_subjecets[] = $subjectlerkon->subjecet_id;
											}
											if ($subjectlerkon->stundent_curve == 0) {
												$basiliabilir[$subjectlerkon->subjecet_id] = 0;
											}else{
												$basiliabilir[$subjectlerkon->subjecet_id] = 1;
											}
										}
										$unique_subject_ids = array_unique($sort_subjecets);
										sort($unique_subject_ids);
										$ogrenci_ders_isimleri[] = $unique_subject_ids;

										foreach ($unique_subject_ids as $key_subject => $subject_id) {
											if ($basiliabilir[$subject_id] != 0) {

												$project_curve = 0;
												foreach ($project_control as $keypro => $valuepro) {
													if ($valuepro->subject_id == $subject_id) {
														$project_curve = 1;
													}
												}
												?>
												<div class="tek_subject font_gb">
													<div class="subject_title">
														<?php echo get_field("select_lesson_type",$subject_id)[0]->post_title; ?>
														<?php  
														if ($basiliabilir == 0) {
															
														}
														?>
													</div>
													<div class="semester_1">
														<div class="subject_grade">
															<?php 
															$su_anki_credi = 0;
															foreach ($sonuclar1 as $keys => $values) {
																if ($values->quarter_id == 1 && $values->subjecet_id == $subject_id) {
																	$student_notlari_genel[$key][$key_subject][1] = number_format($values->stundent_curve, 1);
																}
															}
															foreach ($sonuclar1 as $keys => $values) {
																if ($values->quarter_id == 2 && $values->subjecet_id == $subject_id) {
																	$student_notlari_genel[$key][$key_subject][2] = number_format($values->stundent_curve, 1);
																	$su_anki_credi = get_credit($values->group_id,$values->subjecet_id)[0]->credit;
																	$kredi_sayar = $kredi_sayar + $su_anki_credi;
																}
															}

															if (empty($student_notlari_genel[$key][$key_subject][1])) {
																$student_notlari_genel[$key][$key_subject][1] = $student_notlari_genel[$key][$key_subject][2];
															}

															if ($project_curve == 1) {
																$islem = (($student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2])/2*70/100)+30;
															}else{
																$islem = (($student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2])/2);
															}
															echo $student_curv_point = number_format($islem, 1);

															$kredili_notlar = $kredili_notlar + ($student_curv_point*$su_anki_credi);
															?>
														</div>
														<div class="subject_mark">
															<?php  
															$rakam_karsiligi = "N/A";
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
															echo $rakam_karsiligi;
															?>
														</div>
													</div>
													<div class="semester_2">
														<div class="subject_grade">
															<?php 
															if ($quarter == 4) {

																foreach ($sonuclar1 as $keys => $values) {
																	if ($values->quarter_id == 3 && $values->subjecet_id == $subject_id) {
																		$student_notlari_genel[$key][$key_subject][3] = number_format($values->stundent_curve, 1);
																	}
																}
																foreach ($sonuclar1 as $keys => $values) {
																	if ($values->quarter_id == 4 && $values->subjecet_id == $subject_id) {
																		$student_notlari_genel[$key][$key_subject][4] = number_format($values->stundent_curve, 1);
																		$su_anki_credi = get_credit($values->group_id,$values->subjecet_id)[0]->credit;
																	}
																}

																if (empty($student_notlari_genel[$key][$key_subject][3])) {
																	$student_notlari_genel[$key][$key_subject][3] = $student_notlari_genel[$key][$key_subject][4];
																}

																if ($project_curve == 1) {
																	$islem2 = (($student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4])/2*70/100)+30;
																}else{
																	$islem2 = (($student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4])/2);
																}
																echo $student_curv_point = number_format($islem2, 1);
																$kredili_notlar_2 = $kredili_notlar_2 + ($student_curv_point*$su_anki_credi);
															}
															?>
														</div>
														<div class="subject_mark">
															<?php  
															if ($quarter == 4) {

																$rakam_karsiligi = "N/A";
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
																echo $rakam_karsiligi;
															}
															?>
														</div>
													</div>
													<div class="sene_sonu">
														<div class="subject_grade">
															<?php  
															if ($quarter == 4) {
																if ($project_curve == 1) {
																	$final_not = ($islem2+$islem)*2;
																}else{
																	$final_not = $student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2] + $student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4];
																}
																echo $final_not = number_format(($final_not/4),1);

															}
															?>
														</div>
														
													</div>
												</div>
												<?php 	
											}
											
										}
										?>
										<div class="tek_subject" style="margin-top: 50px; border-top: 2px #eda301 solid;">
											<div class="subject_title" style="background-color: #244b5a; color: #fff; font-weight: bold;">
												GRADE POINT AVERAGE* (GPA)
											</div>
											<div class="semester_1">
												<div class="subject_grade">
													<?php  
													$semester_gpa = 0;
													echo $semester_gpa = number_format(($kredili_notlar/$kredi_sayar),1);
													$student_curv_point = $semester_gpa;
													?>
												</div>
												
											</div>
											<div class="semester_2">
												<div class="subject_grade">
													<?php  
													if ($quarter == 4) {
														$semester_gpa_2 = 0;
														echo $semester_gpa_2 = number_format(($kredili_notlar_2/$kredi_sayar),1);
														$student_curv_point = $semester_gpa_2;
													}
													?>
												</div>

											</div>
											<div class="sene_sonu" style="background-color: #244b5a; color: #fff; font-weight: bold;">
												<div class="subject_grade">
													<?php  
													if ($quarter == 4) {
														echo $student_curv_point = ($semester_gpa + $semester_gpa_2)/2;
													}
													?>
												</div>

											</div>
										</div>
									</div>
									
								</div>



								<div class="card_div" style="display: none;">
									<div class="sayfalar_ust_isim">
										<h5 style="color: #818285;" class="font_gl">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</h5>
										<h5 style="color: #818285;" class="font_gl">
											<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
										</h5>
									</div>
									<div class="pdp_select_table">
										<?php 
										if(have_rows('pdp_select_comments_q'.$quarter, $class)): 
											while(have_rows('pdp_select_comments_q'.$quarter, $class)): 
												the_row(); 
												$sayac_buraya = get_row_index();
												?>
												<div class="pdp_select_1">
													<div class="pdp_select_1_title ">
														<?php echo get_sub_field('comment'); ?>
													</div>
													<div>
														<?php  
														foreach ($select_comments_all as $keycom => $valuecom) {
															if ($valuecom->student_id == $value['ID'] && $valuecom->comment_order == $sayac_buraya && $valuecom->comment_number == 1) {
																echo "&#10003;";
															}
														}
														?>
													</div>
													<div>
														<?php  
														foreach ($select_comments_all as $keycom => $valuecom) {
															if ($valuecom->student_id == $value['ID'] && $valuecom->comment_order == $sayac_buraya && $valuecom->comment_number == 2) {
																echo "&#10003;";
															}
														}
														?>
													</div>
													<div>
														<?php  
														foreach ($select_comments_all as $keycom => $valuecom) {
															if ($valuecom->student_id == $value['ID'] && $valuecom->comment_order == $sayac_buraya && $valuecom->comment_number == 3) {
																echo "&#10003;";
															}
														}
														?>
													</div>
													<div>
														<?php  
														foreach ($select_comments_all as $keycom => $valuecom) {
															if ($valuecom->student_id == $value['ID'] && $valuecom->comment_order == $sayac_buraya && $valuecom->comment_number == 4) {
																echo "&#10003;";
															}
														}
														?>
													</div>
													<div>
														<?php  
														foreach ($select_comments_all as $keycom => $valuecom) {
															if ($valuecom->student_id == $value['ID'] && $valuecom->comment_order == $sayac_buraya && $valuecom->comment_number == 5) {
																echo "&#10003;";
															}
														}
														?>
													</div>

												</div>
												<?php 
											endwhile; 
										endif;
										?>
									</div>
									<div class="grade_advisor_comment">
										<?php  
										$kontrol = "";
										foreach ($grade_advisor_yorumlar as $keygra => $valuegra) {
											if ($valuegra->student_id == $value['ID']) {
												$kontrol = intval($valuegra->comment);
											}
										}
										if(have_rows('grade_advisor_comment_q'.$quarter, $class)): 
											while(have_rows('grade_advisor_comment_q'.$quarter, $class)): 
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
									<div class="pdp_comment_long">
										<?php
										$kontrol = "";  
										foreach ($pdp_long_comment as $keygra => $valuegra) {
											if ($valuegra->student_id == $value['ID']) {
												$kontrol = intval($valuegra->comment);
											}
										}
										if(have_rows('pdp_normal_comments_q'.$quarter, $class)): 
											while(have_rows('pdp_normal_comments_q'.$quarter, $class)): 
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
									<div class="attandance">
										<?php  
										$get_attandance = get_attandance($class, 2, $value['ID']);
										$toplam_gun = 45 * $quarter;
										$absent_yuzde = number_format((100*$get_attandance[0]->absent)/$toplam_gun);
										$late_yuzde = number_format((100*$get_attandance[0]->late)/$toplam_gun);
										$permitted_yuzde = number_format((100*$get_attandance[0]->permitted)/$toplam_gun);
										$toplam_gun_geldi = number_format($toplam_gun - ($get_attandance[0]->absent + $get_attandance[0]->late + $get_attandance[0]->permitted));
										$geldi_yuzde = number_format((100*$toplam_gun_geldi)/$toplam_gun);

										?>
										<div class="attandance_alt">
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
									</div>
								</div>



								<?php if ($student_curv_point > 94.99): ?>
									<div class="card_div">
										<img style="width: 100%;" src="<?php echo get_template_directory_uri(); ?>/print/img/honor.jpg" alt="5-10 Giris Resmi">
										<div class="ogrenci_ismi font_gb">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</div>
										<div class="zaman">
											<?php echo $quarter_yazisi; ?>
											<?php echo " "; ?>
											<?php echo $school_year; ?>
										</div>
										<div class="grade_yazisi">
											Grade <?php echo get_field('grade', 'user_'.$value['ID']); ?>
										</div>
									</div>
								<?php endif ?>

								<?php if ($student_curv_point > 84.99 && $student_curv_point < 95): ?>
									<div class="card_div">
										<img style="width: 100%;" src="<?php echo get_template_directory_uri(); ?>/print/img/recognition.jpg" alt="5-10 Giris Resmi">
										<div class="ogrenci_ismi font_gb">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</div>
										<div class="zaman">
											<?php echo $quarter_yazisi; ?>
											<?php echo " "; ?>
											<?php echo $school_year; ?>
										</div>
										<div class="grade_yazisi">
											Grade <?php echo get_field('grade', 'user_'.$value['ID']); ?>
										</div>
									</div>
								<?php endif ?>

								<?php if ($student_curv_point > 74.99 && $student_curv_point < 85): ?>
									<div class="card_div">
										<img style="width: 100%;" src="<?php echo get_template_directory_uri(); ?>/print/img/acknowle.jpg" alt="5-10 Giris Resmi">
										<div class="ogrenci_ismi font_gb">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</div>
										<div class="zaman">
											<?php echo $quarter_yazisi; ?>
											<?php echo " "; ?>
											<?php echo $school_year; ?>
										</div>
										<div class="grade_yazisi">
											Grade <?php echo get_field('grade', 'user_'.$value['ID']); ?>
										</div>
									</div>
								<?php endif ?>
								<?php 
							}
						}
						?>



						<style>
							@media screen, print{
								.ogrenci_ismi{
									position: absolute;
									font-size: 50px;
									color: #99073e;
									font-weight: bold;
									top: 347px;
									width: 100%;
									text-align: center;
								}
								.grade_yazisi{
									position: absolute;
									top: 413px;
									left: 692px;
									font-size: 28px;
									color: #fff;
								}
								.zaman{
									position: absolute;
									top: 413px;
									left: 362px;
									font-size: 28px;
									color: #fff;
								}
								.attandance_alt{
									width: 402px; height: 60px;
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
								.attandance{
									position: absolute;
									bottom: 145px;
									left: 48px;
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
								.pdp_comment_long{
									position: absolute;
									top: 767px;
									left: 49px;
									font-size: 12px;
									width: 674px;
									padding: 10px;
								}
								.grade_advisor_comment{
									position: absolute;
									top: 577px;
									left: 49px;
									font-size: 12px;
									width: 674px;
									padding: 10px;
								}
								.pdp_select_1{
									display: flex;
									border-left: 1px solid #efb62a;
								}
								.pdp_select_1 div{
									border-bottom: 1px solid #efb62a;
									border-right: 1px solid #efb62a;
									font-size: 11px;
									padding: 10px;
									padding-top: 8px;
									padding-bottom: 8px;
									width: 17px;
									text-align: center;
								}
								.pdp_select_1_title{
									width: 485px !important;
									text-align: left !important;
								}
								.pdp_select_table{
									position: absolute;
									top: 199px;
									left: 48px;
								}
								.apexcharts-tooltip-title{
									display: none;
								}
								.grafik{
									width: 87.5%; 
									margin-left: 4.5%; 
									position: absolute; 
									bottom: 57px;
								}
								.apexcharts-tooltip-y-group{
									display: none;
								}
								.apexcharts-text{
									font-size: 5px !important;
									/*transform: initial;*/
								}
								#SvgjsG1100 text{
									font-size: 10px !important; 
								}
								.subject_grade{
									width: 50%;
									display: flex;
									align-items: center;
									justify-content: center;
									border-right: 1px #eda301 solid;
								}
								.subject_mark{
									width: 50%;
									display: flex;
									align-items: center;
									justify-content: center;
								}
								.sene_sonu{
									width: 123px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 11px;
									text-align: center;
								}
								.semester_2{
									width: 123px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 11px;
									text-align: center;
								}
								.semester_1{
									width: 123px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 11px;
									text-align: center;
								}
								.tek_subject{
									display: flex;
								}
								.subject_title{
									font-size: 11px;
									padding: 6px;
									padding-bottom: 8px;
									padding-bottom: 8px;
									border-left: 2px #eda301 solid;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									width: 305px;
								}
								.subject_list{
									position: absolute;
									top: 213px;
									left: 49px;
								}
								.sayfa_3_top{
									position: absolute;
									top: 6.4%;
									left: 6%;
									font-size: 18px;
									font-weight: bold;
									color: #9f022d;
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
								.student_info_2{
									margin: auto;
									font-size: 30px;
									font-weight: bold;
									text-align: center;
									color: #d79a2a;
									margin-top: 13%;
								}
								.stundet_info_1{
									margin: auto;
									font-size: 15px;
									padding-left: 290px;
								}
								.stundet_info_1 div{
									margin-bottom: 24px;
								}
								.stundet_info{
									position: absolute;
									top: 70%;
									left: 0;
									width: 100%;
									font-size: 13px;
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
	.grade_yazisi{
		position: absolute;
		top: 451px;
		left: 754px;
		font-size: 28px;
		color: #fff;
	}
	.zaman{
		position: absolute;
		top: 450px;
		left: 392px;
		font-size: 28px;
		color: #fff;
	}
	.ogrenci_ismi{
		position: absolute;
		font-size: 50px;
		color: #99073e;
		font-weight: bold;
		top: 379px;
		width: 100%;
		text-align: center;
	}
	.sayfa_3_top{
		position: absolute;
		top: 6%;
		left: 6%;
		font-size: 28px;
		font-weight: bold;
		color: #9f022d;
	}
	.attandance_alt{
		width: 625px; height: 100px;
	}
	.attandance_aciklama{
		width: 100%;
		display: flex;
		margin-top: 15px;
	}
	.attandance{
		position: absolute;
		bottom: 200px;
		left: 77px;
	}
	.attandance_bar{
		display: flex;
		width: 100%;
	}
	.attandance_bar div{
		height: 40px;
	}
	.grade_advisor_comment{
		position: absolute;
		top: 900px;
		left: 76px;
		font-size: 15px;
		width: 1084px;
		padding: 10px;
	}
	.pdp_comment_long{
		position: absolute;
		top: 1196px;
		left: 76px;
		font-size: 15px;
		width: 1084px;
		padding: 10px;
	}
	.pdp_select_1_title{
		width: 790px !important;
		text-align: left !important;
	}
	.pdp_select_1 div{
		border-bottom: 1px solid #efb62a;
		border-right: 1px solid #efb62a;
		font-size: 18px;
		padding: 10px;
		width: 59px;
		text-align: center;
	}
	.pdp_select_table{
		position: absolute;
		top: 311px;
		left: 75px;
	}
	.grafik{
		width: 87.5%; 
		margin-left: 6.5%; 
		position: absolute; 
		bottom: 113px;
	}
	.sene_sonu{
		width: 198px;
	}
	.subject_list2 .sene_sonu{
		width: 198px;
	}
	.semester_2{
		width: 195px;
	}
	.subject_list2 .semester_2{
		width: 195px;
	}
	.semester_1 {
		width: 198px;
	}
	.subject_list2 .semester_1{
		width: 198px;
	}
	.subject_title{
		font-size: 17px;
		padding: 10px;
		border-left: 2px #eda301 solid;
		border-bottom: 2px #eda301 solid;
		border-right: 2px #eda301 solid;
		width: 497px;
	}
	.subject_list{
		position: absolute;
		top: 275px;
		left: 76px;
	}
	.subject_list2{
		position: absolute;
		top: 760px;
		left: 76px;
	}
	.student_info_2{
		margin: auto;
		font-size: 38px;
		font-weight: bold;
		text-align: center;
		color: #d79a2a;
		margin-top: 16%;
	}
	.subject_list2 .subject_title{
		width: 500px;
	} 
	.stundet_info_1{
		margin: auto;
		font-size: 22px;
		padding-left: 450px;
	}
	.stundet_info_1 div{
		margin-bottom: 30px;
	}
</style>

<?php get_footer(); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>



<script>


	function printContent() {
		var printWindow = window.open('', '', 'width=1138,height=877'); 
		var printDocument = printWindow.document;
		var printContent = document.getElementById('printArea').innerHTML; 

		printDocument.write('<html><head><title><?php echo get_the_title($class); ?></title>');
		printDocument.write('<link rel="stylesheet" type="text/css" href="styles.css">'); 
		printDocument.write('</head><body style="margin:initial">');
		printDocument.write(printContent);
		printDocument.write('</body></html>');

		printWindow.document.close(); 
		printWindow.print(); 
	}


</script>


