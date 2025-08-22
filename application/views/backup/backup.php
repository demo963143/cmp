<div class="container-fluid">
<div class="row">
                <div class="col-12">
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                            <a href="<?=base_url('settings')?>"><button type="button" class="btn btn-primary"><?=display('general_settings')?> <i class="glyph-icon simple-icon-settings"></i> </button></a>
                            </li>
                            <li class="breadcrumb-item">
                            <a href="<?=base_url('backup')?>"><button type="button" class="btn btn-primary"> <?=display('backup')?> <i class="glyph-icon iconsminds-file-copy"></i> </button></a>
                            </li>
                           
                        </ol>
                    </nav>
                    <div class="separator mb-1"></div>
                </div>
            </div>
<div class="row">
                 
  
               <div class="col-xl-12 col-lg-12 mb-4">
                   <div class="card">
				   <div class="card-body">
                            <h5 class="mb-4"> <?=display('copy_the_database')?> </h5>
	
	<div class="message_box">
	<?php
		if (isset($success) && strlen($success)) {
			echo '<div class="success">';
			echo '<p>' . $success . '</p>';
			echo '</div>';
		}

		if (isset($errors) && strlen($errors)) {
			echo '<div class="error">';
			echo '<p>' . $errors . '</p>';
			echo '</div>';
		}

		if (validation_errors()) {
			echo validation_errors('<div class="error">', '</div>');
		}
	?>
	</div>
	<?php
		$back_url = $this->uri->uri_string();
		$key = 'referrer_url_key';
		$this->session->set_flashdata($key, $back_url);
	?>
	<div class="row">
	<?php
		echo form_open($this->uri->uri_string());
	?>
	
		
				<select name="backup_type" class="form-control col-xl-12 col-lg-12 mb-4">
				<option value="" selected disabled> <?=display('document_type')?> </option>
				<option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '1' ? 'selected' : '')) ?>><?=display('database')?></option>
				<option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '2' ? 'selected' : '')) ?>><?=display('files')?></option>
				</select>
	

			<select name="file_type" class="form-control col-xl-12 col-lg-12 mb-4">
				<option value="" selected disabled><?=display('fileformat')?>  </option>
				<option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 1 ? 'selected' : '')) ?>>ZIP</option>
				<option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 2 ? 'selected' : '')) ?>>GZIP</option>
			</select>
			<button type="submit" name="backup" value="backup" class="btn btn-sm btn-success ml-3 d-none d-md-inline-block"> <?=display('backup')?></button>
	


	<?php
		echo form_close();
	?>
	</div>
	<hr>
	<table id="table" class="table">
                <thead>
					<tr>
						<th> <?=display('num')?> </th>
						<th> <?=display('date')?></th>
						<th> <?=display('filename')?> </th>
						<th><?=display('download')?> </th>
						<th> <?=display('delete')?> </th>
					</tr>
                </thead>
                     <tbody>
						 <?PHP
						 foreach($backups as $backup)
						 {
						 ?>
						<tr>
							<td><?=$backup->backup_id;?></td>
							<td><?=$backup->created_date;?></td>
							<td><?=$backup->backup_name;?></td>
							<td><a href="<?=base_url();?>/backup/download_db_file/<?=$backup->backup_id;?>" class="btn btn-primary d-block btn-xs mt-2"><?=display('download')?></a></td>
							<td><a href="<?=base_url();?>/backup/delete_db_file/<?=$backup->backup_id;?>" class="btn btn-danger d-block btn-xs mt-2" onclick="return confirm('<?=display('deletion_confirmation')?> ?')">حدف</a></td>
						</tr>
						<?PHP
						 }
						?>

                     </tbody>
     </table>
				   </div></div></div></div></div>
