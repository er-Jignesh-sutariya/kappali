<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open_multipart($url . '/add') ?>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('name', set_value('name'), 'class="form-control form-control-round" id="name" placeholder="Name" required="required"') ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input('mobile', set_value('mobile'), 'class="form-control form-control-round" id="mobile" placeholder="Mobile no." required="required" maxlength="10"') ?>
						<?= form_error('mobile') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input([
							'type' => 'email',
							'placeholder' => 'Email',
							'name' => 'email',
							'id' => 'email',
							'required' => 'required',
							'class' => 'form-control form-control-round',
							'value' => set_value('email')
						]) ?>
						<?= form_error('email') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<?= form_input([
							'type' => 'password',
							'placeholder' => 'Password',
							'name' => 'password',
							'id' => 'password',
							'required' => 'required',
							'class' => 'form-control form-control-round'
						]) ?>
						<?= form_error('password') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="form-group">
						<select class="col-sm-12 form-control form-control-round" name="role" id="role">
							<option disabled="" selected="">Select Role</option>
							<!-- <option value="Admin" <?= set_select('role', 'Admin'); ?>>Admin</option> -->
							<option value="Delivery boy" <?= set_select('role', 'Delivery boy'); ?>>Delivery boy</option>
						</select>
						<?= form_error('role') ?>
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