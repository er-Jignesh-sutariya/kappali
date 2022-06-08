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
						<?= form_input('fname', set_value('fname'), 'class="form-control form-control-round" id="fname" placeholder="First name"') ?>
						<?= form_error('fname') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('lname', set_value('lname'), 'class="form-control form-control-round" id="lname" placeholder="Last name"') ?>
						<?= form_error('lname') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('phone', set_value('phone'), 'class="form-control form-control-round" id="phone" placeholder="Phone no." maxlength="10"') ?>
						<?= form_error('phone') ?>
					</div>
				</div>
				<div class="col-12">
					<?= form_button([
					'content' => 'Save',
					'type'  => 'submit',
					'class' => 'btn btn-outline-info btn-round col-3'
					]) ?>
					<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-3']) ?>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>