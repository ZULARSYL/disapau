<?php
//Route
define('KUNCITOKEN', 'Itbwidy4G4ajuefnufbufge');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? '') == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$basePath = rtrim($basePath, '/\\');
define('BASEURL', $protocol . $host . ($basePath === '' ? '' : $basePath) . '/');

//database
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ppk');

//Manifest
define("TITLE", "DISAPU | Digital Sampah Purworejo");
define("DESKRIPSI", "Digital Sampah Purworejo ");
define("KEYWORD", "disapu, Digital, Sampah, Purworejo, DISAPU, Lumajang, Senduro, Digital Sampah Purworejo");
