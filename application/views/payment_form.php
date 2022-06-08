<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#6ab845" fill-opacity="1"
        d="M0,192L48,192C96,192,192,192,288,181.3C384,171,480,149,576,133.3C672,117,768,107,864,117.3C960,128,1056,160,1152,176C1248,192,1344,192,1392,192L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
    </path>
</svg>
<div class="container">
    <div class="form-head">
        <a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="Kappali"></a>
    </div>
    <div class="mob-nav-head">
        <a href="<?= base_url('car-wash') ?>"><i class="fas fa-arrow-left"></i></a>
        <p><b>Continue</b></p>
    </div>
    <div class="scrap-form">
        <form method="post">
            <br>
            <h4><b>Fill the form -</b></h4>
            <div class="address-details">
                <div class="form-group">
                    <label for="payment_id">Payment ID / Payment reference No.</label><br>
                    <input type="text" name="payment_id" class="form-control" placeholder="Payment ID / Payment reference No." maxlength="100">
                    <?= form_error('payment_id') ?>
                </div>
            </div>
            <div class="continue-msg">
				<p></p>
				<p>Note : <br>1. Your have to download QR code from <a href="<?= base_url('qrcode.jpeg') ?>" download>here.</a><br>
					2. Or you can pay to UPI ID - chudasama1212@okaxis<br>
					3. Or you can pay to our registered no. +91 9737987455 <br>
					4. After payment enter Payment ID / Payment reference No. to confirm your car wash service.<br></p>
			</div>
            <button type="submit" class="btn btn-success">Submit</button><br><br><br>
        </form>
    </div>
</div>