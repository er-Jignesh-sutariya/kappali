<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,320L48,309.3C96,299,192,277,288,266.7C384,256,480,256,576,261.3C672,267,768,277,864,272C960,267,1056,245,1152,245.3C1248,245,1344,267,1392,277.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<div class="container">
<div class="regi-header">
	<div class="regi-header-logo text-center">
		<a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="kappali"></a><br>
		<h3>Verify OTP here</h3>
	</div>
	<div class="regi-form">
		<form method="POST">
			<div class="form-group">
				<label for="otp">OTP</label>
				<input type="number" name="otp" class="form-control" placeholder="Enter your OTP" value="<?= set_value('otp') ?>" maxlength="4">
				<?= form_error('otp') ?>
			</div><br>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>
</div>
</div>