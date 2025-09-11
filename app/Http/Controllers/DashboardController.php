<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Example dashboard data - you can customize this
            $stats = [
                'total_users' => DB::table('users')->count(),
                'active_sessions' => DB::table('sessions')->where('last_activity', '>', now()->subMinutes(5)->timestamp)->count(),
                'recent_activities' => [], // You can populate this with actual data
            ];

            return view('dashboard.index', compact('stats'));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('dashboard.index', ['stats' => []]);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Example transaction with rollback
            // Replace this with your actual business logic

            // For demonstration, let's create a simple user action log
            DB::table('user_actions')->insert([
                'user_id' => Auth::check() ? Auth::id() : null,
                'action' => $request->action ?? 'dashboard_action',
                'data' => json_encode($request->all()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم حفظ البيانات بنجاح'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Dashboard store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ البيانات'
            ], 500);
        }
    }
}
