<?php /* Template Name: Upload Users Bulk */ ?>
<?php get_header(); ?>
<?php $current_user_id = get_current_user_id(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<div class="grid grid-cols-1 mb-5">
				<div class="flex items-center justify-between">
					<h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
						<?php echo get_the_title(); ?>
					</h4>
				</div>
			</div>

			<?php  
			if (get_user_access_read('upload-user-as-bulk')) {
				if (get_user_access_write('upload-user-as-bulk')) {
					?>
					<div class="grid grid-cols-1">
						<a href="<?php echo get_template_directory_uri(); ?>/files/Example Bulk User Upload.xlsx">
							Click here to download example exel file
						</a>
						<hr style="margin-bottom: 50px;">
						<input id="uploadusers" name="file" type="file">
					</div>
					<div id="veriGoster" class="relative overflow-x-auto"></div>
					<?php 
				}else{
					echo access_denieded($current_user_id,'upload-users-bulk','upload-user-as-bulk');
				}
			}else{
				echo access_denieded($current_user_id,'upload-users-bulk','upload-user-as-bulk');
			}

			?>


		</div>
	</div>
</div>



<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>


<script>
	$('#uploadusers').change(function (e) {

		var file = e.target.files[0];
		var reader = new FileReader();

		reader.onload = function (e) {
			var data = e.target.result;
			var workbook = XLSX.read(data, { type: 'binary' });
			var sheet_name_list = workbook.SheetNames;
			var sheet_name = sheet_name_list[0]; 

			var worksheet = workbook.Sheets[sheet_name];
			var veri = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_create_users_bulk',
					veri:veri,
				}),
				success: function(data){
					console.log(data);
					if (data.data.filename_error === "degismis") {
						alert("Dosya degismis");
					}
					var veriGosterDiv = $('#veriGoster');
					veriGosterDiv.empty();
					veriGosterDiv.append('<table class="w-full text-sm text-left text-gray-500 ">');
					for (var i = 0; i < veri.length; i++) {
						veriGosterDiv.append('<tr class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">');
						for (var j = 0; j < veri[i].length; j++) {
							veriGosterDiv.find('tr:last').append('<td style="border: 1px solid;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">' + veri[i][j] + '</td>');
						}
						veriGosterDiv.find('tr:last').append('<td style="border: 1px solid;" class="px-6 py-3.5 border-l border-gray-50 dark:border-zinc-600 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">' + data.data.added_users[i] + '</td>');

						veriGosterDiv.append('</tr>');
					}
					veriGosterDiv.append('</table>');


				}
			});


		};

		reader.readAsBinaryString(file);

	});
</script>

