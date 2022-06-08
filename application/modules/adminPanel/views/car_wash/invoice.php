<hr>
<div style="text-align: center;">
    <img src="<?= base_url('assets/images/logo-tm.png') ?>" width="50%">
    <h3 class="text-center">INVOICE FOR CAR WASH</h3>
</div>
<hr>
<div style="text-align: right; padding:10px; font-size: 12px;">
    UAM NUMBER. - GJ-01-0016388 <br>
    CUSTOMER COPY
</div>
<table>
    <tbody>
        <tr>
            <td style="padding-bottom:10px;">DATE: <?= date('d/m/Y', strtotime($data['wash_date'])) ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">TIME: <?= $data['wash_time'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">NAME : <?= $data['user']['name'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">CO.NO : <?= $data['user']['phone'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">BILL NO : <?= d_id($id) ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">VEHICLE NO : <?= $data['vehicle_no'] ?> </td>
        </tr>
        <tr>
            <td style="padding-bottom:10px;">ADDRESS : <?= $data['user']['address'] ?> </td>
        </tr>
    </tbody>
</table>
<table style="width:100%;border: 1px solid #ccc;border-collapse: collapse;" cellpadding="8">
    <thead style="border: 1px solid #ccc;">
        <tr style="border: 1px solid #ccc;">
            <th style="border: 1px solid #ccc;">Sr. #</th>
            <th style="border: 1px solid #ccc;">COMPANY</th>
            <th style="border: 1px solid #ccc;">MODEL</th>
            <th style="border: 1px solid #ccc;">PAYMENT ID</th>
            <th style="border: 1px solid #ccc;">WASH</th>
            <th style="border: 1px solid #ccc;">DISCOUNT</th>
            <th style="border: 1px solid #ccc;">PRICE</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #ccc;">
        <?php $total = 0; foreach(json_decode($data['washes']) as $k => $wash): $total += $wash->rate ?>
        <tr>
            <td style="border: 1px solid #ccc;"><?= ++$k ?></td>
            <td style="border: 1px solid #ccc;"><?= $data['vehicle_company'] ?></td>
            <td style="border: 1px solid #ccc;"><?= $data['vehicle_model'] ?></td>
            <td style="border: 1px solid #ccc;"><?= $data['payment_id'] ?></td>
            <td style="border: 1px solid #ccc;"><?= $wash->wash ?></td>
            <td style="border: 1px solid #ccc;"><?= $data['discount'] ?></td>
            <td style="border: 1px solid #ccc;"><?= $wash->rate ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="7"  style="text-align: right; padding-right: 30px;">Discount : ₹ <?= $data['discount'] ?></td>
        </tr>
        <tr>
            <td colspan="7"  style="text-align: right; padding-right: 30px;">Total : ₹ <?= $total - $data['discount'] ?></td>
        </tr>
    </tbody>
</table>
<!-- <h6>• NOTE :</h6>
<p style="font-size: 11px;">• YOUR BILL WILL BE GENERATED ONLINE TO YOUR MOBILE NUMBER.</p>
<p style="font-size: 11px;">• YOUR BALANCE CREDITED TO THE KAPPALI APP. WHICH CAN BE REDEEM OR DONATE AS DESIRED. </p>
<p style="font-size: 11px;">• YOUR BALANCE WILL BE CREDITED TO DIRECTLY TO YOUR WALLET OR A/C. </p>
<p style="font-size: 11px;line-height: 1.8">• THE DONATED AMOUNT WILL BE USEFULL FOR TREE PLANTATION, INFORMATION ABOUT THE PROGRAM WILL BE GIVEN &nbsp;&nbsp;&nbsp;TO YOU ON YOUR REGISTER MOBILE. </p> -->
<br><br><br><br>
<div style="text-align: right">
    <span>Sign : <img src="<?= base_url('assets/images/logo-tm.png') ?>" width="20%"></span>
</div>
<br><br>
<div style="text-align: right; font-size: 12px;">
    <span>• ECO-FRINDLY SCRAP SELLING APPLICATION,THANKS FOR CHOOSING KAPPALI :  </span>
</div>
<br>
<div style="text-align: right; font-size: 11px; color: #444">
    <span>CO : 8866679667 </span> <br>
    <span>MAIL : KAPPALI.INFO@GMAIL.COM </span>
</div>