<?php

namespace App\Providers;

use App\Repositories\ItemRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\EmployeeRepository;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        ItemRepositoryInterface::class => ItemRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ItemRepositoryInterface::class,ItemRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class,EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
