<?php

namespace App\Http\Controllers;

use App\Models\akunModel;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\roleModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $roleModel, $akunModel, $kategoriModel, $menuModel;

    public function __construct()
    {
        $this->roleModel = new roleModel();
        $this->akunModel = new akunModel();
        $this->kategoriModel = new Kategori();
        $this->menuModel = new Menu();
    }
}
