jQuery(document).ready(function () {
    jQuery("#pre").click(function(){
        jQuery("#home").css('background','url(images/slide_1.jpg) no-repeat center center/cover');
        jQuery("#slider-heading").html('Hello guys');
        jQuery("#slider-para").html('This looks awesome');
    });
    jQuery("#mid").click(function(){
        jQuery("#home").css('background','url(images/slide_2.jpg) no-repeat center center/cover');
        jQuery("#slider-heading").html('Enjoy this website');
        jQuery("#slider-para").html('Manage your own website');
    });
    jQuery("#next").click(function(){
        jQuery("#home").css('background','url(images/slide_3.jpg) no-repeat center center/cover');
        jQuery("#slider-heading").html('Code with us');
        jQuery("#slider-para").html('Enjoy and feels your coding skills');
    });
})

var slider = 0;
var s = 1000;
while(slider<100){
    setTimeout(() => {
        home.style.background = 'url(images/slide_1.jpg) no-repeat center center/cover';
        document.getElementById('slider-heading').innerHTML = "Hello guys";
        document.getElementById('slider-para').innerHTML = "This looks awesome";
    }, 0+s);

    setTimeout(() => {
        home.style.background = 'url(images/slide_2.jpg) no-repeat center center/cover';
        document.getElementById('slider-heading').innerHTML = "Enjoy this website";
        document.getElementById('slider-para').innerHTML = "Manage your own website";
    }, 5000+s);
    
    setTimeout(() => {
        home.style.background = 'url(images/slide_3.jpg) no-repeat center center/cover';
        document.getElementById('slider-heading').innerHTML = "Code with us";
        document.getElementById('slider-para').innerHTML = "Enjoy and feels your coding skills";
    }, 10000+s);
    s = 15000+s;
    slider+=1;
}

function user_register() {
    jQuery('.field_error').html('');
    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var password = jQuery("#password").val();
    var mobile = jQuery("#mobile").val();
    var is_error='';
    if (name == '') {
        jQuery("#name_err").html('Please enter name');
        is_error='yes';
    }
    if (email == '') {
        jQuery("#email_err").html('Please enter email');
        is_error='yes';
    }
    if (password == '') {
        jQuery("#pass_err").html('Please enter password');
        is_error='yes';
    }
    if (mobile == '') {
        jQuery("#mobile_err").html('Please enter mobile number');
        is_error='yes';
    }
    if (is_error == '') {
        jQuery.ajax({
            url: 'register_submit.php',
            type: 'post',
            data: 'name=' + name + '&password=' + password + '&email=' + email + '&mobile=' + mobile,
            success: function(result) {
                if (result == 'email_present') {
                    jQuery("#email_err").html('Email id already present.');
                }
                if (result == 'insert') {
                    jQuery("#register_msg").html('Thank you for registration.');
                }
            }
        })
    }
}

function user_login() {
    jQuery('.field_error').html('');
    var email = jQuery("#login_email").val();
    var password = jQuery("#login_password").val();
    var is_error='';
    if (email == '') {
        jQuery("#email_error").html('Please enter email');
        is_error='yes';
    }
    if (password == '') {
        jQuery("#pass_error").html('Please enter password');
        is_error='yes';
    }
    if (is_error == '') {
        jQuery.ajax({
            url: 'login_submit.php',
            type: 'post',
            data: 'email=' + email + '&password=' + password, 
            success: function(result) {
                if (result == 'wrong') {
                    jQuery("#login_msg").html('Please enter valid login details.');
                }
                if (result == 'valid') {
                    window.location.href = window.location.href;
                }
            }
        })
    }
}

function manage_cart(pid,qty,type) {
    if (type == 'update') {
        var qty = jQuery("#"+pid+"qty").val();
    }else if (qty != '') {
        var qty = qty;
    }else {
        var qty = jQuery("#qty").val();   
    }
    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
        success: function (result) {
            if (type == 'update' || type == 'remove'){
                window.location.href = window.location.href;
            }
            jQuery('.notify').html(result);
        }
    });
}

function sort_product_drop(cat_id,site_path) {
    var sort_product_id = jQuery("#sort_product_id").val();
    window.location.href = site_path + "categories.php?id=" + cat_id + "&sort=" + sort_product_id;
}

function wishlist_manage(pid,type) {
    jQuery.ajax({
        url: 'wishlist_manage.php',
        type: 'post',
        data: 'pid=' + pid + '&type=' + type,
        success: function (result) {
            if (result == 'not_login'){
                window.location.href = 'login.php';
            } else {
                jQuery('.wishes').html(result);
            }
        }
    });
}

jQuery(document).ready(function(){
    jQuery("#plus").click(function(){
        jQuery("#collapseOne").toggle();
        jQuery('#plus span').toggleClass('fa-minus').toggleClass("fa-plus");
        
    });

    jQuery("#plus1").click(function(){
        jQuery("#collapseTwo").toggle();
        jQuery('#plus1 span').toggleClass('fa-minus').toggleClass("fa-plus");
    });

    jQuery("#plus2").click(function(){
        jQuery("#collapseThree").toggle();
        jQuery('#plus2 span').toggleClass('fa-minus').toggleClass("fa-plus");
    });

    jQuery("#search_btn").click(function(){
        jQuery("#search_bar div").removeClass("search_action");
    });
    
    jQuery("#hide").click(function () {
        jQuery("#side_bar").toggle();
    });
});