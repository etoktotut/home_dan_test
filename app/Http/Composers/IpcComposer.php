<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class IpcComposer
{

    protected $vendors;
    protected $ipctypes;
    protected $lenstypes;
    protected $lighttypes;

    public function __construct()
    {
     $this->vendors=\App\Models\Vendor::all();
     $this->ipctypes=\App\Models\Ipctype::orderBy('id')->get();
     $this->lenstypes=\App\Models\Lenstype::orderBy('id')->get();
     $this->lighttypes=\App\Models\Lighttype::orderBy('id')->get();
    }

    public function compose(View $view)
    {
        $view->with('vendors', $this->vendors);
        $view->with('ipctypes', $this->ipctypes);
        $view->with('lenstypes', $this->lenstypes);
        $view->with('lighttypes', $this->lighttypes);
    }
}
