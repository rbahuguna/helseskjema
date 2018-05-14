<?php
    $DATABASE_HOST      = "localhost";
    $DATABASE           = "helseskjema";
    $DATABASE_USER      = "root";
    $DATABASE_PASSWORD  = "password";

    $DSN_FIREBIRD       = "firebird:dbname=$DATABASE_HOST:$DATABASE";
    $DSN_MYSQL          = "mysql:dbname=$DATABASE;host=$DATABASE_HOST";

    $ADRESSE_INPUT      = "adresse";
    $ETTERNAVN_INPUT    = "etternavn";
    // day/month/year...
    $FODSELSNR_FORMAT   = "d/m/y H:i:s";
    $FODSELSNR_INPUT    = "fodselsnr";
    $FORNAVN_INPUT      = "fornavn";
    $MEDIKAMENTER       = "MEDIKAMENTER";
    $MEDISIN_INPUT      = "medisin";
    $MOBTLF_INPUT       = "mobtlf";
    $POSTNR_INPUT       = "postnr";
    $PERSONNUMMER_INPUT = "personnummer";

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