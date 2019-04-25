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
                            'route' => 'teachers.index',
                            'icon' => 'user'
                        ],
                        [
                            'text' => 'Estudiantes',
                            'route' => 'students.index',
                            'icon' => 'users'
                        ],
                        [
                            'text' => 'Clases',
                            'route' => 'lessons.index',
                            'icon' => 'list'
                        ],
                        [
                            'text' => 'Calendario',
                            'route' => 'list.calendars',
                            'icon' => 'calendar'
                        ],
                        [
                            'text' => 'Horas',
                            'route' => 'credits.index',
                            'icon' => 'money'
                        ]
                    );

                    break;

                    case 'profesor':
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
                                'text' => 'Calendario',
                                'route' => 'calendars.index',
                                'icon' => 'calendar'
                            ]
                        );
                    break;

                    case 'estudiante':
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
                                'text' => 'Mis Clases',
                                'route' => 'my.lessons',
                                'icon' => 'calendar'
                            ]
                        );
                    break;

                }
        });
    }
}
