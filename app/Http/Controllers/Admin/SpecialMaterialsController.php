<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientController\StoreMaterialRequest;
use App\Models\File;
use App\Services\ClientController\MaterialService;
use Illuminate\Http\Request;

class SpecialMaterialsController extends Controller
{
    public function index(Request $request)
    {
        return File::withSortDefault($request)->withSort($request)->where('type', 'special')->orderBy('created_at', 'desc')->get();
    }
    public function store(StoreMaterialRequest $request)
    {
        return (new MaterialService())->store($request, 'special');
    }
}
