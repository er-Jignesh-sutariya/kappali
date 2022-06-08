<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open() ?>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<?= form_input('fname', $data['fname'], 'class="form-control form-control-round" readonly') ?>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<?= form_input('lname', $data['lname'], 'class="form-control form-control-round" readonly') ?>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<?= form_input('phone', $data['phone'], 'class="form-control form-control-round" readonly') ?>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<?= form_input('balance', (set_value('balance')) ? set_value('balance') : $data['balance'], 'class="form-control form-control-round" id="balance" placeholder="User balance" maxlength="6"') ?>
						<?= form_error('balance') ?>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<?= form_input('interior', set_value('interior'), 'class="form-control form-control-round" id="interior" placeholder="interior" maxlength="6"') ?>
						<?= form_error('interior') ?>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<?= form_input('exterior', set_value('exterior'), 'class="form-control form-control-round" id="exterior" placeholder="exterior" maxlength="6"') ?>
						<?= form_error('exterior') ?>
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