<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\CompanyGoal;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return view('search.index', ['results' => [], 'query' => '']);
        }

        $results = [];

        // Search Users
        $results['users'] = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Customers
        $results['customers'] = Customer::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('company', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Services
        $results['services'] = Service::where('name_ar', 'LIKE', "%{$query}%")
            ->orWhere('name_en', 'LIKE', "%{$query}%")
            ->orWhere('description_ar', 'LIKE', "%{$query}%")
            ->orWhere('description_en', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Blogs
        $results['blogs'] = Blog::where('title_ar', 'LIKE', "%{$query}%")
            ->orWhere('title_en', 'LIKE', "%{$query}%")
            ->orWhere('content_ar', 'LIKE', "%{$query}%")
            ->orWhere('content_en', 'LIKE', "%{$query}%")
            ->orWhere('excerpt_ar', 'LIKE', "%{$query}%")
            ->orWhere('excerpt_en', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Contacts
        $results['contacts'] = Contact::where('email', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Testimonials
        $results['testimonials'] = Testimonial::where('name', 'LIKE', "%{$query}%")
            ->orWhere('message', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Invoices
        $results['invoices'] = Invoice::where('invoice_number', 'LIKE', "%{$query}%")
            ->orWhere('notes', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Partners
        $results['partners'] = Partner::where('name_ar', 'LIKE', "%{$query}%")
            ->orWhere('name_en', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Search Company Goals
        $results['company_goals'] = CompanyGoal::where('title', 'LIKE', "%{$query}%")
            ->orWhere('title_en', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('description_en', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return view('search.index', compact('results', 'query'));
    }
}
