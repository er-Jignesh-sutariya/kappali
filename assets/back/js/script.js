"use strict";
$(document).ready(function() {
    var input = $("form").first().find(':input').first().attr('name');
    $(`input[name='${input}']`).first().focus();
    $(".date-filter").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c", 
        dropBorder: "1px solid #1abc9c"
    });

    var elemprimary = document.querySelector('.js-info');
    if (elemprimary !== null)
        var switchery = new Switchery(elemprimary, { color: '#62d1f3', jackColor: '#fff' });

    var $window = $(window);
    //add id to main menu for mobile menu start
    var getBody = $("body");
    var bodyClass = getBody[0].className;
    $(".main-menu").attr('id', bodyClass);
    //add id to main menu for mobile menu end

    // card js start
    $(".card-header-right .close-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').animate({
            'opacity': '0',
            '-webkit-transform': 'scale3d(.3, .3, .3)',
            'transform': 'scale3d(.3, .3, .3)'
        });

        setTimeout(function() {
            $this.parents('.card').remove();
        }, 800);
    });

    $(".card-header-right .minimize-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        var card = $(port).children('.card-block').slideToggle();
        $(this).toggleClass("icon-minus").fadeIn('slow');
        $(this).toggleClass("icon-plus").fadeIn('slow');
    });
    $(".card-header-right .full-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("icon-maximize");
        $(this).toggleClass("icon-minimize");
    });

    $("#more-details").on('click', function() {
        $(".more-details").slideToggle(500);
    });
    $(".mobile-options").on('click', function() {
        $(".navbar-container .nav-right").slideToggle('slow');
    });
    // card js end
    $.mCustomScrollbar.defaults.axis = "yx";
    $("#styleSelector .style-cont").slimScroll({
        setTop: "10px",
        height:"calc(100vh - 440px)",
    });
    $(".main-menu").mCustomScrollbar({
        setTop: "10px",
        setHeight: "calc(100% - 80px)",
    });
    /*chatbar js start*/

    /*chat box scroll*/
    var a = $(window).height() - 80;
    $(".main-friend-list").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5,
        color: '#1b8bf9'
    });

    // search
    $("#search-friends").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    // open chat box
    $('.displayChatbox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat').toggle('slide', options, 500);
    });


    //open friend chat
    $('.userlist-box').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
    });
    //back to main chatbar
    $('.back_chatBox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    // /*chatbar js end*/
    $(".search-btn").on('click', function() {
        $(".main-search").addClass('open');
        $('.main-search .form-control').animate({
            'width': '200px',
        });
    });
    $(".search-close").on('click', function() {
        $('.main-search .form-control').animate({
            'width': '0',
        });
        setTimeout(function() {
            $(".main-search").removeClass('open');
        }, 300);
    });
    $('#mobile-collapse i').addClass('icon-toggle-right');
    $('#mobile-collapse').on('click', function() {
        $('#mobile-collapse i').toggleClass('icon-toggle-right');
        $('#mobile-collapse i').toggleClass('icon-toggle-left');
    });
});
$(document).ready(function() {
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $('.theme-loader').fadeOut('slow', function() {
        $(this).remove();
    });
});

// toggle full screen
function toggleFullScreen() {
    var a = $(window).height() - 10;
    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
    $('.full-screen').toggleClass('icon-maximize');
    $('.full-screen').toggleClass('icon-minimize');
}

var script = {
  logout: function() {
    swal({
        title: "Are you sure?",
        text: "Are you sure to logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-outline-danger",
        confirmButtonText: "Yes",
        cancelButtonText: 'No',
        closeOnConfirm: false
    },
    function(){
        window.location = $('#logout').attr('href');
    });
  },
  delete: function(id) {
    swal({
        title: "Are you sure?",
        text: "Are you sure remove this item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-outline-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: 'No',
        closeOnConfirm: false
    },
    function(){
        $("#"+id).submit();
    });
  },
  active: function(id) {
    swal({
        title: "Are you sure?",
        text: "Are you sure to change active status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-outline-danger",
        confirmButtonText: "Yes",
        cancelButtonText: 'No',
        closeOnConfirm: false
    },
    function(){
        $("#"+id).submit();
    });
  },
  uploadImage: function() {
    $('#imageUploadForm').submit();
  },
  showImages: function(id) {
    $.ajax({
        type:'POST',
        url: $('#base_url').val()+'gallery/showImages/'+$('#upload-id').val(),
        cache:false,
        success:function(data){
            $('#uploaded-images').html(data);
        },
        error: function(data){
            $('#uploaded-images').html('<li class="col-12"><h6>No Image uploaded.</h6></li>');
        }
    });
  },
  removeImage: function(id, image) {
    swal({
        title: "Are you sure?",
        text: "Are you sure to remove this image?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-outline-danger",
        confirmButtonText: "Yes",
        cancelButtonText: 'No',
        closeOnConfirm: false
    },
    function(){
        $.ajax({
            type:'POST',
            url: $('#base_url').val()+'gallery/removeImage',
            data: {id: id, image:image},
            dataType: 'json',
            cache:false,
            success:function(data){
                show(id);
                if (data.error === false)  swal("Done!", data.message, "success");
                else swal("Error!", data.message, "error");
            },
            error: function(data){
                show(id);
            }
        });
    });
  },
};

function show(id)
{
    script.showImages(id);
}

$('#imageUploadForm').on('submit',(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success:function(data){
            show($('#upload-id').val());
            if (data.error === false)  swal("Done!", data.message, "success");
            else swal("Error!", data.message, "error");
        },
        error: function(data){
            swal("Sorry!", "Something is not going good. Please try later.", "error");
        }
    });
}));