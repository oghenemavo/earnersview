<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions()
    {
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['page_title'] = 'My Transactions';
        return view('user.report.transaction', $data);
    }
    
    public function earnings()
    {
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['page_title'] = 'My Earnings';
        $data['min'] = Setting::where('slug', 'min_payout')->first()->meta ?? '100';
        $data['balance'] = auth()->guard('web')->user()->wallet->balance ?? '0.00';
        return view('user.report.earnings', $data);
    }
    
    public function referrals()
    {
        $data['filetype'] = function($filename) {
            $file_array = explode('.', $filename);
            $ext = strtolower(array_pop($file_array));
            return in_array($ext, ['jpeg','png','jpg','gif','svg']) ? true : false;
        };
        $data['current_time'] = Carbon::now();
        $data['promotions'] = Promotion::where('status', '1')->get();
        $data['page_title'] = 'My Referrals';
        return view('user.report.referrals', $data);
    }
}
