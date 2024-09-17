<?php /* Template Name: Sub Classes */ ?>
<?php get_header(); ?>
<?php $current_user_now = wp_get_current_user(); ?>
<?php $current_user_id = get_current_user_id(); ?>
<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						Sub Classes
					</h4>
				</div>
			</div>

			<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">

				<?php 

				if (get_user_access_write("see-all-classes")) {
				$args = array(
					'posts_per_page' => -1,  
					'post_type' => 'user_groups',
					'meta_key' => 'sub_class', 
					'meta_value' => 'Yes',
					'meta_compare' => '=', 
				);

				}

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
						<a href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo get_the_id(); ?>" class="col-span-12 xl:col-span-3">
							<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="padding-top: 10px;">
								<img style="margin: auto; max-width: 225px;" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
								<div class="card-body">
									<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
										<?php echo get_the_title(); ?>
									</h6>
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
				?>

			</div>



		</div>
	</div>
</div>



<?php get_footer(); ?>