<?php /* Template Name: KG Only Semester */ ?>
<?php get_header(); ?>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-1.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-2.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-3.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/kg-semster-4.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/kg-semster-5.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-6.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-7.jpg" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-8.jpg" as="image">

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

$quarter_yazisi = "";
if ($quarter == 2) {
	$quarter_yazisi = "1ST SEMESTER";
}elseif($quarter == 4){
	$quarter_yazisi = "ACADEMIC YEAR";
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
						if (!empty($group_users)) {
							foreach ($group_users as $key => $value) {
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

								$book_objective = "book_".get_current_blog_id()."_gradebook";
								$query = $wpdb->prepare("SELECT * from $book_objective where gb_student_id =".$value['ID']."" );
								$genelnotlar = $wpdb->get_results($query);


								$subject_comments = "subject_comments";

								$query = $wpdb->prepare("SELECT * from $subject_comments where quarter_id =".$quarter." and student_id =".$value['ID']."" );
								$subject_com = $wpdb->get_results($query);


								?>
								<!-- 1. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-1.jpg" />
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
									</div>
								</div>
								<!-- 2. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-2.jpg" />
									<div class="sayfa_3_top font_gb">
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
									</div>
								</div>
								<!-- 3. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-3.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
									</div>
									<div class="primary_subject english_subject">
										<div class="english_subject_title">
											ENGLISH
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "ENGLISH") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject turkish_subject">
										<div class="english_subject_title">
											TURKISH
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "TURKISH") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject arabic_subject">
										<div class="english_subject_title">
											ARABIC / FRENCH
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "ARABIC" || get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "FRENCH") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
								</div>

								<!-- 4. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-semster-4.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
									</div>
									<div class="primary_subject english_subject">
										<div class="english_subject_title">
											MATHEMATICS
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "MATH") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject turkish_subject">
										<div class="english_subject_title">
											SCIENCE
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "SCIENCE") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject arabic_subject">
										<div class="english_subject_title">
											ROBOTICS
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "ROBOTICS") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en_2">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
								</div>
								<!-- 5. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-semster-5.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
									</div>
									<div class="primary_subject english_subject">
										<div class="english_subject_title">
											ISLAMIC STUDIES / MORAL EDUCATION
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "ISLAMIC" || get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "Moral") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment" && get_sub_field("domain_name") != "Literacy") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en_2">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject social_subject">
										<div class="english_subject_title">
											SOCIAL STUDIES
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "SOCIAL STUDIES ENG") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en_3">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject arabic_subject">
										<div class="english_subject_title">
											COMPUTER SCIENCE
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										$ders_kontrol = 0;
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "COMPUTER SCIENCE") {
												$ders_kontrol = 1;
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en_2">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
											
										}
										if ($ders_kontrol == 0) {
											?>
											<div class="beyaza_boya"></div>
											<?php 
										}
										?>
									</div>
								</div>
								<!-- 6. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-6.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
									</div>
									<div class="primary_subject english_subject">
										<div class="english_subject_title">
											ART
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "ART") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject turkish_subject">
										<div class="english_subject_title">
											PE
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "PE") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en_2">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="primary_subject music_subject">
										<div class="english_subject_title">
											MUSIC
										</div>
										<?php  
										$sum = 0;
										$count = 0;
										$ortalama = [];
										foreach ($sonuclar1 as $subject => $subjectler) {
											if (get_field("select_lesson_type",$subjectler->subjecet_id)[0]->post_title == "MUSIC") {
												if ($subjectler->quarter_id == 1) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 2) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 3) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												if ($subjectler->quarter_id == 4) {
													array_push($ortalama,number_format($subjectler->stundent_curve, 0));
												}
												$sum = array_sum($ortalama);
												$count = count($ortalama);
												$average = $sum / $count;
												if ($subjectler->quarter_id == 4) {
													$gradebook_id = get_field("select_gradebook_definition",$subjectler->subjecet_id);
													if(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_id[0]->ID)): 
															the_row();
															$main_domain = get_row_index();
															if (get_sub_field("domain_name") != "Assessment") {
																?>
																<div class="border_table" style="width: 100%; display: flex;">
																	<?php 
																	$sayma = 0;
																	$sub_domain_percentage = 0;
																	$sub_domain_mark_toplam = 0;
																	if(have_rows('add_sub_domains')): 
																		while(have_rows('add_sub_domains')): 
																			the_row();
																			$sub_domain = get_row_index();
																			$sub_domain_percentage = intval(get_sub_field("based_on"));
																			$sayma = $sayma + 1;

																			foreach ($genelnotlar as $keygen => $valuegen) {
																				if ($valuegen->gb_group_id == $subjectler->group_id && $valuegen->gb_subject_id == $subjectler->subjecet_id && $valuegen->gb_quarter_id == 4 && $valuegen->gb_gradebook_id == $gradebook_id[0]->ID && $valuegen->gb_domain_id == $main_domain &&$valuegen->gb_subdomain_id == $sub_domain && $valuegen->gb_student_id == $value['ID']) {

																					$student_mark = $valuegen->gb_point;

																				}
																			}

																			$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																		endwhile; 
																	endif;
																	$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																	$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																	$sonuc = ($average+$sonuc)/2;
																	?>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc > 89.99) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 90 && $sonuc > 79.99) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 80 && $sonuc > 69.99) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 70 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																	</div>
																	<div class="border_table tik_btn">
																		<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																	</div>
																</div>
																<?php 
															} 
														endwhile; 
													endif;
												}
												?>
												<div class="subject_com_en">
													<?php  
													foreach ($subject_com as $keycom => $valuecom) {
														if ($valuecom->subject_id == $subjectler->subjecet_id) {
															if(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																while(have_rows('add_subject_comment_q'.$quarter, $subjectler->subjecet_id)): 
																	the_row(); 

																	if ($valuecom->comment_order == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}
													}
													?>
												</div>
												<?php 
											}
										}
										?>
									</div>

								</div>
								<!-- 7. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-7.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
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
										<div class="pdp_select_1"style="border: initial !important;">
											<div class="pdp_select_1_title" style="border: initial !important;">
												
											</div>
											<div style="border: initial !important;">
												
											</div>
											<div style="border: initial !important;">
												YES
											</div>
											<div style="border: initial !important;">
												
											</div>
											<div style="border: initial !important;">
												NO
											</div>
										</div>
										<div class="pdp_select_1">
											<div class="pdp_select_1_title" style="border-top: 1px solid #efb62a;">
												Parent/Guardian interview recommended
											</div>
											<div style="border: initial !important;">
												
											</div>
											<div style="border-top: 1px solid #efb62a; border-left: 1px solid #efb62a;">

											</div>
											<div style="border: initial !important;">
												
											</div>
											<div style="border-top: 1px solid #efb62a; border-left: 1px solid #efb62a;">

											</div>
										</div>
									</div>
								</div>

								<!-- 8. sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/primary-semster-8.jpg" />
									<div class="sayfa_3_top_2 font_gb">
										<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, <?php echo get_the_title($class); ?>
										<br>
										<?php echo $quarter_yazisi; ?>, <?php echo $school_year; ?> Student Report
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
								<?php 
							}
						}
						?>
						<style>
							@media screen, print{
								.beyaza_boya{
									width: 700px;
									height: 300px;
									background-color: #fff;
									position: absolute;
									top: -97px;
									left: -509px;
								}
								.social_subject{
									top: 500px;
									right: 51px;
									width: 188px;
								}
								.music_subject{
									top: 825px;
									right: 51px;
									width: 188px;
								}
								.arabic_subject{
									top: 851px;
									right: 51px;
									width: 188px;
								}
								.turkish_subject{
									top: 527px;
									right: 51px;
									width: 188px;
								}
								.english_subject{
									top: 203px;
									right: 52px;
									width: 186px;
								}
								.subject_com_en_3{
									position: absolute;
									left: -507px;
									top: 137px;
									font-size: 13px;
									width: 673px;
									padding: 10px;
								}
								.subject_com_en_2{
									position: absolute;
									left: -507px;
									top: 84px;
									font-size: 13px;
									width: 673px;
									padding: 10px;
								}
								.subject_com_en{
									position: absolute;
									left: -507px;
									top: 110px;
									font-size: 13px;
									width: 673px;
									padding: 10px;
								}
								.english_subject_title{
									position: absolute;
									top: -90px;
									left: -498px;
									font-size: 18px;
									font-weight: bold;
									font-family: 'Gotham Bold', 'Gotham Bold', 'Gotham Bold', sans-serif;
									color: #9f022d;
								}
								.tik_btn{
									width: 37px;
									height: 26.5px;
								}
								.renkli_kutu_kirmizi{
									width: 100%;
									height: 100%;
									background-color: #f60002;
								}
								.renkli_kutu_turuncu{
									width: 100%;
									height: 100%;
									background-color: #f46304;
								}
								.renkli_kutu_sari{
									width: 100%;
									height: 100%;
									background-color: #eca920;
								}
								.renkli_kutu_yesil{
									width: 100%;
									height: 100%;
									background-color: #008140;
								}
								.renkli_kutu_mavi{
									width: 100%;
									height: 100%;
									background-color: #4580c2;
								}
								.kutu{
									width: 15px; height: 15px;
									margin-right: 7px;
								}
								
								.primary_subject{
									position: absolute;
								}
								.attandance_alt{
									width: 697px; height: 60px;
								}
								.kutu{
									width: 15px; height: 15px;
									margin-right: 7px;
								}
								.aciklama{
									display: flex;
									font-size: 13px;
									margin-right: 10px;
								}
								.attandance_aciklama{
									width: 100%;
									display: flex;
									margin-top: 15px;
									justify-content: space-around;
								}
								.attandance{
									position: absolute;
									bottom: 430px;
									left: 48px;
								}
								.attandance_bar{
									display: flex;
									width: 100%;
								}
								.attandance_bar div{
									height: 60px;
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
									top: 403px;
									left: 49px;
									font-size: 15px;
									width: 674px;
									padding: 10px;
								}
								.grade_advisor_comment{
									position: absolute;
									top: 155px;
									left: 49px;
									font-size: 14px;
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
									width: 17px;
									text-align: center;
									padding-top: 20px;
									padding-bottom: 20px;
								}
								.pdp_select_1_title{
									width: 485px !important;
									text-align: left !important;
								}
								.pdp_select_table{
									position: absolute;
									top: 252px;
									left: 48px;
								}
								.sayfa_3_top_2{
									position: absolute;
									top: 3%;
									right: 6%;
									font-size: 11px;
									font-weight: bold;
									color: #878787;
									text-align: right;
									line-height: 1.5;
								}
								.sayfa_3_top{
									position: absolute;
									top: 4%;
									right: 7%;
									font-size: 11px;
									font-weight: bold;
									color: #878787;
									text-align: right;
								}
								.stundet_info_1{
									margin: auto;
									font-size: 12px;
									padding-left: 305px;
								}
								.stundet_info_1 div{
									margin-bottom: 22px;
								}
								.stundet_info{
									position: absolute;
									top: 82.5%;
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
	.beyaza_boya{
		width: 1100px;
		height: 485px;
		background-color: #fff;
		position: absolute;
		top: -153px;
		left: -796px;
	}
	.english_subject_title{
		position: absolute;
		top: -143px;
		left: -780px;
		font-size: 24px;
		font-weight: bold;
		font-family:'Gotham Bold','Gotham Bold','Gotham Bold',sans-serif;
		color: #9f022d;
	}
	.music_subject{
		top: 1286px;
		right: 77px;
		width: 296px;
	}
	.arabic_subject{
		top: 1327px;
		right: 77px;
		width: 296px;
	}
	.social_subject{
		top: 780px;
		right: 77px;
		width: 296px;
	}
	.turkish_subject{
		top: 821px;
		right: 77px;
		width: 296px;
	}
	.subject_com_en_3{
		position: absolute;
		left: -789px;
		top: 213px;
		font-size: 20px;
		width: 1083px;
		padding: 10px;
	}
	.subject_com_en_2{
		position: absolute;
		left: -789px;
		top: 131px;
		font-size: 20px;
		width: 1083px;
		padding: 10px;
	}
	.subject_com_en{
		position: absolute;
		left: -789px;
		top: 172px;
		font-size: 20px;
		width: 1083px;
		padding: 10px;
	}
	.tik_btn{
		width: 60px;
		height: 41.5px;
	}
	.english_subject{
		top: 316px;
		right: 77px;
		width: 296px;
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
		width: 1086px; height: 100px;
	}
	.attandance_aciklama{
		width: 100%;
		display: flex;
		margin-top: 15px;
	}
	.attandance{
		position: absolute;
		bottom: 620px;
		left: 77px;
	}
	.attandance_bar{
		display: flex;
		width: 100%;
	}
	.attandance_bar div{
		height: 60px;
	}
	.grade_advisor_comment{
		position: absolute;
		top: 240px;
		left: 76px;
		font-size: 20px;
		width: 1084px;
		padding: 10px;
	}
	.pdp_comment_long{
		position: absolute;
		top: 626px;
		left: 76px;
		font-size: 20px;
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
		padding-top: 20px;
		padding-bottom: 20px;
	}
	.pdp_select_table{
		position: absolute;
		top: 393px;
		left: 75px;
	}
	.sayfa_3_top_2{
		position: absolute;
		top: 3%;
		right: 6.4%;
		font-size: 13px;
		font-weight: bold;
		color: #878787;
		text-align: right;
	}
	.sayfa_3_top{
		position: absolute;
		top: 4%;
		right: 7%;
		font-size: 13px;
		font-weight: bold;
		color: #878787;
		text-align: right;
	}
	.stundet_info_1{
		margin: auto;
		font-size: 22px;
		padding-left: 475px;
	}
	.stundet_info_1 div{
		margin-bottom: 20px;
	}
</style>


<?php get_footer(); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>

<script>
	function printContent() {
		var printWindow = window.open('', '', 'width=806,height=877'); 
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