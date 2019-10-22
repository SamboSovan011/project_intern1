<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Categories;
use App\User;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // Slide

    public function slideListing()
    {
        $slide = Slide::all();
        return view('listing.listingSlide')->with('slides', $slide);
    }

    public function slideForm()
    {
        return view('dashboard.slide');
    }

    public function postSlide(Request $request)
    {
        if ($request->all()) {
            $validateData = $request->validate([
                'title' => 'required|max:255',
                'desc' => 'required|max:655535',
                'image' => 'required|mimes:jpeg,png,jpg,svg,gif',
            ]);

            if ($validateData) {
                $slide = new Slide();
                $slide->user_email = Auth::user()->email;
                $slide->title = $request->input('title');
                $slide->description = $request->input('desc');

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . "." . $extension;
                    $file->move('img/', $filename);
                    $img_path = "img/" . time() . "." . $extension;
                    $slide->img_path = $img_path;
                    session()->flash('success', 'You have posted a slide successfully!');
                } else {
                    return $request;
                    $slide->img_path = "";
                }

                $slide->save();
                return redirect()->route('slidelisting');
            }
        } else {
            session()->flash('error', 'Sorry! We could not get all data. Please reinsert again!');
            return redirect()->route('slidelisting');
        }
    }

    public function deleteSlide($id)
    {
        if (Slide::findOrFail($id)) {
            Slide::where('id', $id)
                ->delete();
            session()->flash('success', 'You just deleted a slide!');
        } else {
            session()->flash('error', 'Sorry, there is some wrong occur!');
        }

        return redirect()->route('slidelisting');
    }

    public function approveSlide($id)
    {
        if (Slide::findOrFail($id)) {
            Slide::where('id', $id)
                ->update(['is_approved' => 2]);
            session()->flash('success', 'You just approved a slide post!');
        }

        return redirect()->route('slidelisting');
    }

    public function blockSlide($id)
    {
        if (Slide::findOrFail($id)) {
            Slide::where('id', $id)
                ->update(['is_approved' => 0]);
            session()->flash('success', 'You just blocked a slide post!');
        }
        return redirect()->route('slidelisting');
    }

    public function getSlideData($id)
    {
        if (request()->ajax()) {
            $data = Slide::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editSlide(Request $request, $id)
    {


        $validateData = $request->validate([
            'title' => 'required|max:225',
            'description' => 'required|max:65535',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validateData) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('img/', $filename);
                $img_path = "img/" . time() . "." . $extension;
                Slide::where('id', $id)->update([
                    'title' => $request->input('title'),
                    'user_email' => Auth::user()->email,
                    'description' => $request->input('description'),
                    'img_path' => $img_path,
                    'is_approved' => 1

                ]);
                session()->flash('success', 'You have successfully update a post!');

                return redirect()->route('slidelisting');
            } else {
                Slide::where('id', $id)->update([
                    'title' => $request->input('title'),
                    'user_email' => Auth::user()->email,
                    'description' => $request->input('description'),
                    'is_approved' => 1
                ]);
                session()->flash('success', 'You have successfully update a post!');

                return redirect()->route('slidelisting');
            }
        }
    }

    // Category

    public function categoryListing()
    {
        $cate = Categories::all();
        return view('listing.listingCategory')->with('cates', $cate);
    }

    public function categoryPostingForm()
    {
        return view('dashboard.category');
    }

    public function postNewCategory(Request $request)
    {

        if ($request->all()) {
            $validateData = $request->validate([
                'title' => 'required|max:255',
                'desc' => 'required|max:65535',
                'image' => 'required|mimes:jpeg,png,jpg,svg,gif',
            ]);

            if ($validateData) {
                $category = new Categories();
                $category->user_email = Auth::user()->email;
                $category->title = $request->input('title');
                $category->description = $request->input('desc');

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('img/', $filename);
                    $filepath = '/img/' . $filename;
                    $category->img_path = $filepath;

                    session()->flash('success', 'You have post a new category!');
                }

                $category->save();
                return redirect()->route('categorylisting');
            }
        } else {
            session()->flash('error', 'Sorry! We could not get all data. Please reinsert again!');
            return redirect()->route('categorylisting');
        }
    }

    public function approveCategory($id)
    {
        if (Categories::findOrFail($id)) {
            Categories::where('id', $id)
                ->update([
                    'is_approved' => 2
                ]);

            session()->flash('success', 'You have approved a category!');
            return redirect()->route('categorylisting');
        }
    }
    public function blockCategory($id)
    {
        if (Categories::findOrFail($id)) {
            Categories::where('id', $id)
                ->update([
                    'is_approved' => 0
                ]);
            session()->flash('success', 'You have block a category!');
            return redirect()->route('categorylisting');
        }
    }

    public function deleteCategory($id)
    {
        if (Categories::findOrFail($id)) {
            Categories::where('id', $id)
                ->delete();
            session()->flash('success', 'You have successfully deleted a category.');
            return redirect()->route('categorylisting');
        }
    }

    public function getCategory($id)
    {
        if (request()->ajax()) {
            $data = Categories::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editCategory(Request $request, $id)
    {

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'description' =>  'required|max:65535',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validateData) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $img_path = '/img/' . $filename;
                $file->move('/img', $filename);
                Categories::where('id', $id)
                    ->update([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'user_email' => Auth::user()->email,
                        'img_path' => $img_path,
                        'is_approved' => 1
                    ]);
                session()->flash('success', 'You have updated a category!');
                return redirect()->route('categorylisting');
            } else {
                Categories::where('id', $id)
                    ->update([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'user_email' => Auth::user()->email,
                        'is_approved' => 1
                    ]);
                session()->flash('success', 'You have updated a category');
                return redirect()->route('categorylisting');
            }
        }
    }

    //User listing

    public function listingUser()
    {
        $user = User::all();
        return view('listing.listingUser')->with('users', $user);
    }

    public function add_admin($id)
    {
        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 1
                ]);
            session()->flash('success', 'Successfully! Update to admin.');
            return redirect()->route('listingUser');
        } else {
            session()->flash('error', 'Fail to Update User!');
            return redirect()->route('listingUser');
        }
    }

    public function add_subadmin($id)
    {
        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 2
                ]);
            session()->flash('success', 'Successfully! Update to Staff.');
            return redirect()->route('listingUser');
        } else {
            session()->flash('error', 'Fail to Update User!');
            return redirect()->route('listingUser');
        }
    }

    public function add_user($id)
    {
        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 0
                ]);
            session()->flash('success', 'Successfully! Update to user.');
            return redirect()->route('listingUser');
        }
        session()->flash('error', 'Fail to Update User!');
        return redirect()->route('listingUser');
    }

    public function block_user($id)
    {
        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => -1
                ]);
            session()->flash('success', 'Successfully! Block the user.');
            return redirect()->route('listingUser');
        }
        session()->flash('error', 'Fail to Update User!');
        return redirect()->route('listingUser');
    }

    public function delete_user($id){
        if(User::findOrFail($id)){
            User::where('id', $id)->delete();
            session()->flash('success', 'Successfully! Delete the user.');
            return redirect()->route('listingUser');
        }
        else{
            session()->flash('error', 'There is something wrong occur. Please try again!');
            return redirect()->route('listingUser');
        }
    }

    public function getUserdata($id){
        if(request()->ajax()){
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editUser(Request $request, $id){

        $validateData = $request->validate([
            'firstname' => 'required|max:225',
            'lastname' => 'required|max:225',
            'phone' => 'required|integer|digits_between:8,20',
            'user-email' => 'required|email|max:225',
        ]);

        if($validateData){
            User::where('id', $id)
                ->update([
                    'fname' => $request->input('firstname'),
                    'lname' => $request->input('lastname'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('user-email')
                ]);
            session()->flash('success', 'Successfully, Update a user.');
            return redirect()->route('listingUser');
        }

    }
}
