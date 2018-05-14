<?php
    include "helseskjema_db.php";

    try {
        $pdo = new PDO("firebird:dbname=$DATABASE_HOST:$DATABASE", $DATABASE_USER, $DATABASE_PASSWORD);

        $fodselsnr = $_POST[$FODSELSNR_INPUT];
        $fodselsnr_time = DateTime::createFromFormat("dmy H:i:s",  $fodselsnr . " 00:00:00");
        if ($fodselsnr_time) {
            $fodselsnr_time = $fodselsnr_time->format($FODSELSNR_FORMAT);
            $personnummer = $_POST[$PERSONNUMMER_INPUT];

            if (($patient_helseskjema_query_stmt =
                $pdo->prepare($patient_helseskjema_query)) === False) {
                outputError($pdo);
            } else {
                if ($patient_helseskjema_query_stmt->bindParam(
                    ':fodselsnr_time', $fodselsnr_time, PDO::PARAM_STR) === FALSE) {
                        outputError($patient_helseskjema_query_stmt);
                } else if ($patient_helseskjema_query_stmt->bindParam(
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

                            $helseskjid     = $helseskjema['HELSESKJID'];
                            $pid            = $helseskjema['PID'];
                            $helseskjema    = array('PID' => $pid, 'HELSESKJID' => $helseskjid);

                            foreach($_POST as $postKey => $postValue) {
                                if (array_search($postKey, array(
                                    $FODSELSNR_INPUT
                                    , $PERSONNUMMER_INPUT
                                    , $FORNAVN_INPUT
                                    , $ETTERNAVN_INPUT
                                    , $ADRESSE_INPUT
                                    , $POSTNR_INPUT
                                    , $MOBTLF_INPUT
                                    , "terms")) === FALSE) {
                                    $postKeyUppercase = strtoupper ($postKey);
                                    if ($postKey == $MEDISIN_INPUT) {
                                        // join medisins with newline
                                        $medisins = join(PHP_EOL, $postValue);
                                        $helseskjema[$MEDIKAMENTER] = $medisins;
                                    } else {
                                        $helseskjema[$postKeyUppercase] = $postValue;
                                    }
                                }
                            }

                            $helseskjema_columns = "";
                            $helseskjema_values = "";
                            $comma = ", ";

                            foreach ($helseskjema as $helseskjema_key => $helseskjema_value) {
                                if (strlen($helseskjema_value)) {
                                    $helseskjema_columns  .= $helseskjema_key . $comma;
                                    $helseskjema_values  .= "'" . $helseskjema_value . "'" . $comma;
                                }
                            }
                            if ($comma_last_pos = strrpos($helseskjema_columns, $comma)) {
                                $helseskjema_columns = substr($helseskjema_columns, 0, $comma_last_pos);
                            }
                            if ($comma_last_pos = strrpos($helseskjema_values, $comma)) {
                                $helseskjema_values = substr($helseskjema_values, 0, $comma_last_pos);
                            }

                            $helseskjema_query = "INSERT INTO helseskjema " .
                                " ( $helseskjema_columns ) VALUES ( $helseskjema_values )";

                            if ($pdo->exec($helseskjema_query)) {
                                $patient_query = "UPDATE pasient " .
                                    " SET FORNAVN = '" .
                                    $_POST["fornavn"] . "'" .
                                    ", ETTERNAVN = '" .
                                    $_POST["etternavn"] . "'" .
                                    ", ADRESSE = '" .
                                    $_POST["adresse"] . "'" .
                                    ",  POSTNR = '" .
                                    $_POST["postnr"] . "'" .
                                    ", MOBTLF = '" .
                                    $_POST["mobtlf"] . "'" .
                                    ' WHERE FODSELSNR = ' . "'" . $fodselsnr_time . "'" .
                                    ' AND PERSONNR = ' . "'" . $personnummer . "'";

                                if ($pdo->exec($patient_query)) {
                                    $helseskjema = array('Success' => True, 'helseskjema' => $helseskjema);
                                    print json_encode($helseskjema);
                                } else{
                                    outputError($pdo);
                                }
                            } else {
                                outputError($pdo);
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