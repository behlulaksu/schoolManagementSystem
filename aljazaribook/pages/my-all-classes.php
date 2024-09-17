<?php /* Template Name: My All Classes */ ?>
<?php get_header(); ?>


<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">My All Classes</h4>
				</div>
			</div>
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">

				<?php 
				$args = array(
					'post_type' => 'newClass_add',
				);
				$my_posts = new WP_Query($args);
				if ($my_posts->have_posts()) {
					while ($my_posts->have_posts()) {
						$my_posts->the_post();
						$categoryID = get_the_id(); 
						/************************************/  
						$queryForPostTypeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),$size = 'full' );
						?>
						<a href="<?php echo get_site_url(); ?>/class-detail?classid=<?php echo get_the_id(); ?>" class="col-span-12 xl:col-span-3">
							<div class="card dark:bg-zinc-800 dark:border-zinc-600">
								<img style="margin: auto; max-width: 225px;" class="rounded" src="<?php echo $queryForPostTypeImage[0]; ?>" alt="">
								<div class="card-body">
									<h6 style="text-align: center;" class="mb-1 text-15 text-gray-700 dark:text-gray-100">
										<?php echo get_the_title(); ?>
									</h6>
								</div>
							</div>
						</a>
						<?php 
					}
				}else{
					echo "Eklenmis Sinif Bulunamadi";
				}
				wp_reset_query();
				?>

			</div>

		</div>
	</div>
</div>




<?php get_footer(); ?>
