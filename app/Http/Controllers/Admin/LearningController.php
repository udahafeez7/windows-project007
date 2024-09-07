<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pretasks;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;// Use the Intervention Image Facade for image handling

class LearningController extends Controller
{
    // Method to get all pretasks
    public function AllPretasks()
    {
        $pretasks = Pretasks::latest()->get();
        return view('admin.backend.pretasks.all_pretasks', compact('pretasks'));
    }

    // Method to show add pretasks form
    public function AddPretasks()
    {
        return view('admin.backend.pretasks.add_pretasks');
    }

    // Method to store new pretasks
    public function StorePretasks(Request $request)
    {

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

            Pretasks::create([
                'pretasks_name' => $request->pretasks_name,
                'image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'New Pretasks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.pretasks')->with($notification);
    }

    // Method to edit pretasks
    public function EditPretasks($id)
    {
        $pretasks = Pretasks::find($id);
        return view('admin.backend.pretasks.edit_pretasks', compact('pretasks'));
    }

    // Method to update pretasks
    public function UpdatePretasks(Request $request)
    {
        $pre_id = $request->id;

        // Validate the form data
        $request->validate([
            'pretasks_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath()); // Use the Image facade
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

            // Update pretasks with new image
            Pretasks::find($pre_id)->update([
                'pretasks_name' => $request->pretasks_name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Pretasks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.pretasks')->with($notification);
        } else {
            // Update only the name if no image was uploaded
            Pretasks::find($pre_id)->update([
                'pretasks_name' => $request->pretasks_name,
            ]);

            $notification = array(
                'message' => 'Pretasks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.pretasks')->with($notification);
        }
    }

    // Method to delete pretasks
    public function DeletePretasks($id)
    {
        $item = Pretasks::find($id);
        $img = $item->image;

        // Delete the image from storage
        if (file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        // Delete the pretasks record
        Pretasks::find($id)->delete();

        $notification = array(
            'message' => 'Pretasks Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
