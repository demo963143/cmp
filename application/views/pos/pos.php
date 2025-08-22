<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2-bootstrap.min.css" />

<style>

.fetchservice a button{
    height:100%;
}

.default-transition h3, .default-transition h6 {
    font-size:16px;
}

.card-body button h4{
    font-size:16px;
}

.modal .modal-header{
    margin:0!important;
    
    padding:10px 10px!important;
}



.needs-validation .modal-body{
    margin-top:10px;
}

.billpri{
    display:none;
}

#printSection{
    padding-top:0!important;
}

.modal-body{
    padding-top:0!important;
}


#app-container.menu-hidden main, #app-container.menu-sub-hidden main, #app-container.sub-hidden main {
    margin-left: 140px !important;
}

@media (max-width: 767px) {
    .card-body .btn.btn-primary.btn-lg{
        padding: 10px 0;
        width: 49.2%;
    }
    
    
    
    
    #app-container.menu-hidden main, #app-container.menu-sub-hidden main, #app-container.sub-hidden main {
        margin-left: 15px !important;
    }
}
#barcodeprint img.logonew {
    display: none;
}
#barcodeprint .secondtable {
    display: none;
}

#barcodeprint .firstsec{
    display:none;
}
#barcodeprint .headingnew{
    display:none;
}
#barcodeprint .dnone{
    display:none;
}

.table-bordered th, .table-bordered td {
    border-top: 1px solid #dee2e6 !important;
    border: none;
}

.table-bordered {
    border: none;
}

#ticket .prdnone{
    display:none;
}

    .iconsminds-zouhir:before {
        content: '\e227';
    }

    .register-img {
        fill: #ed7117;
    }

    .selectedGat {
        background-color: #17a2b8;
        border: 1px solid #17a2b8;
    }

    .selectedProd {
        background-color: #17a2b8;
        border: 1px solid #17a2b8;
        color: #ffffff;
    }

    .selectedbtm {
        background-color: #17a2b8;
        border: 1px solid #17a2b8;
        color: #ffffff;
    }

    .selectedbtm2 {
        background-color: #17a2b8;
        border: 1px solid #17a2b8;
        color: #ffffff;
    }

    .rtl .input-group>.input-group-prepend>.btn {
        border-radius: 0px
    }

    .rtl .input-group>.input-group-append>.btn {
        border-radius: 0px
    }

    .scrollbar {
        height: 240px;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-bottom: 5px;
    }
    
    .input_box {
        position: absolute;
        left: 90px;
    }
    
    #delivery_date, #pickup_date  {
        padding: .5rem .25rem;
    }
    
    .btn.default.btn-lg {
        word-wrap: normal;
    }
    
    .select2-container .select2-selection--single {
        height: 38px;
    }
    
    .select2-container--bootstrap .select2-selection.form-control {
        height: calc(2em + .8rem);
        padding: 10px;
        margin-right: 8px;
        margin-bottom: 4px;
    }
    
    .select2-container--bootstrap {
         margin-right: 8px;
    }
    
    @media screen and (max-width: 768px) {
        .btn-light {
            padding: 10px;
        }
    }
    
    .btn h3, .btn h4 {
        margin-bottom: 0px !important;
    }
    
    .btn.btn-success.btn-lg, .btn.btn-primary.btn-lg, .btn.btn-danger.btn-lg {
        padding: 10px 30px;
    }

    #style-1::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 1px;
        background-color: #ececec;
    }

    #style-1::-webkit-scrollbar {
        width: 10px;
        background-color: #ececec;
    }

    #style-1::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #138496;
    }

    #printSection {
        color: #000;
        margin: 0 auto;
          
    }
    
        #printSection img {
       width:15.5rem !important;
         
    }

    #ticket .modal-dialog {
        width: 100%;
    }


    #modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }

    /*print styling*/

    @media print {
        .modal-dialog {
            width: 100% !important;
            ;
        }

        .modal {
            visibility: visible;
            /**Remove scrollbar for printing.**/
            overflow: visible !important;
        }

        .modal-dialog {
            visibility: visible !important;
            /**Remove scrollbar for printing.**/
            overflow: visible !important;
            height: auto !important;
            width: auto !important;
        }

        body * {
            visibility: hidden;
        }

        .container-fluid {
            display: none;
        }

        #printSection,
        #printSection * {
            visibility: visible;
           
        }

        #printSectionInvoice,
        #printSectionInvoice * {
            visibility: visible;
          
        }

        #printSection {
            text-transform: uppercase;
            font-size: 14px;
            font-weight:600;
            left: 0;
            top: 0;
            padding: 0;
            margin: 0;
        }

        #printSection h4 {
            font-size: 14px;
            font-weight:600;
        }

        #printSection {
            font-size: 14px;
            font-weight:600;
        }

        #printSection tr td {
            margin: 0;
            padding: 0;
            
             
        }

        #printSection .bg-success,
        #printSection .bg-danger {
            visibility: hidden;
        }

        .table {
            color: #000000;
           
        }

        @page {
            margin: 0;
        }

        .hiddenpr {
            display: none !important;
        }

        html,
        body {
            zoom: 95%;
            overflow: hidden !important;
        }

    }
    
    
    
    
    
    


@keyframes bounceIn {
  0% {
    transform: scale(0.1);
    opacity: 0;
  }
  60% {
    transform: scale(1.2);
    opacity: 1;
  }
  100% {
    transform: scale(1);
  }
}

@-webkit-keyframes bounceIn {
  0% {
    transform: scale(0.1);
    opacity: 0;
  }
  60% {
    transform: scale(1.2) rotate(90deg);
    opacity: 1;
  }
  100% {
    transform: scale(1);
  }
}

div#load {
  animation : bounceIn 2s;
  -webkit-animation: bounceIn 2s ease-in-out;
  width: 150px;
  height: 150px;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    border-radius:0;
  }
  100% {
    opacity: 1;
    border-radius:50px;
  }
}

@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
    border-radius:0;
  }
  100% {
    opacity: 1;
    border-radius:50px;
  }
}

@keyframes rotateR {
  from {
    transform: rotate(0deg);
    
  }
  to {
    transform: rotate(360deg);
    
  }
}

@-webkit-keyframes rotateR {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

div#SqCo {
  text-align:center;
  background-color:#8CC7CC;
  width: 100%;
  height: 150px;
  padding-top: 34.5px;
}

div#SqCo .bloc{
  background:white;
  display:inline-block;
  width:50px;
  height:50px;
  margin: 0 10px;
  opacity:0;
}

div#SqCo .bloc.one {
  -webkit-animation: fadeIn 1s linear 0s infinite alternate,
                    rotateR 1s linear 0s infinite;
  animation: fadeIn 1s linear 0s infinite alternate,
              rotateR 1s linear 0s infinite;
}
div#SqCo .bloc.two {
  -webkit-animation: fadeIn 1s linear 0.5s infinite alternate,
              rotateR 1s linear 0.5s infinite;
  animation: fadeIn 1s linear 0.5s infinite alternate,
              rotateR 1s linear 0.5s infinite;
}
div#SqCo .bloc.three {
  -webkit-animation: fadeIn 1s linear 1s infinite alternate,
              rotateR 1s linear 1s infinite;
  animation: fadeIn 1s linear 1s infinite alternate,
              rotateR 1s linear 1s infinite;
}
div#SqCo .bloc.four {
  -webkit-animation: fadeIn 1s linear 1.5s infinite alternate,
              rotateR 1s linear 1.5s infinite;
  animation: fadeIn 1s linear 1.5s infinite alternate,
              rotateR 1s linear 1.5s infinite;
}
div#SqCo .bloc.five {
  -webkit-animation: fadeIn 1s linear 2s infinite alternate,
              rotateR 1s linear 2s infinite;
  animation: fadeIn 1s linear 2s infinite alternate,
              rotateR 1s linear 2s infinite;
}

div#SqCo p{
  color:white;
  font-size:30px;
  font-family:"farray";
  margin-bottom:10px;
}

div#SqCo p .point{
  opacity:0;
}

div#SqCo p .point.one {
  -webkit-animation: fadeIn 1s linear 0s infinite alternate;
  animation: fadeIn 1s linear 0s infinite alternate;
}
div#SqCo p .point.two {
  -webkit-animation: fadeIn 1s linear 0.5s infinite alternate;
  animation: fadeIn 1s linear 0.5s infinite alternate;
}
div#SqCo p .point.three {
  -webkit-animation: fadeIn 1s linear 1s infinite alternate;
  animation: fadeIn 1s linear 1s infinite alternate;
}
/*EyeCo*/
div#EyeCo {
  text-align:center;
  background-color:#3498db;
  width: 100%;
  height: 170px;
  padding-top: 34.5px;
}
div#face{
  opacity:0;
}
div#EyeCo .paupiere{
  background:black;
  display:inline-block;
  width:50px;
  height:50px;
  margin: 0 ;
  border-radius:100% 100% 0 0;
}
div#EyeCo .eye{
  background:white;
  display:inline-block;
  width:50px;
  height:50px;
  margin: 0 10px;
  border-radius:100% 100% 0 0;
}
div#EyeCo .eye .pupil {
  background:black;
  display:inline-block;
  width:35px;
  height:35px;
  margin:15px 10px;
  border-radius:100% 100% 0 0;
  -webkit-border-radius:100% 100% 0 0;
  -moz-border-radius:100% 100% 0 0;
}
div#EyeCo .eye .pupil .iris {
  background:white;
  display:inline-block;
  width:15px;
  height:15px;
  margin:15px 10px;
  border-radius:100%;
  -webkit-border-radius:100%;
  -moz-border-radius:100%;
}
div#EyeCo .eye .pupil .iris .reflet{
  background:black;
  display:inline-block;
  width:5px;
  height:5px;
  margin:5px;
  border-radius:100%;
  -webkit-border-radius:100%;
  -moz-border-radius:100%;
}
div#EyeCo .nose {
  display:block;
  font-size:30px;
  transform:rotate(-90deg);
  -webkit-transform:rotate(-90deg);
  -moz-transform:rotate(-90deg);
}
@keyframes moveIn {
  0% {
    opacity:0;
  }
  100% {
    opacity: 1;
  }
}

