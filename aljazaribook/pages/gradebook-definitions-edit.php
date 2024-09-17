<?php /* Template Name: Gradebook Edit */ ?>
<?php 
if (isset($_GET['id'])){
	$gradebook_ID = strip_tags($_GET["id"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$quarter_1_percentage_counter = 0;
$quarter_2_percentage_counter = 0;
$quarter_3_percentage_counter = 0;
$quarter_4_percentage_counter = 0;


?>
<?php get_header(); ?>
<!-- Responsive Table css -->

<link href="<?php echo get_template_directory_uri(); ?>/assets/extra/editabletable.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
<?php $current_user_id = get_current_user_id(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?> - <?php echo get_the_title($gradebook_ID); ?>
					</h4>
				</div>
			</div>
			<?php  
			if (get_user_access_write('see-module')) {
				if (get_user_access_write('edit-module')) {
					?>
					<div class="grid grid-cols-12 gap-5">     
						<div class="col-span-12 xl:col-span-12">
							<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border: initial;">
								<div class="card-body flex flex-wrap">
									<div class="nav-tabs border-b-tabs" style="width: 100%;">
										<ul style="justify-content: space-evenly;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
											<li>
												<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-home" class="inline-block p-4 <?php if (get_field("active_campus_quarter","options") == 1){echo "active";} ?>">
													<i class="mdi mdi-weather-rainy ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
													Quarter 1
													<div style="color: #244b5a;">
														Total Percentage : % <span id="percentage_quarter1">100</span>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-Profile" class="inline-block p-4 <?php if (get_field("active_campus_quarter","options") == 2){echo "active";} ?>">
													<i class="mdi mdi-snowflake ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
													Quarter 2
													<div style="color: #244b5a;">
														Total Percentage : % <span id="percentage_quarter2">100</span>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-setting" class="inline-block p-4 <?php if (get_field("active_campus_quarter","options") == 3){echo "active";} ?>">
													<i class="mdi mdi-flower ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
													Quarter 3
													<div style="color: #244b5a;">
														Total Percentage : % <span id="percentage_quarter3">100</span>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-contact" class="inline-block p-4 <?php if (get_field("active_campus_quarter","options") == 4){echo "active";} ?>">
													<i class="mdi mdi-white-balance-sunny ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
													Quarter 4
													<div style="color: #244b5a;">
														Total Percentage : % <span id="percentage_quarter4">100</span>
													</div>
												</a>
											</li>
										</ul>
										<style>
											.edit-table input{
												width: 100% !important;
											}
										</style>
										<div class="tab-content mt-5">
											<div class="tab-pane <?php if (get_field("active_campus_quarter","options") == 1){echo "block";}else{echo "hidden";} ?>" id="underline-icon-home">
												<button quarter="1" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="open_all btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
													Open All Domains
												</button>
												<button quarter="1" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="close_all btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
													Close All Domains
												</button>
												<button quarter="1" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="get_module_bank btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#modal_id_1">
													Get Module From Bank
												</button>
												<div style="margin-top: 10px;" class="grid grid-cols-12 gap-5">
													<?php  if(have_rows('add_quarter_1_domains', $gradebook_ID)): 
														while(have_rows('add_quarter_1_domains', $gradebook_ID)): 
															the_row(); 
															$data_id_counter = get_row_index();	
															$quarter_1_percentage_counter = $quarter_1_percentage_counter + get_sub_field("domain_percentage");
															?>
															<div class="col-span-12">
																<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																	<div class="card-body pb-0">
																		<table class="table table-editable table-nowrap align-middle table-edits-domain w-full text-left">
																			<thead>
																				<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																					<th class="p-3" style="color: #8f1537;">
																						Assesment Type
																					</th>
																					<th class="p-3" style="color: #8f1537;">
																						Quarterly Percentage
																					</th>
																					<th class="p-3">
																						Edit
																					</th>
																					<th class="p-3">
																						Delete
																					</th>
																				</tr>
																			</thead>
																			<tbody class="text-gray-600">
																				<tr quarter-id="1" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?>name">
																					<td style="color: #d79a2a; font-weight: bold;" class="p-3 dark:text-zinc-100 domain_name" data-field="domain_name"><?php echo get_sub_field("domain_name"); ?></td>
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_percentage quarter1" data-field="domain_percentage"><?php echo get_sub_field("domain_percentage"); ?></td>
																					<td class="p-3 dark:text-zinc-100" style="width: 100px;">
																						<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																							<i class="fas fa-pencil-alt" style="color: #d79a2a;"></i>
																						</a>
																					</td>
																					<td class="p-3 dark:text-zinc-100 to">
																						<button quarteradd="1" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_domain btn border-0 text-white px-5" style="background-color: #8f1537;">
																							<i class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">Delete</span>
																						</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<div class="card-body">
																		<div class="table-responsive">
																			<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																				<thead>
																					<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																						<th class="p-3">
																							Sub Assesment
																						</th>
																						<th class="p-3">
																							Percentage
																						</th>
																						<th class="p-3">
																							Rubric (Out of)
																						</th>
																						<th class="p-3">
																							From
																						</th>
																						<th class="p-3">
																							To
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Edit
																						</th>
																						<th class="p-3">
																							Delete
																						</th>
																					</tr>
																				</thead>
																				<tbody class="text-gray-600">
																					<?php  if(have_rows('add_sub_domains')): 
																						while(have_rows('add_sub_domains')): 
																							the_row(); 
																							?>
																							<tr quarter-id="1" sub-domain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																								<td class="p-3 dark:text-zinc-100 sub_domain_name" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																								<td class="p-3 dark:text-zinc-100 sub_domain_percentage" data-field="sub_domain_percentage"><?php echo get_sub_field("sub_domain_percentage"); ?></td>
																								<td class="p-3 dark:text-zinc-100 based_on" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																								<td class="p-3 dark:text-zinc-100 from" data-field="from"><?php echo get_sub_field("from"); ?></td>
																								<td class="p-3 dark:text-zinc-100 to" data-field="to"><?php echo get_sub_field("to"); ?></td>
																								<td class="p-3 dark:text-zinc-100 open_mode" data-field="open_mode"><?php echo get_sub_field("open_mode"); ?></td>
																								<td class="p-3 dark:text-zinc-100" style="width: 100px">
																									<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																										<i class="fas fa-pencil-alt"></i>
																									</a>
																								</td>
																								<td class="p-3 dark:text-zinc-100 to">
																									<button quarteradd="1" subdomain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_subdomain btn border-0 bg-red-400 text-white px-5">
																										<i class="mdi mdi-trash-can block text-lg"></i>
																										<span class="">Delete</span>
																									</button>
																								</td>
																							</tr>
																						<?php endwhile; 
																					endif; ?>
																				</tbody>
																			</table>
																			<div style="margin-top: 15px; display: flex; justify-content: end;">
																				<button quarteradd="1" domainId="<?php echo $data_id_counter; ?>" type="button" class="btn text-black bg-gray-100 border-gray-100 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-500/30 active:bg-gray-300 active:border-gray-300 addSubDomain">
																					Add an Sub Assesment
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endwhile; 
													endif; ?>
												</div>
												<button quarteradd="1" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 addDomain">
													Add an Assesment
												</button>
											</div>
											<div class="tab-pane <?php if (get_field("active_campus_quarter","options") == 2){echo "block";}else{echo "hidden";} ?>" id="underline-icon-Profile">
												<button quarter="2" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="open_all btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
													Open All Domains
												</button>
												<button quarter="2" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="close_all btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
													Close All Domains
												</button>
												<button quarter="2" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="get_module_bank btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#modal_id_2">
													Get Module From Bank
												</button>
												<div class="grid grid-cols-12 gap-5">
													<?php  if(have_rows('add_quarter_2_domains', $gradebook_ID)): 
														while(have_rows('add_quarter_2_domains', $gradebook_ID)): 
															the_row(); 
															$data_id_counter = get_row_index();	
															$quarter_2_percentage_counter = $quarter_2_percentage_counter + get_sub_field("domain_percentage");
															?>
															<div class="col-span-12">
																<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																	<div class="card-body pb-0">
																		<table class="table table-editable table-nowrap align-middle table-edits-domain w-full text-left">
																			<thead>
																				<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																					<th class="p-3" style="color: #8f1537;">
																						Assesment Type
																					</th>
																					<th class="p-3" style="color: #8f1537;">
																						Quarterly Percentage
																					</th>
																					<th class="p-3">
																						Edit
																					</th>
																					<th class="p-3">
																						Delete
																					</th>
																				</tr>
																			</thead>
																			<tbody class="text-gray-600">
																				<tr quarter-id="2" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?>name">
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_name" data-field="domain_name"><?php echo get_sub_field("domain_name"); ?></td>
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_percentage quarter2" data-field="domain_percentage"><?php echo get_sub_field("domain_percentage"); ?></td>
																					<td class="p-3 dark:text-zinc-100" style="width: 100px;">
																						<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																							<i class="fas fa-pencil-alt" style="color: #d79a2a;"></i>
																						</a>
																					</td>
																					<td class="p-3 dark:text-zinc-100 to">
																						<button quarteradd="2" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_domain btn border-0 text-white px-5" style="background-color: #8f1537;">
																							<i class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">Delete</span>
																						</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<div class="card-body">
																		<div class="table-responsive">
																			<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																				<thead>
																					<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																						<th class="p-3">
																							Sub Assesment
																						</th>
																						<th class="p-3">
																							Percentage
																						</th>
																						<th class="p-3">
																							Rubric (Out of)
																						</th>
																						<th class="p-3">
																							From
																						</th>
																						<th class="p-3">
																							To
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Edit
																						</th>
																						<th class="p-3">
																							Delete
																						</th>
																					</tr>
																				</thead>
																				<tbody class="text-gray-600">
																					<?php  if(have_rows('add_sub_domains')): 
																						while(have_rows('add_sub_domains')): 
																							the_row(); 
																							?>
																							<tr quarter-id="2" sub-domain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																								<td class="p-3 dark:text-zinc-100 sub_domain_name" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																								<td class="p-3 dark:text-zinc-100 sub_domain_percentage" data-field="sub_domain_percentage"><?php echo get_sub_field("sub_domain_percentage"); ?></td>
																								<td class="p-3 dark:text-zinc-100 based_on" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																								<td class="p-3 dark:text-zinc-100 from" data-field="from"><?php echo get_sub_field("from"); ?></td>
																								<td class="p-3 dark:text-zinc-100 to" data-field="to"><?php echo get_sub_field("to"); ?></td>
																								<td class="p-3 dark:text-zinc-100 open_mode" data-field="open_mode"><?php echo get_sub_field("open_mode"); ?></td>
																								<td class="p-3 dark:text-zinc-100" style="width: 100px">
																									<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																										<i class="fas fa-pencil-alt"></i>
																									</a>
																								</td>
																								<td class="p-3 dark:text-zinc-100 to">
																									<button quarteradd="2" subdomain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_subdomain btn border-0 bg-red-400 text-white px-5">
																										<i class="mdi mdi-trash-can block text-lg"></i>
																										<span class="">Delete</span>
																									</button>
																								</td>
																							</tr>
																						<?php endwhile; 
																					endif; ?>
																				</tbody>
																			</table>
																			<div style="margin-top: 15px; display: flex; justify-content: end;">
																				<button quarteradd="2" domainId="<?php echo $data_id_counter; ?>" type="button" class="btn text-black bg-gray-100 border-gray-100 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-500/30 active:bg-gray-300 active:border-gray-300 addSubDomain">
																					Add an Sub Assesment
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endwhile; 
													endif; ?>
												</div>
												<button quarteradd="2" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 addDomain">
													Add an Assesment
												</button>
											</div>
											<div class="tab-pane <?php if (get_field("active_campus_quarter","options") == 3){echo "block";}else{echo "hidden";} ?>" id="underline-icon-setting">
												<button quarter="3" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="open_all btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
													Open All Domains
												</button>
												<button quarter="3" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="close_all btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
													Close All Domains
												</button>
												<button quarter="3" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="get_module_bank btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#modal_id_3">
													Get Module From Bank
												</button>
												<div class="grid grid-cols-12 gap-5">
													<?php  if(have_rows('add_quarter_3_domains', $gradebook_ID)): 
														while(have_rows('add_quarter_3_domains', $gradebook_ID)): 
															the_row(); 
															$data_id_counter = get_row_index();	
															$quarter_3_percentage_counter = $quarter_3_percentage_counter + get_sub_field("domain_percentage");
															?>
															<div class="col-span-12">
																<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																	<div class="card-body pb-0">
																		<table class="table table-editable table-nowrap align-middle table-edits-domain w-full text-left">
																			<thead>
																				<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																					<th class="p-3" style="color: #8f1537;">
																						Assesment Type
																					</th>
																					<th class="p-3" style="color: #8f1537;">
																						Quarterly Percentage
																					</th>
																					<th class="p-3">
																						Edit
																					</th>
																					<th class="p-3">
																						Delete
																					</th>
																				</tr>
																			</thead>
																			<tbody class="text-gray-600">
																				<tr quarter-id="3" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?>name">
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_name" data-field="domain_name"><?php echo get_sub_field("domain_name"); ?></td>
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_percentage quarter3" data-field="domain_percentage"><?php echo get_sub_field("domain_percentage"); ?></td>
																					<td class="p-3 dark:text-zinc-100" style="width: 100px;">
																						<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																							<i class="fas fa-pencil-alt" style="color: #d79a2a;"></i>
																						</a>
																					</td>
																					<td class="p-3 dark:text-zinc-100 to">
																						<button quarteradd="3" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_domain btn border-0 text-white px-5" style="background-color: #8f1537;">
																							<i class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">Delete</span>
																						</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<div class="card-body">
																		<div class="table-responsive">
																			<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																				<thead>
																					<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																						<th class="p-3">
																							Sub Assesment
																						</th>
																						<th class="p-3">
																							Percentage
																						</th>
																						<th class="p-3">
																							Rubric (Out of)
																						</th>
																						<th class="p-3">
																							From
																						</th>
																						<th class="p-3">
																							To
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Edit
																						</th>
																						<th class="p-3">
																							Delete
																						</th>
																					</tr>
																				</thead>
																				<tbody class="text-gray-600">
																					<?php  if(have_rows('add_sub_domains')): 
																						while(have_rows('add_sub_domains')): 
																							the_row(); 
																							?>
																							<tr quarter-id="3" sub-domain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																								<td class="p-3 dark:text-zinc-100 sub_domain_name" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																								<td class="p-3 dark:text-zinc-100 sub_domain_percentage" data-field="sub_domain_percentage"><?php echo get_sub_field("sub_domain_percentage"); ?></td>
																								<td class="p-3 dark:text-zinc-100 based_on" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																								<td class="p-3 dark:text-zinc-100 from" data-field="from"><?php echo get_sub_field("from"); ?></td>
																								<td class="p-3 dark:text-zinc-100 to" data-field="to"><?php echo get_sub_field("to"); ?></td>
																								<td class="p-3 dark:text-zinc-100 open_mode" data-field="open_mode"><?php echo get_sub_field("open_mode"); ?></td>
																								<td class="p-3 dark:text-zinc-100" style="width: 100px">
																									<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																										<i class="fas fa-pencil-alt"></i>
																									</a>
																								</td>
																								<td class="p-3 dark:text-zinc-100 to">
																									<button quarteradd="3" subdomain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_subdomain btn border-0 bg-red-400 text-white px-5">
																										<i class="mdi mdi-trash-can block text-lg"></i>
																										<span class="">Delete</span>
																									</button>
																								</td>
																							</tr>
																						<?php endwhile; 
																					endif; ?>
																				</tbody>
																			</table>
																			<div style="margin-top: 15px; display: flex; justify-content: end;">
																				<button quarteradd="3" domainId="<?php echo $data_id_counter; ?>" type="button" class="btn text-black bg-gray-100 border-gray-100 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-500/30 active:bg-gray-300 active:border-gray-300 addSubDomain">
																					Add an Sub Assesment
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endwhile; 
													endif; ?>
												</div>
												<button quarteradd="3" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 addDomain">
													Add an Assesment
												</button>
											</div>
											<div class="tab-pane <?php if (get_field("active_campus_quarter","options") == 4){echo "block";}else{echo "hidden";} ?>" id="underline-icon-contact">
												<button quarter="4" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="open_all btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
													Open All Domains
												</button>
												<button quarter="4" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="close_all btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
													Close All Domains
												</button>
												<button quarter="4" gradebook="<?php echo $gradebook_ID; ?>" type="button" class="get_module_bank btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600" data-tw-toggle="modal" data-tw-target="#modal_id_4">
													Get Module From Bank
												</button>
												<div class="grid grid-cols-12 gap-5">
													<?php  if(have_rows('add_quarter_4_domains', $gradebook_ID)): 
														while(have_rows('add_quarter_4_domains', $gradebook_ID)): 
															the_row(); 
															$data_id_counter = get_row_index();	
															$quarter_4_percentage_counter = $quarter_4_percentage_counter + get_sub_field("domain_percentage");
															?>
															<div class="col-span-12">
																<div class="card dark:bg-zinc-800 dark:border-zinc-600">
																	<div class="card-body pb-0">
																		<table class="table table-editable table-nowrap align-middle table-edits-domain w-full text-left">
																			<thead>
																				<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																					<th class="p-3" style="color: #8f1537;">
																						Assesment Type
																					</th>
																					<th class="p-3" style="color: #8f1537;">
																						Quarterly Percentage
																					</th>
																					<th class="p-3">
																						Edit
																					</th>
																					<th class="p-3">
																						Delete
																					</th>
																				</tr>
																			</thead>
																			<tbody class="text-gray-600">
																				<tr quarter-id="4" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?>name">
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_name" data-field="domain_name"><?php echo get_sub_field("domain_name"); ?></td>
																					<td style="color: #d79a2a;" class="p-3 dark:text-zinc-100 domain_percentage quarter4" data-field="domain_percentage"><?php echo get_sub_field("domain_percentage"); ?></td>
																					<td class="p-3 dark:text-zinc-100" style="width: 100px;">
																						<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																							<i class="fas fa-pencil-alt" style="color: #d79a2a;"></i>
																						</a>
																					</td>
																					<td class="p-3 dark:text-zinc-100 to">
																						<button quarteradd="4" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_domain btn border-0 text-white px-5" style="background-color: #8f1537;">
																							<i class="mdi mdi-trash-can block text-lg"></i>
																							<span class="">Delete</span>
																						</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<div class="card-body">
																		<div class="table-responsive">
																			<table class="table table-editable table-nowrap align-middle table-edits w-full text-left">
																				<thead>
																					<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																						<th class="p-3">
																							Sub Assesment
																						</th>
																						<th class="p-3">
																							Percentage
																						</th>
																						<th class="p-3">
																							Rubric (Out of)
																						</th>
																						<th class="p-3">
																							From
																						</th>
																						<th class="p-3">
																							To
																						</th>
																						<th class="p-3">
																							Availability
																						</th>
																						<th class="p-3">
																							Edit
																						</th>
																						<th class="p-3">
																							Delete
																						</th>
																					</tr>
																				</thead>
																				<tbody class="text-gray-600">
																					<?php  if(have_rows('add_sub_domains')): 
																						while(have_rows('add_sub_domains')): 
																							the_row(); 
																							?>
																							<tr quarter-id="4" sub-domain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" class="border-b border-gray-50 dark:border-zinc-600 edit-table" data-id="<?php echo $data_id_counter; ?><?php echo get_row_index(); ?>">
																								<td class="p-3 dark:text-zinc-100 sub_domain_name" data-field="sub_domain_name"><?php echo get_sub_field("sub_domain_name"); ?></td>
																								<td class="p-3 dark:text-zinc-100 sub_domain_percentage" data-field="sub_domain_percentage"><?php echo get_sub_field("sub_domain_percentage"); ?></td>
																								<td class="p-3 dark:text-zinc-100 based_on" data-field="based_on"><?php echo get_sub_field("based_on"); ?></td>
																								<td class="p-3 dark:text-zinc-100 from" data-field="from"><?php echo get_sub_field("from"); ?></td>
																								<td class="p-3 dark:text-zinc-100 to" data-field="to"><?php echo get_sub_field("to"); ?></td>
																								<td class="p-3 dark:text-zinc-100 open_mode" data-field="open_mode"><?php echo get_sub_field("open_mode"); ?></td>
																								<td class="p-3 dark:text-zinc-100" style="width: 100px">
																									<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																										<i class="fas fa-pencil-alt"></i>
																									</a>
																								</td>
																								<td class="p-3 dark:text-zinc-100 to">
																									<button quarteradd="4" subdomain-id="<?php echo get_row_index(); ?>" domain-id="<?php echo $data_id_counter; ?>" type="button" class="delete_subdomain btn border-0 bg-red-400 text-white px-5">
																										<i class="mdi mdi-trash-can block text-lg"></i>
																										<span class="">Delete</span>
																									</button>
																								</td>
																							</tr>
																						<?php endwhile; 
																					endif; ?>
																				</tbody>
																			</table>
																			<div style="margin-top: 15px; display: flex; justify-content: end;">
																				<button quarteradd="4" domainId="<?php echo $data_id_counter; ?>" type="button" class="btn text-black bg-gray-100 border-gray-100 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-500/30 active:bg-gray-300 active:border-gray-300 addSubDomain">
																					Add an Sub Assesment
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endwhile; 
													endif; ?>
												</div>
												<button quarteradd="4" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 addDomain">
													Add an Assesment
												</button>
											</div>
										</div>
									</div>
								</div>						
							</div>					
						</div>  
					</div>

					<?php  
					for ($i=1; $i < 5; $i++) { 
						?>
						<div class="modal relative z-50 hidden" id="modal_id_<?php echo $i; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
							<div class="fixed inset-0 z-50 overflow-hidden">
								<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
								<div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
									<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700">
										<div class="bg-white dark:bg-zinc-600">
											<div class="sm:flex sm:items-start p-5" style="height: 50vh;">
												<div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
													<i class="mdi mdi-alert-outline me-2 text-xl text-red-500"></i>
												</div>
												<div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right">
													<h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
														Select Target Domain
													</h3>
													<div class="mt-2" style="width: 23vw;">
														<div class="col-span-12 lg:col-span-4">
															<div>
																<select id="definition_select_<?php echo $i; ?>" class="border-gray-100" data-trigger name="choices-single-default" placeholder="Search Module">
																	<option value="">Select</option>
																	<?php  
																	$all_groups_args = [
																		'post_type' 	=> 'definitions_function',
																		'numberposts'	=> -1
																	];
																	$all_groups = get_posts($all_groups_args);
																	foreach ($all_groups as $key => $value) {
																		?>
																		<option value="<?php echo $value->ID; ?>">
																			<?php echo $value->post_title; ?>
																		</option>
																		<?php 
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
												<button definition_bank_quarter="<?php echo $i; ?>" type="button" class="selected_definition btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">
													Get Module
												</button>
												<button type="button" class="popup_close btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php 
					}
					?>

					<?php 
				}else{
					echo access_denieded($current_user_id,'gradebook-definitions-edit','edit-module');
				}
			}else{
				echo access_denieded($current_user_id,'gradebook-definitions-edit','authorizations-edit');
			}
			?>
		</div>
	</div>
</div>
<style>
	.open_all{
		margin-bottom: 25px;
	}
	.close_all{
		margin-bottom: 25px;
	}
</style>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>
<!-- Table Editable plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/table-edits/build/table-edits.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/extra/moment.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/extra/pikaday.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>

<style>
	select{
		width: 100%;
	}
</style>
<script>

	$(document).ready(function(){

		$(".selected_definition").click(function(){
			definition_bank_quarter = $(this).attr("definition_bank_quarter");
			definition_select_id = $("#definition_select_"+definition_bank_quarter).val();
			gradebookID = <?php echo $gradebook_ID; ?>;

			Swal.fire({
				title: "Are you sure?",
				text: "You will be changing definition for this quarter and you can't take it back!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_chance_definition',
							definition_bank_quarter:definition_bank_quarter,
							definition_select_id:definition_select_id,
							gradebookID:gradebookID,
						}),
						success: function(data){
							Swal.fire({
								title: 'Success!',
								text: 'You just change the definition.',
								icon: 'success',
								confirmButtonColor: '#5156be',
							}).then(/*$('.popup_close').click()*/).then(
								function (result){
									if (result.value) {
										console.log(data);
										location.reload();
									}
								}
								);
						}
					});

				}else{
					Swal.fire({
						title: 'Cancelled',
						text: 'Your definition is did not change :)',
						icon: 'error',
						confirmButtonColor: '#5156be',
					});
				}

			});


		});


		$(".open_all").click(function(){
			quarter_id_open = $(this).attr("quarter");
			gradebook_id_open = $(this).attr("gradebook");
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_update_gradebook_open',

					quarter_id_open:quarter_id_open,
					gradebook_id_open:gradebook_id_open,

				}),
				success: function(data){
					location.reload();
				}

			});
		});
		$(".close_all").click(function(){
			quarter_id_open = $(this).attr("quarter");
			gradebook_id_open = $(this).attr("gradebook");
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_update_gradebook_close',

					quarter_id_open:quarter_id_open,
					gradebook_id_open:gradebook_id_open,

				}),
				success: function(data){
					//console.log(data);
					location.reload();
				}

			});
		});


		percentage_quarter1_counter = <?php echo $quarter_1_percentage_counter; ?>;
		percentage_quarter1 = document.getElementById("percentage_quarter1");
		percentage_quarter1.innerHTML = ""+percentage_quarter1_counter+"";
		if (percentage_quarter1_counter > 100) {
			$("#percentage_quarter1").css("color","red");
		}

		percentage_quarter2_counter = <?php echo $quarter_2_percentage_counter; ?>;
		percentage_quarter2 = document.getElementById("percentage_quarter2");
		percentage_quarter2.innerHTML = ""+percentage_quarter2_counter+"";
		if (percentage_quarter2_counter > 100) {
			$("#percentage_quarter2").css("color","red");
		}

		percentage_quarter3_counter = <?php echo $quarter_3_percentage_counter; ?>;
		percentage_quarter3 = document.getElementById("percentage_quarter3");
		percentage_quarter3.innerHTML = ""+percentage_quarter3_counter+"";
		if (percentage_quarter3_counter > 100) {
			$("#percentage_quarter3").css("color","red");
		}

		percentage_quarter4_counter = <?php echo $quarter_4_percentage_counter; ?>;
		percentage_quarter4 = document.getElementById("percentage_quarter4");
		percentage_quarter4.innerHTML = ""+percentage_quarter4_counter+"";
		if (percentage_quarter4_counter > 100) {
			$("#percentage_quarter4").css("color","red");
		}



		function isInt(value) {
			return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
		}


		/* Delete Sub Domain */
		$(".delete_subdomain").click(function(){
			gradebookID = <?php echo $gradebook_ID; ?>;
			quarteradd = $(this).attr("quarteradd");
			domainId = $(this).attr("domain-id");
			subDomainId = $(this).attr("subdomain-id");

			console.log(gradebookID);
			console.log(quarteradd);
			console.log(domainId);
			console.log(subDomainId);

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_delete_subdomain',

					gradebookID:gradebookID,
					quarteradd:quarteradd,
					domainId:domainId,
					subDomainId:subDomainId,

				}),
				success: function(data){
					location.reload();
					console.log(data.data);
				}

			});
		});


		/* Sub Domain */
		$(".addSubDomain").click(function(){
			gradebookID = <?php echo $gradebook_ID; ?>;
			quarteradd = $(this).attr("quarteradd");
			domainId = $(this).attr("domainId");

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_add_sub_domain',

					gradebookID:gradebookID,
					domainId:domainId,
					quarteradd:quarteradd,

				}),
				success: function(data){
					location.reload();
				}

			});
		});

		/* Delete Domain */
		$(".delete_domain").click(function(){
			gradebookID = <?php echo $gradebook_ID; ?>;
			quarteradd = $(this).attr("quarteradd");
			domainId = $(this).attr("domain-id");

			console.log(gradebookID);
			console.log(quarteradd);
			console.log(domainId);

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_delete_domain',

					gradebookID:gradebookID,
					quarteradd:quarteradd,
					domainId:domainId,

				}),
				success: function(data){
					location.reload();
					console.log(data);
				}

			});
		});

		/* Domain */
		$(".addDomain").click(function(){
			gradebookID = <?php echo $gradebook_ID; ?>;
			quarteradd = $(this).attr("quarteradd");
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_add_domain',

					gradebookID:gradebookID,
					quarteradd:quarteradd,

				}),
				success: function(data){
					if (isInt(data.data)) {
						location.reload();
					}
				}

			});
		});


	});

