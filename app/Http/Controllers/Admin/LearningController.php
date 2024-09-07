<?php

namespace App\Http\Controllers\Admin; // This groups the LearningController under the Admin section of the application,
use App\Models\Pretasks; // This allows you to access the Pretasks class directly, without needing to use the full namespace path.
use App\Models\Category; // Import Category model
use Illuminate\Support\Facades\Auth; // Import the Auth facade, which provides authentication functionalities.
use App\Http\Controllers\Controller; // The controller you're extending. This is necessary in Laravel because all controllers should extend the base Controller class.
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LearningController extends Controller
{
    public function AllPretasks()
    {
        
        $pretasks = Pretasks::latest()->get(); //get latest data
        return view('admin.backend.pretasks.all_pretasks', compact('pretasks'));//create folder in resources->admin->pretasks->all_pre_tasks.blade.php
    }
    public function AddPretasks()
    {
        return view('admin.backend.pretasks.add_pretasks');
    }
    public function StorePretasks(Request $request)
    {

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

            Category::create([
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
    public function EditPretasks($id)
    {
        $pretasks = Pretasks::find($id);
        return view('admin.backend.pretasks.edit_pretasks', compact('pretasks'));
    }
    // End Method

    public function UpdatePretasks(Request $request)
    {

        $pre_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

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

            Pretasks::find($pre_id)->update([
                'pretasks_name' => $request->pretasks_name,
            ]);
            $notification = array(
                'message' => 'Exsisting Pretasks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.pretasks')->with($notification);
        }
    }
    // End Method

    public function DeletePretasks($id)
    {
        $item = Pretasks::find($id);
        $img = $item->image;
        unlink($img);

        Pretasks::find($id)->delete();

        $notification = array(
            'message' => 'Exsisting Pretasks Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Method

    //
    // End Method

}
