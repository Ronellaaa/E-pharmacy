

<?php
$con = new mysqli("localhost", "root","Oggy2012", "pharmacydatabase", 3306);


if($con -> connect_error){
  die("Connection failed: ".$con -> connect_error);
}

?>
