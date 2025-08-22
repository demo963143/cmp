<div id="updatebtm_result" class="form-group text-success"></div>
<input type="hidden" name="idexpenceup" id="idexpenceup" value="<?=$expence->id;?>">
  
<div class="form-group">
                                                    <label><?=display('num')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control datepicker" placeholder="" name="numup" id="numup" autocomplete="off"  data-date-format="yyyy-mm-dd" value="<?=$expence->reference;?>" readonly>
                                                </div>
<div class="form-group">
                                                    <label><?=display('date')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control datepicker" placeholder="" name="dateup" id="dateup" autocomplete="off"  data-date-format="yyyy-mm-dd" value="<?=$expence->date;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?=display('title')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control" placeholder="" name="noteup" id="noteup" autocomplete="off" value="<?=$expence->note;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?=display('price')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control" placeholder="" name="amountup" id="amountup" autocomplete="off" value="<?=$expence->amount;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?=display('category')?>  <span class="text-danger error_lastname">*</span></label>
                                                     <select class="form-control" name="category_id" id="category_id">
                                                     <?PHP 
                                                         foreach($categories as $category)
                                                         {
                                                         ?>
                                                         <option <?PHP if($category->id == $expence->category_id) echo 'selected';?> value="<?=$category->id;?>"><?=$category->name;?></option>
                                                         <?PHP
                                                         }
                                                         ?>
                                                     </select>
                                                </div>
                                                <div class="form-group">
                                                <label><?=display('file')?> : </label>
                                                      <input type="file" class="form-control" id="attachment" name="attachment">
                           
                                                </div>
                                                