<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Support\Number;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Helper\ProgressBar;

class InstallTailwind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tailwind:install {--force : Overwrite existing executable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the latest TailwindCSS executable';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $binary = match (PHP_OS_FAMILY) {
            'Darwin' => 'tailwindcss-macos-x64',
            'Linux' => 'tailwindcss-linux-x64',
            default => throw new Exception('Unsupported OS.'),
        };

        $outputFile = base_path("bin/$binary");

        if (file_exists($outputFile) && ! $this->option('force')) {
            $this->error("The file $outputFile already exists. Use the --force option to overwrite it.");

            return static::FAILURE;
        }

        $this->info('Downloading TailwindCSS...');

        Http::withOptions([
            'sink' => $outputFile,
            'progress' => $this->onProgress(...),
        ])->timeout(0)->throw()->get(
            "https://github.com/tailwindlabs/tailwindcss/releases/latest/download/$binary"
        );

        $this->newLine();

        $this->info("File downloaded successfully to $outputFile.");

        chmod($outputFile, 0755);

        $this->info("File permissions set to executable.");

        return static::SUCCESS;
    }

    /**
     * Handle displaying the download progress.
     */
    protected function onProgress(int $total, int $downloaded): void
    {
        if (! $total) {
            return;
        }

        static $progress;

        if (! $progress) {
            $progress = $this->output->createProgressBar($total);

            $progress->setFormat('%current%/%max% [%bar%] %percent%%');

            $progress->setPlaceholderFormatterDefinition('current', fn (ProgressBar $bar) => (
                Number::fileSize($bar->getProgress())
            ));

            $progress->setPlaceholderFormatterDefinition('max', fn (ProgressBar $bar) => (
                Number::fileSize($bar->getMaxSteps())
            ));

            $progress->start();
        }

        if ($total === $downloaded) {
            $progress->finish();

            return;
        }

        $progress->setProgress($downloaded);
    }
}
