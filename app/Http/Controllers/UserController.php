<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    //account details page

    public function userDetails()
    {
        return view('user.userDetails');
    }

    //account edit page
    public function editPage()
    {

        return view('user.userEditPage');
    }

    //account edit
    public function edit(Request $request)
    {

        $this->editValidation($request);
        $data = $this->getEditData($request);

        if ($request->image != null) {

            //add update name to database and public folder
            $file = $request->file('image');
            $fileName = 'account' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path() . '/ProjectImg', $fileName);

            $data = [...$data, 'image' => $fileName];

            //delete db name from database and public if exists
            $dbFile = User::where('id', Auth::user()->id)->first();
            $dbName = $dbFile['image'];

            if ($dbName != null) {
                if (File::exists(public_path() . '/ProjectImg/' . $dbName)) {
                    File::delete(public_path() . '/ProjectImg/' . $dbName);
                }
            }

        }
        User::where('id', Auth::user()->id)->update($data);

        return redirect()->route('user#accountDetails')->with(['updateSuccess' => 'updated successfully']);

    }

    //edit validation
    private function editValidation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
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

}