@-webkit-keyframes moveIn {
  0% {
    opacity:0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes moveEyes {
  0% {
    margin-left:10px;
  }
  5% {
    margin-left:10px;
  }
  35% {
    margin-left:20px;
  }
  40% {
    margin-left:-10px;
  }
  70% {
    margin-left:-10px;
  }
  90% {
    margin-left:10px;
  }
}

@-webkit-keyframes moveEyes {
  0% {
    margin-left:10px;
  }
  30% {
    margin-left:20px;
  }
  60% {
    margin-left:-10px;
  }
  90% {
    margin-left:10px;
  }
  100% {
    margin-left:10px;
  }
}

div#face {
  -webkit-animation: moveIn 1s linear 1s 1 forwards;
  animation: moveIn 1s linear 1s 1 forwards;
}
div#EyeCo .eye .iris {
  -webkit-animation: moveEyes 3s linear 2s infinite;
  animation: moveEyes 3s linear 2s infinite;
}
    
    
.hiddenpr {
    margin-bottom: 10px;
}    
    
#sectionviewsale h4 {
    margin-top: 10px;
}    
    
    
    
    
    
    
    
    
</style>


<style>
/*@media only screen and (max-width: 768px) {*/
/*  .qtflex {*/
/*     width:20px;*/
/*     display:flex;*/
/*    position: absolute;*/
/*    left: 180px;*/
/*  }*/
/*  .total_price{*/
/*     width:20px;*/
/*     display:flex;*/
/*    position: absolute;*/
/*    left: 271px; */
/*  }*/
/*}*/
</style>




<!-----------------Main Content------------------------->

