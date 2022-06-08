<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
	<path fill="#6ab845" fill-opacity="1"
		d="M0,192L48,192C96,192,192,192,288,181.3C384,171,480,149,576,133.3C672,117,768,107,864,117.3C960,128,1056,160,1152,176C1248,192,1344,192,1392,192L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
	</path>
</svg>
<div class="container">
	<div class="form-head"><br>
		<a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-updated.png') ?>" alt="Kappali"></a>
	</div>
	<div class="mob-nav-head">
		<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a>
		<p><b>Continue</b></p>
	</div>
	<div class="scrap-form mb-5">
		<form method="post">
		<!-- <form method="post" onsubmit="makePayment(this); return false;"> -->
			<br>
			<h4><b>Fill the form for car wash -</b></h4>
			<p class="wash-note">Note - This service is available only in Ahmedabad.</p>
			<div class="address-details">
				<div class="form-group">
					<label for="vehicle_company">Vehicle Company</label>
					<input type="text" value="<?= $data['vehicle_company'] ?>" maxlength="100" name="vehicle_company" class="form-control" placeholder="Hyundai or Maruti Suzuki">
				</div>
				<div class="form-group">
					<label for="vehicle_model">Vehicle Model</label>
					<input type="text" value="<?= $data['vehicle_model'] ?>" maxlength="100" name="vehicle_model" class="form-control"  placeholder="E.g. Verna">
				</div>
				<div class="form-group">
					<label for="vehicle_no">Vehicle No.</label>
					<input type="text" name="vehicle_no" class="form-control"
						value="<?= $data['vehicle_no'] ?>"
						placeholder="GH01AB1234" maxlength="10">
					<?= form_error('vehicle_no') ?>
				</div>
				<div class="form-group">
					<label for="wash_date">Select date:</label><br>
					<input type="date" id="wash_date" name="wash_date" placeholder="DD-MM-YYYY" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+5 Days')) ?>">
					<?= form_error('wash_date') ?>
				</div>
				<div class="form-group">
					<label class="from-control-label" for="wash_time">Select time</label><br>
					<select name="wash_time" class="form-control">
						<option value="" selected>Select time</option>
						<option>Anytime</option>
						<option>08:00 to 09:00</option>
						<option>09:00 to 10:00</option>
						<option>10:00 to 11:00</option>
						<option>11:00 to 12:00</option>
						<option>12:00 to 01:00</option>
						<option>01:00 to 02:00</option>
						<option>02:00 to 03:00</option>
						<option>03:00 to 04:00</option>
						<option>04:00 to 05:00</option>
						<option>05:00 to 06:00</option>
						<option>06:00 to 07:00</option>
						<option>07:00 to 08:00</option>
					</select>
					<?= form_error('wash_time') ?>
				</div>
				
			</div>
			<!-- <div class="continue-msg">
				<p></p>
				<p>Note : <br>1. Your balance will be credited to the Kapali app, which can be Redeem or donate as
					desired.<br>
					2. Your payment will be made by mobile wallet or bank transfer.<br>
					3. Heavy items will be measured from the store.<br></p>
			</div> -->
			<button type="submit" class="btn btn-success">Submit</button><br><br>
		</form>
		<hr>
		<div class="continue-msg">
		<p></p>
		<p><b>Note : </b><br>
		<?php foreach($notes as $k => $note): ?>
			<?= ++$k ?>. <?= $note['note_details'] ?><br>
		<?php endforeach ?>
		</p>
		</div>
		<hr>
		<h5 class="text-white"><b>Our happy customers -</b></h5><br>
		<div class="happy-customers">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php foreach($custs as $k => $c): ?>
					<div class="carousel-item <?= $k === 0 ? 'active' : '' ?>">
						<?= img(['src' => $c['image']]) ?>
					</div>
					<?php endforeach ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<!-- <h5 class="text-white"><b>Our happy customers -</b></h5><br>
		<div class="row">
			<?php foreach($custs as $cust): ?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-4">
				<?= img(['src' => $cust['image'], 'height' => 100]) ?>
			</div>
			<?php endforeach ?>
		</div> -->
	</div>
	<br><br>
</div>
