<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientController\StoreMaterialRequest;
use App\Http\Requests\Admin\ClientController\StoreRequest;
use App\Http\Requests\Admin\ClientController\UpdateMaterialRequest;
use App\Http\Requests\Admin\ClientController\UpdateRequest;
use App\Models\User;
use App\Services\ClientController\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::orderBy('created_at', 'DESC')->where('id', '!=', Auth()->id())->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        unset($data['password']);
        $data['password'] = Hash::make($request->password);
        return User::create($data);
    }

    public function storeMaterial(StoreMaterialRequest $request, int $client_id)
    {
        return (new MaterialService())->store($request, 'client', $client_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::with('materials')->findOrFail($id);
    }

    public function updateMaterial(UpdateMaterialRequest $request, int $id)
    {
        return (new MaterialService())->update($request, 'client', $id);
    }

    public function deleteMaterial(int $id): \Illuminate\Http\JsonResponse
    {
        return (new MaterialService())->delete($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return Response()->json(['message' => 'true', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return Response()->json(['message' => 'true']);
    }
}
