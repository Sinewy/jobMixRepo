<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/14/14
 * Time: 10:01
 */

if(isset($_POST["runMixer"])) {
    $runPy = $_POST["runMixer"];
    if($runPy == "yes") {
        var_dump($runPy);
        exec('sudo python /home/pi/tmapi2/tmapi.py > /dev/null &');
    }
    echo "success";
}