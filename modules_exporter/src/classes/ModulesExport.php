<?php

namespace App\Console\Commands;
class ModulesExport{

    public function __construct(){
        var_dump("test");
    }

    /**
     * Create custom artisan command, after call this you are able to call: php artisan export-modules
     *
     * @param string  $directoryPath path to artisan commands directory
     * @throws echo   if path are not choosen correctly
     * 
     * @return void
     */ 
    public function initializeArtisanCommand(string $directoryPath='../../app/Console/Commands/'): void {
        if(!is_dir($directoryPath)){
            mkdir($directoryPath, 0755, true);
        }

        $exportModulesCommandPath = '../../modules_exporter/src/classes/ExportModulesCommand.php';
        $exportModulesCommandName = 'ExportModulesCommand.php';
        try {
            copy($exportModulesCommandPath, $directoryPath . $exportModulesCommandName);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
    }

}

