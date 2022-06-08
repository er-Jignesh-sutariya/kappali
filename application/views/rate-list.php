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
        <!-- <div class="car-ratelist">
            <p>Rates list - </p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Car type</th>
                        <th scope="col">Interior</th>
                        <th scope="col">Exterior</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rates as $rate): ?>
                    <tr>
                        <td><?= $rate['item_name'] ?></td>
                        <td>&#8377; <?= $rate['item_rate'] ?></td>
                        <td>&#8377; <?= $rate['exterior_rate'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div> -->
        <div class="coupen-code">
            <p>Available Coupons - </p>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach($coupons as $k => $c): ?>
                    <div class="carousel-item <?= $k === 0 ? 'active' : '' ?>">
                        <?= img(['src' => "assets/images/article/".$c['image'], 'class' => "d-block w-100"]) ?>
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
        </div><br>
        <form method="post">
            <!-- <div class="rate-category">
                <?php foreach(['Interior', 'Exterior'] as $int): $type = $int == 'Interior' ? 'item_rate' : 'exterior_rate' ?>
                    <?php foreach($rates as $rate): ?>
                    <div class="rate-head">
                        <div class="custom-control custom-checkbox image-checkbox text-center">
                            <input type="checkbox" class="custom-control-input" id="ck1a_<?= $rate['item_name'].' - '.$int ?>" name="rate_id[]" value="<?= e_id($rate['id']).' - '.$int ?>">
                            <label class="custom-control-label" for="ck1a_<?= $rate['item_name'].' - '.$int ?>">
                                <p?><?= $rate['item_name'].' - '.$int ?><br><br>&#8377; <?= $rate[$type] ?></p>
                            </label>
                        </div>
                    </div>
                    <?php endforeach ?>
                <?php endforeach ?>
            </div> -->
            <!-- <?= form_error('rate_id[]') ?> -->
            <div class="form-group">
                <label class="from-control-label" for="rate_id[]">Select service</label><br>
                <select name="rate_id[]" class="form-control car-select" id="rate_id" multiple>
                    <?php foreach($rates as $rate): ?>
                        <?php foreach(['Interior', 'Exterior'] as $int): $type = $int == 'Interior' ? 'item_rate' : 'exterior_rate' ?>
                        <option value="<?= e_id($rate['id']).' - '.$int ?>"><?= $rate['item_name'].' - '.$int.' - ₹ '.$rate[$type] ?></option>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </select>
                <?= form_error('rate_id[]') ?>
            </div>
            <div class="form-group mt-4">
                <label for="coupon_code">Enter coupon code</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
                <?= form_error('coupon_code') ?>
            </div>
            <button class="btn btn-success" type="submit">Pay</button>
        </form>
	</div>
    <hr>
    <div class="text-center">
        <iframe width="100%" src="https://www.youtube.com/embed/bf1kqtPvc2c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <hr>
    <div class="vector-menu text-center mb-3">
		<ul>
			<li>Waterless<br> <br><img src="<?= base_url('assets/images/save-water.png') ?>"></li>
			<li>Branded <br>products<br><img src="<?= base_url('assets/images/gift.png') ?>"></li>
			<li>Anytime <br>Anywhere<br><img src="<?= base_url('assets/images/time-check.png') ?>"></li>
			<li>Low rate<br><br><img src="<?= base_url('assets/images/rating.png') ?>"></li>
			<li>Trained <br>staff<br><img src="<?= base_url('assets/images/staff.png') ?>"></li>
		</ul>
	</div>
</div>
