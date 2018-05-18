jQuery(document).ready(function($){
    jQuery.ajaxSetup({async:false});
    $(document).ajaxStart(function () {
        $('body').css('cursor', 'wait');
    });
    $(document).ajaxStop(function () {
        $('body').css('cursor', 'auto');
    });

    $( window ).load(function() {
        $( "input[name='fodselsnr']" ).focus();
        $('#editable-select').editableSelect();
    });

    $('#helseskjema').validate({
        lang: 'no'
        , onfocusout: false
        , onkeyup: false
        });

    var dbErrorDefault = "Invalid Social Security Number"
    var dbError = dbErrorDefault

    $.validator.addMethod("fodselsnr", function(fodselsnr) {
        var ssnValid = false;
        var personnummer = jQuery("input[name=personnummer]").val()

        jQuery.get("helseskjema.php", {'fodselsnr': fodselsnr
            , 'personnummer': personnummer
        }).done(function(data){
            helseskjema = JSON.parse(data)
            if (helseskjema.Success) {
                var pasient = helseskjema.pasient;
                var medisinKey = "medisin";
                for (var name in pasient) {
                    var value = pasient[name];
                    if (name == medisinKey) {
                        medisins = value;
                        $("select" + "#" + medisinKey).val(medisins);
                        // tell the multi select js plugin about the change
                        $("#medisin").trigger("chosen:updated");
                    }
                    $("input:text[name=" + name + "]").val(value);
                    $("input[type='email'][name=" + name + "]").val(value);
                    if (value == "T") {
                        $("input:checkbox[name=" + name + "]").iCheck('check');
                    }
                }
                ssnValid = true
            } else if (helseskjema.Error) {
                dbError = decodeHtml(helseskjema.Error)
            } else {
                dbError = dbErrorDefault
            }
        })
        return ssnValid;
    }, function(){
        return dbError;
    });

    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }

    $("#medisin").chosen({
        'search_contains': true
    });

    // process the form
    $('form#helseskjema').submit(function(event) {

        $('[name="process"]').attr('disabled','disabled');

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'helseskjema_submit.php', // the url where we want to POST
            data        : $(this).serialize(), // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            , beforeSend: function() {
                $('[data-loader="circle-side"]').fadeIn();
                $('#preloader').delay(350).fadeIn();
            }
            , async : true
        })
        // using the done promise callback
        .done(function(data) {
            $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('[name="process"]').removeAttr('disabled');
            if (data.Success)
                location.reload();
            else if (data.Error) {
                $("#submit-error label.submit-error").html(data.Error);
            }
        });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
})