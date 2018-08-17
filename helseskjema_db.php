<?php
    $DATABASE_HOST                          = "localhost";
    $DATABASE                               = "skiny";
    $DATABASE_USER                          = "SYSDBA";
    $DATABASE_PASSWORD                      = "masterkey";

    $DSN_FIREBIRD                           = "firebird:dbname=$DATABASE_HOST:$DATABASE";
    $DSN_MYSQL                              = "mysql:dbname=$DATABASE;host=$DATABASE_HOST";

    $DATABASE_CHARSET                       = "ISO-8859-1";
    $DATABASE_ICONV_OUT_CHARSET             = "ISO-8859-1//TRANSLIT"; 

    // ccyy-mm-dd                       
    $FODSELSNR_FORMAT                       = "Y-m-d";

    // name of column in table helseskjema
    $FIND_US                                = "LEGE";
    $MEDIKAMENTER                           = "MEDIKAMENTER";

    $patient_helseskjema_query              = <<< EOD
        SELECT pasient.*
            , helseskjema.*
            , pasient.PID PASIENT_PID
            FROM pasient
            LEFT JOIN helseskjema
            ON pasient.PID = helseskjema.PID
            WHERE FODSELSNR = :fodselsnr
            AND PERSONNR = :personnummer
            ORDER BY HELSESKJID DESC
EOD;

    $helseskjema_update                     = <<< EOD
        UPDATE pasient
            SET FORNAVN = :fornavn
                , ETTERNAVN = :etternavn
                , ADRESSE = :adresse
                , POSTNR = :postnr
                , MOBTLF = :mobtlf
                , EPOST = :epost
                , YRKE = :yrke
            WHERE FODSELSNR = :fodselsnr
            AND PERSONNR = :personnummer
EOD;
            
    function outputError($pdoInstance) {
        outputErrorMessage(join(":", $pdoInstance->errorInfo()));
    }
?>