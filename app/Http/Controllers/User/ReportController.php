<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions()
    {
        $data['page_title'] = 'My Transactions';
        return view('user.report.transaction', $data);
    }
    
    public function earnings()
    {
        $data['page_title'] = 'My Earnings';
        $data['min'] = Setting::where('slug', 'min_payout')->first()->meta ?? '100';
        $data['balance'] = auth()->guard('web')->user()->wallet->balance ?? '0.00';
        return view('user.report.earnings', $data);
    }
}
