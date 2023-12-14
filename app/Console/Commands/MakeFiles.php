<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Touhidurabir\StubGenerator\Facades\StubGenerator;

class MakeFiles extends Command
{
    /**
     * The name and signature of the console command.
     * R = Repository | Repository Interface -done
     * S = Service
     * C = Controller -done
     * M = Model -done
     * V = Vue File -done
     * Q = Request
     * L = List Resource
     * T = Table Resource
     * G = Detail Resource
     *
     * @var string
     */
    protected $signature = 'make:module {module} {--table=} {--title=} {--include=} {--overwrite=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes files for the Service - Repository - DTO pattern';

    /**
     * The default stub path
     */
    protected $stubPath = "";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stubPath = "stubs/custom";
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $include = $this->options()['include'];
        $include = str_split(!empty($include) ? $include : "RDSCMVPQL");
        try {
            // C
            if (in_array('C', $include)) {
                $this->controllerGenerator();
            }
            // Q
            if (in_array('Q', $include)) {
                $this->requestGenerator();
            }
            // R
            if (in_array('R', $include)) {
                $this->repositoryInterfaceGenerator();
                $this->repositoryGenerator();
            }
            // M
            if (in_array('M', $include)) {
                $this->modelGenerator();
            }
            // S
            if (in_array('S', $include)) {
                $this->serviceGenerator();
            }
            // L
            if (in_array('L', $include)) {
                $this->listCollectionGenerator();
                $this->listResourceGenerator();
            }
            // T
            if (in_array('T', $include)) {
                $this->tableCollectionGenerator();
                $this->tableResourceGenerator();
            }
            // G
            if (in_array('G', $include)) {
                $this->detailResourceGenerator();
            }
            // V
            // if (in_array('V', $include)) {
            //     $this->vueListGenerator();
            //     $this->vueCreateGenerator();
            // }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }

        $this->info('The command was successful!');
        return Command::SUCCESS;
    }

    /**
     * Generate a controller using a stub file
     *
     * @return void
     */
    private function controllerGenerator()
    {
        // Generate the controller
        $table = $this->options()['table'];
        $title = $this->options()['title'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);
        // Note: Create Namespace and Path after pop in case of Provider and Model
        // Otherwise create the Namespace first
        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);
        $vuePath = implode('\\', $parts);

        $modelNamespace = implode('\\', $parts);

        $modelVariable = lcfirst($name);

        $urlNamespace = lcfirst($vuePath);

        $urlFormat = preg_replace('/(?<!\ )[A-Z]/', '-$0', $modelVariable);
        $urlWord = strtolower($urlFormat);
        $urlPath = "/{$urlNamespace}/{$urlWord}";

        $from = "{$this->stubPath}/controller.stub";
        $to = "app/Http/Controllers/{$path}";

        $class = "{$name}Controller";
        $classNamespace = "App\\Http\\Controller\\{$namespace}";
        $baseClass = "App\\Http\\Controllers\\Controller";

        $modelNamespace = "App\\Models\\{$modelNamespace}";
        $parentModelVariable = "{$modelVariable}";

        $class = "{$name}Controller";
        $classNamespace = "App\\Http\\Controllers\\{$namespace}";

        $serviceClass = "{$name}Service";
        $serviceNamespace = "App\\Services\\{$namespace}\\{$name}Service";

        $listPagePath = "Frontend/List";
        $createPagePath =  "Frontend/Create";


