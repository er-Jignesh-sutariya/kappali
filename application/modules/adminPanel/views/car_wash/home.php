<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-2">
					<h5>List of <?= ucwords($title) ?></h5>
				</div>
			</div>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th class="target">Sr.</th>
							<th>Vehicle No.</th>
							<th>Payment ID</th>
							<th>Company</th>
							<th>Model</th>
							<th>Date</th>
							<th>Time</th>
							<th>Discount</th>
							<th class="target">Address</th>
							<th class="target">Invoice</th>
							<th class="target">Status</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>