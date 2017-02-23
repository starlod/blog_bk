<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;
use File;

class StorageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        DB::table('links')->truncate();
        $files = File::allFiles(storage_path('app/public'));

        foreach ($files as $file) {
            $filepath = $file->getRealPath();
            if (!File::exists($filepath)) {
                $this->error("$filepath file not found.");
                Log::error("$filepath file not found.");
                continue;
            }
            if (!File::isWritable($filepath)) {
                $this->error("$filepath file not permission.");
                Log::error("$filepath file not permission.");
                continue;
            }

            // ファイル削除
            File::delete($filepath);
        }
    }
}
