<?php /* Template Name: Objectives Settings */ ?>
<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
<?php  
$bg_table_name = "objectives_define";


if (isset($_GET['grade'])){
	$grade = strip_tags($_GET["grade"]); 
	$query = $wpdb->prepare("SELECT * from $bg_table_name where grade =".$grade);
	$sonuclar1 = $wpdb->get_results($query);
}else{
	$grade = "All";
	$query = $wpdb->prepare("SELECT * from $bg_table_name");
	$sonuclar1 = $wpdb->get_results($query);
}
?>

<div class="main-content">
	<div class="page-content dark:bg-zinc-700"  style="width: 100%; height: 100%;">
		<div class="container-fluid px-[0.625rem]"  style="width: 100%; height: 100%;">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100" style="display: flex; align-items: center; color: #8f1537 !important;">
						Grade <?php echo $grade; ?> Objectives
					</h4>
					<a style="margin-right: 15px;" href="https://book.aljazari.com.tr/proje/atakent-1-2023-2024/wp-content/uploads/sites/29/2024/07/Objective-Excel-Sheets.xlsx">
						<button type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600">
							<i class="bx bx-download bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
							<span class="px-3 leading-[2.8]">
								Sample Excel File
							</span>
						</button>
					</a>
					<a style="margin-right: 15px;" href="<?php echo get_site_url(); ?>/upload-objectives">
						<button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
							<i class="bx bx-upload bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
							<span class="px-3 leading-[2.8]">
								Upload Objectives
							</span>
						</button>
					</a>
					<a href="<?php echo get_site_url(); ?>/add-new-objective">
						<button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
							<i class="bx bx-add-to-queue bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
							<span class="px-3 leading-[2.8]">
								Add New Objective
							</span>
						</button>
					</a>
				</div>
			</div>

			<div class="col-span-12">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body relative overflow-x-auto">
						<table id="example" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">

							<thead>
								<tr>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">
										Campus
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Grade
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Subject
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Code 1
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Code 2
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Objective
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Details
									</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">
										Edit
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sonuclar1 as $key => $value): ?>
									<tr>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php  
											print_r(get_blog_details($value->add_campus)->blogname);
											?>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->grade; ?>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->subject; ?>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->code1; ?>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->code2; ?>
										</td>
										<td class="p-2 pr-4 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->objecttive_content; ?>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<a href="<?php echo get_site_url(); ?>/objectives-details?obj=<?php echo $value->id; ?>">
												<button type="button" class="btn text-black bg-gray-50 border-gray-50 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-500/30 active:bg-gray-300 active:border-gray-300">
													<i class="bx bx-hourglass text-16 align-middle ltr:mr-1 rtl:ml-1 animate-spin"></i>
													<span class="align-middle">
														Detail
													</span>
												</button>
											</a>
										</td>
										<td class="p-2 pr-4 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<a href="<?php echo get_site_url(); ?>/edit-objective?obj=<?php echo $value->id; ?>">
												<button type="button" class="btn border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
													<i class="bx bxs-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
													<span class="px-3 leading-[2.8]">
														Edit
													</span>
												</button>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<th class="border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
										Campus
									</th>
									<th>
										Grade
									</th>
									<th>
										Subject
									</th>
									<th>
										Code 1
									</th>
									<th>
										Code 2
									</th>
								</tr>
							</tfoot>
						</table>

					</div>
				</div>
			</div>


		</div>
	</div>
</div>


<?php get_footer(); ?>
<!-- Required datatable js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/datatables.init.js"></script> 

<style>
	tfoot select{
		width: 100%;
	}
</style>

<script>
	//https://datatables.net/examples/api/multi_filter.html
	new DataTable('#example', {
		lengthMenu: [10, 25, 50],
		initComplete: function () {
			this.api()
			.columns()
			.every(function () {
				let column = this;

                // Create select element
				let select = document.createElement('select');
				select.add(new Option(''));
				column.footer().replaceChildren(select);

                // Apply listener for user change in value
				select.addEventListener('change', function () {
					column
					.search(select.value, {exact: true})
					.draw();
				});

                // Add list of options
				column
				.data()
				.unique()
				.sort()
				.each(function (d, j) {
					select.add(new Option(d));
				});
			});
		}
	});
</script>