<div class="row waitloadpage">
    <div class="col-xl-6 col-lg-12 mb-0">
        <div class="card">
            <div class="card-body p-2">
                
                <div class="w-100 mb-2">
                    
                    <button type="button" class="btn btn-primary btn-lg mb-1 text-center default categories lundaryadd" id="" value="laundry">Laundry By Kilo</button>
                    
                    <button type="button" class="btn btn-primary btn-lg mb-1 text-center default categories selectedGat" id=""><?= display('all') ?></button>
                    
                    <?php
                        foreach ($categories as $category) {
                         if($category->name != 'Laundry')
                         {
                          ?>
                            <button type="button" class="btn btn-primary btn-lg mb-1 text-center default categories" id="<?= $category->id; ?>"><?= $category->name; ?></button>
                          <?PHP
                          }
                        }
                    ?>
                    
                </div>
                
                <div class="row px-3 py-1 productsearch">
                
                <input type="text" id="productsearch" class="form-control col-8 mr-2 mb-1" placeholder=" <?= display('find_an_product') ?> " style="font-size: 15px;">
                <button type="button" class="btn btn-primary  text-center default mr-2 mb-1" onclick="productSearch()">
                    <i class="simple-icon-magnifier"></i>
                </button>
               
               
               
                <span id="errorproduct_search" class="text-danger"></span>
             </div>
                <div class="scroll dashboard-list-with-thumbs ps ps--active-y" id="productList" style="display:block;height:500px">

                    <?PHP
                    if ($products) {
                        foreach ($products as $product) :
                    ?>
                            <a href="javascript:void(0)" class="btn btn-light default mb-1 mr-1 addPct" style="padding-left:5px!important; padding-right:5px!important; padding-bottom:5px!important; text-align:center; width: 23%!important; border-top:4px solid #138496; height:100px" id="<?= $product->num; ?>" onclick="add_prodpos('<?= $product->id; ?>')">
                                <div class="card-body text-center p-0">
                                    <?PHP
                                    $type = substr($product->icon, strrpos($product->icon, '.') + 0);
                                    if ($type == '.svg') {
                                    ?>
                                        <img class="mt-1 mb-1" src="<?= base_url() . '/files/svg/' . $product->icon; ?>" width="45%">
                                    <?PHP
                                    } else {
                                    ?>
                                        <i class="<?= $product->icon; ?>" style="font-size: 30px;"></i>
                                    <?PHP
                                    }
                                    ?>
                                    <p class="card-text mb-2"><?= $product->name; ?></p>

                                    <input type="hidden" id="idname-<?= $product->id; ?>" name="name" value="<?= $product->name; ?>" />
                                    <input type="hidden" id="category" name="category" value="<?= $product->category_id; ?>" />
                                    <input type="hidden" id="price-<?= $product->id; ?>" name="category" value="<?= $product->category_id; ?>" />

                                </div>


                            </a>
                        <?PHP
                        endforeach;
                    } else {
                        ?>
                        <div id="" style="overflow: hidden; width: 95%; height: 220px; margin: 20px">
                            <div class="messageVide"><?= display('empty') ?><span></span></div>
                        </div>
                    <?PHP
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-12 mb-0">

        <div class="card">

            <form>
                <div class="card-body p-2">

                    <div class=" ps ps--active-y">
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype1" style="border-top:4px solid #138496;" id="laundry"><?= display('laundry') ?></button>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype1" style="border-top:4px solid #138496;" id="lroning">Ironing<?//= display('ironing') ?> </button>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype1" style="border-top:4px solid #138496;" id="laundrylroning"><?= display('laundrylroning') ?> </button>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype1" style="border-top:4px solid #138496;" id="dry"> <?= display('dry_wash') ?> </button>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype1" style="border-top:4px solid #138496;" id="other"> <?= display('other_services') ?> </button>

                        <hr>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype2" style="border-top:4px solid #138496;" id="normal"> <?= display('normal') ?> </button>
                        <button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default selectype2" style="border-top:4px solid #138496;" id="fast">Express</button>
                        <div class="w-100">
                            <!--<input type="number" value="1" min="1" max="100" step="1" id="" name="qtecart" />-->
                            <input type="text" id="qtecart" name="qtecart" class="form-control" value="1"> <!-- Rakesh -->
                            
                             <input type="text" id="luandryinput" name="luandryinput" class="form-control luandryinput" value="" hidden>
                        </div>
                        <hr>
                        <select id="color" name="color" class="form-control mb-4" data-width="100%" data-height="20%" required>
                            <option value="<?=display('white')?>" style="background-color: #ffffff;"><?= display('color') ?></option>

                            <?PHP
                            foreach ($colors as $color) {
                            ?>
                                <option value="<?= $color->name ?>" style="background-color:<?= $color->color ?>;"> <?= $color->name ?></option>
                            <?PHP
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary  btn-lg mb-1 w-100 text-center default" onclick="add_posale()"> <?= display('add') ?> </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 mb-0">

        <div class="card">
            <div class="row px-4 py-1">
                
                <div class="col-12 d-flex p-0">
                <input type="text" id="salesearch" class="form-control mr-2 mb-1" placeholder=" <?= display('find_an_invoice') ?> " style="font-size: 15px;">
                <button type="button" class="btn btn-primary btn-xs  text-center default mb-1" onclick="SaleSearch()">
                     <i class="simple-icon-magnifier"></i>
                </button>
                </div>
                
                <span id="errorsale_searsh" class="text-danger"></span>
           
           
           
           
            </div>
            <div class="card-body px-2 py-0">

                <div class="row px-3">
                    <div class="col-12 d-flex p-0">
                    <select id="customerSelect" name="" class="form-control select2-single" >
                        <option value="0"><?= display('default_client') ?></option>
                        <?php
                        foreach ($clients as $client) {
                        ?>
                            <option value="<?= $client->id; ?>"><?= $client->lastname . ' ' . $client->firstname . ' ' . $client->phone; ?></option>
                        <?PHP
                        }
                        ?>
                    </select>
                    <button type="button" class="btn btn-xs btn-primary  text-center default mb-1" data-toggle="modal" data-target="#clientModal">
                        <i class="fa fa-plus"></i>
                    </button>
                    </div>
                    
                    
                    <div class="input-group col-lg-12 mt-1 p-0">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                             <input type="text" class="form-control" id="phoneClient" placeholder="<?= display('phone') ?>">
                        </div>
                        <div class="col-md-12 px-0 d-flex">
                        <div class="col-md-8 px-0">
                            
                        <div class="input-group col-lg-12 mt-1 pl-0">
                            <div class="input-group-prepend">
                                <div style="padding-left:4px; padding-right:4px;" class="input-group-text">Invoice Date</div>
                            </div>
                             <input type="date" style="padding-left:4px; padding-right:4px;" class="form-control" id="invoice_date" name="invoice_date" placeholder="Invoice Date" value="<?=date('Y-m-d');?>">
                        </div>
                            
                        <div class="input-group col-lg-12 mt-1 pl-0">
                                    <div class="input-group-prepend">
                                        <div style="padding-left:4px; padding-right:4px;" class="input-group-text">Pickup Date</div>
                                    </div>
                             <input type="date" style="padding-left:4px; padding-right:4px;" class="form-control" id="pickup_date" name="pickup_date" placeholder="Pickup Date" value="<?=date('Y-m-d');?>">
                        </div>
                        <div class="input-group col-lg-12 mt-1 pl-0">
                                    <div class="input-group-prepend">
                                        <div style="padding-left:4px; padding-right:4px;" class="input-group-text">Delivery Date</div>
                                    </div>
                             <input type="date" style="padding-left:4px; padding-right:4px;" class="form-control" id="delivery_date" name="delivery_date" placeholder="Delivery Date">
                        </div>
                        </div>
                        
                        <div class="input-group col-md-4 col-4 mt-1 pl-0 pr-0">
                                    <div class="" style="width:100%; border:1px solid #d7d7d7; padding:8px;">
                                        <div class="" style="width:100%;">
                                        <p style="margin-bottom:10px">Store</p>
                                        <div class="d-flex">
                                        <p style="margin-bottom:0px">Pickup</p>
                                        <input class="form-check-input input_box" type="radio"  name="store_delivery" value="pickup" checked>
                                        </div>
                                         <div class="d-flex">
                                        <p style="margin-bottom:0px">Delivery</p>
                                        <input class="form-check-input input_box" type="radio" name="store_delivery" value="delivery">
                                        </div>
                                        
                                        </div>
                                    </div>
                             
                        </div>
                        </div>
                
                </div>

                <div class="dashboard-list-with-thumbs ps ps--active-y" style="height: 450px;">

                    <div class="col-md-13">
                        <div class="info mt-4">
                            <div class="row mt-2 pb-1" style="border-bottom:1px solid #138496; color:#0b414a">
                                <div class="col-3 product-name">
                                    <div><?= display('product') ?> </div>
                                </div>
                                <div class="col-3 product-name">
                                    <div> <?= display('service') ?></div>
                                </div>

                                <div class="col-2 price text-center">
                                    <span>Qtya</span>
                                </div>
                                <div class="col-2 price text-center p-0">
                                    <span><?= display('price') ?></span>
                                </div>
                                <div class="col-2  text-center">
                                    <span></span>
                                </div>
                            </div>
                            <div class="scrollbar sds" id="style-1">
                                <div class="cartview" id="cartview">


                                    <?PHP
                                    if ($posales) {
                                        foreach ($posales as $posale) {
                                            $product = $this->product->get_by_id($posale->product_id);
                                            $storeid = $this->session->userdata('store_id');
                                            $services = $this->posale->get_all(array('parent' => $posale->id, 'register' => $this->register, 'store_id' => $this->store_id));
                                            if ($posale->price > 0) {
                                                $posale_price = $posale->price . '' . settings()->currency;
                                            } else {
                                                $posale_price = '';
                                            }

                                            $row = '<div class="row mt-2 pb-1" style="border-bottom:1px dotted #138496">
                            				 <div class="col-3">
                            							 <div>' . $product->name . ' : <span class="value">' . $product->category_name . '</span></div>
                                                         <div> ' . display('color') . ': <span class="value">' . $posale->color . '</span></div>
                            				 </div>
                            				 <div class="col-3">
                            							 <div>' . display($posale->type_one) . ': <span class="value">' . display($posale->type_second) . '</span><BR> ' . $posale_price . ' </div>
                            				 </div>
                            				 
                            				 <div class="col-2 text-center">
                                                 <span class="font-weight-bold">' . $posale->quantity . '</span>
                                                 
                                             </div>
                                             <div class="col-2 text-center">';
                                            if ($posale->total > 0) {
                                                $row .= '<span class="font-weight-bold">' . number_format((float)$posale->total, settings()->decimals, '.', '') . '</span>';
                                            }



                                            $row .= '</div><div class="col-2">
                                             <span class="font-weight-bold"><a href="javascript:void(0)" onclick="delete_posale(' . "'" . $posale->id . "'" . ')"><div class="far fa-trash-alt text-danger"></div></a></span>
                                             </div>
                                             
                                             <div class="col-md-12">';
                                            foreach ($services as $service) {
                                                $row .= '<a href="javascript:void(0)" onclick="delete_posale(' . $service->id . ')"><span class="badge badge-pill badge-success mb-1"><i class="glyph-icon simple-icon-close"></i> ' . $service->product_name . ' (' . $service->total . ') ' . settings()->currency . '</span></a>';
                                            }
                                            $row .= '</div><div class="col-md-12 mt-1"><a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','increment'" . ')"><span class="btn btn-outline-success default btn-xs mr-1"><i class="fa fa-plus"></i></span></a><a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','decrement'" . ')"><span class="btn btn-outline-danger default btn-xs"><i class="fa fa-minus"></i></span></a>
                                             <a href="#servicemodal" class="green" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span class="btn btn-success btn-xs default"><i class="fa fa-plus"></i> Services</span></a>
                                             </div>
                            			 </div>';

                                            echo  $row;
                                        }
                                    } else {
                                        echo '<br><span class="m-5 text-center col-md-12">' . display('empty') . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="row">
                            <div class="table-responsive col-sm-12 totalTab" style="background-color: #f8f8f8; border:1px solid #f1efef">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="active" width="35%" style="padding:3px"> <?= display('subtotal'); ?></td>
                                            <td class="whiteBg" width="65%" style="padding:3px"><span id="Subtot">0.00</span> <?= settings()->currency; ?> <span class="float-right"><b id="ItemsNum"><span>0</span> <?= display('number_of_services'); ?></b></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="active" style="padding:3px"><?= display('tax'); ?></td>
                                            <td class="whiteBg" style="padding:3px"><input type="text" value="<?= settings()->tax; ?>" onchange="total_change()" id="taxValue" class="total-input TAX form-control" placeholder="" maxlength="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="active" style="padding:3px"><?= display('discounts'); ?></td>
                                            <td class="whiteBg" style="padding:3px"><input type="text" value="<?= settings()->discount; ?>" onchange="total_change()" id="RemiseValue" class="total-input Remise form-control" placeholder="" maxlength="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="active" style="padding:3px"><?= display('total'); ?></td>
                                            <td class="whiteBg light-blue text-bold" style="padding:3px"><span id="total">0.00</span> <?= settings()->currency; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 mb-4">
        <div class="card">
            <div class="card-body p-2">
                <div class="btn btn-success default w-100">
                    <h3><i class="glyph-icon iconsminds-money-bag"></i> <?= display('daily_sales'); ?> :
                        <span id="total_sales">
                            <?= number_format((float)($sum_sale_day), settings()->decimals, '.', '') ?>
                        </span> <?= settings()->currency; ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 mb-4">
        <div class="card">
            <div class="card-body p-2">
                <div class="btn btn-success default w-100">
                    <h3><i class="glyph-icon simple-icon-calculator"></i> <?= display('number_of_daily_orders'); ?> : <span id="number_sales"><?= $count_sale ?></span></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 mb-4">
        <div class="card">
            <div class="card-body p-2">
                <div class="d-flex" style="justify-content:space-between;">
                    
                    <button style="width:32%;" type="button" class="btn btn-success btn-lg default float-left text-center" style="width:30%;" id="paid-btn" data-toggle="modal" data-target="#AddSale" disabled>
                        <h4 style="display:inline-block;"><?= display('paid'); ?></h4>
                    </button>
                   
                   
                    <button type="button" class="btn btn-primary btn-lg default float-left text-center" id="print-btn" style="width:32%;" onclick="saleBtn(1,1)" disabled>
                        <h4 style="display:inline-block;"><?= display('print'); ?></h4>
                    </button>
                   
                  
                    <button type="button" class="btn btn-danger btn-lg default float-left text-center" style="width:32%;" onclick="cancelPOS()">
                        <h4 style="display:inline-block;"><?= display('close'); ?></h4>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //  **********************select categorie
    $(document).ready(async function() {
        $('.ChequeNum').hide();
        $('#customerSelect').select2();

        $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
        $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
        const resp = await fetch("<?php echo site_url('pos/subtot') ?>");
        let subTotal = await resp.text()
        console.log(subTotal)
        if(!isNaN(subTotal) && subTotal > 0){
            $('#print-btn').removeAttr('disabled');
            $('#paid-btn').removeAttr('disabled');
        }else{
            $('#print-btn').attr('disabled', 'disabled'); // Add 'disabled' attribute
            $('#paid-btn').attr('disabled', 'disabled');
        }
        
        $(".categories").on("click", function() {
            var filter = $(this).attr('id');
            $(this).parent().children().removeClass('selectedGat');
            $(this).addClass('selectedGat');
            $('#productList').load("<?php echo site_url('pos/load_product/') ?>/" + filter);

        });
        $(".addPct").on("click", function() {
            var filterprd = $(this).attr('id');
            $(this).parent().children().removeClass('selectedProd');
            $(this).addClass('selectedProd');
        });

        $(".selectype1").on("click", function() {
            var filterprd = $(this).attr('id');
            //alert(filterprd);
            $(this).parent().children().removeClass('selectedbtm');
            $(this).addClass('selectedbtm');
            $.ajax({
                url: "<?php echo site_url('pos/add_typeone') ?>/",
                type: "POST",
                data: {
                    selectype1: filterprd
                },
                success: function(data) {},
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });

        });
        $(".selectype2").on("click", function() {
            var filterprd = $(this).attr('id');
            $(this).parent().children().removeClass('selectedbtm2');
            $(this).addClass('selectedbtm2');
            $.ajax({
                url: "<?php echo site_url('pos/add_typetow') ?>/",
                type: "POST",
                data: {
                    selectype2: filterprd
                },
                success: function(data) {},
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });

        });
        
        $('#servicemodal').on('show.bs.modal', function(e) {
            var posall_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/pos/servicemodal/',
                data: 'posall_id=' + posall_id,
                success: function(data) {
                    $('.fetchservice').html(data);
                    // $('#service_posale').load("<?php echo site_url('pos/load_service_posale') ?>/" + posall_id);
                    $('#service_list').load("<?php echo site_url('pos/load_service_posale') ?>/" + posall_id);
                }
            });
        });
        
        $('#laundrybykilomodal').on('show.bs.modal', function (e) {
            var posall_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/pos/productemodal/',
                data: { posall_id: posall_id },
                success: function (data) {
                    if (data) {
                        $('#product_list_store').html(data);
                    } else {
                        $('#product_list_store').html('<tr><td colspan="3">No products available.</td></tr>');
                    }
                },
                error: function () {
                    $('#product_list_store').html('<tr><td colspan="3">Failed to fetch products.</td></tr>');
                }
            });
        });
        
     
