<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,160L80,160C160,160,320,160,480,149.3C640,139,800,117,960,133.3C1120,149,1280,203,1360,229.3L1440,256L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
<div class="container">
<div class="form-head">
	<a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="Kappali"></a>
</div><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br">
<div class="mob-nav-head">
	<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a><p><b>Redeem</b></p>
</div>
<div class="redeem-form">
	<i class="fas fa-user-circle fa-lg"></i><h4>Hi, <?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?></h4><br><br>
	<h5>Your kappali balance</h5>
	<p class="point">- <?= $this->balance ?></p><br>
	<a href="<?= base_url('add-point') ?>"><button type="submit" class="btn btn-success redeem-btn">Continue</button></a>
	<p class="msg">(For redeem balance please continue)</p>
</div>
</div>