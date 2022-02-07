<?php
if(isset($_POST['idcko']))
{
    $id=$_POST['idcko'];
    $_SESSION['idcko']=$id;
    header("location:/semestralka/uprava.php");
}
?>
