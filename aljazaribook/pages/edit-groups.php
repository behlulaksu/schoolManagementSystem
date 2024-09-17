<?php /* Template Name: Edit Group */ ?>

<?php 
if (isset($_GET['group'])){
	$group = strip_tags($_GET["group"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 

}
$blog_id = get_current_blog_id();

?>
<?php $current_user_now = wp_get_current_user(); ?>
<?php get_header(); ?>
<!-- choices css -->
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
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center; color: #8f1537 !important;">
						<?php  
						$group_image = get_field('gru',$group);
						if (empty($group_image)) {
							$group_image['url'] = get_template_directory_uri()."/indir.png";
						}
						?>
						<img style="max-width: 50px; margin-right: 20px;" src="<?php echo $group_image['url']; ?>" alt="">
						<?php echo get_the_title($group); ?>
					</h4>
					<?php 
					$sub_Class = get_field("sub_class",$group);
					if ($sub_Class === "Yes") {
						?>
						<button type="button" class="btn py-2.5 px-6 text-[15.5px] text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:text-white active:bg-gray-600 active:border-gray-600 dark:border-transparent">
							SubClass
						</button>
						<?php 
					}else{
						?>
						<a style="margin-top: 5px;" href="<?php echo get_site_url(); ?>/yearly-report?group=<?php echo $group; ?>">
							<button style="margin-bottom: 7px;" type="button" class="btn text-white bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600">
								<i class="mdi mdi-graph"></i>
								Class Average Report
							</button>
						</a>
						<?php 
					}
					?>
				</div>
			</div>
			<div style="display: none !important;" class="grid gap-12 mb-12 md:grid-cols-1">
				<div>
					<label for="group_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
						Group Name
					</label>
					<input type="text" id="group_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" value="<?php echo get_the_title($group); ?>">
				</div>
			</div>
			<div class="card-body flex flex-wrap">
				<div class="nav-tabs border-b-tabs" style="width: 100%;">
					<ul class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
						<?php 
						if (get_user_access_read('class-roster')) {
							?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-home" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
									<i class="bx bx-user h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Class Roster
								</a>
							</li>
							<?php 
						}
						?>
						<?php if (get_user_access_read('class-subject')): ?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-Profile" class="inline-block p-4 active ">
									<i class="bx bxs-book h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Subjects
								</a>
							</li>
						<?php endif ?>

						<?php if (get_user_access_read('class-settings')): ?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-setting" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
									<i class="bx bxs-cog h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Settings
								</a>
							</li>
						<?php endif ?>

						<?php if (get_user_access_read('class-files')): ?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-files" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
									<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Examination
								</a>
							</li>
						<?php endif ?>

						<?php /* if (get_user_access_read('class-contacts')): ?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-contact" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
									<i class="bx bx-message-rounded-dots h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Communication
								</a>
							</li>
						<?php endif */ ?>

						<?php if ($sub_Class === "No"): ?>
							<?php if (get_user_access_read('grade-advisor') || get_user_access_read('pdp-comment')): ?>
							<li>
								<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-grade-advisor" class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
									<i class="bx bxs-star h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
									Grade Advisor & PDP
								</a>
							</li>
						<?php endif ?>
					<?php endif ?>
					<li>
						<a activity="0" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="all_point_for_class" class="class_all_report_section inline-block p-4 hover:border-b-2 hover:border-gray-300">
							<i class="bx bx-bookmarks h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
							Class Report
						</a>
					</li>
					<?php if ($sub_Class === "No"): ?>
						<li>
							<a activity="0" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="student_attandance" class="class_all_report_section inline-block p-4 hover:border-b-2 hover:border-gray-300">
								<i class="bx bx-list-ul h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
								Attandance
							</a>
						</li>
					<?php endif ?>
					<?php if ($sub_Class === "No"): 
						// if ($current_user_now->roles[0] != 'hod') {
						?>

						<li>
							<a activity="0" href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="print_papers" class="class_all_report_section inline-block p-4 hover:border-b-2 hover:border-gray-300">
								<i class="bx bx-printer h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
								Print
							</a>
						</li>
						<?php 
						// }
					endif ?>
					

				</ul>
				<?php $group_users = get_field("group_users",$group); ?>
				<div class="tab-content mt-5">
					<?php if ($sub_Class === "No"): ?>
						<div class="tab-pane hidden" id="print_papers">
							<div class="card-body"> 
								<div class="relative overflow-x-auto">
									<table class="w-full text-sm text-left text-gray-500" style="text-align: center !important;">
										<thead class="text-sm text-gray-700 dark:text-gray-100">
											<tr class="border border-gray-50 dark:border-zinc-600">
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Quarters
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													5-10 Quarter
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													5-10 Quarter TR
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													11-12 Quarter
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													KG-4 Quarter
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													KG-4 Quarter TR
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card KG-4 
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card KG-4 TR
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card 5-10  
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card 5-10  TR
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card 11-12
												</th>
												<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
													Semester Report Card 11-12 TR
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
												<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Quarter 1
												</th>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report?class=<?php echo $group; ?>&quarter=1">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report-tr?class=<?php echo $group; ?>&quarter=1">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-paper-atar-report?class=<?php echo $group; ?>&quarter=1">
														<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter?class=<?php echo $group; ?>&quarter=1">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter-tr?class=<?php echo $group; ?>&quarter=1">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">

												</td>
											</tr>
											<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
												<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Quarter 2
												</th>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report-tr?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-paper-atar-report?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter-tr?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/primary-semester?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-neutral-500 p-0 align-middle text-white focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/primary-semester-tr?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-neutral-500 p-0 align-middle text-white focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/middle-semester?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/middle-semester-tr?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/atar-semester?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-green-800 p-0 align-middle text-white focus:ring-2 focus:ring-green-800/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/atar-semester-tr?class=<?php echo $group; ?>&quarter=2">
														<button type="button" class="btn border-0 bg-green-800 p-0 align-middle text-white focus:ring-2 focus:ring-green-800/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
											</tr>
											<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
												<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Quarter 3
												</th>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report?class=<?php echo $group; ?>&quarter=3">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report-tr?class=<?php echo $group; ?>&quarter=3">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-paper-atar-report?class=<?php echo $group; ?>&quarter=3">
														<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter?class=<?php echo $group; ?>&quarter=3">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter-tr?class=<?php echo $group; ?>&quarter=3">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													
												</td>
											</tr>
											<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
												<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													Quarter 4
												</th>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-page-report-tr?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/one-paper-atar-report?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/kg-quarter-tr?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/primary-semester?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-neutral-500 p-0 align-middle text-white focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/primary-semester-tr?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-neutral-500 p-0 align-middle text-white focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/middle-semester?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/middle-semester-tr?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/atar-semester?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-green-800 p-0 align-middle text-white focus:ring-2 focus:ring-green-800/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
												<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
													<a href="<?php echo get_site_url(); ?>/atar-semester-tr?class=<?php echo $group; ?>&quarter=4">
														<button type="button" class="btn border-0 bg-green-800 p-0 align-middle text-white focus:ring-2 focus:ring-green-800/30 hover:bg-green-600">
															<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
															<span class="px-3 leading-[2.8]">
																Print
															</span>
														</button>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<a href="<?php echo get_site_url(); ?>/kg-only-semester?class=<?php echo $group; ?>&quarter=4">
									<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
										<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
										<span class="px-3 leading-[2.8]">
											For KG!
										</span>
									</button>
								</a>
								<a href="<?php echo get_site_url(); ?>/sertifikalar?class=<?php echo $group; ?>&quarter=4">
									<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
										<i class="bx bx-printer bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
										<span class="px-3 leading-[2.8]">
											Certificates
										</span>
									</button>
								</a>
							</div>
						</div>
					<?php endif ?>

					<div class="tab-pane hidden" id="underline-icon-home">
						<?php 
						if (get_user_access_read('class-roster')) {
							?>
							<div class="grid grid-cols-12 gap-5">
								<div class="col-span-12 xl:col-span-12">
									<div class="card dark:bg-zinc-800 dark:border-zinc-600">
										<div class="card-body">
											<div data-tw-accordion="collapse">
												<div class="accordion-item text-gray-700">
													<?php $get_group_teachers = get_field("group_admin",$group); ?>
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
															<span class="text-15">
																Teachers
																( <?php echo count($get_group_teachers); ?> )
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>

													<div class="accordion-body hidden">
														<?php if (get_user_access_write('class-roster')): ?>
															<?php if (get_user_access_delete('class-roster')): ?>
																<div class="grid grid-cols-12 gap-5">
																	<div class="col-span-12 lg:col-span-12">
																		<select class="choice_place" data-trigger name="choices-multiple-default" id="choices-multiple-default" multiple>
																			<?php 
																			if (!empty($get_group_teachers)) {
																				foreach ($get_group_teachers as $key => $value) {
																					?>
																					<option value="<?php echo $value['user_email']; ?>" selected>
																						<?php echo $value['user_email']; ?>
																					</option>
																					<?php 
																				}
																			}



																			$args = array(
																				'role__not_in' => 'student',
																			);
																			$users = get_users($args);
																			if (!empty($users)) {
																				foreach ($users as $key => $value) {
																					?>
																					<option value="<?php echo $value->data->user_email; ?>">
																						<?php echo $value->data->user_email; ?>
																					</option>
																					<?php 
																				} 
																			}

																			?>
																		</select>
																	</div>
																</div>
															<?php endif ?>

															<div class="card-body">
																<div class="relative overflow-x-auto">
																	<table class="text-sm text-left text-gray-500" style="width: 100%;">
																		<thead class="text-sm text-gray-700 dark:text-gray-100">
																			<tr>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					User ID
																				</th>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Teacher Name
																				</th>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Teacher Email
																				</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php 
																			if (!empty($get_group_teachers)) {
																				foreach ($get_group_teachers as $key => $value) {
																					?>
																					<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																						<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<?php echo $value['ID']; ?>
																						</th>
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<?php echo $value['display_name']; ?>
																						</td>
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<a href="mailto:<?php echo $value['user_email']; ?>">
																								<?php echo $value['user_email']; ?>
																							</a>
																						</td>
																					</tr>
																					<?php 
																				}
																			}

																			?>
																		</tbody>
																	</table>
																</div>
															</div>
														<?php endif ?>
													</div>
												</div>
												<div class="accordion-item text-gray-700">
													<h2>
														<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left border border-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
															<span id="show_stundetn_count" class="text-15">
																Students
																( <?php echo count($group_users); ?> )
															</span>
															<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
															<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
														</button>
													</h2>
													<div class="accordion-body hidden">
														<?php if (get_user_access_write('class-roster')): ?>
															<div class="grid grid-cols-12 gap-5" style="margin-top: 10px;">
																<div class="col-span-10 lg:col-span-10">
																	<select class="border-gray-100" data-trigger name="choices-single-default" id="new_student_add" placeholder="This is a search placeholder">
																		<option value="">This is a placeholder</option>
																		<?php 
																		$args = array(
																			'role' => 'student',
																		);
																		$users = get_users($args);
																		if (!empty($users)) {
																			foreach ($users as $key => $value) {
																				?>
																				<option value="<?php echo $value->data->user_email; ?>">
																					<?php echo $value->data->user_email; ?>
																				</option>
																				<?php 
																			} 
																		}
																		?>
																	</select>
																</div>
																<div class="col-span-2 lg:col-span-2">
																	<button id="new_student_add_button" style="width: 100%; height: 100%;" type="button" class="btn text-white bg-sky-500 border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600">
																		Add Student
																	</button>
																</div>
															</div>
															<table id="student_control_list" style="margin-top: 10px;" class="w-full text-sm text-left text-gray-500 ">
																<thead class="text-sm text-gray-700 dark:text-gray-100">
																	<tr class="border border-gray-50 dark:border-zinc-600">
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Eyotek ID
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Student Name
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Remove
																		</th>
																		<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																			Move To
																		</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	if (!empty($group_users)) {
																		foreach ($group_users as $key => $value) {
																			?>
																			<tr student_row_id="<?php echo $value['ID']; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																				<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																					<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
																				</th>
																				<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<?php echo $value['display_name']; ?>
																				</td>
																				<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<button student_delete_id="<?php echo $value['ID']; ?>" type="button" class="delete_student btn border-0 bg-red-400 text-white px-5" style="display: flex; align-items: center; justify-content: center; width: 100%;">
																						<i style="margin-right: 7px;" class="mdi mdi-trash-can block text-lg"></i>
																						<span class="">
																							Delete
																						</span>
																					</button>
																				</td>
																				<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																					<button student_name="<?php echo $value['display_name']; ?>" student_id="<?php echo $value['ID']; ?>" data-tw-toggle="modal" data-tw-target="#modal-move-to" type="button" class="move_to_btn btn border-0 bg-yellow-700 text-white px-5" style="display: flex; align-items: center; justify-content: center; width: 100%;">
																						<span class="">
																							Move
																						</span>
																						<i style="margin-left: 7px;" class="mdi mdi-arrow-expand-right"></i>
																					</button>
																				</td>
																			</tr>
																			<?php 
																		}
																	}
																	?>
																</tbody>
															</table>
														<?php endif ?>
													</div>
												</div>
												<?php if ($sub_Class === "No"): ?>
													<div class="accordion-item text-gray-700">
														<h2>
															<button type="button" class="accordion-header group flex items-center justify-between w-full p-3 font-medium text-left border border-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
																<span class="text-15">
																	Class List
																</span>
																<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
																<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
															</button>
														</h2>
														<div class="accordion-body hidden">
															<div class="card-body">
																<div class="relative overflow-x-auto">
																	<table class="text-sm text-left text-gray-500" style="width: 100%;">
																		<thead class="text-sm text-gray-700 dark:text-gray-100">
																			<tr>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Image
																				</th>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					School No (Eyotek)
																				</th>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Student Name
																				</th>
																				<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Student Email
																				</th>
																				<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Student Profile
																				</th>
																				<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Student Academic Records
																				</th>
																				<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																					Counselling Notes
																				</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php 
																			if (!empty($group_users)) {
																				foreach ($group_users as $key => $value) {
																					?>
																					<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<img src="<?php echo get_field('user_image', 'user_'.$value['ID']); ?>" alt="">
																						</td>
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
																						</td>
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<?php echo $value['display_name']; ?>
																						</td>
																						<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<a href="mailto:<?php echo $value['user_email']; ?>">
																								<?php echo $value['user_email']; ?>
																							</a>
																						</td>
																						<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<a target="_Blank" href="<?php echo get_site_url(); ?>/edit-user?user=<?php echo $value['ID']; ?>">
																								<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																									View
																								</button>
																							</a>
																						</td>
																						<td style="text-align: center;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																							<a target="_Blank" href="<?php echo get_site_url(); ?>/student-sheets-list?user=<?php echo $value['ID']; ?>&group=<?php echo $group; ?>">
																								<button type="button" class="btn text-white bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600">
																									View
																								</button>
																							</a>
																						</td>
																						<td style="text-align: center;" class="px-6 py-3.5 border-l border-green-50 dark:border-zinc-600 dark:text-zinc-100">
																							<a href="<?php echo get_site_url(); ?>/counselling-notes?student=<?php echo $value['ID']; ?>&group=<?php echo $group; ?>">
																								<button type="button" class="btn text-white bg-green-700 border-green-700 hover:bg-green-700 hover:border-green-700 focus:bg-green-700 focus:border-green-700 focus:ring focus:ring-green-700/30 active:bg-gray-700 active:border-green-700">
																									Notes
																								</button>
																							</a>
																						</td>
																					</tr>
																					<?php 
																				}
																			}

																			?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												<?php endif ?>

											</div>
										</div>
										<?php if (get_user_access_delete('class-roster')): ?>
											<div class="card-body"> 

												<div class="grid gap-12 mb-12 md:grid-cols-1">

													<button id="update_group" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
														Update Group
													</button>

												</div>
											</div>
										<?php endif ?>
									</div>
								</div>
							</div>
							<?php 
						}
						?>

					</div>

					<div class="tab-pane block" id="underline-icon-Profile">
						<?php if (get_user_access_read('class-subject')): ?>
							<div class="grid grid-cols-12 gap-5">
								<div class="col-span-12 xl:col-span-12">
									<div class="card dark:bg-zinc-800 dark:border-zinc-600">
										<?php $gruoup_subjects = get_field("subject_for_group",$group); 
										if (!empty($gruoup_subjects)) {
											?>
											<div class="card-body">
												<div class="relative overflow-x-auto">
													<div class="col-span-12 xl:col-span-6">
														<div class="card dark:bg-zinc-800 dark:border-zinc-600">
															<div class="card-body ">
																<div data-tw-accordion="collapse">
																	<?php  
																	$subjectt_write = get_user_access_write('class-subject');
																	foreach ($gruoup_subjects as $key => $value) {
																		$subject_title = "";
																		if ($current_user_now->roles[0] === 'hod') {
																			$select_lesson_type = get_field("select_lesson_type",$value->ID);
																			$subject_title = ($select_lesson_type[0]->post_title);
																		}else{
																			$subject_title = get_the_title($value->ID);
																		}
																		$teacher_subject = get_field('subjects_' . $blog_id,'user_'.get_current_user_id());
																		if ($current_user_now->roles[0] === 'hod') {
																			foreach ($teacher_subject as $keyler => $valueler) {
																				if (get_the_title($valueler) == $subject_title) {
																					?>
																					<div class="accordion-item text-gray-700 subjects_tab">
																						<h2>
																							<button type="button" class="accordion-header group flex border-b border-gray-100 dark:border-b-zinc-600 items-center justify-between w-full p-3 font-medium text-left rounded-t-lg">
																								<span class="text-15">
																									<?php
																									echo $subject_title;
																									?>
																								</span>
																								<i class="mdi mdi-chevron-down text-2xl group-[.active]:rotate-180"></i>
																							</button>
																						</h2>

																						<div class="accordion-body hidden">
																							<table class="w-full text-sm text-left text-gray-500 ">
																								<thead class="text-sm text-gray-700 dark:text-gray-100">
																									<tr class="border border-gray-50 dark:border-zinc-600">
																										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																											Subject Name
																										</th>
																										<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																											------------
																										</th>
																										<?php if (get_user_access_read('class-curve')): ?>
																											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																												Curve
																											</th>
																										<?php endif ?>
																										<?php if ($subjectt_write): ?>
																											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																												Authorization
																											</th>
																											<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																												Gradebook
																											</th>
																										<?php endif ?>
																									</tr>
																								</thead>
																								<tbody>
																									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																											<?php echo get_the_title($value->ID); ?>
																										</td>
																										<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">

																											<a href="<?php echo get_site_url(); ?>/curriculum-breakdown?grade=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																												<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
																													<i class="mdi mdi-book-open-page-variant"></i>
																													Curriculum Breakdown
																												</button>
																											</a>

																										</td>
																										<?php if (get_user_access_read('class-curve')): ?>
																											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																												<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=1">
																													<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																														<i class="mdi mdi-content-save-settings-outline"></i>
																														Q1
																													</button>
																												</a>
																												<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=2">
																													<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																														<i class="mdi mdi-content-save-settings-outline"></i>
																														Q2
																													</button>
																												</a>
																												<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=3">
																													<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																														<i class="mdi mdi-content-save-settings-outline"></i>
																														Q3
																													</button>
																												</a>
																												<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=4">
																													<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																														<i class="mdi mdi-content-save-settings-outline"></i>
																														Q4
																													</button>
																												</a>
																												<br>
																											</td>
																										<?php endif ?>
																										<?php if ($subjectt_write): ?>
																											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																												<a href="<?php echo get_site_url(); ?>/edit-subject?subject=<?php echo $value->ID; ?>">
																													<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																														Edit
																													</button>
																												</a>
																											</td>
																											<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																												<a target="_Blank" href="<?php echo get_site_url(); ?>/gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																													<button type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																														View
																													</button>
																												</a>
																											</td>
																										<?php endif ?>
																									</tr>
																								</tbody>
																							</table>
																						</div>
																					</div>
																					<?php 
																				}
																			}
																		}else{
																			?>
																			<div class="accordion-item text-gray-700 subjects_tab">
																				<h2>
																					<button type="button" class="accordion-header group flex border-b border-gray-100 dark:border-b-zinc-600 items-center justify-between w-full p-3 font-medium text-left rounded-t-lg">
																						<span class="text-15">
																							<?php
																							echo $subject_title;
																							?>
																						</span>
																						<i class="mdi mdi-chevron-down text-2xl group-[.active]:rotate-180"></i>
																					</button>
																				</h2>

																				<div class="accordion-body hidden">
																					<table class="w-full text-sm text-left text-gray-500 ">
																						<thead class="text-sm text-gray-700 dark:text-gray-100">
																							<tr class="border border-gray-50 dark:border-zinc-600">
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									Subject Name
																								</th>
																								<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																									----------------
																								</th>
																								<?php if (get_user_access_read('class-curve')): ?>
																									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																										Curve
																									</th>
																								<?php endif ?>
																								<?php if ($subjectt_write): ?>
																									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																										Authorization
																									</th>
																									<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																										Gradebook
																									</th>
																								<?php endif ?>
																							</tr>
																						</thead>
																						<tbody>
																							<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<?php echo get_the_title($value->ID); ?>
																								</td>
																								<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																									<a href="<?php echo get_site_url(); ?>/curriculum-breakdown?grade=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																										<button type="button" class="bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																											<i class="bx bx-book-open bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
																											<span class="px-3 leading-[2.8]">
																												Curriculum Breakdown
																											</span>
																										</button>
																									</a>
																								</td>
																								<?php if (get_user_access_read('class-curve')): ?>
																									<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																										<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=1">
																											<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																												<i class="mdi mdi-content-save-settings-outline"></i>
																												Q1
																											</button>
																										</a>
																										<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=2">
																											<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																												<i class="mdi mdi-content-save-settings-outline"></i>
																												Q2
																											</button>
																										</a>
																										<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=3">
																											<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																												<i class="mdi mdi-content-save-settings-outline"></i>
																												Q3
																											</button>
																										</a>
																										<a href="<?php echo get_site_url(); ?>/curve-settings?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=4">
																											<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
																												<i class="mdi mdi-content-save-settings-outline"></i>
																												Q4
																											</button>
																										</a>
																										<br>
																									</td>
																								<?php endif ?>
																								<?php if ($subjectt_write): ?>
																									<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																										<a href="<?php echo get_site_url(); ?>/edit-subject?subject=<?php echo $value->ID; ?>">
																											<button type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
																												Edit
																											</button>
																										</a>
																									</td>
																									<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																										<a target="_Blank" href="<?php echo get_site_url(); ?>/gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>">
																											<button type="button" class="btn bg-red-500 border-red-500 text-white hover:bg-red-600 focus:ring ring-red-200 focus:bg-red-600">
																												View
																											</button>
																										</a>
																									</td>
																								<?php endif ?>
																							</tr>
																						</tbody>
																					</table>
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
											<?php 
										}else{
											echo "There is no subject yet";
										}
										?>
										<?php if (get_user_access_delete('class-subject')): ?>
											<div class="card-body">
												<div class="grid gap-12 mb-12 md:grid-cols-1">
													<h5 class="text-sm text-gray-700 dark:text-gray-100 mb-3">
														Subjects Assigned to the Class
													</h5>
													<div class="grid grid-cols-12 gap-5">
														<div class="col-span-12 lg:col-span-12">
															<select class="choice_place" data-trigger name="choices-multiple-default" id="choices-multiple-subject" multiple>
																<?php  
																foreach ($gruoup_subjects as $key => $value) {
																	?>
																	<option selected value="<?php echo $value->ID; ?>">
																		<?php echo get_the_title($value->ID); ?>
																	</option>
																	<?php 
																}


																$post_args = [
																	'post_type'	=> 'subject_function',
																	'numberposts'	=> -1,
																];
																$get_all_subjects = get_posts($post_args);

																foreach ($get_all_subjects as $key => $value) {
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
												<button id="update_group_subjects" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
													Save & Exit
												</button>
											</div>
										<?php endif ?>

									</div>
								</div>
							</div>
						<?php endif ?>

					</div>
					<div class="tab-pane hidden" id="underline-icon-setting">
						<?php if (get_user_access_read('class-settings')): ?>

							<table style="margin-bottom: 25px;" class="w-full text-sm text-left text-gray-500 ">
								<h4 style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
									Remaining Time For Next Report Generation
								</h4>
								<thead class="text-sm text-gray-700 dark:text-gray-100">
									<tr class="border border-gray-50 dark:border-zinc-600">
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 1
										</th>
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 2
										</th>
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 3
										</th>
										<th style="text-align: center;" scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
											Quarter 4
										</th>
									</tr>
								</thead>
								<tbody>
									<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
										<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_date_q1",$group); ?>" id="remaining_time_q1">
										</th>
										<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_date_q2",$group); ?>" id="remaining_time_q2">
										</th>
										<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_date_q3",$group); ?>" id="remaining_time_q3">
										</th>
										<th class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
											<input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" value="<?php echo get_field("lock_date_q4",$group); ?>" id="remaining_time_q4">
										</th>
									</tr>
								</tbody>
							</table>
							<div class="col-span-12 lg:col-span-4" style="margin-bottom: 25px;">
								<div class="mb-3">
									<div class="mb-2">
										<label for="choices-multiple-default" class="form-label text-13 font-medium text-gray-500 dark:text-zinc-100">
											Class Advisor
										</label>
									</div>
									<select class="choice_place" data-trigger name="choices-multiple-default" id="choices-multiple-advisor" placeholder="This is a placeholder" multiple>
										<?php $class_advisors = get_field("class_advisors",$group);										
										if (!empty($class_advisors)) {
											foreach ($class_advisors as $key => $value) {
												?>
												<option value="<?php echo $value['user_email']; ?>" selected>
													<?php echo $value['user_email']; ?>
												</option>
												<?php 
											}
										}

										$args = array(
											'role__not_in' => 'student',
										);
										$users = get_users($args);
										if (!empty($users)) {
											foreach ($users as $key => $value) {
												?>
												<option value="<?php echo $value->data->user_email; ?>">
													<?php echo $value->data->user_email; ?>
												</option>
												<?php 
											} 
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-span-12 lg:col-span-4" style="margin-bottom: 25px;">
								<div class="mb-3">
									<div class="mb-2">
										<label for="choices-multiple-default" class="form-label text-13 font-medium text-gray-500 dark:text-zinc-100">
											Class PDP
										</label>
									</div>
									<select class="choice_place" data-trigger name="choices-multiple-default" id="choices-multiple-pdp" placeholder="This is a placeholder" multiple>
										<?php $class_pdp = get_field("class_pdp",$group);										
										if (!empty($class_pdp)) {
											foreach ($class_pdp as $key => $value) {
												?>
												<option value="<?php echo $value['user_email']; ?>" selected>
													<?php echo $value['user_email']; ?>
												</option>
												<?php 
											}
										}

										$args = array(
											'role__not_in' => 'student',
										);
										$users = get_users($args);
										if (!empty($users)) {
											foreach ($users as $key => $value) {
												?>
												<option value="<?php echo $value->data->user_email; ?>">
													<?php echo $value->data->user_email; ?>
												</option>
												<?php 
											} 
										}
										?>
									</select>
								</div>
							</div>
							<div class="mb-4">
								<div class="mb-3">
									<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										Active Quarter
									</label>
									<select id="active_quarter" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option selected>
											<?php echo get_field("active_quarter",$group);?>
										</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>
							</div>
							<script>
								subjecet_credit = [];
							</script>
							<?php  if (get_user_access_delete('class-settings')): ?>
								<?php if (!empty($gruoup_subjects)): ?>
									<div class="relative overflow-x-auto">
										<table class="w-full text-sm text-left text-gray-500 ">
											<thead class="text-sm text-gray-700 dark:text-gray-100">
												<tr class="border border-gray-50 dark:border-zinc-600">
													<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
														Subject
													</th>
													<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
														Credit
													</th>
													<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
														Lesson Hours
													</th>
												</tr>
											</thead>
											<tbody>
												<?php  
												global $wpdb;


												$subject_credit = "subject_credit";
												$query = $wpdb->prepare("SELECT * from $subject_credit where bloog_id =".$blog_id." and class_id =".$group."" );
												$sonuclar = $wpdb->get_results($query);

												$bg_table_name_name = "subject_hours";
												$query = $wpdb->prepare("SELECT * from $bg_table_name_name where blog_id =".$blog_id." and class_id =".$group."" );
												$sonuclarlar = $wpdb->get_results($query);

												foreach ($gruoup_subjects as $key => $value) {
													$subject_credi = "";
													$subject_hourse = "";

													foreach ($sonuclar as $keys => $values) {
														if ($values->subjecet_id == $value->ID) {
															$subject_credi = $values->credit;
														}
													}
													
													foreach ($sonuclarlar as $keys => $values) {
														if ($values->subject_id == $value->ID) {
															$subject_hourse = $values->subject_hours;
														}
													}
													?>
													<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
														<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
															<?php echo($value->post_title); ?>
														</th>
														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
															<input class="subject_credit w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" value="<?php echo $subject_credi; ?>" min="0" >
														</td>
														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
															<input class="subject_lesson_hourse w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" value="<?php echo $subject_hourse; ?>" min="0">
														</td>
													</tr>
													<script>subjecet_credit[<?php echo $key ?>] = <?php echo $value->ID; ?>;</script>
													<?php 
												}
												?>
											</tbody>
										</table>
									</div>
								<?php endif ?>
							<?php endif  ?>
							<button style="margin-top: 20px;" id="sava_settings" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
								Save Settings
							</button>

							<?php /* if (get_user_access_delete('class-settings')): ?>
								<button type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600" data-tw-toggle="modal" data-tw-target="#delete-class">
									<i class="mdi mdi-trash-can block text-lg"></i>
									<span>Delete Class</span>
								</button>
							<?php endif */ ?>

						<?php endif ?>

					</div>

					<div class="tab-pane hidden" id="underline-icon-files">
						<?php if (get_user_access_read('class-files')): ?>
							<div class="grid grid-cols-12 gap-5">
								<div class="col-span-12 xl:col-span-12">
									<div class="card dark:bg-zinc-800 dark:border-zinc-600">
										<?php $gruoup_subjects = get_field("subject_for_group",$group); 
										if (!empty($gruoup_subjects)) {
											?>
											<div class="card-body">
												<div class="relative overflow-x-auto">
													<table class="text-sm text-left text-gray-500 w-full dark:bg-zinc-700 dark:border-zinc-600">
														<thead class="text-sm text-gray-700 dark:text-gray-100 ">
															<tr>
																<th scope="col" class="px-6 py-3">
																	Subject ID
																</th>
																<th scope="col" class="px-6 py-3">
																	Subject Name
																</th>
																<th scope="col" class="px-6 py-3">
																	Files
																</th>
															</tr>
														</thead>
														<tbody>
															<?php  
															foreach ($gruoup_subjects as $key => $value) {
																$teacher_subject = get_field('subjects_' . $blog_id,'user_'.get_current_user_id());
																if ($current_user_now->roles[0] === 'hod') {
																	foreach ($teacher_subject as $keyler => $valueler) {
																		$subject_title = "";
																		if ($current_user_now->roles[0] === 'hod') {
																			$select_lesson_type = get_field("select_lesson_type",$value->ID);
																			$subject_title = ($select_lesson_type[0]->post_title);
																		}else{
																			$subject_title = get_the_title($value->ID);
																		}
																		if (get_the_title($valueler) == $subject_title) {
																			?>
																			<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																				<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																					<?php echo $value->ID; ?>
																				</th>
																				<td class="px-6 py-3.5 dark:text-zinc-100">
																					<?php echo $subject_title; ?>
																				</td>
																				<?php  
																				$campus_id = get_current_blog_id();
																				$target_files = get_uploaded_file($campus_id,$group,$value->ID);
																				?>
																				<td class="px-6 py-3.5 dark:text-zinc-100">
																					<button style="background-color: #992f4c !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900"  data-tw-toggle="modal" data-tw-target="#upload_fiels_<?php echo $key; ?>">
																						Browse Exams
																						<i class="mdi mdi-upload block text-lg" style="margin-left: 7px; margin-right: 5px;"></i>
																						(<?php echo count($target_files); ?>)
																					</button>
																				</td>
																			</tr>
																			<?php 
																		}	
																	}
																}else{
																	?>
																	<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
																		<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																			<?php echo $value->ID; ?>
																		</th>
																		<td class="px-6 py-3.5 dark:text-zinc-100">
																			<?php echo get_the_title($value->ID); ?>
																		</td>
																		<?php  
																		$campus_id = get_current_blog_id();
																		$target_files = get_uploaded_file($campus_id,$group,$value->ID);
																		?>
																		<td class="px-6 py-3.5 dark:text-zinc-100">
																			<button style="background-color: #992f4c !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900"  data-tw-toggle="modal" data-tw-target="#upload_fiels_<?php echo $key; ?>">
																				Browse Exams
																				<i class="mdi mdi-upload block text-lg" style="margin-left: 7px; margin-right: 5px;"></i>
																				(<?php echo count($target_files); ?>)
																			</button>
																		</td>
																	</tr>
																	<?php 
																}
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<?php 
										}else{
											echo "There is no subject yet";
										}
										?>
									</div>
								</div>
							</div>
						<?php endif ?>
					</div>

					<?php /* ?>
					<div class="tab-pane hidden" id="underline-icon-contact">
						<?php if (get_user_access_read('class-contacts')): ?>
							<p class="mb-0 dark:text-gray-300">
								Group chat will be here but not ready
							</p>
						<?php endif ?>
					</div>
					<?php */ ?>


					<?php if ($sub_Class === "No"): ?>
						<div class="tab-pane hidden" id="underline-grade-advisor">
							<div class="card-body">
								<div class="relative overflow-x-auto">
									<table class="text-sm text-left text-gray-500" style="width: 100%;">
										<thead class="text-sm text-gray-700 dark:text-gray-100">
											<tr>
												<th scope="col" class="px-6 py-3">
													School No (Eyotek)
												</th>
												<th scope="col" class="px-6 py-3">
													Student Name
												</th>
												<?php if (get_user_access_read('grade-advisor')): ?>
													<th scope="col" class="px-6 py-3">
														GRADE ADVISOR'S COMMENT
													</th>
												<?php endif ?>
												<?php if (get_user_access_read('pdp-comment')): ?>
													<th scope="col" class="px-6 py-3">
														PDP'S COMMENT
													</th>
												<?php endif ?>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (!empty($group_users)) {
												foreach ($group_users as $key => $value) {
													global $wpdb;
													?>
													<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
															<?php echo get_field('school_no', 'user_'.$value['ID']); ?>
														</td>
														<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
															<?php echo $value['display_name']; ?>
														</td>
														<?php if (get_user_access_read('grade-advisor')): ?>
															<?php  
															$comment_type = "grade_advisor_comment";
															$comment_control = get_long_comment($group, get_field("active_quarter", $group), $value['ID'],$comment_type);
															$pdp_comment_bg = " ";
															if (!empty($comment_control)) {
																$pdp_comment_bg = "background-color: green !important;";
															}
															?>
															<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																<button style="width: 100%; <?php echo $pdp_comment_bg; ?>" type="button" class="btn text-white bg-red-500" data-tw-toggle="modal" data-tw-target="#advisor_comment-<?php echo $value['ID']; ?>">
																	GRADE ADVISOR
																</button>
															</td>
														<?php endif ?>
														<?php if (get_user_access_read('pdp-comment')): ?>
															<?php  
															$comment_type = "pdp_long_comment";
															$comment_control = get_long_comment($group, get_field("active_quarter", $group), $value['ID'],$comment_type);
															$pdp_comment_bg = " ";
															if (!empty($comment_control)) {
																$pdp_comment_bg = "background-color: green !important;";
															}
															?>
															<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																<button style="width: 100%; <?php echo $pdp_comment_bg; ?>" type="button" class="btn text-white bg-red-500" data-tw-toggle="modal" data-tw-target="#pdp_comment-<?php echo $value['ID']; ?>">
																	PDP COMMENT
																</button>
															</td>
														<?php endif ?>

													</tr>
													<?php 
												}
											}

											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php endif ?>

					<div class="tab-pane hidden" id="all_point_for_class">
						<a target="_Blank" href="<?php echo get_site_url(); ?>/class-all-marks/?group=<?php echo $group; ?>&quarter=<?php echo get_field("active_quarter",$group);?>">
							<button type="button" class="btn text-white bg-yellow-500 border-yellow-500 hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600">
								Quarter <?php echo get_field("active_quarter",$group);?> Marks
							</button>
						</a>
						<a target="_Blank" href="<?php echo get_site_url(); ?>/class-all-marks-for-all-quarters/?group=<?php echo $group; ?>">
							<button style="background-color: #8f1537 !important;" type="button" class="btn text-white bg-yellow-500 border-yellow-500 hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600">
								All Year Marks
							</button>
						</a>
						<a target="_Blank" href="<?php echo get_site_url(); ?>/class-list-report-by-subject/?group=<?php echo $group; ?>">
							<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
								Subject Report
							</button>
						</a>
					</div>

					<?php if ($sub_Class === "No"): ?>
						<div class="tab-pane hidden" id="student_attandance">
							<div class="col-span-12 xl:col-span-6">
								<div class="card dark:bg-zinc-800 dark:border-zinc-600">
									<div class="card-body pb-0">
										<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Students Attandance All Year</h6>
									</div>
									<div class="card-body"> 
										<div class="relative overflow-x-auto">
											<table class="w-full text-sm text-left text-gray-500 ">
												<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
													<tr style="color: #8e1838; font-weight: bold;">
														<th scope="col" class="px-6 py-3">
															Student Name
														</th>
														<th style="text-align: center;" scope="col" class="px-6 py-3">
															Absent
														</th>
														<th style="text-align: center;" scope="col" class="px-6 py-3">
															Late
														</th>
														<th style="text-align: center;" scope="col" class="px-6 py-3">
															Permitted
														</th>
													</tr>
												</thead>
												<tbody>
													<script>
														student_list_class = [];
													</script>
													<?php  
													foreach ($group_users as $key => $value) {
														$get_attandance = get_attandance($group, 2, $value['ID']);
													//print_r($get_attandance[0]->absent);
														?>
														<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
															<td style="color: #8e1838; font-weight: bold;" class="px-6 py-3.5 dark:text-zinc-100">
																<?php echo $value['display_name']; ?>
															</td>
															<td class="px-6 py-3.5 dark:text-zinc-100">
																<input class="absent_student w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" value="<?php echo $get_attandance[0]->absent ?>">
															</td>
															<td class="px-6 py-3.5 dark:text-zinc-100">
																<input class="late_student w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" value="<?php echo $get_attandance[0]->late ?>">
															</td>
															<td class="px-6 py-3.5 dark:text-zinc-100">
																<input class="permitted_student w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" value="<?php echo $get_attandance[0]->permitted ?>">
															</td>
														</tr>
														<script>
															student_list_class[<?php echo $key ?>] = <?php echo $value['ID']; ?>;
														</script>
														<?php 
													}
													?>
												</tbody>
											</table>
											<button style="margin-top: 25px;" type="button" class="save_attandance btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
												<span class="align-middle">
													Save Attandance
												</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif ?>

				</div>
			</div>
		</div>

	</div>
</div>



<!-- Popop Modeller -->
<?php 
if ($sub_Class === "No") {
	if (get_user_access_read('grade-advisor')) {
		if (!empty($group_users)) {
			foreach ($group_users as $key => $value) {
				?>
				<div class="modal relative z-50 hidden" id="advisor_comment-<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
					<div class="fixed inset-0 z-50 overflow-y-auto">
						<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
						<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
							<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
								<div class="bg-white dark:bg-zinc-700">
									<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
										<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
											<?php echo $value['display_name']; ?>
										</h3>
										<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
											<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
										</button>
									</div>
									<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="padding: initial !important;max-height: 69vh; overflow-y: scroll !important;">
										<div class="col-span-12 xl:col-span-6">
											<div class="card-body flex flex-wrap">
												<div class="nav-tabs border-tab" style="width: 100%;">
													<ul style="justify-content: space-around;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q1-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 1){echo "active";} ?>">
																Quarter 1
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q2-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 2){echo "active";} ?>">
																Quarter 2
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q3-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 3){echo "active";} ?>">
																Quarter 3
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q4-advisor-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 4){echo "active";} ?>">
																Quarter 4
															</a>
														</li>
													</ul>
													<style>
														.class_advisor label{
															font-weight: 300 !important;
															padding: 15px;
															border: 1px solid #d79a2a;
														}
													</style>
													<div class="mt-5 tab-content">
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1){echo "block";}else{echo "hidden";} ?>" id="q1-advisor-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<div class="mb-3">
																	<?php 
																	$comment_type = "grade_advisor_comment";
																	$comment_control = get_long_comment($group, 1, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('grade_advisor_comment_q1', $group)): 
																		while(have_rows('grade_advisor_comment_q1', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_1" type="radio" name="advisor_1_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_1" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="q2-advisor-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<div class="mb-3">
																	<?php 
																	$comment_type = "grade_advisor_comment";
																	$comment_control = get_long_comment($group, 2, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('grade_advisor_comment_q2', $group)): 
																		while(have_rows('grade_advisor_comment_q2', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" type="radio" name="advisor_2_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="q3-advisor-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<div class="mb-3">
																	<?php 
																	$comment_type = "grade_advisor_comment";
																	$comment_control = get_long_comment($group, 3, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('grade_advisor_comment_q3', $group)): 
																		while(have_rows('grade_advisor_comment_q3', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" type="radio" name="advisor_3_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="q4-advisor-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<div class="mb-3">
																	<?php 
																	$comment_type = "grade_advisor_comment";
																	$comment_control = get_long_comment($group, 4, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('grade_advisor_comment_q4', $group)): 
																		while(have_rows('grade_advisor_comment_q4', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" type="radio" name="advisor_4_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="advisor-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
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
									<div style="justify-content: flex-end;" class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
										<h5>
											You can save only Quarter <?php echo get_field("active_quarter",$group); ?>
										</h5>
										<button active_quarter="<?php echo get_field("active_quarter",$group); ?>" comment_type="grade_advisor_comment" student="<?php echo $value['ID']; ?>" type="button" class="advisor_comment_select btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
											Save Comment
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
		}
	}
	if (get_user_access_read('pdp-comment')) {
		if (!empty($group_users)) {
			foreach ($group_users as $key => $value) {
				?>
				<div class="modal relative z-50 hidden" id="pdp_comment-<?php echo $value['ID']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
					<div class="fixed inset-0 z-50 overflow-y-auto">
						<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
						<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
							<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
								<div class="bg-white dark:bg-zinc-700">
									<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
										<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
											<?php echo $value['display_name']; ?>
										</h3>
										<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
											<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
										</button>
									</div>
									<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="padding: initial !important;max-height: 69vh; overflow-y: scroll !important;">
										<div class="col-span-12 xl:col-span-6">
											<div class="card-body flex flex-wrap">
												<div class="nav-tabs border-tab" style="width: 100%;">
													<ul style="justify-content: space-around;" class="nav w-full flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q1-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 1){echo "active";} ?>">
																Quarter 1
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q2-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 2){echo "active";} ?>">
																Quarter 2
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q3-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 3){echo "active";} ?>">
																Quarter 3
															</a>
														</li>
														<li>
															<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="q4-<?php echo $value['ID']; ?>-pdp_comment" class="inline-block px-4 py-3 <?php if (get_field("active_quarter",$group) == 4){echo "active";} ?>">
																Quarter 4
															</a>
														</li>
													</ul>
													<style>
														.class_advisor label{
															font-weight: 300 !important;
															padding: 15px;
															border: 1px solid #d79a2a;
														}
													</style>
													<div class="mt-5 tab-content">
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1){echo "block";}else{echo "hidden";} ?>" id="q1-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<table class="w-full text-sm text-left text-gray-500 mb-4">
																	<thead class="text-sm text-gold-700 dark:text-gray-100">
																		<tr class="border border-bordo-50 dark:border-zinc-600">
																			<th style="max-width: 50%;" scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Comment
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Consistently
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Often
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Sometimes
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Seldom
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Not Assessed
																			</th>
																		</tr>
																	</thead>
																	<tbody alinanlar="q1_<?php echo $value['ID']; ?>">
																		<?php 
																		if(have_rows('pdp_select_comments_q1', $group)): 
																			while(have_rows('pdp_select_comments_q1', $group)): 
																				the_row(); 
																				$sayac_buraya = get_row_index();
																				$kaydedilmis = get_pdp_select_comment($group, 1, $value['ID'], $sayac_buraya)[0]->comment_number;
																				?>
																				<tr secilecek_madde="q1_<?php echo $value['ID']; ?>" class="bg-white border border-bordo-50 dark:border-zinc-600 dark:bg-transparent">
																					<th style="max-width: 50%;" scope="row" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																						<?php echo get_sub_field('comment'); ?>
																					</th>
																					<td style="text-align: center;" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 1){echo "checked";} ?> type="radio" name="q1_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 2){echo "checked";} ?> type="radio" name="q1_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 3){echo "checked";} ?> type="radio" name="q1_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 4){echo "checked";} ?> type="radio" name="q1_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 5){echo "checked";} ?> type="radio" name="q1_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																				</tr>
																				<?php  
																			endwhile; 
																		endif;
																		?>
																	</tbody>
																</table>
																<div class="mb-3">
																	<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																		Student Comment
																	</label>
																	<?php 
																	$comment_type = "pdp_long_comment";
																	$comment_control = get_long_comment($group, 1, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('pdp_normal_comments_q1', $group)): 
																		while(have_rows('pdp_normal_comments_q1', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" type="radio" name="pdp_normal_1_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="q2-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<table class="w-full text-sm text-left text-gray-500 ">
																	<thead class="text-sm text-gold-700 dark:text-gray-100">
																		<tr class="border border-bordo-50 dark:border-zinc-600">
																			<th style="max-width: 50%;" scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Comment
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Consistently
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Often
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Sometimes
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Seldom
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Not Assessed
																			</th>
																		</tr>
																	</thead>
																	<tbody alinanlar="q2_<?php echo $value['ID']; ?>">
																		<?php 
																		if(have_rows('pdp_select_comments_q2', $group)): 
																			while(have_rows('pdp_select_comments_q2', $group)): 
																				the_row(); 
																				$sayac_buraya = get_row_index();
																				$kaydedilmis = get_pdp_select_comment($group, 2, $value['ID'], $sayac_buraya)[0]->comment_number;
																				?>
																				<tr secilecek_madde="q2_<?php echo $value['ID']; ?>" class="bg-white border border-bordo-50 dark:border-zinc-600 dark:bg-transparent">
																					<th style="max-width: 50%;" scope="row" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																						<?php echo get_sub_field('comment'); ?>
																					</th>
																					<td style="text-align: center;" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 1){echo "checked";} ?> type="radio" name="q2_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 2){echo "checked";} ?> type="radio" name="q2_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 3){echo "checked";} ?> type="radio" name="q2_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 4){echo "checked";} ?> type="radio" name="q2_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 5){echo "checked";} ?> type="radio" name="q2_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																				</tr>
																				<?php  
																			endwhile; 
																		endif;
																		?>
																	</tbody>
																</table>
																<div class="mb-3">
																	<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																		Student Comment
																	</label>
																	<?php 
																	$comment_type = "pdp_long_comment";
																	$comment_control = get_long_comment($group, 2, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('pdp_normal_comments_q2', $group)): 
																		while(have_rows('pdp_normal_comments_q2', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" type="radio" name="pdp_normal_2_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_2" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="q3-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<table class="w-full text-sm text-left text-gray-500 ">
																	<thead class="text-sm text-gold-700 dark:text-gray-100">
																		<tr class="border border-bordo-50 dark:border-zinc-600">
																			<th style="max-width: 50%;" scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Comment
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Consistently
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Often
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Sometimes
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Seldom
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Not Assessed
																			</th>
																		</tr>
																	</thead>
																	<tbody alinanlar="q3_<?php echo $value['ID']; ?>">
																		<?php 
																		if(have_rows('pdp_select_comments_q3', $group)): 
																			while(have_rows('pdp_select_comments_q3', $group)): 
																				the_row(); 
																				$sayac_buraya = get_row_index();
																				$kaydedilmis = get_pdp_select_comment($group, 3, $value['ID'], $sayac_buraya)[0]->comment_number;
																				?>
																				<tr secilecek_madde="q3_<?php echo $value['ID']; ?>" class="bg-white border border-bordo-50 dark:border-zinc-600 dark:bg-transparent">
																					<th style="max-width: 50%;" scope="row" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																						<?php echo get_sub_field('comment'); ?>
																					</th>
																					<td style="text-align: center;" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 1){echo "checked";} ?> type="radio" name="q3_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 2){echo "checked";} ?> type="radio" name="q3_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 3){echo "checked";} ?> type="radio" name="q3_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 4){echo "checked";} ?> type="radio" name="q3_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 5){echo "checked";} ?> type="radio" name="q3_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																				</tr>
																				<?php  
																			endwhile; 
																		endif;
																		?>
																	</tbody>
																</table>
																<div class="mb-3">
																	<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																		Student Comment
																	</label>
																	<?php 
																	$comment_type = "pdp_long_comment";
																	$comment_control = get_long_comment($group, 3, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('pdp_normal_comments_q3', $group)): 
																		while(have_rows('pdp_normal_comments_q3', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" type="radio" name="pdp_normal_3_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_3" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
																			</div>
																			<?php 
																		endwhile; 
																	endif;
																	?>
																</div>
															</div>
														</div>
														<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="q4-<?php echo $value['ID']; ?>-pdp_comment">
															<div class="relative overflow-x-auto">
																<table class="w-full text-sm text-left text-gray-500 ">
																	<thead class="text-sm text-gold-700 dark:text-gray-100">
																		<tr class="border border-bordo-50 dark:border-zinc-600">
																			<th style="max-width: 50%;" scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Comment
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Consistently
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Often
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Sometimes
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Seldom
																			</th>
																			<th scope="col" class="px-6 py-3 border-l border-bordo-50 dark:border-zinc-600">
																				Not Assessed
																			</th>
																		</tr>
																	</thead>
																	<tbody alinanlar="q4_<?php echo $value['ID']; ?>">
																		<?php 
																		if(have_rows('pdp_select_comments_q4', $group)): 
																			while(have_rows('pdp_select_comments_q4', $group)): 
																				the_row(); 
																				$sayac_buraya = get_row_index();
																				$kaydedilmis = get_pdp_select_comment($group, 4, $value['ID'], $sayac_buraya)[0]->comment_number;
																				?>
																				<tr secilecek_madde="q4_<?php echo $value['ID']; ?>" class="bg-white border border-bordo-50 dark:border-zinc-600 dark:bg-transparent">
																					<th style="max-width: 50%;" scope="row" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																						<?php echo get_sub_field('comment'); ?>
																					</th>
																					<td style="text-align: center;" class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 1){echo "checked";} ?> type="radio" name="q4_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 2){echo "checked";} ?> type="radio" name="q4_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 3){echo "checked";} ?> type="radio" name="q4_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 4){echo "checked";} ?> type="radio" name="q4_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																					<td class="px-6 py-3.5 border-l border-bordo-50 dark:border-zinc-600 dark:text-zinc-100">
																						<input <?php if($kaydedilmis == 5){echo "checked";} ?> type="radio" name="q4_<?php echo $value['ID']; ?>_<?php echo get_row_index(); ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500">
																					</td>
																				</tr>
																				<?php  
																			endwhile; 
																		endif;
																		?>
																	</tbody>
																</table>
																<div class="mb-3">
																	<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
																		Student Comment
																	</label>
																	<?php 
																	$comment_type = "pdp_long_comment";
																	$comment_control = get_long_comment($group, 4, $value['ID'],$comment_type);
																	$kontrol = intval($comment_control[0]->comment);
																	if(have_rows('pdp_normal_comments_q4', $group)): 
																		while(have_rows('pdp_normal_comments_q4', $group)): 
																			the_row(); 
																			?>
																			<div class="flex items-center mb-4 border border-bordo-50 dark:border-zinc-600 px-6 py-3">
																				<input <?php if ($kontrol == get_row_index()) {echo "checked";} ?> id="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" type="radio" name="pdp_normal_4_<?php echo $value['ID']; ?>" class="ring-0 ring-offset-0 focus:bg-violet-500 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" >
																				<label for="pdp_normal-<?php echo $value['ID']; ?>-<?php echo get_row_index(); ?>_4" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
																					<?php 
																					$metin = get_sub_field("comment"); 
																					$eski = "[student-name]";
																					$yeni = $value['display_name'];
																					echo str_replace($eski, $yeni, $metin);
																					?>
																				</label>
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
									<div style="justify-content: flex-end;" class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
										<h5>
											You can save only Quarter <?php echo get_field("active_quarter",$group); ?>
										</h5>
										<button active_quarter="<?php echo get_field("active_quarter",$group); ?>" comment_type="pdp_comment_sected" student="<?php echo $value['ID']; ?>" type="button" class="pdp_comment_select btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
											Save Comment
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
		}
	}

}

?>

<div class="modal relative z-50 hidden" id="delete-class" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-hidden">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700">
				<div class="bg-white dark:bg-zinc-600">
					<div class="sm:flex sm:items-start p-5">
						<div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
							<i class="mdi mdi-alert-outline me-2 text-xl text-red-500"></i>
						</div>
						<div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right">
							<h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title-delete-class">
								Delete Class
							</h3>
							<div class="mt-2">
								<p class="text-gray-500 dark:text-zinc-100/80">
									You are now about to delete the class. If you confirm, your class and all associated data will be deleted.
								</p>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
						<button id="delete-class-button" type="button" class="btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">
							Delete
						</button>
						<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal relative z-50 hidden" id="modal-move-to" aria-labelledby="modal-title" role="dialog" aria-modal="true">
	<div class="fixed inset-0 z-50 overflow-hidden">
		<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
		<div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
			<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700" style="overflow: initial !important;">
				<div class="bg-white dark:bg-zinc-600">
					<div class="sm:flex sm:items-start p-5" style="height: 30vh;">
						<div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
							<i class="mdi mdi-alert-outline me-2 text-xl text-red-500"></i>
						</div>
						<div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right" style="width: 100%;">
							<h3 id="move_student_name" move_student_id="" class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Deactivate account</h3>
							<div class="mt-2">
								<div class="mb-2">
									<label for="target_class" class="form-label font-medium text-13 text-gray-500 dark:text-zinc-100">
										Select Class
									</label>
								</div>
								<select class="border-gray-100" data-trigger name="target_class" id="target_class" placeholder="Target Class">
									<option value="">Target Class</option>
									<?php 
									if ($sub_Class === "Yes") {
										$args = array(
											'post_type' => 'user_groups',
											'meta_key' => 'sub_class', 
											'meta_value' => 'Yes',
											'meta_compare' => '=', 
										);
									}else{
										$args = array(
											'post_type' => 'user_groups',
											'meta_key' => 'sub_class', 
											'meta_value' => 'No',
											'meta_compare' => '=', 
										);
									}

									$my_posts = new WP_Query($args);
									if ($my_posts->have_posts()) {
										while ($my_posts->have_posts()) {
											$my_posts->the_post();
											?>
											<option value="<?php echo get_the_id(); ?>"><?php echo get_the_title(); ?></option>
											<?php 
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
						<button id="move_accept_btn" type="button" class="btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">
							Move To Class
						</button>
						<button id="move_popup_close" type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php  
if (get_user_access_write('class-files')) {
	$access_write = true;
}else{
	$access_write = false;
}
if (get_user_access_delete('class-files')) {
	$access_delete = true;
}else{
	$access_delete = false;
}
foreach ($gruoup_subjects as $key => $value) {
	?>
	<div class="modal relative z-50 hidden" id="upload_fiels_<?php echo $key; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 z-50 overflow-y-auto">
			<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
			<div class="animate-translate p-4 sm:max-w-4xl mx-auto">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
					<div class="bg-white dark:bg-zinc-700">
						<div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
								<?php echo get_the_title($value->ID); ?>
							</h3>
							<button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
								<i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
							</button>
						</div>
						<div class="p-6 space-y-6 ltr:text-left rtl:text-right" style="max-height: 80vh; overflow-y: scroll;">
							<div class="card-body flex flex-wrap">
								<div class="nav-tabs bar-tabs" style="width: 100%;">
									<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full overflow-hidden">
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-home-<?php echo $key; ?>" class="inline-block w-full p-4 <?php if (get_field("active_quarter",$group) == 1){echo "active";} ?>">
												Quarter 1
											</a>
										</li>
										<li class="w-full border-x border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-Profile-<?php echo $key; ?>" class="inline-block w-full p-4 <?php if (get_field("active_quarter",$group) == 2){echo "active";} ?>">
												Quarter 2
											</a>
										</li>
										<li class="w-full ltr:border-r rtl:border-l border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-setting-<?php echo $key; ?>" class="inline-block w-full p-4 <?php if (get_field("active_quarter",$group) == 3){echo "active";} ?>">
												Quarter 3
											</a>
										</li>
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="tab-full-u-contact-<?php echo $key; ?>" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg <?php if (get_field("active_quarter",$group) == 4){echo "active";} ?>">
												Quarter 4
											</a>
										</li>
									</ul>

									<div class="tab-content mt-5">
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 1){echo "block";}else{echo "hidden";} ?>" id="tab-full-u-home-<?php echo $key; ?>">
											<?php  
											$campus_id = get_current_blog_id();
											$file_type = 'exam';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,1,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Examinations
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Print
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>

															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php  
																	if ($files_data->ready_print == 0) {
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: red;" print_id="<?php echo $files_data->id; ?>" type="button" class="ready_print btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-remove-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}else{
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: green;" print_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-check-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}
																	?>
																	<?php if (get_field("active_quarter",$group) == 1): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 1): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="1" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
											<hr>
											<?php 
											$file_type = 'answer';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,1,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Marking Key (Answer Sheet)
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php if (get_field("active_quarter",$group) == 1): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 1): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file1_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="1" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
										</div>
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 2){echo "block";}else{echo "hidden";} ?>" id="tab-full-u-Profile-<?php echo $key; ?>">
											<?php  
											$campus_id = get_current_blog_id();
											$file_type = 'exam';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,2,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Examinations
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Print
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php  
																	if ($files_data->ready_print == 0) {
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: red;" print_id="<?php echo $files_data->id; ?>" type="button" class="ready_print btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-remove-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}else{
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: green;" print_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-check-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}
																	?>
																	<?php if (get_field("active_quarter",$group) == 2): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 2): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="2" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
											<hr>
											<?php 
											$file_type = 'answer';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,2,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Marking Key (Answer Sheet)
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php if (get_field("active_quarter",$group) == 2): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 2): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file2_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="2" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
										</div>
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 3){echo "block";}else{echo "hidden";} ?>" id="tab-full-u-setting-<?php echo $key; ?>">
											<?php  
											$campus_id = get_current_blog_id();
											$file_type = 'exam';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,3,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Examinations
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Print
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php  
																	if ($files_data->ready_print == 0) {
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: red;" print_id="<?php echo $files_data->id; ?>" type="button" class="ready_print btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-remove-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}else{
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: green;" print_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-check-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}
																	?>
																	<?php if (get_field("active_quarter",$group) == 3): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 3): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="3" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
											<hr>
											<?php 
											$file_type = 'answer';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,3,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Marking Key (Answer Sheet)
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php if (get_field("active_quarter",$group) == 3): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 3): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file3_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="3" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
										</div>
										<div class="tab-pane <?php if (get_field("active_quarter",$group) == 4){echo "block";}else{echo "hidden";} ?>" id="tab-full-u-contact-<?php echo $key; ?>">
											<?php  
											$campus_id = get_current_blog_id();
											$file_type = 'exam';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,4,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Examinations
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Print
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php  
																	if ($files_data->ready_print == 0) {
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: red;" print_id="<?php echo $files_data->id; ?>" type="button" class="ready_print btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-remove-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}else{
																		?>
																		<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																			<button style="background-color: green;" print_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 text-white px-5">
																				<i class="mdi mdi-sticker-check-outline block text-lg"></i>
																				<span class="">
																					Print
																				</span>
																			</button>
																		</td>
																		<?php 
																	}
																	?>
																	<?php if (get_field("active_quarter",$group) == 4): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 4): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="exam" popup_id="<?php echo $key; ?>" quarter_id="4" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>
													<?php endif ?>
												</div>
											</div>
											<hr>
											<?php 
											$file_type = 'answer';
											$target_files = get_uploaded_file_quarter($campus_id,$group,$value->ID,4,$file_type);
											?>
											<div class="card-body"> 
												<div class="relative overflow-x-auto" style="background-color: #f2f2f2 !important;">
													<table class="w-full text-sm text-left text-gray-500 ">
														<div style="text-align: center;" class="border border-gray-50 dark:border-zinc-600 px-6 py-3">
															<h4 style="color: #244b5a;">
																Marking Key (Answer Sheet)
															</h4>
														</div>
														<thead class="text-sm text-gray-700 dark:text-gray-100">
															<tr class="border border-gray-50 dark:border-zinc-600">
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	File Name
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Teacher
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	Date
																</th>
																<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																	View
																</th>
																<?php if ($access_delete): ?>
																	<th scope="col" class="px-6 py-3 border-l border-gray-50 dark:border-zinc-600">
																		Delete
																	</th>
																<?php endif ?>
															</tr>
														</thead>
														<tbody body_id="<?php echo $value->ID; ?>" id="file_list_<?php echo $key; ?>">
															<?php  
															foreach ($target_files as $file_number => $files_data) {
																?>
																<tr style="background-color: #f2f2f2 !important;" row_id="<?php echo $files_data->id; ?>" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">
																	<th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
																		<?php echo $files_data->file_name; ?>
																	</th>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php 
																		$current_user_edit_meta = get_user_meta($files_data->user_id); 
																		echo $current_user_edit_meta['first_name'][0].$current_user_edit_meta['last_name'][0];
																		?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<?php echo $files_data->date; ?>
																	</td>
																	<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																		<a target="_Blank" href="<?php echo $files_data->file_path; ?>">
																			<button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0">
																				<i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i>
																			</button>
																		</a>
																	</td>
																	<?php if (get_field("active_quarter",$group) == 4): ?>
																		<?php if ($access_delete): ?>
																			<td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
																				<button file_id="<?php echo $files_data->id; ?>" type="button" class="btn border-0 bg-red-400 text-white px-5 delete_file">
																					<i style="pointer-events: none;" class="mdi mdi-trash-can block text-lg"></i>
																					<span class="">
																						Delete
																					</span>
																				</button>
																			</td>
																		<?php endif ?>
																	<?php endif ?>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
													<?php if (get_field("active_quarter",$group) == 4): ?>
														<?php if ($access_write): ?>
															<div class="flex items-center border border-gray-50 dark:border-zinc-600 px-6 py-3">
																<form id="pdf-upload-form" style="width: 100%;">
																	<input style="width: 45%;" class="pdf-name4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="Define The Exam (LRT, Quiz, Project...)">
																	<input class="pdf-file4_<?php echo $key; ?> rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="file" accept=".pdf, .docx">
																	<button file_type="answer" popup_id="<?php echo $key; ?>" quarter_id="4" subject_id="<?php echo $value->ID; ?>" type="button" class="upload-button btn bg-green-500 border-green-500 text-white hover:bg-green-600 focus:ring ring-green-200 focus:bg-green-600">
																		<i class="bx bx-upload h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="margin-right: 0.5rem !important; color: #fff !important; pointer-events: none;"></i>
																		Upload File
																	</button>
																</form>
															</div>
														<?php endif ?>	
													<?php endif ?>
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
		</div>
	</div>
	<?php 
}


?>


<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var class_id = <?php echo $group; ?>
</script>
<?php get_footer(); ?>

<!-- choices js -->
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
	$(document).ready(function(){
		$(".ready_print").click(function () {
			print_id = $(this).attr("print_id");
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_ready_print',
					file_id:print_id,
				}),
				success: function(data){
					tamam = $('[print_id="'+print_id+'"]')[0];
					tamam.style.backgroundColor = "green";
				}
			});

		});

		$("#move_accept_btn").click(function () {
			move_selected_student = $("#move_student_name").text();
			move_selected_student_id = $("#move_student_name").attr("move_student_id");
			target_class_name = $("#target_class").text();
			target_class_id = $("#target_class").val();

			Swal.fire({
				title: "Are you sure?",
				text: "You will be moving '"+move_selected_student+"' to '"+target_class_name+"'",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				var value = $.ajax({
					method: "POST",
					url: get_site_url+'/wp-admin/admin-ajax.php',
					data: ({action:'my_ajax_move_student',
						move_selected_student_id:move_selected_student_id,
						target_class_id:target_class_id,
						current_class_id:<?php echo $group; ?>,
					}),
					success: function(data){
						console.log(data);
						student_dom = $('[student_row_id="'+move_selected_student_id+'"]');
						student_dom.remove();
						Swal.fire("Student moved to target class").then($('#move_popup_close').click());
						class_stundet_number();
					}
				});
			});

		});
		
		$(".move_to_btn").click(function () {
			move_student_name = $(this).attr("student_name");
			move_student_id = $(this).attr("student_id");

			$("#move_student_name").text(move_student_name);
			$("#move_student_name").attr('move_student_id',move_student_id);

		});

		$("#new_student_add_button").click(function () {
			Swal.fire({
				title: "Are you sure?",
				text: "You will be adding new student to class",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes"
			}).then(function (result) {
				if (result.value) {
					new_student_add = $("#new_student_add").val();
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_add_new_student',

							class_id:<?php echo $group; ?>,
							new_student_add:new_student_add,

						}),
						success: function(data){
							if (data.data[1] === "hata") {
								Swal.fire(
								{
									title: 'Problem',
									text: 'System didnt add the new student. Please contact with IT.',
									icon: 'question',
									showCancelButton: false,
									confirmButtonColor: '#8f1537',
								}
								)
							}else{
								Swal.fire(
								{
									title: 'Done',
									text: 'You added new student: '+data.data[2],
									icon: 'success',
									showCancelButton: false,
									confirmButtonColor: '#8f1537',
								}
								)
								var table = document.getElementById("student_control_list").getElementsByTagName('tbody')[0];
								var newRow = table.insertRow(table.rows.length);
								newRow.classList.add("bg-white", "border", "border-gray-50", "dark:border-zinc-600", "dark:bg-transparent");
								newRow.setAttribute("student_row_id", "");
								var cell1 = newRow.insertCell(0);
								var cell2 = newRow.insertCell(1);
								var cell3 = newRow.insertCell(2);
								var cell4 = newRow.insertCell(3);
								cell1.classList.add("px-6", "py-3.5", "border-l", "border-gray-50", "dark:border-zinc-600", "font-medium", "text-gray-900", "whitespace-nowrap", "dark:text-zinc-100");
								cell2.classList.add("px-6", "py-3.5", "border-l", "border-gray-50", "dark:border-zinc-600", "font-medium", "text-gray-900", "whitespace-nowrap", "dark:text-zinc-100");
								cell3.classList.add("px-6", "py-3.5", "border-l", "border-gray-50", "dark:border-zinc-600", "font-medium", "text-gray-900", "whitespace-nowrap", "dark:text-zinc-100");
								cell4.classList.add("px-6", "py-3.5", "border-l", "border-gray-50", "dark:border-zinc-600", "font-medium", "text-gray-900", "whitespace-nowrap", "dark:text-zinc-100");


								cell1.innerHTML = ""+data.data[3]+"";
								cell2.innerHTML = ""+data.data[2]+"";
								cell3.innerHTML = "";
								cell4.innerHTML = "";		
								class_stundet_number();

							}

						}
					});
				}
			});
		});

		$(".delete_student").click(function () {	
			delete_student_id = $(this).attr("student_delete_id");
			Swal.fire({
				title: "Are you sure?",
				text: "Student will remove from class!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#2ab57d",
				cancelButtonColor: "#fd625e",
				confirmButtonText: "Yes, remove!"
			}).then(function (result) {
				if (result.value) {
					var value = $.ajax({
						method: "POST",
						url: get_site_url+'/wp-admin/admin-ajax.php',
						data: ({action:'my_ajax_remove_student',
							class_id:<?php echo $group; ?>,
							delete_student_id:delete_student_id,
						}),
						success: function(data){
							student_dom = $('[student_row_id="'+delete_student_id+'"]');
							student_dom.remove();
							Swal.fire("Removed!", "'"+data.data[2]+"' was removed from class list.", "success"
								);
							class_stundet_number();
						}
					});
				}
			});
		});


		function class_stundet_number(){
			var studentRows = document.querySelectorAll('[student_row_id]');
			var rowCount = studentRows.length;
			var studentCountElement = document.getElementById('show_stundetn_count');
			studentCountElement.textContent = "Students ( "+rowCount+" )";
		}


		/**************************** V1 Alani *****************************************/
		for (var i = 0; i < $(".subjects_tab").length; i++) {
			if (i%2 === 0) {
				$(".subjects_tab")[i].style.backgroundColor = "#dddddd";
			}
		}

		$(".save_attandance").click(async function () {
			absent_student = $(".absent_student");
			absent_student_array = [];
			late_student_array = [];
			permitted_array = [];

			for (var i = 0; i < absent_student.length; i++) {
				absent_student_array[i] = $(".absent_student")[i].value;
				late_student_array[i] = $(".late_student")[i].value;
				permitted_array[i] = $(".permitted_student")[i].value;
			}

			console.log(student_list_class);
			console.log(absent_student_array);
			console.log(late_student_array);
			console.log(permitted_array);

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_student_attandance',

					class_id:<?php echo $group; ?>,
					attandance_quarter:2,
					student_list_class:student_list_class,
					absent_student_array:absent_student_array,
					late_student_array:late_student_array,
					permitted_array:permitted_array,

				}),
				success: function(data){
					console.log(data.data);
					if (data.data == "tamam") {
						Swal.fire(
						{
							title: 'Done',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});



		});

		$(".advisor_comment_select").click(async function () {
			selected_student = $(this).attr('student');
			selected_active_quarter = $(this).attr('active_quarter');
			selected_comment_type = $(this).attr('comment_type');



			secilen_normal_comment = "";
			pdp_normal = [];
			pdp_normal = $("[name='advisor_"+selected_active_quarter+"_"+selected_student+"']");
			for (var i = 0; i < pdp_normal.length; i++) {
				if (pdp_normal[i].checked) {
					secilen_normal_comment = i+1;
				}
			}

			console.log(secilen_normal_comment);


			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_grade_advisor_save',

					class_id:<?php echo $group; ?>,
					selected_student:selected_student,
					selected_active_quarter:selected_active_quarter,
					selected_comment_type:selected_comment_type,
					secilen_normal_comment:secilen_normal_comment,
				}),
				success: function(data){
					console.log(data.data);
					if (data.data == "tamam") {
						Swal.fire(
						{
							title: 'Done',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});



		});




		$(".pdp_comment_select").click(async function () {
			selected_student = $(this).attr('student');
			selected_active_quarter = $(this).attr('active_quarter');
			selected_comment_type = $(this).attr('comment_type');
			row_sayma = $("[secilecek_madde='q"+selected_active_quarter+"_"+selected_student+"']");
			comment_number = [];

			/**/
			secilen_normal_comment = "";
			pdp_normal = [];
			pdp_normal = $("[name='pdp_normal_"+selected_active_quarter+"_"+selected_student+"']");
			for (var i = 0; i < pdp_normal.length; i++) {
				if (pdp_normal[i].checked) {
					secilen_normal_comment = i+1;
				}
			}
			/**/

			for (var i = 1; i < row_sayma.length+1; i++) {
				radio_buttons = $("[name='q"+selected_active_quarter+"_"+selected_student+"_"+i+"']");
				for (var a = 0; a < 5; a++) {
					if (radio_buttons[a].checked) {
						comment_number[i-1] = a+1;
					}
				}
			}

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_select_comment_save',

					class_id:<?php echo $group; ?>,
					selected_student:selected_student,
					selected_active_quarter:selected_active_quarter,
					selected_comment_type:selected_comment_type,
					comment_number:comment_number,

					secilen_normal_comment:secilen_normal_comment,
				}),
				success: function(data){
					console.log(data.data);
					if (data.data == "tamam") {
						Swal.fire(
						{
							title: 'Done',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});



		});







		$("#sava_settings").click(function(){
			subject_credit = $(".subject_credit");
			subject_credit_array = []; 
			for (var i = 0; i < subject_credit.length; i++) {
				subject_credit_array[i] = subject_credit[i].value;
			}

			subject_lesson_hourse = $(".subject_lesson_hourse");
			subject_lesson_hourse_array = [];
			for (var i = 0; i < subject_lesson_hourse.length; i++) {
				subject_lesson_hourse_array[i] = subject_lesson_hourse[i].value;
			}

			remaining_time_q1 = $("#remaining_time_q1").val();
			remaining_time_q2 = $("#remaining_time_q2").val();
			remaining_time_q3 = $("#remaining_time_q3").val();
			remaining_time_q4 = $("#remaining_time_q4").val();
			active_quarter = $("#active_quarter").val();

			choices_multiple_advisor = $("#choices-multiple-advisor").val();
			choices_multiple_pdp = $("#choices-multiple-pdp").val();

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_class_settings',

					postID:<?php echo $group; ?>,
					choices_multiple_advisor:choices_multiple_advisor,
					choices_multiple_pdp:choices_multiple_pdp,
					lock_date_q1:remaining_time_q1,
					lock_date_q2:remaining_time_q2,
					lock_date_q3:remaining_time_q3,
					lock_date_q4:remaining_time_q4,
					active_quarter:active_quarter,

					subjecet_credit:subjecet_credit,
					subject_credit_array:subject_credit_array,
					subject_lesson_hourse_array:subject_lesson_hourse_array,
				}),
				success: function(data){
					console.log(data);
					if (isInt(data.data)) {
						Swal.fire(
						{
							title: 'Class Settings Saved',
							text: '',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#8f1537',
						}
						)
					}
				}

			});

		});


		$(".advisor_comment").click(function(){
			student_id = $(this).attr("student");
			student_order = $(this).attr("order");
			comment_type = 'advisor_comment';
			student_content = "";
			class_id = <?php echo $group; ?>;
			quarter_id = 1;
			secili_id = "";

			radioButtons = document.getElementsByName(comment_type+"-radio-"+student_id);
			for (var i = 0; i < radioButtons.length; i++) {
				if (radioButtons[i].checked) {
					secili_id = radioButtons[i];
					secili_id = secili_id.attributes.id.textContent;
					student_content = $("[for='"+secili_id+"']")[0].outerText;
					if (student_content === "") {
						student_content = $("[for='"+secili_id+"']")[0].value;
					}
				}
			}


			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_comments',

					student_id:student_id,
					student_content:student_content,
					class_id:class_id,
					quarter_id:quarter_id,
					secili_id:secili_id,

				}),
				success: function(data){
					if (data.data === "tamam") {
							//location.reload();
						$("[data-tw-target='#"+comment_type+"-"+student_id+"']").css("backgroundColor","green");
						alert("Your comment about your student has been saved");
					}else{
						console.log(data.data);
					}
				}

			});



		});





		function isInt(value) {
			return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
		}
		function userRegisterFunction(){

			group_name = $("#group_name").val();
			choices_multiple_default = $("#choices-multiple-default").val();
				//console.log(choices_multiple_student);

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_edit_group',

					postID:<?php echo $group; ?>,
					group_name:group_name,
					group_admin_email:choices_multiple_default,

				}),
				success: function(data){
					if (isInt(data.data)) {
						location.reload();
					}
				}

			});
		}


		function group_update_subjects(){
			choices_multiple_subject = $("#choices-multiple-subject").val();
				//console.log(choices_multiple_subject);
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_edit_subjects',

					postID:<?php echo $group; ?>,
					choices_multiple_subject:choices_multiple_subject,

				}),
				success: function(data){
					location.reload();
					console.log(data.data);
				}

			});


		}


		function delete_class(){
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_delete_class',

					classid:<?php echo $group; ?>,

				}),
				success: function(data){
					if (isInt(data.data.ID)) {
						window.location.href = "<?php echo get_site_url(); ?>/all-groups";
					}
					console.log(data.data.ID);
				}

			});
		}

		$("#update_group").click(function(){
			userRegisterFunction();
		});
		$("#update_group_subjects").click(function(){
			group_update_subjects();
		});

		$("#delete-class-button").click(function(){
			delete_class();
		});




	});



