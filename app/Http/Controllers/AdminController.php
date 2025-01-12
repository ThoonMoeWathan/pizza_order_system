<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    // change password
    public function changePassword(Request $request){
        /*
            1. all field must be filled
            2. new password and confirm password length must be greater than 6
            3. new password and confirm password must be same
            4. client old password must be same with db password
            5. password change
        */
        $this->passwordValidationCheck($request);
        $currentUserId= Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword,$dbHashValue)){
            $data=[
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('admin#loginPage');
            return back()-> with(['changeSuccess'=>'Password Changed Success']);
        }
        return back()->with(['notMatch'=> 'The old password does not match. Try again.']);
    }
    // direct admin details page
    public function details(){
        return view('admin.account.details');
    }
    // direct admin profile pic
    public function edit(){
        return view('admin.account.edit');
    }
    // update account
    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')){
            // 1. old image name | check => delete | store
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;

            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin account has been updated.']);
    }

    // admin list
    public function list(){
        $admin = User::
        // when(request('key'),function($query){
        //     $query->orWhere('name','like','%'.request('key').'%')
        //           ->orWhere('email','like','%'.request('key').'%')
        //           ->orWhere('gender','like','%'.request('key').'%')
        //           ->orWhere('phone','like','%'.request('key').'%')
        //           ->orWhere('address','like','%'.request('key').'%');
        // })
        // ->
        where('role','admin')
        ->paginate(3);
        $admin->append(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    // delete account
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'The chosen admin account has been deleted.']);
    }

    // change
    public function change(Request $request){
        // logger($request->all());
        $updateSource=[
            'role' => $request->role
        ];
        User::where('id',$request->adminId)->update($updateSource);
        // return response()->json($data, 200);
    }

    // request user data (admin list)
    private function requestUserData($request){
            return [
            'role' => $request->role
        ];
    }

    // request user data (self)
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required'
        ])->validate();
    }
    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=> 'required|min:6',
            'newPassword'=> 'required|min:6',
            'confirmPassword'=> 'required|min:6|same:newPassword'
        ])->validate();
    }
}
