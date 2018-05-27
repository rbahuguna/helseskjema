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
    });

    $('#helseskjema').validate({
        lang: 'no'
        , onfocusout: false
        , onkeyup: false
        });

    var dbErrorDefault = "Invalid Social Security Number"
    var dbError = dbErrorDefault

    var findUsKey = "find-us";
    var findUsSelector = "#" + findUsKey;
    var medisinKey = "medisin";
    var medisinSelector = "#" + medisinKey;

    $.validator.addMethod("fodselsnr", function(fodselsnr) {
        var ssnValid = false;
        var personnummer = jQuery("input[name=personnummer]").val()

        jQuery.get("helseskjema.php", {'fodselsnr': fodselsnr
            , 'personnummer': personnummer
        }).done(function(data){
            helseskjema = JSON.parse(data)
            if (helseskjema.Success) {
                var pasient = helseskjema.pasient;
                for (var name in pasient) {
                    var value = pasient[name];
                    if (name == findUsKey) {
                        var valuesObject = value.map(function(value){
                            return {"id": value, "title": value};
                        });
                        findUsSelectize.addOption(valuesObject);
                        findUsSelectize.setValue(value);
                    } else if (name == medisinKey) {
                        var medisins = value;
                        var medisinsObject = medisins.map(function(medisin){
                            return {"title": medisin}
                        });
                        medisinSelectize.addOption(medisinsObject);
                        medisinSelectize.setValue(medisins);
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

    // process the form
    $('[name="process"]').click(function(event) {

        $(this).attr('disabled','disabled');

        var submitButton = $(this);
        var form = $($(this)[0].form);

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'helseskjema_submit.php', // the url where we want to POST
            data        : form.serialize(), // our data object
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
            submitButton.removeAttr('disabled');
            if (data.Success)
                location.reload();
            else if (data.Error) {
                $("#submit-error label.submit-error").html(data.Error);
            }
        });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

    findUsSelectize = $(findUsSelector).selectize({
        create: true
        , plugins: ['remove_button', 'drag_drop']
        , valueField: 'id'
        , labelField: 'title'
        , searchField: 'title'
    })[0].selectize;

    medisinSelectize = $(medisinSelector).selectize({
        create: true
        , plugins: ['remove_button', 'drag_drop']
        , valueField: 'title'
        , labelField: 'title'
        , searchField: 'title'
        , load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'medisins.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    term: query
                    , maxRows: 20
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.elements);
                }
            });
        }
    })[0].selectize;
})