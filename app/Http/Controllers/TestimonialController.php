<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $testimonials = Testimonial::select([
                'id',
                'name',
                'message',
                'rating',
                'created_at'
            ]);

            return DataTables::of($testimonials)
                ->addColumn('rating_stars', function ($testimonial) {
                    $stars = '';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $testimonial->rating) {
                            $stars .= '<i class="fas fa-star text-warning"></i>';
                        } else {
                            $stars .= '<i class="far fa-star text-warning"></i>';
                        }
                    }
                    return $stars;
                })
                ->addColumn('message_preview', function ($testimonial) {
                    return strlen($testimonial->message) > 50
                        ? substr($testimonial->message, 0, 50) . '...'
                        : $testimonial->message;
                })
                ->addColumn('actions', function ($testimonial) {
                    $editBtn = '<button class="btn btn-sm btn-info btn-edit" title="Edit" data-testimonial-id="' . $testimonial->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-testimonial-id="' . $testimonial->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions', 'rating_stars'])
                ->make(true);
        }

        return view('testimonials.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::beginTransaction();

        try {
            $testimonial = Testimonial::create([
                'name' => $request->name,
                'message' => $request->message,
                'rating' => $request->rating,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial created successfully',
                'testimonial' => $testimonial
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonial creation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the testimonial'
            ], 500);
        }
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::beginTransaction();

        try {
            $testimonial->update([
                'name' => $request->name,
                'message' => $request->message,
                'rating' => $request->rating,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial updated successfully',
                'testimonial' => $testimonial
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonial update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the testimonial'
            ], 500);
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Testimonial deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the testimonial'
            ], 500);
        }
    }
}
