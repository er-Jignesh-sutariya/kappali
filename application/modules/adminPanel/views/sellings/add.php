<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open_multipart($url . '/add') ?>
			<input type="hidden" name="phone" id="phone" />
			<input type="hidden" name="name" id="name" />
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('name', set_value('name'), 'class="form-control form-control-round" id="name" placeholder="Name of user"') ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('phone', set_value('phone'), 'class="form-control form-control-round" id="phone" placeholder="Phone of user"') ?>
						<?= form_error('phone') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<select class="js-example-placeholder-multiple col-sm-12 form-control form-control-round" name="prods[]" id="prods" multiple="">
							<option value="Newspaper" <?= set_select('prods[]', 'Newspaper'); ?>>Newspaper</option>
							<option value="Plastic" <?= set_select('prods[]', 'Plastic'); ?>>Plastic</option>
							<option value="Metal" <?= set_select('prods[]', 'Metal'); ?>>Metal</option>
							<option value="E-waste" <?= set_select('prods[]', 'E-waste'); ?>>E-waste</option>
							<option value="Other" <?= set_select('prods[]', 'Other'); ?>>Other</option>
						</select>
						<?= form_error('prods[]') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('app_no', set_value('app_no'), 'class="form-control form-control-round" id="app_no" placeholder="Flat no. / Appartment no."') ?>
						<?= form_error('app_no') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('society', set_value('society'), 'class="form-control form-control-round" id="society" placeholder="Society"') ?>
						<?= form_error('society') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('nearby', set_value('nearby'), 'class="form-control form-control-round" id="nearby" placeholder="Nearby Area"') ?>
						<?= form_error('nearby') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<select class="js-example-basic-single col-sm-12 form-control form-control-round" name="area" id="area">
							<option selected="" disabled="">Select Area</option>
							<?php foreach ($areas as $area): ?>
							<option value="<?= $area['id'] ?>" <?= set_select('area', $area['id']); ?>><?= $area['area'] . '-' . $area['pincode'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('area') ?>
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
<script>
	function addNamePhone(user)
	{
		let strUser = user.options[user.selectedIndex].text;
		let myArr = strUser.split(" - ");
		var name = myArr[0];
		var phone = myArr[myArr.length-1];
        document.getElementById('name').value = name;
        document.getElementById('phone').value = phone;
	}
</script>