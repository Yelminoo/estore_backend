<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    //list page
    public function listPage()
    {

        $contact = Contact::
            select('contacts.*', 'users.image as user_image', 'users.address as user_address', 'users.phone as user_phone', "users.gender as user_gender")
            ->leftJoin('users', 'users.name', 'contacts.name')
            ->when(request('key'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('users.email', 'like', '%' . request('key') . '%')
                    ->orWhere('contacts.message', 'like', '%' . request('key') . '%')

                ;
            })

            ->orderBy('contacts.id', 'desc')
            ->paginate(5);

        logger($contact);
        return view('admin.contact.contactList', compact('contact'));

    }

    //conatct details page
    public function detailsPage($id)
    {
        logger($id);

        $c = Contact::select('contacts.*', 'users.image as user_image', 'users.address as user_address', 'users.phone as user_phone', "users.gender as user_gender")
            ->where('contacts.id', $id)
            ->leftJoin('users', 'users.name', 'contacts.name')
            ->first();

        return view('admin.contact.contactDetails', compact('c'));
    }

    //contact delete
    public function delete($id)
    {
        Contact::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'deleted successfully...']);

    }
}
