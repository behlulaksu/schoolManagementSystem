<?php /* Template Name: Authorizations Edit */ ?>
<?php 
if (isset($_GET['user'])){
	$get_user_id = strip_tags($_GET["user"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$get_user_data = get_user_by('id',$get_user_id);
?>

<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/assets/extra/editabletable.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<?php $current_user_edit_meta = get_user_meta($get_user_id); ?>
<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?> - <?php echo $current_user_edit_meta['first_name'][0]; ?> <?php echo $current_user_edit_meta['last_name'][0]; ?>
					</h4>
				</div>
			</div>


			<div class="card-body flex flex-wrap">
				<div class="nav-tabs tab-pill" style="width: 100% !important;">
					<ul class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500">
						<?php
						$categories = get_categories();
						$tabClass = "active";
						foreach ($categories as $category) {
							if ($category->slug != "uncategorized") {
								
								if ($category->slug === "users-category-slug") {
									$tabClass = "active";
								}else{
									$tabClass = "";
								}
								?>
								<li>
									<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-<?php echo $category->slug; ?>" class="inline-block px-4 py-3 rounded-md <?php echo $tabClass; ?>">
										<?php echo $category->name; ?>
									</a>
								</li>
								<?php
							}
						}


						?>
					</ul>
					<style>
						.table-edits input{
							width: 100% !important;
						}
						.kutular{
							border: 1px solid;
						}
					</style>
					<div class="tab-content mt-5">
						<?php
						$tabClass = "hidden";
						foreach ($categories as $category) {
							if ($category->slug != "uncategorized") {
								if ($category->slug === "users-category-slug") {
									$tabClass = "block";
								}else{
									$tabClass = "hidden";
								}
								?>
								<div class="tab-pane <?php echo $tabClass; ?>" id="tab-<?php echo $category->slug; ?>">
									<div class="grid grid-cols-12 gap-5">
										<div class="col-span-12">
											<div class="card dark:bg-zinc-800 dark:border-zinc-600">
												<div class="card-body pb-0">
													<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
														<?php echo $category->name; ?>
													</h6>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-edits table-nowrap align-middle table-edits w-full text-left">
															<thead>
																<tr class="border-b border-gray-50 text-gray-700 dark:text-gray-100 dark:border-zinc-600">
																	<th class="p-3">ID</th>
																	<th class="p-3">Name</th>
																	<th class="p-3">Read</th>
																	<th class="p-3">Write</th>
																	<th class="p-3">Delete</th>
																	<th class="p-3">Edit</th>
																</tr>
															</thead>
															<tbody class="text-gray-600">
																<?php

																$args = array(
																	'category_name' => $category->slug,
																	'post_type' => 'author_functions', 
																	'posts_per_page' => -1, //-1 yap bunu bana 
																);
																$custom_query = new WP_Query($args);
																if ($custom_query->have_posts()) :
																	while ($custom_query->have_posts()) : $custom_query->the_post();
																		?>
																		<tr class="border-b border-gray-50 dark:border-zinc-600" data-id="<?php echo get_the_id(); ?>">
																			<td class="p-3 dark:text-zinc-100" style="width: 80px"><?php echo get_the_id(); ?></td>
																			<td class="p-3 dark:text-zinc-100"><?php echo get_the_title(); ?></td>

																			<?php  
																			$read_author = get_field("read", get_the_id());
																			if (!empty($read_author)) {
																				if (in_array($get_user_id, $read_author)) {
																					?>
																					<td style="color:white; background-color: green;" read class="p-3 dark:text-zinc-100 kutular" sections-type="read" data-field="gender">Open</td>
																					<?php 
																				}else{
																					?>
																					<td style="color:white; background-color: red;" read class="p-3 dark:text-zinc-100 kutular" sections-type="read" data-field="gender">Close</td>
																					<?php 
																				}
																			}else{
																				?>
																				<td style="color:white; background-color: red;" read class="p-3 dark:text-zinc-100 kutular" sections-type="read" data-field="gender">Close</td>
																				<?php 
																			}


																			$write_users = get_field("write_users", get_the_id());
																			if (!empty($write_users)) {
																				if (in_array($get_user_id, $write_users)) {
																					?>
																					<td style="color:white; background-color: green;" write class="p-3 dark:text-zinc-100 kutular" sections-type="write" data-field="gender">Open</td>
																					<?php 
																				}else{
																					?>
																					<td style="color:white; background-color: red;" write class="p-3 dark:text-zinc-100 kutular" sections-type="write" data-field="gender">Close</td>
																					<?php 
																				}
																			}else{
																				?>
																				<td style="color:white; background-color: red;" write class="p-3 dark:text-zinc-100 kutular" sections-type="write" data-field="gender">Close</td>
																				<?php 
																			}


																			$delete_users = get_field("delete", get_the_id());
																			if (!empty($delete_users)) {
																				if (in_array($get_user_id, $delete_users)) {
																					?>
																					<td style="color:white; background-color: green;" delete class="p-3 dark:text-zinc-100 kutular" sections-type="delete" data-field="gender">Open</td>
																					<?php 
																				}else{
																					?>
																					<td style="color:white; background-color: red;" delete class="p-3 dark:text-zinc-100 kutular" sections-type="delete" data-field="gender">Close</td>
																					<?php 
																				}
																			}else{
																				?>
																				<td style="color:white; background-color: red;" delete class="p-3 dark:text-zinc-100 kutular" sections-type="delete" data-field="gender">Close</td>
																				<?php 
																			}
																			?>


																			<td class="p-3 dark:text-zinc-100" style="width: 100px">
																				<a class="btn btn-outline-secondary btn-sm edit" title="Edit">
																					<i class="fas fa-pencil-alt"></i>
																				</a>
																			</td>
																		</tr>
																		<?php 
																	endwhile;
																endif;
																wp_reset_postdata();
																?>



															</tbody>
														</table>
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
					</div>
				</div>
			</div>



		</div>
	</div>
</div>




<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>
<!-- Table Editable plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/table-edits/build/table-edits.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/extra/moment.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/extra/pikaday.js"></script>
<style>
	select{
		width: 100%;
	}
</style>


<script>

	$(function () {
		var pickers = {};
		$('.table-edits tr').editable({
			dropdowns: {
				gender: ['Open', 'Close']
			},
			
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


	function pointsave(e){
		secili = e;

		yetki_post_id = secili.children[0].textContent;
		read_sonuc = secili.children[2].textContent;
		write_sonuc = secili.children[3].textContent;
		delete_sonuc = secili.children[4].textContent;
		user_id = <?php echo $get_user_id; ?>


		read_user = secili.children[2].textContent;
		if (read_user === "Close") {
			secili.children[2].style.backgroundColor = "red";
		}else if(read_user === "Open"){
			secili.children[2].style.backgroundColor = "green";
		}

		read_user = secili.children[3].textContent;
		if (read_user === "Close") {
			secili.children[3].style.backgroundColor = "red";
		}else if(read_user === "Open"){
			secili.children[3].style.backgroundColor = "green";
		}

		read_user = secili.children[4].textContent;
		if (read_user === "Close") {
			secili.children[4].style.backgroundColor = "red";
		}else if(read_user === "Open"){
			secili.children[4].style.backgroundColor = "green";
		}



		var value = $.ajax({
			method: "POST",
			url: get_site_url+'/wp-admin/admin-ajax.php',
			data: ({action:'my_ajax_authorization_update',

				yetki_post_id:yetki_post_id,
				read_sonuc:read_sonuc,
				write_sonuc:write_sonuc,
				delete_sonuc:delete_sonuc,
				user_id:user_id,

			}),
			success: function(data){
				console.log(data);
			}

		});


	}
</script>