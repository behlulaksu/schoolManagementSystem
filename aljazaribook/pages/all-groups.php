<?php /* Template Name: All Groups */ ?>
<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						All Class
					</h4>
					<form class="app-search xl:block">
						<div class="relative inline-block">
							<input id="searchInput" type="text" class="bg-gray-50/30 dark:bg-zinc-700/50 border-0 rounded focus:ring-0 placeholder:text-sm px-4 dark:placeholder:text-gray-200 dark:text-gray-100 dark:border-zinc-700 " placeholder="Search...">
						</div>
					</form>
				</div>
			</div>

			<div class="grid grid-cols-12 lg:grid-cols-12 gap-5 mt-5" id="itemList">

				<?php 
				if ($current_user_now->roles[0] === 'teacher') {
					$args = array(
						'post_type' => 'user_groups',
						'meta_query' => array(
							array(
								'key' => 'group_admin',
								'value' => get_current_user_id(),
								'compare' => 'LIKE',
							)
						)
					);

					$my_posts = new WP_Query($args);
					if ($my_posts->have_posts()) {
						while ($my_posts->have_posts()) {
							$my_posts->the_post();
							$categoryID = get_the_id(); 
							/************************************/  
							$group_image = get_field('gru',$categoryID);
							if (empty($group_image)) {
								$group_image['url'] = get_template_directory_uri()."/indir.png";
							}
							?>
							<a href="<?php echo get_site_url(); ?>/my-subjects?group=<?php echo get_the_id(); ?>" class="col-span-6 xl:col-span-3">
								<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="padding-top: 10px;">
									<img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
									<div class="card-body">
										<h5 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
											<?php echo get_the_title(); ?>
										</h5>
									</div>
									<div>
										<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
											Addede Student : 
											<?php 
											$group_users = get_field('group_users',$categoryID);
											//echo count($group_users);
											if (!empty($group_users)) {
												print_r(count($group_users));
											}

											?>
										</h6>
									</div>
								</div>
							</a>
							<?php 
						}
					}else{
						echo "There is no group";
					}
					wp_reset_query();
				}elseif($current_user_now->roles[0] === 'pdp'){
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
							/************************************/  
							$group_image = get_field('gru',$categoryID);
							if (empty($group_image)) {
								$group_image['url'] = get_template_directory_uri()."/indir.png";
							}
							?>
							<a href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo get_the_id(); ?>" class="col-span-6 xl:col-span-3">
								<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="padding-top: 10px;">
									<img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
									<div class="card-body">
										<h5 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
											<?php echo get_the_title(); ?>
										</h5>
									</div>
									<div>
										<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
											Addede Student : 
											<?php 
											$group_users = get_field('group_users',$categoryID);
											//echo count($group_users);
											if (!empty($group_users)) {
												print_r(count($group_users));
											}

											?>
										</h6>
									</div>
								</div>
							</a>
							<?php 
						}
					}else{
						echo "There is no group";
					}
					wp_reset_query();
				}else{

					/* yetki kontrol baslangic */
					if (get_user_access_read("see-all-classes")) {
						$args = array(
							'post_type' => 'user_groups',
							'meta_query' => array(
								array(
									'key' => 'group_admin',
									'value' => get_current_user_id(),
									'compare' => 'LIKE',
								)
							)
						);

						if (get_user_access_write("see-all-classes")) {

							$args = array(
								'post_type' => 'user_groups',
								'meta_key' => 'sub_class', 
								'orderby' => 'Yes',   
								'order' => 'ASC',   
							);


							// $args = array(
							// 	'post_type' => 'user_groups',
							// 	'meta_key' => 'sub_class', 
							// 	'meta_value' => 'No',
							// 	'meta_compare' => '=', 
							// );


						}

						// if ($current_user_now->roles[0] === 'hod' || $current_user_now->roles[0] === 'principal' || $current_user_now->roles[0] === 'viceprincipal') {
						// 	$args = array(
						// 		'post_type' => 'user_groups',
						// 		'meta_query' => array(
						// 			array(
						// 				'key' => 'group_admin',
						// 				'value' => get_current_user_id(),
						// 				'compare' => 'LIKE',
						// 			)
						// 		)
						// 	);
						// }
						$my_posts = new WP_Query($args);
						if ($my_posts->have_posts()) {
							while ($my_posts->have_posts()) {
								$my_posts->the_post();
								$categoryID = get_the_id(); 
								/************************************/  
								$group_image = get_field('gru',$categoryID);
								if (empty($group_image)) {
									$group_image['url'] = get_template_directory_uri()."/indir.png";
								}
								?>
								<a href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo get_the_id(); ?>" class="col-span-6 xl:col-span-3">
									<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="padding-top: 10px;">
										<img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
										<div class="card-body">
											<h5 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
												<?php echo get_the_title(); ?>
											</h5>
										</div>
										<div>
											<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
												Addede Student : 
												<?php 
												$group_users = get_field('group_users',$categoryID);
											//echo count($group_users);
												if (!empty($group_users)) {
													print_r(count($group_users));
												}

												?>
											</h6>
										</div>
									</div>
								</a>
								<?php 
							}
						}else{
							echo "There is no class";
						}
					}else{
						echo access_denieded($current_user_id,'all-groups','see-all-classes');
					}

					/* yetki kontrol bitis */

					wp_reset_query();

				}


				?>

			</div>



		</div>
	</div>
</div>



<?php get_footer(); ?>

<script>
	const searchInput = document.getElementById('searchInput');
	const itemList = document.getElementById('itemList');
	const items = itemList.getElementsByTagName('h5');

	searchInput.addEventListener('input', function() {
		const query = searchInput.value.toLowerCase();

		for (let i = 0; i < items.length; i++) {
			const itemText = items[i].textContent.toLowerCase();
			if (itemText.includes(query)) {
				parentElement = findParentByTagName(items[i], 'a');
				parentElement.style.display = 'block';
			} else {
				parentElement = findParentByTagName(items[i], 'a');
				parentElement.style.display = 'none';
			}
		}
	});


	function findParentByTagName(element, tagName) {
		while (element) {
			element = element.parentNode;
			if (element && element.tagName && element.tagName.toLowerCase() === tagName.toLowerCase()) {
				return element;
			}
		}
		return null;
	}
</script>



<style>
	.main-content h5{
		text-align: center;
		color: #8e1838 !important;
		font-weight: bold;
	}
	.main-content h6{
		text-align: center;
		color: #e0b35c !important;
		font-weight: bold;
	}
	.class_image{
		margin: auto; max-width: 225px;
	}
	@media only screen and (max-width: 600px) {
		.class_image{
			margin: auto; max-width: 125px;
		}
	}
</style>