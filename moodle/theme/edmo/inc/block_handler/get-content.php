<?php
/**
 * Block Content Handler
 */

function edmo_block_image_process($img) {
    global $CFG;
    $old_url = 'http://localhost/moodle/edmo-4.0.4/';
    $old_url2 = 'http://localhost:8888/moodle/edmo-4.2/';
    $new_url = $CFG->wwwroot.'/';

    if (strpos($img, $old_url) !== false) {
        $img = str_replace($old_url,$new_url,$img);
        return $img;
    }elseif (strpos($img, $old_url2) !== false) {
        $img = str_replace($old_url2,$new_url,$img);
        return $img;
    }else{
        return $img;
    }
}