function pointsave(e){

	domainID = $(e).attr("domain-id");
	quarterID = $(e).attr("quarter-id");
	subDomainID = $(e).attr("sub-domain-id");
	sub_domain_name = $(e).find(".sub_domain_name").text();
	sub_domain_percentage = $(e).find(".sub_domain_percentage").text();
	based_on = $(e).find(".based_on").text();
	from = $(e).find(".from").text();
	to = $(e).find(".to").text();
	open_mode = $(e).find(".open_mode").text();
	gradebookID = <?php echo $gradebook_ID; ?>;
	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_update_gradebook',

			domainID:domainID,
			subDomainID:subDomainID,
			sub_domain_name:sub_domain_name,
			sub_domain_percentage:sub_domain_percentage,
			based_on:based_on,
			from:from,
			to:to,
			open_mode:open_mode,
			gradebookID:gradebookID,
			quarterID:quarterID,

		}),
		success: function(data){
			console.log(data);
		}

	});

}


	/* Domain Save Function */
function domainSave(e){
	domainID = $(e).attr("domain-id");
	quarterID = $(e).attr("quarter-id");
	domain_name = $(e).find(".domain_name").text();
	domain_percentage = $(e).find(".domain_percentage").text();
	gradebookID = <?php echo $gradebook_ID; ?>;

	var value = $.ajax({
		method: "POST",
		url: get_site_url+'/wp-admin/admin-ajax.php',
		data: ({action:'my_ajax_update_domain',

			domainID:domainID,
			gradebookID:gradebookID,
			quarterID:quarterID,

			domain_name:domain_name,
			domain_percentage:domain_percentage,

		}),
		success: function(data){
			console.log(data);
			updateDomainFrontTotal(quarterID);
		}

	});
}

