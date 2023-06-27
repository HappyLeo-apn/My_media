<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //Direct admin list page
   public function index(){
    $userData = User::select('id', 'name', 'phone', 'email', 'address', 'gender')->get();
    $searchKey = "";
    return view('admin.list.index', compact('userData'));
   }

   public function deleteAccount($id){
   User::where('id', $id)->delete();
   return back()->with(['deleteSuccess' => "Account deleted successfully!"]);
   }

   public function adminListSearch(Request $request){
    $searchKey = $request->adminSearchKey;
    $userData = User::orWhere('name', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('email', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('phone', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('address', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('gender', 'like', '%'.$request->adminSearchKey.'%')
                    ->get();
    return view('admin.list.index', compact('userData', 'searchKey'));
   }
}
