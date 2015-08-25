<?php
session_start();
if (isset ($_SESSION["ID_ADMIN_VAL"])) unset($_SESSION["ID_ADMIN_VAL"]);
if (isset ($_SESSION["PSEUDO_ADMIN_VAL"])) unset($_SESSION["PSEUDO_ADMIN_VAL"]);
if (isset ($_SESSION["MAIL_ADMIN_VAL"])) unset($_SESSION["MAIL_ADMIN_VAL"]);
if (isset ($_SESSION["NOM_ADMIN_VAL"])) unset($_SESSION["NOM_ADMIN_VAL"]);
if (isset ($_SESSION["PRENOM_ADMIN_VAL"])) unset($_SESSION["PRENOM_ADMIN_VAL"]);

header("location: index.php");
exit;
?>