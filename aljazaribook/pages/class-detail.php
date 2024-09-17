<?php /* Template Name: Class Detail */ ?>
<?php get_header(); ?>

<?php 
if (isset($_GET['classid'])){
	$classid = strip_tags($_GET["classid"]); 
	$args = array(
		'post_type' => 'newClass_add',
		'p'			=> $classid,
	);
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>/my-all-classes";
	</script>
	<?php 
}

?>

<?php 
$my_posts = new WP_Query($args);
if ($my_posts->have_posts()) {
	while ($my_posts->have_posts()) {
		$my_posts->the_post();
		$categoryID = get_the_id(); 
		//edit_comment();
		?>
		<div class="main-content">
			<div class="page-content dark:bg-zinc-700">
				<div class="container-fluid px-[0.625rem]">
					<div class="grid grid-cols-1 mb-5">
						<div class="flex items-center justify-between">
							<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
								<?php echo get_the_title(); ?> 
							</h4>
						</div>
					</div>
					<div class=" grid grid-cols-1">
						<div class="grid grid-cols-12 gap-5">

							<?php $add_class_students = get_field("add_class_students",$categoryID); 
							if ($add_class_students != "") {
								foreach ($add_class_students as $key => $value) {
									?>
									<!------------------------------->
									<div studentID="<?php echo $value['ID']; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
											<div class="card-body">
												<div class="mb-4">
													<img src="<?php echo get_field("user_image","user_".$value['ID'])['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
												</div>
												<div class="text-center">
													<h5 class="text-16 text-gray-700 mb-1">
														<a href="#" class="dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</a>
													</h5>
													<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
														<?php echo $value['user_email']; ?>
													</a>
												</div>
											</div>
											<div class="inline-flex rounded-md w-full" role="group">
												<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $value['ID']; ?>">
													Profile
												</button>
												<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton-studentpoint<?php echo $value['ID']; ?>">
													Points
												</button>
											</div>
										</div>
									</div>
									<!------------------------------->
									<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
										<div class="fixed inset-0 z-50 overflow-hidden">
											<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
											<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
												<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
													<div class="bg-white p-5 text-center dark:bg-zinc-700">
														<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
															<img src="<?php echo get_field("user_image","user_".$value['ID'])['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
														</div>
														<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</h2>
														<div class="card-body">
															<div class="grid grid-cols-12 gap-5">
																<div class="col-span-12 lg:col-span-6">
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['display_name']; ?>" id="user-display-name">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['user_registered']; ?>" id="user-registered">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$value['ID']); ?>" id="user-eyotek-id">
																	</div>
																</div>
																<div class="col-span-12 lg:col-span-6">
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $value['user_email']; ?>" id="user-email">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																			Gender
																		</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$value['ID']); ?>" id="user-gender">
																	</div>
																	<div class="mb-4">
																		<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																			Subject
																		</label>
																		<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$value['ID']); ?>" id="user-gender">
																	</div>
																</div>
															</div>
														</div>

														<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
															<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal relative z-50 hidden" id="modal-id_wideButton-studentpoint<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
										<div class="fixed inset-0 z-50 overflow-hidden">
											<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
											<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
												<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
													<div class="bg-white p-5 text-center dark:bg-zinc-700">
														<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
															<?php echo $value['display_name']; ?>
														</h2>
														<div class="col-span-12 xl:col-span-6">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																<div class="card-body flex flex-wrap">
																	<div class="nav-tabs bar-tabs" style="width: 100%;">
																		<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full overflow-hidden">
																			<li class="w-full">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter1_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4 active">Quarter 1</a>
																			</li>
																			<li class="w-full border-x border-gray-50">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter2_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4">
																					Quarter 2
																				</a>
																			</li>
																			<li class="w-full ltr:border-r rtl:border-l border-gray-50">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter3_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4">
																					Quarter 3
																				</a>
																			</li>
																			<li class="w-full">
																				<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="quarter4_user_<?php echo $value['ID']; ?>" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg">
																					Quarter 4
																				</a>
																			</li>
																		</ul>

																		<div class="tab-content mt-5">
																			<div class="tab-pane block" id="quarter1_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">

																						<?php $add_not_to_quarter_1 = get_field("add_not_to_quarter_1",$categoryID);  
																						if ($add_not_to_quarter_1 != "") {
																							foreach ($add_not_to_quarter_1 as $keys => $values) {
																								$studetn_point_spesifik = get_student_point($classid,1,$value['ID'],$keys);
																								
																								?>
																								<!------------------------->
																								<div class="col-md-6 row" style="padding: 7px; flex-flow:initial;">
																									<div style="width: 60%;" class="point_kutular">
																										<?php echo $values['point_title']; ?>
																									</div>
																									<div style="width: 20%;" class="point_kutular">
																										%<?php echo $values['percentage']; ?>
																									</div>
																									<?php if (date('d-m-Y') < $values['start_date'] || date('d-m-Y') > $values['end_date']) {
																										$input_time = 'readonly';
																									}else{
																										$input_time = '';
																									} ?>
																									<input input-id="<?php echo $keys; ?>" type="number" min="0" max="100"  style="max-width: 20%;" <?php echo $input_time; ?> value="<?php echo $studetn_point_spesifik[0]->comment_content; ?>" class="<?php echo $input_time; ?>">
																								</div>
																								<!------------------------->
																								<?php 
																								//echo date('d-m-Y');
																								//print_r($values);
																							}
																						}
																						?>


																						<style>
																							.readonly{
																								background-color: red;
																								color: #fff;
																								border-color: #fff;
																							}
																							.readonly::placeholder{
																								color: #fff;
																							}
																							.point_kutular{
																								border: 1px solid #e5e7eb;
																								pointer-events: none;
																								display: flex;
																								align-items: center;
																								padding: 10px;
																							}
																						</style>
																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter2_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">

																						<?php $add_not_to_quarter_2 = get_field("add_not_to_quarter_2",$categoryID);  
																						if ($add_not_to_quarter_2 != "") {
																							foreach ($add_not_to_quarter_2 as $keys => $values) {
																								$studetn_point_spesifik = get_student_point($classid,2,$value['ID'],$keys);
																								?>
																								<!------------------------->
																								<div class="col-md-6 row" style="padding: 7px; flex-flow:initial;">
																									<div style="width: 60%;" class="point_kutular">
																										<?php echo $values['point_title']; ?>
																									</div>
																									<div style="width: 20%;" class="point_kutular">
																										%<?php echo $values['percentage']; ?>
																									</div>
																									<?php if (date('d-m-Y') < $values['start_date'] || date('d-m-Y') > $values['end_date']) {
																										$input_time = 'readonly';
																									}else{
																										$input_time = '';
																									} ?>
																									<input input-id="<?php echo $keys; ?>" type="number" min="0" max="100"  style="max-width: 20%;" <?php echo $input_time; ?> value="<?php echo $studetn_point_spesifik[0]->comment_content; ?>" class="<?php echo $input_time; ?>">
																								</div>
																								<!------------------------->
																								<?php 
																							}
																						}
																						?>


																						<style>
																							.point_kutular{
																								border: 1px solid #e5e7eb;
																								pointer-events: none;
																								display: flex;
																								align-items: center;
																								padding: 10px;
																							}
																						</style>
																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter3_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">

																						<?php $add_not_to_quarter_3 = get_field("add_not_to_quarter_3",$categoryID);  
																						if ($add_not_to_quarter_3 != "") {
																							foreach ($add_not_to_quarter_3 as $keys => $values) {
																								$studetn_point_spesifik = get_student_point($classid,3,$value['ID'],$keys);
																								?>
																								<!------------------------->
																								<div class="col-md-6 row" style="padding: 7px; flex-flow:initial;">
																									<div style="width: 60%;" class="point_kutular">
																										<?php echo $values['point_title']; ?>
																									</div>
																									<div style="width: 20%;" class="point_kutular">
																										%<?php echo $values['percentage']; ?>
																									</div>
																									<?php if (date('d-m-Y') < $values['start_date'] || date('d-m-Y') > $values['end_date']) {
																										$input_time = 'readonly';
																									}else{
																										$input_time = '';
																									} ?>
																									<input input-id="<?php echo $keys; ?>" type="number" min="0" max="100"  style="max-width: 20%;" <?php echo $input_time; ?> value="<?php echo $studetn_point_spesifik[0]->comment_content; ?>" class="<?php echo $input_time; ?>">
																								</div>
																								<!------------------------->
																								<?php 
																							}
																						}
																						?>


																						<style>
																							.point_kutular{
																								border: 1px solid #e5e7eb;
																								pointer-events: none;
																								display: flex;
																								align-items: center;
																								padding: 10px;
																							}
																						</style>
																					</div>
																				</p>
																			</div>
																			<div class="tab-pane hidden" id="quarter4_user_<?php echo $value['ID']; ?>">
																				<p class="mb-0 dark:text-gray-300">
																					<div class="row">

																						<?php $add_not_to_quarter_4 = get_field("add_not_to_quarter_4",$categoryID);  
																						if ($add_not_to_quarter_4 != "") {
																							foreach ($add_not_to_quarter_4 as $keys => $values) {
																								$studetn_point_spesifik = get_student_point($classid,4,$value['ID'],$keys);
																								?>
																								<!------------------------->
																								<div class="col-md-6 row" style="padding: 7px; flex-flow:initial;">
																									<div style="width: 60%;" class="point_kutular">
																										<?php echo $values['point_title']; ?>
																									</div>
																									<div style="width: 20%;" class="point_kutular">
																										%<?php echo $values['percentage']; ?>
																									</div>
																									<?php if (date('d-m-Y') < $values['start_date'] || date('d-m-Y') > $values['end_date']) {
																										$input_time = 'readonly';
																									}else{
																										$input_time = '';
																									} ?>
																									<input input-id="<?php echo $keys; ?>" type="number" min="0" max="100"  style="max-width: 20%;" <?php echo $input_time; ?> value="<?php echo $studetn_point_spesifik[0]->comment_content; ?>" class="<?php echo $input_time; ?>">
																								</div>
																								<!------------------------->
																								<?php 
																							}
																						}
																						?>

																						<style>
																							.point_kutular{
																								border: 1px solid #e5e7eb;
																								pointer-events: none;
																								display: flex;
																								align-items: center;
																								padding: 10px;
																							}
																						</style>
																					</div>
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
															<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
															<button button_filed_id="<?php echo $value['ID']; ?>" style="margin-left: 15px;" type="button" class="save_student_nots btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Save</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
								}
							}else{
								echo "Class Is Empty";
							}

							?>

							<?php /* ?>
							<?php echo "<pre>"; ?>
							<?php print_r($add_class_students); ?>
							<?php echo "<pre>"; ?>
							<?php */ ?>


						</div>
					</div>



				</div>
			</div>
		</div>
		<?php 
	}

}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>/wp-admin/admin.php?page=my_classes";
	</script>
	<?php 
}
wp_reset_query();
?>


<?php get_footer(); ?>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var class_id = '<?php echo $classid; ?>';
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/class-detail.js?ver=1"></script>