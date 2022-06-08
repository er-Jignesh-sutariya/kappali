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
		<div class="bread">
			<img src="<?= base_url('assets/images/bread.png') ?>">
		</div>
		<h4><b>Personal details -</b></h4>
		<div class="personal-details">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?>">
				<?= form_error('name') ?>
			</div><br>
			<div class="form-group">
				<label for="number">Mobile No.</label>
				<input type="number" name="phone" class="form-control" placeholder="Enter your mobile number" value="<?= $this->session->phone ?>" maxlength="10">
				<?= form_error('phone') ?>
			</div>
		</div><br>
		<hr><br>
		<h4><b>Address -</b></h4>
		<div class="address-details">
			<div class="form-group">
				<label for="app_no">Flat no. / Appartment no.</label><br>
				<input type="text" name="app_no" class="form-control" placeholder="Flat no. / Appartment no.">
				<?= form_error('app_no') ?>
			</div>
			<div class="form-group">
				<label for="society">Society / Appartment / Bunglows</label><br>
				<input type="text" name="society" class="form-control" placeholder="Society / Appartment / Bunglows name">
				<?= form_error('society') ?>
			</div>
			<div class="form-group">
				<label for="nearby">Nearby area</label><br>
				<input type="text" name="nearby" class="form-control" placeholder="Nearby area">
				<?= form_error('nearby') ?>
			</div>
			<div class="form-group">
				<label for="area">Area</label><br>
				<select name="area" class="form-control">
					<?php foreach ($areas as $v): ?>
						<option value="<?= my_crypt($v['id']) ?>"><?= ucwords($v['area']).' - '.$v['pincode'] ?></option>
					<?php endforeach ?>
				</select>
				<?= form_error('area') ?>
				<p class="area-msg">*Service will start in the rest of the area in ahmedabad and other cities shortly.</p>
			</div>
		</div>
		<div class="continue-msg">
			<p></p>
			<p>Note : <br>1. Your balance will be credited to the Kapali app, which can be Redeem or donate as desired.<br>
			2. Your payment will be made by mobile wallet or bank transfer.<br>
			3. Heavy items will be measured from the store.<br></p>
		</div>
		<button type="submit" class="btn btn-success">Submit</button><br><br><br>
	</form>
</div>
</div>