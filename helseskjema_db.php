<?php
    $DATABASE_HOST      = "localhost";
    $DATABASE           = "helseskjema";
    $DATABASE_USER      = "root";
    $DATABASE_PASSWORD  = "password";

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

        SELECT pasient1.*
            , helseskjema.*
            FROM pasient1
            LEFT JOIN helseskjema1 helseskjema
            ON pasient1.PID = helseskjema.PID
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