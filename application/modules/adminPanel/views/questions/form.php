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
						<?= form_input('question', (set_value('question')) ? set_value('question') : (isset($data['question']) ? $data['question'] : ''), 'class="form-control form-control-round" id="question" placeholder="Question" maxlength="255"') ?>
						<?= form_error('question') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('answer', (set_value('answer')) ? set_value('answer') : (isset($data['answer']) ? $data['answer'] : ''), 'class="form-control form-control-round" id="answer" placeholder="Answer" maxlength="255"') ?>
						<?= form_error('answer') ?>
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