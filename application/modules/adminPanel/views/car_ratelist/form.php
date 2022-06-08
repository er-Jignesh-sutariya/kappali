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
						<?= form_input('item_name', (set_value('item_name')) ? set_value('item_name') : (isset($data['item_name']) ? $data['item_name'] : ''), 'class="form-control form-control-round" id="item_name" placeholder="Car Type"') ?>
						<?= form_error('item_name') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('item_rate', (set_value('item_rate')) ? set_value('item_rate') : (isset($data['item_rate']) ? $data['item_rate'] : ''), 'class="form-control form-control-round" id="item_rate" placeholder="Interior Rate"') ?>
						<?= form_error('item_rate') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('exterior_rate', (set_value('exterior_rate')) ? set_value('exterior_rate') : (isset($data['exterior_rate']) ? $data['exterior_rate'] : ''), 'class="form-control form-control-round" id="exterior_rate" placeholder="Exterior Rate"') ?>
						<?= form_error('exterior_rate') ?>
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