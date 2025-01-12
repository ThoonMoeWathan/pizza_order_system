<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all product list
    public function productList(){
        $products =Product::get();
        return response()->json($products, 200);
    }

    // get all category list
    public function categoryList(){
        $category=Category::get();
        return response()->json($category, 200);
    }

    // get all data list for API
    public function allList(){
        $products =Product::get();
        $category=Category::get();

        $data=[
            'product' => $products,
            'category' => $category
        ];
        // return $data['product'][0]->name;
        return response()->json($data, 200);
    }
    // create category
    public function categoryCreate(Request $request){
        // dd($request->header('header_data'));
        // dd($request->all());
        $data=[
            'name'=>$request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }
    // create contact
    public function contactCreate(Request $request){
        $data=$this->getContactData($request);
        $response = Contact::create($data);
        return response()->json($response, 200);
    }
    // delete category (POST)
    public function categoryDelete(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
        Category::where('id',$request->category_id)->delete();
        return response()->json(['status' => true,'message'=>'delete success'], 200);
        }
        return response()->json(['status' => false,'message'=>'category id not found'], 200);
    }
    // delete category (GET)
    public function categoryDeleteGET($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
        Category::where('id',$id)->delete();
        return response()->json(['status' => true,'message'=>'delete success','deleteData'=>$data], 200);
        }
        return response()->json(['status' => false,'message'=>'category id not found'], 200);
    }
    // category details
    public function categoryDetails(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
        return response()->json(['status' => true,'message'=>'Category exists','Category'=>$data], 200);
        }
        return response()->json(['status' => false,'message'=>'category id not found'], 200);
    }
    // update category
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;
        $dbSource = Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
        return response()->json(['status' => true,'message'=>'Category update success','Category'=>$response], 200);
        }
        return response()->json(['status' => false,'message'=>'category id not found'], 404);
    }
    // get contact data
    private function getContactData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    // get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
