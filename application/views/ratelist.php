<svg class="svg-class" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#6ab845" fill-opacity="1" d="M0,160L80,160C160,160,320,160,480,149.3C640,139,800,117,960,133.3C1120,149,1280,203,1360,229.3L1440,256L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
<div class="container">
<div class="mob-nav-head">
	<a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i></a><p><b>Rate List</b></p>
</div>
<div class="rate-list-head">
	<?php foreach ($category as $v): ?>
	<div class="rate-part">
		<i class="fas fa-long-arrow-alt-right fa-2x"></i>&nbsp;&nbsp;<h3><?= $v['cat_name'] ?></h3><br>
	</div>
	<div class="rate-category">
		<?php foreach ($v['rates'] as $rate): ?>
		<div class="rate-head">
			<p><?= $rate['item_name'] ?></p>
			<h6 class="text-center">&#8377; <?= $rate['item_rate'] ?> / kg</h6>
		</div>
		<?php endforeach ?>
	</div><br>
	<hr>
	<?php endforeach ?>
</div>
</div>