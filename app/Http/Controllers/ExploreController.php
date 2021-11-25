<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Setting;
use App\Models\Video;
use App\Models\VideoLog;
use Carbon\Carbon;
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
        
        $user = auth()->guard('web')->user();
        $data['user'] = $user;
        if ($user) {
            $data['subscription'] = is_null(auth()->guard('web')->user()->membership);

            $data['watched_count'] = VideoLog::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();

            // subscribed users max videos
            $data['max_videos'] = Setting::where('slug', 'max_videos')->first()->meta;

            // non subscribed users max videos
            $data['max_videos_ns'] = Setting::where('slug', 'max_videos_ns')->first()->meta;
        }
        return view('video', $data);
    }
}
