<?php

namespace App\Http\Controllers;

use App\Library\Facades\FlutterwaveFacade;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function unique_email(Request $request)
    {
        $email = $request->get('email');
        $ignore_id = $request->get('ignore_id') ?? null;
        
        $user = new User();
        $is_valid = ! $user->email_exists($email, $ignore_id);
        echo json_encode($is_valid);
    }
    
    public function check_account(Request $request)
    {
        $account = $request->account_number; // bank account number
        $code = $request->code; // bank code
        return FlutterwaveFacade::validate_account($code, $account);
    }
}
