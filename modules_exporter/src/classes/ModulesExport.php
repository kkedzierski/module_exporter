<?php


namespace App\Console\Commands;

// include_once('../../modules_exporter/src/helpers/helpers.php');
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

    private function exportFile(string $filePath, string $progamDirectoryName, string $programDirectoryPath='../programs'):void{
        $fileName = substr($filePath, strrpos($filePath, "/") + 1);
        try {
            copy($filePath, "$programDirectoryPath/$progamDirectoryName/$fileName");
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function exportProgram():void{
        if(empty($this->modulesDirectoryPathArray)){
            throw new Exception("Initial setModulesDirectoryArray method first");
        }

        foreach( $this->modulesDirectoryPathArray as $modulesDirectoryPath ){
            $moduleName = substr($modulesDirectoryPath, strrpos($modulesDirectoryPath, '/') + 1);
            $this->createProgramDirectory($moduleName);
            $this->exportFile("$modulesDirectoryPath/Resources/assets/js/app.js", $moduleName);
            $this->exportFile("$modulesDirectoryPath/Resources/assets/sass/app.scss", $moduleName);
            $this->exportFile("$modulesDirectoryPath/Resources/views/layouts/master.blade.php", $moduleName);
            $this->exportFile("$modulesDirectoryPath/Resources/views/index.blade.php", $moduleName);
            // $this->parseHTMLFile("../programs/$moduleName");
        }
        echo "Program with modules exported";
    }

    private function parseHTMLFile(
        string $HTMLfilesPath, 
        string $HTMLMasterFileName="master.blade.php", 
        string $HTMLIndexFileName = "index.blade.php"):void {
        
        $file = prepareFile($HTMLfilesPath/$HTMLIndexFileName, '@');
        prepareFile($HTMLfilesPath/$HTMLMasterFileName, '@', );
    }

    private function prepareFile(
        string $filePath, 
        ?string $stringToDelete = null,
        ?string $stringToAdd = null,
        ?string $cutToString = null): string {
        
        $file = getFile($filePath);
        
        if($stringToDelete){
            $file = deleteContentFromFile($filePath, $stringToDelete);
        }

        if($cutToString){
            $toLine = getFileLineWithString($filePath, $cutToString);
            $file = getFile($filePath, 0, $toLine);
            file_put_contents($filePath, $file);
        } 

        return $file;
    }

}

