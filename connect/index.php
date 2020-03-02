<?php
if(!isset($_SESSION['usr']))
{
    header("Location: ../invalid.php");
    exit();
}
?>