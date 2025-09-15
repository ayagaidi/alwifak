<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'active', 'created_at']);
            return DataTables::of($users)
                ->addColumn('status', function ($user) {
                    return $user->active ? '<span class="badge badge-success">مفعل</span>' : '<span class="badge badge-secondary">غير مفعل</span>';
                })
                ->addColumn('actions', function ($user) {
                    $editBtn = '<button class="btn btn-sm btn-info btn-edit" title="تعديل" data-user-id="' . $user->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="حذف" data-user-id="' . $user->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    $toggleBtn = $user->active ?
                        '<button class="btn btn-sm btn-warning btn-toggle-active" title="إلغاء التفعيل" data-user-id="' . $user->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16"><path d="M5 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0z"/><path d="M0 8a5 5 0 0 0 10 0 5 5 0 0 0-10 0z"/></svg></button>' :
                        '<button class="btn btn-sm btn-warning btn-toggle-active" title="تفعيل" data-user-id="' . $user->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16"><path d="M11 8a3 3 0 1 0-6 0 3 3 0 0 0 6 0z"/><path d="M16 8a5 5 0 0 1-10 0 5 5 0 0 1 10 0z"/></svg></button>';
                    return $editBtn . ' ' . $deleteBtn . ' ' . $toggleBtn;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('users.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة المستخدم بنجاح',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User creation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة المستخدم'
            ], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث المستخدم بنجاح',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث المستخدم'
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف المستخدم بنجاح'
            ]);

        } catch (\Exception $e) {
            Log::error('User deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف المستخدم'
            ], 500);
        }
    }

    public function toggleActive(User $user)
    {
        try {
            $user->update(['active' => !$user->active]);

            $message = $user->active ? 'تم تفعيل المستخدم' : 'تم إلغاء تفعيل المستخدم';

            return response()->json([
                'success' => true,
                'message' => $message,
                'active' => $user->active
            ]);

        } catch (\Exception $e) {
            Log::error('User toggle active error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تغيير حالة المستخدم'
            ], 500);
        }
    }
}
