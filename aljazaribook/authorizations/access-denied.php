<?php 

function access_denieded($user_id, $page_link, $access_type){
	return '
	<div class="col-span-12 xl:col-span-12">
		<div class="card-body">
			<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-1 gap-5">
				<div class="px-6 py-3 text-center relative bg-red-100 border-2 border-red-200 rounded alert-dismissible" role="alert">
					<div class="mt-2 mb-4">
						<i class="mdi mdi-block-helper text-6xl text-red-500"></i>
					</div>
					<h5 class="text-red-500">Access Denied</h5>
					<p class="text-red-800 mt-1 mb-4">
						You are trying to access a page for which you do not have authorization. If you think you need authorization, please click
						<a style="color: #fff;" href="#">here</a>
					</p>
				</div>
			</div>
		</div>
	</div>';
}
