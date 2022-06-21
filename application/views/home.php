<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid" style="background-color: #6ab845;">
	<div class="ct-us pt-3">
		<!-- <a href="tel:8866679667" class="text-dark">Contact us - 88666 79667</a> -->
		Contact us - 88666 79667
	</div>
	<div class="upcoming-btn">
		<a href="<?= base_url('upcoming') ?>"><img src="<?= base_url('assets/images/sprout.png') ?>" alt="coming soon"></a>
	</div><br>
	<div class="header">
		<i class="fas fa-user-circle fa-lg"></i><h5>Hi, <?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?> </h5><h5 class="pl-4 ml-3">Your cust ID - <?= $this->session->phone ?></h5>
		<!-- <i class="fas fa-user-circle fa-lg"></i><h5>Hi, <?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?></h5> -->
	</div>
	<div class="pointpart mt-4">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center">
				<div class="bal-part">
					<h4><b>Kappali balance</b></h4>
					<p><?= $this->balance ?></p>
					<a href="<?= base_url('car-wash') ?>"><button class="btn btn-primary"><i class="fas fa-minus-circle"></i>Redeem</button></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center">
				<div class="point-part">
					<h4><b>Car Washing</b></h4>
					<i class="fas fa-car" style="font-size:22px;"></i><br>
					<a href="<?= base_url('car-wash') ?>"><button class="btn btn-primary mt-2"><i class="fas fa-car"></i>Car washing</button></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<marquee><p>Note - This service is available only in Ahmedabad. Temporary scrap service is barred or unavailable.</p></marquee>
	<div class="ct-us-web">
		<a href="tel:8866679667" class="text-white">Contact us - 88666 79667</a>
	</div>
	<div class="web-cont">
		<div class="header">
			<i class="fas fa-user-circle fa-lg"></i><h5>Hi, <?= ucfirst($this->session->fname).' '.ucfirst($this->session->lname) ?> (Your cust ID - <?= $this->session->phone ?>)</h5>
		</div>
		<div class="pointpart">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-6">
					<div class="bal-part">
						<h4>Kappali balance</h4>
						<p><?= $this->balance ?></p>
						<a href="<?= base_url('car-wash') ?>"><button class="btn btn-primary"><i
									class="fas fa-minus-circle"></i>Redeem</button></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-6">
					<div class="point-part">
						<h4>Car Washing</h4>
						<i class="fas fa-car fa-lg"></i>
						<br>
						<a href="<?= base_url('car-wash') ?>"><button class="btn btn-primary mt-2"><i class="fas fa-car"></i>Car washing</button></a>
					</div>
				</div>
			</div>
		</div>
	</div><br class="point-br"><hr class="point-hr">
	<div class="sellpart">
		<h4>What would you like to sell?</h4><br class="point-br">
			<div class="products">
				<div class="product">
					<div class="custom-control custom-checkbox image-checkbox">
						<input type="checkbox" class="custom-control-input" id="ck1a" name="product[]" value="newspaper" disabled>
						<label class="custom-control-label" for="ck1a">
							<div class="prod-img text-center">
								<img src="<?= base_url('assets/images/newspaper-wh.png') ?>" alt="newspaper">
							</div>
						</label>
					</div>
					<div class="product-desc">
						<h6 class="text-center">Paper</h6>
						<p>Newspapers,<br>Cartons, etc.</p>
					</div>
				</div>
				<div class="product">
					<div class="custom-control custom-checkbox image-checkbox">
						<input type="checkbox" class="custom-control-input" id="ck1b" name="product[]" value="plastic" disabled>
						<label class="custom-control-label" for="ck1b">
							<img src="<?= base_url('assets/images/plastic-wh.png') ?>" alt="plastic">
						</label>
					</div>
					<div class="product-desc">
						<h6 class="text-center">Plastic</h6>
						<p>Oil-container,<br>Plastic, etc.</p>
					</div>
				</div>
				<div class="product">
					<div class="custom-control custom-checkbox image-checkbox">
						<input type="checkbox" class="custom-control-input" id="ck1c" name="product[]" value="metal" disabled>
						<label class="custom-control-label" for="ck1c">
							<img src="<?= base_url('assets/images/scrap-wh.png') ?>" alt="metal">
						</label>
					</div>
					<div class="product-desc">
						<h6 class="text-center">Metal</h6>
						<p>Iron, Brass<br>Copper, etc.</p>
					</div>
				</div>
				<div class="product">
					<div class="custom-control custom-checkbox image-checkbox">
						<input type="checkbox" class="custom-control-input" id="ck1d" name="product[]" value="e-waste" disabled>
						<label class="custom-control-label" for="ck1d">
							<img src="<?= base_url('assets/images/electronic-wh.png') ?>" alt="e-waste">
						</label>
					</div>
					<div class="product-desc">
						<h6 class="text-center">E-Waste</h6>
						<p>Computers,<br>Keyboards, etc.</p>
					</div>
				</div>
				<div class="product">
					<div class="custom-control custom-checkbox image-checkbox">
						<input type="checkbox" class="custom-control-input" id="ck1e" name="product[]" value="other" disabled>
						<label class="custom-control-label" for="ck1e">
							<img src="<?= base_url('assets/images/electronics-wh.png') ?>" alt="other items">
						</label>
					</div>
					<div class="product-desc">
						<h6 class="text-center">Other Items</h6>
						<p>Glass, bottles,<br>Machines, etc.</p>
					</div>
				</div>
			</div>
		</div><br>
		<button class="btn btn-success continue-btn" type="button" disabled onclick="saveProds()">Continue</button>
		<div class="selling-note mt-5">
			<p>Note - We don't buy wood, cloth and glass.</p>
		</div>
	<br><br>
	<hr>
	<div class="article-part">
		<h4>Article</h4>
		<div class="article-list">
			<div class="owl-carousel">
				<?php foreach ($articles as $k => $v): ?>
				<a href="<?= base_url('article/'.my_crypt($v['id'])) ?>">
					<div class="article">
						<div class="article-img">
							<?= img(['src' => $v['image']]) ?>
						</div>
						<div class="article-text">
							<p><?= mb_substr(strip_tags($v['details']), 0, 150) ?></p>
						</div>
					</div>
				</a>
				<?php endforeach ?>
			</div>
		</div>
	</div><br class="point-br"><hr><br>
	<div class="text-center">
		<iframe width="100%" src="https://www.youtube.com/embed/YyKcv1ABMug" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<br class="point-br"><hr><br>
	<div class="vector-menu text-center">
		<ul>
			<li>Authorized <br>recycle<br><img src="<?= base_url('assets/images/recycle.png') ?>"></li>
			<li>Trusted <br>person<br><img src="<?= base_url('assets/images/user.png') ?>"></li>
			<li>Plantation<br><br><img src="<?= base_url('assets/images/nature.png') ?>"></li>
			<li>Earn <br>money<br><img src="<?= base_url('assets/images/salary.png') ?>"></li>
			<li>Easy <br>access app	<br><img src="<?= base_url('assets/images/click.png') ?>"></li>
		</ul>
	</div><hr class="point-hr"><br>
	<div class="contact-details text-center">
		<p>Contact us - 88666 79667 / Email - kappali.info@gmail.com</p>
	</div><br>
</div>