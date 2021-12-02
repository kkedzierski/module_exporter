<?php

namespace App\Console\Commands;
require_once('./modules_exporter/src/classes/ModulesExport.php');
use Illuminate\Console\Command;

class ExportModulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export-modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export frontend modules from current Laravel app to new folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modulesExport = new ModulesExport('./Modules');
        $modulesExport->setModulesDirectoryArray();
        $modulesExport->exportProgram();      
        return Command::SUCCESS;
    }
}
