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
						<?= form_input('name', set_value('name'), 'class="form-control form-control-round" id="name" placeholder="Name"') ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('area', set_value('area'), 'class="form-control form-control-round" id="area" placeholder="Area"') ?>
						<?= form_error('area') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('contact', set_value('contact'), 'class="form-control form-control-round" id="contact" placeholder="Contact"') ?>
						<?= form_error('contact') ?>
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
						<?= form_textarea('details', set_value('details'), 'class="form-control" id="details" placeholder="Other details"') ?>
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