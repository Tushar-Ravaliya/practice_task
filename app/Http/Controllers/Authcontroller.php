<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class Authcontroller extends Controller
{
    public function register(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:members,email',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/',
            'mobile_no' => 'required|numeric|digits:10|unique:members,mobile_no',
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

        $member_table = new Member;
        $member_table->name = $req->name;
        $member_table->email = $req->email;
        $member_table->password = $req->password;
        $member_table->mobile_no = $req->mobile_no;
        $member_table->birthdate = $req->birthdate;
        $member_table->gender = $req->gender;
        if (isset($req->profile_image)) {

            $pic_name = uniqid() . $req->file('profile_image')->getClientOriginalName();
            $req->profile_image->move('profile_pic', $pic_name);

            $member_table->profile_image = $pic_name;
            $member_table->save();
        } else {
            $member_table->save();
        }

        $email = $req->email;
        $fn = $req->name;
        $data = ['em' => $email, 'fn' => $fn];
        Mail::send('register_template', ["data1" => $data], function ($message) use ($data) {

            $message->to($data['em'], $data['fn']);
            $message->from("travaliya519@rku.ac.in", "Tushar");
        });

        return view('login');
    }
    public function login(Request $req)
    {
        $result = Member::where('email', $req->email)->where('password', $req->password)->first();
        if ($result == null) {
            session()->flash('error', 'Invalid email or password');
            return redirect()->back();
        } else if ($result['role'] == "user" && $result['status'] == "Active") {
            $req->session()->put('email', $result['email']);
            $req->session()->put('pwd', $result['password']);
            $req->session()->put('name', $result['name']);
            $req->session()->put('user_id', $result['id']);


            return redirect('home');
        } else if ($result['role'] == "Admin" && $result['status'] == "Active") {
            $req->session()->put('email', $result['email']);
            $req->session()->put('pwd', $result['password']);
            $req->session()->put('name', $result['name']);
            $req->session()->put('user_id', $result['id']);


            return redirect('admin.userlist');
        } else {
            session()->flash('error', 'Your account is not activated');
            return redirect()->back();
        }
    }
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
    public function account_activation($email)
    {
        $result = Member::where("email", $email)->first();
        if (empty($result)) {
            session()->flash('error', 'Your account is not registered. kindly register here.');
            return redirect('register');
        } else {
            if ($result->status == 'Active') {
                session()->flash('success', 'Your account is already activated kindly login');
            } else {
                $update = Member::where('email', $email)->update(array('status' => 'Active'));
                if ($update) {
                    session()->flash('success', 'Your account is activated successfully. kindly login');
                } else {
                    session()->flash('error', 'Account activation failed please try after sometime.');
                }
            }
            return view('login');
        }
    }
}
