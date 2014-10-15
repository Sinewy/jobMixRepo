<?php

  if( isset($_GET["formulas_id"]) !== true )
  {
    echo "error [formulas_id not set]";
    exit();
  }

  $formulas_id = $_GET["formulas_id"];

  if (preg_match("/^[1-9]{1}[0-9]*$/", $formulas_id) !== 1)
  {
    echo "error [formulas_id must be valid unsigned integer]";
    exit();
  }



  // MySQL connection
  //
  $mysqli = new mysqli("localhost", "jumix", "mirna", "jumix");

  if($mysqli->connect_errno > 0)
    die('Unable to connect to database [' . $db->connect_error . ']');


  // query
  //
  $result = $mysqli->query("select 
                                p.name as 'product_name',
                                c.name as 'color_name',
                                right(b.name, 6) as 'base_name',
                                cs.can as 'can'
                            from
                                formulas f
                                inner join products p on (p.id = f.products_id)
                                inner join bases b on (b.id = f.bases_id)
                                inner join colors c on (c.id = f.colors_id)
                                inner join products_has_cansizes pc on (p.id = pc.products_id)
                                inner join cansizes cs on (cs.id = pc.cansizes_id)
                            where
                                f.id = ".$formulas_id."
		            limit 1");

  $row = $result->fetch_assoc();

  $data  = "@RUN\n";
  $data .= "@PRD \"\" \"".$row["product_name"]."\"\n";
  $data .= "@CLR \"".$row["color_name"]."\"\n";
  $data .= "@UNT 1.00 1.00\n";
  $data .= "@CAN \"".$row["can"]."\" 1\n";
  $data .= "@BAS \"".$row["base_name"]."\"\n";


  $result1 = $mysqli->query("select
                               c.name as 'name',
                               round(fc.quantity, 2) as 'quantity'
                            from
                               formulas f
                               inner join formulas_has_colorants fc on (fc.formulas_id = f.id)
                               inner join colorants c on (c.id = fc.colorants_id)
                            where
                               f.id = ".$formulas_id);

  // colorants
  //
  $data .= "@CNT ";
  while($row = $result1->fetch_assoc())
  {
    $data .= "\"".$row["name"]."\" ".$row["quantity"]. " ";
  }
  $data .= "\n@END";


  $mysqli->close();

  $bytes_written = file_put_contents("flink.data", $data);

  if( $bytes_written > 0 )
  {
    echo "ok";
  }
  else
  {
    echo "Could not write to filesystem.";
    exit();
  }
?>
