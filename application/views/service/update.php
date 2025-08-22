<div id="updatebtm_result" class="form-group text-success"></div>
<input type="hidden" name="idserveup" id="idserveup" value="<?= $service->id; ?>">

<div class="form-group position-relative error-l-50">
    <label> <?= display('num') ?></label>
    <input type="text" class="form-control" placeholder="" name="numup" id="numup" required value="<?= $service->num; ?>" readonly="readonly">
</div>
<div class="form-group">
    <label> <?= display('service_name') ?> <span class="text-danger">*</span> </label>
    <input type="text" class="form-control" placeholder="" name="nameserviceup" id="nameserviceup" autocomplete="off" value="<?= $service->name; ?>">
</div>
<div class="error_validateup text-danger"></div>