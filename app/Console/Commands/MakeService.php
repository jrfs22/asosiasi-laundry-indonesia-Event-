<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a service Class';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $servicePath = app_path('Services');

        if(!$this->files->isDirectory($servicePath)) {
            $this->files->makeDirectory($servicePath);
            $this->info('Service folder created successfull');
        }else {
            $this->info('Already Exist');
        }

        $name = $this->argument('name');

        if($name) {
            $this->createServiceClass($name);
        }
    }

    protected function createServiceClass($name)
    {
        $path = app_path("Services/{$name}.php");

        if($this->files->exists($path))
        {
            $this->error("Service class {$name} already exists!!!");
            return;
        }

        $stub = "<?php

namespace App\Services;

class {$name}
{
    // Ur method
}";

        $this->files->put($path, $stub);
        $this->info('Service class {$name} created successfully');
    }
}
