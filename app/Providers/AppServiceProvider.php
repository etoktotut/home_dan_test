<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Http\Composers\IpcComposer;

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
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer(['ipc_add','ipc_all','ipc_one','ipc_one_edit'],IpcComposer::class);
        // View::composer(['ipc_add','ipc_all','ipc_one','ipc_one_edit'], function ($view) {
        //   $vendors=\App\Models\Vendor::orderBy('id')->get();
        //   $ipctypes=\App\Models\Ipctype::orderBy('id')->get();
        //   $lenstypes=\App\Models\Lenstype::orderBy('id')->get();
        //   $lighttypes=\App\Models\Lighttype::orderBy('id')->get();
        //
        //   $view->with('vendors',$vendors)->with('ipctypes',$ipctypes)->with('lenstypes',$lenstypes)->with('lighttypes',$lighttypes);
        //
        //
        // });
      //);
    }
}
