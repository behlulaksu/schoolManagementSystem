<?php /* Template Name: Create Gradebook */ ?>
<?php get_header(); ?>
<?php $current_user_id = get_current_user_id(); ?>


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
			if (get_user_access_read('create-module')) {
				if (get_user_access_write('create-module')) {
					?>
					<div class="grid grid-cols-12 gap-5">
						<div class="col-span-12 xl:col-span-12">
							<div class="card dark:bg-zinc-800 dark:border-zinc-600">
								<div class="card-body"> 
									<div class="grid gap-6 mb-6 md:grid-cols-1">
										<div>
											<label for="group_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
												Gradebook Definition Name
											</label>
											<input type="text" id="group_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Gradebook" required>
										</div>
									</div>
									<button id="create_group" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
										Create
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php 
				}else{
					echo access_denieded($current_user_id,'create-gradebook','create-module');
				}
			}else{
				echo access_denieded($current_user_id,'create-gradebook','create-module');
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>


<script>
	$(document).ready(function(){

		function userRegisterFunction(){

			group_name = $("#group_name").val();

			var value = $.ajax({
				method: "POST",
				url: get_site_url+'/wp-admin/admin-ajax.php',
				data: ({action:'my_ajax_create_gradebook',

					group_name:group_name,

				}),
				success: function(data){
					console.log(data);
					location.href = "<?php echo get_site_url(); ?>/gradebook-definitions-edit/?id="+data.data;
				}

			});
		}

		$("#create_group").click(function(){
			userRegisterFunction();
		});
	});



</script>

