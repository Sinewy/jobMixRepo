<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/14/14
 * Time: 10:01
 */

require_once("dbc.php");

if(isset($_POST["formulaId"])) {
    $fid= $_POST["formulaId"];
    writePrismaFile($connection, $fid);
    echo "success";
}

function writePrismaFile($connection, $id) {
    $result = $connection->query("select
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
                                f.id = ".$id."
		            limit 1");

    $row = $result->fetch_assoc();

    $data  = "@RUN\n";
    $data .= "@PRD \"\" \"".$row["product_name"]."\"\n";
    $data .= "@CLR \"".$row["color_name"]."\"\n";
    $data .= "@UNT 1.00 1.00\n";
    $data .= "@CAN \"".$row["can"]."\" 1\n";
    $data .= "@BAS \"".$row["base_name"]."\"\n";


    $result1 = $connection->query("select
                               c.name as 'name',
                               round(fc.quantity, 2) as 'quantity'
                            from
                               formulas f
                               inner join formulas_has_colorants fc on (fc.formulas_id = f.id)
                               inner join colorants c on (c.id = fc.colorants_id)
                            where
                               f.id = ".$id);

// colorants
//
    $data .= "@CNT ";
    while($row = $result1->fetch_assoc())
    {
        $data .= "\"".$row["name"]."\" ".$row["quantity"]. " ";
    }
    $data .= "\n@END";


    $connection->close();

    $bytes_written = file_put_contents("/var/jumix/flink.data", $data);

    if( $bytes_written > 0 )
    {
        echo "ok";
    }
    else
    {
        echo "Could not write to filesystem.";
        exit();
    }
}



