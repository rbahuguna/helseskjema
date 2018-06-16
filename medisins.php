<?php
    function getMedisins($medisins_filename_prefix) {
        $medisins_file = $medisins_filename_prefix . 's.txt';
        if (file_exists($medisins_file) == FALSE) {
            set_time_limit(0);
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
            natcasesort($medisins);
            $medisins = implode(PHP_EOL, $medisins);
            file_put_contents($medisins_file, $medisins);
        }
        $medisins = file_get_contents($medisins_file);
        return explode(PHP_EOL, $medisins);
    }
?>