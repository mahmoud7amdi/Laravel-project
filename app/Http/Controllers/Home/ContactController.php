<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function Contact()
    {
        return view('frontend.contact');
    }

    public function StoreMessage(Request $request)
    {
        Contact::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
            'phone'=> $request->phone,
            'created_at'=> Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Your Message Submitted   successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }

    public function ContactMessage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.allcontact',compact('contacts'));
    }
    public function DeleteMessage($id)
    {
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Your Message deleted  successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }
}
