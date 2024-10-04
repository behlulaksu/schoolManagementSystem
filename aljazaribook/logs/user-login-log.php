<?php /* Template Name: User Login Log */ ?>

<?php 
if (isset($_GET['userID'])){
	$userID = strip_tags($_GET["userID"]); 
}else{
	?>
	<script>
		window.location.href = "<?php echo get_site_url(); ?>";
	</script>
	<?php 

}
$blog_id = get_current_blog_id();
$user = get_user_by('id', $userID);

global $wpdb;
$book_objective = "user_login_logs";
$one_month_ago = date('Y-m-d H:i:s', strtotime('-1 month')); // Son bir ay
$one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week')); // Son bir hafta
$today_start = date('Y-m-d 00:00:00'); // Bugünün başlangıcı

// Son bir ay içindeki girişleri almak
$query = $wpdb->prepare("SELECT * from $book_objective WHERE user_id = ".$userID." AND login_time >= %s", $one_month_ago);
$sonuclar = $wpdb->get_results($query);

// Sonuçları kategorilere ayırmak için değişkenler
$bugun = [];
$birhafta = [];
$biray = []; // Son bir ay için veri tutacağımız yeni dizi

// Gelen sonuçları döngüyle işlemek
foreach ($sonuclar as $sonuc) {
    // Eğer bugünkü girişse
	if ($sonuc->login_time >= $today_start) {
		$bugun[] = $sonuc;
	}
    // Eğer son bir hafta içindeki girişse
	if ($sonuc->login_time >= $one_week_ago) {
        $birhafta[] = $sonuc; // Haftalık girişleri ayrı topluyoruz
    }
    // Eğer son bir ay içindeki girişse (her şeyi dahil ediyoruz)
    if ($sonuc->login_time >= $one_month_ago) {
        $biray[] = $sonuc; // Aylık girişleri ayrı topluyoruz
    }
}

/* Saat ayıklama - Bugün olan girişleri saat bazında ayıklama */
$saat_girisleri = array_fill(0, 24, 0); // 0'dan 23'e kadar olan saatleri 0 olarak başlatıyoruz

// Bugünkü girişleri saat bazında işlemek
foreach ($bugun as $sonuc) {
    $saat = (int)date('H', strtotime($sonuc->login_time)); // Girişin saat kısmını alıyoruz (0-23 arasında bir değer)
    $saat_girisleri[$saat]++; // O saate karşılık gelen değeri 1 artırıyoruz
}

/* Son 7 gün için istatistik */
$gun_girisleri = array_fill(0, 7, 0); // Son 7 günün her biri için giriş sayısını tutan dizi
$gun_isimleri = []; // Son 7 günün isimlerini tutacak dizi

for ($i = 0; $i < 7; $i++) {
    // Her günün başlangıcı
	$gun_baslangici = date('Y-m-d 00:00:00', strtotime("-$i days"));
	$gun_bitisi = date('Y-m-d 23:59:59', strtotime("-$i days"));

    // O günün tarihini al
    $gun_isimleri[$i] = date('Y-m-d', strtotime("-$i days")); // Tarih formatı

    // O gün için girişleri say
    foreach ($birhafta as $sonuc) {
    	if ($sonuc->login_time >= $gun_baslangici && $sonuc->login_time <= $gun_bitisi) {
            $gun_girisleri[$i]++; // O gün için giriş sayısını artır
        }
    }
}

// Diziyi tersine çevirerek günlerin sırasını düzeltelim (bugün başta, dünden önceki günler sırasıyla gelsin)
$gun_girisleri = array_reverse($gun_girisleri);
$gun_isimleri = array_reverse($gun_isimleri);

/* Son 1 ay için istatistik */
$biray_girisleri = array_fill(0, 30, 0); // Son 30 gün için giriş sayısını tutan dizi
$biray_isimleri = []; // Son 30 günün tarihlerini tutacak dizi

