<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-6">
					<h5>List of <?= ucwords($title) ?></h5>
				</div>
				<?php if (in_array($this->role, ['Super admin', 'Admin'])): ?>
				<div class="col-3">
					<?= anchor($url.'/print', '<i class="fa fa-print"></i>', 'class="btn btn-outline-success btn-round btn-block float-right col-12"') ?>
				</div>
				<div class="col-3">
					<?= anchor($url.'/add', '<i class="fa fa-plus"></i>', 'class="btn btn-outline-success btn-round btn-block float-right col-12"') ?>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th class="target">Sr.</th>
							<th class="target">Action</th>
							<th>Status</th>
							<th>Order Type</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Products</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>