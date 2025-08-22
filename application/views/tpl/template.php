<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laundro Klean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?=base_url();?>assets/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/fullcalendar.min.css" />
    
    
    
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/datatables.responsive.bootstrap4.min.css" />


    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/glide.core.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/images/lk.jpg" />
    
   
    <script src="<?=base_url();?>assets/js/vendor/jquery-3.3.1.min.js"></script>
   
   
   
   <style>
       .navbar .navbar-right {
            display: flex;
            align-items: center;
            justify-content: end;
       }
       
       .openbtn {
            margin-right: 10px;
            background: #fff;
            color: #ed7117;
            border-color: #ed7117;
            /*outline: none !important;*/
            outline: 5px auto -webkit-focus-ring-color;
        }
       
       .closebtn {
            position: absolute;
            top: 4px;
            left: 10px;
            font-size: 25px;
       }
       #app-container.sub-hidden.menu-mobile .main-menu {
            transform: translateX(-90px) !important;
       }
       
       .sub-hidden .menu .main-menu.default-transition {
            transform: translateX(0px) !important;
       }
       
       .page-item.disabled .page-link {
            padding: 8px 10px;
        }
        #table {
            overflow-x: auto;
            display: block;
        }
        
         div.dataTables_wrapper div.dataTables_paginate {
            margin-top: 0px;
        }
           
    @media screen and (max-width: 767px) {
        .menu .main-menu .scroll {
           margin-top: 20px;
        } 
        #app-container.menu-mobile .main-menu {
            transform: translateX(-90px);
        }
       .navbar .navbar-left {
            flex-basis: 72%;
        }
        .navbar .navbar-left .btn { 
            margin-left: 8px !important;
            padding: 7px 10px;
        }
        .navbar .navbar-right {
            flex-basis: 23%;
        }
        .navbar .navbar-right .user {
            margin-right: 8px;
        }
    }
    
    @media (max-width: 767px) {
        #app-container.main-hidden .main-menu, #app-container.menu-hidden .main-menu {
            transform: translateX(-100px)!important;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: 25px;
        }
    }
    
    .green .btn-info, .green .btn-danger {
        margin-bottom: 4px;
    }
   
    #table_wrapper .row:nth-child(3) {
        align-items: center;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        justify-content: end;
    }
    
    @media (max-width: 991px) {
         #table_wrapper .row:nth-child(3) {
            display: block;
         }
        div.dataTables_wrapper div.dataTables_info {
            text-align: center;
        }
        #table_wrapper .row:nth-child(3) .col-md-7, #table_wrapper .row:nth-child(3) .col-md-5 {
            max-width: 100%;
        }
        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            justify-content: center;
        }
    }
    
    .default-transition h3, .default-transition h6 {
        font-size: 24px;
    }
    @media (max-width: 450px) {
        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            justify-content: start;
            overflow: auto;
        }
    }
    
      
    
       
   </style>

</head>

