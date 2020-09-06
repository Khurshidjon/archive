<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Folder;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::query()->where('status', 1)->where('parent_id', null)->get();
        $collection_folders = Folder::query()->where('status', 1)->get();
        return view('files.index', [
            'folders' => $folders,
            'collection_folders' => $collection_folders
        ]);
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
    public function store(Request $request)
    {
        $files = $request->file('files');
        $request->validate([
            'files[]' => 'unique:files',
        ]);

        foreach($files as $file)
        {
            $destinationPath = 'uploads/' . date('Y') . '/' . date('F') . '/' . date('d');
            
            $fileName = $file->getClientOriginalName(); //Get Image Name
            $fileSize = $file->getSize(); //Get Image Size
            $extension = $file->getClientOriginalExtension();  //Get Image Extension
        
            $model = new File();
            $model->file_name = $fileName;
            $model->file_size = $fileSize;
            $model->file_extension = $extension;
            $model->file_path = $destinationPath;
            $model->folder_id = $request->post('folder_id');

            if($model->save()){
                $file->move($destinationPath, $fileName);
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return view('files.show', [
            'file' => $file
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $file)
    {

        File::query()->find($file)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
