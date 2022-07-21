<?php

namespace App\Http\Controllers\Daughter;

use App\Models\File;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class FilesProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);
        $daughter->profile;

        if ($daughter->profile) {
            $query = File::query();
            $files = $daughter->profile->files;
            $index = array();
            foreach ($files as $file) {
                $index[] = $file->id;
            }
            $query->whereIn('id', $index);

            if (request('search')) {
                $query->where('external_filename', 'LIKE', '%' . request('search') . '%');
            }

            if (request('dateStart') || request('dateEnd')) {
                $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                    'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                    'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors());
                } else {
                    $query->whereBetween('created_at', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('created_at', 'desc');
                }
            }
            $addressClass = new AddressController();
            $provinces =  $addressClass->getProvinces();

            return Inertia::render('Daughter/Files', [
                'daughter' => $daughter,
                'allProvinces' => $provinces,
                'files_list' => $query
                    ->paginate(10)
                    ->appends(request()->query()),
                'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd']),

            ]);
        } else {
            return abort(404);
        }
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
    public function store(Request $request, $user_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);


        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make([
            'filedata' => $request->file('filedata'),
        ], [
            'filedata' => ['required', 'max:5000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }


        if ($request->hasFile('filedata')) {

            $user =  User::find($user_id);
            $file = $request->file('filedata');
            $name = $file->getClientOriginalName();
            $fileSize = filesize($file);
            $filePath = 'documents/daugther-profiles/files/' . $user->id . '/' . $name;

            if ($user->profile) {
                $filesCount =  count($user->profile->files);
                $fileOld = $user->profile->files()
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
                    if ($filesCount < 10) {
                        Storage::disk('s3')->put($filePath, file_get_contents($file));
                        Storage::disk('s3')->setVisibility($filePath, 'private');

                        $user->profile->files()->create([
                            'filename' => $filePath,
                            'external_filename' => $name,
                            'filesize' => $fileSize,
                            'url' => Storage::disk('s3')->url($filePath)
                        ]);
                        return redirect()->back()->with(['success' => 'Archivo guardado correctamente.']);
                    } else {
                        return redirect()->back()->with(['error' => 'Excede la cantidad de archivos permitidos.']);
                    }
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