$(document).on('click', '.addinal-product-add', function (e) {
    e.preventDefault();

    const $row = $(this).closest('tr'); // Get the current row

    const quantity = $row.find('.product_quantity_model').val();
    const productName = $row.find('.product_name_model').text();
    const productid = $row.find('.product_id_model').val();
    const storeid = $row.find('.product_storeid_model').val();
    const parentid = $row.find('.product_parent_model').val(); 
    const register = $row.find('.product_register_model').val();
    
     const serviceicon = $row.find('.product_serviceicon_model').val();
     const color = $row.find('.product_color_model').val();
     const typeone = $row.find('.product_typeone_model').val();
     const typeseconde = $row.find('.product_typeseconde_model').val();

    if (quantity > 0) {
        const productData = {
            name: productName,
            quantity: quantity,
            productid: productid,
            storeid: storeid,
            parentid: parentid,
            register: register,
            serviceicon:serviceicon,
            color:color,
            typeone:typeone,
            typeseconde:typeseconde
        };

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>/pos/productemodal_listAdd/',
            data: {
                products: [productData] 
            },
            success: function (response) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                
                $('#product_list_posale').load("<?php echo site_url('pos/load_product_model_posale') ?>/" + parentid);
                
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
            },
            error: function () {
                alert('Error while sending product data.');
            }
        });
    } else {
        alert('Please enter a quantity greater than 0.');
    }
});
        
        
        
        
        
        $("#paymentMethod").change(function() {

            var p_met = $(this).find('option:selected').val();

            if (p_met === '0') {
                $('.Paid').show();
                $('.ChequeNum').hide();
            } else if (p_met === '2') {
                $('.Paid').hide();
                $('.ChequeNum').show();
                $('.ReturnChange').hide();
            }

        });
        // ********************************* change calculations
        $('#Paid').on('keyup', function() {
            var change = -(parseFloat($('#total').text()) - parseFloat($(this).val()));
            if (change < 0) {
                $('#ReturnChange span').text(change.toFixed(<?= settings()->decimals; ?>));
                $('#ReturnChange span').addClass("text-danger");
                $('#ReturnChange span').removeClass("text-info");
            } else {
                $('#ReturnChange span').text(change.toFixed(<?= settings()->decimals; ?>));
                $('#ReturnChange span').removeClass("text-danger");
                $('#ReturnChange span').addClass("text-info");
            }
        });
        
        $("#customerSelect").change(function() {
            var id = $(this).find('option:selected').val();
            if (id === '0') {
                $('.Remise').val('<?= settings()->discount; ?>');
                $('#phoneClient').val('');
            } else {
                $.ajax({
                    url: "<?php echo site_url('pos/GetDiscount') ?>/" + id,
                    type: "POST",
                    success: function(data) {
                        var values = data.split('~');
                        if (values[2] > 0) {
                            $('#customerIDA').val(values[2]);
                        }
                        $('#customerName span').text(values[1]);
                        $('.Remise').val(values[0]);
                        $('#phoneClient').val(values[3]);
                        $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("error");
                    }
                });
            }
        });
    });
    
    $(".lundaryadd").click(function() {
       var laundryValue = $("#luandryinput").val('laundry');
    });    
    

    function add_prodpos(id) {
        var name1 = $('#idname-' + id).val();
        var priceprod = $('#price-' + id).val();
        $('.addPctlead-' + id).parent().children().removeClass('selectedProd');
        $('.addPctlead-' + id).addClass('selectedProd');

        $.ajax({
            url: "<?php echo site_url('pos/add_prodcart') ?>/",
            type: "POST",
            data: {
                idproduct: id,
                name: name1,
                priceprod: priceprod
            },
            success: function(data) {},
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });

    }

    function add_posale() {
        var color = $('#color').val();
        // var qtecart = $('#qtecartnpt').val();
        var qtecart = $('#qtecart').val(); //Rakesh
        var laundry = $('#luandryinput').val(); //Rakesh
        console.log(qtecart);
        $.ajax({
            url: "<?php echo site_url('pos/add_posale') ?>/",
            type: "POST",
            data: {
                color: color,
                qtecart: qtecart,
                laundry: laundry
            },
            success:async function(data) {
               $('#luandryinput').val('');
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                const response = await fetch("<?php echo site_url('pos/subtot') ?>");
                let subTotal = await response.text()
                if(!isNaN(subTotal) && subTotal > 0){
                    $('#print-btn').removeAttr('disabled');
                    $('#paid-btn').removeAttr('disabled');
                }else{
                    $('#print-btn').attr('disabled', 'disabled'); // Add 'disabled' attribute
                    $('#paid-btn').attr('disabled', 'disabled');
                }
                $('.selectype1').removeClass('selectedbtm');
                $('.selectype2').removeClass('selectedbtm2');
                $('.addPct').removeClass('selectedProd');
                
                // $('#qtecartnpt').val('1');
                $('#qtecart').val('1'); //Rakesh
                $('.sound2').get(0).play();


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    /*
    function add_service(id, posale_id) {
        var service_id = id;
        var posale_id = posale_id;
        $.ajax({
            url: "<?php echo site_url('pos/add_service') ?>/",
            type: "POST",
            data: {
                service_id: service_id,
                posale_id: posale_id
            },
            success: function(data) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#service_posale').load("<?php echo site_url('pos/load_service_posale') ?>/" + posale_id);
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    
    function delete_posale_service(parent_id,posale_id,delete_id) {
        $.ajax({
            url: "<?php echo site_url('pos/delete_service') ?>/",
            type: "POST",
            data: {
                parent_id:parent_id,
                posale_id: posale_id,
                delete_id: delete_id
            },
            success: async function(data) {
                const res = JSON.parse(data);
                if(res.status){
                    $('#service_list').load("<?php echo site_url('pos/load_service_posale') ?>/" + parent_id);
                    $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                    $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                }
               
 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    
    */
    
    function service_list(product_id, service_id,posale_id) {
      
        $.ajax({
            url: "<?php echo site_url('pos/service_list') ?>/",
            type: "POST",
            data: {
                posale_id:posale_id,
                service_id: service_id,
                product_id: product_id
            },
            success: function(data) {
               
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#service_list').load("<?php echo site_url('pos/load_service_posale') ?>/" + posale_id);
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    

    
    function delete_posale(id) {
        $.ajax({
            url: "<?php echo site_url('pos/delete') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: async function(data) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                // $('#service_posale').load("<?php echo site_url('pos/load_service_posale') ?>/" + data.parent_id);
                $('#service_list').load("<?php echo site_url('pos/load_service_posale') ?>/" + data.parent_id);
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                const response = await fetch("<?php echo site_url('pos/subtot') ?>");
                let subTotal = await response.text()
                if(!isNaN(subTotal) && subTotal > 0){
                    $('#print-btn').removeAttr('disabled');
                    $('#paid-btn').removeAttr('disabled');
                }else{
                    $('#print-btn').attr('disabled', 'disabled'); // Add 'disabled' attribute
                    $('#paid-btn').attr('disabled', 'disabled');
                }

                $('.sound1').get(0).play();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }

    function edit_posale(id, type) {
        $.ajax({
            url: "<?php echo site_url('pos/edit_posale') ?>/" + id + "/" + type,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");

                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });

    }

    function cancelPOS() {

        $('#customerSelect').val('0');
        $.ajax({
            url: "<?php echo site_url('pos/ResetPos') ?>/",
            type: "POST",
            success: function(data) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                $('#ItemsNum span, #ItemsNum2 span').text("0");
                $('.Remise').val('<?= settings()->discount; ?>');
                $('.TAX').val('<?= settings()->tax; ?>');
                $('.sound1').get(0).play();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }

    // Add a customer
    // function saveclt() {
    //     var num = $('#num').val();
    //     var phone = $('#phone').val();
    //     var lastname = $('#lastname').val();
    //     var firstname = $('#firstname').val();
    //     var adress = $('#adress').val();
    //     var discountclt = $('#discountclt').val();
    //     if (lastname != '' && firstname != '') {
    //         $.ajax({
    //             url: "<?php echo base_url('clients/add') ?>",
    //             type: "POST",
    //             dataType: "JSON",
    //             data: {
    //                 num: num,
    //                 phone: phone,
    //                 lastname: lastname,
    //                 firstname: firstname,
    //                 adress: adress,
    //                 discount: discountclt
    //             },
    //             success: function(data) {
    //                 $('#saveclt_result').html(data.msg);
    //                 $('#customerSelect').load("<?php echo site_url('clients/load_clients/') ?>" + data.insertid);
    //                 $('#clientModal').modal('toggle');
    //                 if (data.add == 'add') {
    //                     $('#num').val('');
    //                     $('#phone').val('');
    //                     $('#lastname').val('');
    //                     $('#firstname').val('');
    //                     $('#adress').val('');

    //                 } else {
    //                     $('.sounderr').get(0).play();
    //                 }
    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 alert("error");
    //             }
    //         });
    //     } else {
    //         $('.error_validateclt').html(' * <?= display('this_fieldis_required') ?>');
    //     }
    // }
    
    
    function saveclt() {
        $('.error').text('');
        var num = $('#num').val();
        var phone = $('#phone').val().trim();;
        var lastname = $('#lastname').val();
        var firstname = $('#firstname').val();
        var adress = $('#adress').val();
        var discountclt = $('#discountclt').val();
        const phoneRegex = /^\d{10}$/;
        if(!phoneRegex.test(phone) && phone.length!==10 ){
             $('#phoneError').text('Phone No. must be a valid 10-digit number');
             return;
        }
        if (lastname != '' && firstname != '' && phone!=='') {
            $.ajax({
                url: "<?php echo base_url('clients/add') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    num: num,
                    phone: phone,
                    lastname: lastname,
                    firstname: firstname,
                    adress: adress,
                    discount: discountclt
                },
                success: function(data) {
                    $('#saveclt_result').html(data.msg);
                    $('#customerSelect').load("<?php echo site_url('clients/load_clients/') ?>" + data.insertid, function() {
                        $('#customerSelect').val(data.insertid).change();
                    });
                    $('#clientModal').modal('toggle');
                    if (data.add == 'add') {
                        $('#num').val('');
                        $('#phone').val('');
                        $('#lastname').val('');
                        $('#firstname').val('');
                        $('#adress').val('');
                    } else {
                        $('.sounderr').get(0).play();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });
        } else {
            $('.error_validateclt').html(' * <?= display('this_fieldis_required') ?>');
        }
    }

    
    

    function PrintTicket() {
        $('.modal-body').removeAttr('id');
        window.print();
        $('.modal-body').attr('id', 'modal-body');
        window.close();
    }
    // function to calculate the total number
    
    // change 24/01/2024
    function testtotal_change() {
        var tot;
        if (($('.TAX').val().indexOf('%') == -1) && ($('.Remise').val().indexOf('%') == -1)) {
            tot = parseFloat($('#Subtot').text().replace(/ /g, '')) + parseFloat($('.TAX').val() ? $('.TAX').val() : 0);
            $('#taxValue').text('<?= settings()->currency; ?>');
            $('#RemiseValue').text('<?= settings()->currency; ?>');
            tot = tot - parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
            $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            $('#TotalModal').text('total ' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        } else if (($('.TAX').val().indexOf('%') != -1) && ($('.Remise').val().indexOf('%') == -1)) {
            // console.log($('.TAX').val())
            let taxValue = parseFloat($('.TAX').val());
            console.log(taxValue)
            tot = parseFloat($('#Subtot').text()) + percentage($('#Subtot').text(), taxValue);
            $('#taxValue').text(percentage($('#Subtot').text(), $('.TAX').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            $('#RemiseValue').text('<?= settings()->currency; ?>');
            tot = tot - parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
            $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            $('#TotalModal').text('total ' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        } else if (($('.TAX').val().indexOf('%') != -1) && ($('.Remise').val().indexOf('%') != -1)) {
            tot = parseFloat($('#Subtot').text()) + percentage($('#Subtot').text(), $('.TAX').val());
            $('#taxValue').text(percentage($('#Subtot').text(), $('.TAX').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            tot = tot - percentage($('#Subtot').text(), $('.Remise').val());
            $('#RemiseValue').text(percentage($('#Subtot').text(), $('.Remise').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            $('#TotalModal').text('Total' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        } else if (($('.TAX').val().indexOf('%') == -1) && ($('.Remise').val().indexOf('%') != -1)) {
            tot = parseFloat($('#Subtot').text()) + parseFloat($('.TAX').val() ? $('.TAX').val() : 0);
            tot = tot - percentage($('#Subtot').text(), $('.Remise').val());
            $('#taxValue').text('<?= settings()->currency; ?>');
            $('#RemiseValue').text(percentage($('#Subtot').text(), $('.Remise').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            $('#TotalModal').text('Total ' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        }
    }
    
     function total_change(packs = null) {
        pack = $('.pac_dis').is(':checked') ? 1 : 0;
        pack_val = parseFloat($('.pac_discount').val());
        var tot;
        if (($('.TAX').val().indexOf('%') == -1) && ($('.Remise').val().indexOf('%') == -1)) {
            console.log('sdsds')
            subtot = parseFloat($('#Subtot').text());
           
              newsubtot = subtot;
               if(pack == 1 && pack_val > 0 && subtot >= pack_val){
                   newsubtot = newsubtot - pack_val;
               }
              
               dis = parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
               if(newsubtot > 0 && dis > 0 && newsubtot > dis ){
                   newsubtot = parseFloat(newsubtot) - dis;
               }
              
               if(newsubtot > 0 && newsubtot >= $('.TAX').val()){
                   newsubtot = newsubtot - parseFloat($('.TAX').val());
               }
               
               $('#taxValue').text(newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
               $('#RemiseValue').text('<?= settings()->currency; ?>');
               
               
               $('#total').text(newsubtot.toFixed(<?= settings()->decimals; ?>));
               $('#Paid').val(newsubtot.toFixed(<?= settings()->decimals; ?>));
               $('#TotalModal').text('total ' + newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            
            // tot = parseFloat($('#Subtot').text().replace(/ /g, '')) + parseFloat($('.TAX').val() ? $('.TAX').val() : 0);
            // $('#taxValue').text('<?= settings()->currency; ?>');
            // $('#RemiseValue').text('<?= settings()->currency; ?>');
            // if(pack == 1){
            //     tot = tot - parseFloat($('.Remise').val() ? $('.Remise').val() : 0) - pack_val;
            // }else{
            //     tot = tot - parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
            // } 
            // tot = tot - parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
            // $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#TotalModal').text('total ' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        } else if (($('.TAX').val().indexOf('%') != -1) && ($('.Remise').val().indexOf('%') == -1)) {
           
            subtot = parseFloat($('#Subtot').text());
           
            newsubtot = subtot;
                if(pack == 1 && pack_val > 0 && subtot >= pack_val){
                    newsubtot = newsubtot - pack_val;
                }
                dis = parseFloat($('.Remise').val() ? $('.Remise').val() : 0);
                if(newsubtot > 0 && dis > 0 && newsubtot > dis ){
                    newsubtot = parseFloat(newsubtot) - dis;
                }
               
                if(newsubtot > 0){
                    newsubtot = newsubtot + percentage(parseFloat(newsubtot), $('.TAX').val());
                }
                
                $('#taxValue').text(newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
                $('#RemiseValue').text('<?= settings()->currency; ?>');
                
                
                $('#total').text(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#Paid').val(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#TotalModal').text('total ' + newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            
            
        } else if (($('.TAX').val().indexOf('%') != -1) && ($('.Remise').val().indexOf('%') != -1)) {

            subtot = parseFloat($('#Subtot').text());
           
            newsubtot = subtot;
                if(pack == 1 && pack_val > 0 && subtot >= pack_val){
                    newsubtot = newsubtot - pack_val;
                }
                dis = $('.Remise').val();
                if(newsubtot > 0 && dis){
                    newsubtot = newsubtot - percentage(parseFloat(newsubtot), dis);
                }
               
                if(newsubtot > 0){
                    newsubtot = newsubtot + percentage(parseFloat(newsubtot), $('.TAX').val());
                }
                
                $('#taxValue').text(newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
                $('#RemiseValue').text('<?= settings()->currency; ?>');
                
                
                $('#total').text(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#Paid').val(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#TotalModal').text('total ' + newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');


            // tot = parseFloat($('#Subtot').text()) + percentage($('#Subtot').text(), $('.TAX').val());
            // $('#taxValue').text(percentage($('#Subtot').text(), $('.TAX').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            // if(pack == 1){
            //     tot = tot - percentage($('#Subtot').text(), $('.Remise').val()) - pack_val;
            // }else{
            //     tot = tot - percentage($('#Subtot').text(), $('.Remise').val());
            // } 
            // $('#RemiseValue').text(percentage($('#Subtot').text(), $('.Remise').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            // $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#TotalModal').text('Total' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        } else if (($('.TAX').val().indexOf('%') == -1) && ($('.Remise').val().indexOf('%') != -1)) {

            subtot = parseFloat($('#Subtot').text());
           
            newsubtot = subtot;
                if(pack == 1 && pack_val > 0 && subtot >= pack_val){
                    newsubtot = newsubtot - pack_val;
                }
                dis = $('.Remise').val();
                if(newsubtot > 0 && dis){
                    newsubtot = newsubtot - percentage(parseFloat(newsubtot), dis);
                }
               
                if(newsubtot > 0 ){
                    newsubtot = newsubtot - parseFloat($('.TAX').val());
                }
                
                $('#taxValue').text(newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
                $('#RemiseValue').text('<?= settings()->currency; ?>');
                
                
                $('#total').text(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#Paid').val(newsubtot.toFixed(<?= settings()->decimals; ?>));
                $('#TotalModal').text('total ' + newsubtot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');

            // tot = parseFloat($('#Subtot').text()) + parseFloat($('.TAX').val() ? $('.TAX').val() : 0);
            // tot = tot - percentage($('#Subtot').text(), $('.Remise').val());
            // if(pack == 1){
            //     tot = tot = tot - percentage($('#Subtot').text(), $('.Remise').val()) - pack_val;
            // }else{
            //     tot = tot - percentage($('#Subtot').text(), $('.Remise').val());
            // } 
            // $('#taxValue').text('<?= settings()->currency; ?>');
            // $('#RemiseValue').text(percentage($('#Subtot').text(), $('.Remise').val()).toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
            // $('#total').text(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#Paid').val(tot.toFixed(<?= settings()->decimals; ?>));
            // $('#TotalModal').text('Total ' + tot.toFixed(<?= settings()->decimals; ?>) + ' <?= settings()->currency; ?>');
        }
    }
    
    function percentage(v1, v2){
        if (typeof v1 == 'string'){
            v1 = v1.replace("%", "");
        }
         v2 = v2.replace("%", "");
        return (parseFloat(v1) * parseFloat(v2))/100;
    }

    function saleBtn(type, printcheck=null) {
        var clientID = $('#customerSelect').find('option:selected').val();
        var clientName = $('#customerName span').text();
        var phoneClient = $('#phoneClient').val();
        var delivery_date = $('#delivery_date').val();
        var pickup_date = $('#pickup_date').val();
         var invoice_date = $('#invoice_date').val();
        var store_pickup_delivery = $('input[name="store_delivery"]:checked').val();
        var Tax = $('.TAX').val();
        var Discount = $('.Remise').val();
        var Subtotal = $('#Subtot').text();
        var Total = $('#total').text();
        var createdBy = '<?= $this->user_name; ?>';
        var totalItems = $('#ItemsNum span').text();
        if(pickup_date !== '' && delivery_date !== ''){
        if(printcheck == 1){
            var Paid = 0;
        }else{
            var Paid = $('#Paid').val();
        }
        var paidMethod = $('#paymentMethod').find('option:selected').val();
        var Status = 0;
        switch (paidMethod) {
            case '1':
                paidMethod += '~' + $('#CreditCardNum').val() + '~' + $('#CreditCardHold').val();
                break;
            case '2':
                paidMethod += '~' + $('#ChequeNum').val()
                break;
            case '0':
                var change = parseFloat(Total) - parseFloat(Paid);
                if (change == parseFloat(Total)) Status = 1;
                else if (change > 0) Status = 2;
                else if (change <= 0) Status = 0;
        }
        var taxamount = $('.TAX').val().indexOf('%') != -1 ? parseFloat($('#taxValue').text()) : $('.TAX').val();
        var discountamount = $('.Remise').val().indexOf('%') != -1 ? parseFloat($('#RemiseValue').text()) : $('.Remise').val();

        $.ajax({
            url: "<?php echo site_url('pos/AddNewSale') ?>/" + type,
            type: "POST",
            data: {
                client_id: clientID,
                phoneclient:phoneClient,
                delivery_date:delivery_date,
                pickup_date:pickup_date,
                invoice_date:invoice_date,
                clientname: clientName,
                discountamount: discountamount,
                taxamount: taxamount,
                store_pickup_delivery:store_pickup_delivery,
                tax: Tax,
                discount: Discount,
                subtotal: Subtotal,
                total: Total,
                created_by: createdBy,
                totalitems: totalItems,
                paid: Paid,
                status: Status,
                paidmethod: paidMethod
            },
            dataType:"json",
            success:async function(data) {
               
                $('.printSection').html(data.html);
                $('.print_all_barcodes').attr("href","https://laundroklean.meshink.xyz/software/pos/print_all_barcodes/"+data.sale_id);
                
                $('.print_all_barcodes2').attr("href","https://laundroklean.meshink.xyz/software/pos/print_all_barcodes2/"+data.sale_id);
                
                $('.saleid_data').val(data.sale_id);

                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#number_sales').load("<?php echo site_url('pos/number_sales') ?>");
                $('#total_sales').load("<?php echo site_url('pos/total_sales') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                const response = await fetch("<?php echo site_url('pos/subtot') ?>");
                let subTotal = await response.text()
                if(!isNaN(subTotal) && subTotal > 0){
                    $('#print-btn').removeAttr('disabled');
                    $('#paid-btn').removeAttr('disabled');
                }else{
                    $('#print-btn').attr('disabled', 'disabled'); // Add 'disabled' attribute
                    $('#paid-btn').attr('disabled', 'disabled');
                }
                $('#AddSale').modal('hide');
                $('#ticket').modal('show');
                $('.check-print').val(printcheck);
                $('#ReturnChange span').text('0');
                $('#Paid').val('0');
                $('.sound1').get(0).play();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
            
        }else{
            //alert('Pickup date and delivery are required');
            $('#deliverydate').modal('show');
        }
    }

    function CloseRegister() {
        $.ajax({
            url: "<?php echo site_url('pos/CloseRegister') ?>/",
            type: "POST",
            success: function(data) {
                $('#closeregsection').html(data);
                $('#CloseRegister').modal('show');
                setTimeout(function() {
                    $('#countedcash').focus()
                }, 1000);
                $('#countedcash').on('keyup', function() {
                    var change = -(parseFloat($('#expectedcash').text()) - parseFloat($(this).val()));
                    var difftot = change + parseFloat($('#diffcheque').text());
                    var total = parseFloat($('#countedcheque').val()) + parseFloat($('#countedcash').val());
                    $('#countedtotal').text(total.toFixed(<?= settings()->decimals; ?>));
                    $('#difftotal').text(difftot.toFixed(<?= settings()->decimals; ?>))
                    if (change < 0) {
                        $('#diffcash').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcash').addClass("red");
                        $('#diffcash').removeClass("light-blue");
                    } else {
                        $('#diffcash').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcash').removeClass("red");
                        $('#diffcash').addClass("light-blue");
                    }
                });

                $('#countedcc').on('keyup', function() {
                    var change = -(parseFloat($('#expectedcc').text()) - parseFloat($(this).val()));
                    var difftot = parseFloat($('#diffcash').text()) + parseFloat($('#diffcheque').text());
                    var total = parseFloat($('#countedcheque').val()) + parseFloat($('#countedcash').val());
                    $('#countedtotal').text(total.toFixed(<?= settings()->decimals; ?>));
                    $('#difftotal').text(difftot.toFixed(<?= settings()->decimals; ?>))
                    if (change < 0) {
                        $('#diffcc').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcc').addClass("red");
                        $('#diffcc').removeClass("light-blue");
                    } else {
                        $('#diffcc').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcc').removeClass("red");
                        $('#diffcc').addClass("light-blue");
                    }
                });

                $('#countedcheque').on('keyup', function() {
                    var change = -(parseFloat($('#expectedcheque').text()) - parseFloat($(this).val()));
                    var difftot = change + parseFloat($('#diffcash').text());
                    var total = parseFloat($('#countedcheque').val()) + parseFloat($('#countedcash').val());
                    $('#countedtotal').text(total.toFixed(<?= settings()->decimals; ?>));
                    $('#difftotal').text(difftot.toFixed(<?= settings()->decimals; ?>))
                    if (change < 0) {
                        $('#diffcheque').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcheque').addClass("red");
                        $('#diffcheque').removeClass("light-blue");
                    } else {
                        $('#diffcheque').text(change.toFixed(<?= settings()->decimals; ?>));
                        $('#diffcheque').removeClass("red");
                        $('#diffcheque').addClass("light-blue");
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }

    function SubmitRegister() {
        var expectedcash = $('#expectedcash').text();
        var countedcash = $('#countedcash').val();
        var expectedcheque = $('#expectedcheque').text();
        var countedcheque = $('#countedcheque').val();
        var RegisterNote = $('#RegisterNote').val();

        $.ajax({
            url: "<?php echo site_url('pos/SubmitRegister') ?>/",
            type: "POST",
            data: {
                expectedcash: expectedcash,
                countedcash: countedcash,
                expectedcheque: expectedcheque,
                countedcheque: countedcheque,
                RegisterNote: RegisterNote
            },
            success: function(data) {
                window.location.href = "<?php echo site_url() ?>";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });

    }

    function SaleSearch() {
        var saleid = $('#salesearch').val();
        if(saleid.length==10){
            $.ajax({
            url: "<?php echo site_url('pos/salesearchbyphone') ?>/",
            type: "POST",
            data: {
                saleid: saleid
            },
            success: function(data) {
                // console.log(data);
                if (data != '') {
                    $('#sectionviewsale').html(data);
                    $('#SaleView').modal('show');
                    $('#errorsale_searsh').html('');
                    // $('#msgdelivery').html('');
                } else {
                    $('#errorsale_searsh').html('<?= display('invoice_does_not_exist') ?>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
            });
        }else{
            $.ajax({
            url: "<?php echo site_url('pos/salesearch') ?>/",
            type: "POST",
            data: {
                saleid: saleid
            },
            success: function(data) {
                if (data != '') {
                    $('#sectionviewsale').html(data);
                    $('#SaleView').modal('show');
                    $('#errorsale_searsh').html('');
                    $('#msgdelivery').html('');
                } else {
                    $('#errorsale_searsh').html('<?= display('invoice_does_not_exist') ?>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
            });
        }
        
    }

    function viewReciet(id){
        $('#salesearch').val(id);
        $('#sectionviewsale').html(' ');
        $('#SaleView').modal('hide');
        SaleSearch();
    }

    function productSearch() {
        var productid = $('#productsearch').val();
        $.ajax({
            url: "<?php echo site_url('pos/productSearch') ?>/",
            type: "POST",
            data: {
                productid: productid
            },
            success: function(data) {
                if (data != '') {
                    $('#productList').remove();
                    $(data).insertAfter('.productsearch');
                    $('#errorproduct_search').html('');
                } else {
                    $('#errorproduct_search').html('<?= display('product_does_not_exist') ?>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }

    function delivery(id, type) {
        var notesale = $('#notesale').val();
        var total = $('#deliverytotal').val();
        var paid = $('#deliverypaid').val();
        var rest = $('#rest').val();
        var paidMethod = $('#paymdata').find('option:selected').val();
        $.ajax({
            url: "<?php echo site_url('pos/delivery') ?>/" + id + "/" + type,
            type: "POST",
            dataType: "JSON",
            data: {
                notesale: notesale,
                rest: rest,
                total: total,
                paid: paid,
                paidMethod:paidMethod
            },
            success: function(data) {
                $('#msgdelivery').html(data.msg);
                $('.paid_after').html(data.paid_after);
                $('.rest_after').html(data.rest_after);
                $('#notesale').val(data.notesale_after);
                $('#deliverybtm').hide();
                $('#deliverypay').hide();
                $('.lbl-rest').hide();
                $('#rest').hide();
                var  html = "Hey "+data.clientname+", Your order has been picked up from "+data.store_name+" Please let us know if you have any feedback.  "+data.store_name;
                    var action_url = "https://wa.me/91"+data.phone+"?text="+html;
                    window.open(action_url, '_blank');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("errorddd");
            }
        });
    }
    
    function sendsms(id) {
        $.ajax({
            url: "<?php echo site_url('pos/smsreadycollection') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            data: {
                idsale: id,
            },
            success: function(data) {
                $('#smslabel').html(data.msgtesra);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("errorddd");
            }
        });

    }
</script>

<!-- Modal -->
<!-- ModaL client -->
<div class="modal fade modal-left" id="clientModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 20px;"> <?= display('add_new_customer') ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2">
                <input type="hidden" name="idclt" id="idclt" value="">

                <div class="form-group position-relative error-l-50">
                    <label> <?= display('num') ?></label>
                    <?PHP
                    $invID = str_pad($this->client->last_id() + 1, 3, '0', STR_PAD_LEFT);
                    $numclt = 'CL' . $invID;
                    ?>
                    <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?= $numclt ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label> <?= display('first_name') ?> <span class="text-danger error_lastname">*</span></label>
                    <input type="text" class="form-control" placeholder="" name="lastname" id="lastname" autocomplete="off">
                </div>
                <div class="form-group">
                    <label> <?= display('last_name') ?> <span class="text-danger error_firstname">*</span></label>
                    <input type="text" class="form-control" placeholder="" name="firstname" id="firstname" autocomplete="off">
                </div>
                <div class="form-group">
                    <label> <?= display('phone') ?><span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="" name="phone" id="phone" autocomplete="off">
                    <span class="text-danger error" id="phoneError"></span>
                </div>
                <div class="form-group">
                    <label> <?= display('adress') ?></label>
                    <input type="text" class="form-control" placeholder="" name="adress" id="adress">
                </div>
                <div class="form-group">
                    <label> <?= display('discounts') . ' (' . settings()->currency ?>)</label>
                    <input type="text" class="form-control" placeholder="" name="discountclt" id="discountclt">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= display('close') ?></button>
                <button type="button" class="btn btn-primary" id="saveclt" onclick="saveclt()"><?= display('save') ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="AddSale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= display('add_an_invoice') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form>
                <div class="modal-body mt-2">
                    <div class="form-groups">
                        <h4 style="margin-bottom:10px;font-weight:600;font-size:17px;line-height:22px;" id="customerName"><?= display('client') ?> :  <span style="font-weight:500; "> <?= display('default_client') ?></span></h4>
                    </div>
                    <div class="form-groups">
                        <h3 style="margin-bottom:10px;font-weight:600;font-size:17px;line-height:22px;" id="ItemsNum2"><span></span> <?= display('number_of_services') ?> </h3>
                    </div>
                    <div class="form-group">
                        <h2 style="margin-bottom:0px;font-weight:600;font-size:17px;line-height:22px;" id="TotalModal"></h2>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod"> <?= display('payementtype') ?></label>
                        <select class="js-select-options form-control" id="paymentMethod">
                            <option value="01">select payment method</option>
                            <option value="0"><?= display('cash') ?></option>
                            <option value="2"><?= display('cheque') ?></option>
                            <option value="3">Card</option>
                            <option value="4">UPI</option>
                        </select>
                    </div>
                    <div class="form-group Paid">
                        <label for="Paid"><?= display('paid') ?></label>
                        <input type="text" value="0" name="paid" class="form-control " id="Paid" placeholder="<?= display('paid') ?>">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group ChequeNum">
                        <label for="ChequeNum"><?= display('check_number') ?></label>
                        <input type="text" name="chequenum" class="form-control" id="ChequeNum" placeholder="<?= display('check_number') ?>">
                    </div>
                    <div class="form-group ReturnChange">
                        <h3 id="ReturnChange"><?= display('rest') ?> <span>0</span> <?= settings()->currency; ?></h3>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= display('close') ?></button>
                    <button type="button" class="btn btn-primary" onclick="saleBtn(1,0)"><?= display('paid') ?></button>
                </div>
                <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- CloseRegister -->
<div class="modal fade" id="CloseRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= display('close_the_sale') ?></h4>
            </div>
            <div class="modal-body">
                <div id="closeregsection">
                    <!-- close register detail goes here -->
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" onclick="SubmitRegister()" class="btn btn-sm btn-danger ml-3 d-none d-md-inline-block w-25 text-center"><?= display('close_the_sale') ?></a>
            </div>
        </div>
    </div>
</div>


  <!--deleivery date alert-->
  
<div class="modal fade" id="deliverydate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Close</h4>
            </div>
            <div class="modal-body">
                <div id="text-center" style="text-align: center;margin-top: 23px;">
                    <h6>Pickup date and delivery are required</h6>
                </div>
            </div>
            <div class="modal-footer">
                <!--<a href="javascript:void(0)" class="btn btn-sm btn-danger ml-3 d-none d-md-inline-block w-25 text-center">Close</a>-->
                <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close" style="font-size=20px;">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="servicemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <?= display('additional_services') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation">
                <div class="modal-body">
                    <div class="fetchservice">

                    </div>
                    
                    <div id="service_posale" class="form-group">
                        <table class="table">
                			<thead>
                				<tr>
                					<th scope="col">#</th>
                					<th scope="col"><?=display('service')?></th>
                					<th scope="col"> <?=display('quantity') ?></th>
                					<th scope="col"> <?= display('price') . ' ' . settings()->currency ?></th>
                					<th scope="col"><?= display('total') . ' ' . settings()->currency ?></th>
                					<th scope="col"></th>
                				</tr>
                			</thead>
                			<tbody id="service_list">
                			</tbody>
            			 </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('hide') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Laundry By Kilo Modal -->
<div class="modal" id="laundrybykilomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-sm-6 col-12 mt-2">
              <input class="form-control product-search" placeholder="search product">
             </div>
            <form class="needs-validation">
                <div class="modal-body">
                    <div id="product_posale" class="form-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="product_list">
                            </tbody>
                            
                             <tbody id="product_list_store">
                            </tbody>
                            
                        </table>
                        
                        <br>
                        <div>
                            <table class="table">
                                <tbody id="product_list_posale">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary closesearchpro" data-dismiss="modal"><?= display('hide') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--Add Notes-->
<div class="modal" id="noteslomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight33" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Notes</h5>
                <button type="button" class="close closesearchpross" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h6 class="add_note_message"><h6>
            <div class="col-6 mt-2">
             </div>
            <form class="needs-validation" action="">
                <div class="modal-body">
                    <input type="text" class="product_notes_id" value="" hidden>
                    <textarea class="form-control product_notes" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary addnotes">Save</button>
                    <button type="button" class="btn btn-outline-primary closesearchpross" data-dismiss="modal"><?= display('hide') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Add Notes-->



<!--image models-->

<div class="modal" id="imagesmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight353" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Image</h5>
                <button type="button" class="close closesearchpross" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h6 class="add_image_message"><h6>
            <div class="col-6 mt-2">
             </div>
            <form class="needs-validation" action="">
                <div class="modal-body">
                    <input type="text" class="product_images_id" value="" hidden>
                    <input type="file" class="product_images_data form-control" accept=".png, .jpg, .jpeg">
                </div>
                <div class="image-pro"><img src="" alt="" width="142"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary addimages">Save</button>
                    <button type="button" class="btn btn-outline-primary closesearchpross" data-dismiss="modal"><?= display('hide') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--end image model-->


<!-- Modal ticket -->
<div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document" id="ticketModal">
        <div class="modal-content">
            <div class="modal-header billpri">
                <h5 class="modal-title" id="ticket"><?= display('receipt') ?> </h5>
                <button type="button" class="close pagereload" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body" id="modal-body" style="margin-top: 0px; padding: 0px">
                <div id="printSection" class="printSection" style="padding-bottom:0px; padding-top: 0px; margin-top: 0px; margin-bottom: 0px;padding:10px;padding-right:20px;">
                    <!-- Ticket goes here -->
                    <center>
                        <h1 style="color:#34495E"><?= display('empty') ?></h1>
                    </center>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="check-print"/>
                
                <button type="button" class="btn btn-sm btn-danger pagereload hiddenpr" style="margin-bottom:0;" data-dismiss="modal"><?= display('close') ?></button>
                <button type="button" class="btn btn-sm btn-success hiddenpr" style="margin-bottom:0;" onclick="PrintTicket()"><?= display('print') ?></button>
                <!--<button type="button" class="btn btn-sm btn-success hiddenpr" data-toggle="modal" data-target="#barcodeprint">Print Barcode</button>-->
                
                <a href="" class="btn btn-warning print_all_barcodes" target="_blank">Tag</a>
                
                <a href="" class="btn btn-warning print_all_barcodes2" target="_blank">Tag2</a>
                
                <input class="saleid_data" value="" hidden>
                
                <button type="button" onclick="sendnotification()" class="btn btn-success"><i style="font-size:17px;" class="fab fa-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>


<!--loading model-->

<button type="button" class="loadingpage" data-toggle="modal" data-target="#exampleModal" hidden></button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
         <div id="SqCo">
          <p>
            Please wait
            <span class="point one">.</span>
            <span class="point two">.</span>
            <span class="point three">.</span>
          </p>
          <span class="bloc one"></span>
          <span class="bloc two"></span>
          <span class="bloc three"></span>
          <span class="bloc four"></span>
          <span class="bloc five"></span>
        </div>
          
          
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<!--loading model end-->



<div class="modal fade" id="barcodeprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document" id="ticketModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeprint"><?= display('receipt') ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body" id="modal-body" style="margin-top: 0px;padding: 5px; padding-bottom: 0px">
                <div id="printSection" class="printSection" style="padding-bottom:0px; padding-top: 0px; margin-top: 0px; margin-bottom: 0px">
                    <!-- Ticket goes here -->
                    <center>
                        <h1 style="color:#34495E"><?= display('empty') ?></h1>
                    </center>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="check-print"/>
                <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal"><?= display('close') ?></button>

               
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-left" id="SaleView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document" id="" style="max-width:500px;">
        <div class="modal-content">
            <div class="modal-header">

                <div class="modal-body" id="" style="margin-top: 0px;padding: 5px; padding-bottom: 0px">
                    <span id="msgdelivery"></span>
                    <span id="smslabel"></span>
                    <div id="sectionviewsale" style="padding-bottom:0px; padding-top: 0px; margin-top: 0px; margin-bottom: 0px">
                        <!-- Ticket goes here -->
                        <center>
                            <h1 style="color:#34495E"><?= display('empty') ?></h1>
                        </center>
                        <input type="text" readonly>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $(document).on('click', '.decrement', function() {
                var productId = $(this).data('id'); 
                var quantityInput = $('#product_quantity_' + productId); 
                var currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 0) {
                    quantityInput.val(currentQuantity - 1);
                }
            });
        
            $(document).on('click', '.increment', function() {
                var productId = $(this).data('id'); 
                var quantityInput = $('#product_quantity_' + productId); 
                var currentQuantity = parseInt(quantityInput.val());
                quantityInput.val(currentQuantity + 1);
            });
        });
    </script>
    
    
    <script>
    //   $(document).on('click', '.pagereload', function () {
    //     window.location.reload()
    //   });
    
    $(document).on('click', '.pagereload', function () {
     $('.waitloadpage').hide(); 
        
         $('.loadingpage').click();
    let actualReload = function() {
        window.location.reload(); 
    };

    let timeoutId; 

        timeoutId = setTimeout(actualReload, 2000);
    
        $(window).on('load', function() {
            if (typeof timeoutId !== 'undefined') {
                clearTimeout(timeoutId); 
            }
            $('.waitloadpage').hide(); 
        });
    });
   

    
    </script>
    
    
    
    
   
    

    <script>
      $(document).on('keyup', '.product-search', function () {
            var parent = $('.product_parent_model').val();
            var register = $('.product_register_model').val();
            var searchTerm = $(this).val();
            
            var serviceicon = $('.product_serviceicon_model').val();
            var color = $('.product_color_model').val();
            var typeone = $('.product_type_one_model').val();
            var typeseconde = $('.product_type_second_model').val();

            $.ajax({
                url: "<?php echo site_url('pos/productSearchbymodel'); ?>",
                type: 'POST',
                data: {
                    term: searchTerm,
                    parent: parent,
                    register: register,
                    serviceicon: serviceicon,
                    color: color,
                    typeone: typeone,
                    typeseconde: typeseconde,
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    if (response.status && response.products.length > 0) {
                        var productHTML = '';
                        $.each(response.products, function (index, product) {
                            productHTML += `
                                <tr>
                                    <td style="padding:.5rem">${index + 1}</td>
                                    <td style="padding:.5rem" class="product_name_model">${product.name}</td>
                                    <td style="padding-left:0rem; padding-right:0;">
                                        <button type="button" style="padding:0 3px!important;border:0;" class="btn btn-xs text-danger decrement" data-id="${product.id}"><i class="fa fa-minus"></i></button>
                                        <input type="number" id="product_quantity_${product.id}" class="form-control product_quantity_model" min="0" value="0" style="height:30px;padding:0 5px; width: 40px; display: inline-block; text-align: center;">
                                        <button type="button" style="padding:0 3px!important;border:0;" class="btn btn-xs text-success increment" data-id="${product.id}"><i class="fa fa-plus"></i></button>
                                        <input type="hidden" class="form-control product_id_model" value="${product.id}">
                                        <input type="hidden" class="form-control product_storeid_model" value="${product.store_id}">
                                        <input type="hidden" class="form-control product_parent_model" value="${product.parent}">
                                        <input type="hidden" class="form-control product_register_model" value="${product.register}">
                                        
                                        <input type="hidden" class="form-control product_serviceicon_model" value="${product.serviceicon}">
                                        <input type="hidden" class="form-control product_color_model" value="${product.color}">
                                        <input type="hidden" class="form-control product_typeone_model" value="${product.typeone}">
                                        <input type="hidden" class="form-control product_typeseconde_model" value="${product.typeseconde}">

                                        
                                    </td>
                                     <td style="padding:.5rem"><button type="button" class="btn btn-xs btn-primary addinal-product-add" data-id="${product.id}">Add</button></td>
                                </tr>`;
                        });
                        $('#product_list').html(productHTML);
                    } else {
                        $('#product_list').html('<tr><td colspan="3">No products found.</td></tr>');
                    }
                },
                error: function () {
                    $('#product_list').html('<tr><td colspan="3">An error occurred while fetching products.</td></tr>');
                }
            });
        });
        
        
        
    function delete_posaledata(id) {
        $.ajax({
            url: "<?php echo site_url('pos/delete') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: async function(data) {
                $('#cartview').load("<?php echo site_url('pos/load_posales') ?>");
                $('#product_list_posale').load("<?php echo site_url('pos/load_product_model_posale') ?>/" + data.parent_id);
                $('#ItemsNum span, #ItemsNum2 span').load("<?php echo site_url('pos/totiems') ?>");
                $('#Subtot').load("<?php echo site_url('pos/subtot') ?>", null, total_change);
                const response = await fetch("<?php echo site_url('pos/subtot') ?>");
                let subTotal = await response.text()
                if(!isNaN(subTotal) && subTotal > 0){
                    $('#print-btn').removeAttr('disabled');
                    $('#paid-btn').removeAttr('disabled');
                }else{
                    $('#print-btn').attr('disabled', 'disabled');
                    $('#paid-btn').attr('disabled', 'disabled');
                }
                $('.sound1').get(0).play();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    
    
   $(document).on('click', '.product_notesdata', function () {
       let dataId = $(this).data('id');
       let hiddenInput = $('.product_notes_id'); 
       hiddenInput.val(dataId); 
       $.ajax({
            url: "<?php echo site_url('pos/product_notes_gets'); ?>",
            type: 'POST',
            data: {
                id: dataId,
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
               $('.product_notes').val(response.data.notes);
            },
        });
    });
    
    
    $(document).on('click', '.addnotes', function () {
        var id = $('.product_notes_id').val();
        var notes = $('.product_notes').val();
        $.ajax({
            url: "<?php echo site_url('pos/add_notes_route'); ?>",
            type: 'POST',
            data: {
                id: id,
                notes: notes,
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
            if (response.status) {
                $('.product_notes').val('');
                $('.add_note_message').html('<div class="alert alert-success">' + response.message + '</div>');
            } else {
                $('.add_note_message').html('<div class="alert alert-danger">' + response.message + '</div>');
            } 
            setTimeout(function() {
                $('.add_note_message').empty(); 
                $('.closesearchpross').click();
            }, 2000);
            },
        });
     });
     
      $(document).on('click', '.closesearchpross', function () {
            $('.product_notes').val('');
      });      
      
      
    
      $(document).on('click', '.product_imagesdata', function () {
        let dataId = $(this).data('id');
        let hiddenInput = $('.product_images_id'); 
        hiddenInput.val(dataId); 
        
        $.ajax({
            url: "<?php echo site_url('pos/product_images_gets'); ?>",
            type: 'POST',
            data: { id: dataId },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if(response.status) { 
                    let imageContainer = $('.image-pro');
                    imageContainer.html(''); // Clear previous images
    
                    try {
                        let images = JSON.parse(response.data.product_image); // Decode JSON string
                        if (Array.isArray(images)) {
                            images.forEach(imageUrl => {
                                imageContainer.append('<img src="' + imageUrl + '" alt="Product Image" width="142" style="margin:5px;">');
                            });
                        } else {
                           // imageContainer.html('<div class="alert alert-danger">Invalid image format</div>');
                        }
                    } catch (e) {
                        imageContainer.html('<div class="alert alert-danger">Image format error</div>');
                    }
                } else {
                    $('.image-pro').html('<div class="alert alert-danger">Image not found</div>'); 
                }
            },
        });
    });

    
    $(document).on('click', '.addimages', function () {
        var id = $('.product_images_id').val();
        var files = $('.product_images_data')[0].files; 
        var formData = new FormData();
        formData.append('id', id);
    
        for (var i = 0; i < files.length; i++) {
            formData.append('logo[]', files[i]); 
        }
    
            $.ajax({
                url: "<?php echo site_url('pos/add_image_route'); ?>",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        $('.product_images_data').val('');
                        $('.add_image_message').html('<div class="alert alert-success">' + response.message + '</div>');
                    } else {
                        $('.add_image_message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                    setTimeout(function () {
                        $('.add_image_message').empty();
                        $('.closesearchpross').click();
                    }, 3000);
                },
            });
        });  
      
      
      
      
    
    
 function sendnotification() {
    var id = $(".saleid_data").val();
    $.ajax({
        url: "<?php echo site_url('sales/send_notification')?>",
        type: "POST",
        data: { id: id },
        success: function(data) {
            try {
                var result = JSON.parse(data);
                console.log(result);
                if (result.status == 1) {

                    // Build the line items
                    let itemDetails = "Item Details:\n\n";
                    if (Array.isArray(result.items) && result.items.length > 0) {
                        result.items.forEach(function(item, index) {
                            itemDetails += `${index + 1}: ${item.name}`;
                            // If you want service_name or type, etc.
                            if (item.service_name) {
                                itemDetails += ` (${item.service_name})`;
                            }
                            itemDetails += ` = ${item.qt.toFixed(2)} X ${item.price.toFixed(2)} = ${item.subtotal.toFixed(2)}\n`;
                        });
                    } else {
                        itemDetails += "No item data found.\n";
                    }

                    // Build final message
                    let message = `Dear ${result.clientname},

                    Thank you for placing the order.
                    Your Invoice Number: ${result.sales_id} with amount of ${result.total_amount}.
                    
                    ${itemDetails}
                    Total Amount: ${result.subtotal_amount}
                    Discount Amount: ${result.discountamount}
                    Tax: ${result.tax}
                    Bill: ${result.total_amount}
                    
                    Thanks`;

                    // Construct WhatsApp URL
                    let action_url = "https://wa.me/91" + result.phone + "?text=" + encodeURIComponent(message);
                    window.open(action_url, '_blank');
                } else {
                    alert(result.message);
                }
            } catch (e) {
                alert("Invalid JSON response: " + data);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + " - " + errorThrown);
        }
    });
}
    
    
    
    
    
      
    </script>


    <script src="<?= base_url(); ?>assets/js/bootstrap-input-spinner.js"></script>
    <script>
        $("input[type='number']").inputSpinner();
    </script>
    
    