<body id="app-container" class="menu-default show-spinner <?php if($this->uri->segment('1') =='pos') echo 'main-hidden sub-hidden'; ?>">
    <div class="app-container">
    <?php
    if(settings()->audio_alert ==true):
    ?>
    <audio class="sound1" src="<?php echo base_url('assets/').'sound/bleep3.mp3';?>"></audio>
    <audio class="sound2" src="<?php echo base_url('assets/').'sound/beep7.mp3';?>"></audio>
    <audio class="sounderr" src="<?php echo base_url('assets/').'sound/error.mp3';?>"></audio>
    <?PHP
    endif;
    ?>

    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
           


            <?php
                    if(permission_link())
                    {
                    ?>
            <a class="btn btn-sm btn-info ml-3 d-md-inline-block"
                href="<?=base_url('settings');?>"><i class="glyph-icon simple-icon-settings"></i> <?=display('settings');?> </a>
                  <?php 
                    }
                  ?>

            <a class="btn btn-sm btn-info ml-3 d-md-inline-block"
                href="<?=base_url();?>"><i class="glyph-icon simple-icon-home"></i> <?=display('main');?> </a>

           
            <?PHP
            if(isset($activbmregister))
            {
                ?>
                <!--<a href="javascript:void(0)" class="btn btn-sm btn-danger ml-3 d-none d-md-inline-block" onclick="CloseRegister()"> <i class="glyph-icon simple-icon-close"></i>   <?=display('close_register');?></a>-->

                <?PHP
            }
            else
            {
                ?>
                <a class="btn btn-sm btn-success ml-3 d-md-inline-block"
                href="<?=base_url('pos');?>"> <i class="glyph-icon iconsminds-cash-register-2"></i> <?=display('pos');?></a>
                <?PHP
            }
            ?>
             <a class="btn btn-sm btn-warning ml-3 d-none d-md-inline-block"
                href="<?=base_url('payroll');?>" target="_blank"> <i class="glyph-icon iconsminds-cash-register-2"></i> Payroll</a>
        </div>

        <!-- <div class="">
          <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="ltrRadio" name="directionRadio" class="custom-control-input direction-radio" data-direction="ltr">
          <label class="custom-control-label" for="ltrRadio">Ltr</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="rtlRadio" name="directionRadio" class="custom-control-input direction-radio" data-direction="rtl">
            <label class="custom-control-label" for="rtlRadio">Rtl</label>
          </div>
        </div> -->
        <!--<a class="navbar-logo" href="<?=base_url();?>">-->
        <!--    <span class="logo-mobile d-block d-xs-none"></span>-->
        <!--</a>-->

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
               

                <div class="position-relative d-inline-block">
                    <!--<button class="header-icon btn btn-empty" type="button" id="notificationButton"-->
                    <!--    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--    <i class="glyph-icon simple-icon-list"></i>-->
                    <!--    <?=display('language');?>-->
                    <!--</button>-->
                    
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="">
                        
                        <div class="scroll">
        //                         <?php
        //                         if(!empty(languages()))
        //                         {
        //                         	foreach (languages() as  $key => $lng) {
        //                         ?>               
        //                       <div class="d-flex flex-row mb-3 border-bottom">
        //                         <div class="pl-3">
        //                             <a id="rtlRadio" data-direction="rtl" class="direction-radio" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/<?php echo $key; ?>">
        //                                 <p class="font-weight-medium mb-1"><?=display($lng);?></p>
        //                             </a>
        //                         </div>
        //                         </div>
								// <?php
								//   }
        //                           }
								// ?>
                        </div>
                        
                    </div>
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name"><?=user_info()->name;?></span>
                    <span>
                        <img alt="Profile Picture" src="<?=base_url();?>assets/img/profiles/l-3.jpg" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="<?=base_url('settings/profile');?>"><?=display('account');?></a>
                    <a class="dropdown-item" href="<?=base_url('app/logout');?>"><?=display('signout');?></a>
                </div>
            </div>
            <button class="openbtn d-block d-md-none" onclick="openNav()">☰ </button>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu" id="mySidebar">
            <a href="javascript:void(0)" class="closebtn d-block d-md-none" onclick="closeNav()">×</a>
            <div class="scroll">
                <ul class="list-unstyled">
                    
                    <li  class="<?php echo ($activemn=='product') ? 'active' : ''; ?>">
                        <a href="<?=base_url('products')?>">
                            <i class="fa fa-box"></i> <?=display('products');?>
                        </a>
                    </li>
                    <li class="<?php echo ($activemn=='sales') ? 'active' : ''; ?>">
                        <a href="<?=base_url('sales')?>">
                            <i class="fa fa-tag"></i> <?=display('sales');?>  
                        </a>
                    </li>
                    
                    <!--<li class="<?php echo ($activemn=='onlineSales') ? 'active' : ''; ?>">-->
                    <!--    <a href="<?=base_url('onlineSales')?>">-->
                    <!--        <i class="iconsminds-air-balloon-1""></i> Online Sales  -->
                    <!--    </a>-->
                    <!--</li>-->
                    
                    <li class="<?php echo ($activemn=='pos/pos_list') ? 'active' : ''; ?>">
                        <a href="<?=base_url('pos/pos_list')?>">
                            <i class="fa fa-list" aria-hidden="true"></i> PosList  
                        </a>
                    </li>
                    <li class="<?php echo ($activemn=='client') ? 'active' : ''; ?>">
                        <a href="<?=base_url('clients')?>">
                            <i class="fa fa-users"></i> <?=display('customers');?>
                        </a>
                    </li>
                    <?php
                    if(permission_link())
                    {
                    ?>
                    <li class="<?php echo ($activemn=='expence') ? 'active' : ''; ?>">
                        <a href="<?=base_url('expences');?>">
                            <i class="fas fa-file-alt"></i> <?=display('expenses');?> 
                        </a>
                    </li>
                    <li class="<?php echo ($activemn=='user') ? 'active' : ''; ?>">
                        <a href="<?=base_url('users');?>">
                            <i class="fa fa-user"></i> <?=display('system_users');?>
                        </a>
                    </li>
                    <li class="<?php echo ($activemn=='repports') ? 'active' : ''; ?>">
                        <a href="<?=base_url('repports')?>">
                            <i class="fa fa-file-invoice"></i> <?=display('reports');?> 
                        </a>
                    </li>
                    <?php if($this->session->userdata('role_id') == '1'){ ?>
                     <li class="<?php echo ($activemn=='orderstatus') ? 'active' : ''; ?>">
                        <a href="<?=base_url('orderstatus')?>">
                            <i class="fa fa-chart-bar"></i> Order Status 
                        </a>
                    </li>
                   <?PHP
                    }
                    }
                    ?>
                    
                </ul>
            </div>
        </div>

        <div class="sub-menu">
           
        </div>
    </div>

    <main>
       
            <?=$content_page;?>
      
   
    </main>

    
    </div>
    
    
    <script style="opacity: 1;">
    function openNav() {
      document.getElementById("mySidebar").style.transform = "translateX(0px)";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.transform = "translateX(-90px)";
      document.getElementById("main").style.marginLeft= "0";
    }
    </script>
    
    <script>
     var linkurl = '<?=base_url();?>assets/css/';
    </script>
    <script src="<?=base_url();?>assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/moment.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/fullcalendar.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/datatables.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/progressbar.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/jquery.barrating.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/select2.full.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/nouislider.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/bootstrap-datepicker.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/Sortable.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/mousetrap.min.js"></script>
    <?php if(!$glide){ ?>
      <script src="<?=base_url();?>assets/js/vendor/glide.min.js"></script>
    <?php } ?>



    <script src="<?=base_url();?>assets/js/dore.script.js"></script>
    <script src="<?=base_url();?>assets/js/scripts.js"></script>

</body>

</html>