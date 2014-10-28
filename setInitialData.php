<?php
require_once("includes/dbc.php");
require_once("includes/globalFunctions.php");


if(isset($_GET["remoteId"])) {

    // download zip
    // list files
    //
  $url = "http://10.20.0.101:8000/api/v1/mixers/" . $_GET["remoteId"] . "/tabledata";
//  $url = "http://10.20.0.101:8000/api/v1/mixers/EF23212A-0F32-E111-BC50-78ACC0F7ECD6/tabledata";

  $raw_data = file_get_contents($url);

  if( $raw_data === false )
  {
    echo "Failed to retrieve file from url.";
    exit();
  }

  $bytes_written = file_put_contents("tables.zip", $raw_data);

  if( ($bytes_written === 0) or ($bytes_written === false) )
  {
    echo "Failed to write zip file on the filesystem.";
    exit();
  } 

  // ok, let's try to open zip file
  //
  $zip = new ZipArchive;
  $result = $zip->open("tables.zip");

  if( $result !== true )
  {
    echo "Could not open zip file.";
    unlink("tables.zip"); // delete file from the filesystem
    exit();
  }

  if( $zip->extractTo("tables") !== true )
  {
    unlink("tables.zip");
    $zip->close();
    echo "Failed to extract zip.";
    exit();
  }

  unlink("tables.zip");
  $zip->close();  

  // 2. insert to database

  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if( $mysqli->connect_errno )
  {
    echo "Failed to connect to MySQL: (" .
         $mysqli->connect_errno . ") " .
         $mysqli->connect_error;
    exit();
  }

  // Returns FALSE on failure.
  // For successful SELECT, SHOW, DESCRIBE or EXPLAIN queries mysqli_query() will 
  // return a mysqli_result object.
  // For other successful queries mysqli_query() will return TRUE. 
  //
  if( $mysqli->query("start transaction") !== true )
  {
    echo "Query failed [".$mysqli->error."]";
    $mysqli->close();
    exit();
  }

  // first delete all rows
  //
  foreach(array("products_has_languages",
                "languages",
                "formulas_has_colorants",
                "formulas",
                "pricelists_has_prefilledcan",
                "pricelists_has_colorants",
                "pricelists",
                "products_has_cansizes",
                "products_has_bases",
                "prefilledcan",
                "collections",
                "colors",
                "products",
                "bases",
                "colorants",
                "cansizes") as $index => $item)
  {
    if( $mysqli->query("delete from ".$item) !== true )
    {
      echo "Failed to execute query delete from ".$item." [".$mysqli->error."]";
      $mysqli->query("rollback");
      $mysqli->close();
      exit();      
    }
  }  


  foreach(array("cansizes",
                "collections",
                "colors",
                "products",
                "bases",
                "colorants",
                "pricelists",
                "prefilledcan",
                "formulas",
                "formulas_has_colorants",
                "products_has_bases",
                "products_has_cansizes",
                "pricelists_has_colorants",
                "pricelists_has_prefilledcan",
                "languages",
                "products_has_languages") as $index => $item)
  {
    // open each file and read file line and by line and insert to database
    //
    $handle = fopen("tables/jumix_".$item.".sql", "r");

    if( $handle === false )
    {
      echo "Failed to open file: tables/jumix_".$item."sql for reading";
      $mysqli->query("rollback");
      $mysqli->close();
      exit();
    }

    echo "Inserting to table: " . $item . PHP_EOL;
 
    // now, read file line and by line and perform query
    //
    while( ($line = fgets($handle)) !== false )
    {
      if( $mysqli->query(trim($line)) !== true )
      {
        echo "Failed to execute query [".$mysqli->error."]";
        $mysqli->query("rollback");
        $mysqli->close();
        fclose($handle);
        exit();
      }
    }

    fclose($handle);
  }

  if( $mysqli->query("commit") !== true )
  {
    echo "Failed to execute query commit [".$mysqli->error."]";
  }


  $mysqli->close();


  // cleanup
  // delete tables directory and all its files
  //
  try
  {
    $it = new FilesystemIterator("./tables");

    foreach ($it as $fileinfo)
    {
      $path = $fileinfo->getPath() . "/". $fileinfo->getFilename();
      
      if( unlink($path) !== true )
      {
        echo "Could not delete file: " . $path . PHP_EOL;
        exit();
      }
    }
    if( rmdir("./tables") !== true )
    {
      echo "Failed to delete directory tables.";
      exit();
    }
  }
  catch(Exception $e)
  {
    echo "Could delete tables files.";
    exit();
  }

        global $connection;
        $query  = "UPDATE device_info ";
        $query  .= "SET status = 1 ";
        $query  .= "WHERE remoteId LIKE '{$_GET["remoteId"]}' ";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);

//    redirectTo("jumix.php");

  // Echo memory usage
  //
//  echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , PHP_EOL;

  // Echo memory peak usage
  //
//  echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , PHP_EOL;
}

?>