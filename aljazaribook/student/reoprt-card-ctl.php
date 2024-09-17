<?php /* Template Name: Report Card CTL */ ?>
<?php get_header(); ?>
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

if (isset($_GET['calisma'])){
	$calisma = strip_tags($_GET["calisma"]); 
}


$blog_id = get_current_blog_id();
$get_user_data = get_user_meta($student);
$gruoup_subjects = get_field("subject_for_group",$group);
/**************************************************************/
$args = array(
	'post_type' => 'user_groups',
	'meta_query' => array(
		array(
			'key' => 'group_users',
			'value' => $student,
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

						<div id="printableArea" style="position: relative; height: 70vh; overflow-y: scroll; width: 100%;">
							<img style="width: 100%; max-width: 100%;" src="<?php echo get_template_directory_uri(); ?>/images/7-10-header.png" alt="">
							<div style="padding-left: 5%; padding-right: 5%; min-height: 790px;">
								<div style="width: 100%; margin-bottom: 25px; margin-top: 50px; font-size: 10px; font-weight: bold;">
									<div style="display: flex; font-family: 'Gotham Light';">
										<div style="color: #000; border-top: 1px solid #d79a2a; border-bottom: 1px solid #d79a2a; padding: 5px; width: 40%;">
											Ref : PR1-2324<?php echo get_field('school_no', 'user_'.$student); ?>
										</div>
										<div style="color: #000; border: 1px solid #d79a2a; padding: 5px; width: 25%;">
											Seviye : <?php echo get_field('grade', 'user_'.$student); ?>
										</div>
										<div style="color: #000; border-top: 1px solid #d79a2a; border-bottom: 1px solid #d79a2a; padding: 5px; width: 35%;">
											Veriliş Tarihi : 02-12-2023
										</div>
									</div>
									<div style="display: flex; font-family: 'Gotham Light';">
										<div style="color: #000; border-bottom: 1px solid #d79a2a; padding: 5px; width: 40%;">
											Adı / Soyadı : <?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
										</div>
										<div style="color: #000; border-bottom: 1px solid #d79a2a; border-left: 1px solid #d79a2a; border-right: 1px solid #d79a2a; padding: 5px; width: 25%;">
											Öğrenci Numarası : <?php echo get_field('school_no', 'user_'.$student); ?>
										</div>
										<div style="color: #000; border-bottom: 1px solid #d79a2a; padding: 5px; width: 35%;">
											Sınıf : <?php echo get_the_title($group); ?>
										</div>
									</div>
								</div>
								<div class="font_gb" style="background-color: #8f1537; color: #fff; border: 1px solid #d79a2a; padding: 7px; width: 98%; -webkit-print-color-adjust: exact; text-align: center; font-size: 14px; font-weight: 600;">
									DERSLER
								</div>
								<table style="width: 100%; border-spacing: initial;">
									<thead>
										<tr style="width: 100%;">
											<th class="font_gb" style="background-color: #244b5a; color: #fff; border: 1px solid #d79a2a; padding: 10px; width: 75%; -webkit-print-color-adjust: exact; font-size: 13px; text-align: left;">
												DERS ADI
											</th>
											<th class="font_gb" style="background-color: #244b5a; color: #fff; border: 1px solid #d79a2a; padding: 10px; width: 25%; -webkit-print-color-adjust: exact; font-size: 13px; text-align: center;">
												ORTALAMA
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  
										foreach ($gruoup_subjects as $key => $value) {
											$select_lesson_type = get_field("select_lesson_type",$value->ID);

											$bg_table_name = "student_avarages";
											$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$group." and subjecet_id =".$value->ID." and quarter_id = 1 and student_id =".$student."" );
											$sonuclar1 = $wpdb->get_results($query);
											?>
											<tr style="width: 100%;">
												<th class="font_gl" style="border: 1px solid #d79a2a; padding: 10px; width: 75%;text-align: left; font-size: 11px;">
													<?php echo $select_lesson_type[0]->post_title; ?>
												</th>
												<td class="font_gl" style="border: 1px solid #d79a2a; padding: 10px; width: 25%; font-size: 11px; text-align: center;">
													<?php print_r($sonuclar1[0]->student_avarage); ?>
												</td>
											</tr>
											<?php 
										}
										foreach ($my_query as $keys => $values) {
											$sub_gruoup_subjects = get_field("subject_for_group",$values->ID);
											$select_lesson_type = get_field("select_lesson_type",$sub_gruoup_subjects[0]->ID);


											$bg_table_name = "student_avarages";
											$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and group_id =".$values->ID." and quarter_id = 1 and student_id =".$student."" );
											$sonuclar1 = $wpdb->get_results($query);
											?>
											<tr style="width: 100%;">
												<th class="font_gl" style="border: 1px solid #d79a2a; padding: 10px; width: 75%;text-align: left; font-size: 11px;">
													<?php echo $select_lesson_type[0]->post_title; ?>
												</th>
												<td class="font_gl" style="border: 1px solid #d79a2a; padding: 10px; width: 25%; font-size: 11px; text-align: center;">
													<?php print_r($sonuclar1[0]->student_avarage); ?>
												</td>
											</tr>
											<?php 
										}
										?>
									</tbody>
								</table>
							</div>
							<img style="width: 100%; max-width: 100%;" src="<?php echo get_template_directory_uri(); ?>/images/7-10-footer.png" alt="">
							<style>
								@media screen, print{
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
			printWindow.document.write('<html><head><title>Print</title></head><body style="padding-left: 0%; padding-right: 0%;">');
			printWindow.document.write(printableArea.innerHTML);
			printWindow.document.close();
			printWindow.print();
			//printWindow.close();
		} else {
			alert('Printable area not found.');
		}
	});


	document.getElementById('printButton_1112').addEventListener('click', function() {
		var printableArea = document.getElementById('printButton_1112_6');

		if (printableArea) {
			var printWindow = window.open('', '', 'width=800,height=700');
			printWindow.document.open();
			printWindow.document.write('<html><head><title>Print</title></head><body style="padding-left: 0%; padding-right: 0%;">');
			printWindow.document.write(printableArea.innerHTML);
			printWindow.document.close();
			printWindow.print();
			//printWindow.close();
		} else {
			alert('Printable area not found.');
		}
	});
</script>





