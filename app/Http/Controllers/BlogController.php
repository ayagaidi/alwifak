<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::select(['id', 'title_ar', 'title_en', 'slug', 'status', 'published_at', 'created_at'])
                ->with('author:id,name');

            return DataTables::of($blogs)
                ->addColumn('title', function ($blog) {
                    return app()->getLocale() === 'ar' ? $blog->title_ar : $blog->title_en;
                })
                ->addColumn('author_name', function ($blog) {
                    return $blog->author->name ?? 'غير محدد';
                })
                ->addColumn('status_badge', function ($blog) {
                    $statusClass = $blog->status === 'published' ? 'success' : 'warning';
                    $statusText = $blog->status === 'published' ? 'منشور' : 'مسودة';
                    return '<span class="badge bg-' . $statusClass . '">' . $statusText . '</span>';
                })
                ->addColumn('actions', function ($blog) {
                    $editBtn = '<button class="btn btn-sm btn-info btn-edit" title="تعديل" data-blog-id="' . $blog->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="حذف" data-blog-id="' . $blog->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('blogs.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'excerpt_ar' => 'nullable|string|max:500',
            'excerpt_en' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->title_en);

            // Ensure unique slug
            $count = 0;
            $originalSlug = $slug;
            while (Blog::where('slug', $slug)->exists()) {
                $count++;
                $slug = $originalSlug . '-' . $count;
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('blogs', 'public');
            }

            $blog = Blog::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'slug' => $slug,
                'content_ar' => $request->content_ar,
                'content_en' => $request->content_en,
                'excerpt_ar' => $request->excerpt_ar,
                'excerpt_en' => $request->excerpt_en,
                'author_id' => auth()->id(),
                'status' => $request->status,
                'published_at' => $request->status === 'published' ? ($request->published_at ?? now()) : null,
                'image' => $imagePath,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة المقالة بنجاح',
                'blog' => $blog
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog creation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة المقالة'
            ], 500);
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'excerpt_ar' => 'nullable|string|max:500',
            'excerpt_en' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->title_en);

            // Ensure unique slug (excluding current blog)
            $count = 0;
            $originalSlug = $slug;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $count++;
                $slug = $originalSlug . '-' . $count;
            }

            $imagePath = $blog->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                $imagePath = $request->file('image')->store('blogs', 'public');
            }

            $blog->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'slug' => $slug,
                'content_ar' => $request->content_ar,
                'content_en' => $request->content_en,
                'excerpt_ar' => $request->excerpt_ar,
                'excerpt_en' => $request->excerpt_en,
                'status' => $request->status,
                'published_at' => $request->status === 'published' ? ($request->published_at ?? now()) : null,
                'image' => $imagePath,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث المقالة بنجاح',
                'blog' => $blog
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث المقالة'
            ], 500);
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            // Delete image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف المقالة بنجاح'
            ]);

        } catch (\Exception $e) {
            Log::error('Blog deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف المقالة'
            ], 500);
        }
    }
}
