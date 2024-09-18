<?php /* Template Name: Campus Settings */ ?>
<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="card dark:bg-zinc-800 dark:border-zinc-600">
				<div class="card-body flex flex-wrap">
					<div class="nav-tabs tab-pill" style="width: 100%;">
						<ul class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500" style="justify-content: space-around;">
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-home" class="inline-block px-4 py-3 rounded-md active">
									Campus Time Settings
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-Profile" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">
									ASC Teachers
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-setting" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">
									ASC Classes
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-pills-contact" class="inline-block px-4 py-3 rounded-md dark:hover:text-white">Empty</a>
							</li>
						</ul>

						<div class="tab-content mt-5">
							<div class="tab-pane block" id="tab-pills-home">
								<table style="margin-bottom: 25px;" class="w-full text-sm text-left text-gray-500 ">
									<h4 style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
										Remaining Time For Next Report Generation
									</h4>
									<thead class="text-sm text-gray-700 dark:text-gray-100">
										<tr class="border border-gray-50 dark:border-zinc-600">
											<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Quarter 1
											</th>
											<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Quarter 2
											</th>
											<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Quarter 3
											</th>
											<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
												Quarter 4
											</th>
										</tr>
									</thead>
									<tbody>
										<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
											<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
												<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_campus_q1","options"); ?>" id="remaining_time_q1">
											</th>
											<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_campus_q2","options"); ?>" id="remaining_time_q2">
											</th>
											<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_campus_q3","options"); ?>" id="remaining_time_q3">
											</th>
											<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
												<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_campus_q4","options"); ?>" id="remaining_time_q4">
											</th>
										</tr>
									</tbody>
								</table>
								<div class="mb-4">
									<div class="mb-3">
										<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
											Active Quarter
										</label>
										<select id="active_quarter" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
											<option selected>
												<?php echo get_field("active_campus_quarter","options");?>
											</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
										</select>
									</div>
								</div>
								<button id="sava_settings" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
									Save Settings
								</button>
							</div>
							<div class="tab-pane hidden" id="tab-pills-Profile">
								<div class="grid grid-cols-12 gap-5">
									<div class="col-span-12 xl:col-span-6">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600">
											<div class="card-body pb-0">
												<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
													ASC Teachers
												</h6>
											</div>
											<div class="card-body"> 
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	First Name
																</th>
																<th scope="col" class="px-6 py-3">
																	ASC ID
																</th>
															</tr>
														</thead>
														<tbody>
															<?php  
															if(have_rows('add_xml_file', 'options')): 
																while(have_rows('add_xml_file', 'options')): 
																	the_row(); 
																	$calendar_name = get_sub_field("calendar_name"); 
																	$calendar_file_path = get_sub_field("calendar_file");
																	$xml = simplexml_load_file($calendar_file_path);
																	$teachers = [];
																	foreach ($xml->teachers->teacher as $teacher) {
																		$teachers[(string)$teacher['id']] = (string)$teacher['name'];
																	}
																	asort($teachers);

																	// $classes = [];
																	// $sayma = 0;
																	// foreach ($xml->classes->class as $classe) {
																	// 	$classes[0][$sayma] = $classe['id'];
																	// 	$classes[1][$sayma] = $classe['name'];
																	// 	$sayma = $sayma + 1;
																	// }

																	foreach ($teachers as $key => $value) {
																		?>
																		<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																			<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $value; ?>
																			</th>
																			<td class="px-6 py-3.5 dark:text-zinc-100">
																				<?php echo $key; ?>
																			</td>
																		</tr>
																		<?php 
																	}
																endwhile; 
															endif;
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<div class="col-span-12 xl:col-span-6">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600">
											<div class="card-body pb-0">
												<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
													System Teachers
												</h6>
											</div>
											<div class="card-body"> 
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	Display Name
																</th>
																<th scope="col" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	#
																</th>
															</tr>
														</thead>
														<tbody>
															<?php  
															$args = array(
																'role__not_in' => ['student','administrator']
															);
															$users = get_users($args);
															foreach ($users as $key => $value) {
																?>
																<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<th scope="row" class="px-6 py-3.5">
																		<?php echo $value->data->display_name; ?>
																	</th>
																	<td class="px-6 py-3.5">
																		<input user_system_id="<?php echo $value->data->ID; ?>" type="text" class="system_id_save border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100"  value="<?php echo $asc_time_table_id = get_field('asc_time_table_id', 'user_' .$value->data->ID); ?>">
																	</td>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane hidden" id="tab-pills-setting">
								<div class="grid grid-cols-12 gap-5">
									<div class="col-span-12 xl:col-span-6">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600">
											<div class="card-body pb-0">
												<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
													ASC Classes
												</h6>
											</div>
											<div class="card-body"> 
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Class Name
																</th>
																<th scope="col" class="px-6 py-3">
																	ASC ID
																</th>
															</tr>
														</thead>
														<tbody>
															<?php  
															if(have_rows('add_xml_file', 'options')): 
																while(have_rows('add_xml_file', 'options')): 
																	the_row(); 
																	$calendar_name = get_sub_field("calendar_name"); 
																	$calendar_file_path = get_sub_field("calendar_file");
																	$xml = simplexml_load_file($calendar_file_path);
																	

																	$classes = [];
																	$sayma = 0;
																	foreach ($xml->classes->class as $classe) {
																		$classes[0][$sayma] = $classe['id'];
																		$classes[1][$sayma] = $classe['name'];
																		$sayma = $sayma + 1;
																	}

																	$classes = json_decode(json_encode((array)$classes), true);

																	foreach ($classes[1] as $key => $value) {
																		?>
																		<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																			<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																				<?php echo $value[0]; ?>
																			</th>
																			<td class="px-6 py-3.5 dark:text-zinc-100">
																				<?php echo $classes[0][$key][0];?>
																			</td>
																		</tr>
																		<?php 
																	}
																endwhile; 
															endif;
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<div class="col-span-12 xl:col-span-6">
										<div class="card dark:bg-zinc-800 dark:border-zinc-600">
											<div class="card-body pb-0">
												<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
													System Classes
												</h6>
											</div>
											<div class="card-body"> 
												<div class="relative overflow-x-auto">
													<table class="w-full text-sm text-left text-gray-500 ">
														<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
															<tr>
																<th scope="col" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	Class Name
																</th>
																<th scope="col" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																	#
																</th>
															</tr>
														</thead>
														<tbody>
															<?php  
															$args = array(
																'role__not_in' => ['student','administrator']
															);
															$users = get_users($args);
															foreach ($users as $key => $value) {
																?>
																<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																	<th scope="row" class="px-6 py-3.5">
																		<?php echo $value->data->display_name; ?>
																	</th>
																	<td class="px-6 py-3.5">
																		<input user_system_id="<?php echo $value->data->ID; ?>" type="text" class="system_id_save border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100"  value="<?php echo $asc_time_table_id = get_field('asc_time_table_id', 'user_' .$value->data->ID); ?>">
																	</td>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="tab-pane hidden" id="tab-pills-contact">
								<p class="mb-0 dark:text-gray-300">
									Raw denim you probably haven't heard of them jean shorts Austin.
									Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
									cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
									butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
									qui irure terry richardson ex squid. Aliquip placeat salvia cillum
									iphone. Seitan aliquip quis cardigan american apparel, butcher
									voluptate nisi qui.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>




<style>
	.yesil_arka_plan{
		background-color: yellow !important;
	}
	.system_id_save{
		padding: initial;
		padding-left: 7px;
	}
	.ring-red-200{
		background-color: #8f1537 !important;
	}
	.ring-red-200:hover{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.ring-red-200:focus{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.remining_time{
		padding: 15px;
		border-radius: 7px;
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.remining_time h3{
		text-align: center;
		color: #8f1537 !important;
		padding-bottom: 15px;
	}
	.count-down-container {
		border-radius: 10px;
		overflow: hidden;
		display: flex;
		width: 600px;
		height: 150px;
	}

	.count-down-box {
		text-shadow: 2px 2px rgba(0, 0, 0, 0.3);
		place-items: center;
		text-align: center;
		display: grid;
		height: 100%;
		width: 100%;
	}

	.count-down-box:nth-child(1) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(2) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(3) {
		background-color: rgb(215,154,42,1.0) !important;
	}

	.count-down-box:nth-child(4) {
		background-color: #8f1537 !important;
	}

	.count-down-box h1 {
		font-size: 60px;
		color: white;
	}

	.count-down-box p {
		font-size: 13px;
		color: white;
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


<script>
	$(document).ready(function(){


		$('.system_id_save').on('change', function() {
			user_system_id = $(this).attr("user_system_id");
			user_asc_id = $(this).val();

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_user_asc_change',
					user_system_id:user_system_id,
					user_asc_id:user_asc_id,
				}),
				success: function(data){
					console.log(data);
					$(this).addClass('yesil_arka_plan');

					setTimeout(function() {
						$(this).removeClass('yesil_arka_plan');
					}, 2000);
				}

			});

		});


		$("#header_title").text("Campus Settings");

		document.getElementById("sava_settings").addEventListener("click", function() {
			Swal.fire({
				title: "Are you sure?",
				text: "Your settings will be default settings for all campus",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes, save it!"
			}).then(function (result) {
				if (result.value) {
					remaining_time_q1 = $("#remaining_time_q1").val();
					remaining_time_q2 = $("#remaining_time_q2").val();
					remaining_time_q3 = $("#remaining_time_q3").val();
					remaining_time_q4 = $("#remaining_time_q4").val();
					active_quarter = $("#active_quarter").val();

					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_campus_settings',
							lock_date_q1:remaining_time_q1,
							lock_date_q2:remaining_time_q2,
							lock_date_q3:remaining_time_q3,
							lock_date_q4:remaining_time_q4,
							active_quarter:active_quarter,
						}),
						success: function(data){
							Swal.fire("Saved!", "Your settings are the default for all campus", "success"
								);
							console.log(data.data);
						}

					});

				}
			});
		});

	});
</script>