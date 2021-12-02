<?php

declare(strict_types = 1);
namespace App\Console\Commands;
include_once("../src/classes/ModulesExport.php");

$modulesExport = new ModulesExport('../../Modules');
$modulesExport->initializeArtisanCommand();
$modulesExport->setModulesDirectoryArray();
$modulesExport->exportProgram();
