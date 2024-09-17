<?php /* Template Name: PDP Settings */ ?>
<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="col-span-12 xl:col-span-12">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body flex flex-wrap">
						<div class="nav-tabs border-b-tabs" style="width: 100%;">
							<ul class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-home" class="inline-block p-4">
										PDP Select Countent Groups
									</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-Profile" class="inline-block p-4 active ">
										PDP Comment Groups
									</a>
								</li>
							</ul>

							<div class="mt-5 tab-content">
								<div class="tab-pane hidden" id="underline-home">
									<div class="card dark:bg-zinc-800 dark:border-zinc-600">
										<div class="card-body ">
											<div data-tw-accordion="collapse">
												<?php  if(have_rows('add_pdp_content_group', 'options')): 
													while(have_rows('add_pdp_content_group', 'options')): 
														the_row(); 
														$general_group_id = get_row_index();
														?>
														<div class="accordion-item text-gray-700">
															<h2>
																<button type="button" class="accordion-header group flex border-b border-gray-100 dark:border-b-zinc-600 items-center justify-between w-full p-3 font-medium text-left rounded-t-lg">
																	<span class="text-15">
																		<?php echo get_sub_field("group_name"); ?>
																	</span>
																	<i class="mdi mdi-chevron-down text-2xl group-[.active]:rotate-180"></i>
																</button>
															</h2>

															<div class="accordion-body hidden">
																<div class="p-5 font-light">
																	<button style="margin-bottom: 10px;" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600" data-tw-toggle="modal" data-tw-target="#set-classes-<?php echo $general_group_id; ?>">
																		Set Group For Class
																	</button>
																	<div class="relative overflow-x-auto">
																		<table class="w-full text-sm text-left text-gray-500 ">
																			<thead class="text-sm text-gray-700 dark:text-gray-100">
																				<tr class="border border-gray-50 dark:border-zinc-600">
																					<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																						#
																					</th>
																					<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																						Comment
																					</th>
																					<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																						Delete
																					</th>
																				</tr>
																			</thead>
																			<tbody comment_group_id="<?php echo $general_group_id; ?>">

																				<?php  if(have_rows('add_group_field', 'options')): 
																					while(have_rows('add_group_field', 'options')): 
																						the_row(); 
																						$general_comment_id = get_row_index();
																						?>
																						<tr delete_comment="<?php echo $general_group_id; ?>_<?php echo $general_comment_id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																							<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																								<?php echo get_row_index(); ?>
																							</th>
																							<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																								<?php echo get_sub_field("comment"); ?>
																							</td>
																							<td group_id="<?php echo $general_group_id; ?>" commnet_id="<?php echo $general_comment_id; ?>" style="text-align: center;" class="delete_comment px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																								<button type="button" class="btn border-0 bg-red-400 text-white px-5"><i class="mdi mdi-trash-can block text-lg"></i>
																									<span class="">Delete</span>
																								</button>
																							</td>
																						</tr>
																					<?php endwhile; 
																				endif; ?>
																			</tbody>
																		</table>
																		<div class="mt-3 w-full">
																			<input style="width: 77%;" class="rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text">
																			<button group_id="<?php echo $general_group_id; ?>" commnet_id="<?php echo $general_comment_id; ?>" style="width: 22%;" type="button" class="add_comment_to_list btn border-0 bg-green-600 text-white px-5">
																				<i class="mdi mdi-pencil block text-lg"></i>
																				<span class="">
																					Edit
																				</span>
																			</button>
																		</div>

																	</div>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="set-classes-<?php echo $general_group_id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-y-auto">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
																<div class="animate-translate p-4 sm:max-w-lg mx-auto">
																	<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
																		<div class="bg-white dark:bg-zinc-700">
																			<button type="button" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
																				<i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
																			</button>
																			<div class="p-5">
																				<h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
																					Please Select Class And Quarter
																				</h3>
																				<div class="mb-4">
																					<div class="mb-3">
																						<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																							Classes
																						</label>
																						<select selected_class="<?php echo $general_group_id; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																							<?php 
																							$args = array(
																								'post_type' => 'user_groups',
																								'meta_key' => 'sub_class', 
																								'meta_value' => 'No',
																								'meta_compare' => '=', 
																							);
																							$my_posts = new WP_Query($args);
																							if ($my_posts->have_posts()) {
																								while ($my_posts->have_posts()) {
																									$my_posts->the_post();
																									$categoryID = get_the_id(); 
																									?>
																									<option value="<?php echo $categoryID; ?>">
																										<?php echo get_the_title(); ?>
																									</option>
																									<?php 
																								}
																							}else{
																								echo "There is no group";
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="mb-4">
																					<div class="mb-3">
																						<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																							Quarter
																						</label>
																						<select selected_quarter="<?php echo $general_group_id; ?>" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
																							<option value="1">1</option>
																							<option value="2">2</option>
																							<option value="3">3</option>
																							<option value="4">4</option>
																						</select>
																					</div>
																				</div>
																				<div class="mb-4">
																					<button set_group_id="<?php echo $general_group_id; ?>" type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																						Set Class PDP Selection Settings
																					</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php endwhile; 
												endif; ?>
											</div>
										</div>
									</div>
									<input style="min-width: 250px;" class="group_name_input rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="group name">
									<button type="button" class="create_comment_group btn rounded-full text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
										New Comment Group
									</button>
								</div>
								<div class="tab-pane block" id="underline-Profile">
									<div class="card-body ">
										<div data-tw-accordion="collapse">
											<?php  
											if(have_rows('add_pdp_comments_group', 'options')): 
												while(have_rows('add_pdp_comments_group', 'options')): 
													the_row(); 
													?>
													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex border-b border-gray-100 dark:border-b-zinc-600 items-center justify-between w-full p-3 font-medium text-left">
																<span class="text-15">
																	<?php echo get_sub_field("group_name"); ?>
																</span>
																<i class="mdi mdi-chevron-down text-2xl group-[.active]:rotate-180"></i>
															</button>
														</h2>
														<div class="accordion-body hidden">
															<table class="w-full text-sm text-left text-gray-500 ">
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			#
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Comment
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Delete
																		</th>
																	</tr>
																</thead>
																<tbody>
																	<?php  
																	if(have_rows('add_comment')): 
																		while(have_rows('add_comment')): 
																			the_row(); 
																			?>
																			<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																				<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																					<?php echo get_row_index(); ?>
																				</th>
																				<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<?php echo get_sub_field("comment") ?>
																				</td>
																				<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<button type="button" class="btn border-0 bg-red-400 text-white px-5">
																						<i class="mdi mdi-trash-can block text-lg"></i>
																						<span class="">
																							Delete
																						</span>
																					</button>
																				</td>
																			</tr>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<?php 
												endwhile; 
											endif;
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-span-12 xl:col-span-6">

			</div>

		</div>
	</div>
</div>



<style>
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
		$("#header_title").text("PDP Settings");
		function isInt(value) {
			return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
		}

		$(".create_comment_group").click(function(){
			group_name_input = $(".group_name_input").val();
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_create_comment_group',
					group_name_input:group_name_input,
				}),
				success: function(data){
					if (isInt(data.data)) {
						location.reload();
					}
				}

			});
		});

		$("[set_group_id]").click(function(){
			set_group_id = $(this).attr("set_group_id");
			selected_class = $("[selected_class='"+set_group_id+"']").val();
			selected_quarter = $("[selected_quarter='"+set_group_id+"']").val();

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_set_class_pdp_selectable',

					set_group_id:set_group_id,
					selected_class:selected_class,
					selected_quarter:selected_quarter,

				}),
				success: function(data){
					console.log(data.data);
					if (isInt(data.data)) {
						Swal.fire(
						{
							title: 'Done',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						);
					}
				}

			});

		});

		$(".delete_comment").click(function(){
			group_id = $(this).attr("group_id");
			commnet_id = $(this).attr("commnet_id");

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_pdp_delete_comment_domain',

					group_id:group_id,
					commnet_id:commnet_id,

				}),
				success: function(data){
					if (data.data == true) {
						Swal.fire(
						{
							title: 'Done',
							text: 'Your Comment deleted',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						);
						delete_dom = $('[delete_comment="'+group_id+'_'+commnet_id+'"]');
						delete_dom.remove();
					}
				}

			});

		});

		$(".add_comment_to_list").click(function(){
			new_comment = $(this).prev("input").val();
			new_comment_group_id = $(this).attr("group_id");
			new_comment_commnet_id = $(this).attr("commnet_id");

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_pdp_add_comment_domain',

					new_comment:new_comment,
					new_comment_group_id:new_comment_group_id,

				}),
				success: function(data){
					if (isInt(data.data)) {
						console.log(data.data);
						Swal.fire(
						{
							title: 'New Comment added',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						);
						$('[comment_group_id="'+new_comment_group_id+'"]')[0].innerHTML += '<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent"><th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">'+data.data+'</th><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">'+new_comment+'</td></tr>';
					}
				}

			});

		});

	});
</script>
