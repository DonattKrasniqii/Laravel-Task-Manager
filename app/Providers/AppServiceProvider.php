<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view', fn (User $user, Task $task) => $user->id === $task->user_id);
        Gate::define('update', fn (User $user, Task $task) => $user->id === $task->user_id);
        Gate::define('delete', fn (User $user, Task $task) => $user->id === $task->user_id);
    }
}
