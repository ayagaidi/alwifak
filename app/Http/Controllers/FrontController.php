<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function services()
    {
        return view('front.services');
    }

    public function blog()
    {
        return view('front.blog');
    }

    public function singleBlog()
    {
        return view('front.single-blog');
    }

    public function pricing()
    {
        return view('front.pricing');
    }

    public function project()
    {
        return view('front.project');
    }

    public function team()
    {
        return view('front.team');
    }

    public function testimonial()
    {
        return view('front.testimonial');
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function checkout()
    {
        return view('front.checkout');
    }

    public function productDetail()
    {
        return view('front.product-detail');
    }

    public function shop()
    {
        return view('front.shop');
    }

    public function domain()
    {
        return view('front.domain');
    }

    public function reseller()
    {
        return view('front.reseller');
    }

    public function shared()
    {
        return view('front.shared');
    }

    public function vps()
    {
        return view('front.vps');
    }

    public function dedicated()
    {
        return view('front.dedicated');
    }

    public function loadMore()
    {
        return view('front.load-more');
    }

    public function oneColumn()
    {
        return view('front.one-column');
    }

    public function twoColumn()
    {
        return view('front.two-column');
    }

    public function threeColumn()
    {
        return view('front.three-column');
    }

    public function threeColumSidbar()
    {
        return view('front.three-colum-sidbar');
    }

    public function fourColumn()
    {
        return view('front.four-column');
    }

    public function sixColumFullWide()
    {
        return view('front.six-colum-full-wide');
    }

    public function newsletterSubscribe(Request $request)
    {
        // Handle newsletter subscription
        // For now, just redirect back with success
        return back()->with('success', 'Subscribed successfully!');
    }
}
