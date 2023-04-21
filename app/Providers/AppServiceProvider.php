<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		// Важно здесь указать путь к шаблону пагинации из папки "resources/views/vendor/pagination" который мы хотим использовать:
		// Путь к шаблону указывается по папкам через точку:	Так подключается шаблон "resources/views/vendor/pagination/bootstrap-4.blade.php"
		Paginator::defaultView('vendor.pagination.bootstrap-4');
		// Tailwind ставится по умолчанию почему-то, страница выглядит поломанной
    }
}
