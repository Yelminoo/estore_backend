<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //list page
    public function listPage()
    {
        $admin = User::
            when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')

            ;
        })

            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('admin.list.accountList', compact('admin'));

    }

    //account edit page
    public function editPage()
    {

        return view('admin.list.acccountEdit');
    }

    //account details page

    public function accountDetails()
    {
        return view('admin.list.accountDetails');
    }

    //account edit
    public function edit(Request $request)
    {

        logger($request->id);
        $this->editValidation($request);
        $data = $this->getEditData($request);
        if ($request->image != null) {

            //add update name to database and public folder
            $file = $request->file('image');
            $fileName = 'account' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path() . '/ProjectImg', $fileName);

            $data = [...$data, 'image' => $fileName];

            //delete db name from public if exists
            $dbFile = User::where('id', Auth::user()->id)->first();
            $dbName = $dbFile['image'];

            if ($dbName != null) {
                if (File::exists(public_path() . '/ProjectImg/' . $dbName)) {
                    File::delete(public_path() . '/ProjectImg/' . $dbName);
                }
            }

        }

        User::where('id', Auth::user()->id)->update($data);
        return redirect()->route('admin#accountDetails')->with(['updateSuccess' => 'updated successfully']);

    }

    //password change page is commom to both user and admin
    public function passwordChangePage()
    {
        return view('admin.list.passwordChangePage');
    }

    //change password
    public function passwordChange(Request $request)
    {

        $this->passwordValidation($request);
        $pwdata = User::where('id', Auth::user()->id)->first();

        $dbHashPw = $pwdata->password;
        if (Hash::check($request->oldPassword, $dbHashPw)) {

            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#login');
        } else {
            return back()->with(['oldPasswordError' => 'oldPassword not match']);
        }
    }

    //edit validation
    private function editValidation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|unique:users,name,$request->id',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    private function getEditData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }

    private function passwordValidation($request)
    {
        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|min:8|max:15|same:newPassword',
        ])->validate();
    }

}
