<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,160L80,160C160,160,320,160,480,149.3C640,139,800,117,960,133.3C1120,149,1280,203,1360,229.3L1440,256L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
<div class="container">
<div class="form-head">
	<a href="<?= base_url() ?>"><img src="assets/images/logo-tm.png" alt="Kappali"></a>
</div><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br">
<div class="mob-nav-head">
	<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a><p><b>Add Points</b></p>
</div>
<div class="redeem-form">
	<i class="fas fa-user-circle fa-lg"></i><h4>Hi, <?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?></h4><br><br>
	<!-- <div class="note-part">
		<u><h4>&#8594;&nbsp;&nbsp;Note&nbsp;&nbsp;:</h4></u>
	</div>
	<div class="note">
		<p>You will be able to donate the desired amount for the 'GREEN DONATION’ from the main balance, which will appear on the Points home page. Which will be used for animal feed, water and tree planting. (Information about the program will be given to you on your mobile number.)<br><br>* Donation in not compulsory.</p>
	</div><hr><br>
	<div class="row add-form">
		<div class="col-lg-6 col-md-6 col-sm-7 col-7">
			<h5>Your kappali balance</h5>
			<p class="point">- <?= $this->balance ?></p><br><br>
			<h5 class="donate-line">Please add kappali points for 'green donation'</h5>
			<form>
				<input type="number" name="balance" id="balance" placeholder="Enter here any amount from main balance" onkeyup="changeRemaining()">
				<br class="point-br"><br><br>
			</form>
			<h5 class="donate-line">Your remaining balance is : <span id="remaining"></span></h5>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-5 col-5 text-center tree-part">
			<img src="<?= base_url('assets/images/tree.png') ?>">
		</div>
	</div>
	<hr><br> -->
	<!-- <div class="add-form">
		<div class="text-center tree-part">
			<img src="<?= base_url('assets/images/tree.png') ?>">
		</div>
	</div> -->
	<div class="pay-note">
		<h4><b>Select mode of payment -</b></h4><br>
	</div><br>
	<div class="payment-mode">
		<div class="payment-type">
			<div class="form-group">
				<label>Paytm<br>
					<input type="radio" name="payment" value="paytm" checked="">
					<img src="<?= base_url('assets/images/paytm-384.png') ?>">
				</label>
			</div>
		</div>
		<div class="payment-type">
			<div class="form-group">
				<label>GooglePay<br>
					<input type="radio" name="payment" value="googlepay">
					<img src="<?= base_url('assets/images/google-pay-512.png') ?>">
				</label>
			</div>
		</div>
		<div class="payment-type">
			<div class="form-group">
				<label>PhonePe<br>
					<input type="radio" name="payment" value="phonepe">
					<img src="<?= base_url('assets/images/phonepe-black.png') ?>">
				</label>
			</div>
		</div>
		<!-- <div class="payment-type">
			<div class="form-group">
				<label>Bank transfer<br>
					<input type="radio" name="payment" value="bank-transfer">
					<img src="<?= base_url('assets/images/bank-transfer.png') ?>">
				</label>
			</div>
		</div> -->
	</div>
	<!-- <div id="bank-transfer" style="display: none">
		<input type="text" name="bank_acc" placeholder="Enter bank account number" />
		<br class="point-br"><br>
		<input type="text" name="bank_ifsc" placeholder="Enter bank IFSC" />
		<br class="point-br"><br>
		<input type="number" name="bank_mobile" placeholder="Enter registered mobile number" maxlength="10" />
		<br class="point-br"><br>
		<input type="text" name="bank_name" placeholder="Enter name in bank records" />
		<br class="point-br"><br><br>
	</div> -->
	<!-- <p class="point-msg">*After getting redeem request payment will be done within 1 to 3 working days.</p><br><br> -->
	<a href="<?= base_url('thankyou') ?>">
		<button type="button" class="btn btn-success add-btn" id="redeem-points">Submit</button>
	</a><br>
	<p class="text-white mt-4">(Redeem amount used only for scrap services.)</p>
	<br><br><br>
</div>
</div>
<!-- <script>
	function changeRemaining()
	{
		let bal = parseInt("<?= $this->balance ?>");
		let remain = parseInt(document.getElementById('balance').value);
		let total = (bal - remain === parseInt(bal - remain)) ? bal - remain : '';

		if (total < 0) {
			document.getElementById('balance').value = '';
			document.getElementById('remaining').innerHTML = '';
		}else
			document.getElementById('remaining').innerHTML = total;
	}
</script> -->
<?= form_hidden('balance', $this->balance); ?>