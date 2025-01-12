<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // direct contact list page
    public function contactList(){
        $contact=Contact::when(request('key'),function($query){
            $query->orWhere('id','like','%'.request('key').'%')
                  ->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.contactList',compact('contact'));
    }
    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactList')->with(['deleteSuccess'=>'Contact has been successfully Deleted']);
    }
}
