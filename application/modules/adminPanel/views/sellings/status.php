<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' Prices') ?></h5>
		</div>
		<div class="card-block">
		    <div class="row">
		        <div class="col-lg-2 col-md-2 col-sm-4 col-4" style="padding-bottom:10px">NAME : </div>
		        <div class="col-lg-10 col-md-10 col-sm-8 col-8"><?= $data['name'] ?></div>
		        <div class="col-lg-2 col-md-2 col-sm-4 col-4" style="padding-bottom:10px"><?php $area = $this->main->get('areas', 'CONCAT(area, " - ", pincode) area', ['id' => $data['area']]) ?>ADDRESS : </div>
		        <div class="col-lg-10 col-md-10 col-sm-8 col-8"><?= $data['address'] ?>, <?= $area['area'] ?></div>
		        <div class="col-lg-2 col-md-2 col-sm-4 col-4" style="padding-bottom:10px">CO.NO :</div>
		        <div class="col-lg-10 col-md-10 col-sm-8 col-8"><?= $data['phone'] ?></div>
		    </div>
			<!--<table>-->
			<!--	<tbody>-->
			<!--		<tr>-->
			<!--			<td style="padding-bottom:10px;">NAME : <?= $data['name'] ?> </td>-->
			<!--		</tr>-->
			<!--		<tr>-->
			<!--			<?php $area = $this->main->get('areas', 'CONCAT(area, " - ", pincode) area', ['id' => $data['area']]) ?>-->
			<!--			<td style="padding-bottom:10px; width: 100%;">ADDRESS : <?= $data['address'] ?>, <?= $area['area'] ?> </td>-->
			<!--		</tr>-->
			<!--		<tr>-->
			<!--			<td style="padding-bottom:10px;">CO.NO : <?= $data['phone'] ?> </td>-->
			<!--		</tr>-->
			<!--	</tbody>-->
			<!--</table>-->
			<?= form_open($url."/status/$id") ?>
			<input type="text" name="vendor_name" class="form-control col-6" placeholder="Enter vendor name" />
			<br>
			<div class="row">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Product/Item</th>
								<th>Rate</th>
								<th>KG</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rates as $rate): ?>
							<tr>
								<td><?= $rate['item_name'] ?></td>
								<td>₹ <?= $rate['item_rate'] ?></td>
								<td><?= form_input([
									'type' => 'number',
									'name' => 'prods['.$rate['id'].']',
									'value' => set_value('prods['.$rate['id'].']'),
									'class' => 'form-control form-control-round col-md-2',
									'id' => $rate['item_name'],
									'placeholder' => "KG"
								]) ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="col-12">
					<?= form_button([
					'content' => 'Save',
					'type'  => 'submit',
					'class' => 'btn btn-outline-info btn-round col-4'
					]) ?>
					<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-4']) ?>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>