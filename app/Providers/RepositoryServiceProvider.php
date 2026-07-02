<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Maps each repository interface to its Eloquent implementation.
     * Concrete bindings are added here as modules are built out.
     */
    protected array $repositoryBindings = [];

    public function register(): void
    {
        foreach ($this->repositoryBindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
