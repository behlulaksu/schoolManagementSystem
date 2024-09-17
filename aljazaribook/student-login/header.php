<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <title><?php echo get_the_title(); ?></title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />


    <link href="<?php echo get_template_directory_uri(); ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/swiper/swiper-bundle.min.css">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/icons.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tailwind.css" />

    <?php 
    if ( !is_user_logged_in() ) {
        auth_redirect();
    } 
    ?>


    <?php $current_user_now = wp_get_current_user(); ?>
    <?php $current_user_id = get_current_user_id(); ?>

</head>

<body data-mode="light" data-sidebar-size="lg">

    <div id="page-loading">
        <div class="three-balls">
            <div class="ball ball1"></div>
            <div class="ball ball2"></div>
            <div class="ball ball3"></div>
        </div>
    </div>

    <!-- leftbar-tab-menu -->
    <nav class="border-b border-slate-100 dark:bg-zinc-800 print:hidden flex items-center fixed top-0 right-0 left-0 bg-white z-10 dark:border-zinc-700">

        <div class="flex items-center justify-between w-full">
            <div class="topbar-brand flex items-center">
                <div class="navbar-brand flex items-center justify-between shrink px-5 h-[70px] border-r bg-slate-50 border-r-gray-50 dark:border-zinc-700 dark:bg-zinc-800">
                    <a href="#" class="flex items-center font-bold text-lg  dark:text-white" style="flex-direction: column;">
                        <img src="<?php echo get_template_directory_uri(); ?>/indir.png" alt="" class="ltr:mr-2 rtl:ml-2 inline-block mt-1 h-6" />
                        <span class="hidden xl:block align-middle" style="font-size: .9rem; color: #8e1838;">
                            <?php echo get_bloginfo(); ?>
                        </span>
                    </a>
                </div>
                <button type="button" class="text-gray-600 dark:text-white h-[70px] ltr:-ml-10 ltr:mr-6 rtl:-mr-10 rtl:ml-10 vertical-menu-btn" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

            </div>
            <h6 id="header_title"></h6>
            <div class="flex items-center">
                <div>
                    <select id="site_change" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <?php  

                        $all_sites = get_blogs_of_user(get_current_user_id());
                        foreach ($all_sites as $key => $value) {
                            ?>
                            <option <?php if($value->siteurl === get_site_url()){echo "selected";}; ?> value="<?php echo $value->siteurl; ?>">
                                <?php echo $value->blogname; ?>
                            </option>
                            <?php 
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <button type="button" class="light-dark-mode text-xl px-4 h-[70px] text-gray-600 dark:text-gray-100 hidden sm:block ">
                        <i data-feather="moon" class="h-5 w-5 block dark:hidden"></i>
                        <i data-feather="sun" class="h-5 w-5 hidden dark:block"></i>
                    </div>

                    <div>
                        <div class="dropdown relative text-gray-600 hidden sm:block">
                            <button type="button" class="btn border-0 h-[70px] text-xl px-4 dropdown-toggle dark:text-gray-100" data-bs-toggle="dropdown" id="dropdownMenuButton1">
                             <i data-feather="grid" class="h-5 w-5"></i>
                         </button>
                         <div class="dropdown-menu absolute -left-40 z-50 hidden w-72 list-none border border-gray-50 rounded bg-white shadow dark:bg-zinc-800 dark:border-zinc-600 dark:text-gray-300" aria-labelledby="dropdownMenuButton1">
                            <div class="p-2">
                                <div class="grid grid-cols-3">
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://aljazari.com.tr/" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/login-logo.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>Aljazari Web Site</span>
                                    </a>
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="http://aljazari.eyotek.com/" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/eyotek.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>Eyotek</span>
                                    </a>

                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://www.office.com/" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/office.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>Office</span>
                                    </a>
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://www.office.com/" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/teams.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>Microsoft Teams</span>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="dropdown relative ">
                        <div class="relative">
                            <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-100" aria-expanded="false" data-dropdown-toggle="notification">
                                <i data-feather="bell" class="h-5 w-5"></i>
                            </button>
                            <span class="absolute text-xs px-1.5 bg-red-500 text-white font-medium rounded-full left-6 top-2.5">5</span>
                        </div>
                    </div>
                </div>


                <div>
                    <div class="dropdown relative ltr:mr-4 rtl:ml-4">
                        <button type="button" class="flex items-center px-4 py-5 border-x border-gray-50 bg-gray-50/30 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/users/avatar-6.jpg" alt="Header Avatar">
                            <span class="fw-medium hidden xl:block">
                                <?php echo $current_user_now -> display_name; ?>
                            </span>
                            <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                        </button>
                        <div class="dropdown-menu absolute top-0 ltr:-left-3 rtl:-right-3 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800" id="profile/log">
                            <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                                <div class="dropdown-item dark:text-gray-100">
                                    <a href="<?php echo get_site_url(); ?>/student-profile" class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50">
                                        <i class="mdi mdi-face-man text-16 align-middle mr-1"></i> Profile
                                    </a>
                                </div>
                                <hr class="border-gray-50 dark:border-gray-700">
                                <div class="dropdown-item dark:text-gray-100">
                                    <a class="p-3 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="<?php echo wp_logout_url(); ?>">
                                        <i class="mdi mdi-logout text-16 align-middle mr-1"></i> 
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">

        <div data-simplebar class="h-full">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">Menu</li>

                    <li>
                        <a href="<?php echo get_site_url(); ?>/student-home/" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard"> 
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <?php  
                    $args = array(
                        'post_type' => 'user_groups',
                        'meta_query' => array(
                            array(
                                'key' => 'group_users',
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
                            ?>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps"> 
                                        <?php echo get_the_title($categoryID); ?>
                                    </span>
                                </a>
                                <ul>
                                    <?php 
                                    $gruoup_subjects = get_field("subject_for_group",$categoryID); 
                                    foreach ($gruoup_subjects as $key => $value) {
                                        $select_lesson_type = get_field("select_lesson_type",$value->ID);
                                        ?>
                                        <li>
                                            <a href="<?php echo get_site_url(); ?>/student-gradebook?group=<?php echo $categoryID; ?>&subject=<?php echo $value->ID; ?>&student=<?php echo get_current_user_id(); ?>" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                                <?php echo $select_lesson_type[0]->post_title; ?>
                                            </a>
                                        </li>
                                        <?php 
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php 
                        }
                    }else{
                        echo "There is no group";
                    }
                    wp_reset_query();
                    ?>

                </ul>

            </div>

        </div>
    </div>

    <div class="main-content">

        <style>
            #page-loading {
              position: fixed;
              top: 0;
              left: 0;
              bottom: 0;
              right: 0;
              z-index: 999;
              background-color: #F5F5F5;
          }

          .three-balls {
              margin: 0 auto;
              width: 70px;
              text-align: center;
              position: absolute;
              left: 0;
              right: 0;
              top: 45%;
          }

          .three-balls .ball {
              position: relative;
              width: 15px;
              height: 15px;
              border-radius: 50%;
              display: inline-block;
              -webkit-animation: bouncedelay 2.0s infinite cubic-bezier(.62, .28, .23, .99) both;
              animation: bouncedelay 2.0s infinite cubic-bezier(.62, .28, .23, .99) both;
          }

          .three-balls .ball1 {
              -webkit-animation-delay: -.16s;
              animation-delay: -.16s;
          }

          .three-balls .ball2 {
              -webkit-animation-delay: -.08s;
              animation-delay: -.08s;
          }

          @keyframes bouncedelay {
              0% {
                bottom: 0;
                background-color: #03A9F4;
            }
            16.66% {
                bottom: 40px;
                background-color: #FB6542;
            }
            33.33% {
                bottom: 0px;
                background-color: #FB6542;
            }
            50% {
                bottom: 40px;
                background-color: #FFBB00;
            }
            66.66% {
                bottom: 0px;
                background-color: #FFBB00;
            }
            83.33% {
                bottom: 40px;
                background-color: #03A9F4;
            }
            100% {
                bottom: 0;
                background-color: #03A9F4;
            }
        }

        @-webkit-keyframes bouncedelay {
          0% {
            bottom: 0;
            background-color: #03A9F4;
        }
        16.66% {
            bottom: 40px;
            background-color: #FB6542;
        }
        33.33% {
            bottom: 0px;
            background-color: #FB6542;
        }
        50% {
            bottom: 40px;
            background-color: #FFBB00;
        }
        66.66% {
            bottom: 0px;
            background-color: #FFBB00;
        }
        83.33% {
            bottom: 40px;
            background-color: #03A9F4;
        }
        100% {
            bottom: 0;
            background-color: #03A9F4;
        }
    }
</style>