for ($i = 0; $i < 30; $i++) {
    // Her günün başlangıcı (son 30 gün için)
	$gun_baslangici = date('Y-m-d 00:00:00', strtotime("-$i days"));
	$gun_bitisi = date('Y-m-d 23:59:59', strtotime("-$i days"));

    // O günün tarihini al
    $biray_isimleri[$i] = date('Y-m-d', strtotime("-$i days")); // Tarih formatı (Yıl-ay-gün)

    // O gün için girişleri say
    foreach ($biray as $sonuc) {
    	if ($sonuc->login_time >= $gun_baslangici && $sonuc->login_time <= $gun_bitisi) {
            $biray_girisleri[$i]++; // O gün için giriş sayısını artır
        }
    }
}

// Son 30 günün verilerini de tersine çevirerek doğru sıralamaya koy
$biray_girisleri = array_reverse($biray_girisleri);
$biray_isimleri = array_reverse($biray_isimleri);

// Şimdi $biray_girisleri son 30 gündeki giriş sayılarını tutuyor
// Ve $biray_isimleri son 30 günün tarihlerini tutuyor (Yıl-ay-gün formatında)

?>

<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<div class="main-content">
	<div class="page-content dark:bg-zinc-700">
		<div class="container-fluid px-[0.625rem]">
			<h4 class="display_name">
				<?php echo $user->display_name; ?> 
				<a href="mailto:<?php echo $user->user_email; ?>">
					( <?php echo $user->user_email; ?> )
				</a>
				<?php  
				$user_id = $userID; 
				$user_info = get_userdata($user_id); 

				if ($user_info) {
					$user_roles = $user_info->roles; 

					if (!empty($user_roles)) {
						echo 'Role: ' . implode(', ', $user_roles);
					} else {
						echo 'Bu kullanıcının rolü yok.';
					}
				} else {
					echo 'Kullanıcı bulunamadı.';
				}
				?>
			</h4>
			<div class="col-span-12" style="margin-top: 20px;">
				<div class="card dark:bg-zinc-800 dark:border-zinc-600">
					<div class="card-body relative overflow-x-auto">
						<table id="datatable-buttons" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
							<thead>
								<tr>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">Log ID</th>
									<th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">IP</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Date/Time</th>
									<th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Campus - Year</th>
								</tr>
							</thead>
							<tbody>
								<?php  
								foreach ($sonuclar as $key => $value) {
									?>
									<tr>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->id; ?>
										</td>
										<td class="p-4 pr-8 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->ip_adress; ?>
										</td>
										<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php echo $value->login_time; ?>
										</td>
										<td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
											<?php
											$site_details = get_blog_details($value->site_id);
											echo $site_details->blogname; 
											?>
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
			<div class="grid grid-cols-1 xl:grid-cols-12 gap-5" style="margin-top: 25px;">
				<div class="col-span-6">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-600 dark:text-gray-100">
								Today Login History
							</h6>
						</div>
						<div class="card-body flex flex-wrap gap-3">
							<div id="today_history" data-colors='["#5156be"]' class="apex-charts w-full" dir="ltr"></div>                              
						</div>
					</div>
				</div>
				<div class="col-span-6">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-600 dark:text-gray-100">
								Last Week History
							</h6>
						</div>
						<div class="card-body flex flex-wrap gap-3">
							<div id="line_chart_dashed" data-colors='["#ff0000"]' class="apex-charts w-full" dir="ltr"></div>           
						</div>
					</div>
				</div>
				<div class="col-span-12">
					<div class="card dark:bg-zinc-800 dark:border-zinc-600">
						<div class="card-body pb-0">
							<h6 class="mb-1 text-15 text-gray-600 dark:text-gray-100">
								Last 1 Month Usage Statistics
							</h6>
						</div>
						<div class="card-body flex flex-wrap gap-3">
							<div id="spline_area" data-colors='["#5156be"]' class="apex-charts w-full" dir="ltr"></div>                         
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.display_name{
		background-color: #8e1838;
		color: #fff;
		padding: 10px;
		border-radius: 10px;
	}
</style>
<script>
	var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
	var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
	var userID = <?php echo $userID; ?>
</script>
<?php get_footer(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/apexcharts.init.js"></script>

<script>
	var lineDatalabelColors = getChartColorsArray("#today_history");
	var options = {
		chart: {
			height: 380,
			type: 'line',
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			}
		},
		colors: lineDatalabelColors,
		dataLabels: {
			enabled: false,
		},
		stroke: {
			width: [3, 3],
			curve: 'straight'
		},
		series: [{
			name: "Login",
			data: [<?php  
				foreach ($saat_girisleri as $key => $value) {
					echo $value;
					echo ",";
				}
				?>]
		}
		],
		title: {
			text: '',
			align: 'left',
			style: {
				fontWeight:  '500',
			},
		},
		grid: {
			row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
    },
    borderColor: '#f1f1f1'
},
markers: {
	style: 'inverted',
	size: 0
},
xaxis: {
	categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
	title: {
		text: 'Hour'
	}
},
yaxis: {
	title: {
		text: 'Login Number'
	}
},
legend: {
	position: 'top',
	horizontalAlign: 'right',
	floating: true,
	offsetY: -25,
	offsetX: -5
},
responsive: [{
	breakpoint: 600,
	options: {
		chart: {
			toolbar: {
				show: false
			}
		},
		legend: {
			show: false
		},
	}
}]
}

