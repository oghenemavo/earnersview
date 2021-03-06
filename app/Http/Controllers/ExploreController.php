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
        $data['slider'] = Video::where('status', '1')->orderBy('created_at', 'desc')->limit(1)->get();
        $data['feed'] = Video::where('status', '1')->limit(5)->get();
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['current_time'] = Carbon::now();
        $data['duration'] = function($seconds) {
            if ($seconds > 60) {
                return floor($seconds);
            }
            return floor($seconds);
        };
        $data['tax'] = 0.01 * (Setting::where('slug', 'payout_tax_percentage')->first()->meta ?? '0.1');
        // $data['earning'] = function($earnings = ['earnable' => 0, 'earnable_ns' => 0]) {
        //     return auth()->check() ? $earnings['earnable'] : $earnings['earnable_ns'];
        // };
        $data['earning'] = function($earnings = ['earnable' => 0, 'earnable_ns' => 0]) use($data) {
            if (auth()->check()) {
                if (!is_null(auth()->guard('web')->user()->membership)) {
                    return $earnings['earnable'] - ($earnings['earnable'] * $data['tax']);
                } else {
                    return $earnings['earnable_ns'] - ($earnings['earnable_ns'] * $data['tax']);
                }
            }
            return $earnings['earnable'] - ($earnings['earnable'] * $data['tax']);
        };
        $data['category_videos'] = Video::where('status', '1')->get()->groupBy('category_id')
            ->map(function($category) {
                return $category->take(10);
            });
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };

        return view('welcome', $data);
    }
    
    public function category(Category $category)
    {
        $data['page_title'] = $category->category . ' Videos';
        $data['category'] = $category;
        $data['videos'] = Video::where('category_id', $category->id)
        ->where('status', '1')->orderby('created_at', 'desc')->get();
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        return view('category', $data);
    }

    public function standards()
    {
        $data['page_title'] = 'How it works';
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        return view('how-it-works', $data);
    }

    public function faq()
    {
        $data['page_title'] = 'FAQ';
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        return view('faq', $data);
    }

    public function contact()
    {
        $data['page_title'] = 'Contact';
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        return view('contact', $data);
    }
    
    public function video(Video $video)
    {
        $data['page_title'] = $video->title;
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['video'] = $video ?? 0;
        $data['views'] = VideoLog::where('video_id', $video->id)->count();
        $data['latest_videos'] = Video::where('category_id', $video->category_id)
        ->where('status', '1')->orderby('created_at', 'desc')->limit('10')->get();
        
        $user = auth()->guard('web')->user();
        $data['user'] = $user;
        $data['tax'] = 0.01 * (Setting::where('slug', 'payout_tax_percentage')->first()->meta ?? '0.1');
        if ($user) {
            $data['subscription'] = is_null($user->membership);

            $data['watched_count'] = VideoLog::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();
            $data['is_watched'] = VideoLog::where('user_id', $user->id)->where('video_id', $video->id)->count();

            // subscribed users max videos
            $data['max_videos'] = Setting::where('slug', 'max_videos')->first()->meta;

            // non subscribed users max videos
            $data['max_videos_ns'] = Setting::where('slug', 'max_videos_ns')->first()->meta;

            // echo '<pre>' . var_export($data['is_watched'], true) . '</pre>';
            
            if (!$data['is_watched'] && !$data['subscription'] && ($data['watched_count'] >= $data['max_videos'])) { // subscription exists
                return redirect()->back()->with('sub_user', 'Maximum numbers of videos watched Today');
            } elseif (!$data['is_watched'] && $data['subscription'] && ($data['watched_count'] >= $data['max_videos_ns'])) {
                return redirect()->back()->with('info', 'Maximum numbers of videos watched Today, Subscribe now to watch more');
            }
        }
        $data['duration'] = function($seconds) {
            if ($seconds > 60) {
                return floor($seconds/60);
            }
            return 1;
        };
        $data['earning'] = function($earnings = ['earnable' => 0, 'earnable_ns' => 0]) use($data) {
            // return auth()->check() ?  : $earnings['earnable_ns'];
            if (auth()->check()) {
                if (!$data['subscription']) {
                    return $earnings['earnable'] - ($earnings['earnable'] * $data['tax']);
                } else {
                    return $earnings['earnable_ns'] - ($earnings['earnable_ns'] * $data['tax']);
                }
            }
            return $earnings['earnable'] - ($earnings['earnable'] * $data['tax']);
        };
        $data['current_time'] = Carbon::now();
        return view('video', $data);
    }
}
