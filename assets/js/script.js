"use strict"

var base_url = document.getElementById("base_url").value;

document.addEventListener('contextmenu', e => e.preventDefault());

function openNav() {
    document.getElementById("mySidepanel").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidepanel").style.width = "0";
}

$(document).ready(function(){
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                loop:false
            },
            600:{
                items:3,
                nav:false,
                loop:false
            },
            1000:{
                items:3,
                nav:false,
                loop:false
            }
        }
    });

    $('input[type=radio][name=payment]').change(function() {
        if (this.value == 'bank-transfer')
            $("#bank-transfer").fadeIn("slow");
        else
            $("#bank-transfer").fadeOut("slow");
    });

    $("#redeem-points").click(function(e) {
        e.preventDefault();
        let balance = ($('input[name=balance]').val()) ? $('input[name=balance]').val() : 0;
        let bal = parseInt(balance);
        
        if (bal > 0) {
            let data = {
                balance: balance,
                payment: $('input[type=radio][name=payment]:checked').val(),
                bank_acc: ($('input[name=bank_acc]').val()) ? $('input[name=bank_acc]').val() : 'NA',
                bank_ifsc: ($('input[name=bank_ifsc]').val()) ? $('input[name=bank_ifsc]').val() : 'NA',
                bank_mobile: ($('input[name=bank_mobile]').val()) ? $('input[name=bank_mobile]').val() : 'NA',
                bank_name: ($('input[name=bank_name]').val()) ? $('input[name=bank_name]').val() : 'NA'
            };

            $.ajax({
                type: "POST",
                url: `${base_url}add-point`,
                data: data,
                cache: false,
                success: function(msg){
                toastr.info(msg);
                setTimeout(function(){ 
                    if (data.balance > 0)
                        window.location = `${base_url}`;
                        // window.location = `${base_url}thankyou`;
                    else
                        window.location = `${base_url}`;
                        // window.location = `${base_url}paymentThankyou`;
                }, 2000);
                }
            });
        }else{
            toastr.info("Your kappali balance is low.");
            return false;
        }
    });

    if ($("#toastr").val()) 
        toastr.info($("#toastr").val());
});

function saveProds()
{
    let prods = [];
    $(':checkbox:checked').each(function(i){
        prods[i] = $(this).val();
    });
    if(prods.length > 0){
        $.ajax({
            type: "POST",
            url: `${base_url}saveProds`,
            data: {prods:prods},
            cache: false,
            success: function(msg){
                // window.location = `${base_url}continue-form`;
                window.location = `${base_url}continue-success`;
            }
        });
    }else{
        toastr.info("Select product first.");
    }
}

function shareApp()
{
    if (navigator.canShare)
        navigator.share({ title: 'Kappali', text: 'No dustbin say recycle bin', url: 'https://play.google.com/store/apps/details?id=com.kappali.kappali'});
    else
        window.AndroidShareHandler.share('https://play.google.com/store/apps/details?id=com.kappali.kappali');
}


/* const pk = new PayKun({ merchantId : "544987822992243", accessToken: "8E8CD7D9C1736E9470BA229839003677", isLive: false});
function initPayment(amount) {
    let order = {
        amount: amount, 
        orderId: "ORD" + (new Date).getTime(),
        productName: "Mobile",
        customerName: "Test name",
        customerEmail: "test@gmail.com",
        customerMobile: "9999999999",
        currency: "INR",
        onSuccess: function (transactionId) {
            var transaction = pk.getTransactionDetail(transactionId, function(transaction) {
                console.log(transaction);
                alert('Payment is success, Your transaction ID : ' + transaction.transaction.payment_id);
            });
        },
        onCancelled: function (transactionId) {
            var transaction = pk.getTransactionDetail(transactionId, function(transaction) {
                console.log(transaction);
                alert('Payment is cancelled, Your transaction ID : ' + transaction.transaction.payment_id);
            });
        }
    };
    console.log(order)
    pk.init(order);
} */