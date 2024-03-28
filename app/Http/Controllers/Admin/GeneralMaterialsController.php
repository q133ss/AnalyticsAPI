<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientController\StoreMaterialRequest;
use App\Http\Requests\Admin\ClientController\UpdateMaterialRequest;
use App\Models\File;
use App\Services\ClientController\MaterialService;
use Illuminate\Http\Request;

class GeneralMaterialsController extends Controller
{
    public function index()
    {
        return File::where('type', 'all')->orderBy('created_at', 'desc')->get();
    }
    public function store(StoreMaterialRequest $request)
    {
        return (new MaterialService())->store($request, 'all');
    }
}
