<?php /* Template Name: Student Home */ ?>
<?php include 'header.php';?>
<div class="page-content dark:bg-zinc-700">
	<div class="container-fluid px-[0.625rem]">
<!-- 		<div class="grid grid-cols-1 mb-5">
			<div class="flex items-center justify-between">
				<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
					Stundet Dashboard
				</h4>
			</div>
		</div> -->
		<!-- main content start -->
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5" id="itemList">

			<?php  
			$args = array(
				'post_type' => 'user_groups',
				'meta_query' => array(
					array(
						'key' => 'group_users',
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
					<a href="<?php echo get_site_url(); ?>/student-class-detail?group=<?php echo get_the_id(); ?>" class="col-span-12 xl:col-span-3">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="padding-top: 10px;">
							<img style="margin: auto; max-width: 225px;" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
							<div class="card-body">
								<h5 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
									<?php echo get_the_title(); ?>
								</h5>
							</div>
						</div>
					</a>
					<?php 
				}
			}else{
				echo "There is no group";
			}
			wp_reset_query();
			?>

		</div>
		<!-- main content end -->
	</div>
</div>
<?php include 'footer.php';?>
