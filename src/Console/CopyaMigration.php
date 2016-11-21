<?php

namespace Copya\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Exception;

class CopyaMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copyacategory:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for Copya Category.';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->makeMigration()) {
            $this->info('Migration successfully created!');

            return;
        }
        $this->error('[InvalidArgumentException]');
        $this->error('Migration already exists.');

        return;
    }

    protected function makeMigration()
    {
        $copya_category_setup = __DIR__ . "/stubs/migration/CopyaCategoryMigration.php";
        $copyaCategoryMigrationFile = base_path("/database/migrations") . "/" . date('Y_m_d_His') . "_copya_category_migration.php";


        try {
            if (!class_exists('CopyaCategoryMigration')) {
                if (!file_exists($copyaCategoryMigrationFile) && $fs = fopen($copyaCategoryMigrationFile, 'x')) {
                    fwrite($fs, file_get_contents($copya_category_setup));
                    fclose($fs);
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }


}
