<?php /* Template Name: Student Profile */ ?>
<?php get_header(); ?>
<?php 
if (isset($_GET['student'])){
	$student = strip_tags($_GET["student"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
$pdp_student = get_user_by('id',$student);
?>
<?php $student_point = get_student_all_points($student); 




?>


<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">

			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">User Profile</h4>
				</div>
			</div>
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

				</div>

			</div>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Student All Points</h6>
						</div>
						<div class="card-body"> 
							<div class="relative overflow-x-auto">
								<table class="w-full text-sm text-left text-gray-500 ">
									<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
										<tr>
											<th scope="col" class="px-6 py-3">
												Point ID
											</th>
											<th scope="col" class="px-6 py-3">
												Class Name
											</th>
											<th scope="col" class="px-6 py-3">
												Quarter
											</th>
											<th scope="col" class="px-6 py-3">
												Percentage
											</th>
											<th scope="col" class="px-6 py-3">
												Point Type
											</th>
											<th scope="col" class="px-6 py-3">
												Point
											</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($student_point as $key => $value) { ?>
											<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
												<th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
													<?php echo $value->comment_ID; ?>
												</th>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php echo get_the_title($value->comment_karma); ?>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php echo $value->comment_type; ?>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100" style="display: flex;">
													<span>
														%
													</span>
													<div>
														<?php
														$deneme = get_field("add_not_to_quarter_1",$value->comment_karma);
														echo ($deneme[$value->comment_agent]['percentage']);
														?>
													</div>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php
													$deneme = get_field("add_not_to_quarter_1",$value->comment_karma);
													echo ($deneme[$value->comment_agent]['point_title']);
													?>
												</td>
												<td class="px-6 py-3.5 dark:text-zinc-100">
													<?php echo $value->comment_content; ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>