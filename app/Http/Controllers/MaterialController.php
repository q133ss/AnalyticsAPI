<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function get(Request $request, string $type)
    {
        switch ($type){
            case 'materials':
                $user = Auth()->user();
                return $user->materials()->withSortDefault($request)->withSort($request)->get();
            case 'general':
                return File::where('type', 'all')->withSortDefault($request)->withSort($request)->get();
            case 'special':
                return File::where('type', 'special')->withSortDefault($request)->withSort($request)->get();
        }
    }

    public function getByIds(Request $request)
    {
        return File::whereIn('id', $request->id)->withSortDefault($request)->withSort($request)->get();
    }
}
