<?php

namespace App\Console\Commands;
class ModulesExport{

    private string $modulesDirectoryPath;
    private array  $modulesDirectoryPathArray = [];

    public function __construct($modulesDirectoryPath){
        $this->modulesDirectoryPath = $modulesDirectoryPath;
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

    public function setModulesDirectoryArray(){
        $modulesDirectoryNames = array_slice(scandir($this->modulesDirectoryPath), 2); 
        foreach($modulesDirectoryNames as $moduleDirectoryName){
            array_push($this->modulesDirectoryPathArray, "$this->modulesDirectoryPath/$moduleDirectoryName");
        }
    }

    private function createProgramDirectory(string $programDirectoryName, string $directoryPath='../programs'): void{
        if(!is_dir($directoryPath)){
            mkdir($directoryPath, 0755, true);
        }

        if(!is_dir("$directoryPath/$programDirectoryName")){
            mkdir("$directoryPath/$programDirectoryName", 0755, true);
        }
    }

}

