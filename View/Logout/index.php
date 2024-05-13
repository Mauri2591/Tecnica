<?php
require_once ("../../Config/Conexion.php");
session_destroy();
header("Location: ".URL);