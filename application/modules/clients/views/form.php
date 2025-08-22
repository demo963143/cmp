<?php
$cv = $this->controller->view_data['custom_values'];
?>

<script type="text/javascript">
    $(function () {
        $("#client_country").select2({
            placeholder: "<?php _trans('country'); ?>",
            allowClear: true
        });
    });
</script>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="_ip_csrf" value="<?= $this->security->get_csrf_hash() ?>">

    <div id="headerbar">
        <h1 class="headerbar-title"><?php _trans('client_form'); ?></h1>
        <?php $this->layout->load_view('layout/header_buttons'); ?>
    </div>

    <div id="content">

        <?php $this->layout->load_view('layout/alerts'); ?>

        <input class="hidden" name="is_update" type="hidden"
            <?php if ($this->mdl_clients->form_value('is_update')) {
                echo 'value="1"';
            } else {
                echo 'value="0"';
            } ?>
        >

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-offset-3">

                <div class="panel panel-default">
                    <div class="panel-heading form-inline clearfix">
                        <?php _trans('personal_information'); ?>

                        <div class="pull-right">
                            <label for="client_active" class="control-label">
                                <?php _trans('active_client'); ?>
                                <input id="client_active" name="client_active" type="checkbox" value="1"
                                    <?php if ($this->mdl_clients->form_value('client_active') == 1
                                        || !is_numeric($this->mdl_clients->form_value('client_active'))
                                    ) {
                                        echo 'checked="checked"';
                                    } ?>>
                            </label>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label for="room_no">
                                Room No
                            </label>
                            <input id="room_no" name="room_no" type="text" class="form-control" required
                                   autofocus
                                   value="<?php echo $this->mdl_clients->form_value('room_no', true); ?>">
                        </div>

                        <div class="form-group">
                            <label for="client_name">
                                Tenant Full Name
                            </label>
                            <input id="client_name" name="client_name" type="text" class="form-control" required
                                   autofocus
                                   value="<?php echo $this->mdl_clients->form_value('client_name', true); ?>">
                        </div>

                        <div class="form-group">
                            <label for="tenant_photo">Tenant Photo</label>
                            <input id="tenant_photo" name="tenant_photo[]" type="file" class="form-control" accept="image/*">
                            <input type="hidden" name="tenant_file_name" id="tenant_file_name" class="form-control tenant_file_name" value="<?php echo $this->mdl_clients->form_value('tenant_file_name', true); ?>">
                        </div>
                    
                        <div class="form-group">
                            <label for="client_gender">
                                <?php _trans('gender'); ?> 
                                </label>

                            <div class="controls">
                                <select name="client_gender" id="client_gender" class="form-control simple-select">
                                    <?php
                                    $genders = array(
                                        trans('gender_male'),
                                        trans('gender_female'),
                                        trans('gender_other'),
                                    );
                                    foreach ($genders as $key => $val) { ?>
                                        <option value=" <?php echo $key; ?>" <?php check_select($key, $this->mdl_clients->form_value('client_gender')) ?>>
                                            <?php echo $val; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- <div class="form-group has-feedback">
                            <label for="client_birthdate"><?php _trans('birthdate'); ?> (Optional)</label>
                            <?php
                            $bdate = $this->mdl_clients->form_value('client_birthdate');
                            if ($bdate && $bdate != "0000-00-00") {
                                $bdate = date_from_mysql($bdate);
                            } else {
                                $bdate = '';
                            }
                            ?>
                            <div class="input-group">
                                <input type="text" name="client_birthdate" id="client_birthdate"
                                       class="form-control datepicker"
                                       value="<?php _htmlsc($bdate); ?>">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                            </div>
                        </div> -->

                        <div class="form-group">
                           <label for="client_birthdate"><?php _trans('birthdate'); ?> (Optional)</label>
                            <div class="controls">
                                <input type="date" name="client_birthdate" id="client_birthdate" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_birthdate', true); ?>">
                            </div>
                        </div>
                        

                        <!-- Custom fields -->
                        <?php foreach ($custom_fields as $custom_field): ?>
                            <?php if ($custom_field->custom_field_location != 3) {
                                continue;
                            } ?>
                            <?php print_field($this->mdl_clients, $custom_field, $cv); ?>
                        <?php endforeach; ?>


                    </div>
                </div>

            </div>
        </div>


        <div class="row">
		            <div class="col-xs-12 col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                     Parents Details 
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="father_name">Father Name</label>
                            <div class="controls">
                                <input type="text" name="father_name" id="father_name" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('father_name', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="father_no">Father Contact  Number </label>
                            <div class="controls">
                                <input type="number" name="father_no" id="father_no" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('father_no', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mother_name">Mother Name</label>
                            <div class="controls">
                                <input type="text" name="mother_name" id="mother_name" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('mother_name', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mother_no">Mother Contact Number </label>
                            <div class="controls">
                                <input type="number" name="mother_no" id="mother_no" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('mother_no', true); ?>" required>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
		</div>




        <div class="row">
		<div class="col-xs-12 col-sm-6 col-md-offset-3">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <?php _trans('contact_information'); ?>
                    </div>

                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="client_mobile"><?php _trans('mobile_number'); ?></label>

                            <div class="controls">
                                <input type="text" name="client_mobile" id="client_mobile" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_mobile', true); ?>" required>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="client_email"><?php _trans('email_address'); ?>(Optional)</label>

                            <div class="controls">
                                <input type="text" name="client_email" id="client_email" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_email', true); ?>" >
                            </div>
                        </div>

                       

                        <!-- Custom fields -->
                        <?php foreach ($custom_fields as $custom_field): ?>
                            <?php if ($custom_field->custom_field_location != 2) {
                                continue;
                            } ?>
                            <?php print_field($this->mdl_clients, $custom_field, $cv); ?>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-offset-3">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <?php _trans('address'); ?>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="client_address_1"><?php _trans('street_address'); ?></label>

                            <div class="controls">
                                <input type="text" name="client_address_1" id="client_address_1" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_address_1', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_address_2"><?php _trans('street_address_2'); ?> (Optional)</label>

                            <div class="controls">
                                <input type="text" name="client_address_2" id="client_address_2" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_address_2', true); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_city"><?php _trans('city'); ?></label>

                            <div class="controls">
                                <input type="text" name="client_city" id="client_city" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_city', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_state"><?php _trans('state'); ?></label>

                            <div class="controls">
                                <input type="text" name="client_state" id="client_state" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_state', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_zip"><?php _trans('zip_code'); ?></label>

                            <div class="controls">
                                <input type="text" name="client_zip" id="client_zip" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_zip', true); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_country"><?php _trans('country'); ?></label>

                            <div class="controls">
                                <select name="client_country" id="client_country" class="form-control">
                                    <option value=""><?php _trans('none'); ?></option>
                                    <?php foreach ($countries as $cldr => $country) { ?>
                                        <option value="<?php echo $cldr; ?>"
                                            <?php check_select($selected_country, $cldr); ?>
                                        ><?php echo $country ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Custom Fields -->
                        <?php foreach ($custom_fields as $custom_field): ?>
                            <?php if ($custom_field->custom_field_location != 1) {
                                continue;
                            } ?>
                            <?php print_field($this->mdl_clients, $custom_field, $cv); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="row">
		            <div class="col-xs-12 col-sm-6 col-md-offset-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php _trans('other_information'); ?>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label for="security_amount">Security Amount</label>
                            <div class="controls">
                                <input type="number" name="security_amount" id="security_amount" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('security_amount', true); ?>" required>
                            </div>
                        </div>

                       
                        <?php $selected_doc = $this->mdl_clients->form_value('document_type', true); ?>
                        <div class="form-group">
                            <label for="client_tax_code">Document Type</label>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="Aadhaar Card" name="document_type" id="radioDefault1"
                                    <?php echo ($selected_doc == 'Aadhaar Card') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="radioDefault1">Aadhaar Card</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="Pan card" name="document_type" id="radioDefault2"
                                    <?php echo ($selected_doc == 'Pan card') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="radioDefault2">Pancard</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="Driving Licence" name="document_type" id="radioDefault3"
                                    <?php echo ($selected_doc == 'Driving Licence') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="radioDefault3">Driving Licence</label>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="client_tax_code">Document No</label>

                            <div class="controls">
                                <input type="text" name="client_adhaar_no" id="client_adhaar_no" class="form-control"
                                       value="<?php echo $this->mdl_clients->form_value('client_adhaar_no', true); ?>" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="client_document">Document</label>
                            <div class="controls">
                                <input type="file" name="document_file[]" id="document_file" class="form-control" accept="image/*,application/pdf" multiple>
                                <input type="hidden" name="document_file_name" id="document_file_name" class="form-control" value="<?php echo $this->mdl_clients->form_value('document_file_name', true); ?>"></div>
                        </div>


                        <div class="form-group">
                            <label for="employee_photo">Employee Id Card</label>
                            <input id="employee_photo" name="employee_photo[]" type="file" class="form-control" accept="image/*,application/pdf">
                            <input type="hidden" name="employee_file_name" id="employee_file_name" class="form-control" value="<?php echo $this->mdl_clients->form_value('employee_file_name', true); ?>">
                        </div>

                        <div class="form-group">
                            <label for="student_photo">Student Id Card</label>
                            <input id="student_photo" name="student_photo[]" type="file" class="form-control" accept="image/*,application/pdf">
                            <input type="hidden" name="student_file_name" id="student_file_name" class="form-control" value="<?php echo $this->mdl_clients->form_value('student_file_name', true); ?>">
                        </div>
						
                        <!-- Custom fields -->
                        <?php foreach ($custom_fields as $custom_field): ?>
                            <?php if ($custom_field->custom_field_location != 4) {
                                continue;
                            } ?>
                            <?php print_field($this->mdl_clients, $custom_field, $cv); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
		</div>
		
        <?php if ($custom_fields): ?>
            <div class="row">
                <div class="col-xs-12 col-md-6">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <?php _trans('custom_fields'); ?>
                        </div>

                        <div class="panel-body">
                            <?php foreach ($custom_fields as $custom_field): ?>
                                <?php if ($custom_field->custom_field_location != 0) {
                                    continue;
                                }
                                print_field($this->mdl_clients, $custom_field, $cv);
                                ?>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</form>


<script>
$(document).ready(function() {
    $('#document_file').on('change', function() {
        var files = this.files;  
        var fileNames = [];
        for (var i = 0; i < files.length; i++) {
            fileNames.push(files[i].name);
        }
        $('#document_file_name').val(fileNames.join(','));
    });

    $('#tenant_photo').on('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        $('#tenant_file_name').val(fileName);
    });

    $('#employee_photo').on('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        $('#employee_file_name').val(fileName);
    });

    $('#student_photo').on('change', function() {
        var fileName = this.files[0] ? this.files[0].name : '';
        $('#student_file_name').val(fileName);
    });



});
</script>
