<?php

namespace App\Http\Controllers;

use App\Models\Member;
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

        $user = DB::table('members');
        $total = $user->count();

        $totalFilter = DB::table('members');

        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('name', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orwhere('email', 'like', '%' . $searchValue . '%');
        }

        $totalFilter = $totalFilter->count();

        $arrData = DB::table('members');
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
        $data = Category::select()->get();
        return view('admin.addcat', compact('data'));
    }
}
