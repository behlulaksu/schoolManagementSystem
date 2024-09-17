<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <title><?php echo get_the_title(); ?></title>
    <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
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

    <?php  
    if ($current_user_now->roles[0] === 'student') {
        $return_url = get_site_url().'/student-home/';
        wp_redirect( $return_url );
    }

    if (empty($current_user_now->roles[0])) {
        $return_url = get_site_url().'/unauthorized-access/';
        wp_redirect( $return_url );
    }

    ?>
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
                       $all_sites_reversed = array_reverse($all_sites); 
                       foreach ($all_sites_reversed as $key => $value) {
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
                                <?php  
                                if ($current_user_now->roles[0] === 'administrator') {
                                    ?>
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" target="_blank" href="<?php echo get_site_url(); ?>/admin">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/brands/github.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>
                                            Admin 
                                            <br>
                                            Panel
                                        </span>
                                    </a>
                                    <?php 
                                }
                                ?>
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
                        <?php $user_image = get_field('user_image', 'user_'.get_current_user_id()); ?>
                        <?php  
                        if (empty($user_image)) {
                            ?>
                            <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/users/avatar-6.jpg" alt="<?php echo $current_user_now -> display_name; ?>">
                            <?php 
                        }else{
                            ?>
                            <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2" src="<?php echo $user_image; ?>" alt="<?php echo $current_user_now -> display_name; ?>">
                            <?php 
                        }
                        ?>
                        <span class="fw-medium hidden xl:block">
                            <?php echo $current_user_now -> display_name; ?>
                        </span>
                        <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                    </button>
                    <div class="dropdown-menu absolute top-0 ltr:-left-3 rtl:-right-3 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800" id="profile/log">
                        <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                            <div class="dropdown-item dark:text-gray-100">
                                <a href="<?php echo get_site_url(); ?>/user-profile" class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="apps-contacts-profile.html">
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
                    <a href="<?php echo get_site_url(); ?>/dashboard" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"> Dashboard</span>
                    </a>
                </li>


                <?php if (get_user_access_read('users-menu')): ?>
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="users"></i>
                            <span data-key="t-auth">Users</span>
                        </a>
                        <ul>
                           <?php 
                           if ($current_user_id === 1) {
                            ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/all-users" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">All Users</a>
                            </li>
                            <?php 
                        }

                        ?>
                        <?php if (get_user_access_read('students')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/all-students" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Students</a>
                            </li>
                        <?php endif ?>

                        <?php if (get_user_access_read('staff')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/all-staff" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Staff</a>
                            </li>
                        <?php endif ?>

                        <?php if (get_user_access_read('upload-user-as-bulk')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/upload-users-bulk" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Upload Users</a>
                            </li>
                        <?php endif ?>

                    </ul>
                </li>
            <?php endif ?>

            <?php if (get_user_access_read('classes-menu')): ?>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-compo">Classes</span>
                    </a>
                    <ul>

                        <?php if (get_user_access_read('see-all-classes')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/all-groups" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">All Classes</a>
                            </li>
                        <?php endif ?>

                        <?php if (get_user_access_read('create-new-class')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/create-group" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">New Class</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </li>
            <?php endif ?>
            <?php  
            if ($current_user_now->roles[0] === 'teacher') {
                ?>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-compo">Classes</span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo get_site_url(); ?>/all-groups" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">All Classes</a>
                        </li>
                    </ul>
                </li>
                <?php 
            }
            ?>

            <?php if (get_user_access_read('subject-menu')): ?>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="map"></i>
                        <span data-key="t-compo">Subjects</span>
                    </a>
                    <ul>
                        <?php if (get_user_access_read('list-subject')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/lessons" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    All Subjects
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if (get_user_access_read('add-new-subject')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    Create Subjects
                                </a>
                            </li> 
                        <?php endif ?>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-bookmark group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
                        <span data-key="t-charts">
                            Objectives
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo get_site_url(); ?>/objectives-settings" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                All Objectives
                            </a>
                        </li>
                        <?php  
                        for ($i=1; $i < 13; $i++) { 
                            ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/objectives-settings?grade=<?php echo $i; ?>" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    Grade <?php echo $i; ?>
                                </a>
                            </li>
                            <?php 
                        }
                        ?>
                    </ul>
                </li>
            <?php endif ?>

            <?php if (get_user_access_read('assessment-menu')): ?>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="sliders"></i>
                        <span data-key="t-charts">
                            Assesment Modules
                        </span>
                    </a>
                    <ul>

                        <?php if (get_user_access_read('see-module')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/all-gradebook-definitions" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    All Modules
                                </a>
                            </li>
                        <?php endif ?>

                        <?php if (get_user_access_read('create-module')): ?>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/create-gradebook" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Create Module</a>
                            </li>
                        <?php endif ?>

                    </ul>
                </li>
            <?php endif ?>


            <?php if (get_user_access_read('students')): ?>
                <li>
                    <a href="<?php echo get_site_url(); ?>/point-all-students" aria-expanded="false"  class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-user group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20 feather feather-sliders"></i>
                        <span data-key="t-charts">
                            Students
                        </span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($current_user_id === 1 || $current_user_id === 994): ?>
                <li> 
                    <a href="<?php echo get_site_url(); ?>/authorizations" aria-expanded="false"  class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-lock-open group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20 feather feather-sliders"></i>
                        <span data-key="t-charts">
                            Authorizations
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo get_site_url(); ?>/authorization-who" aria-expanded="false"  class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-lock-open group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20 feather feather-sliders"></i>
                        <span data-key="t-charts">
                            Authorization Pages
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo get_site_url(); ?>/campus-settings" aria-expanded="false"  class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-code group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
                        <span data-key="t-charts">
                            Campus Settings
                        </span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (get_user_access_write('pdp-comment')): ?>
                <li>
                    <a href="<?php echo get_site_url(); ?>/pdp-settings" aria-expanded="false"  class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i style="margin-right: 9px; font-size: 17px;" class="dripicons-heart group-hover:bg-violet-50/50 group-hover:text-violet-500 dark:border-zinc-600 dark:group-hover:border-transparent dark:group-hover:bg-violet-500/20"></i>
                        <span data-key="t-charts">
                            PDP
                        </span>
                    </a>
                </li>
            <?php endif ?>


        </ul>

    </div>

</div>
</div>
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