<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
//        $this->mapApiRoutes();
        $this->mapWebRoutes();

        // Custom routes
        $this->mapKeysRoutes();
        $this->mapObjectsRoutes();
        $this->mapInventoryRoutes();
        $this->mapKnowledgeRoutes();
        $this->mapTaskManagerRoutes();
        $this->mapUsersRoutes();
        $this->mapCabinetRoutes();
        $this->mapExternalRoutes();
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
        $this->mapEmployeesRoutes();
=======
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
=======
        $this->mapEmployeesRoutes();
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapKeysRoutes()
    {
        Route::prefix('keys')
            ->name('keys.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Keys')
            ->group(base_path('routes/Routes/Keys.php'));
    }

    protected function mapObjectsRoutes()
    {
        Route::prefix('objects')
            ->name('objects.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Objects')
            ->group(base_path('routes/Routes/Objects.php'));
    }

    protected function mapInventoryRoutes()
    {
        Route::prefix('inventory')
            ->name('inventory.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Inventory')
            ->group(base_path('routes/Routes/Inventory.php'));
    }

    protected function mapKnowledgeRoutes()
    {
        Route::prefix('knowledge')
            ->name('knowledge.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Knowledge')
            ->group(base_path('routes/Routes/Knowledge.php'));
    }

    protected function mapTaskManagerRoutes()
    {
        Route::prefix('task-manager')
            ->name('tasks.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\TaskManager')
            ->group(base_path('routes/Routes/TaskManager.php'));
    }

    protected function mapUsersRoutes()
    {
        Route::prefix('users')
            ->name('users.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Users')
            ->group(base_path('routes/Routes/Users.php'));
    }

    protected function mapCabinetRoutes()
    {
        Route::prefix('cabinet')
            ->name('cabinet.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Cabinet')
            ->group(base_path('routes/Routes/Cabinet.php'));
    }

    protected function mapExternalRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/Routes/External.php'));
    }
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
=======
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)

    protected function mapEmployeesRoutes()
    {
        Route::prefix('employees')
            ->name('employees.')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Employees')
            ->group(base_path('routes/Routes/Employees.php'));
    }

<<<<<<< refs/remotes/origin/master
=======
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
=======
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
}
