<?php

namespace Pfinal\PfinalWebuploader;

use Illuminate\Support\ServiceProvider;

class PfinalWebuploaderServiceProvider extends ServiceProvider
{
    protected $defer = false; // 延迟加载服务

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //配置
        $configPath = __DIR__ . '/../config/pfinal-uploader.php';
        $this->mergeConfigFrom($configPath, 'pfinal-uploader');
        $this->publishes([$configPath => config_path('pfinal-uploader.php')]);

        //公共资源
        $publicPath = __DIR__ . '/../public';
        $this->publishes([$publicPath => public_path('')]);

        $viewPath = __DIR__ . '/../resources/views';
        $this->loadViewsFrom($viewPath, 'pfinal-webuploader');

        //路由
        $routePath = __DIR__ . '/Http/routes.php';
        if (!$this->app->routesAreCached()) {
            require $routePath;
        }
    }


    public function provides()
    {
        return ['pfinal-uploader'];
    }
}
