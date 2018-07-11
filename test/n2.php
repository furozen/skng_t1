<?php
    set_time_limit(1);
    $filename = "./counter.txt"; 


    // Read the current counts
    $fh = fopen($filename, "r+");
    if (!$fh) {
        die("Can't open count file");
    }

    while (!flock($fh, LOCK_EX | LOCK_NB)) {
        //with this time limit there are about 20 tries
        usleep(round(rand(0, 100)*1000)); 
    }

    $counter = intval(fread($fh, 1024)) + 1;

    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, $counter);
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
