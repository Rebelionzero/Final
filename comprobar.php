<?php
$comp = $_POST['comprobar'];
if($comp == "commit"){
  header("Location:Admin/admin.php");
}elseif($comp == "objetos"){
  header("Location:objetos/index.php");
}elseif($comp == "site"){
  header("Location:site/index.php");
}else{
  header("Location:index.php"); 
}

?>