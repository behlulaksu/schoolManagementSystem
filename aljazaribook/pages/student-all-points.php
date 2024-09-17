<?php /* Template Name: Student All Points */ ?>

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
$get_user_data = get_user_meta($student);
?>

<?php get_header(); ?>


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
					<div class="card dark:bg-zinc-800 dark:border-zinc-600" style="border: initial;">
						<div class="card-body flex flex-wrap">
							<div class="nav-tabs border-b-tabs" style="width: 100%;">
								<ul style="justify-content: space-evenly;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
									<li>
										<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-home" class="inline-block p-4 active">
											<i class="mdi mdi-weather-rainy ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
											Quarter 1
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-Profile" class="inline-block p-4 hover:border-b-2 hover:border-gray-300 ">
											<i class="mdi mdi-snowflake ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
											Quarter 2
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-setting" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
											<i class="mdi mdi-flower ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
											Quarter 3
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-contact" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
											<i class="mdi mdi-white-balance-sunny ltr:mr-2 rtl:ml-2 text-lg align-middle"></i>
											Quarter 4
										</a>
									</li>
								</ul>
								<style>
									.edit-table input{
										width: 100% !important;
									}
								</style>
								<div class="tab-content mt-5">
									<div class="tab-pane block" id="underline-icon-home">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
									</div>
									<div class="tab-pane hidden" id="underline-icon-Profile">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.m
									</div>
									<div class="tab-pane hidden" id="underline-icon-setting">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
									</div>
									<div class="tab-pane hidden" id="underline-icon-contact">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, sed praesentium qui dolor nostrum in impedit non ullam animi, facilis perferendis molestiae quis doloribus, quas explicabo modi amet necessitatibus at.
									</div>
								</div>
							</div>
						</div>						
					</div>					
				</div>  
			</div>




		</div>
	</div>
</div>



<?php get_footer(); ?>