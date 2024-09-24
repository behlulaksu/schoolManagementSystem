<?php get_header(); ?>
<!-- DataTables -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

<?php $current_user_now = wp_get_current_user(); ?>
<?php $current_user_id = get_current_user_id(); ?>

<?php  
if ($current_user_now->roles[0] === 'student') {
    $return_url = get_site_url().'/student-home/';
    wp_redirect( $return_url );
}
?>
<div class="main-content ">

    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <!-- $current_user_id === 1 -->
            <div class="grid grid-cols-12 gap-5">
                <?php if (true): ?>
                    <!-- alanlar baslangic -->
                    <div class="col-span-12 xl:col-span-7">
                        <?php  
                        if(have_rows('add_xml_file', 'options')): 
                            while(have_rows('add_xml_file', 'options')): 
                                the_row(); 
                                ?>
                                <?php $calendar_name = get_sub_field("calendar_name"); ?>
                                <?php $calendar_file_path = get_sub_field("calendar_file"); ?>

                                <?php  
                                $xml = simplexml_load_file($calendar_file_path);

                                $periods = [];
                                foreach ($xml->periods->period as $period) {
                                    $periods[0][(string)$period['period']] = (string)$period['name'];
                                    $periods[1][(string)$period['period']] = (string)$period['starttime'];
                                    $periods[2][(string)$period['period']] = (string)$period['endtime'];
                                }

                                $teachers = [];
                                foreach ($xml->teachers->teacher as $teacher) {
                                    $teachers[(string)$teacher['id']] = (string)$teacher['name'];
                                }

                                $days = [];
                                foreach ($xml->daysdefs->daysdef as $day) {
                                    $days[(string)$day['id']] = (string)$day['name'];
                                }

                                $subjects = [];
                                foreach ($xml->subjects->subject as $subject) {
                                    $subjects[(string)$subject['id']] = (string)$subject['name'];
                                }

                                $classes = [];
                                $sayma = 0;
                                foreach ($xml->classes->class as $classe) {
                                    $classes[0][$sayma] = $classe['id'];
                                    $classes[1][$sayma] = $classe['name'];
                                    $sayma = $sayma + 1;
                                }


                                $cards = [];
                                $sayma = 0;
                                foreach ($xml->cards->card as $key => $value) {
                                    $cards[$sayma]['lessonid'] = $value['lessonid'];
                                    $cards[$sayma]['classroomids'] = $value['classroomids'];
                                    $cards[$sayma]['period'] = $value['period'];
                                    $cards[$sayma]['days'] = $value['days'];
                                    $sayma = $sayma + 1;
                                }

                                $lessons = [];
                                foreach ($xml->lessons->lesson as $lesson) {
                                    $teacherIds = explode(',', (string)$lesson['teacherids']);
                                    $dayId = (string)$lesson['daysdefid'];
                                    $subjectId = (string)$lesson['subjectid'];
                                    $classId = (string)$lesson['classids'];
                                    $lessonId = (string)$lesson['id']; 

                                    foreach ($teacherIds as $teacherId) {
                                        $teacherId = trim($teacherId); 

                                        if (isset($teachers[$teacherId]) && isset($days[$dayId]) && isset($subjects[$subjectId])) {
                                            $lessons[$teacherId][] = [
                                                'day' => $days[$dayId],
                                                'subject' => $subjects[$subjectId],
                                                'lesson_id' => $lessonId,
                                                'class' => $classId
                                            ];
                                        }
                                    }
                                }

                                $lesson_idler_gecici = [];
                                $lesson_idler = [];
                                // $lesson_idler[0] = subject id
                                // $lesson_idler[1] = subject name
                                // $lesson_idler[2] = class name
                                // $lesson_idler[3] = subject day
                                // $lesson_idler[4] = subject period

                                //get_field('asc_time_table_id', 'user_' .$get_user_data->data->ID)
                                $teacherId = get_field('asc_time_table_id', 'user_' .$current_user_id);
                                // ogretmenlerin ders listelerini belirledigimiz yer
                                if (isset($lessons[$teacherId])) {
                                    foreach ($lessons[$teacherId] as $key => $lesson) {
                                        $lesson_idler_gecici[0][$key] = $lesson['lesson_id'];
                                        $lesson_idler_gecici[1][$key] = $lesson['subject'];

                                        foreach ($classes[0] as $keyl => $valuel) {
                                            $classIds = explode(',', $lesson['class']);

                                            foreach ($classIds as $classId) {
                                                $classId = trim($classId); 

                                                if ($classId == $classes[0][$keyl]) {
                                                    $lesson_idler_gecici[2][$key] = $classes[1][$keyl];
                                                    break; 
                                                }
                                            }
                                        }
                                    }
                                }

                                // periodlari bulma alani
                                $sayma = 0;
                                foreach ($cards as $key => $value) {
                                    foreach ($lesson_idler_gecici[0] as $keys => $values) {
                                        if ($value['lessonid'] == $values) {
                                            $lesson_idler[1][$sayma] = $lesson_idler_gecici[1][$keys];
                                            $lesson_idler[2][$sayma] = $lesson_idler_gecici[2][$keys];
                                            if ($value['days'] == '10000') {
                                                $lesson_idler[3][$sayma] = "Monday";
                                            }elseif($value['days'] == '01000'){
                                                $lesson_idler[3][$sayma] = "Tuesday";
                                            }elseif($value['days'] == '00100'){
                                                $lesson_idler[3][$sayma] = "Wednesday";
                                            }elseif($value['days'] == '00010'){
                                                $lesson_idler[3][$sayma] = "Thursday";
                                            }elseif($value['days'] == '00001'){
                                                $lesson_idler[3][$sayma] = "Friday";
                                            }
                                            $lesson_idler[4][$sayma] = $value['period'];
                                            $sayma = $sayma + 1;
                                        }

                                    }
                                }

                                // echo "<pre>";
                                // print_r($lesson_idler);
                                // echo "<pre>";
                                if (!empty($lesson_idler)) {
                                    ?>
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <div class="card-body pb-0">
                                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
                                                <?php echo $calendar_name; ?>
                                            </h6>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="relative overflow-x-auto">
                                                <table class="ders_programlari w-full text-sm text-left text-gray-500 ">
                                                    <thead class="text-sm text-gray-700 dark:text-gray-100">
                                                        <tr style="background-color: #8e1838; color: #fff;" class="calendar_head border border-gray-50 dark:border-zinc-600">
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Period
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Monday
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Tuesday
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Wednesday
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Thursday
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Friday
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="calendar_body">
                                                        <?php  
                                                        $ders_sayisis = count($lesson_idler[3]);
                                                        for ($i=1; $i < count($periods[0])+1; $i++) { 
                                                            $bg_color = "";
                                                            if ($periods[0][$i] === "ARRIVAL TIME" || $periods[0][$i] === "BREAK" || $periods[0][$i] === "LUNCH BREAK" || $periods[0][$i] === "PRAYER TIME" || $periods[0][$i] === "DISMISSAL TIME") {
                                                                $bg_color = "grey !important";
                                                                $text_color = "#fff !important";
                                                            }else{
                                                                $bg_color = "";
                                                                $text_color = "";
                                                            }
                                                            ?>
                                                            <tr style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">

                                                                <th class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php echo $periods[0][$i]; ?>
                                                                    <br>
                                                                    <?php echo $periods[1][$i]; ?> to <?php echo $periods[2][$i]; ?>
                                                                </th>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Monday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Tuesday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Wednesday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Thursday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Friday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
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
                                    <?php 
                                }
                            endwhile; 
                        endif;
                        ?>
                    </div>
                    <!-- alanlar bitis -->
                <?php endif ?>
                <?php if ($current_user_id === 1): ?>
                    <!-- alanlar baslangic -->
                    <div class="col-span-12 xl:col-span-7">
                        <?php  
                        if(have_rows('add_xml_file', 'options')): 
                            while(have_rows('add_xml_file', 'options')): 
                                the_row(); 
                                ?>
                                <?php $calendar_name = get_sub_field("calendar_name"); ?>
                                <?php $calendar_file_path = get_sub_field("calendar_file"); ?>

                                <?php  
                                $xml = simplexml_load_file($calendar_file_path);

                                $periods = [];
                                foreach ($xml->periods->period as $period) {
                                    $periods[0][(string)$period['period']] = (string)$period['name'];
                                    $periods[1][(string)$period['period']] = (string)$period['starttime'];
                                    $periods[2][(string)$period['period']] = (string)$period['endtime'];
                                }

                                $teachers = [];
                                foreach ($xml->teachers->teacher as $teacher) {
                                    $teachers[(string)$teacher['id']] = (string)$teacher['name'];
                                }

                                $days = [];
                                foreach ($xml->daysdefs->daysdef as $day) {
                                    $days[(string)$day['id']] = (string)$day['name'];
                                }

                                $subjects = [];
                                foreach ($xml->subjects->subject as $subject) {
                                    $subjects[(string)$subject['id']] = (string)$subject['name'];
                                }

                                $classes = [];
                                $sayma = 0;
                                foreach ($xml->classes->class as $classe) {
                                    $classes[0][$sayma] = $classe['id'];
                                    $classes[1][$sayma] = $classe['name'];
                                    $sayma = $sayma + 1;
                                }


                                $cards = [];
                                $sayma = 0;
                                foreach ($xml->cards->card as $key => $value) {
                                    $cards[$sayma]['lessonid'] = $value['lessonid'];
                                    $cards[$sayma]['classroomids'] = $value['classroomids'];
                                    $cards[$sayma]['period'] = $value['period'];
                                    $cards[$sayma]['days'] = $value['days'];
                                    $sayma = $sayma + 1;
                                }

                                $lessons = [];
                                foreach ($xml->lessons->lesson as $lesson) {
                                    $teacherIds = explode(',', (string)$lesson['teacherids']);
                                    $dayId = (string)$lesson['daysdefid'];
                                    $subjectId = (string)$lesson['subjectid'];
                                    $classId = (string)$lesson['classids'];
                                    $lessonId = (string)$lesson['id']; 

                                    foreach ($teacherIds as $teacherId) {
                                        $teacherId = trim($teacherId); 

                                        if (isset($teachers[$teacherId]) && isset($days[$dayId]) && isset($subjects[$subjectId])) {
                                            $lessons[$teacherId][] = [
                                                'day' => $days[$dayId],
                                                'subject' => $subjects[$subjectId],
                                                'lesson_id' => $lessonId,
                                                'class' => $classId
                                            ];
                                        }
                                    }
                                }

                                $lesson_idler_gecici = [];
                                $lesson_idler = [];
                                // $lesson_idler[0] = subject id
                                // $lesson_idler[1] = subject name
                                // $lesson_idler[2] = class name
                                // $lesson_idler[3] = subject day
                                // $lesson_idler[4] = subject period

                                //get_field('asc_time_table_id', 'user_' .$get_user_data->data->ID)
                                $teacherId = get_field('asc_time_table_id', 'user_' .$current_user_id);
                                // ogretmenlerin ders listelerini belirledigimiz yer
                                if (isset($lessons[$teacherId])) {
                                    foreach ($lessons[$teacherId] as $key => $lesson) {
                                        $lesson_idler_gecici[0][$key] = $lesson['lesson_id'];
                                        $lesson_idler_gecici[1][$key] = $lesson['subject'];
                                        $lesson_idler_gecici[2][$key] = $lesson['class'];

                                        // foreach ($classes[0] as $keyl => $valuel) {
                                        //     $classIds = explode(',', $lesson['class']);

                                        //     foreach ($classIds as $classId) {
                                        //         $classId = trim($classId); 

                                        //         if ($classId == $classes[0][$keyl]) {
                                        //             $lesson_idler_gecici[2][$key] = $classes[1][$keyl];
                                        //             break; 
                                        //         }
                                        //     }
                                        // }
                                    }
                                }

                                // periodlari bulma alani
                                $sayma = 0;
                                foreach ($cards as $key => $value) {
                                    foreach ($lesson_idler_gecici[0] as $keys => $values) {
                                        if ($value['lessonid'] == $values) {
                                            $lesson_idler[1][$sayma] = $lesson_idler_gecici[1][$keys];
                                            $lesson_idler[2][$sayma] = $lesson_idler_gecici[2][$keys];
                                            if ($value['days'] == '10000') {
                                                $lesson_idler[3][$sayma] = "Monday";
                                            }elseif($value['days'] == '01000'){
                                                $lesson_idler[3][$sayma] = "Tuesday";
                                            }elseif($value['days'] == '00100'){
                                                $lesson_idler[3][$sayma] = "Wednesday";
                                            }elseif($value['days'] == '00010'){
                                                $lesson_idler[3][$sayma] = "Thursday";
                                            }elseif($value['days'] == '00001'){
                                                $lesson_idler[3][$sayma] = "Friday";
                                            }
                                            $lesson_idler[4][$sayma] = $value['period'];
                                            $sayma = $sayma + 1;
                                        }

                                    }
                                }

                                if (!empty($lesson_idler)) {
                                    ?>
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <div class="card-body pb-0 flex items-center justify-between">
                                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">
                                                <?php echo $calendar_name; ?>
                                            </h6>
                                            <h6>
                                                <?php  
                                                date_default_timezone_set('Europe/Istanbul');
                                                $bugun = date('l');
                                                echo $bugun;
                                                $su_an = date('H:i');
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="relative overflow-x-auto">
                                                <table class="ders_programlari w-full text-sm text-left text-gray-500 ">
                                                    <thead class="text-sm text-gray-700 dark:text-gray-100">
                                                        <tr style="background-color: #8e1838; color: #fff;" class="calendar_head border border-gray-50 dark:border-zinc-600">
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                Period
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                <div>
                                                                    Monday
                                                                </div>
                                                                <?php  
                                                                if ($bugun === "Monday") {
                                                                    ?>
                                                                    <button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" style="padding: 3px 15px;">
                                                                        <i class="bx bx-down-arrow-alt text-16 align-middle" style="font-size: 20px !important;"></i>
                                                                    </button>
                                                                    <?php 
                                                                }
                                                                ?>
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                <div>
                                                                    Tuesday
                                                                </div>
                                                                <?php  
                                                                if ($bugun === "Tuesday") {
                                                                    ?>
                                                                    <button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" style="padding: 3px 15px;">
                                                                        <i class="bx bx-down-arrow-alt text-16 align-middle" style="font-size: 20px !important;"></i>
                                                                    </button>
                                                                    <?php 
                                                                }
                                                                ?>
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                <div>
                                                                    Wednesday
                                                                </div>
                                                                <?php  
                                                                if ($bugun === "Wednesday") {
                                                                    ?>
                                                                    <button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" style="padding: 3px 15px;">
                                                                        <i class="bx bx-down-arrow-alt text-16 align-middle" style="font-size: 20px !important;"></i>
                                                                    </button>
                                                                    <?php 
                                                                }
                                                                ?>
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                <div>
                                                                    Thursday
                                                                </div>
                                                                <?php  
                                                                if ($bugun === "Thursday") {
                                                                    ?>
                                                                    <button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" style="padding: 3px 15px;">
                                                                        <i class="bx bx-down-arrow-alt text-16 align-middle" style="font-size: 20px !important;"></i>
                                                                    </button>
                                                                    <?php 
                                                                }
                                                                ?>
                                                            </th>
                                                            <th scope="col" class="merkeze_al px-1 py-1 border-l border-gray-50 dark:border-zinc-600">
                                                                <div>
                                                                    Friday
                                                                </div>
                                                                <?php  
                                                                if ($bugun === "Friday") {
                                                                    ?>
                                                                    <button type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600" style="padding: 3px 15px;">
                                                                        <i class="bx bx-down-arrow-alt text-16 align-middle" style="font-size: 20px !important;"></i>
                                                                    </button>
                                                                    <?php 
                                                                }
                                                                ?>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="calendar_body">
                                                        <?php  
                                                        $ders_sayisis = count($lesson_idler[3]);
                                                        for ($i=1; $i < count($periods[0])+1; $i++) { 
                                                            $bg_color = "";
                                                            if ($periods[0][$i] === "ARRIVAL TIME" || $periods[0][$i] === "BREAK" || $periods[0][$i] === "LUNCH BREAK" || $periods[0][$i] === "PRAYER TIME" || $periods[0][$i] === "DISMISSAL TIME") {
                                                                $bg_color = "grey !important";
                                                                $text_color = "#fff !important";
                                                            }else{
                                                                $bg_color = "";
                                                                $text_color = "";
                                                            }
                                                            ?>
                                                            <tr style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;" class="bg-white border border-gray-50 dark:border-zinc-600 dark:bg-transparent">

                                                                <th class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php echo $periods[0][$i]; ?>
                                                                    <br>
                                                                    <?php echo $periods[1][$i]; ?> to <?php echo $periods[2][$i]; ?>
                                                                </th>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Monday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {

                                                                                echo get_title_by_meta("class_asc_id", $lesson_idler[2][$a]);
                                                                                echo "<br>";
                                                                                ?>
                                                                                <span>
                                                                                    <?php echo $lesson_idler[2][$a]; ?>
                                                                                </span>
                                                                                <?php 
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Tuesday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Wednesday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Thursday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                $array = explode(",", $lesson_idler[2][$a]);
                                                                                foreach ($array as $keyar => $valuear) {

                                                                                }
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }

                                                                    if ($bugun === "Thursday" && $su_an >= $periods[1][$i] && $su_an <= $periods[2][$i]) {
                                                                        ?>
                                                                        <br>
                                                                        <a href="">
                                                                            <button type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600">
                                                                                <i class="bx bx-list-ul bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                                                                <span class="px-3 leading-[2.8]">
                                                                                    Attendance
                                                                                </span>
                                                                            </button>
                                                                        </a>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="merkeze_al px-1 py-2 border-l border-gray-50 dark:border-zinc-600 dark:text-zinc-100">
                                                                    <?php  
                                                                    for ($a=0; $a < $ders_sayisis; $a++) { 
                                                                        if ($lesson_idler[3][$a] === "Friday") {
                                                                            $dizi = ((int)$lesson_idler[4][$a]);
                                                                            if ($dizi == $i) {
                                                                                echo $lesson_idler[2][$a];
                                                                                echo "<br>";
                                                                                echo $lesson_idler[1][$a];
                                                                            }
                                                                        }
                                                                    }
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
                                    <?php 
                                }
                            endwhile; 
                        endif;
                        ?>
                    </div>
                    <!-- alanlar bitis -->
                <?php endif ?>
                <div class="col-span-12 xl:col-span-5">
                    <!-- alanlar baslangic -->
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body pb-0">
                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">My Classes</h6>
                        </div>
                        <div class="card-body relative overflow-x-auto">
                            <table id="dash_1" class="table w-full pt-4 text-gray-700 dark:text-zinc-100">
                                <thead>
                                    <tr>
                                        <th class="p-4 pr-8 border rtl:border-l-0 border-y-2 border-gray-50 dark:border-zinc-600">Icon</th>
                                        <th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Class Name</th>
                                        <th class="p-4 pr-8 border border-y-2 border-gray-50 dark:border-zinc-600 border-l-0">Open Class</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    if ($current_user_now->roles[0] === 'teacher') {
                                        $args = array(
                                            'post_type' => 'user_groups',
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'group_admin',
                                                    'value' => get_current_user_id(),
                                                    'compare' => 'LIKE',
                                                )
                                            )
                                        );

                                        $my_posts = new WP_Query($args);
                                        if ($my_posts->have_posts()) {
                                            while ($my_posts->have_posts()) {
                                                $my_posts->the_post();
                                                $categoryID = get_the_id(); 
                                                /************************************/  
                                                $group_image = get_field('gru',$categoryID);
                                                if (empty($group_image)) {
                                                    $group_image['url'] = get_template_directory_uri()."/indir.png";
                                                }
                                                ?>
                                                <tr>
                                                    <td class="p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                        <img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
                                                    </td>
                                                    <td class="p-2 pr-2 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        <?php echo get_the_title(); ?>
                                                    </td>
                                                    <td class="p-2 pr-2 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        <a href="<?php echo get_site_url(); ?>/my-subjects?group=<?php echo get_the_id(); ?>">
                                                            <button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                                                                <span class="px-3 leading-[2.8]">
                                                                    Go to Class
                                                                </span>
                                                                <i class="bx bx-right-arrow-alt bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                               // sinifa dahil edilmemis hoca
                                            ?>
                                            <tr>
                                                <td class="p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                                <td class="p-1 pr-1 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                                <td class="p-1 pr-1 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                        wp_reset_query();
                                    }elseif($current_user_now->roles[0] === 'pdp'){
                                        $args = array(
                                            'post_type' => 'user_groups',
                                            'meta_key' => 'sub_class', 
                                            'meta_value' => 'No',
                                            'meta_compare' => '=', 
                                        );

                                        $my_posts = new WP_Query($args);
                                        if ($my_posts->have_posts()) {
                                            while ($my_posts->have_posts()) {
                                                $my_posts->the_post();
                                                $categoryID = get_the_id(); 
                                                /************************************/  
                                                $group_image = get_field('gru',$categoryID);
                                                if (empty($group_image)) {
                                                    $group_image['url'] = get_template_directory_uri()."/indir.png";
                                                }
                                                ?>
                                                <tr>
                                                    <td class="make_center p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                        <img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
                                                    </td>
                                                    <td class="p-2 pr-2 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        <?php echo get_the_title(); ?>
                                                    </td>
                                                    <td class="p-2 pr-2 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        <a href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo get_the_id(); ?>">
                                                            <button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                                                                <span class="px-3 leading-[2.8]">
                                                                    Go to Class
                                                                </span>
                                                                <i class="bx bx-right-arrow-alt bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                                // sinifa dahil edilmemis hoca
                                            ?>
                                            <tr>
                                                <td class="p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                                <td class="p-1 pr-1 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                                <td class="p-1 pr-1 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                    ---
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                        wp_reset_query();
                                    }else{

                                        if (get_user_access_read("see-all-classes")) {
                                            $args = array(
                                                'post_type' => 'user_groups',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'group_admin',
                                                        'value' => get_current_user_id(),
                                                        'compare' => 'LIKE',
                                                    )
                                                )
                                            );

                                            if (get_user_access_write("see-all-classes")) {

                                                $args = array(
                                                    'post_type' => 'user_groups',
                                                    'meta_key' => 'sub_class', 
                                                    'orderby' => 'Yes',   
                                                    'order' => 'ASC',   
                                                );

                                            }

                                            $my_posts = new WP_Query($args);
                                            if ($my_posts->have_posts()) {
                                                while ($my_posts->have_posts()) {
                                                    $my_posts->the_post();
                                                    $categoryID = get_the_id(); 
                                                    /************************************/  
                                                    $group_image = get_field('gru',$categoryID);
                                                    if (empty($group_image)) {
                                                        $group_image['url'] = get_template_directory_uri()."/indir.png";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="make_center p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                            <img class="class_image" class="rounded" src="<?php echo $group_image['url']; ?>" alt="">
                                                        </td>
                                                        <td class="p-2 pr-2 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                            <?php echo get_the_title(); ?>
                                                        </td>
                                                        <td class="p-2 pr-2 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                            <a href="<?php echo get_site_url(); ?>/edit-groups?group=<?php echo get_the_id(); ?>">
                                                                <button type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                                                                    <span class="px-3 leading-[2.8]">
                                                                        Go to Class
                                                                    </span>
                                                                    <i class="bx bx-right-arrow-alt bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                }
                                            }else{
                                                    // sinifa dahil edilmemis hoca
                                                ?>
                                                <tr>
                                                    <td class="p-1 pr-1 border rtl:border-l-0 border-t-0 border-gray-50 dark:border-zinc-600">
                                                        ---
                                                    </td>
                                                    <td class="p-1 pr-1 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        ---
                                                    </td>
                                                    <td class="p-1 pr-1 border rtl:border-l border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                                        ---
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }else{
                                            echo access_denieded($current_user_id,'all-groups','see-all-classes');
                                        }


                                        wp_reset_query();

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- alanlar bitis -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .calendar_head{
        font-size: 1rem;
    }
    .calendar_body th, .calendar_body td{
        font-size: 0.77rem !important;
    }
    .class_image{
        max-width: 70px;
    }
    .make_center{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .merkeze_al{
        text-align: center !important;
    }
    @media only screen and (max-width: 600px) {
        .calendar_head{
            font-size: 14px;
        }
        
    }
</style>
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

<script>
    new DataTable('#dash_1', {

    });
</script>