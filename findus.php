<?php
    include "helseskjema_db.php";

    print getFindUsJson();

    function getFindUsJson() {
        global $FIND_US_OPTIONS;
        return json_encode(array("results" => array_map(function($findUsKey, $findUsValue) {
            return array("id" => $findUsKey, "title" => $findUsValue);
        }, array_keys($FIND_US_OPTIONS), array_values($FIND_US_OPTIONS))));
    }
?>