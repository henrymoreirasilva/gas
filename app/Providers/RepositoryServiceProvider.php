<?php
namespace Gas\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Gas\Repositories\BranchRepository::class, \Gas\Repositories\BranchRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\ClientRepository::class, \Gas\Repositories\ClientRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\ProductRepository::class, \Gas\Repositories\ProductRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\SaleItemRepository::class, \Gas\Repositories\SaleItemRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\SaleRepository::class, \Gas\Repositories\SaleRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\SellerRepository::class, \Gas\Repositories\SellerRepositoryEloquent::class);

        $this->app->bind(\Gas\Repositories\UserRepository::class, \Gas\Repositories\UserRepositoryEloquent::class);
        
    }
}
