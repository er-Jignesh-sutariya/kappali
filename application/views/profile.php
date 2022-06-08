<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,181.3C384,171,480,149,576,133.3C672,117,768,107,864,117.3C960,128,1056,160,1152,176C1248,192,1344,192,1392,192L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<div class="container">
<div class="form-head">
	<a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="Kappali"></a>
</div>
<div class="mob-nav-head">
	<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a><p><b>Continue</b></p>
</div>
<div class="scrap-form">
	<form method="post">
		<h4><b>Update profile -</b></h4>
		<div class="address-details">
			<div class="form-group">
				<label for="fname">First name</label>
				<input type="text" name="fname" class="form-control" placeholder="Enter your first name" value="<?= $data['fname'] ?>">
				<?= form_error('fname') ?>
			</div>
			<div class="form-group mt-3">
				<label for="fname">Last name</label>
				<input type="text" name="lname" class="form-control" placeholder="Enter your last name" value="<?= $data['lname'] ?>">
				<?= form_error('lname') ?>
			</div>
			<div class="form-group mt-3">
				<label for="phone">Mobile no.</label>
				<input type="number" name="phone" class="form-control" placeholder="Enter your mobile number" value="<?= $data['phone'] ?>"  maxlength="10">
				<?= form_error('phone') ?>
			</div>
			<div class="form-group">
				<label for="app_no">Flat no. / Appartment no.</label><br>
				<input type="text" name="app_no" class="form-control" placeholder="Flat no. / Appartment no." value="<?= $data['app_no'] ?>">
				<?= form_error('app_no') ?>
			</div>
			<div class="form-group">
				<label for="society">Society / Appartment / Bunglows</label><br>
				<input type="text" name="society" class="form-control" placeholder="Society / Appartment / Bunglows name" value="<?= $data['society'] ?>">
				<?= form_error('society') ?>
			</div>
			<div class="form-group">
				<label for="nearby">Nearby area</label><br>
				<input type="text" name="nearby" class="form-control" placeholder="Nearby area" value="<?= $data['nearby'] ?>">
				<?= form_error('nearby') ?>
			</div>
			<div class="form-group">
				<label for="area">Area</label><br>
				<input type="text" name="area" class="form-control" placeholder="Area" value="<?= $this->main->check('areas', ['id' => $data['area']], 'area') ?>">
				<?= form_error('area') ?>
			</div>
			<!-- <div class="form-group">
				<label for="area">Area</label><br>
				<select name="area" class="form-control">
					<?php foreach ($areas as $v): ?>
						<option value="<?= my_crypt($v['id']) ?>" <?= $v['id'] == $data['area'] ? 'selected' : '' ?>><?= ucwords($v['area']).' - '.$v['pincode'] ?></option>
					<?php endforeach ?>
				</select>
				<?= form_error('area') ?>
			</div> -->
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" placeholder="Enter your password" maxlength="100">
				<?= form_error('password') ?>
			</div>
		</div>
		<button type="submit" class="btn btn-success">Submit</button><br><br>
		<a href="<?= base_url('logout') ?>" class="btn btn-success logout-btn">Logout</a><br><br><br>
	</form>
</div>
</div>