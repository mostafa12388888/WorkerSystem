<?php

namespace App\Providers;

use App\desiger\interface\{clinetServicesinterface, workerprofileInterFace, WorkerReviewIterface};

use App\desiger\Repostory\{clinetServicesRepostory, workerprofileRepostory, WorkerReviewRepostory};
use Illuminate\Support\ServiceProvider;

class DesigProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(clinetServicesinterface::class,clinetServicesRepostory::class);
        $this->app->bind(WorkerReviewIterface::class,WorkerReviewRepostory::class);
        $this->app->bind(workerprofileInterFace::class,workerprofileRepostory::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
