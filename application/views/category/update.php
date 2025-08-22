<div id="updatebtm_result" class="form-group text-success"></div>
<input type="hidden" name="idcategup" id="idcategup" value="<?=$category->id;?>">
                                            
                                 <div class="form-group position-relative error-l-50">
                                                    <label><?=display('num')?></label>
                                                    <input type="text" class="form-control" placeholder="" name="numup" id="numup" required value="<?=$category->num;?>" readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label> <?=display('name')?> <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" placeholder="" name="namecategoryup" id="namecategoryup" autocomplete="off" value="<?=$category->name;?>">
                                                </div>
                                                <div class="error_validateup text-danger"></div>
                                                