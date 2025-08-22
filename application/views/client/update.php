<div id="updatebtm_result" class="form-group text-success"></div>
<input type="hidden" name="idcltup" id="idcltup" value="<?= $client->id; ?>">

<div class="form-group position-relative error-l-50">
    <label><?= display('num') ?></label>
    <input type="text" class="form-control" placeholder="" name="numup" id="numup" required value="<?= $client->num; ?>" readonly="readonly">
</div>
<div class="form-group">
    <label><?= display('first_name') ?><span class="text-danger">*</span> </label>
    <input type="text" class="form-control" placeholder="" name="lastnameup" id="lastnameup" autocomplete="off" value="<?= $client->lastname; ?>">
</div>
<div class="form-group">
    <label><?= display('last_name') ?><span class="text-danger">*</span> </label>
    <input type="text" class="form-control" placeholder="" name="firstnameup" id="firstnameup" autocomplete="off" value="<?= $client->firstname; ?>">
</div>
<div class="form-group">
    <label><?= display('phone') ?></label>
    <input type="text" class="form-control" placeholder="" name="phoneup" id="phoneup" autocomplete="off" value="<?= $client->phone; ?>">
</div>
<div class="form-group">
    <label><?= display('adress') ?></label>
    <input type="text" class="form-control" placeholder="" name="adressup" id="adressup" value="<?= $client->adress; ?>">
</div>
<div class="form-group">
    <label> <?= display('discounts') . ' (' . settings()->currency ?>)</label>
    <input type="text" class="form-control" placeholder="" name="discountup" id="discountup" value="<?= $client->discount; ?>">
</div>