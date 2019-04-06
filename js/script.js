'use strict'

//Preloader
var preloader = $('#spinner-wrapper');
$(window).on('load', function() {
    var preloaderFadeOutTime = 500;

    function hidePreloader() {
        preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
});

jQuery(document).ready(function($) {

    //Incremental Coutner
    if ($.isFunction($.fn.incrementalCounter))
        $("#incremental-counter").incrementalCounter();

    //For Trigering CSS3 Animations on Scrolling
    if ($.isFunction($.fn.appear))
        $(".slideDown, .slideUp").appear();

    $(".slideDown, .slideUp").on('appear', function(event, $all_appeared_elements) {
        $($all_appeared_elements).addClass('appear');
    });

    //For Header Appearing in Homepage on Scrolling
    var lazy = $('#header.lazy-load')

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 200) {
            lazy.addClass('visible');
        } else {
            lazy.removeClass('visible');
        }
    });

    //Initiate Scroll Styling
    if ($.isFunction($.fn.scrollbar))
        $('.scrollbar-wrapper').scrollbar();

    if ($.isFunction($.fn.masonry)) {

        // fix masonry layout for chrome due to video elements were loaded after masonry layout population
        // we are refreshing masonry layout after all video metadata are fetched.
        var vElem = $('.img-wrapper video');
        var videoCount = vElem.length;
        var vLoaded = 0;

        vElem.each(function(index, elem) {

            //console.log(elem, elem.readyState);

            if (elem.readyState) {
                vLoaded++;

                if (count == vLoaded) {
                    $('.js-masonry').masonry('layout');
                }

                return;
            }

            $(elem).on('loadedmetadata', function() {
                vLoaded++;
                //console.log('vLoaded',vLoaded, this);
                if (videoCount == vLoaded) {
                    $('.js-masonry').masonry('layout');
                }
            })
        });


        // fix masonry layout for chrome due to image elements were loaded after masonry layout population
        // we are refreshing masonry layout after all images are fetched.
        var $mElement = $('.img-wrapper img');
        var count = $mElement.length;
        var loaded = 0;

        $mElement.each(function(index, elem) {

            if (elem.complete) {
                loaded++;

                if (count == loaded) {
                    $('.js-masonry').masonry('layout');
                }

                return;
            }

            $(elem).on('load', function() {
                loaded++;
                if (count == loaded) {
                    $('.js-masonry').masonry('layout');
                }
            })
        });

    } // end of `if masonry` checking


    //Fire Scroll and Resize Event
    $(window).trigger('scroll');
    $(window).trigger('resize');
});

/**
 * function for attaching sticky feature
 **/

function attachSticky() {
    // Sticky Chat Block
    $('#chat-block').stick_in_parent({
        parent: '#page-contents',
        offset_top: 70
    });

    // Sticky Right Sidebar
    $('#sticky-sidebar').stick_in_parent({
        parent: '#page-contents',
        offset_top: 70
    });

}

// Disable Sticky Feature in Mobile
$(window).on("resize", function() {

    if ($.isFunction($.fn.stick_in_parent)) {
        // Check if Screen wWdth is Less Than or Equal to 992px, Disable Sticky Feature
        if ($(this).width() <= 992) {
            $('#chat-block').trigger('sticky_kit:detach');
            $('#sticky-sidebar').trigger('sticky_kit:detach');

            return;
        } else {

            // Enabling Sticky Feature for Width Greater than 992px
            attachSticky();
        }

        // Firing Sticky Recalculate on Screen Resize
        return function(e) {
            return $(document.body).trigger("sticky_kit:recalc");
        };
    }
});

