<?php
try{
 $user = 'clmt';
 $pass = '130702';
 $conn = new PDO('mysql:host=localhost;dbname=base_camping;charset=UTF8'  
				,$user, $pass, array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
 echo "connecté<br/>";
}
catch (PDOException $e){
  echo "Erreur: ".$e->getMessage()."<br/>";
  die() ;
}
return $conn;
?>
