<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MediaController extends Controller
{
    public function categories()
    {
        $data['page_title'] = 'Create & Manage Categories';
        return view('admin.media.categories', $data);
    }

    public function createCategory(Request $request)
    {
        $rules = ['category' => 'required|min:3|unique:categories'];
        $request->validate($rules);

        $data = $request->all();
        $data['slug'] = Str::of($data['category'])->slug('-');

        $result = Category::create($data);
        if ($result) {
            return back()->with('primary', 'Categories Created Successfully!');
        }
        return back()->with('danger', 'Unable to Create Category!');
    }

    public function editCategory(Request $request, Category $category)
    {
        $rules = [
            'category' => [
                'required',
                'min:3',
                Rule::unique('categories')->ignore($category->id)
            ],
        ];
        $request->validate($rules);
        
        $category->category = $request->category;
        $category->slug = Str::of($request->category)->slug('-');


        if ($category->save()) {
            return response()->json(['success' => true]);
        }
        return back()->with('danger', 'Unable to Update Category!');
    }

    public function videos()
    {
        $data['page_title'] = 'Create & Manage Videos';
        $data['categories'] = Category::all();
        return view('admin.media.videos', $data);
    }

    public function createVideo(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'title' => 'required|min:2',
            'description' => 'required|min:10',
            'url' => 'required|url',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'length' => 'required',
            'charges' => 'required',
            'earnable' => 'required',
            'earned_after' => 'required',
        ];
        $request->validate($rules);

        if ($request->hasfile('cover')) {
            $cover = $request->file('cover');
            $name = 'cover_' . time() . '.' . $cover->extension();

            $cover->move(public_path('/cover'), $name);

            $data = $request->all();
            $data['slug'] = Str::of($data['title'])->slug('-') . '-' . uniqid();
            $data['description'] = $this->clean($request->description);
            $data['cover'] = $name;
    
            $result = Video::create($data);
            if ($result) {
                return redirect()->route('admin.media.videos')->with('primary', 'Video Created Successfully!');
            }
        }

        return back()->with('danger', 'Unable to Create Video!');
    }

    public function editVideo(Video $video)
    {
        $data['page_title'] = 'Edit Video';
        $data['categories'] = Category::all();
        $data['video'] = $video;
        return view('admin.media.edit-video', $data);
    }

    public function updateVideo(Request $request, Video $video)
    {
        $rules = [
            'category_id' => 'required',
            'title' => 'required|min:2',
            'description' => 'required|min:10',
            'url' => 'required|url',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'length' => 'required',
            'charges' => 'required',
            'earnable' => 'required',
            'earned_after' => 'required',
        ];
        $request->validate($rules);

        $data = $request->all();
        if ($request->hasfile('cover')) {
            $cover = $request->file('cover');
            $name = 'cover_' . time() . '.' . $cover->extension();

            $cover->move(public_path('/cover'), $name);
            $data['cover'] = $name;
        }

        if ($video->title != $data['title']) {
            $data['slug'] = Str::of($data['title'])->slug('-') . '-' . uniqid();
        }
        
        $data['description'] = $this->clean($request->description);
        $result = $video->update($data);
        if ($result) {
            $initial_path = public_path('/cover') . $video->cover;
            if (FacadesFile::exists($initial_path)) {
                FacadesFile::delete($initial_path);
            }
            return redirect()->route('admin.media.videos')->with('primary', 'Video Edited Successfully!');
        }
        return back()->with('danger', 'Unable to Edit Video!');
    }
    
    public function unblockVideo(Request $request)
    {
        $video = Video::findOrFail($request->video_id);
        $video->status = '1';

        $result = $video->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }

    public function blockVideo(Request $request)
    {
        $video = Video::findOrFail($request->video_id);
        $video->status = '0';

        $result = $video->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }

    
    protected function clean($string){
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string, ENT_QUOTES);
        $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $string;
    }
}