// Fuction for map initialization
function initMap() {
  var uluru = {lat: 12.927923, lng: 77.627108};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: uluru,
    zoomControl: true,
    scaleControl: false,
    scrollwheel: false,
    disableDoubleClickZoom: true
  });
  
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}
//CUSTOM JS AJAX
function insertData(){
    var userName = $('#userName').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var pass = $('#pass').val();
var file = document.getElementById('myfile').files[0];
 if(file){
    if(file.size < 2097152) {
   } else {
     alert("File is  over 2Mb in size!");
     evt.preventDefault();
   }
 }    
    if(![userName,email,phone,pass].every(Boolean)){
        alert('All fields are required to submit.')
    }else{
  var formData = new FormData($("#insertDataForm")[0]);
$("#insertDataForm").get(0).reset();
    $('#userName').css("border-color", "#ddd");
    $('#email').css("border-color", "#ddd");
    $('#phone').css("border-color", "#ddd");
    $('#pass').css("border-color", "#ddd");
    $.ajax({
        url:'crud.php',
        dataType: 'text',
        data: formData,
        processData:false,   
        contentType: false,                   
        type: 'post',
        success: function(response,status){
        document.getElementById('alertmsg').innerHTML = response;
        $('#alert').modal('show');
        }
     });
    }
}
function loginUser(){
    $('#cerrors').addClass('hidden');
    $('#cerrors').css("border-color", "#fff");
    var formData = new FormData($("#loginForm")[0]);
$("#loginForm").get(0).reset();
    $.ajax({
        url:'crud.php',
        dataType: 'text',
        data: formData,
        processData:false,   
        contentType: false,                   
        type: 'post',
        success: function(response,status){
        document.getElementById('cerrors').innerHTML = response;
        $('#cerrors').removeClass('hidden');
        $('#cerrors').css({'border-color' : 'red','color' : 'red'});
        if(response == 'You are logged in!'){
        $('#cerrors').css({'border-color' : 'green','color' : 'green'});
            location.reload();
        }
        }
     });
}
function checkuserName(){
    $('#ferrors').addClass('hidden');
    var checkuserName = $('#userName').val();
    if(checkuserName.length >= 3){
        $.ajax({
            url:'crud.php',
            type:'POST',
            data:{checkuserName:checkuserName},
        success:function(response,status){
        if(response == "Username available."){
            $('#userName').css("border-color", "green");
        }else{
        document.getElementById('ferrors').innerHTML = response;
        $('#ferrors').removeClass('hidden');
        $('#ferrors').css({'border-color' : 'red','color' : 'red'});
        $('#userName').css("border-color", "red");
        }
        }
        });
    }else{
        $('#ferrors').html('User Name must be atleast 3 characters!');
        $('#ferrors').removeClass('hidden');
        $('#userName').css("border-color", "red");
    }
}
function validateEmail() {
   var email =  $('#email').val();
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function checkemail(){
    $('#ferrors').addClass('hidden');
    var checkemail= $('#email').val();
    if(validateEmail()){
        $.ajax({
            url:'crud.php',
            type:'POST',
            data:{checkemail:checkemail},
        success:function(response,status){
        if(response == "Email available."){
            $('#email').css("border-color", "green");
        }else{
        document.getElementById('ferrors').innerHTML = response;
        $('#ferrors').removeClass('hidden');
        $('#ferrors').css({'border-color' : 'red','color' : 'red'});
        $('#email').css("border-color", "red");
        }
        }
        });
    }else{
        $('#ferrors').html('Invalid Email!');
        $('#ferrors').removeClass('hidden');
        $('#email').css("border-color", "red");
    }
}
function validatephone() {
  var phone =  $('#phone').val();
  var re = /^[+]?(1\-|1\s|1|\d{3}\-|\d{3}\s|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/g;
  return re.test(phone);
}
function onlynumbers(){
  var phone =  $('#phone').val();
  return /^\d*$/.test(phone);
}
function checkphone(){
    $('#ferrors').addClass('hidden');
    var checkphone= $('#phone').val();
    if(onlynumbers() && checkphone.length > 9){
        $.ajax({
            url:'crud.php',
            type:'POST',
            data:{checkphone:checkphone},
        success:function(response,status){
        if(response == "Phone available."){
            $('#phone').css("border-color", "green");
        }else{
        document.getElementById('ferrors').innerHTML = response;
        $('#ferrors').removeClass('hidden');
        $('#ferrors').css({'border-color' : 'red','color' : 'red'});
        $('#phone').css("border-color", "red");
        }
        }
        });
    }else{
        $('#ferrors').html('Invalid phone number! Phone must be atleast 10 digits.');
        $('#ferrors').removeClass('hidden');
        $('#phone').css("border-color", "red");
    }
}
function validatePassword() {
    var pw = $('#pass').val();
    return /[A-Z]/       .test(pw) &&
           /[a-z]/       .test(pw) &&
           /[0-9]/       .test(pw) &&
           /[^A-Za-z0-9]/.test(pw) &&
           pw.length > 3;
}
function checkpass(){
    if(validatePassword()){
    $('#pass').css("border-color", "green");
    }else{
        $('#ferrors').html('Password must be contain  atleast one uppercase,<br> one lowercase letter, one digit, one special symbol.');
        $('#ferrors').removeClass('hidden');
        $('#pass').css("border-color", "red");   
    }
}
isOnline();
setInterval(function(){ 
    isOnline();
}, 5000);
function isOnline(){
    var isOnline="isOnline";
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{isOnline:isOnline},
        success:function(response,status){
            $('ul.online-users.list-inline').html(response);
        }
    });
}
$(document).ready(function(){
    $('#myimg').change(function(){
    var changeimgForm = new FormData($("#changeimgForm")[0]);
    $("#changeimgForm").get(0).reset();

    $.ajax({
        url:'crud.php',
        dataType: 'text',
        data: changeimgForm,
        processData:false,   
        contentType: false,                   
        type: 'post',
        success: function(response,status){
        if(response == "Profile pic updated!"){
            location.reload();
        }
        }
     });
    });
});