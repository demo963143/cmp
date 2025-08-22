<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php _trans('general_settings'); ?>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-md-12">

                    <div class="form-group">
                        <label for="settings[api_key]">
                            API Key
                        </label>
                        <input type="text" name="settings[api_key]" id="settings[api_key]"
                               class="form-control"
                               value="<?php echo get_setting('api_key'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="settings[sender_id]">
                            Sender Id
                        </label>
                        <input type="text" name="settings[sender_id]" id="settings[sender_id]"
                               class="form-control"
                               value="<?php echo get_setting('sender_id'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="settings[api_url]">
                            API Url
                        </label>
                        <input type="text" name="settings[api_url]" id="settings[api_url]"
                               class="form-control"
                               value="<?php echo get_setting('api_url'); ?>">
                    </div>


                </div>
            </div>

        </div>
    </div>

</div>

<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="panel panel-default">
        <div class="panel-heading">
            Sms
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-md-6">

                    <div class="form-group">
                        <span>Birthday SMS</span> <textarea id="settings[birthday_sms]" name="settings[birthday_sms]" rows="3" cols="50"><?php echo get_setting('birthday_sms', '', true); ?></textarea></br>
				        <span>Anniversary SMS</span> <textarea id="settings[anniversary_sms]" name="settings[anniversary_sms]" rows="3" cols="50"><?php echo get_setting('anniversary_sms', '', true); ?></textarea>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
