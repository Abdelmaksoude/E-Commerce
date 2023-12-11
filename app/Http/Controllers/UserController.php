<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Contact;
use App\Models\FavouriteProduct;
use App\Models\ProductAttachment;
use App\Models\Review;
use App\Models\Slider;
use App\Models\MainCategory;
use Auth;
use App\Mail\SendTheContact;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        $allProducts = Product::all();
        $all_favourite_product = FavouriteProduct::all();
        $all_sliders = Slider::all();
        $all_category = MainCategory::all();
        return view('user.home',compact('site_details','allProducts','all_favourite_product','theFavourite','all_sliders','all_category'));
    }
    public function productCategory($id)
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        $all_product_for_this_product = Product::where('category_id',$id)->get();
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.productcategory',compact('all_product_for_this_product','site_details','theFavourite'));
    }
    public function shop()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        $allProducts = Product::all();
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.shop',compact('site_details','allProducts','theFavourite'));
    }
    public function filterProducts(Request $request)
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });

        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        $filter = Product::where('final_value','<',$request->input('value'))->get();
        return view('user.product_list',compact('site_details','theFavourite','filter'));
    }
    public function details($id)
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        $product = Product::findorFail($id);
        $productAttachments = ProductAttachment::where('product_id',$id)->get();
        $review = Review::where('product_id',$id)->get();
        $total = Review::where('product_id', $id)->sum('rate');
        $reviewCount = Review::where('product_id',$id)->count();
        $totalreviewcount = ($reviewCount > 0) ? ($total / $reviewCount) : 0;
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.details',compact('site_details','product','productAttachments','review','reviewCount','theFavourite','totalreviewcount'));
    }
    public function detailsReview(Request $request, $id)
    {
        Review::create([
            'review'=>$request->review,
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'rate'=>$request->rate,
            'product_id'=>$id,
        ]);
        return redirect()->back()->with('error','Your Review Added Successfully');
    }
    public function shoping_cart()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.shoping_cart',compact('site_details','theFavourite'));
    }
    public function checkout()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        $cartItems = \Cart::getContent();
        return view('user.checkout',compact('site_details','theFavourite','cartItems'));
    }
    public function Allavourite()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        $allFavourite = FavouriteProduct::where('user_id',\Auth::user()->id)->get();
        return view('user.favourite',compact('site_details','allFavourite','theFavourite'));
    }
    public function contact()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.contact',compact('site_details','theFavourite'));
    }
    public function sendcontact(Request $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        Mail::to('abdelmaqsoudgomma@gmail.com')->send(new SendTheContact(
            $contact->name,
            $contact->email,
            $contact->subject,
            $contact->message
        ));
        return redirect()->back()->with('error','Your Mail Sendded Successfully');
    }

    public function addFavourite(Request $request, $id)
    {
        $existingFavorite = FavouriteProduct::where('product_id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$existingFavorite) {
            FavouriteProduct::create([
                'product_id' => $id,
                'user_id' => Auth::user()->id,
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Product added to favorites successfully']);
    }

    public function deleteFavourite($id)
    {
        FavouriteProduct::destroy($id);
        // return response()->json(['success' => true]);
        return response()->json(['success' => true, 'message' => 'Product deletes from favorites successfully']);
    }
    public function deleteFavouritefromhomepage($id)
    {
        $deleteFromFavouriteTable = FavouriteProduct::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if($deleteFromFavouriteTable)
        {
            $deleteFromFavouriteTable->delete();
        }
        // return redirect()->back()->with('error','Producted Deleted From Favourite Successfully');
        return response()->json(['success' => true, 'message' => 'Product deletes from favorites successfully']);
    }
}
