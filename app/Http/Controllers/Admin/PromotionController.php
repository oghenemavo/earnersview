<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Create & Manage Promotions';
        return view('admin.media.promotions', $data);
    }

    public function createPromotion(Request $request)
    {
        $rules = [
            'title' => 'required|min:2',
            'material' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $request->validate($rules);

        if ($request->hasfile('material')) {
            $material = $request->file('material');
            $name = 'promotion_' . time() . '.' . $material->extension();

            $material->move(public_path('/promotions'), $name);

            $data = $request->all();
            $data['material'] = $name;
    
            $result = Promotion::create($data);
            if ($result) {
                return redirect()->route('admin.media.promotions')->with('primary', 'Promotion Created Successfully!');
            }
        }

        return back()->with('danger', 'Unable to Create Promotion!');
    }
    
    public function editPromotion(Promotion $promotion)
    {
        $data['page_title'] = 'Edit Promotion';
        $data['promotion'] = $promotion;
        return view('admin.media.edit-promotion', $data);
    }

    public function updatePromotion(Request $request, Promotion $promotion)
    {
        $rules = [
            'title' => 'required|min:2',
            'material' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $request->validate($rules);
        
        if ($request->hasfile('material')) {
            $material = $request->file('material');
            $name = 'promotion_' . time() . '.' . $material->extension();

            $material->move(public_path('/promotions'), $name);
            $promotion->material = $name;
        }

        $promotion->title = $request->title;
        
        if ($promotion->save()) {
            return redirect()->route('admin.media.promotions')->with('primary', 'Promotion edited Successfully!');
        }
        return back()->with('danger', 'Unable to Edit Promotion!');
    }
    
    public function unblockPromotion(Request $request)
    {
        $promotion = Promotion::findOrFail($request->promotion_id);
        $promotion->status = '1';

        $result = $promotion->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }

    public function blockPromotion(Request $request)
    {
        $promotion = Promotion::findOrFail($request->promotion_id);
        $promotion->status = '0';

        $result = $promotion->save();
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['fail' => true]);
    }
}
