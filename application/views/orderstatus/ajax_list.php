
<style>
    /*.col.p-0{*/
    /*    width:200px;*/
    /*}*/
    
    /*.row.orderstatus .card .card-body{*/
    /*    width:200px;*/
    /*}*/
    h5.pb-3{
        width:230px;
        border: 1px solid #a6a6a6;
        margin:4px!important;
        margin: 13px!important;
        margin-right:0!important;
    }
    .btn-outline-primary:not(:disabled):not(.disabled).active, .btn-outline-primary:not(:disabled):not(.disabled):active, .show>.btn-outline-primary.dropdown-toggle{
        background:transparent;
        border-color:transparent;
        color:#007bff;
    }
    
    .card.portlet.header{
        width:230px!important;
    }
    
    .row.orderstatus .card .card-body{
        width:230px!important;
    }
    
    
</style>



<div class="col">
    <div class="inner_areaa border mx-2 px-2" style="border-color:#666; overflow:auto; height:100vh;">
    <div class="row" style="flex-wrap:nowrap;">


<div class="col p-0" style="cursor: pointer;">
    <H5 class="m-0 pt-3 pb-3" style="color: #0089ff; font-size: 17px; margin-top: 1rem;"><b>Order Placed</b></H5>
    
    <div class="column flex">
        <?php foreach($orders_placed as $orderplaced) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet header" style="border:1px solid #0089ff;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$orderplaced->order_no?>')" style="float: left;text-align:left; font-size:13px;">-->
                            <!--    <?=$orderplaced->clientname ?></h6>-->
                            
                            <h6 onclick="showTicket1('<?= $orderplaced->order_no ?>', '<?= htmlspecialchars($orderplaced->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $orderplaced->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$orderplaced->clientname?>
                            </h6> 
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$orderplaced->invoice_id ?></h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            
                            <p class="card-text" style="float:left;font-size:13px; text-align:left;">Delivery Date: <?=$orderplaced->delivery_date ?></p>

                            <!--<h6 style="float: left;"></h6>-->
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$orderplaced->qt?>)</p>
                            

                            <img style="float:right;" src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px;" onchange="change_order_status(<?=$orderplaced->id ?>,this)"
                            class="w-100 btn btn-outline-primary" name="order_status">
                            <option value="0" selected>Order Placed</option>
                            <option value="1">Picked up by Delivery Van</option>
                            <option value="2">Delivered at Plant</option>
                            <option value="3">Recieved at Plant</option>
                            <option value="4">Sorting and Processing</option>
                            <option value="5">Packing and sticker print</option>
                            <option value="6">Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>
                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<div class="col p-0" style="cursor: pointer;">
    <H5 class="m-0 pt-3 pb-3" style="color: orange; font-size: 17px; margin-top: 1rem;"><b>Picked up by Delivery Van</b></H5>
    <div class="column flex">
        <?php foreach($Picked_up_by_delivery_van as $Picked_up_by_delivery_vandata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$Picked_up_by_delivery_vandata->order_no?>')" style="float: left; text-align:left; font-size:13px;">-->
                            <!--    <?=$Picked_up_by_delivery_vandata->clientname?></h6>-->
                            
                            <h6 onclick="showTicket1('<?= $Picked_up_by_delivery_vandata->order_no ?>', '<?= htmlspecialchars($Picked_up_by_delivery_vandata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Picked_up_by_delivery_vandata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Picked_up_by_delivery_vandata->clientname?>
                            </h6>
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Picked_up_by_delivery_vandata->invoice_id?></h6>
                        </div>
                    </div>
                    
                
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left;font-size:13px; text-align:left;">Delivery Date: <?=$Picked_up_by_delivery_vandata->delivery_date?></p>
                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$Picked_up_by_delivery_vandata->qt?>)</p>
                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                        </div>
                    </div>
                    
                    <?php if ($Picked_up_by_delivery_vandata->image): ?>  <div class="row">
                            <div class="col" style="padding-left:3px;">
                                <a href="<?= htmlspecialchars($Picked_up_by_delivery_vandata->image) ?>">
                                  <img style="float:right;height:60px;" src="<?=$Picked_up_by_delivery_vandata->image?>" alt="Icon 1" /> 
                                </a>
                            </div>
                            <div class="col" style="padding-left:3px;">
                                <img style="float:right;height:60px;" src="<?=$Picked_up_by_delivery_vandata->signature?>" alt="Icon 2" /> </div>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col">
                            <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$Picked_up_by_delivery_vandata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" selected>Picked up by Delivery Van</option>
                            <option value="2">Delivered at Plant</option>
                            <option value="3">Recieved at Plant</option>
                            <option value="4">Sorting and Processing</option>
                            <option value="5">Packing and Sticker Print</option>
                            <option value="6">Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>
                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size: 17px; margin-top: 1rem;"><b>Delivered at Plant</b></h5>
    <div class="column flex">
        <?php  foreach($delivered_at_plant as $delivered_at_plantdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$delivered_at_plantdata->order_no?>')" style="float: left; font-size:13px; text-align:left;">-->
                            <!--    <?=$delivered_at_plantdata->clientname?></h6>-->
                            
                             <h6 onclick="showTicket1('<?= $delivered_at_plantdata->order_no ?>', '<?= htmlspecialchars($delivered_at_plantdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $delivered_at_plantdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$delivered_at_plantdata->clientname?>
                            </h6>
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$delivered_at_plantdata->invoice_id?></h6>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left; text-align:left;">Delivery Date: <?=$delivered_at_plantdata->delivery_date?>
                            </p>
                            
                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$delivered_at_plantdata->qt?>)</p>

                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$delivered_at_plantdata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" selected>Delivered at Plant</option>
                            <option value="3">Recieved at Plant</option>
                            <option value="4">Sorting and Processing</option>
                            <option value="5">Packing and Sticker Print</option>
                            <option value="6">Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>


                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <H5 class="m-0 pt-3 pb-3" style="color:#0089ff; font-size: 17px; margin-top: 1rem;"><b>Recieved at Plant</b></H5>
    <div class="column flex">
        <?php foreach($recieved_at_plant as $recieved_at_plantdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet header" style="border:1px solid #0089ff;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$recieved_at_plantdata->order_no?>')" style="font-size:13px; text-align:left; float: left;">-->
                            <!--    <?=$recieved_at_plantdata->clientname ?></h6>-->
                            
                             <h6 onclick="showTicket1('<?= $recieved_at_plantdata->order_no ?>', '<?= htmlspecialchars($recieved_at_plantdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $recieved_at_plantdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$recieved_at_plantdata->clientname?>
                            </h6>
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$recieved_at_plantdata->invoice_id ?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left; font-size:13px; text-align:left;">Delivery Date: <?=$recieved_at_plantdata->delivery_date ?></p>

                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$recieved_at_plantdata->qt?>)</p>
                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$recieved_at_plantdata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" selected>Recieved at Plant</option>
                            <option value="4">Sorting and Processing</option>
                            <option value="5">Packing and Sticker Print</option>
                            <option value="6">Ready to Dispatch</option>
                             <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>

                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <H5 class="m-0 pt-3 pb-3" style="color:orange; font-size: 17px; margin-top: 1rem;"><b>Sorting and Processing</b></H5>
    <div class="column flex">
        <?php foreach($Sorting_and_processing_through as $Sorting_and_processing_throughdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$Sorting_and_processing_throughdata->order_no?>')" style="float: left; font-size:13px; text-align:left;">-->
                            <!--    <?=$Sorting_and_processing_throughdata->clientname?></h6>-->
                            
                             <h6 onclick="showTicket1('<?= $Sorting_and_processing_throughdata->order_no ?>', '<?= htmlspecialchars($Sorting_and_processing_throughdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Sorting_and_processing_throughdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Sorting_and_processing_throughdata->clientname?>
                            </h6>
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Sorting_and_processing_throughdata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left;text-align:left;">Delivery Date: <?=$Sorting_and_processing_throughdata->delivery_date?></p>
                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$Sorting_and_processing_throughdata->qt ?>)</p>
                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">    
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$Sorting_and_processing_throughdata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" selected>Sorting and Processing</option>
                            <option value="5">Packing and Sticker Print</option>
                            <option value="6">Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received </option>
                            <option value="9">Delivered to Customer</option>

                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size: 17px; margin-top: 1rem;"><b>Packing and Sticker Print</b></h5>
    <div class="column flex">
        <?php  foreach($Packing_and_sticker_print as $Packing_and_sticker_printdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$Packing_and_sticker_printdata->order_no?>')" style="font-size:13px;text-align:left; float: left;">-->
                            <!--    <?=$Packing_and_sticker_printdata->clientname?></h6>-->
                            
                             <h6 onclick="showTicket1('<?= $Packing_and_sticker_printdata->order_no ?>', '<?= htmlspecialchars($Packing_and_sticker_printdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Packing_and_sticker_printdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Packing_and_sticker_printdata->clientname?>
                                 
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Packing_and_sticker_printdata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left;text-align:left;">Delivery Date: <?=$Packing_and_sticker_printdata->delivery_date?></p>

                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:rigth;">(<?=$Packing_and_sticker_printdata->qt ?>)</p>

                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px;width:100%;" onchange="change_order_status(<?=$Packing_and_sticker_printdata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing</option>
                            <option value="5" selected>Packing and Sticker Print</option>
                            <option value="6">Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received </option>
                            <option value="9">Delivered to Customer</option>

                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size: 17px; margin-top: 1rem;"><b>Ready to Dispatch</b></h5>
    <div class="column flex">
        <?php  foreach($ready_to_dispatch as $ready_to_dispatchdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$ready_to_dispatchdata->order_no?>')" style="text-align:left; font-size:13px; float: left;">-->
                            <!--    <?=$ready_to_dispatchdata->clientname?></h6>-->
                            
                             <h6 onclick="showTicket1('<?= $ready_to_dispatchdata->order_no ?>', '<?= htmlspecialchars($ready_to_dispatchdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $ready_to_dispatchdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$ready_to_dispatchdata->clientname?>
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="font-size:13px; float: right;">Ord No. <?=$ready_to_dispatchdata->invoice_id?></h6>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <p class="card-text" style="float:left; text-align:left;">Delivery Date: <?=$ready_to_dispatchdata->delivery_date?></p>
                            <!--<h6 style="float: left;"></h6>-->
                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float: right;">(<?=$ready_to_dispatchdata->qt?>)</p>

                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select onchange="change_order_status(<?=$ready_to_dispatchdata->id ?>,this)"
                            style="font-size:14px;" class="w-100 btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing</option>
                            <option value="5" >Packing and Sticker Print</option>
                            <option value="6" selected>Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7">Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>

                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>



<!--pecked-->
<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size: 17px; margin-top: 1rem;"><b>Pick-up by Delivery Van</b></h5>
    <div class="column flex">
        <?php  foreach($Pick_up_by_delivery_van as $Pick_up_by_delivery_vandata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6  style="font-size:13px; text-align:left; float: left;"  onclick="showTicket1('<?=$Pick_up_by_delivery_vandata->order_no?>')">-->
                            <!--    <?=$Pick_up_by_delivery_vandata->clientname?></h6>-->
                            
                              <h6 onclick="showTicket1('<?= $Pick_up_by_delivery_vandata->order_no ?>', '<?= htmlspecialchars($Pick_up_by_delivery_vandata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Pick_up_by_delivery_vandata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Pick_up_by_delivery_vandata->clientname?>
                                 
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Pick_up_by_delivery_vandata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left; text-align:left;">Delivery Date: <?=$Pick_up_by_delivery_vandata->delivery_date?></p>

                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float:right;">(<?=$Pick_up_by_delivery_vandata->qt?>)</p>
                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$Pick_up_by_delivery_vandata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">
                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing</option>
                            <option value="5" >Packing and Sticker print</option>
                            <option value="6" >Ready to Dispatch</option>
                            <option value="10" selected>Pick-up by Delivery Van</option>
                            <option value="7" >Delivered at franchise</option>
                            <option value="8">Franchise Received </option>
                            <option value="9">Delivered to Customer</option>
                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!--pecked-->


<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size:17px; margin-top: 1rem;"><b>Delivered at Franchise</b></h5>
    <div class="column flex">
        <?php  foreach($Delivered_at_franchise as $Delivered_at_franchisedata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left; font-size:13px;text-align:left;" onclick="showTicket1('<?=$Delivered_at_franchisedata->order_no?>')">-->
                            <!--    <?=$Delivered_at_franchisedata->clientname?></h6>-->
                            
                            <h6 onclick="showTicket1('<?= $Delivered_at_franchisedata->order_no ?>', '<?= htmlspecialchars($Delivered_at_franchisedata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Delivered_at_franchisedata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Delivered_at_franchisedata->clientname?>
                            </h6> 
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Delivered_at_franchisedata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="text-align:left; float:left;">Delivery Date: <?=$Delivered_at_franchisedata->delivery_date?></p>

                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float: left;">(<?=$Delivered_at_franchisedata->qt?>)</p>
                            <img style="float:left;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                        </div>
                        
                        <?php if ($Delivered_at_franchisedata->image): ?>  <div class="row" style="margin-left: 18px;">
                            <div class="col" style="padding-left:3px;">
                                <img style="float:right;height:60px;" src="<?=$Delivered_at_franchisedata->image?>" alt="Icon 1" /> </div>
                            <div class="col" style="padding-left:3px;">
                                <img style="float:right;height:60px;" src="<?=$Delivered_at_franchisedata->signature?>" alt="Icon 2" /> </div>
                        </div>
                       <?php endif; ?>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$Delivered_at_franchisedata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing</option>
                            <option value="5" >Packing and Sticker Print</option>
                            <option value="6" >Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7" selected>Delivered at Franchise</option>
                            <option value="8">Franchise Received</option>
                            <option value="9">Delivered to Customer</option>



                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size:17px; margin-top: 1rem;"><b>Franchise Received</b></h5>
    <div class="column flex">
        <?php  foreach($Franchise_received_through_sticker as $Franchise_received_through_stickerdata) { ?>
        <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$Franchise_received_through_stickerdata->order_no?>','<?=$Franchise_received_through_stickerdata->barcode?>','<?=$Franchise_received_through_stickerdata->qt?>')" style="font-size:13px;text-align:left; float: left;">-->
                            <!--    <?=$Franchise_received_through_stickerdata->clientname?></h6>-->
                                
                            <h6 onclick="showTicket1('<?= $Franchise_received_through_stickerdata->order_no ?>', '<?= htmlspecialchars($Franchise_received_through_stickerdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $Franchise_received_through_stickerdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$Franchise_received_through_stickerdata->clientname?>
                            </h6>  
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size:13px;">Ord No. <?=$Franchise_received_through_stickerdata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left;">Delivery Date: <?=$Franchise_received_through_stickerdata->delivery_date?></p>
                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float: left;">(<?=$Franchise_received_through_stickerdata->qt?>)</p>

                            <img style="float:left;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select style="font-size:14px; width:100%;" onchange="change_order_status(<?=$Franchise_received_through_stickerdata->id ?>,this)"
                            class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by Delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing</option>
                            <option value="5" >Packing and Sticker Print</option>
                            <option value="6" >Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery Van</option>
                            <option value="7" >Delivered at Franchise</option>
                            <option value="8" selected>Franchise Received</option>
                            <option value="9">Delivered to Customer</option>



                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<div class="col p-0" style="cursor: pointer;">
    <h5 class="m-0 pt-3 pb-3" style="color:#13b313; font-size:17px; margin-top: 1rem;"><b>Delivered to Customer</b></h5>
    <div class="column flex">
        <?php  foreach($delivered_to_customer as $delivered_to_customerdata) { ?>
         <div class="col-sm-12 mb-3 portlet">
            <div class="card portlet-header" style="border:1px solid #13b313; cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 onclick="showTicket1('<?=$delivered_to_customerdata->order_no?>')" style="font-size:13px; text-align:left; float: left;">-->
                            <!--    <?=$delivered_to_customerdata->clientname?></h6>-->
                            
                            <h6 onclick="showTicket1('<?= $delivered_to_customerdata->order_no ?>', '<?= htmlspecialchars($delivered_to_customerdata->barcode, ENT_QUOTES, 'UTF-8') ?>', '<?= $delivered_to_customerdata->qt ?>')" style="font-size:13px;text-align:left; float: left;">
                                 <?=$delivered_to_customerdata->clientname?>
                            
                        </div>
                        <div class="col" style="padding-left:3px;">
                            <h6 style="float: right; font-size: 13px;">Ord No. <?=$delivered_to_customerdata->invoice_id?></h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="padding-right:3px;">
                            <!--<h6 style="float: left;"></h6>-->
                            <p class="card-text" style="float:left;text-align:left;">Delivery Date: <?=$delivered_to_customerdata->delivery_date?></p>

                        </div>

                        <div class="col" style="padding-left:3px;">
                            <p style="float: right;">(<?=$delivered_to_customerdata->qt?>)</p>

                            <img style="float:right;"
                                src="https://img.icons8.com/ios-glyphs/30/null/womens-t-shirt.png" />
                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <select onchange="change_order_status(<?=$delivered_to_customerdata->id ?>,this)"
                            style="font-size:14px; width:100%;"    class="btn btn-outline-primary" name="order_status">

                            <option value="0" >Order Placed</option>
                            <option value="1" >Picked up by delivery Van</option>
                            <option value="2" >Delivered at Plant</option>
                            <option value="3" >Recieved at Plant</option>
                            <option value="4" >Sorting and Processing </option>
                            <option value="5" >Packing and Sticker Print</option>
                            <option value="6" >Ready to Dispatch</option>
                            <option value="10">Pick-up by Delivery van</option>
                            <option value="7" >Delivered at Franchise</option>
                            <option value="8" >Franchise Received  </option>
                            <option value="9" selected>Delivered to Customer</option>
                        </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</div>
</div>
</div>


<script type="text/javascript">
function change_order_status(id, type) {
    var status = $(type).children("option:selected").val();
    data = 'id=' + id + '&status=' + status;
    $.ajax({
        url: "<?php echo site_url('sales/change_order_status')?>",
        type: "GET",
        data: data,
        success: function(data) {
            result = JSON.parse(data);
            if (result.status == 1) {
                refreshpage();
                alert(result.message);
                var html = "";
                if (status == 0) {
                    //html = "Pending";
                }
                if (status == 1) {
                    html = "Hey " + result.clientname +
                        ", we are processing your order now for cleaning/Ironing, and we’ll let you know when it’s ready to deliver. Thanks " +
                        result.username;
                    var action_url = "https://wa.me/91" + result.phone + "?text=" + html;
                    window.open(action_url, '_blank');
                }
                if (status == 2) {
                    html = "Hey " + result.clientname + ", Your order has been picked up from " + result
                        .username + " Please let us know if you have any feedback.  " + result.username;
                    var action_url = "https://wa.me/91" + result.phone + "?text=" + html;
                    window.open(action_url, '_blank');
                }

            } else {
                alert(result.message);
            }


        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("error");
        }
    });
}
</script>