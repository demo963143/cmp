<div class="scroll dashboard-list-with-thumbs ps ps--active-y" id="productList" style="display:block;height:500px">

<?PHP
if ($products) {
    foreach ($products as $product) :
?>
        <a href="javascript:void(0)" class="btn btn-light default mb-1 mr-1 addPct" style="width: 18.8%!important; border-top:4px solid #138496; height:100px" id="<?= $product->num; ?>" onclick="add_prodpos('<?= $product->id; ?>')">
            <div class="card-body text-center p-1">
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
        <div class="messageVide"><?= display('empty') ?> <span></span></div>
    </div>
<?PHP
}
?>


</div>