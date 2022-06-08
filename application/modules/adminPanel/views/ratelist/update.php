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
						<select name="cat_id" class="form-control form-control-round">
							<?php foreach ($cats as $k => $v): ?>
								<option value="<?= my_crypt($v['id']) ?>" <?= (set_value('cat_id')) ? set_select('cat_id', my_crypt($v['id'])) : (($data['cat_id'] == $v['id']) ? 'selected' : '') ?>><?= $v['cat_name'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('cat_id') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('item_name', (set_value('item_name')) ? set_value('item_name') : $data['item_name'], 'class="form-control form-control-round" id="item_name" placeholder="Item name"') ?>
						<?= form_error('item_name') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('item_rate', (set_value('item_rate')) ? set_value('item_rate') : $data['item_rate'], 'class="form-control form-control-round" id="item_rate" placeholder="Item rate"') ?>
						<?= form_error('item_rate') ?>
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