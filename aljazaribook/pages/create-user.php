<?php /* Template Name: Create User Page */ ?>

<?php 
if (isset($_GET['stundet'])){
	$usur_type = strip_tags($_GET["stundet"]); 
}
?>

<?php get_header(); ?>

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
			<?php $userKontrol = get_user_by( 'email', 'student1@aljazari.k12.tr' ); 
			echo $userKontrol2 = get_field('school_no', 'user_'.$userKontrol->data->ID);
			?>
			<div class="grid grid-cols-12 gap-5">
				<div class="col-span-12 xl:col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body"> 
							<div class="grid gap-6 mb-6 md:grid-cols-2">
								<div>
									<label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										First name
									</label>
									<input type="text" id="first_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="First name" required>
								</div>
								<div>
									<label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										Last name
									</label>
									<input type="text" id="last_name" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Last name" required>
								</div>
								<div>
									<label for="tc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										Nationality ID (TC)
									</label>
									<input type="text" id="tc" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="TC" required>
								</div>  
								<div>
									<label for="schoolno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										School No (Eyotek)
									</label>
									<input type="number" id="schoolno" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="School No" required>
								</div>
								<div>
									<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										Gender
									</label>
									<select id="gender" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option>Male</option>
										<option>Fmale</option>
									</select>
								</div>
								<div>
									<label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										Birthday
									</label>
									<input type="date" id="birthday" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Birthday" required>
								</div>
								<div>
									<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Grade</label>
									<select id="studentgrade" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<option>KG -1</option>
										<option>KG -2</option>
										<option>KG -3</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
									</select>
								</div>
								<div>
									<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										Email
									</label>
									<input type="email" id="email" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Email" required>
								</div>
								<div>
									<label for="userpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-50">
										Password
									</label>
									<input type="text" id="userpassword" class=" border border-gray-100 text-gray-900 text-sm rounded focus:ring-violet-100 focus:border-violet-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100/60 dark:text-zinc-100" placeholder="Password" required>
								</div>
								<div>
									<label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
										User Role
									</label>
									<select id="userrole" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
										<?php 
										if ($usur_type === "true") {
											?>
											<option value="student" selected>Student</option>
											<?php
										}else{
											?>
											<option value="principal">Principal</option>
											<option value="viceprincipal">Vice Principal</option>
											<option value="hod">HOD</option>
											<option value="pdp">PDP</option>
											<option value="studentaff">Student Affairs</option>
											<option value="it">IT</option>
											<option value="teacher">Teacher</option>
											<option value="student">Student</option>
											<?php
										}
										?>

									</select>
								</div>
							</div>
							<button id="create_user" type="submit" class="text-white bg-violet-500 hover:bg-violet-700 focus:ring-2 focus:ring-violet-100 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
								Crearte
							</button>
							
							<div class="onaybutonu" style="margin-top: 50px;"></div>
							
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/add-user.js?ver=2"></script>