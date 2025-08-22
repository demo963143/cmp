<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
        <div class="card">
          <div class="card-body" style="overflow:hidden;height:385px">
                <div class="error-template text-center">
                    <h1>
                    <?=display('an_error_occurred')?>!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div class="error-details">
                    <?=display('sorry_you_dont_have_the_powerstodo_this')?> 
                    </div>
                    <div class="error-actions">
                        <a href="<?=base_url();?>" class="btn btn-primary btn-lg"> <?=display('return')?>  <i class="glyph-icon simple-icon-arrow-right"></i></a>
                    </div>
                </div>
          </div>
        </div>
        </div>
    </div>
</div>
