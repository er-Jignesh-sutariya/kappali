<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-3" onclick="window.location = '<?= base_url(admin('article')) ?>'">
	<div class="card bg-c-yellow text-white">
		<div class="card-block">
			<div class="row align-items-center">
				<div class="col">
					<p class="m-b-5">Articles</p>
					<h4 class="m-b-0"><?= $article ?></h4>
				</div>
				<div class="col col-auto text-right">
					<i class="feather icon-file-minus f-50 text-c-yellow"></i>
				</div>
			</div>
		</div>
	</div>
</div>