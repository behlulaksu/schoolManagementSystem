<?php /* Template Name: Unauthorized Access */ ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<title>Unauthorized Access</title>
	<meta
	name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no"
	/>
	<meta
	content="Tailwind Admin & Dashboard Template"
	name="description"
	/>
	<meta content="" name="Themesbrand" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico" />


	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/icons.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind.css" />



</head>

<body data-mode="light" data-sidebar-size="lg">

	<?php  
	$current_user_id = get_current_user_id();
	$user_all_sites = get_blogs_of_user($current_user_id);
	$dashboard_link = "";
	foreach ($user_all_sites as $key => $value) {
		$dashboard_link = $value->siteurl;
	}
	?>


	<div class="container-fluid">
		<div class="bg-gray-50/20 h-screen dark:bg-zinc-800">
			<div>
				<div class="container mx-auto">
					<div class="grid grid-cols-12 justify-center">
						<div class="col-span-12">
							<div class="text-center">
								<h1 class="text-8xl text-gray-600 mb-3 dark:text-gray-100">Sorry</h1>
								<h4 class="uppercase mb-2 text-gray-600 text-[21px] dark:text-gray-100">Unauthorized Access</h4>
							</div>
							<div class="mt-12 text-center">
								<a class="btn bg-violet-500 border-transparent focus:ring focus:ring-violet-50 py-2 text-white" href="<?php echo $dashboard_link; ?>">
									Back to Dashboard
								</a>
							</div>
						</div>
						<div class="col-span-8 col-start-3">
							<div class="pt-12">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/error-img.png" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/@popperjs/core/umd/popper.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/feather-icons/feather.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/metismenujs/metismenujs.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/feather-icons/feather.min.js"></script>

	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>
</body>

</html>