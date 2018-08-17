<?php
    $FODSELSNR_FORM_FIELD_FORMAT            = "dmy";
    $FODSELSNR_FORM_FIELD_FORMAT_ALTERNATE  = "d.m.y";

    // names of html form fields
    // for example, <input name="additional_message" ...
    $ADDITIONAL_MESSAGE_FORM_FIELD          = "additional_message";
    $ADRESSE_FORM_FIELD                     = "adresse";
    $ARBEIDSSTED_FORM_FIELD                 = "arbeidssted";
    $EMAIL_FORM_FIELD                       = "epost";
    $ETTERNAVN_FORM_FIELD                   = "etternavn";
    $FASTLEGE_FORM_FIELD                    = "fastlege";
    $FODSELSNR_FORM_FIELD                   = "fodselsnr";
    $FORNAVN_FORM_FIELD                     = "fornavn";
    $MOBTLF_FORM_FIELD                      = "mobtlf";
    $PERSONNUMMER_FORM_FIELD                = "personnummer";
    $POSTNR_FORM_FIELD                      = "postnr";
    $STED_FORM_FIELD                        = "sted";
    $YRKE_FORM_FIELD                        = "yrke";

    $FIND_US_OPTIONS                        = array(
        "Friend"
        , "Newspaper ad"
        , "Radio"
        , "Social"
        , "TV"
    );

    function outputErrorMessage($message) {
        $error = array('Success' => False,
            'Error' => $message);
        print json_encode($error);
    }
?>