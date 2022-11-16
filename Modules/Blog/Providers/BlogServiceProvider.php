<?php

namespace Modules\Blog\Providers;

use Config;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Blog\Repositories\Impl\BlogCategoryRepositoryImpl;
use Modules\Blog\Repositories\Impl\BlogRepositoryImpl;
use Modules\Blog\Services\BlogCategoryService;
use Modules\Blog\Services\BlogService;
use Modules\Blog\Services\Impl\BlogCategoryServiceImpl;
use Modules\Blog\Services\Impl\BlogServiceImpl;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'Blog';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'blog';

    /**
     * @var array<class-string, class-string>
     */
    public array $singletons = [
        // Blog
        Blog::class => Blog::class,
        BlogRepository::class => BlogRepositoryImpl::class,
        BlogService::class => BlogServiceImpl::class,
        // BlogCategory
        BlogCategory::class => BlogCategory::class,
        BlogCategoryRepository::class => BlogCategoryRepositoryImpl::class,
        BlogCategoryService::class => BlogCategoryServiceImpl::class,
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<integer, class-string>
     */
    public function provides(): array
    {
        return [
            // Blog
            Blog::class,
            BlogRepository::class,
            BlogService::class,
            // BlogCategory
            BlogCategory::class,
            BlogCategoryRepository::class,
            BlogCategoryService::class,
        ];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
