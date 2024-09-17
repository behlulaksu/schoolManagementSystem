<?php /* Template Name: Report Card */ ?>
<?php get_header(); ?>
<?php 


if (isset($_GET['user'])){
	$student = strip_tags($_GET["user"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}

if (isset($_GET['calisma'])){
	$calisma = strip_tags($_GET["calisma"]); 
}


$blog_id = get_current_blog_id();
$get_user_data = get_user_meta($student);
/**************************************************************/
$bg_table_name = "student_avarages";
$query = $wpdb->prepare("SELECT * from $bg_table_name where bloog_id =".$blog_id." and student_id = ".$student."" );
$sonuclar1 = $wpdb->get_results($query);
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center;">
						Student Academic Records - <?php echo $get_user_data['first_name'][0]; ?> <?php echo $get_user_data['last_name'][0]; ?>
					</h4>
				</div>
			</div>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					

					<div class="card-body"> 
						<div class="relative overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-500 ">
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr class="border border-gray-50 dark:border-zinc-600">
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 1
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 2
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 3
										</th>
										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 4
										</th>
									</tr>
								</thead>
								<tbody>

									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php  
											foreach ($sonuclar1 as $key => $value) {
												if ($value->quarter_id == 1) {
													echo "<br>";
													echo $value->id;
													echo "<br>";
													?>
													<a href="<?php echo get_site_url(); ?>/edit-groups/?group=<?php echo $value->group_id ?>">
														<?php echo get_the_title($value->subjecet_id)."-".$value->stundent_curve; ?>
													</a>
													<?php 	
												}
											}
											?>
										</th>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php  
											foreach ($sonuclar1 as $key => $value) {
												if ($value->quarter_id == 2) {
													echo "<br>";
													echo $value->id;
													echo "<br>";
													?>
													<a href="<?php echo get_site_url(); ?>/edit-groups/?group=<?php echo $value->group_id ?>">
														<?php echo get_the_title($value->subjecet_id)."-".$value->stundent_curve; ?>
													</a>
													<?php 	
												}
											}
											?>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php  
											foreach ($sonuclar1 as $key => $value) {
												if ($value->quarter_id == 3) {
													echo "<br>";
													echo $value->id;
													echo "<br>";
													?>
													<a href="<?php echo get_site_url(); ?>/edit-groups/?group=<?php echo $value->group_id ?>">
														<?php echo get_the_title($value->subjecet_id)."-".$value->stundent_curve; ?>
													</a>
													<?php 	
												}
											}
											?>
										</td>
										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<?php  
											foreach ($sonuclar1 as $key => $value) {
												if ($value->quarter_id == 4) {
													echo "<br>";
													echo $value->id;
													echo "<br>";
													?>
													<a href="<?php echo get_site_url(); ?>/edit-groups/?group=<?php echo $value->group_id ?>">
														<?php echo get_the_title($value->subjecet_id)."-".$value->stundent_curve; ?>
													</a>
													<?php 	
												}
											}
											?>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




















<?php get_footer(); ?>


