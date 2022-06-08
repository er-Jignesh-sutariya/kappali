<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-9">
					<h5>List of <?= ucwords($title) ?></h5>
				</div>
				<div class="col-3">
					<?= anchor($url.'/add', '<i class="fa fa-plus"></i>', 'class="btn btn-outline-success btn-round btn-block float-right col-12"') ?>
				</div>
			</div>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th class="target">Sr.</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Balance</th>
							<th class="target">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>