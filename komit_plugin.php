<?php
/*
 Plugin Name: Event list of MCC
 Description: Produce a listing of events at KU MCC
 Version: 0.2
 Author: Mace Ojala
 Licence: GPL3
 Licence URI: https://www.gnu.org/licences/gpl.html
*/

function listevents() {
    // Get events and form a list of them
    $context = stream_context_create(array(
        'http' => array(
            'header' => 'User-Agent: komit_plugin'
        )
    ));
    $url = "http://mcc.ku.dk/calendar/?get_ical=1";
    
    $response = file_get_contents($url, false, $context);
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
