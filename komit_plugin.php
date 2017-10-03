<?php
/*
 Plugin Name: Event list of MCC
 Description: Produce a listing of events at KU MCC
 Version: 0.1
 Author: Mace Ojala
 Licence: GPL3
 Licence URI: https://www.gnu.org/licences/gpl.html
*/

function listevents() {
    $url = "http://mcc.ku.dk/calendar/?get_ical=1";
    $response = file_get_contents($url);
    $lines = explode("\n", $response);

    // Produce a HTML list
    print('<ul>');
    foreach($lines as $line) {
        if(strpos($line, "SUMMARY") === 0) {
            print('<li style="color: gray">' . $line . '</li>' . PHP_EOL);
        }
    }
    print('</ul>');
}

add_action('wp_footer', 'listevents');
