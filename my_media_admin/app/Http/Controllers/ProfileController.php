<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Direct home Page
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id', 'name','phone', 'email', 'address', 'gender')->where('id', $id)->first();

        return view('admin.profile.index', compact('user'));
    }

    public function updateAdminAccount(Request $request){

    $validator = $this->validationCheck($request);

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

    $userData = $this->getUserInfo($request);

    User::where('id', Auth::user()->id)->update($userData);

    return back()->with(['updateSuccess' => 'Admin Account Updated']);
    }

    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request){

        $validator = $this->passwordValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashUserPassword = Hash::make($request->newPassword);
        $updated_data = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];
        if(Hash::check($request->oldPassword,$dbPassword )){
            User::where('id', Auth::user()->id)->update($updated_data);
            return redirect()->route('dashboard');
        }
        else {
            return back()->with(['fail' => 'Incorrect old password!']);
        }
    }
    //private

    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
        ];
    }
    //Validation
    private function validationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required|max:255',
            'adminEmail' => 'required',
        ],[
            'adminName' => "Name is required !",
            'adminEmail' => "Email is required !"
        ]);


    }
    private function passwordValidationCheck($request){
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|min:8|max:15|same:newPassword'
        ];
        $validationMessage = [
            'confirmPassword.same' => "New password and Confirm Password do not match"
        ];
        return Validator::make($request->all(),$validationRules, $validationMessage);
    }
}
