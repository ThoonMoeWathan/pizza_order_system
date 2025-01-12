<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // direct user list page
    public function userList(){
        $users=User::where('role','user')
        ->paginate(5);
        return view('admin.user.list',compact('users'));
    }

    // change user role
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateSource=[
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
        // return response()->json($data, 200);
    }

    // delete user
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'This user has been successfully Deleted']);
    }

}
