<?php
    include "helseskjema_form.php";
    include "helseskjema_db.php";

    try {
        $pdo = new PDO($DSN_FIREBIRD, $DATABASE_USER, $DATABASE_PASSWORD);

        $fodselsnr = $_POST[$FODSELSNR_FORM_FIELD];
        $fodselsnr_datetime = DateTime::createFromFormat($FODSELSNR_FORM_FIELD_FORMAT, $fodselsnr);
        if ($fodselsnr_datetime == FALSE) {
            $fodselsnr_datetime = DateTime::createFromFormat($FODSELSNR_FORM_FIELD_FORMAT_ALTERNATE, $fodselsnr);
        }
        if ($fodselsnr_datetime) {
            if ($fodselsnr_datetime->format("Y") > getdate()["year"]) {
                $fodselsnr_datetime->modify('-100 year');
            }
            $fodselsnr = $fodselsnr_datetime->format($FODSELSNR_FORMAT);
            $personnummer = $_POST[$PERSONNUMMER_FORM_FIELD];

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
                        if (($helseskjema =
                            $patient_helseskjema_query_stmt->fetch(PDO::FETCH_ASSOC)) === FALSE) {
                            outputErrorMessage("Vennligst kontakt resepsjonen");
                        } else {
                            $helseskjid  = is_null($helseskjema['HELSESKJID']) ? 0 : $helseskjema['HELSESKJID'];
                            $helseskjid  += 1;

                            $pid            = $helseskjema['PASIENT_PID'];
                            $helseskjema    = array('PID' => $pid, 'HELSESKJID' => $helseskjid);

                             // prepare to update table helseskjema
                            foreach($_POST as $postKey => $postValue) {
                                // exclude pasient information
                                if (array_search($postKey, array(
                                    $FODSELSNR_FORM_FIELD
                                    , $PERSONNUMMER_FORM_FIELD
                                    , $FORNAVN_FORM_FIELD
                                    , $ETTERNAVN_FORM_FIELD
                                    , $ADRESSE_FORM_FIELD
                                    , $POSTNR_FORM_FIELD
                                    , $STED_FORM_FIELD
                                    , $MOBTLF_FORM_FIELD
                                    , $EMAIL_FORM_FIELD
                                    , $ARBEIDSSTED_FORM_FIELD
                                    , $YRKE_FORM_FIELD
                                    , $ADDITIONAL_MESSAGE_FORM_FIELD
                                    , $FASTLEGE_FORM_FIELD
                                    )) === FALSE) {

                                    if (is_array ($postValue)) {
                                        $postValue = array_map(function($postValue) {
                                            global $DATABASE_ICONV_OUT_CHARSET;
                                            return iconv("UTF-8", $DATABASE_ICONV_OUT_CHARSET, $postValue);
                                        }, $postValue);
                                        // join with newline
                                        $postValue = join(PHP_EOL, $postValue);
                                    } else {
                                        $postValue = iconv("UTF-8", $DATABASE_ICONV_OUT_CHARSET, $postValue);
                                    }

                                    $helseskjema[$postKey] = $postValue;
                                }
                            }

                            // table columns are in upper case
                            $helseskjema = array_change_key_case($helseskjema, CASE_UPPER);
                            $helseskjema_table_columns = array_keys($helseskjema);
                            // join with comma
                            $helseskjema_columns = join($helseskjema_table_columns, ", ");

                            $helseskjema_table_column_data = array_map(function($helseskjema_table_column){
                                global $helseskjema;
                                // quote table column value
                                return "'" . $helseskjema[$helseskjema_table_column] . "'";
                            }, $helseskjema_table_columns);

                            // join with comma
                            $helseskjema_column_data = join($helseskjema_table_column_data, ", ");

                            $helseskjema_query = "INSERT INTO helseskjema " .
                                " ( $helseskjema_columns ) VALUES ( $helseskjema_column_data )";

                            if ($pdo->exec($helseskjema_query)) {
                                if (($helseskjema_update_stmt =
                                    $pdo->prepare($helseskjema_update)) === False) {
                                    outputError($pdo);
                                } else {
                                    if ($helseskjema_update_stmt->bindParam(
                                        ':' . $FORNAVN_FORM_FIELD, $_POST[$FORNAVN_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $ETTERNAVN_FORM_FIELD, $_POST[$ETTERNAVN_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $ADRESSE_FORM_FIELD, $_POST[$ADRESSE_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $POSTNR_FORM_FIELD, $_POST[$POSTNR_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $MOBTLF_FORM_FIELD, $_POST[$MOBTLF_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $EMAIL_FORM_FIELD, $_POST[$EMAIL_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $YRKE_FORM_FIELD, $_POST[$YRKE_FORM_FIELD], PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $FODSELSNR_FORM_FIELD, $fodselsnr, PDO::PARAM_STR) === FALSE
                                        || $helseskjema_update_stmt->bindParam(
                                        ':' . $PERSONNUMMER_FORM_FIELD, $personnummer, PDO::PARAM_INT) === FALSE
                                        ) {
                                            outputError($helseskjema_update_stmt);
                                    } else {
                                        // update table pasient
                                        if ($helseskjema_update_stmt->execute() === FALSE) {
                                            outputError($helseskjema_update_stmt);
                                        } else {
                                            $helseskjema = array('Success' => True);
                                            $helseskjema_json = json_encode($helseskjema);
                                            if ($helseskjema_json === FALSE) {
                                                outputErrorMessage(join(":", array(json_last_error(), json_last_error_msg())));
                                            } else {
                                                print $helseskjema_json;
                                            }
                                        }
                                    }
                                }
                            } else {
                                outputError($pdo);
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