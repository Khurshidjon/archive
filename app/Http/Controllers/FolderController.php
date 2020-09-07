<?php

namespace App\Http\Controllers;

use App\Category;
use App\Folder;
use App\File;
use App\Language;
use App\Type;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::query()->where('status', 1)->where('parent_id', null)->get();
        $categories = Category::query()->where('status', 1)->get();
        $languages = Language::query()->get();
        $types = Type::query()->get();

        $title = null;
        $author = null;
        $category_selected = null;
        $type_selected = null;
        $document_number = null;
        $language_selected = null;
        
        return view('folders.index', [
            'folders' => $folders,
            'categories' => $categories,
            'languages' => $languages,
            'types' => $types,
            'title' => $title,
            'author' => $author,
            'category_selected' => $category_selected,
            'type_selected' => $type_selected,
            'document_number' => $document_number,
            'language_selected' => $language_selected
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
        $request->validate([
            'title' => 'string|max:20'
        ]);
        Folder::query()->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        $files = File::query()->where('folder_id', $folder->id)->get();
        $categories = Category::query()->where('status', 1)->get();
        $types = Type::query()->get();
        $languages = Language::query()->get();
        
        $title = null;
        $author = null;
        $category_selected = null;
        $type_selected = null;
        $document_number = null;
        $language_selected = null;

        return view('folders.show', [
            'folder' => $folder,
            'files' => $files,
            'categories' => $categories,
            'types' => $types,
            'languages' => $languages,
            'title' => $title,
            'author' => $author,
            'category_selected' => $category_selected,
            'type_selected' => $type_selected,
            'document_number' => $document_number,
            'language_selected' => $language_selected
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        Folder::query()->find($folder->id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
    }

    /**
     * Create file.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createFileModal(Request $request)
    {
        $folder_id = $request->post('folder_id');
        $folder = Folder::query()->find($folder_id);
        $files = File::query()->where('folder_id', $folder->id)->get();
        $categories = Category::query()->where('status', 1)->get();
        $types = Type::query()->get();
        $languages = Language::query()->get();

        return view('modal.create-file', [
            'folder' => $folder,
            'files' => $files,
            'categories' => $categories,
            'types' => $types,
            'languages' => $languages
        ])->render();
    }

    /**
     * @param  Request  $request
     * Saerch the specified resource from storage.
     */

    public function searchModal(Request $request)
    {
        $categories = Category::query()->where('status', 1)->get();
        $types = Type::all();
        $folder_id = $request->get('folder_id');
        $folder = Folder::query()->find($folder_id);
        return view('modal.search', [
            'categories' => $categories,
            'types' => $types,
            'folder' => $folder
        ])->render();
    }

    /**
     * Search files result.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchResult(Request $request)
    {
        $folder_id = $request->get('folder_id');
        $folders = Folder::query()->get();
        $categories = Category::query()->where('status', 1)->get();
        $types = Type::all();
        $languages = Language::all();
        $files = File::query();

        $title = $request->title;
        $author = $request->document_author;
        $category_selected = $request->category_id;
        $type_selected = $request->type_id;
        $document_number = $request->document_number;
        $language_selected = $request->language;

        if($request->title != null){
            $files->where('title', 'LIKE', '%'.$request->title.'%');
        }elseif ($request->document_author != null){
            $files->where('document_author', 'LIKE', '%'.$request->document_author.'%');
        }elseif ($request->category_id != null){
            $files->where('category_id', $request->category_id);
        }elseif ($request->type_id != null){
            $files->where('type_id', $request->type_id);
        }elseif ($request->document_number != null){
            $files->where('document_number', 'LIKE', '%'.$request->document_number.'%');
        }elseif ($request->document_date != null){
            $files->where('document_date', 'LIKE', '%'.$request->document_date.'%');
        }elseif ($request->document_description != null){
            $files->where('document_description', 'LIKE', '%'.$request->document_description.'%');
        }
        $result = $files->get();

        // dd($category);
        return view('folders.search-result', [
            'folders' => $folders,
            'files' => $result,
            'categories' => $categories,
            'types' => $types,
            'languages' => $languages,
            'title' => $title,
            'author' => $author,
            'category_selected' => $category_selected,
            'type_selected' => $type_selected,
            'document_number' => $document_number,
            'language_selected' => $language_selected
        ]);
    }
}
