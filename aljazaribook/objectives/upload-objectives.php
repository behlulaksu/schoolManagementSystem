<?php /* Template Name: Upload Objectives */ ?>
<?php get_header(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<!-- color picker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/@simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/icons.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind.css" />

<div class="main-content">
	<div class="page-content dark:bg-zinc-700"  style="width: 100%; height: 100%;">
		<div class="container-fluid px-[0.625rem]"  style="width: 100%; height: 100%;">

            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <form id="upload-form">
                        <label for="file-input">Chose file from here:</label>
                        <input type="file" id="file-input" accept=".xlsx" />
                        <button type="submit" value="Upload" class="btn border-0 bg-gray-50 text-black px-5">
                            <i class="mdi mdi-upload block text-lg"></i>
                            <span class="">
                              Show All
                          </span>
                      </button>
                  </form>
                  <button id="upload_all" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                    <i class="bx bx-check-double bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                    <span class="px-3 leading-[2.8]">
                        Upload
                    </span>
                </button>
            </div>
        </div>


        <div id="table-container"></div>


    </div>
</div>
</div>
<script>
    var get_site_url = <?php echo "'".get_site_url()."'"; ?>;
    var get_template_url = <?php echo "'".get_bloginfo('template_directory')."'"; ?>;
</script>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/form-advanced.init.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/pages/sweetalert.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
<script>
    gonderilecek = [];

    document.getElementById('upload-form').addEventListener('submit', function(e) {
        e.preventDefault();

        var fileInput = document.getElementById('file-input');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, { type: 'array' });

        // İlk sayfayı seç
            var firstSheet = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[firstSheet];

        // Sheet verisini JSON olarak al, formülleri hesaplamadan sadece metin olarak al
            var json = XLSX.utils.sheet_to_json(worksheet, { header: 1, raw: true });

        // Filtreleme işlemi: "Assessment category" değeri boş olan satırları filtrele
            json = json.filter(function(row) {
            var assessmentCategory = row[3]; // "Assessment category" sütunu
            return assessmentCategory !== undefined && assessmentCategory !== null && assessmentCategory.trim() !== '';
        });

        // Tüm hücreleri kontrol ederek boş hücreleri "None" olarak güncelle
            // json = json.map(function(row) {
            //     return row.map(function(cell) {
            //         return cell !== undefined && cell !== null && cell.trim() !== '' ? cell : 'None';
            //     });
            // });

        // Son sütundaki değerleri "." karakterinden ayır ve yeni başlıkları ekle
            json = json.map(function(row, index) {
                if (index === 0) {
                return row.concat(["Curriculum", "Grade", "Subject", "Skills", "Order"]); // Başlık satırına yeni başlıklar ekle
            }
            var lastCell = row[row.length - 1]; // Son sütunu al
            var splitValues = lastCell.split('.'); // Değerleri "." karakterinden ayır
            return row.slice(0, -1).concat([lastCell].concat(splitValues)); // Son sütunu kaldırıp ayrılan değerleri ekleyerek yeni satırı oluştur
        });

        // Verileri HTML tablosu olarak göster
            var tableContainer = document.getElementById('table-container');
            var table = document.createElement('table');
            table.className = "table w-full pt-4 text-gray-700 dark:text-zinc-100";

        // İlk satırı başlık olarak kullan
            var thead = document.createElement('thead');
            var tbody = document.createElement('tbody');

            json.forEach(function(row, index) {
                var tr = document.createElement('tr');
                row.forEach(function(cell, idx) {
                    var cellElement = document.createElement(index === 0 ? 'th' : 'td');
                cellElement.textContent = cell; // Boş hücreler "None" olarak gösterilir
                if (index === 0) {
                    cellElement.className = "p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600";
                } else {
                    cellElement.className = "p-2 pr-4 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600";
                }
                tr.appendChild(cellElement);
            });
                if (index === 0) {
                    thead.appendChild(tr);
                } else {
                    tbody.appendChild(tr);
                }
            });

            table.appendChild(thead);
            table.appendChild(tbody);
            tableContainer.innerHTML = "";
            tableContainer.appendChild(table);

            var tableData = json.map(function(row) {
                return Object.values(row);
            });

            console.log("Tabloya yüklenen veriler:");
            console.log(tableData);
            gonderilecek = tableData;
        };

        reader.readAsArrayBuffer(file);
    });


    $("#upload_all").click(function () {

        Swal.fire({
            title: "Upload",
            text: 'You are uploading all the objectives in the list!',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes"
        }).then(function (result) {
            if (result.value) {
                var value = $.ajax({
                    method: "POST",
                    url: get_site_url+'/wp-admin/admin-ajax.php',
                    data: ({action:'my_ajax_upload_objectives',

                        tableData:gonderilecek,

                    }),
                    success: function(data){
                        console.log(data);
                        Swal.fire("Done.").then(function (result) {
                            if (result.value) {
                                window.location.href = "<?php echo get_site_url(); ?>/objectives-settings/";
                            }
                        });
                    }
                });

            }
        });

    });
</script>









