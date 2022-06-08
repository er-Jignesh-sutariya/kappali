<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open_multipart($url."/update/$id") ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?= form_input('area', (set_value('area')) ? set_value('area') : $data['area'], 'class="form-control form-control-round" id="area" placeholder="Area name"') ?>
						<?= form_error('area') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('pincode', (set_value('pincode')) ? set_value('pincode') : $data['pincode'], 'class="form-control form-control-round" id="pincode" placeholder="Area pincode" maxlength="6"') ?>
						<?= form_error('pincode') ?>
					</div>
				</div>
				<div class="col-12">
					<?= form_button([
					'content' => 'Save',
					'type'  => 'submit',
					'class' => 'btn btn-outline-info btn-round col-4'
					]) ?>
					<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-4']) ?>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>