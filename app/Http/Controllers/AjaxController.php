<?php

namespace App\Http\Controllers;

use App\Library\Facades\FlutterwaveFacade;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function uniqueEmail(Request $request)
    {
        $email = $request->get('email');
        $ignore_id = $request->get('ignore_id') ?? null;
        
        $user = new User();
        $is_valid = ! $user->emailExists($email, $ignore_id);
        echo json_encode($is_valid);
    }
    
    public function checkAccount(Request $request)
    {
        $account = $request->account_number; // bank account number
        $code = $request->code; // bank code
        return FlutterwaveFacade::validate_account($code, $account);
    }
    
    public function allUsers()
    {
        $users = User::all();
        $mapped_users = $users->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['initials'] = $item->initials;
            $data['email'] = $item->email;
            $data['bank_code'] = $item->bank_code;
            $data['bank_account'] = $item->bank_account;
            $data['balance'] = 500;
            $data['email_verified_at'] = $item->email_verified_at ? true : false;
            $data['referred_by'] = $item->referred_by;
            $data['is_active'] = $item->is_active;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['users' => $mapped_users]);
    }

    public function uniqueCategory(Request $request)
    {
        $inp_category = $request->get('category');
        $ignore_id = $request->get('ignore_id') ?? null;
        
        $category = new Category();
        $is_valid = ! $category->categoryExists($inp_category, $ignore_id);
        echo json_encode($is_valid);
    }

    public function allCategories()
    {
        $categories = Category::all();
        // $mapped_users = $categories->map(function($item, $key) {
        //     $data['id'] = $item->id;
        //     $data['name'] = $item->category;
        //     $data['slug'] = $item->slug;
        //     $data['created_at'] = $item->created_at;

        //     return $data;
        // });
        return response()->json(['categories' => $categories]);
    }
    
}
