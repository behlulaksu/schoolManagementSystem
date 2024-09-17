<?php /* Template Name: PDP */ ?>
<?php get_header(); ?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="col-span-12 xl:col-span-6">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body pb-0">
						<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
							All Students
						</h6>
					</div>

					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 12</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body block">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '12'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<?php 
													}
												} else {
													echo 'No users found.';
												}



												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 11</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '11'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 10</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '10'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 9</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '9'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 8</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '8'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 7</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '7'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 6</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '6'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div data-tw-accordion="collapse">
							<div class="accordion-item text-gray-700">
								<h2>
									<button type="button" class="accordion-header group active flex items-center justify-between w-full p-3 font-medium text-left border border-b-0 border-gray-100 rounded-t-lg hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
										<span class="text-15">Grade 5</span>
										<i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
										<i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
									</button>
								</h2>
								<div class="accordion-body hidden">
									<div class="p-5 font-light border border-b-0 border-gray-100 dark:border-zinc-600">

										<div class=" grid grid-cols-1">
											<div class="grid grid-cols-12 gap-5">
												<?php 
												$args = array(
													'role' => 'Student',
													'meta_query' => array(
														array(
															'key' => 'student_grade',
															'value' => '5'
														),
													),
												);

												$user_query = new WP_User_Query( $args );
												if ( ! empty( $user_query->get_results() ) ) {
													foreach ( $user_query->get_results() as $user ) {
														?>
														<div studentID="<?php echo $user->id; ?>" class="col-span-12 md:col-span-6 xl:col-span-3">
															<div class="card dark:bg-zinc-800 dark:border-zinc-600 mb-0">
																<div class="card-body">
																	<div class="mb-4">
																		<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="h-20 rounded-full mx-auto ring-1 ring-gray-100 p-1">
																	</div>
																	<div class="text-center">
																		<h5 class="text-16 text-gray-700 mb-1">
																			<a href="#" class="dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</a>
																		</h5>
																		<a href="mailto:<?php echo $value['user_email']; ?>" class="text-gray-500 dark:text-zinc-100 mb-2">
																			<?php echo $user->user_email; ?>
																		</a>
																	</div>
																</div>
																<div class="inline-flex rounded-md w-full" role="group">
																	<button type="button" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100" data-tw-toggle="modal" data-tw-target="#modal-id_wideButton<?php echo $user->id; ?>">
																		Profile
																	</button>
																	<a href="<?php echo get_site_url(); ?>/pdpdetail?student=<?php echo $user->id; ?>" class="btn px-4 py-2 text-sm w-full border rounded border-gray-50 rounded-r-none hover:bg-gray-50/50 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:text-gray-100">
																		Comments
																	</a>
																</div>
															</div>
														</div>

														<div class="modal relative z-50 hidden" id="modal-id_wideButton<?php echo $user->id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
															<div class="fixed inset-0 z-50 overflow-hidden">
																<div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
																<div class="animate-translate min-h-screen flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
																	<div class="relative -top-10 transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-700">
																		<div class="bg-white p-5 text-center dark:bg-zinc-700">
																			<div class="h-14 w-14 rounded-full bg-green-100 mx-auto">
																				<img src="<?php echo get_field("user_image","user_".$user->id)['sizes']['medium']; ?>" alt="" class="rounded-full mx-auto ring-1 ring-gray-100 p-1">
																			</div>
																			<h2 class="text-xl mt-5 text-gray-700 dark:text-gray-100">
																				<?php echo $user->display_name; ?>
																			</h2>
																			<div class="card-body">
																				<div class="grid grid-cols-12 gap-5">
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->display_name; ?>" id="user-display-name">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Registered</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_registered; ?>" id="user-registered">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('eyotek_id', 'user_'.$user->id); ?>" id="user-eyotek-id">
																						</div>
																					</div>
																					<div class="col-span-12 lg:col-span-6">
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $user->user_email; ?>" id="user-email">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Gender
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																						<div class="mb-4">
																							<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
																								Subject
																							</label>
																							<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('subject', 'user_'.$user->id); ?>" id="user-gender">
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="border-gray-50 mt-5 px-4 py-3 sm:flex justify-center sm:px-6">
																				<button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php 
													}
												} else {
													echo 'No users found.';
												}
												?>
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
<?php get_footer(); ?>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var class_id = '<?php echo $classid; ?>';
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/class-detail.js?ver=1"></script>