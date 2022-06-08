<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5><?= ucwords($operation . ' ' . $title) ?></h5>
        </div>
        <div class="card-block">
            <?= form_open() ?>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?= form_input('trans_id', set_value('trans_id'), 'class="form-control form-control-round" id="trans_id" placeholder="Transaction ID"') ?>
                        <?= form_error('trans_id') ?>
                    </div>
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