<?php
    $term = $_GET["term"];
    $term = empty($term) ? "a" : $term;
    $maxRows = $_GET["maxRows"];

    print getMedisinsJson($term, $maxRows);

    function getMedisinsJson($term, $maxRows) {
        $medisinUrl = "https://www.felleskatalogen.no/medisin/sok/json?maxRows=" . $maxRows . "&" . "term=" . $term;
        $medisins = trim(file_get_contents($medisinUrl));
        return strlen($medisins) > 0 ? $medisins : json_encode(array("elements" => array()));
    }
?>