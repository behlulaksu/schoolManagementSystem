<?php /* Template Name: Student Profile */ ?>
<?php $current_user_now = wp_get_current_user(); ?>
<?php include 'header.php';?>


<div class="page-content dark:bg-zinc-700">
	<div class="container-fluid px-[0.625rem]">
		<div class=" grid grid-cols-12 gap-4">
			<div class="col-span-12 lg:col-span-12">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body">
						<div class="grid grid-cols-12 ">
							<div class="col-span-12">
								<div class="flex flex-wrap items-center">
									<div class="h-20 w-20 ltr:mr-1 rtl:ml-1" style="padding-right: 15px;">
										<?php $user_image = get_field('user_image', 'user_'.get_current_user_id()); ?>
										<?php  
										if (empty($user_image)) {
											?>
											<img src="https://book.aljazari.com.tr/proje/atakent-1-2023-2024/wp-content/themes/aljazaribook/assets/images/users/avatar-6.jpg" alt="" class="rounded-full">
											<?php 
										}else{
											?>
											<img src="<?php echo $user_image['url']; ?>" alt="" class="rounded-full">
											<?php
										}
										?>
									</div>
									<div>
										<h5 class="text-16 mb-1 text-gray-700 dark:text-gray-100">
											<?php echo $current_user_now -> display_name; ?>
										</h5>
										<p class="text-gray-500 dark:text-zinc-100 text-13">
											<?php echo $current_user_now->roles[0]; ?>
										</p>

										<div class="flex flex-wrap items-start gap-2 text-13 mt-3">
											<a href="mailto:<?php echo $current_user_now->data->user_email; ?>" class="text-gray-500 dark:text-zinc-100">
												<i class="mdi mdi-circle-medium me-1 text-green-500 align-middle ltr:mr-1 rtl:ml-1"></i>
												<?php echo $current_user_now->data->user_email; ?>
											</a>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-span-3">
								<div class="flex flex-wrap justify-end">
									<button type="button" class="btn bg-gray-50/50 border-transparent dark:bg-zinc-700 dark:text-gray-100"><i class="me-1"></i> Message</button>
									<div class="dropstart text-end relative">
										<a class="btn border-transparent px-6 py-1 text-16 text-gray-500 dark:text-zinc-100 shadow-none dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
											<i class="bx bx-dots-horizontal-rounded"></i>
										</a>
										<ul class=" dropdown-menu min-w-max absolute bg-white z-50 float-left py-2 list-none text-left -right-10 top-6 w-40 rounded-lg shadow-lg hidden bg-clip-padding border-none dark:bg-zinc-700" aria-labelledby="dropdownMenu1">
											<li>
												<a
												class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-600/50"
												href="#">Action</a>
											</li>
											<li>
												<a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
												bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-600/50" href="#">Another action</a >
											</li>
											<li>
												<a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent
												text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-600/50" href="#">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div> -->
						</div>

					</div>
				</div>
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body border-b border-gray-50 dark:border-zinc-600">
						<div class="flex">
							<div class="grow">
								<h5 class="text-15 text-gray-700 dark:text-gray-100">Post</h5>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="grid grid-cols-12 gap-5">
							<div class="col-span-12 lg:col-span-6">
								<div class="mb-4">
									<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Display Name</label>
									<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $current_user_now -> display_name; ?>" id="user-display-name">
								</div>
								<div class="mb-4">
									<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Eyotek ID</label>
									<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('school_no', 'user_'.get_current_user_id()); ?>" id="user-eyotek-id">
								</div>
							</div>
							<div class="col-span-12 lg:col-span-6">
								<div class="mb-4">
									<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">User Email</label>
									<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo $current_user_now->data->user_email; ?>" id="user-email">
								</div>
								<div class="mb-4">
									<label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">
										Gender
									</label>
									<input disabled class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="<?php echo get_field('gender', 'user_'.get_current_user_id()); ?>" id="user-gender">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body">
						<div>
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
												<?php echo get_field('user_bio', 'user_'.get_current_user_id()); ?>
											</p>
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


<?php include 'footer.php';?>
