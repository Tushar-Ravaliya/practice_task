<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admincontroller extends Controller
{
    public function showdata(Request $request)
    {
        // $data = Member::all();

        // return response()->json(['data'=> $data]);

        $draw                 =         $request->get('draw'); // Internal use
        $start                 =         $request->get("start"); // where to start next records for pagination
        $rowPerPage         =         $request->get("length"); // How many recods needed per page for pagination

        $orderArray        =         $request->get('order');
        $columnNameArray     =         $request->get('columns'); // It will give us columns array

        $searchArray         =        $request->get('search');
        $columnIndex         =        $orderArray[0]['column'];  // This will let us know,
        // which column index should be sorted 
        // 0 = id, 1 = name, 2 = email , 3 = created_at

        $columnName         =        $columnNameArray[$columnIndex]['data']; // Here we will get column name, 
        // Base on the index we get

        $columnSortOrder     =        $orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue         =        $searchArray['value']; // This is search value 

        $user = Member::withCount('blogs');
        $total = $user->count();

        $totalFilter = Member::withCount('blogs');

        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('name', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orwhere('email', 'like', '%' . $searchValue . '%');
        }

        $totalFilter = $totalFilter->count();

        $arrData = Member::withCount('blogs');
        $arrData =  $arrData->skip($start)->take($rowPerPage);
        $arrData =  $arrData->orderBy($columnName, $columnSortOrder);

        if (!empty($searchValue)) {
            $arrData = $arrData->where('name', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orwhere('email', 'like', '%' . $searchValue . '%');
        }
        $arrData = $arrData->get();

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $arrData,
        );
        return response()->json($response);
    }

    public function add_catagories(Request $req)
    {

        $req->validate([
            'cat' => 'required',

        ]);
        $reg = new Category;
        $reg->categories = $req->cat;
        if ($reg->save()) {
            session()->flash('succ', 'Data saved successfully');
        } else {
            session()->flash('err', 'error in saving data');
        }
        $data = Category::select()->get();
        return view('admin.addcat', compact('data'));
    }
    public function feth_cat()
    {
        return dd(Blog::with('members')->get());
        $data = Category::select()->get();
        return view('admin.addcat', compact('data'));
    }


    public function showblog(Request $request)
    {
        // $data = Member::all();

        // return response()->json(['data'=> $data]);

        $draw                 =         $request->get('draw'); // Internal use
        $start                 =         $request->get("start"); // where to start next records for pagination
        $rowPerPage         =         $request->get("length"); // How many recods needed per page for pagination

        $orderArray        =         $request->get('order');
        $columnNameArray     =         $request->get('columns'); // It will give us columns array

        $searchArray         =        $request->get('search');
        $columnIndex         =        $orderArray[0]['column'];  // This will let us know,
        // which column index should be sorted 
        // 0 = id, 1 = name, 2 = email , 3 = created_at

        $columnName         =        $columnNameArray[$columnIndex]['data']; // Here we will get column name, 
        // Base on the index we get

        $columnSortOrder     =        $orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue         =        $searchArray['value']; // This is search value 

        $user = Blog::with('members');
        $total = $user->count();

        $totalFilter = Blog::with('members');

        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('name', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orwhere('email', 'like', '%' . $searchValue . '%');
        }

        $totalFilter = $totalFilter->count();

        $arrData = Blog::with('members');
        $arrData =  $arrData->skip($start)->take($rowPerPage);
        $arrData =  $arrData->orderBy($columnName, $columnSortOrder);

        if (!empty($searchValue)) {
            $arrData = $arrData->where('name', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orwhere('email', 'like', '%' . $searchValue . '%');
        }
        $arrData = $arrData->get();

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $arrData,
        );
        return response()->json($response);
    }

    public function delete_user(string $id)
    {
        Member::where('id', $id)->delete();
        return redirect()->back();
    }
    public function edit_user(string $id)
    {
        $member = Member::where('id', $id)->first();
        return view('admin.edituser', compact('member'));
    }

    public function update_user(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/',
            'mobile_no' => 'required|numeric|digits:10',
            'birthdate' => 'required',
            'gender' => 'required',
        ], [
            'email.unique' => 'email is already register',
            'password.required' => 'Password cannot be empty',

            'password.regex' => 'Password must contain one digit,one character both upper and lower and a special character',

            'mobile_no.required' => 'Mobile number cannot be empty',
            'mobile_no.digits' => 'Mobile number must contain only 10 digits',
            'mobile_no.unique' => 'Mobile number is already register',
        ]);
        $member = Member::where('id', $id)->first();

       if(!empty($request->file('profile_image'))){
        $image_name = uniqid() . $request->file('profile_image')->getClientOriginalName();
        $request->profile_image->move('blogs_images', $image_name);
       }else{
        $image_name = 'default.jpg';
       }

        $member->where('id', $id)->update(array('name' => $request->name, 'email' => $request->email, 'password'=>$request->password,'mobile_no' => $request->mobile_no,'birthdate' => $request->birthdate,'gender' => $request->gender,'profile_image' => $image_name));

        

               
        
        return redirect()->back();
    }
}
