<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::select([
                'id',
                'phone',
                'email',
                'address',
                'facebook_url',
                'twitter_url',
                'linkedin_url',
                'youtube_url',
                'instagram_url',
                'website_url',
                'whatsapp',
                'telegram',
                'created_at'
            ]);

            return DataTables::of($contacts)
                ->addColumn('social_links', function ($contact) {
                    $links = [];
                    if ($contact->facebook_url) $links[] = '<a href="' . $contact->facebook_url . '" target="_blank" class="text-primary me-1"><i class="fab fa-facebook"></i></a>';
                    if ($contact->twitter_url) $links[] = '<a href="' . $contact->twitter_url . '" target="_blank" class="text-info me-1"><i class="fab fa-twitter"></i></a>';
                    if ($contact->linkedin_url) $links[] = '<a href="' . $contact->linkedin_url . '" target="_blank" class="text-primary me-1"><i class="fab fa-linkedin"></i></a>';
                    if ($contact->youtube_url) $links[] = '<a href="' . $contact->youtube_url . '" target="_blank" class="text-danger me-1"><i class="fab fa-youtube"></i></a>';
                    if ($contact->instagram_url) $links[] = '<a href="' . $contact->instagram_url . '" target="_blank" class="text-danger me-1"><i class="fab fa-instagram"></i></a>';
                    if ($contact->website_url) $links[] = '<a href="' . $contact->website_url . '" target="_blank" class="text-success me-1"><i class="fas fa-globe"></i></a>';
                    return implode('', $links);
                })
                ->addColumn('messaging', function ($contact) {
                    $messaging = [];
                    if ($contact->whatsapp) $messaging[] = '<a href="https://wa.me/' . preg_replace('/[^0-9]/', '', $contact->whatsapp) . '" target="_blank" class="text-success me-1"><i class="fab fa-whatsapp"></i></a>';
                    if ($contact->telegram) $messaging[] = '<a href="https://t.me/' . ltrim($contact->telegram, '@') . '" target="_blank" class="text-info me-1"><i class="fab fa-telegram"></i></a>';
                    return implode('', $messaging);
                })
                ->addColumn('actions', function ($contact) {
                    $editBtn = '<button class="btn btn-sm btn-info btn-edit" title="تعديل" data-contact-id="' . $contact->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="حذف" data-contact-id="' . $contact->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions', 'social_links', 'messaging'])
                ->make(true);
        }

        // Check if contact exists to determine if we should show add button
        $contactExists = Contact::exists();

        return view('contacts.index', compact('contactExists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'email' => 'nullable|string|email|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'twitter_url' => 'nullable|string|url|max:255',
            'linkedin_url' => 'nullable|string|url|max:255',
            'youtube_url' => 'nullable|string|url|max:255',
            'instagram_url' => 'nullable|string|url|max:255',
            'website_url' => 'nullable|string|url|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            // Check if contact already exists
            $existingContact = Contact::first();

            if ($existingContact) {
                // Update existing contact
                $existingContact->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                    'facebook_url' => $request->facebook_url,
                    'twitter_url' => $request->twitter_url,
                    'linkedin_url' => $request->linkedin_url,
                    'youtube_url' => $request->youtube_url,
                    'instagram_url' => $request->instagram_url,
                    'website_url' => $request->website_url,
                    'whatsapp' => $request->whatsapp,
                    'telegram' => $request->telegram,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث بيانات الاتصال بنجاح',
                    'contact' => $existingContact
                ]);
            } else {
                // Create new contact
                $contact = Contact::create([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                    'facebook_url' => $request->facebook_url,
                    'twitter_url' => $request->twitter_url,
                    'linkedin_url' => $request->linkedin_url,
                    'youtube_url' => $request->youtube_url,
                    'instagram_url' => $request->instagram_url,
                    'website_url' => $request->website_url,
                    'whatsapp' => $request->whatsapp,
                    'telegram' => $request->telegram,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'تم إضافة بيانات الاتصال بنجاح',
                    'contact' => $contact
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Contact creation/update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ بيانات الاتصال'
            ], 500);
        }
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'email' => 'nullable|string|email|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'twitter_url' => 'nullable|string|url|max:255',
            'linkedin_url' => 'nullable|string|url|max:255',
            'youtube_url' => 'nullable|string|url|max:255',
            'instagram_url' => 'nullable|string|url|max:255',
            'website_url' => 'nullable|string|url|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            $contact->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'linkedin_url' => $request->linkedin_url,
                'youtube_url' => $request->youtube_url,
                'instagram_url' => $request->instagram_url,
                'website_url' => $request->website_url,
                'whatsapp' => $request->whatsapp,
                'telegram' => $request->telegram,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث بيانات الاتصال بنجاح',
                'contact' => $contact
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Contact update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث بيانات الاتصال'
            ], 500);
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف بيانات الاتصال بنجاح'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف بيانات الاتصال'
            ], 500);
        }
    }
    
}
