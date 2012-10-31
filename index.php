<?php
/**
 * Created by JetBrains PhpStorm.
 * User: devon
 * Date: 10/30/12
 * Time: 7:44 PM
 * To change this template use File | Settings | File Templates.
 */

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get("/", function(){
    $mysqli = new mysqli("10.20.50.41", "ashetler", "BacRuTe2", "na_vbulletin", 3306 );

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }



    $q = "SELECT vb3_user.pvpnet_id, vb3_user.username, vb3_userban.liftdate, vb3_userban.reason FROM vb3_user LEFT JOIN ( na_vbulletin.vb3_userban ) ON (vb3_userban.userid = vb3_user.userid) WHERE (vb3_userban.bandate != 0) ORDER BY vb3_user.userid;";

    if($results = $mysqli->query($q)){
        echo "Select returned ...".$results->num_rows;
        echo "<br>";
        echo "<table border='1'><tr><td>PVPNet ID</td><td>Username</td><td>Amount till lift (seconds)</td><td>Reason</td></tr>";
        while ($row = $results->fetch_row()) {
            echo "<tr>";
            $bantime = ($row[2] - time());
            $bandata = ($bantime <= -1000000000 || $bantime >= 2000000000 ? "Permanent" : $bantime);
            echo "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$bandata."</td><td>".$row[3]."</td>";
            echo "</tr>";
        }

    }



});



$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();
