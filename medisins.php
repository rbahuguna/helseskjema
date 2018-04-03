<?php
    set_time_limit(0);
    include "helseskjema_db.php";
    $medisins = array();
    for($characterAscii = ord("a");$characterAscii <= ord("z");$characterAscii++) {
        $medisinUrl = "https://www.felleskatalogen.no/medisin/sok/json?maxRows=" . PHP_INT_MAX . "&" . "term=" . chr($characterAscii);
        $medisinsContent = json_decode(file_get_contents($medisinUrl));
        foreach ($medisinsContent->elements as $medisin) {
                if (array_search($medisin->title, $medisins) == FALSE) {
                    array_push($medisins, $medisin->title);
                }
        }
    }
    $medisins = implode(PHP_EOL, $medisins);
    file_put_contents($MEDISIN . 's.txt', $medisins);
?>