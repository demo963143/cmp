<input type="hidden" name="idprodup" id="idprodup" value="<?= $product->id; ?>">
<div class="row">
    <div class="form-group position-relative error-l-50 col-md-2 col-12">
        <label><?= display('num'); ?> </label>
        <input type="text" class="form-control" placeholder="" name="numup" id="numup" autocomplete="off" value="<?= $product->num; ?>" readonly="readonly">
    </div>

    <div class="form-group col-md-6 col-12">
        <label> <?= display('name'); ?> <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="nameprodup" id="nameprodup" autocomplete="off" value="<?= $product->name; ?>">
    </div>

    <div class="form-group col-md-4 col-12">
        <label> <?= display('categories'); ?> <span class="text-danger ">*</span></label>
        <select name="categoryidup" class="form-control reqred" id="categoryidup">
            <?PHP
            foreach ($categories as $category) {
            ?>
                <option <?php if ($category->id == $product->category_id) echo 'selected="selected"'; ?> value="<?= $category->id; ?>"><?= $category->name; ?></option>
            <?PHP
            }
            ?>

        </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-12">
        <label> Ironing Normal (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="lroningnormalup" id="lroningnormalup" autocomplete="off" value="<?= $product->ironingnormal; ?>">
    </div>
    <div class="form-group col-md-6 col-12">
        <label> Ironing Express <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="lroningfastup" id="lroningfastup" autocomplete="off" value="<?= $product->ironingexpress; ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-12">
        <label> <?= display('laundry'); ?> <?= display('normal'); ?> (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="laundrynormalup" id="laundrynormalup" autocomplete="off" value="<?= $product->laundrynormal; ?>">
    </div>
    <div class="form-group col-md-6 col-12">
        <label> Laundry Express (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="laundryfastup" id="laundryfastup" autocomplete="off" value="<?= $product->laundryexpress; ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-12">
        <label> <?= display('laundrylroning') ?> <?= display('normal'); ?> (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="laundrylroningnormalup" id="laundrylroningnormalup" autocomplete="off" value="<?= $product->laundryironnormal; ?>">
    </div>
    <div class="form-group col-md-6 col-12">
        <label> Laundry Ironing Express (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="laundrylroningfastup" id="laundrylroningfastup" autocomplete="off" value="<?= $product->laundryironexpress; ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-12">
        <label> <?= display('dry_wash') ?> <?= display('normal'); ?> (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="drynormalup" id="drynormalup" autocomplete="off" value="<?= $product->drywashnormal; ?>">
    </div>
    <div class="form-group col-md-6 col-12">
        <label>Dry Wash Express (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
        <input type="text" class="form-control reqred" placeholder="" name="dryfastup" id="dryfastup" autocomplete="off" value="<?= $product->drywashexpress; ?>">
    </div>
    <div class="form-group col-md-12 col-12">
        <!--<button type="button" class="btn btn-sm btn-outline-primary ml-3 d-none d-md-inline-block" data-toggle="modal" data-backdrop="static" data-target="#iconshow"> <?= display('add_an_icon'); ?> <i class="glyph-icon simple-icon-plus"></i> </button>-->
        <span id="icon_selectup" style="font-size: 40px;">
            <?PHP
            $type = substr($product->icon, strrpos($product->icon, '.') + 0);
            if ($type == '.svg') {
            ?>
                <img class="svgicon" src="<?= base_url() . '/files/svg/' . $product->icon; ?>">
            <?PHP
            } else {
            ?>
                <i class="<?= $product->icon; ?>"></i>
            <?PHP
            }
            ?>

        </span>
        <input type="hidden" id="iconsup">
    </div>
</div>
<hr>
<div class="row">

    <?PHP
    foreach ($services as $service) {
        $pricing = $this->service->get_pricing($service->id, $product->id) ? $this->service->get_pricing($service->id, $product->id)->pricing : 0;
    ?>
        <div class="form-group col-md-4 col-12">
            <label> <?= $service->name; ?> (<?= settings()->currency ?>) <span class="text-danger ">*</span></label>
            <input type="text" class="form-control item_nameup" placeholder="" name="item_name" id="" autocomplete="off" value="<?= format_price($pricing) ?>">
            <input type="hidden" class="servidup" placeholder="" name="servid" id="" autocomplete="off" value="<?= $service->id; ?>">
        </div>
    <?PHP
    }
    ?>
</div>