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




								
								$sort_subjecets = [];
								foreach ($sonuclar1 as $subject => $subjectler) {
									if ($subjectler->quarter_id == $quarter) {
										$sort_subjecets[] = $subjectler->subjecet_id;
									}
								}
								$unique_subject_ids = array_unique($sort_subjecets);
								sort($unique_subject_ids);
								$ogrenci_ders_isimleri[] = $unique_subject_ids;

								foreach ($unique_subject_ids as $key_subject => $subject_id) {
									$atar = get_field("atar",$subject_id);
									$project_curve = 0;

									foreach ($project_control as $keypro => $valuepro) {
										if ($valuepro->subject_id == $subject_id) {
											$project_curve = 1;
										}
									}

									if ($atar === "Yes") {
										
										$su_anki_credi = 0;
										foreach ($sonuclar1 as $keys => $values) {
											if ($values->quarter_id == 1 && $values->subjecet_id == $subject_id) {
												if ($project_curve == 1) {
													$student_notlari_genel[$key][$key_subject][1] = number_format($values->stundent_curve, 1);
												}else{
													$student_notlari_genel[$key][$key_subject][1] = number_format($values->stundent_curve, 1);
												}
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
											$islem = (($student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2])*35/50)+15;
										}else{
											$islem = (($student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2]));
										}
										if ($islem > 50) {
											$islem = 50;
										}
										$student_curv_point = number_format($islem, 1);

										$kredili_notlar = $kredili_notlar + ($student_curv_point*$su_anki_credi)*2;
										

										
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
												$islem = (($student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4])*35/50)+15;
											}else{
												$islem = (($student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4]));
											}
											if ($islem > 50) {
												$islem = 50;
											}
											$student_curv_point = number_format($islem, 1);

											$kredili_notlar_2 = $kredili_notlar_2 + ($student_curv_point*$su_anki_credi)*2;
										}
										?>


										<?php  
										if ($quarter == 4) {

											$final_not = $student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2] + $student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4];

											if ($project_curve == 1) {
												$final_not = ($final_not*70/100)+30;
											}else{
												$final_not = ($final_not);
											}

											if ($final_not > 100) {
												$final_not = 100;
											}
											$final_not = number_format($final_not,1);

										}
										?>

										<?php 	
									}										
								}

								$sort_subjecets = [];
								foreach ($sonuclar1 as $subject => $subjectler) {
									if ($subjectler->quarter_id == $quarter) {
										$sort_subjecets[] = $subjectler->subjecet_id;
									}
								}
								$unique_subject_ids = array_unique($sort_subjecets);
								sort($unique_subject_ids);
								$ogrenci_ders_isimleri[] = $unique_subject_ids;

								foreach ($unique_subject_ids as $key_subject => $subject_id) {
									$atar = get_field("atar",$subject_id);
									if ($atar != "Yes") {

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


										$student_curv_point = number_format($islem, 1);

										$kredili_notlar = $kredili_notlar + ($student_curv_point*$su_anki_credi);

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
											$student_curv_point = number_format($islem2, 1);

											$kredili_notlar_2 = $kredili_notlar_2 + ($student_curv_point*$su_anki_credi);
										}

										if ($quarter == 4) {
											if ($project_curve == 1) {
												$final_not = ($islem2+$islem)*2;
											}else{
												$final_not = $student_notlari_genel[$key][$key_subject][1] + $student_notlari_genel[$key][$key_subject][2] + $student_notlari_genel[$key][$key_subject][3] + $student_notlari_genel[$key][$key_subject][4];
											}
											$final_not = number_format(($final_not/4),1);

										}

									}										
								}

								$semester_gpa = 0;
								$semester_gpa = number_format(($kredili_notlar/$kredi_sayar),1);
								$student_curv_point = $semester_gpa;

								if ($quarter == 4) {
									$semester_gpa_2 = 0;
									$semester_gpa_2 = number_format(($kredili_notlar_2/$kredi_sayar),1);
									$student_curv_point = $semester_gpa_2;
								}

								if ($quarter == 4) {
									// rakam burda 
									$student_curv_point = (($semester_gpa + $semester_gpa_2)/2);
								}
								$student_curv_point = $student_curv_point +2;
								?>

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
								.grade_yazisi{
									position: absolute;
									top: 281px;
									left: 467px;
									font-size: 18px;
									color: #fff;
								}
								.zaman{
									position: absolute;
									top: 281px;
									left: 215px;
									font-size: 18px;
									color: #fff;
								}
								.ogrenci_ismi{
									position: absolute;
									font-size: 35px;
									color: #99073e;
									font-weight: bold;
									top: 234px;
									width: 100%;
									text-align: center;
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
									width: 123.5px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 13px;
									text-align: center;
								}
								.semester_2{
									width: 124px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 13px;
									text-align: center;
								}
								.semester_1{
									width: 124.5px;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									display: flex;
									font-size: 13px;
									text-align: center;
								}
								.subject_list2 .semester_1{
									width: 124px;
								}
								.tek_subject{
									display: flex;
								}
								.subject_title{
									font-size: 13px;
									padding: 6px;
									padding-bottom: 8px;
									padding-bottom: 8px;
									border-left: 2px #eda301 solid;
									border-bottom: 2px #eda301 solid;
									border-right: 2px #eda301 solid;
									width: 304px;
								}
								.subject_list{
									position: absolute;
									top: 176px;
									left: 48px;
								}
								.subject_list2{
									position: absolute;
									top: 488px;
									left: 48px;
								}
								.subject_list2 .subject_title{
									width: 306px;
								}
								.subject_list2 .sene_sonu{
									width: 124.5px;
								}
								.subject_list2 .semester_2{
									width: 123.5px;
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
									margin-top: 16%;
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
									top: 67.5%;
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
		top: 433px;
		left: 725px;
		font-size: 28px;
		color: #fff;
	}
	.zaman{
		position: absolute;
		top: 433px;
		left: 336px;
		font-size: 28px;
		color: #fff;
	}
	.ogrenci_ismi{
		position: absolute;
		font-size: 50px;
		color: #99073e;
		font-weight: bold;
		top: 362px;
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


