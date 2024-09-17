<?php /* Template Name: PDP Detail */ ?>
<?php get_header(); ?>
<?php 
if (isset($_GET['student'])){
	$student = strip_tags($_GET["student"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>/pdp";
	</script>
	<?php 
}
$pdp_student = get_user_by('id',$student);
?>
<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">User Profile</h4>
				</div>
			</div>
			<?php //print_r($pdp_student); ?>
			<div class=" grid grid-cols-12 gap-4">
				<div class="col-span-12 lg:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body ">
							<div class="grid grid-cols-12 ">
								<div class="col-span-9">
									<div class="flex flex-wrap items-center">
										<div class="h-20 w-20 ltr:mr-1 rtl:ml-1">
											<?php $user_image = get_field('user_image', 'user_'.$student); ?>
											<img src="<?php echo $user_image['url']; ?>" alt="" class="rounded-full">
										</div>
										<div style="padding-left: 30px;">
											<h5 class="text-16 mb-1 text-gray-700 dark:text-gray-100">
												<?php echo $pdp_student -> display_name; ?>
											</h5>
											<p class="text-gray-500 dark:text-zinc-100 text-13">
												<?php echo $pdp_student->roles[0]; ?>
											</p>

											<div class="flex flex-wrap items-start gap-2 text-13 mt-3">
												<div class="text-gray-500 dark:text-zinc-100">
													<i class="mdi mdi-circle-medium me-1 text-green-500 align-middle ltr:mr-1 rtl:ml-1"></i>
													<?php echo get_field('subject', 'user_'.$student); ?>
												</div>
												<div class="text-gray-500 dark:text-zinc-100">
													<i class="mdi mdi-circle-medium me-1 text-green-500 align-middle ltr:mr-1 rtl:ml-1"></i> Grade
													<?php echo get_field('student_grade', 'user_'.$student); ?>
												</div>
												<a href="mailto:<?php echo $pdp_student->data->user_email; ?>" class="text-gray-500 dark:text-zinc-100">
													<i class="mdi mdi-circle-medium me-1 text-green-500 align-middle ltr:mr-1 rtl:ml-1"></i>
													<?php echo $pdp_student->data->user_email; ?>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body border-b border-gray-50 dark:border-zinc-600">
							<div class="flex">
								<div class="grow">
									<h5 class="text-15 text-gray-700 dark:text-gray-100">Studetn Detail</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="grid grid-cols-12 gap-5">
								<div class="col-span-12 lg:col-span-6">
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $pdp_student -> display_name; ?>" id="user-display-name">
									</div>
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $pdp_student->data->user_registered; ?>" id="user-registered">
									</div>
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$student); ?>" id="user-eyotek-id">
									</div>
								</div>
								<div class="col-span-12 lg:col-span-6">
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $pdp_student->data->user_email; ?>" id="user-email">
									</div>
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
											Gender
										</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$student); ?>" id="user-gender">
									</div>
									<div class="mb-4">
										<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
											Subject
										</label>
										<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$student); ?>" id="user-gender">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body">
							<div class="pb-3">
								<div class="grid grid-cols-12">
									<div class="col-span-2">
										<div>
											<h5 class="text-15 text-gray-700 dark:text-gray-100">Bio :</h5>
										</div>
									</div>
									<div class="col-span-10">
										<div class="text-gray-500 dark:text-zinc-100">
											<p class="mb-2">
												<?php echo get_field('user_bio', 'user_'.$student); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-span-12 xl:col-span-6">
						<div class="card dark:bg-zinc-800 dark:border-zinc-600">
							<div class="card-body pb-0">
								<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Report Card Comment</h6>
							</div>
							<div class="card-body flex flex-wrap">
								<div class="nav-tabs bar-tabs">
									<ul class="nav text-sm font-medium text-center text-gray-500 dark:divide-gray-900 rounded-lg shadow sm:flex w-full overflow-hidden">
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-home" class="inline-block w-full p-4 active">Quarter 1</a>
										</li>
										<li class="w-full border-x border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-Profile" class="inline-block w-full p-4">Quarter 2</a>
										</li>
										<li class="w-full ltr:border-r rtl:border-l border-gray-50">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-setting" class="inline-block w-full p-4">Quarter 3</a>
										</li>
										<li class="w-full">
											<a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="bar-u-contact" class="inline-block w-full p-4 ltr:rounded-r-lg rtl:rounded-l-lg">Quarter 4</a>
										</li>
									</ul>
									<style>
										.secmeli-alanlar{
											display: flex; 
										}
									</style>
									<div class="tab-content mt-5">
										<div class="tab-pane block" id="bar-u-home">
											<p class="mb-0 dark:text-gray-300">
												Raw denim you probably haven't heard of them jean shorts Austin.
												Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
												cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
												butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
												qui irure terry richardson ex squid. Aliquip placeat salvia cillum
												iphone. Seitan aliquip quis cardigan american apparel, butcher
												voluptate nisi qui.
											</p>
											<hr style="margin-top: 10px; margin-bottom: 10px;">
											<?php  if(have_rows('add_type', 'options')): 
												while(have_rows('add_type', 'options')): 
													the_row(); 
													$ust_row_id = get_row_index();
													?>
													<h4 class="dark:text-gray-300">
														<?php echo get_sub_field("title"); ?>
													</h4>
													<?php  if(have_rows('comment_text', 'options')): 
														while(have_rows('comment_text', 'options')): 
															the_row(); 
															$alt_row_id = get_row_index();
															?>
															<div class="secmeli-alanlar grid grid-cols-12">
																<h6 class="col-span-4 dark:text-gray-300">
																	<?php echo get_sub_field("text"); ?>
																</h6>
																<div class="form-check col-span-2">
																	<input type="checkbox" class="rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500" id="for-<?php echo $ust_row_id; ?>-a-<?php echo $alt_row_id; ?>">
																	<label class="ml-2 font-medium text-gray-700 dark:text-zinc-100" for="for-<?php echo $ust_row_id; ?>-a-<?php echo $alt_row_id; ?>">Excellent</label>
																</div>
																<div class="form-check col-span-2">
																	<input type="checkbox" class="rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500" id="for-<?php echo $ust_row_id; ?>-b-<?php echo $alt_row_id; ?>">
																	<label class="ml-2 font-medium text-gray-700 dark:text-zinc-100" for="for-<?php echo $ust_row_id; ?>-b-<?php echo $alt_row_id; ?>">Very Good</label>
																</div>
																<div class="form-check col-span-2">
																	<input type="checkbox" class="rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500" id="for-<?php echo $ust_row_id; ?>-c-<?php echo $alt_row_id; ?>">
																	<label class="ml-2 font-medium text-gray-700 dark:text-zinc-100" for="for-<?php echo $ust_row_id; ?>-c-<?php echo $alt_row_id; ?>">Good</label>
																</div>
																<div class="form-check col-span-2">
																	<input type="checkbox" class="rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500" id="for-<?php echo $ust_row_id; ?>-d-<?php echo $alt_row_id; ?>">
																	<label class="ml-2 font-medium text-gray-700 dark:text-zinc-100" for="for-<?php echo $ust_row_id; ?>-d-<?php echo $alt_row_id; ?>">Average</label>
																</div>
															</div>
															<hr style="margin-top: 5px; margin-bottom: 5px;">
														<?php endwhile; 
													endif; ?>

												<?php endwhile; 
											endif; ?>
										</div>
										<div class="tab-pane hidden" id="bar-u-Profile">
											<p class="mb-0 dark:text-gray-300">
												Denim you probably haven't heard of them jean shorts Austin.
												Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
												cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
												butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
												qui irure terry richardson ex squid. Aliquip placeat salvia cillum
												iphone. Seitan aliquip quis cardigan american apparel, butcher
												voluptate nisi qui.
											</p>
										</div>
										<div class="tab-pane hidden" id="bar-u-setting">
											<p class="mb-0 dark:text-gray-300">
												You probably haven't heard of them jean shorts Austin.
												Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
												cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
												butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
												qui irure terry richardson ex squid. Aliquip placeat salvia cillum
												iphone. Seitan aliquip quis cardigan american apparel, butcher
												voluptate nisi qui.
											</p>
										</div>
										<div class="tab-pane hidden" id="bar-u-contact">
											<p class="mb-0 dark:text-gray-300">
												Enim you probably haven't heard of them jean shorts Austin.
												Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
												cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
												butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
												qui irure terry richardson ex squid. Aliquip placeat salvia cillum
												iphone. Seitan aliquip quis cardigan american apparel, butcher
												voluptate nisi qui.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php  if(have_rows('add_comment_area_'.get_field('student_grade', 'user_'.$student), 'options')): 
						while(have_rows('add_comment_area_'.get_field('student_grade', 'user_'.$student), 'options')): 
							the_row(); 
							?>
							<div class="card dark:bg-zinc-800 dark:border-zinc-600">
								<div class="card-body">
									<div class="pb-3">
										<div class="grid grid-cols-12">
											<div class="col-span-2">
												<div>
													<h5 class="text-15 text-gray-700 dark:text-gray-100">
														<?php echo get_sub_field("comment_area_name"); ?> :
													</h5>
												</div>
											</div>
											<div class="col-span-7" style="padding-right: 20px;">
												<div class="text-gray-500 dark:text-zinc-100">
													<textarea class="border-gray-100 block w-full mt-2 rounded placeholder:text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100/80 dark:placeholder:text-zinc-100/80 focus:ring-2 focus:ring-offset-0 focus:ring-violet-500/30" rows="2" placeholder="<?php echo get_sub_field("comment_area_default_value"); ?>"></textarea>
												</div>
											</div>
											<div class="col-span-2">
												<div class="text-gray-500 dark:text-zinc-100">
													<h5 class="text-15 text-gray-700 dark:text-gray-100">
														Who Can See
													</h5>
													<h6>
														<?php echo get_sub_field("who_can_see"); ?>
													</h6>
												</div>
											</div>
											<div class="col-span-1">
												<div class="text-gray-500 dark:text-zinc-100">
													<button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">SAVE</button>
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
	</div>
</div>



<?php get_footer(); ?>
