<?php

namespace App\Http\Controllers;

use App\Library\Facades\FlutterwaveFacade;
use App\Models\Category;
use App\Models\Payout;
use App\Models\Promotion;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoLog;
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
        $category_collection = Category::all();
        return response()->json(['categories' => $category_collection]);
    }

    public function allVideos()
    {
        $video_collection = Video::all();
        $mapped_videos = $video_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['title'] = $item->title;
            $data['slug'] = $item->slug;
            $data['category'] = $item->category->category;
            $data['description'] = htmlspecialchars_decode($item->description);
            $data['url'] = $item->url;
            $data['cover'] = asset("cover/$item->cover");
            $data['length'] = $item->length;
            $data['charges'] = $item->charges;
            $data['earnable'] = $item->earnable;
            $data['earned_after'] = $item->earned_after;
            $data['status'] = $item->status;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['videos' => $mapped_videos]);
    }

    public function allPromotions()
    {
        $promotion_collection = Promotion::all();
        $mapped_promotions = $promotion_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['title'] = $item->title;
            $data['material'] = asset("promotions/$item->material");
            $data['status'] = $item->status;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['promotions' => $mapped_promotions]);
    }
    
    public function allTransactions()
    {
        $transaction_collection = Transaction::all();
        $mapped_transactions = $transaction_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['name'] = $item->user->name;
            $data['email'] = $item->user->email;
            $data['amount'] = $item->amount;
            $data['reference'] = $item->tx_ref;
            $data['status'] = $item->is_confirmed;
            $data['confirmed_at'] = $item->confirmed_at;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['transactions' => $mapped_transactions]);
    }

    public function allReferrals()
    {
        $referral_collection = Referral::all();
        $mapped_referrals = $referral_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['referrer'] = $item->referrer->name;
            $data['referred'] = $item->referrer->name;
            $data['bonus'] = $item->bonus;
            $data['status'] = $item->status;
            $data['bonus_at'] = $item->bonus_at;
            $data['credited_at'] = $item->credited_at;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['referrals' => $mapped_referrals]);
    }

    public function allPayouts()
    {
        $payout_collection = Payout::all();
        $mapped_payouts = $payout_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['name'] = $item->user->name;
            $data['receipt'] = $item->receipt_no;
            $data['amount'] = $item->amount;
            $data['reference'] = $item->reference;
            $data['status'] = $item->status;
            $data['is_notified'] = $item->is_notified;
            $data['attempts'] = $item->attempts;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['payouts' => $mapped_payouts]);
    }

    public function userTransactions(User $user)
    {
        $transaction_collection = $user->transactions()->where('is_confirmed','1')->get();
        $mapped_transactions = $transaction_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['amount'] = $item->amount;
            $data['reference'] = $item->tx_ref;
            $data['status'] = $item->is_confirmed;
            $data['confirmed_at'] = $item->confirmed_at;
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['transactions' => $mapped_transactions]);
    }

    public function allVideoLogs()
    {
        $videoLog_collection = VideoLog::all();
        $mapped_videoLog = $videoLog_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['name'] = $item->user->name;
            $data['video'] = $item->video->title;
            $data['watched'] = number_format((float) $item->watched, 2);
            $data['amount'] = $item->credit;
            $data['status'] = $item->is_credited;
            $data['credited_at'] = $item->updated_at > $item->created_at ? $item->updated_at : "n/a";
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['video_logs' => $mapped_videoLog]);
    }
    
    public function userVideoLogs(User $user)
    {
        $videoLog_collection = $user->videoLogs()->get();
        $mapped_videoLog = $videoLog_collection->map(function($item, $key) {
            $data['id'] = $item->id;
            $data['video'] = $item->video->title;
            $data['watched'] = number_format((float) $item->watched, 2);
            $data['amount'] = $item->credit;
            $data['status'] = $item->is_credited;
            $data['credited_at'] = $item->updated_at > $item->created_at ? $item->updated_at : "n/a";
            $data['created_at'] = $item->created_at;

            return $data;
        });
        return response()->json(['video_logs' => $mapped_videoLog]);
    }
}
