<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TanksImport;

class InsertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-data {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $filename = $this->argument('filename');

            if ( !(Storage::disk('local')->exists($filename)) ) {
                throw new \Exception('File tidak ditemukan!');
            }

            Excel::import(new TanksImport, $filename, 'local');

            $this->info('Berhasil insert data');
        }
        catch (\Throwable $th) {
            throw $th;
            $this->error('Gagal insert data!');
        }
    }
}
