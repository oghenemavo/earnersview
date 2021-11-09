<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function category(Category $category)
    {
        $data['page_title'] = $category->category . ' Videos';
        $data['category'] = $category;
        $data['videos'] = Video::where('category_id', $category->id)
        ->where('status', '1')->orderby('created_at', 'desc')->get();
        return view('category', $data);

    }
}
