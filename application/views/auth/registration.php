<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,320L48,309.3C96,299,192,277,288,266.7C384,256,480,256,576,261.3C672,267,768,277,864,272C960,267,1056,245,1152,245.3C1248,245,1344,267,1392,277.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<div class="container">
<div class="regi-header">
	<div class="regi-header-logo text-center">
		<a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="kappali"></a><br>
		<h3>Sign Up here</h3>
	</div>
	<div class="regi-form">
		<form method="POST">
			<div class="form-group">
				<label for="fname">First name</label>
				<input type="text" name="fname" class="form-control" placeholder="Enter your first name" value="<?= set_value('fname') ?>">
				<?= form_error('fname') ?>
			</div>
			<div class="form-group mt-3">
				<label for="fname">Last name</label>
				<input type="text" name="lname" class="form-control" placeholder="Enter your last name" value="<?= set_value('lname') ?>">
				<?= form_error('lname') ?>
			</div>
			<div class="form-group mt-3">
				<label for="phone">Mobile no.</label>
				<input type="number" name="phone" class="form-control" placeholder="Enter your mobile number" value="<?= set_value('phone') ?>"  maxlength="10">
				<?= form_error('phone') ?>
			</div>
			<div class="form-group mt-3">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" placeholder="Enter your password" maxlength="100">
				<?= form_error('password') ?>
			</div>
			<div class="form-group mt-3">
				<label for="app_no">Flat no. / Appartment no.</label>
				<input type="text" name="app_no" class="form-control" placeholder="Flat no. / Appartment no.">
				<?= form_error('app_no') ?>
			</div>
			<div class="form-group mt-3">
				<label for="society">Society / Appartment / Bunglows</label>
				<input type="text" name="society" class="form-control" placeholder="Society / Appartment / Bunglows name">
				<?= form_error('society') ?>
			</div>
			<div class="form-group mt-3">
				<label for="nearby">Nearby area</label>
				<input type="text" name="nearby" class="form-control" placeholder="Nearby area">
				<?= form_error('nearby') ?>
			</div>
			<div class="form-group mt-3">
				<label for="area">Area</label>
				<input type="text" name="area" class="form-control" placeholder="Area">
				<?= form_error('area') ?>
			</div>
			<!-- <div class="form-group">
				<label for="area">Area</label><br>
				<select name="area" class="form-control">
					<?php foreach ($areas as $v): ?>
					<option value="<?= my_crypt($v['id']) ?>"><?= ucwords($v['area']).' - '.$v['pincode'] ?>
					</option>
					<?php endforeach ?>
				</select>
				<?= form_error('area') ?>
				<p class="area-msg">*Service will start in the rest of the area in ahmedabad and other cities shortly.</p>
			</div> -->
			<button type="submit" class="btn btn-success">Submit</button><br><br>
			<p>Already registered? <a href="<?= base_url('login') ?>"><u>Login here</u></a></p>
			<div class="contact-details">
				<p>For any query please -</p>
				<p class="contDet">Contact us - 88666 79667 <br>Email - kappali.info@gmail.com</p>
			</div>
		</form>
	</div>
</div>
</div>