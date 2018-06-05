<?php
    $DATABASE_HOST      = "localhost";
    $DATABASE           = "helseskjema";
    $DATABASE_USER      = "SYSDBA";
    $DATABASE_PASSWORD  = "masterkey";

    $DATABASE_CHARSET   = "ISO-8859-1";

    $DSN_FIREBIRD       = "firebird:dbname=$DATABASE_HOST:$DATABASE";
    $DSN_MYSQL          = "mysql:dbname=$DATABASE;host=$DATABASE_HOST";

    $ADRESSE_INPUT      = "adresse";
    $ETTERNAVN_INPUT    = "etternavn";
    $FIND_US            = "LEGE";
    $FIND_US_INPUT      = "find-us";
    // day/month/year...
    $FODSELSNR_FORMAT   = "d/m/y H:i:s";
    $FODSELSNR_INPUT    = "fodselsnr";
    $FORNAVN_INPUT      = "fornavn";
    $MEDIKAMENTER       = "MEDIKAMENTER";
    $MEDISIN_INPUT      = "medisin";
    $MEDISINS_INPUT     = $MEDISIN_INPUT . "[]";
    $MOBTLF_INPUT       = "mobtlf";
    $PERSONNUMMER_INPUT = "personnummer";
    $POSTNR_INPUT       = "postnr";

    $FIND_US_OPTIONS    = array(
        "Friend"
        , "Newspaper ad"
        , "Radio"
        , "Social"
        , "TV"
    );

    $patient_helseskjema_query = <<< EOD

        SELECT pasient.*
            , helseskjema.*
            , pasient.PID PASIENT_PID
            FROM pasient
            LEFT JOIN helseskjema
            ON pasient.PID = helseskjema.PID
            WHERE FODSELSNR = :fodselsnr_time
            AND PERSONNR = :personnummer
            ORDER BY HELSESKJID DESC;

EOD;

    function outputError($pdoInstance) {
        outputErrorMessage(join(":", $pdoInstance->errorInfo()));
    }

    function outputErrorMessage($message) {
        $error = array('Success' => False,
            'Error' => $message);
        print json_encode($error);
    }
?>