var chart = new ApexCharts(
	document.querySelector("#today_history"),
	options
	);

chart.render();


//  line chart datalabel  
var lineDashedColors = getChartColorsArray("#line_chart_dashed");
var options = {
	chart: {
		height: 380,
		type: 'line',
		zoom: {
			enabled: true
		},
		toolbar: {
			show: true,
		}
	},
	colors: lineDashedColors,
	dataLabels: {
		enabled: true
	},
	stroke: {
		width: [3, 4, 3],
		curve: 'straight',
		dashArray: [0, 8, 5]
	},
	series: [{
		name: "Login",
		data: [<?php 
			foreach ($gun_girisleri as $key => $value) {
				echo $value;
				echo ",";
			}
			?>]
	}
	],
	title: {
		align: 'left',
		style: {
			fontWeight:  '500',
		},
	},
	markers: {
		size: 0,

		hover: {
			sizeOffset: 6
		}
	},
	xaxis: {
		categories: [<?php 
			foreach ($gun_isimleri as $key => $value) {
				echo "'";
				echo $value;
				echo "',";
			}
			?>
			],
		title: {
			text: 'Days'
		}
	},
	tooltip: {
		y: [{
			title: {
				formatter: function (val) {
					return val + " (mins)"
				}
			}
		}]
	},
	grid: {
		borderColor: '#ff0000',
	}
}

var chart = new ApexCharts(
	document.querySelector("#line_chart_dashed"),
	options
	);

chart.render();



var splneAreaColors = getChartColorsArray("#spline_area");
var options = {
	chart: {
		height: 350,
		type: 'area',
		toolbar: {
			show: false,
		}
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		curve: 'smooth',
		width: 3,
	},
	series: [{
		name: 'Login',
		data: [<?php  
			foreach ($biray_girisleri as $key => $value) {
				echo $value;
				echo ",";
			}
			?>]
	}],
	colors: splneAreaColors,
	xaxis: {
		type: 'datetime',
		categories: [<?php  
			foreach ($biray_isimleri as $key => $value) {
				echo '"';
				echo $value;
				echo '",';
			}
			?>],                
	},
	grid: {
		borderColor: '#f1f1f1',
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy'
		},
	}
}

var chart = new ApexCharts(
	document.querySelector("#spline_area"),
	options
	);

chart.render();
</script>