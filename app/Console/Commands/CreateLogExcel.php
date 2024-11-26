<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivityLogExport;

class CreateLogExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:create-excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create initial log Excel file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = public_path('storage/logs');
        
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $filePath = $directory . '/logs.xlsx';
        
        // Tạo file Excel trống với header
        Excel::store(
            new ActivityLogExport([]),
            'logs/logs.xlsx',
            'public'
        );

        $this->info('Log Excel file created at: ' . $filePath);
    }
}
