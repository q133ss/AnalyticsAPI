<?php

namespace App\Services\ClientController;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialService
{
    public function store($request, string $type, int $client_id = 0)
    {
        if($client_id != 0) {
            User::findOrFail($client_id);
        }
        $data = $request->validated();
        $data['type'] = $type;

        unset($data['file']);
        unset($data['preview']);
        $data['file_src'] = '/storage/'.$request->file('file')->store('files', 'public');

        if($request->file('preview') != null) {
            $data['preview_src'] = '/storage/'.$request->file('preview')->store('files', 'public');
        }

        $file = File::create($data);

        if($client_id != 0){
            DB::table('users_materials')->insert(['user_id' => $client_id, 'file_id' => $file->id]);
        }

        return $file->load('category');
    }

    public function update($request, int $id)
    {
        $data = $request->validated();
        unset($data['file']);
        unset($data['preview']);

        $file = File::findOrFail($id);
        if($request->file('file') != null){
            Storage::disk('public')->delete(str_replace('/storage/', '', $file->file_src));
            $data['file_src'] = '/storage/'.$request->file('file')->store('files', 'public');
        }

        if($request->file('preview') != null) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $file->preview));
            $data['preview_src'] = '/storage/'.$request->file('preview')->store('files', 'public');
        }

        $file->update($data);

        return $file->load('category');
    }

    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete(str_replace('/storage/', '', $file->file_src));
        Storage::disk('public')->delete(str_replace('/storage/', '', $file->preview));
        $file->delete();

        DB::table('users_materials')->where('file_id', $id)->delete();

        return Response()->json(['message' => 'true']);
    }
}
