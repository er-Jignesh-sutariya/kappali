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
						<?= form_input('cat_name', (set_value('cat_name')) ? set_value('cat_name') : $data['cat_name'], 'class="form-control form-control-round" id="cat_name" placeholder="Category name"') ?>
						<?= form_error('cat_name') ?>
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