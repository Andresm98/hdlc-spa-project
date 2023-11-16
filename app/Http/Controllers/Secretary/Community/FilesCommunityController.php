<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\File;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FilesCommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $community =  Community::find($community_id);

        return $community->files()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);


        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make([
            'filedata' => $request->file('filedata'),
        ], [
            'filedata' => ['required', 'max:10000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }


        if ($request->hasFile('filedata')) {

            $community =  Community::find($community_id);

            $file = $request->file('filedata');
            $name = $file->getClientOriginalName();
            $fileSize = filesize($file);

            if ($community->comm_id != null) {
                $communityFirst =  Community::find($community->comm_id);
                $filePath = 'documents/communities/files/' .   $communityFirst->id . '/' . $community->id . '/' . $name;
            } else {

                $filePath = 'documents/communities/files/' . $community->id . '/' . $name;
            }

            $filesCount =  count($community->files);
            $fileOld = $community->files()
                ->where('external_filename', '=', $name)
                ->get()
                ->first();

            if ($fileOld != null) {
                Storage::disk('s3')->delete($fileOld->filename);

                Storage::disk('s3')->put($filePath, file_get_contents($file));
                Storage::disk('s3')->setVisibility($filePath, 'private');

                $fileOld->update([
                    'filename' => $filePath,
                    'external_filename' => $name,
                    'filesize' => $fileSize,
                    'url' => Storage::disk('s3')->url($filePath)
                ]);
                return redirect()->back()->with(['success' => 'Archivo actualizado correctamente.']);
            } else {
                if ($filesCount < 15) {
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
                    Storage::disk('s3')->setVisibility($filePath, 'private');

                    $community->files()->create([
                        'filename' => $filePath,
                        'external_filename' => $name,
                        'filesize' => $fileSize,
                        'url' => Storage::disk('s3')->url($filePath)
                    ]);
                    return redirect()->back()->with(['success' => 'Archivo guardado correctamente.']);
                } else {
                    return redirect()->back()->with(['error' => 'Excede la cantidad de archivos permitidos, max 15 archivos.']);
                }
            }

            return redirect()->back()->with(['error' => 'Adjuntar archivo.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file_id)
    {
        $validator = Validator::make(['file_id' => $file_id], [
            'file_id' => ['required', 'exists:files,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $file = File::find($file_id);

        return  Storage::disk('s3')->download($file->filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($file_id)
    {

        $validator = Validator::make(['id' => $file_id], [
            'id' => ['exists:files,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $file = File::find($file_id);

        return    Storage::disk('s3')->temporaryUrl(
            $file->filename,
            now()->addMinutes(5)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_id)
    {
        $validator = Validator::make(['id' => $file_id], [
            'id' => 'exists:files,id'
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $file = File::find($file_id);
        Storage::disk('s3')->delete($file->filename);
        $file->delete();

        return redirect()->back()->with(['success' => 'Archivo eliminado correctamente.']);
    }
}
