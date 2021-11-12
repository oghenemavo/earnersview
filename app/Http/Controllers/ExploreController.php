<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Video;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Home - Earner\'s View';
        $data['slider'] = Video::where('status', '1')->orderBy('created_at', 'desc')->limit(4)->get();
        $data['feed'] = Video::where('status', '1')->get();
        $data['promotions'] = Promotion::where('status', '1')->get();
        return view('welcome', $data);
    }
    
    public function category(Category $category)
    {
        $data['page_title'] = $category->category . ' Videos';
        $data['category'] = $category;
        $data['videos'] = Video::where('category_id', $category->id)
        ->where('status', '1')->orderby('created_at', 'desc')->get();
        return view('category', $data);
    }

    public function standards()
    {
        $data['page_title'] = 'How it works';
        return view('how-it-works', $data);
    }

    public function faq()
    {
        $data['page_title'] = 'FAQ';
        return view('faq', $data);
    }

    public function contact()
    {
        $data['page_title'] = 'Contact';
        return view('contact', $data);
    }
    
    public function video(Video $video)
    {
        $data['page_title'] = $video->title;
        $data['video'] = $video;
        $data['latest_videos'] = Video::where('category_id', $video->category_id)
        ->where('status', '1')->orderby('created_at', 'desc')->limit('10')->get();
        return view('video', $data);
    }
}
