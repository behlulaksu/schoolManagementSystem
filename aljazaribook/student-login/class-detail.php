<?php /* Template Name: Student Class Detail */ ?>
<?php include 'header.php';?>
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

$ogrenci_kontrol = false;
$group_users = get_field("group_users",$group); 
foreach ($group_users as $key => $value) {
	if ($value['ID'] == get_current_user_id()) {
		$ogrenci_kontrol = true;
	}
}

if (!$ogrenci_kontrol) {
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 
}
?>


<div class="page-content dark:bg-zinc-700">
	<div class="container-fluid px-[0.625rem]">
		<div class="grid grid-cols-12 gap-5">
			<div class="col-span-12 xl:col-span-12">
				<div class="card-body"> 
					<h4 style="margin-bottom: 20px; text-align: center; color: #d79a2a !important;">
						<?php echo get_the_title($group); ?>
					</h4>
					<div class="relative overflow-x-auto">
						<table class="w-full text-sm text-left text-gray-500 ">
							<thead class="text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-zinc-600">
								<tr style="background-color: #8f1537;">
									<th style="color: #fff; text-align: left;" scope="col" class="px-6 py-3">
										Subject Title
									</th>
									<th style="color: #fff;" scope="col" class="px-6 py-3">
										Quarter 1
									</th>
									<th style="color: #fff;" scope="col" class="px-6 py-3">
										Quarter 2
									</th>
									<th style="color: #fff;" scope="col" class="px-6 py-3">
										Quarter 3
									</th>
									<th style="color: #fff;" scope="col" class="px-6 py-3">
										Quarter 4
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$gruoup_subjects = get_field("subject_for_group",$group); 
								foreach ($gruoup_subjects as $key => $value) {
									$select_lesson_type = get_field("select_lesson_type",$value->ID);
									?>
									<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
										<th style="color: #d79a2a !important; font-weight: bold; text-align: left;" scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
											<?php echo $select_lesson_type[0]->post_title; ?>
										</th>
										<td class="px-6 py-3.5 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-subject-report?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=1&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													Graphic
												</button>
											</a>
											<a href="<?php echo get_site_url(); ?>/student-gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=1&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-pen"></i>
													Marks
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-subject-report?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=2&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													Graphic
												</button>
											</a>
											<a href="<?php echo get_site_url(); ?>/student-gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=2&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-pen"></i>
													Marks
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-subject-report?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=3&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													Graphic
												</button>
											</a>
											<a href="<?php echo get_site_url(); ?>/student-gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=3&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-pen"></i>
													Marks
												</button>
											</a>
										</td>
										<td class="px-6 py-3.5 dark:text-zinc-100">
											<a href="<?php echo get_site_url(); ?>/student-subject-report?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=4&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-graph"></i>
													Graphic
												</button>
											</a>
											<a href="<?php echo get_site_url(); ?>/student-gradebook?group=<?php echo $group; ?>&subject=<?php echo $value->ID; ?>&quarter=4&student=<?php echo get_current_user_id(); ?>">
												<button style="margin-bottom: 7px; background-color: #8e1838;" type="button" class="popop_button btn ring-red-200 text-white hover:bg-yellow-600 focus:ring ring-yellow-200 focus:bg-yellow-600">
													<i class="mdi mdi-pen"></i>
													Marks
												</button>
											</a>
										</td>
									</tr>
									<?php 
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	th{
		text-align: center;
	}
	td{
		text-align: center;
	}
</style>
<?php include 'footer.php';?>