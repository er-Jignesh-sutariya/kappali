<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open() ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?= form_input('note_details', (set_value('note_details')) ? set_value('note_details') : (isset($data['note_details']) ? $data['note_details'] : ''), 'class="form-control form-control-round" id="note_details" placeholder="Note details"') ?>
						<?= form_error('note_details') ?>
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