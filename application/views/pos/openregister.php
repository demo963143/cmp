<link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/select2.min.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/select2-bootstrap.min.css" />
<div class="container-fluid">
<?=form_open_multipart('pos/openregister');?>
<div class="row">
               <div class="col-xl-9 col-lg-9 mb-4">
                   <div class="card">
                      
                   <div class="card-body">
                            <h5 class="mb-4">  <?=display('open_sale')?>  </h5>
                            
                         
                         <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">  <?=display('cashinhand')?>   : <?=settings()->currency;?></label>
                                        <input autocomplete="off" type="text" class="form-control col-md-6" id="cash" placeholder="0.00" name="cash" value="" required  style="direction:ltr; font-size:19px">
                                    </div>
                                    
                                </div>
                               
                                
                              
                                <button type="submit" class="btn btn-primary d-block mt-3"> <?=display('update')?> </button>
                               
                        </div>
                   </div>
               </div>
              
                </div>
               
           </div>
           <?=form_close();?>
</div>

