<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/8/14
 * Time: 10:47
 */

require_once("functions.php");



if($_GET['type'] == 'country'){
    $searchString = $_GET['searchString'];
    $result = findCountries($searchString);
    $data = array();
    if(mysqli_num_rows($result) > 0) {
        while($country = mysqli_fetch_assoc($result)) {
            array_push($data, $country["country_name"]);
        }
    }
    echo json_encode($data);

}


