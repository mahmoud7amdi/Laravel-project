<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProtfolioStoreRequest;
use App\Models\Protfolio;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProtfolioController extends Controller
{
    public function AllProtfolio()
    {
        $protfolio = Protfolio::latest()->get();
        return view('admin.protfolio.protfolio_all',compact('protfolio'));
    }

    public function AddProtfolio ()
    {
        return view('admin.protfolio.add_protfolio');
    }

    public function StoreProtfolio(ProtfolioStoreRequest $request)
    {
        $image = $request->file('protfolio_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1020,519)->save('upload/protfolio/'.$name_gen);
        $save_url = 'upload/protfolio/'.$name_gen;
        Protfolio::insert([
            'protfolio_name' => $request->protfolio_name,
            'protfolio_title' => $request->protfolio_title,
            'protfolio_description' => $request->protfolio_description,
            'protfolio_image' => $save_url
        ]);
        $notification = array(
            'message' => 'Hprotfolio Inserted  successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.protfolio')->with($notification);
    }


    public function EditProtfolio($id)
    {
        $protfolio = Protfolio::findOrFail($id);
        return view('admin.protfolio.edit_protfolio',compact('protfolio'));
    }

    public function UpdateProtfolio(ProtfolioStoreRequest $request)
    {
        $protfolio_id = $request->id ;
        if ($request->file('protfolio_image')) {
            $image = $request->file('protfolio_image');
            $mame_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/protfolio/'.$mame_gen);
            $save_url = ('upload/protfolio/'.$mame_gen);

            Protfolio::findOrFail($protfolio_id)->update([
                'protfolio_name' => $request->protfolio_name,
                'protfolio_title' => $request->protfolio_title,
                'protfolio_description' => $request->protfolio_description,
                'protfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'protfolio Updated with Image  successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('all.protfolio')->with($notification);
        }else{
            Protfolio::findOrFail($protfolio_id)->update([
                'protfolio_name' => $request->protfolio_name,
                'protfolio_title' => $request->protfolio_title,
                'protfolio_description' => $request->protfolio_description,
            ]);
            $notification = array(
                'message' => 'protfolio Updated without Image  successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('all.protfolio')->with($notification);
        }

    }

    public function DeleteProtfolio($id)
    {

        $protfolio =  Protfolio::findOrFail($id);
        $img = $protfolio->protfolio_image ;
        unlink($img);
        Protfolio::findOrFail($id)->delete() ;

        $notification = array(
            'message' => 'protfolio Deleted  successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }


    public function ProtfolioDetails($id)
    {
        $protfolio = Protfolio::findOrFail($id);
        return view('frontend.protfolio_details',compact('protfolio'));
    }

    public function HomeProtfolio()
    {
        $protfolio = Protfolio::latest()->get();
        return view('frontend.protfolio',compact('protfolio'));
    }

}
