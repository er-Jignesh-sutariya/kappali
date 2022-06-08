<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= validation_errors(); ?>
			<?php foreach ($recieved_items as $k => $v): ?>
			<?= form_open($url."/update/$id", '', ['id' => $v->id]) ?>
			<div class="row" style="margin-bottom: 20px">
				<div class="col-md-4">
					<div class="form-group">
						<?= form_input('item', $v->item, 'class="form-control form-control-round" id="item_<?= $v->id ?>" placeholder="Item" readonly=""') ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?= form_input([
						'type' => 'number',
						'name' => 'itemkg',
						'value' => $v->rec_kg,
						'class' => 'form-control form-control-round',
						'id' => "kg_<?= $v->id ?>",
						'placeholder' => "KG"
						]) ?>
					</div>
				</div>
				<div class="col-md-2">
					<?= form_button([
					'content' => 'Save',
					'type'  => 'submit',
					'class' => 'btn btn-outline-info btn-round col-12'
					]) ?>
				</div>
			</div>
			<?= form_close() ?>
			<?php endforeach ?><br>
			<div class="row">
				<div class="col-4">
					<?= anchor("$url/download/$id", '<i class="fa fa-print"></i>', 'class="btn btn-outline-success btn-round btn-block col-12"') ?>
				</div>
				<div class="col-4">
					<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-12']) ?>
				</div>
			</div>
		</div>
	</div>
</div>