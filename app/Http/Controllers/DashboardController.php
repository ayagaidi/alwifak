<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Partner;
use App\Models\CompanyGoal;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Comprehensive dashboard statistics
            $stats = [
                // Basic counts
                'total_users' => DB::table('users')->count(),
                'total_customers' => Customer::count(),
                'total_services' => Service::count(),
                'total_contacts' => Contact::count(),
                'total_testimonials' => Testimonial::count(),
                'total_blogs' => Blog::count(),
                'total_partners' => Partner::count(),
                'total_company_goals' => CompanyGoal::count(),

                // Financial statistics
                'total_invoices' => Invoice::count(),
                'paid_invoices' => Invoice::where('payment_status', 'paid')->count(),
                'pending_invoices' => Invoice::where('payment_status', 'pending')->count(),
                'overdue_invoices' => Invoice::where('payment_status', 'overdue')->count(),
                'total_revenue' => Invoice::where('payment_status', 'paid')->sum('total_amount'),
                'pending_revenue' => Invoice::where('payment_status', 'pending')->sum('total_amount'),

                // Monthly growth (current month vs previous month)
                'monthly_revenue' => Invoice::where('payment_status', 'paid')
                    ->whereMonth('payment_date', now()->month)
                    ->whereYear('payment_date', now()->year)
                    ->sum('total_amount'),
                'previous_month_revenue' => Invoice::where('payment_status', 'paid')
                    ->whereMonth('payment_date', now()->subMonth()->month)
                    ->whereYear('payment_date', now()->subMonth()->year)
                    ->sum('total_amount'),

                // Recent activities from user_actions table
                'recent_activities' => DB::table('user_actions')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get(),

                // Active sessions
                'active_sessions' => DB::table('sessions')->where('last_activity', '>', now()->subMinutes(5)->timestamp)->count(),
            ];

            // Calculate growth percentage
            $stats['revenue_growth'] = $stats['previous_month_revenue'] > 0
                ? (($stats['monthly_revenue'] - $stats['previous_month_revenue']) / $stats['previous_month_revenue']) * 100
                : ($stats['monthly_revenue'] > 0 ? 100 : 0);

            // Chart data for monthly revenue (last 6 months)
            $monthlyRevenueData = Invoice::select(
                    DB::raw('DATE_FORMAT(payment_date, "%Y-%m") as month'),
                    DB::raw('SUM(total_amount) as revenue')
                )
                ->where('payment_status', 'paid')
                ->where('payment_date', '>=', now()->subMonths(6)->startOfMonth())
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $stats['monthly_revenue_chart'] = [
                'labels' => $monthlyRevenueData->pluck('month')->toArray(),
                'data' => $monthlyRevenueData->pluck('revenue')->toArray()
            ];

            // Customer growth chart (last 6 months)
            $customerGrowthData = Customer::select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $stats['customer_growth_chart'] = [
                'labels' => $customerGrowthData->pluck('month')->toArray(),
                'data' => $customerGrowthData->pluck('count')->toArray()
            ];

            // Services distribution
            $servicesData = Service::select('name_ar', DB::raw('COUNT(*) as count'))
                ->groupBy('name_ar')
                ->get();

            $stats['services_distribution'] = [
                'labels' => $servicesData->pluck('name_ar')->toArray(),
                'data' => $servicesData->pluck('count')->toArray()
            ];

            // Invoice status distribution
            $invoiceStatusData = Invoice::select('payment_status', DB::raw('COUNT(*) as count'))
                ->groupBy('payment_status')
                ->get();

            $stats['invoice_status_distribution'] = [
                'labels' => $invoiceStatusData->pluck('payment_status')->toArray(),
                'data' => $invoiceStatusData->pluck('count')->toArray()
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
