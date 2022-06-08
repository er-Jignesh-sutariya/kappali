<div class="card" id="print-area">
    <div class="row invoice-contact">
        <div class="col-md-8">
            <div class="invoice-box row">
                <div class="col-sm-12">
                    <table
                        class="table table-responsive invoice-table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?= base_url('assets/images/logo-tm.png') ?>" class="m-b-10" alt="logo-tm.png" width="200">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>123 6th St. Melbourne, FL 32904 West
                                Chicago, IL 60185</td>
                            </tr> -->
                            <tr>
                                <td>
                                    <a href="mailto:kappali.info@gmail.com"
                                        target="_top">kappali.info@gmail.com
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>+91 88666 79667</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="m-b-20">Invoice Date
            <span><?= date("d-m-Y") ?></span>
            </h6>
        </div>
    </div>
    <div class="card-block">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped invoice-detail-table">
                        <thead>
                            <tr class="thead-default">
                                <th class="col-1">Sr. #</th>
                                <th class="col-3">Name & Phone</th>
                                <th class="col-2">Address</th>
                                <th class="col-2">Products</th>
                                <th class="col-4">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $k => $v): ?>
                            <tr>
                                <td><?= ++$k ?></td>
                                <td><?= $v->name.' - '.$v->phone ?></td>
                                <td><?= "$v->app_no, $v->nearby, $v->society, $v->area" ?></td>
                                <td><?= $v->prods ?></td>
                                <td></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-12">
                <table
                    class="table table-responsive invoice-table invoice-total">
                    <tbody>
                        <tr>
                            <th>Sub Total :</th>
                            <td>$4725.00</td>
                        </tr>
                        <tr>
                            <th>Taxes (10%) :</th>
                            <td>$57.00</td>
                        </tr>
                        <tr>
                            <th>Discount (5%) :</th>
                            <td>$45.00</td>
                        </tr>
                        <tr class="text-info">
                            <td>
                                <hr />
                                <h5 class="text-primary">Total :</h5>
                            </td>
                            <td>
                                <hr />
                                <h5 class="text-primary">$4827.00</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-sm-12">
                <h6>Terms And Condition :</h6>
                <p>lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor </p>
            </div>
        </div> -->
    </div>
</div>