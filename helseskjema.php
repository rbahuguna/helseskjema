<?php
    include "helseskjema_form.php";
    include "helseskjema_db.php";

    try {
        $pdo = new PDO($DSN_FIREBIRD, $DATABASE_USER, $DATABASE_PASSWORD);

        $fodselsnr = $_GET[$FODSELSNR_FORM_FIELD];
        $fodselsnr_datetime = DateTime::createFromFormat($FODSELSNR_FORM_FIELD_FORMAT, $fodselsnr);
        if ($fodselsnr_datetime == FALSE) {
            $fodselsnr_datetime = DateTime::createFromFormat($FODSELSNR_FORM_FIELD_FORMAT_ALTERNATE, $fodselsnr);
        }
        if ($fodselsnr_datetime) {
            if ($fodselsnr_datetime->format("Y") > getdate()["year"]) {
                $fodselsnr_datetime->modify('-100 year');
            }
            $fodselsnr = $fodselsnr_datetime->format($FODSELSNR_FORMAT);
            $personnummer = $_GET[$PERSONNUMMER_FORM_FIELD];

            if (($patient_helseskjema_query_stmt =
                $pdo->prepare($patient_helseskjema_query)) === False) {
                outputError($pdo);
            } else {
                if ($patient_helseskjema_query_stmt->bindParam(
                    ':fodselsnr', $fodselsnr, PDO::PARAM_STR) === FALSE
                    || $patient_helseskjema_query_stmt->bindParam(
                    ':personnummer', $personnummer, PDO::PARAM_INT) === FALSE) {
                        outputError($patient_helseskjema_query_stmt);
                } else {
                    if ($patient_helseskjema_query_stmt->execute() === FALSE) {
                        outputError($patient_helseskjema_query_stmt);
                    } else {
                        if (($pasient =
                            $patient_helseskjema_query_stmt->fetch(PDO::FETCH_ASSOC)) === FALSE) {
                            outputErrorMessage("Vennligst kontakt resepsjonen");
                        } else {

                            $pasient = array_map(function($pasient_value) {
                                // replace nulls with blanks
                                $pasient_value = is_null($pasient_value) ? "" : $pasient_value;
                                // convert to utf-8
                                global $DATABASE_CHARSET;
                                return iconv($DATABASE_CHARSET, "UTF-8", $pasient_value);
                            }, $pasient);

                            // for "find us" and medisins
                            foreach($pasient as $pasient_key => $pasient_value) {
                                if ($pasient_key == $MEDIKAMENTER
                                    || $pasient_key == $FIND_US) {
                                    // split values on newline
                                    $pasient_value = explode(PHP_EOL, $pasient_value);
                                    // remove empty values, if any
                                    $pasient_value = array_filter($pasient_value, function($pasient_value){
                                        return strlen(trim($pasient_value)) > 0;
                                    });
                                    $pasient[$pasient_key] = $pasient_value;
                                }
                            }

                            // lowercase pasient keys
                            // html form fields use lower case names,
                            // while database columns are uppercase
                            $pasient = array_change_key_case($pasient);

                            $pasient = array('Success' => True, 'pasient' => $pasient);
                            $pasient_json = json_encode($pasient);
                            if ($pasient_json === FALSE) {
                                outputErrorMessage(join(":", array(json_last_error(), json_last_error_msg())));
                            } else {
                                print $pasient_json;
                            }
                        }
                    }
                }
            }
        } else{
            outputErrorMessage(sprintf("Ugyldig fødselsdato; bruk datoformat %s, %s",
                $FODSELSNR_FORM_FIELD_FORMAT, $FODSELSNR_FORM_FIELD_FORMAT_ALTERNATE));
        }
    } catch (PDOException $e) {
        outputErrorMessage($e->getMessage());
    }
?>