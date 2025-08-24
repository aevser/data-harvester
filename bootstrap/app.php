<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command('app:get-stocks')
            ->name('app:get-stocks')
            ->description('Получить данные о складах')
            ->daily()
            ->withoutOverlapping();

        $schedule->command('app:get-incomes')
            ->name('app:get-incomes')
            ->description('Получить данные о доходах')
            ->daily()
            ->withoutOverlapping();

        $schedule->command('app:get-sales')
            ->name('app:get-sales')
            ->description('Получить данные о проходах')
            ->daily()
            ->withoutOverlapping();

        $schedule->command('app:get-orders')
            ->name('app:get-orders')
            ->description('Получить данные о заказах')
            ->daily()
            ->withoutOverlapping();
    })
    ->create();
