<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-10">
					<h5>Download Invoice</h5>
				</div>
			</div>
		</div>
		<div class="card-block row">
			<div class="col-lg-3 col-md-3 col-sm-5 col-5">
				<?= anchor("$url/download/$id", '<i class="fa fa-print"></i>', 'class="btn btn-outline-success btn-round btn-block col-12"') ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-7 col-7">
				<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-10']) ?>
			</div>
		</div>
	</div>
</div>