<?php

declare(strict_types = 1);
namespace App\Console\Commands;
include_once("../src/classes/ModulesExport.php");

$modulesExport = new ModulesExport();
$modulesExport->initializeArtisanCommand();

