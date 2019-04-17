<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
            $event->menu->add('MENU DE NAVEGACION');

                switch (Auth::user()->role) {

                    case 'administrador':

                    $event->menu->add(
                        [
                            'text' => 'Dashboard',
                            'route' => 'home',
                            'icon' => 'dashboard'
                        ],
                        [
                            'text' => 'Perfil',
                            'route' => 'users.profile',
                            'icon' => 'user-md'
                        ],
                        [
                            'text' => 'Profesores',
                            'route' => 'users.teachers',
                            'icon' => 'user'
                        ],
                        [
                            'text' => 'Estudiantes',
                            'route' => 'users.students',
                            'icon' => 'users'
                        ],
                        [
                            'text' => 'Clases',
                            'route' => 'lessons.index',
                            'icon' => 'list'
                        ],
                        [
                            'text' => 'Calendario',
                            'route' => 'calendars.index',
                            'icon' => 'calendar'
                        ],
                        [
                            'text' => 'Creditos',
                            'route' => 'credits.index',
                            'icon' => 'money'
                        ]
                    );

                    break;

                    case 'profesor':

                    break;

                    case 'estudiante':

                    break;

                }
        });
    }
}