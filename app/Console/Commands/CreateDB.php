<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDB extends Command
{
    protected $signature = 'migrate:fresh-all {--seed}';
    protected $description = 'Drop all tables and re-run all migrations for all databases';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Dropping all tables in the default database...');
        $this->dropAllTables(config('database.default'));

        $migrationPaths = [
            'database/migrations',
            'database/migrations/Main',
        ];

        $this->info('Running migrations...');
        foreach ($migrationPaths as $path) {
            $this->info("Path: $path running");
            Artisan::call('migrate', [
                '--force' => true,
                '--path' => $path,
            ]);
            $this->info("--$path done");
        }

        if ($this->option('seed')) {
            $this->info('Seeding the databases...');
            Artisan::call('db:seed', ['--force' => true]);
        }

        $this->info('All done!');

    }

    private function dropAllTables($connection)
    {
        $driveName = DB::connection()->getDriverName();
        if ($driveName == 'mysql') {
            // MySQL için sorgu
            $query = 'SHOW TABLES';
        } elseif ($driveName == 'sqlite') {
            // SQLite için sorgu
            $query = "SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';";
        } else {
            // Diğer veritabanları için (örn: PostgreSQL, SQL Server vs.)
            throw new \Exception("This database not supported: $connection");
        }

        $tables = DB::connection($connection)->select($query);

        Schema::connection($connection)->disableForeignKeyConstraints();

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            Schema::connection($connection)->drop($tableName);
        }

        Schema::connection($connection)->enableForeignKeyConstraints();
    }
}
