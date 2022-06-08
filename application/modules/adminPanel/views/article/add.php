<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open_multipart($url . '/add') ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?= form_input('title', set_value('title'), 'class="form-control form-control-round" id="title" placeholder="Article title"') ?>
						<?= form_error('title') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input([
							'type' => 'file',
							'name' => 'image',
							'class' => 'form-control form-control-round'
						]) ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_textarea('details', set_value('details'), 'class="form-control form-control-round ckeditor" id="details" placeholder="Trustee details"') ?>
						<?= form_error('details') ?>
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