</script>

<script>
	jQuery(document).ready(function($) {
		$('.upload-button').on('click', function(e) {
			e.preventDefault();
			console.log(this);
			var quarter_id = $(this).attr("quarter_id");
			var popup_id = $(this).attr("popup_id");
			var formData = new FormData();
			var subject_id = $(this).attr("subject_id");

			var file_type = $(this).attr("file_type");
			if (file_type === "exam") {
				var pdfFile = $('.pdf-file'+quarter_id+"_"+popup_id)[0].files[0];
				var pdfFile_name = $('.pdf-name'+quarter_id+"_"+popup_id)[0].value;
			}else{
				var pdfFile = $('.pdf-file'+quarter_id+"_"+popup_id)[1].files[0];
				var pdfFile_name = $('.pdf-name'+quarter_id+"_"+popup_id)[1].value;
			}
			sayac = 0;
			if (quarter_id == 1) {
				if (file_type === "exam") {
					sayac = 0;
				}else{
					sayac = 1;
				}
			}else if(quarter_id == 2){
				if (file_type === "exam") {
					sayac = 2;
				}else{
					sayac = 3;
				}
			}else if(quarter_id == 3){
				if (file_type === "exam") {
					sayac = 4;
				}else{
					sayac = 5;
				}
			}else if(quarter_id == 4){
				if (file_type === "exam") {
					sayac = 6;
				}else{
					sayac = 7;
				}
			}

			formData.append('action', 'my_ajax_upload_file');
			formData.append('pdf_file', pdfFile);
			formData.append('pdf_name', pdfFile_name);
			formData.append('class_id', class_id);
			formData.append('subject_id', subject_id);
			formData.append('quarter_id', quarter_id);
			formData.append('file_type', file_type);

			$.ajax({
				url: get_site_url+'/wp-admin/admin-ajax.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(data){
					if (data.data != "error") {
						call_back_final = data;
						$('[body_id="'+subject_id+'"]')[sayac].innerHTML += '<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent"><th scope="row" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100"> '+call_back_final.data.file_name+' </th><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">---</td><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">'+call_back_final.data.date+'</td><td class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100"><a target="_Blank" href="'+call_back_final.data.link+'"><button style="background-color: #5156be !important; display: flex; align-items: center; justify-content: center;" type="button" class="btn rounded-full text-white bg-neutral-800 border-neutral-800 hover:bg-neutral-900 hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900" data-tw-toggle="modal" data-tw-target="#upload_fiels_0"><i class="bx bx-folder-open h-10 w-10 border border-gray-50 text-xl text-center leading-loose rounded-full text-gray-300 ltr:mr-5 rtl:ml-5 group-hover:border-transparent group-hover:bg-violet-50/50 group-hover:text-violet-500 transition-all duration-300 align-middle dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20" style="color: #fff !important; margin-right: initial !important;"></i></button></a></td></tr>';
						console.log(data);
					}
				}
			});
		});

		$('.delete_file').on('click', function(e) {
			silinecek_file = $(this).attr("file_id");
			console.log(silinecek_file);
			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_delete_file',

					silinecek_file:silinecek_file,

				}),
				success: function(data){
					console.log(data);
					delete_dom = $('[row_id="'+silinecek_file+'"]');
					delete_dom.remove();
				}

			});


		});
	});
</script>


<style>
	@media only screen and (min-width: 540px) {
		.sm\:max-w-4xl{
			max-width: 65rem !important;
		}
	}

	.ring-red-200{
		background-color: #8f1537 !important;
	}
	.ring-red-200:hover{
		background-color: rgb(215,154,42,1.0) !important;
	}
	.ring-red-200:focus{
		background-color: rgb(215,154,42,1.0) !important;
	}
</style>