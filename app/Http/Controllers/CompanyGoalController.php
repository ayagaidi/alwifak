<?php

namespace App\Http\Controllers;

use App\Models\CompanyGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class CompanyGoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companyGoals = CompanyGoal::select(['id', 'title', 'description', 'created_at']);

            return DataTables::of($companyGoals)
                ->addColumn('actions', function ($companyGoal) {
                    $editBtn = '<button class="btn btn-sm btn-info btn-edit" title="تعديل" data-company-goal-id="' . $companyGoal->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="حذف" data-company-goal-id="' . $companyGoal->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('company-goals.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $companyGoal = CompanyGoal::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الهدف بنجاح',
                'companyGoal' => $companyGoal
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('CompanyGoal creation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة الهدف'
            ], 500);
        }
    }

    public function update(Request $request, CompanyGoal $companyGoal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $companyGoal->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الهدف بنجاح',
                'companyGoal' => $companyGoal
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('CompanyGoal update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الهدف'
            ], 500);
        }
    }

    public function destroy(CompanyGoal $companyGoal)
    {
        try {
            $companyGoal->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الهدف بنجاح'
            ]);

        } catch (\Exception $e) {
            Log::error('CompanyGoal deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الهدف'
            ], 500);
        }
    }
}