function updateDomainFrontTotal(quarterID){
	assesmentCounter = $(".quarter"+quarterID);
	quarterToplam = 0;
	for (var i = assesmentCounter.length - 1; i >= 0; i--) {
		quarterToplam = quarterToplam + parseInt($(".quarter"+quarterID)[i].textContent);
	}
	if (quarterToplam > 100) {
		alert("Total over 100 percent");
		$("#percentage_quarter"+quarterID).css("color","red");
	}else{
		$("#percentage_quarter"+quarterID).css("color","#244b5a");
	}
		//percentage_quarter1
	percentage_quarter = document.getElementById("percentage_quarter"+quarterID);
	percentage_quarter.innerHTML = ""+quarterToplam+"";
}



$(function () {
	var pickers = {};
	$('.table-edits tr').editable({
		dropdowns: {
			open_mode: ['Open', 'Close']
		},

		edit: function (values) {
			$(".edit i", this)
			.removeClass('fa-pencil-alt')
			.addClass('fa-save')
			.attr('title', 'Save');
			pickers[this] = new Pikaday({
				field: $("td[data-field=from] input", this)[0],
				format: 'D MMM, YYYY'
			});
			pickers[this] = new Pikaday({
				field: $("td[data-field=to] input", this)[0],
				format: 'D MMM, YYYY'
			});
		},
		save: function (values) {
			$(".edit i", this)
			.removeClass('fa-save')
			.addClass('fa-pencil-alt')
			.attr('title', 'Edit');

			if (this in pickers) {
				pickers[this].destroy();
				delete pickers[this];
			}
			pointsave(this);
		},
		cancel: function (values) {
			$(".edit i", this)
			.removeClass('fa-save')
			.addClass('fa-pencil-alt')
			.attr('title', 'Edit');

			if (this in pickers) {
				pickers[this].destroy();
				delete pickers[this];
			}
		}
	});
});



$(function () {
	var pickers = {};
	$('.table-edits-domain tr').editable({

		edit: function (values) {
			$(".edit i", this)
			.removeClass('fa-pencil-alt')
			.addClass('fa-save')
			.attr('title', 'Save');

		},
		save: function (values) {
			$(".edit i", this)
			.removeClass('fa-save')
			.addClass('fa-pencil-alt')
			.attr('title', 'Edit');

			if (this in pickers) {
				pickers[this].destroy();
				delete pickers[this];
			}
			domainSave(this);
		},
		cancel: function (values) {
			$(".edit i", this)
			.removeClass('fa-save')
			.addClass('fa-pencil-alt')
			.attr('title', 'Edit');

			if (this in pickers) {
				pickers[this].destroy();
				delete pickers[this];
			}
		}
	});
});


</script>


