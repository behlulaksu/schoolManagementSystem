<?php /* Template Name: KG Quarter */ ?>
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

$pdp_normal_comments = "pdp_normal_comments_q1";
$quarter_domains = "add_quarter_1_domains";
$grade_advisor_comment = "grade_advisor_comment_q1";
if ($quarter == 1) {
	$grade_advisor_comment = "grade_advisor_comment_q1";
	$quarter_domains = "add_quarter_1_domains";
	$pdp_normal_comments = "pdp_normal_comments_q1";

}elseif ($quarter == 2) {
	$grade_advisor_comment = "grade_advisor_comment_q2";
	$quarter_domains = "add_quarter_2_domains";
	$pdp_normal_comments = "pdp_normal_comments_q2";

}elseif ($quarter == 3) {
	$grade_advisor_comment = "grade_advisor_comment_q3";
	$quarter_domains = "add_quarter_3_domains";
	$pdp_normal_comments = "pdp_normal_comments_q3";

}elseif ($quarter == 4) {
	$grade_advisor_comment = "grade_advisor_comment_q4";
	$quarter_domains = "add_quarter_4_domains";
	$pdp_normal_comments = "pdp_normal_comments_q4";

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
								<!-- ilk sayfa -->
								<div class="card_div">
									<img style="width: 100%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-quarter-1.jpg" />
									<div class="quarter_number font_gb">
										<?php echo $quarter; ?>
									</div>
									<div class="stundet_info font_gb">
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
											2023-2024
										</div>
									</div>
								</div>
								<!-- ikinci sayfa -->
								<div class="card_div">
									<img style="width: 99%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-quarter-2.jpg" />
									<div class="page_header font_gb">
										<div style="margin-left: 18%; min-width: 57%;">
											<div>
												<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
											</div>
											<div>
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
										</div>
										<div>
											<div>
												<?php echo get_the_title($class); ?>
											</div>
											<div>
												2023-2024
											</div>
										</div>
									</div>
								</div>
								<!-- ucuncu sayfa -->
								<div class="card_div">
									<img style="width: 99%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-quarter-3.jpg" />
									<div class="page_header font_gb">
										<div style="margin-left: 18%; min-width: 57%;">
											<div>
												<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
											</div>
											<div>
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
										</div>
										<div>
											<div>
												<?php echo get_the_title($class); ?>
											</div>
											<div>
												2023-2024
											</div>
										</div>
									</div>
									<div class="subjects">
										<?php 
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											if ($select_lesson_type[0]->post_title != "ENGLISH" && $select_lesson_type[0]->post_title != "TURKISH" && $select_lesson_type[0]->post_title != "ARABIC" && $select_lesson_type[0]->post_title != "FRENCH") {
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_point font_gb">
														<?php 
														$sonuclar = $values->stundent_curve; 
														$yazilacak_rakam = "";
														if ($sonuclar > 89) {
															$yazilacak_rakam = "A";
														}elseif($sonuclar > 79){
															$yazilacak_rakam = "B+";
														}elseif($sonuclar > 69){
															$yazilacak_rakam = "B";
														}elseif($sonuclar > 59){
															$yazilacak_rakam = "C";
														}elseif($sonuclar > 49){
															$yazilacak_rakam = "C-";
														}else{
															$yazilacak_rakam = "D";
														}
														echo $yazilacak_rakam;
														?>
													</div>
												</div>
											<?php } 
										}

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
											if ($select_lesson_type[0]->post_title != "ENGLISH" && $select_lesson_type[0]->post_title != "TURKISH" && $select_lesson_type[0]->post_title != "ARABIC" && $select_lesson_type[0]->post_title != "FRENCH") {
												?>
												<div class="subject_row">
													<div class="subject_title font_gb">
														<?php echo $select_lesson_type[0]->post_title; ?>
													</div>
													<div class="subject_point font_gb">
														<?php  
														$bg_table_name = "student_avarages";
														$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and quarter_id = ".$quarter." and student_id =".$value['ID']."" );
														$sonuclar1 = $wpdb->get_results($query);
														$sonuclar = $sonuclar1[0]->stundent_curve;
														$yazilacak_rakam = "";
														if ($sonuclar > 89) {
															$yazilacak_rakam = "A";
														}elseif($sonuclar > 79){
															$yazilacak_rakam = "B+";
														}elseif($sonuclar > 69){
															$yazilacak_rakam = "B";
														}elseif($sonuclar > 59){
															$yazilacak_rakam = "C";
														}elseif($sonuclar > 49){
															$yazilacak_rakam = "C-";
														}else{
															$yazilacak_rakam = "D";
														}
														echo $yazilacak_rakam;
														?>
													</div>
												</div>
												<?php 
											}
										}
										?>
									</div>
									<div class="english_subject">
										<?php  
										
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											if ($select_lesson_type[0]->post_title === "ENGLISH") {

												$selected_lesson = get_field("select_gradebook_definition",$values->subjecet_id);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($class,$values->subjecet_id,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
											}
										}
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
											if ($select_lesson_type[0]->post_title === "ENGLISH") {
												
												$selected_lesson = get_field("select_gradebook_definition",$sub_gruoup_subjects[0]->ID);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($values->ID,$sub_gruoup_subjects[0]->ID,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
												
											}
										}
										
										?>
									</div>
									<div class="turkish_subject">
										<?php  
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
											if ($select_lesson_type[0]->post_title === "TURKISH") {
												
												$selected_lesson = get_field("select_gradebook_definition",$sub_gruoup_subjects[0]->ID);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($values->ID,$sub_gruoup_subjects[0]->ID,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
												
											}
										}
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											if ($select_lesson_type[0]->post_title === "TURKISH") {

												$selected_lesson = get_field("select_gradebook_definition",$values->subjecet_id);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($class,$values->subjecet_id,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
											}
										}
										?>
									</div>
								</div>
								<!-- son sayfa -->
								<div class="card_div">
									<img style="width: 99%" src="<?php echo get_template_directory_uri(); ?>/print/img/kg-quarter-4.jpg" />
									<div class="page_header font_gb">
										<div style="margin-left: 18%; min-width: 57%;">
											<div>
												<?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
											</div>
											<div>
												<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
											</div>
										</div>
										<div>
											<div>
												<?php echo get_the_title($class); ?>
											</div>
											<div>
												2023-2024
											</div>
										</div>
									</div>
									<div class="arabic_subject">
										<?php  
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
											if ($select_lesson_type[0]->post_title === "ARABIC" || $select_lesson_type[0]->post_title === "FRENCH") {
												
												$selected_lesson = get_field("select_gradebook_definition",$sub_gruoup_subjects[0]->ID);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($values->ID,$sub_gruoup_subjects[0]->ID,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
												
											}
										}
										foreach ($grouped_students[$value['ID']] as $keys => $values) {
											$select_lesson_type = get_field("select_lesson_type",$values->subjecet_id);
											if ($select_lesson_type[0]->post_title === "ARABIC" || $select_lesson_type[0]->post_title === "FRENCH") {

												$selected_lesson = get_field("select_gradebook_definition",$values->subjecet_id);
												if(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
													while(have_rows($quarter_domains, $selected_lesson[0]->ID)): 
														the_row(); 
														$main_domain = get_row_index();
														?>
														<div class="subject_row">
															<div class="subject_title font_gb">
																<?php echo get_sub_field("domain_name"); ?>
															</div>
															<div class="subject_point font_gb">
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
																		$student_mark = get_student_one_point($class,$values->subjecet_id,$quarter,$selected_lesson[0]->ID,$main_domain,$sub_domain,$value['ID'])[0]->gb_point;
																		$sub_domain_mark_toplam = $sub_domain_mark_toplam + $student_mark;
																	endwhile; 
																endif;
																$sub_domain_mark_toplam = ($sub_domain_mark_toplam/$sayma);
																$sonuclar = ($sub_domain_mark_toplam*100)/$sub_domain_percentage;
																$yazilacak_rakam = "";
																if ($sonuclar > 89) {
																	$yazilacak_rakam = "A";
																}elseif($sonuclar > 79){
																	$yazilacak_rakam = "B+";
																}elseif($sonuclar > 69){
																	$yazilacak_rakam = "B";
																}elseif($sonuclar > 59){
																	$yazilacak_rakam = "C";
																}elseif($sonuclar > 49){
																	$yazilacak_rakam = "C-";
																}else{
																	$yazilacak_rakam = "D";
																}
																echo $yazilacak_rakam;
																?>
															</div>
														</div>
														<?php 
													endwhile; 
												endif;
											}
										}
										?>
									</div>
									<div class="academic_comment font_gb">
										<?php  
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
										?>
									</div>
									<div class="pdp_comment font_gb">
										<?php  
										$comment_type = "pdp_long_comment";
										$comment_control = get_long_comment($class, $quarter, $value['ID'],$comment_type);
										$kontrol = intval($comment_control[0]->comment);

										if(have_rows($pdp_normal_comments, $class)): 
											while(have_rows($pdp_normal_comments, $class)): 
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
								</div>

								<?php 
							}
						}
						?>



						<style>
							@media screen, print{
								.pdp_comment{
									position: absolute;
									top: 73%;
									left: 6.2%;
									font-size: 20px;
									width: 87%;
								}
								.academic_comment{
									position: absolute;
									top: 43%;
									left: 6.2%;
									font-size: 20px;
									width: 87%;
								}
								.arabic_subject{
									position: absolute;
									top: 13.3%;
									left: 6.2%;
									font-size: 16px;
									width: 87%;
								}
								.turkish_subject{
									position: absolute;
									top: 78.8%;
									left: 6%;
									font-size: 16px;
									width: 87%;
								}
								.english_subject{
									position: absolute;
									top: 56.1%;
									left: 6%;
									font-size: 16px;
									width: 87%;
								}
								.subject_point{
									padding: 15px;
									width: 13.7%;
									text-align: center;
								}
								.subject_title{
									padding: 15px;
									width: 83.7%;
									border-right: 1px solid #f1ba46;
								}
								.subjects{
									position: absolute;
									top: 13.5%;
									left: 6%;
									font-size: 16px;
									width: 87%;
								}
								.subject_row{
									display: flex;
									border-bottom: 1px solid #f1ba46;
									width: 100%;
								}
								.page_header{
									display: flex;
									position: absolute;
									top: 1.7%;
									font-size: 15px;
									width: 100%;
								}
								.stundet_info div {
									margin-top: 31px;
								}
								.stundet_info {
									position: absolute;
									bottom: 6.7%;
									left: 39%;
									width: 100%;
									font-size: 15px;
								}
								.quarter_number {
									position: absolute;
									left: 10.5%;
									bottom: 18.7%;
									font-size: 43px;
									color: #eca100;
									font-weight: bold;
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
	.subject_point{
		padding: 15px;
		width: 16%;
		text-align: center;
	}
	.page_header{
		display: flex;
		position: absolute;
		top: 1.5%;
		font-size: 15px;
	}
	#printArea{
		width: 1240px;
		position: relative;
	}
	.quarter_number{
		position: absolute;
		left: 11%;
		bottom: 18%;
		font-size: 53px;
		color: #eca100;
		font-weight: bold;
	}
	.stundet_info{
		position: absolute;
		bottom: 6.7%;
		left: 39%;
		width: 100%;
		font-size: 19px;
	}
	.stundet_info div{
		margin-top: 25px;
	}
</style>









<?php get_footer(); ?>



<script>
	function printContent() {
    var printWindow = window.open('', '', 'width=1120,height=877'); // Yeni bir pencere aç
    var printDocument = printWindow.document;
    var printContent = document.getElementById('printArea').innerHTML; // Yazdırılacak içeriği al

    // Yazdırılacak içeriği yeni pencereye aktar
    printDocument.write('<html><head><title><?php echo get_the_title($class); ?></title>');
    printDocument.write('<link rel="stylesheet" type="text/css" href="styles.css">'); // CSS dosyasını bağlayın
    printDocument.write('</head><body style="margin:initial">');
    printDocument.write(printContent);
    printDocument.write('</body></html>');

    // Yeni pencereyi yazdır
    printWindow.document.close(); // Dokümanı kapat
    printWindow.print(); // Yazdır
}


</script>



