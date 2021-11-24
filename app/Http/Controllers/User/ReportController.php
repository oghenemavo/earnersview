<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $data['balance'] = auth()->guard('web')->user()->wallet->balance ?? '0.00';
        return view('user.report.earnings', $data);
    }
}
