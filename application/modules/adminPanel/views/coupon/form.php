<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<?= form_input('c_code', (set_value('c_code')) ? set_value('c_code') : (isset($data['c_code']) ? $data['c_code'] : ''), 'class="form-control form-control-round" id="c_code" placeholder="Coupon Code"') ?>
						<?= form_error('c_code') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('discount', (set_value('discount')) ? set_value('discount') : (isset($data['discount']) ? $data['discount'] : ''), 'class="form-control form-control-round" id="discount" placeholder="Coupon Discount" maxlength="2"') ?>
						<?= form_error('discount') ?>
					</div>
				</div>
				<div class="col-<?= isset($data['image']) ? 8 : 12 ?>">
					<div class="form-group">
						<?= form_input([
							'type' => 'file',
							'name' => 'image',
							'class' => 'form-control form-control-round'
						]) ?>
					</div>
				</div>
				<?php if (isset($data['image'])): ?>
					<div class="col-4">
						<?= img(['src' => $this->uploadPath.$data['image'], 'width' => '100%']) ?>
					</div>
				<?php endif ?>
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