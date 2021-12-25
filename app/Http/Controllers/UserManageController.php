<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeletedUser;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class UserManageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','adminrank']);
    }
    
    //
    public function index(Request $request)
    {
    	$search = $request->search;

        $query = DB::table('users')
                        ->leftjoin('profiles', 'users.id', '=', 'profiles.user_id')
                        ->select('users.*', 'profiles.CompanyName');
                        

        if (!is_null($search)) {
            $users = $query->where('name', 'like', '%'.$search.'%')
            				->orwhere('email', 'like', '%'.$search.'%')
            				->orwhere('CompanyName', 'like', '%'.$search.'%')
            				->orderBy('name', 'asc')
                                        ->paginate(20);
        }else{
            $users = $query->orderBy('name', 'asc')
                                        ->paginate(20);
        }


        return view('admin.user_management.usertable',compact('users'));
    }

      public function edit($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.user_management.usertable_edit', compact('user'));
    }

     public function update($id,Request $request)
    {
    	 $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            
        ]);

        $user = User::findOrFail($id);

       
        $user->update(['name'=>request('name')]);
        $user->update(['email'=>request('email')]);
        $user->update(['phone_no'=>request('phone_no')]);

        Toastr::success('User updated!');

       return redirect()->route('user.index');
    }


    public function verifyUserEmail(Request $request)
    {
        $search = $request->search;

        $query = DB::table('users')
                        ->leftjoin('profiles', 'users.id', '=', 'profiles.user_id')
                        ->select('users.*', 'profiles.CompanyName');
                        

        if (!is_null($search)) {
            $users =User::whereNull('email_verified_at')
                        ->where([
                            ['name', 'like', '%'.$search.'%'],
                            ['email', 'like', '%'.$search.'%'],
                        ])
                            ->get();
        }else{
            $users = User::whereNull('email_verified_at')->get();
        }

        return view('admin.verifyuseremail',compact('users'));
    }

    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);

        $user->update(['email_verified_at'=>now()]);

        Toastr::success('User email verified!');

       return redirect()->back();
    }

    public function deleteUser($id,Request $request)
    {
        $user = User::findOrFail($id);

        // $newUser = $user->replicate();
        if ($user->Status == 0) {
            DeletedUser::create([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => $user['password'],
                'phone_no' => $user['phone_no'],
                'Status' => $user['Status'],
                'RejectComment' => $user['RejectComment'],
            ]);

            $user->delete();

            Toastr::success('User deleted!');
        }else{
            Toastr::warning('User has profile data. Cannot be deleted!!');
        }
        return redirect()->back();
    }
}
