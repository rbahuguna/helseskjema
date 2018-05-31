<?php
    include "helseskjema_db.php";

    try {
        $pdo = new PDO($DSN_FIREBIRD, $DATABASE_USER, $DATABASE_PASSWORD);

        $fodselsnr = $_GET[$FODSELSNR_INPUT];
        $fodselsnr_time = DateTime::createFromFormat("dmy H:i:s",  $fodselsnr . " 00:00:00");
        if ($fodselsnr_time) {
            if ($fodselsnr_time->format("Y") > getdate()["year"]) {
                $fodselsnr_time->modify('-100 year');
            }
            $fodselsnr_time = $fodselsnr_time->format($FODSELSNR_FORMAT);
            $personnummer = $_GET[$PERSONNUMMER_INPUT];

            if (($patient_helseskjema_query_stmt =
                $pdo->prepare($patient_helseskjema_query)) === False) {
                outputError($pdo);
            } else {
                if ($patient_helseskjema_query_stmt->bindParam(
                    ':fodselsnr_time', $fodselsnr_time, PDO::PARAM_STR) === FALSE
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
                            // lowercase pasient keys
                            foreach($pasient as $pasient_key => $pasient_value) {
                                // html form fields use lower case names,
                                // while database columns are uppercase
                                unset($pasient[$pasient_key]);
                                $pasient_key_lowercase = strtolower($pasient_key);
                                // Value of $FODSELSNR_INPUT is not needed
                                // It is input by user on html form
                                if (array_search($pasient_key_lowercase, array($FODSELSNR_INPUT)) === FALSE) {
                                    $pasient_value = is_null($pasient_value) ? "" : $pasient_value;
                                    $pasient_value = iconv($DATABASE_CHARSET, "UTF-8", $pasient_value);
                                    if ($pasient_key == $MEDIKAMENTER) {
                                        // split medisins on newline
                                        $pasient_value = explode(PHP_EOL, $pasient_value);
                                        // remove empty values, if any
                                        $pasient_value = array_filter($pasient_value, function($pasient_value){
                                            return strlen(trim($pasient_value)) > 0;
                                        });
                                        $pasient[$MEDISIN_INPUT] = $pasient_value;
                                    } else if ($pasient_key == $FIND_US) {
                                        // split "find us" on comma
                                        $pasient_value = explode(PHP_EOL, $pasient_value);
                                        // remove empty values, if any
                                        $pasient_value = array_filter($pasient_value, function($pasient_value){
                                            return strlen(trim($pasient_value)) > 0;
                                        });
                                        $pasient[$FIND_US_INPUT] = $pasient_value;
                                    } else {
                                        $pasient[$pasient_key_lowercase] = $pasient_value;
                                    }
                                }
                            }
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
            outputErrorMessage("Ugyldig fødselsdato");
        }
    } catch (PDOException $e) {
        outputErrorMessage($e->getMessage());
    }
?>