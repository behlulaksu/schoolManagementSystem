<?php /* Template Name: Semester 1 Report KG TR */ ?>
<?php get_header(); ?>


<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa1.png" as="image">
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa2.jpg" as="image">


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
						KG-4 - <?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
					</h4>
				</div>
			</div>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div id="printableArea" style="position: relative; height: 70vh; overflow-y: scroll;">

							<div class="ilk_sayfa">
								<img style="width: 100vw; height:100vh; " src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa1.png" alt="5-10 Giris Resmi">
								<div class="ilk_sayfa_isimlar">
									<h3 class="font_gbook"><?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?></h3>
									<h3 class="font_gbook"><?php echo get_the_title($group); ?></h3>
									<h3 class="font_gbook"><?php echo get_field('school_no', 'user_'.$student); ?></h3>
									<h3 class="font_gbook">2023/2024</h3>
								</div>
							</div>
							<div class="ikinci_sayfa">
								<img style="width: 100vw; height:100vh;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa2.jpg" alt="5-10 Giris Resmi">
							</div>
							<div class="ucuncu_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>

								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "ENGLISH") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													ENGLISH
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "ENGLISH") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															ENGLISH
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
																	<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "TURKISH") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													TURKISH
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "TURKISH") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															TURKISH
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
																	<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "ARABIC") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													ARABIC
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "ARABIC") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															ARABIC
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
																	<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "FRENCH") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													FRENCH
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "FRENCH") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															FRENCH
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
																	<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3-footer.png" alt="5-10 Giris Resmi">
							</div>
							<div class="dorduncu_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "MATH") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													MATHEMATICS
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "MATH") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															MATHEMATICS
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
																	<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
																</div>
																<div class="border_table tik_btn">
																	<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
																</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "SCIENCE") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													SCIENCE
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "SCIENCE") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															SCIENCE
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "ROBOTICS") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													ROBOTICS
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "ROBOTICS") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															ROBOTICS
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa4-footer.png" alt="5-10 Giris Resmi">
							</div>
							<div class="besinci_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "ISLAMIC") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													ISLAMIC STUDIES
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "ISLAMIC") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															ISLAMIC STUDIES
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "Moral") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													MORAL EDUCATION
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "Moral") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															MORAL EDUCATION
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "SOCIAL") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													SOCIAL STUDIES
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "SOCIAL") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															SOCIAL STUDIES
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "COMPUTER SCIENCE") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													COMPUTER SCIENCE
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "COMPUTER SCIENCE") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															COMPUTER SCIENCE
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3-footer.png" alt="5-10 Giris Resmi"> 
							</div>

							<div class="altinci_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "ART") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													ART
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "ART") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															ART
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "PE") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													PE
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "PE") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															PE
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
																<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->
								<!-- kopyalanacak yer baslangic -->
								<?php 
								$subject_id = 0;
								foreach ($gruoup_subjects as $key => $value) {
									if (get_field("select_lesson_type",$value->ID)[0]->post_title === "MUSIC") {
										$subject_id = $value->ID;
									}
								}
								if ($subject_id != 0) {
									?>
									<div class="ders_ust">
										<div class="ders_header">
											<div class="ders_header_left">
												<div class="ders_header_left_title">
													MUSIC
												</div>
												<div class="ders_header_left_ic">
													<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
														Learning Area Achievement
													</h4>
													<div style="display: flex; margin-bottom: 10px;">
														<div class="border_table left_ic_madde font_gbook">Excellent</div>
														<div class="border_table left_ic_madde font_gbook">High</div>
														<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
														<div class="border_table left_ic_madde font_gbook">Limited</div>
														<div class="border_table left_ic_madde font_gbook">Very Low</div>
													</div>
												</div>
											</div>
											<div class="ders_header_right">
												<div><p>Excellent</p></div>
												<div><p>High</p></div>
												<div><p>Satisfactory</p></div>
												<div><p>Limited</p></div>
												<div><p>Very Low</p></div>
											</div>
										</div>
										<?php  
										$gradebook_id = get_field("select_gradebook_definition",$subject_id);
										if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
											while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
												the_row();
												$main_domain = get_row_index();
												if (get_sub_field("domain_name") != "Benchmark") {
													?>
													<div class="border_table" style="width: 100%; display: flex;">
														<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
															<?php echo get_sub_field("domain_name"); ?>
														</div>
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
																$student_mark = get_student_one_point($group,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
															endwhile; 
														endif;
														$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
														$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
														?>
														<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
													</div>
													<?php 
												} 
											endwhile; 
										endif;
										?>
										<div class="border_table" style="width: 100%; display: flex;">
											<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
												Comments:
											</div>
										</div>
										<div class="border_table" style="width: 100%; display: flex;">
											<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
												<?php 
												$subject_comments = "subject_comments";
												$comment_control = get_subject_comment($subject_id, 2, $student);
												$kontrol = intval($comment_control[0]->comment_order);
												if ($kontrol != 0) {
													if(have_rows('add_subject_comment_q2', $subject_id)): 
														while(have_rows('add_subject_comment_q2', $subject_id)): 
															the_row(); 
															if ($kontrol == get_row_index()){
																$metin = get_sub_field("comment"); 
																$eski = "[student-name]";
																$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																echo str_replace($eski, $yeni, $metin);
															} 
														endwhile; 
													endif;
												}else{
													echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
												}

												?>
											</div>
										</div>
									</div>
									<?php 
								}else{
									foreach ($my_query as $keys => $values) {
										$sub_gruoup_subjects[$keys] = get_field("subject_for_group",$values->ID);
										if (get_field("select_lesson_type",$sub_gruoup_subjects[$keys][0]->ID)[0]->post_title === "MUSIC") {
											$subject_id = $sub_gruoup_subjects[$keys][0]->ID;
											?>
											<div class="ders_ust">
												<div class="ders_header">
													<div class="ders_header_left">
														<div class="ders_header_left_title">
															MUSIC
														</div>
														<div class="ders_header_left_ic">
															<h4 style="font-size: 15px; margin-bottom: 7px; margin-top: 10px; font-family:'Gotham Bold','Gotham Book',sans-serif;">
																Learning Area Achievement
															</h4>
															<div style="display: flex; margin-bottom: 10px;">
																<div class="border_table left_ic_madde font_gbook">Excellent</div>
																<div class="border_table left_ic_madde font_gbook">High</div>
																<div class="border_table left_ic_madde font_gbook">Satisfactory</div>
																<div class="border_table left_ic_madde font_gbook">Limited</div>
																<div class="border_table left_ic_madde font_gbook">Very Low</div>
															</div>
														</div>
													</div>
													<div class="ders_header_right">
														<div><p>Excellent</p></div>
														<div><p>High</p></div>
														<div><p>Satisfactory</p></div>
														<div><p>Limited</p></div>
														<div><p>Very Low</p></div>
													</div>
												</div>
												<?php  
												$gradebook_id = get_field("select_gradebook_definition",$subject_id);
												if(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
													while(have_rows('add_quarter_2_domains', $gradebook_id[0]->ID)): 
														the_row();
														$main_domain = get_row_index();
														if (get_sub_field("domain_name") != "Benchmark") {
															?>
															<div class="border_table" style="width: 100%; display: flex;">
																<div class="font12" style="padding: 5px; width: 68.4%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
																	<?php echo get_sub_field("domain_name"); ?>
																</div>
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
																		$student_mark = get_student_one_point($values->ID,$subject_id,2,$gradebook_id[0]->ID,$main_domain,$sub_domain,$student)[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuc = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																?>
															<div class="border_table tik_btn">
															<?php if ($sonuc > 90) { echo "<div class='renkli_kutu_mavi'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 91 && $sonuc > 80) { echo "<div class='renkli_kutu_yesil'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 81 && $sonuc > 70) { echo "<div class='renkli_kutu_sari'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 71 && $sonuc > 60) { echo "<div class='renkli_kutu_turuncu'></div>"; } ?>
														</div>
														<div class="border_table tik_btn">
															<?php if ($sonuc < 61) { echo "<div class='renkli_kutu_kirmizi'></div>"; } ?>
														</div>
															</div>
															<?php 
														} 
													endwhile; 
												endif;
												?>
												<div class="border_table" style="width: 100%; display: flex;">
													<div class="font_gb" style="padding: 5px; width: 100%; font-weight: bold; color: #244b5a !important;">
														Comments:
													</div>
												</div>
												<div class="border_table" style="width: 100%; display: flex;">
													<div style="padding: 10px; width: 100%; font-family:'Gotham Light','Gotham Book','Gotham Bold',sans-serif;">
														<?php 
														$subject_comments = "subject_comments";
														$comment_control = get_subject_comment($subject_id, 2, $student);
														$kontrol = intval($comment_control[0]->comment_order);
														if ($kontrol != 0) {
															if(have_rows('add_subject_comment_q2', $subject_id)): 
																while(have_rows('add_subject_comment_q2', $subject_id)): 
																	the_row(); 
																	if ($kontrol == get_row_index()){
																		$metin = get_sub_field("comment"); 
																		$eski = "[student-name]";
																		$yeni = $get_user_data['first_name'][0]." ".$get_user_data['last_name'][0];
																		echo str_replace($eski, $yeni, $metin);
																	} 
																endwhile; 
															endif;
														}else{
															echo get_student_comment_easy($subject_id,2,$student,'subject_comment')[0]->comment;
														}

														?>
													</div>
												</div>
											</div>
											<?php 
										}

									}
								}
								?>
								<!-- kopyalanan yer bitis -->


								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa4-footer.png" alt="5-10 Giris Resmi">
							</div>

							<div class="pdp_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 3%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-1.jpg" alt="5-10 Giris Resmi">
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
											<div style="width: 100%; display: flex; height: 60px;">
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

									<div style="width: 100%; display: flex; height: 25px; margin-top: 6%; text-align: center;">
										<div class="" style="width: 74%;padding-left:10px; font-weight: bold; color: #244b5a !important; display: flex; align-items: center; font-size: 13px; font-weight: 400;">
											
										</div>
										<div class="font_gb" style="width: 13%;">
											Yes
										</div>
										<div class="font_gb" style="width: 13%;">
											No
										</div>
									</div>
									<div style="width: 100%; display: flex; height: 60px;">
										<div class="border_table font_gbook" style="width: 74%;padding-left:10px; font-weight: bold; color: #244b5a !important; display: flex; align-items: center; font-size: 13px; font-weight: 400;">
											Parent/Guardian interview recommended
										</div>
										<div class="border_table" style="width: 13%;">

										</div>
										<div class="border_table" style="width: 13%;">

										</div>
									</div>
									<!-- tekrarlanacak alan bitis -->
								</div>
								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3-footer.png" alt="5-10 Giris Resmi"> 
							</div>

							<div class="son_sayfa">
								<div style="display: flex;">
									<img style="width: 15vw; margin-left: 6%; margin-top: 3%; margin-right: 10px;" src="<?php echo get_template_directory_uri(); ?>/images/tr/kg-4-sayfa3.png" alt="5-10 Giris Resmi">
									<div class="font_gb" style="width: 77.8vw; height: 60px; margin-top: 3%; background-color: #e7e7e8; display: flex; justify-content: center; align-items: flex-end; padding-right: 6%; flex-direction: column; font-weight: bold;">
										<div style="color: #818285; font-size: 12px;">
											<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>, Grade <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #818285; font-size: 12px;">
											Semester 1, 2023-2024
										</div>
									</div>
								</div>
								<img style="width: 88%; margin-left: 6%; margin-top: 6%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-2.jpg" alt="5-10 Giris Resmi">
								<div style="margin-top: 3%;" class="advisor_comment" class="font_gl">
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
								<img style="width: 88%; margin-left: 6%; margin-top: 6%;" src="<?php echo get_template_directory_uri(); ?>/images/5-10-sayfa4-3.jpg" alt="5-10 Giris Resmi">
								<div style="margin-top: 3%;" class="advisor_comment" class="font_gl">
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
								<img style="width: 100%; margin-top: 6%;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa8-attandance.PNG" alt="5-10 Giris Resmi">
								<?php  
								$get_attandance = get_attandance($group, 2, $student);
								$toplam_gun = 90;
								$absent_yuzde = number_format((100*$get_attandance[0]->absent)/$toplam_gun);
								$late_yuzde = number_format((100*$get_attandance[0]->late)/$toplam_gun);
								$permitted_yuzde = number_format((100*$get_attandance[0]->permitted)/$toplam_gun);
								$toplam_gun_geldi = number_format($toplam_gun - ($get_attandance[0]->absent + $get_attandance[0]->late + $get_attandance[0]->permitted));
								$geldi_yuzde = number_format((100*$toplam_gun_geldi)/$toplam_gun);

								?>
								<div style="margin-top: 25px; margin-bottom: 25px; width: 88%; height: 100px;margin-left: 6%;">
									<div class="attandance_bar">
										<div style="width: <?php echo $geldi_yuzde; ?>%;" class="attanadance_bar_red"></div>
										<div style="width: <?php echo $absent_yuzde; ?>%;" class="attanadance_bar_yellow"></div>
										<div style="width: <?php echo $late_yuzde; ?>%;" class="attanadance_bar_late"></div>
										<div style="width: <?php echo $permitted_yuzde; ?>%;" class="attanadance_bar_blue"></div>
									</div>
									<div class="attandance_aciklama" style="justify-content: space-around;">
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
								<img style="width: 100%; margin-top: 12%;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa8-imza.PNG" alt="5-10 Giris Resmi">


								<img style="width: 100%; position: absolute; bottom: 0; left: 0%;" src="<?php echo get_template_directory_uri(); ?>/images/kg-4-sayfa8-son.PNG" alt="5-10 Giris Resmi">
							</div>


							<style>
								@media screen, print{
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
									.aciklama{
										display: flex;
										font-size: 15px;
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
									.son_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.pdp_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.altinci_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.besinci_sayfa{
										position: relative;
										width: 100vw; height:100vh; max-height: 100vh; min-height: 100vh ;
									}
									.font12{
										font-size: 12px !important;
									}
									.tik_btn{
										width: 40px;
										display: flex;
										align-items: center;
										justify-content: center;
									}
									.ders_header_right{
										width: 30%;
										display: flex;
									}
									.ders_header_right div{
										border: 1px solid #d79a2a !important;
										font-weight: bold;
										color: #244b5a !important;
										text-align: left;
										max-width: 40px;
									}
									.ders_header_right div p{
										width: 100px;
										margin: initial;
										padding: initial;
										text-align: left;
										transform: rotate(-90deg) translateX(-60px) translateY(-30px);
										font-family:'Gotham Bold','Gotham Book',sans-serif;
										font-size: 13px;
										font-weight: bold;
									}
									.ders_header_left_title{
										color: #a41f36 !important; 
										padding: 5px;
										border-right: 1px solid #d79a2a !important;
										font-family:'Gotham Bold','Gotham Book',sans-serif;
										font-size: 18px;
										font-weight: 800;

									}
									.left_ic_madde{
										padding: 10px;
										color: #244b5a;
										min-width: 65px;
										text-align: center;
										font-size: 11px;
									}
									.ders_header_left_ic{
										padding: 5px; 
										border-right: 1px solid #d79a2a !important;
										border-top: 1px solid #d79a2a !important;
										display: flex;
										flex-direction: column;
										align-items: center;
										justify-content: center;
									}
									.ders_header_left{
										width: 70%;
									}
									.ders_header{
										width: 100%;
										display: flex;
										border-top: 1px solid #d79a2a !important;
										border-left: 1px solid #d79a2a !important;
										border-right: 1px solid #d79a2a !important;
									}
									.ders_ust{
										width: 88%; margin-left: 6%; margin-top: 1%;
										border: 1px solid #d79a2a !important;
									}
									.advisor_comment{
										padding: 12px; color: #244b5a; min-height: 50px;
										border: 1px solid #d79a2a !important;
										width: 85%; margin-left: 6%;
										font-size: 15px;
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
										margin-top: 50px;
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
										top: 81.5vh;
										left: 37%;
									}
									.ilk_sayfa_isimlar h3{
										color: #000;
										margin: 12px;
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


<script>
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