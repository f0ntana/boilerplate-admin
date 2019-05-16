<?php

namespace App\Bootstrap\Console\Commands;

use Illuminate\Console\Command;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

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
        $name = $this->argument('name');
        $moduleName = camel_case(strtolower(snake_case(str_singular($name))));
        $modulePluralName = str_plural($moduleName);
        $moduleModel = ucwords($moduleName);
        $moduleNamespace = ucwords($modulePluralName);

        $this->info('creating controllers & models');
        // creating controllers and models
        $controllerNamespace = "App\\Modules\\{$moduleNamespace}\\Http\\Controllers\\{$moduleNamespace}Controller";
        $this->call('make:controller', [
            'name' => $controllerNamespace,
            '--model' => "App\\Modules\\{$moduleNamespace}\\Models\\{$moduleModel}",
            '--resource', '--no-interaction'
        ]);

        $controllerPath = str_replace('\\', '/', $controllerNamespace);
        $controllerPath = str_replace_first('App', 'app', $controllerPath);
        $controllerPath = base_path("$controllerPath.php");
        $controllerContents = file_get_contents($controllerPath);
        $controllerContents = str_replace('use App\Http\Controllers\Controller;', 'use App\Bootstrap\Http\Controllers\Controller;', $controllerContents);
        file_put_contents($controllerPath, $controllerContents);


        $this->info('creating module provider');
        $moduleProviderNamespace = "App\\Modules\\{$moduleNamespace}\\Providers";
        $moduleProviderPath = str_replace('App\\', '', $moduleProviderNamespace);
        $moduleProviderPath = str_replace('\\', '/', app_path($moduleProviderPath));

        if (!is_dir($moduleProviderPath)) {
            mkdir($moduleProviderPath);
        }

        $moduleServiceProviderPath = "{$moduleProviderPath}/ModuleServiceProvider.php";
        if (!file_exists($moduleServiceProviderPath)) {
            $moduleProviderContent = file_get_contents(resource_path('stubs/ModuleServiceProvider.stub'));
            $moduleProviderContent = str_replace('$NAMESPACE', $moduleProviderNamespace, $moduleProviderContent);
            $moduleProviderContent = str_replace('$MODULE_NAME', $modulePluralName, $moduleProviderContent);
            file_put_contents($moduleServiceProviderPath, $moduleProviderContent);
        }

        $this->info('creating route provider');
        $moduleControllersNamespace = "App\\Modules\\{$moduleNamespace}\\Http\\Controllers";
        $moduleRouteProviderPath = str_replace('Controllers', 'Routes', $moduleControllersNamespace);
        $moduleRouteProviderPath = str_replace('\\', '/', $moduleRouteProviderPath);
        $moduleRouteProviderPath = str_replace_first('App', 'app', $moduleRouteProviderPath);
        $routeProviderPath = "{$moduleProviderPath}/RouteServiceProvider.php";
        if (!file_exists($routeProviderPath)) {
            $routeProviderContent = file_get_contents(resource_path('stubs/RouteServiceProvider.stub'));
            $routeProviderContent = str_replace('$NAMESPACE', $moduleProviderNamespace, $routeProviderContent);
            $routeProviderContent = str_replace('$CONTROLLERS_NAMESPACE', $moduleControllersNamespace, $routeProviderContent);
            $routeProviderContent = str_replace('$ROUTES_NAMESPACE', "$moduleRouteProviderPath/", $routeProviderContent);
            file_put_contents($routeProviderPath, $routeProviderContent);
        }

        $this->info('creating routes');
        if (!is_dir(base_path($moduleRouteProviderPath))) {
            mkdir(base_path($moduleRouteProviderPath));
            file_put_contents(base_path("{$moduleRouteProviderPath}/web.php"), "<?php\nRoute::resource('{$modulePluralName}', '{$moduleNamespace}Controller');");
            file_put_contents(base_path("{$moduleRouteProviderPath}/api.php"), "<?php\n");
        }

        $this->info('creating views folder');
        $moduleResourcesNamespace = "App\\Modules\\{$moduleNamespace}\\Resources";
        $moduleResourcesPath = str_replace('App\\', '', $moduleResourcesNamespace);
        $moduleResourcesPath = str_replace('\\', '/', app_path($moduleResourcesPath));

        if (!is_dir($moduleResourcesPath)) {
            mkdir($moduleResourcesPath);
        }

        $moduleViewsPath = "$moduleResourcesPath/Views";
        if (!is_dir($moduleViewsPath)) {
            mkdir($moduleViewsPath);
        }

        $moduleViewPath = "{$moduleViewsPath}/{$modulePluralName}";
        if (!is_dir($moduleViewPath)) {
            mkdir($moduleViewPath);
        }

        $this->info('creating repositories folder');
        $moduleRepositoriesNamespace = "App\\Modules\\{$moduleNamespace}\\Repositories";
        $moduleRepositoriesPath = str_replace('App\\', '', $moduleRepositoriesNamespace);
        $moduleRepositoriesPath = str_replace('\\', '/', app_path($moduleRepositoriesPath));

        if (!is_dir($moduleRepositoriesPath)) {
            mkdir($moduleRepositoriesPath);
        }

        $repositoryContent = file_get_contents(resource_path('stubs/Repository.stub'));
        $repositoryContent = str_replace('$NAMESPACE', "App\\Modules\\{$moduleNamespace}\\Repositories", $repositoryContent);
        $repositoryContent = str_replace('$MODEL', "App\\Modules\\{$moduleNamespace}\\Models\\{$moduleModel}", $repositoryContent);
        $repositoryContent = str_replace('$ENTITY', $moduleModel, $repositoryContent);

        file_put_contents("{$moduleRepositoriesPath}/{$moduleModel}Repository.php", $repositoryContent);

    }
}
