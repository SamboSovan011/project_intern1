<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Categories;
use App\User;
use App\Products;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $slide = Slide::withTrashed()->where('id', $id)->firstOrFail();

        if ($slide->trashed()) {
            $slide->forceDelete();


            session()->flash('success', 'You have delete a slide from trash!');
            return redirect(route('trash'));
        } else {
            $slide->delete();
            session()->flash('success', 'You have delete a slide!');
            return redirect(route('slidelisting'));
        };
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
        $cate = Categories::withTrashed()->where('id', $id)->firstOrFail();

        if ($cate->trashed()) {
            $cate->forceDelete();


            session()->flash('success', 'You have delete a category from trash!');

            return redirect(route('trash'));
        } else {
            $cate->delete();
            session()->flash('success', 'You have delete a category!');

            return redirect(route('categorylisting'));
        };
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
        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'You have been assign as Admin',
            'reciever' => $user_name,
            'content' => 'Potted Pan has assign your account to Administrator Account!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];


        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 1
                ]);
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('Role Assign');
            });
            session()->flash('success', 'Successfully! Update to admin.');
            return redirect()->route('listingUser');
        } else {
            session()->flash('error', 'Fail to Update User!');
            return redirect()->route('listingUser');
        }
    }

    public function add_subadmin($id)
    {
        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'You have been assign as Staff',
            'reciever' => $user_name,
            'content' => 'Potted Pan has assign your account to Staff Account!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 2
                ]);
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('Role Assign');
            });
            session()->flash('success', 'Successfully! Update to Staff.');
            return redirect()->route('listingUser');
        } else {
            session()->flash('error', 'Fail to Update User!');
            return redirect()->route('listingUser');
        }
    }

    public function add_user($id)
    {
        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'You have been assign as User',
            'reciever' => $user_name,
            'content' => 'Potted Pan has assign your account to User Account!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => 0
                ]);
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('Role Assign');
            });
            session()->flash('success', 'Successfully! Update to user.');
            return redirect()->route('listingUser');
        }
        session()->flash('error', 'Fail to Update User!');
        return redirect()->route('listingUser');
    }

    public function block_user($id)
    {
        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'You have been block due to some violation action occure',
            'reciever' => $user_name,
            'content' => 'Potted Pan has temporily block your account.',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        if (User::findOrFail($id)) {
            User::where('id', $id)
                ->update([
                    'is_admin' => -1
                ]);
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('Block Alert!');
            });
            session()->flash('success', 'Successfully! Block the user.');
            return redirect()->route('listingUser');
        }
        session()->flash('error', 'Fail to Update User!');
        return redirect()->route('listingUser');
    }

    public function delete_user($id)
    {
        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'You have been deleted due to some violation action occure or requests ',
            'reciever' => $user_name,
            'content' => 'Potted Pan has temporily block your account.',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        if (User::findOrFail($id)) {
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('Sorry! Your account has been deleted.');
            });
            User::where('id', $id)->delete();
            session()->flash('success', 'Successfully! Delete the user.');
            return redirect()->route('listingUser');
        } else {
            session()->flash('error', 'There is something wrong occur. Please try again!');
            return redirect()->route('listingUser');
        }
    }

    public function getUserdata($id)
    {
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editUser(Request $request, $id)
    {

        $user_email = User::where('id', $id)->first()->email;
        $user_name = User::where('id', $id)->first()->fname;

        $data = [
            'title' => 'Your account information has updated.',
            'reciever' => $user_name,
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'phone' => $request->input('phone'),
            'userEmail' => $request->input('user-email'),
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];


        $validateData = $request->validate([
            'firstname' => 'required|max:225',
            'lastname' => 'required|max:225',
            'phone' => 'required|integer|digits_between:8,20',
            'user-email' => 'required|email|max:225',
        ]);

        if ($validateData) {
            User::where('id', $id)
                ->update([
                    'fname' => $request->input('firstname'),
                    'lname' => $request->input('lastname'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('user-email')
                ]);
            Mail::send('email.mailNotification', $data, function ($message) use ($user_email, $user_name) {

                $message->to($user_email, $user_name);
                $message->subject('We have updated your information!');
            });
            session()->flash('success', 'Successfully, Update a user.');
            return redirect()->route('listingUser');
        }
    }

    // trash

    public function trash()
    {
        $products = Products::onlyTrashed()->get();
        $cates = Categories::onlyTrashed()->get();
        $slides = Slide::onlyTrashed()->get();
        $productItems = Products::with('reviews.users')->with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc')->onlyTrashed();
        }])->get();;
        return view('dashboard.trash1', compact('slides', 'cates', 'products', 'productItems'));
    }

    public function restoreSlide($id)
    {
        $slide = Slide::withTrashed()->where('id', $id)->firstOrFail();
        $slide->restore();

        session()->flash('success', 'You have restore a slide!');

        return redirect()->back();
    }

    public function restoreCate($id)
    {
        $cate = Categories::withTrashed()->where('id', $id)->firstOrFail();
        $cate->restore();

        session()->flash('success', 'You have restore a category!');

        return redirect()->back();
    }


    public function pendingListing(){
        $cates = Categories::where('is_approved', 1)->get();
        $slides = Slide::where('is_approved', 1)->get();
        $productItems = Products::with('reviews.users')->with(['reviews' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->get();;
        $products = Products::where('is_approved', 1)->get();
        // dd($productItems->toArray());
        return view('listing.pendingItem', compact('cates', 'slides', 'productItems', 'products'));
    }
}
