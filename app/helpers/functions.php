<?php

// log fuunction
function logger($fileName, $methodName, $lineNumber, $error) {
    // echo '__creating new country name DID NOT succeed, TRY AGAIN__' . $error;

    // detail information for the error, all info sits in between the brackets()
    /**
     * setting time to the error where it was first made
     */
    date_default_timezone_set('Europe/Amsterdam');
    $time = 'Date/Time( ' . date('d-M-Y H:i:s )', time()) . "\t";

    /**
     * the error of the code
     */
    $error = " The error is( " . $error . ")\t";

    /**
     * the IP of the user that makes the error 
     */
    $ip = " Remote IP Adress( " . $_SERVER["REMOTE_ADDR"] . ")\t";

    /**
     * the location of the error
     */
    $placeOfError = "file( " . $fileName . "method: " . $methodName . "line-number: " . $lineNumber . ")\t";


    // make an log file if it doesnt exist
    /**
     * make an log file here
     */
    $pathToLogFile = APPROOT . '/logs/nonefunctionallog.txt';

    /**
     * checks if a logfile exists, if not make new
     */
    if (!file_exists($pathToLogFile)) {
        file_put_contents($pathToLogFile, "Non functional Log\r");
    }

    // asks the content the logfile
    /**
     * asks the content of the logfile
     */
    $contents = file_get_contents($pathToLogFile);

    // makes a new error in $contents
    /**
     * make new error
     */
    $contents .= $time . $ip . $error . $placeOfError . "\r";

    // add a new error to the logfile
    /**
     * writes the new content to the logfile
     */
    file_put_contents($pathToLogFile, $contents);

    // var_dump($_SERVER);
}