        $requestClass = "{$name}Request";
        $requestNamespace = "App\\Http\\Requests\\{$namespace}\\{$requestClass}";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'name'              => $name,
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'title'             => $title,
                    'modelNamespace'    => $modelNamespace,
                    'baseClass'         => $baseClass,
                    'classNamespace'    => $classNamespace,
                    'parentModelVariable' => $parentModelVariable,
                    'serviceNamespace'  => $serviceNamespace,
                    'serviceClass'      => $serviceClass,
                    'listPagePath'      => $listPagePath,
                    'createPagePath'    => $createPagePath,
                    'urlPath'           => $urlPath,
                    'requestClass'      => $requestClass,
                    'requestNamespace'  => $requestNamespace
                ])
                ->save();
        } catch (Exception $e) {

            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a request using a stub file
     *
     * @return void
     */
    public function requestGenerator()
    {
        //Generate the request

        $table = $this->options()['table'];

        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);

        $from = "{$this->stubPath}/request.stub";
        $to = "app/Http/Requests/{$path}";

        $class = "{$name}Request";
        $classNamespace = "App\\Http\\Requests\\{$namespace}";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'classNamespace'    => $classNamespace,
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a list collection using a stub file
     *
     * @return void
     */
    private function listCollectionGenerator()
    {
        // Generate the resource
        $table = $this->options()['table'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);
        $modelNamespace = implode('\\', $parts);

        $from = "{$this->stubPath}/list-collection.stub";
        $to = "app/Http/Resources/{$path}/Lists";

        $class = "{$name}ListCollection";
        $classNamespace = "App\\Http\\Resources\\{$namespace}\\Lists";
        $modelNamespace = "App\\Models\\{$modelNamespace}\\{$name}";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     *
     */
    private function listResourceGenerator()
    {
        // Generate the resource
        $table = $this->options()['table'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);

        $from = "{$this->stubPath}/list-resource.stub";
        $to = "app/Http/Resources/{$path}/Lists";

        $class = "{$name}ListResource";
        $classNamespace = "App\\Http\\Resources\\{$namespace}\\Lists";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'classNamespace'    => $classNamespace
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a table collection using a stub file
     *
     * @return void
     */
    private function tableCollectionGenerator()
    {
        // Generate the resource
        $table = $this->options()['table'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);
        $modelNamespace = implode('\\', $parts);

        $from = "{$this->stubPath}/table-collection.stub";
        $to = "app/Http/Resources/{$path}/Table";

        $class = "{$name}TableCollection";
        $classNamespace = "App\\Http\\Resources\\{$namespace}\\Table";
        $modelNamespace = "App\\Models\\{$modelNamespace}\\{$name}";

        $tableResourceNamespace = "App\\Http\Resources\\{$namespace}\\Table\\{$name}TableResource";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                    'tableResourceNamespace' => $tableResourceNamespace,
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a table resource using a stub file
     *
     * @return void
     */
    private function tableResourceGenerator()
    {
        // Generate the resource
        $table = $this->options()['table'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);

        $from = "{$this->stubPath}/table-resource.stub";
        $to = "app/Http/Resources/{$path}/Table";

        $class = "{$name}TableResource";
        $classNamespace = "App\\Http\\Resources\\{$namespace}\\Table";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'classNamespace'    => $classNamespace
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a detail resource using a stub file
     *
     * @return void
     */
    private function DetailResourceGenerator()
    {
        // Generate the resource
        $table = $this->options()['table'];
        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);

        $from = "{$this->stubPath}/detail-resource.stub";
        $to = "app/Http/Resources/{$path}";

        $class = "{$name}DetailResource";
        $classNamespace = "App\\Http\\Resources\\{$namespace}";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $name,
                    'table'             => $table,
                    'classNamespace'    => $classNamespace
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a repository using a stub file
     *
     * @return void
     */
    private function repositoryGenerator()
    {
        // Generate the repository
        $table = $this->options()['table'];

        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);
        $modelNamespace = implode('\\', $parts);

        $from = "{$this->stubPath}/repository.stub";
        $to = "app/Repositories/{$path}";

        $class = "{$name}Repository";
        $classNamespace = "App\\Repositories\\{$namespace}";
        $modelNamespace = "App\\Models\\{$modelNamespace}\\{$name}";
        $model = "{$name}";
        $modelObject = lcfirst($name);
        $modelInstance = $table;

        $pluralClass = Str::plural($name);

        $interfaceNamespace =  "App\\Repositories\\{$namespace}\\RepoInterface\\{$name}RepoInterface";
        $interfaceClass = "{$name}RepoInterface";

        $requestNamespace = "App\\Http\\Requests\\{$namespace}\\{$name}Request";
        $requestClass = "{$name}Request";

        $detailsResourceNamespace = "App\\Http\\Resources\\{$namespace}\\{$name}DetailResource";
        $detailsResourceClass = "{$name}DetailResource";
        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'name'              => $name,
                    'class'             => $class,
                    'model'             => $model,
                    'modelInstance'     => $modelInstance,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                    'interfaceClass'    => $interfaceClass,
                    'interfaceNamespace' => $interfaceNamespace,
                    'modelObject'       => $modelObject,
                    'pluralClass'       => $pluralClass,
                    'requestNamespace'      => $requestNamespace,
                    'requestClass'          => $requestClass,
                    'detailsResourceNamespace' => $detailsResourceNamespace,
                    'detailsResourceClass' => $detailsResourceClass
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a repository interface using a stub file
     *
     * @return void
     */
    public function repositoryInterfaceGenerator()
    {
        //Generate the repository interface

        $table = $this->options()['table'];

        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);
        $modelNamespace = implode('\\', $parts);

        $interfaceVariable = lcfirst($name);

        $from = "{$this->stubPath}/interface.stub";
        $to = "app/Repositories/{$path}/RepoInterface";

        $class = "{$name}RepoInterface";
        $classNamespace = "App\\Repositories\\{$namespace}\\RepoInterface";
        $modelNamespace = "App\\Models\\{$modelNamespace}\\{$name}";
        $model = "{$name}";
        $modelInstance = $table;
        $interfaceVariable = "{$interfaceVariable}RepoInterface";

        $requestNamespace = "App\\Http\Requests\\{$namespace}\\{$name}Request";
        $requestClass = "{$name}Request";


        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'name'              => $name,
                    'class'             => $class,
                    'model'             => $model,
                    'modelInstance'     => $modelInstance,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                    'interfaceVariable' => $interfaceVariable,
                    'requestNamespace'  => $requestNamespace,
                    'requestClass'      => $requestClass
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a service using a stub file
     *
     * @return void
     */
    public function serviceGenerator()
    {
        //Generate the service

        $table = $this->options()['table'];

        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $namespace = implode('\\', $parts);
        $path = implode('/', $parts);

        $name = array_pop($parts);

        $modelNamespace = implode('\\', $parts);

        $from = "{$this->stubPath}/service.stub";
        $to = "app/Services/{$path}";

        $class = "{$name}Service";
        $classNamespace = "App\\Services\\{$namespace}";
        $modelNamespace = "App\\Models\\{$modelNamespace}\\{$name}";
        $model = "{$name}";
        $modelObject = lcfirst($name);
        $modelInstance = $table;

        $tableCollectionClass = "{$name}TableCollection";
        $tableCollectionNamespace = "App\\Http\\Resources\\{$namespace}\\Table\\{$name}TableCollection";

        $listResourceClass = "{$name}ListResource";
        $listResourceNamespace = "App\\Http\\Resources\\{$namespace}\\Lists\\{$name}ListResource";

        $repositoryClass = "{$name}Repository";
        $repositoryNamespace = "App\\Repositories\\{$namespace}\\{$name}Repository";

        $requestNamespace = "App\\Http\\Requests\\{$namespace}\\{$name}Request";
        $requestClass = "{$name}Request";

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'name'              => $name,
                    'class'             => $class,
                    'model'             => $model,
                    'modelInstance'     => $modelInstance,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                    'tableCollectionClass'   => $tableCollectionClass,
                    'repositoryClass'   => $repositoryClass,
                    'tableCollectionNamespace' => $tableCollectionNamespace,
                    'repositoryNamespace' => $repositoryNamespace,
                    'requestClass'       => $requestClass,
                    'requestNamespace'       => $requestNamespace,
                    'listResourceClass' => $listResourceClass,
                    'listResourceNamespace' => $listResourceNamespace,
                    'modelObject' => $modelObject
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Generate a model using a stub file
     *
     * @return void
     */
    public function modelGenerator()
    {
        //Generate the model

        $table = $this->options()['table'];

        $module = $this->argument('module');
        $parts  = explode('/', $module);

        $name = array_pop($parts);
        $namespace = implode('\\', $parts);

        $from = "{$this->stubPath}/model.stub";
        $to = "app/Models/{$namespace}";

        $class = "{$name}";
        $classNamespace = "App\\Models\\{$namespace}";
        $modelNamespace = "App\\Models\\{$namespace}";
        $model = "{$name}";
        $modelInstance = $table;

        try {
            StubGenerator::from($from)
                ->to($to, true)
                ->as($class)
                ->withReplacers([
                    'class'             => $class,
                    'model'             => $model,
                    'modelInstance'     => $modelInstance,
                    'modelNamespace'    => $modelNamespace,
                    'classNamespace'    => $classNamespace,
                    'table'             => $table
                ])
                ->save();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    // /**
    //  * Generate a vue list using a stub file
    //  *
    //  * @return void
    //  */
    // private function vueListGenerator()
    // {
    //     // Generate the vue file
    //     $table = $this->options()['table'];

    //     $title = $this->options()['title'];

    //     $module = $this->argument('module');
    //     $parts  = explode('/', $module);

    //     $name = array_pop($parts);

    //     $from = "{$this->stubPath}/list-vue.stub";
    //     $to = "resources/js/Pages/{$module}";

    //     $class = "List{$name}";

    //     $classObject = lcfirst($name);

    //     try {
    //         StubGenerator::from($from)
    //             ->to($to, true)
    //             ->as($class)
    //             ->ext('vue') // the file extension(optional, by default to php)
    //             ->withReplacers([
    //                 'class'             => $class,
    //                 'classObject'       => $classObject,
    //                 'title'             => $title
    //             ])
    //             ->save();
    //     } catch (Exception $e) {
    //         $this->error($e->getMessage());
    //     }
    // }

    // /**
    //  * Generate a vue create using a stub file
    //  *
    //  * @return void
    //  */
    // private function vueCreateGenerator()
    // {
    //     // Generate the vue file
    //     $table = $this->options()['table'];

    //     $title = $this->options()['title'];

    //     $module = $this->argument('module');
    //     $parts  = explode('/', $module);

    //     $name = array_pop($parts);

    //     $from = "{$this->stubPath}/create-vue.stub";
    //     $to = "resources/js/Pages/{$module}";

    //     $class = "Create{$name}";

    //     $classObject = lcfirst($name);

    //     try {
    //         StubGenerator::from($from)
    //             ->to($to, true)
    //             ->as($class)
    //             ->ext('vue') // the file extension(optional, by default to php)
    //             ->withReplacers([
    //                 'class'             => $class,
    //                 'classObject'       => $classObject,
    //                 'title'             => $title
    //             ])
    //             ->save();
    //     } catch (Exception $e) {
    //         $this->error($e->getMessage());
    //     }
    // }
}
