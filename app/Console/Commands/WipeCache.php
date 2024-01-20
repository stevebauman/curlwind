<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class WipeCache extends Command
{
    /**
     * The storage disks to wipe.
     */
    protected $disks = ['js', 'css'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:wipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wipe the CSS and JS cache files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->disks as $disk) {
            $this->info("Wiping $disk disk...");

            foreach(Storage::disk($disk)->allFiles() as $file) {
                if ($file === '.gitignore') {
                    continue;
                }

                Storage::disk($disk)->delete($file);
            }
        }
    }
}
