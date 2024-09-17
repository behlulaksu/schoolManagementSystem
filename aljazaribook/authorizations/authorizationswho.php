<?php /* Template Name: Authorization Who */ ?>
<?php get_header(); ?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						Authorization Pages
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
																	<th class="p-3">Users</th>
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
																			<td class="p-3 dark:text-zinc-100">
																				<?php 
																				$all_read_users = get_field("read",get_the_id()); 
																				foreach ($all_read_users as $key => $value) {
																					$user_data = get_userdata($value);
																					if ($user_data) {
																						$user_email = $user_data->user_email;
																						?>
																						<a target="_Blank" href="<?php echo get_site_url(); ?>/authorizations-edit?user=<?php echo $value; ?>">
																							<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																								<?php echo $user_email; ?>
																							</button>
																						</a>
																						<?php 
																					}
																				}
																				?>	
																			</td>
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












<?php get_footer(); ?>