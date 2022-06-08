<hr>
<div style="text-align: center;">
    <img src="<?= base_url('assets/images/logo-tm.png') ?>" width="50%">
</div>
<div style="text-align: right; padding:10px; font-size: 12px;">
    UAM NUMBER. - GJ-01-0016388
</div>
<hr>
<h3 class="text-center" style="text-align:center;">ESTIMATED VALUE OF SCRAP</h3>

<!-- <div style="text-align: right; padding:10px; font-size: 12px;">
    
    UAM NUMBER. - GJ-01-0016388 <br>
    CUSTOMER COPY
</div> -->
<div style="text-align: right; padding:10px; font-size: 12px;">
    CUSTOMER COPY
</div>
<table>
    <tbody>
        <tr>
            <td style="padding-bottom:10px;">DATE: <?= date('d/m/Y') ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">NAME : <?= $data['name'] ?> </td>
        </tr>
        <tr>
            <?php $area = $this->main->get('areas', 'CONCAT(area, " - ", pincode) area', ['id' => $data['area']]) ?>
            <td style="padding-bottom:10px;">ADDRESS : <?= $data['address'] ?>, <?= $area['area'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">CO.NO : <?= $data['phone'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">BILL NO : <?= d_id($id) ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">PRODUCTS : <?= $data['prods'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">VENDOR : <?= $data['vendor_name'] ?> </td>
        </tr>
    </tbody>
</table>
<table style="width:100%;border: 1px solid #ccc;border-collapse: collapse;" cellpadding="8">
    <thead style="border: 1px solid #ccc;">
        <tr style="border: 1px solid #ccc;">
            <th style="border: 1px solid #ccc;">Sr. #</th>
            <th style="border: 1px solid #ccc;">Product / Item</th>
            <th style="border: 1px solid #ccc;">KG</th>
            <th style="border: 1px solid #ccc;">Rate</th>
            <th style="border: 1px solid #ccc;">Total</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #ccc;">
        <?php $total = 0; foreach ($recieved_items as $k => $v): $total += $v->rec_kg * $v->rate; ?>
        <tr>
            <td style="border: 1px solid #ccc;"><?= ++$k ?></td>
            <td style="border: 1px solid #ccc;"><?= $v->item ?></td>
            <td style="border: 1px solid #ccc;"><?= $v->rec_kg ?></td>
            <td style="border: 1px solid #ccc;">₹ <?= $v->rate ?></td>
            <td style="border: 1px solid #ccc;">₹ <?= $v->rec_kg * $v->rate ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="5"  style="text-align: right; padding-right: 30px;">Total : ₹ <?= $total ?></td>
        </tr>
    </tbody>
</table>
<h6>• NOTE :</h6>
<p style="font-size: 11px;">• YOUR BILL WILL BE GENERATED ONLINE TO YOUR MOBILE NUMBER.</p>
<p style="font-size: 11px;">• YOUR BALANCE CREDITED TO THE KAPPALI APP. WHICH CAN BE REDEEM OR DONATE AS DESIRED. </p>
<p style="font-size: 11px;">• YOUR BALANCE WILL BE CREDITED TO DIRECTLY TO YOUR WALLET OR A/C. </p>
<p style="font-size: 11px;line-height: 1.8">• THE DONATED AMOUNT WILL BE USEFULL FOR TREE PLANTATION, INFORMATION ABOUT THE PROGRAM WILL BE GIVEN &nbsp;&nbsp;&nbsp;TO YOU ON YOUR REGISTER MOBILE. </p>
<br><br>
<div style="text-align: right">
    <span>Sign : <img src="<?= base_url('assets/images/logo-tm.png') ?>" width="20%"></span>
</div>
<br><br>
<div style="text-align: right; font-size: 12px;">
    <span>• ECO-FRINDLY SCRAP SELLING APPLICATION,THANKS FOR CHOOSING KAPPALI :  </span>
</div>

<div style="text-align: right; font-size: 11px; color: #444">
    <span>CO : 8866679667 </span> <br>
    <span>MAIL : KAPPALI.INFO@GMAIL.COM </span>
</div>