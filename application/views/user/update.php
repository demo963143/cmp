<div id="updatebtm_result" class="form-group text-success"></div>
<input type="hidden" name="idusup" id="idusup" value="<?= $user->id; ?>">
<div class="form-group position-relative error-l-50">

    <input type="text" class="form-control" placeholder="" name="numup" id="numup" autocomplete="off" value="<?= $user->num; ?>" readonly="readonly">
</div>
<div class="form-group">
    <label> <?= display('name'); ?> <span class="text-danger error_lastname">*</span></label>
    <input type="text" class="form-control" placeholder="" name="nameup" id="nameup" autocomplete="off" value="<?= $user->name; ?>">
</div>

<div class="form-group">
    <label> <?= display('email'); ?> <span class="text-danger error_lastname">*</span></label>
    <input type="text" class="form-control" placeholder="" name="emailup" id="emailup" autocomplete="off" value="<?= $user->email; ?>">
</div>
<div class="form-group">
    <label> <?= display('password'); ?> <span class="text-danger error_lastname">*</span></label>
    <input type="password" class="form-control" placeholder="" name="passwordup" id="passwordup">
    <input type="hidden" name="old_password" value="<?= $user->password; ?>" id="old_password">
</div>
<div class="form-group">
    <label> <?= display('roles'); ?> <span class="text-danger error_lastname">*</span> </label>
    <select class="form-control" name="roleidup" id="roleidup">
        <?PHP
        foreach ($roles as $role) {
        ?>
            <option <?PHP if ($role->id_role == $user->role_id) echo 'selected'; ?> value="<?= $role->id_role; ?>"><?= $role->name; ?></option>
        <?PHP
        }
        ?>

    </select>
</div>