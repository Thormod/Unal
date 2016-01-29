<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Folder;
use App\File;

use Storage;
use League\Flysystem\Filesystem;

class FolderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function viewFolderCreation()
	{
		//
		$folders = Folder::where('created_by', Auth::user()->id)->get();

		return view('folder-creation')
		->with('folders',$folders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function viewFolder()
	{
		//
		return view('view-folder');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function saveFolder(Request $request)
	{
		//Validate the Request through the validation rules
        $validator = Validator::make($request->all(),[
            'folder_name' => 'required|min:5',
        ]);

        //Take actions when the validation has failed
        if($validator->fails()){
            return redirect('create-folder')
                ->withErrors($validator)
                ->withInput();
        }

        $folder = new Folder;

        $folder->name = $request->input('folder_name');
        $folder->created_by = Auth::user()->id;

        $folder->save();

        $folder_path = "folders";
        $folder_path .= "/";
        $folder_path .= Auth::user()->id;
        $folder_path .= "/";
        $folder_path .= $folder->id;

        if(!file_exists($folder_path)){
            //Create the folder
            mkdir($folder_path,8777, true);
        }

        return redirect('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$files = File::where('created_by', Auth::user()->id)
					   ->where('folder_id', $id)
					   ->get();

		$folders = Folder::where('created_by', Auth::user()->id)->get();

		$folder = Folder::findOrFail($id);

		return view('view-folder')
		->with('folder', $folder)
		->with('folders',$folders)
		->with('files', $files);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteFolder($id)
	{
		//
		$currentFolder = Folder::findOrFail($id);

		//$filesFolder = $currentFolder->files;
		$files = $currentFolder->files();

		foreach ($files as $file){
			unlink(public_path($file->file_path));
		}
		
		$files->delete();
		$currentFolder->delete();
		//rmdir('folders/'.$currentFolder->created_by.'/'.$currentFolder->id);

		return redirect()->back();
	}

}
