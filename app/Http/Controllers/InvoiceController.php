<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $invoices = Invoice::with(['customer', 'items'])
                ->select(['id', 'invoice_number', 'customer_id', 'invoice_date', 'due_date', 'payment_status', 'total_amount', 'created_at']);

            return DataTables::of($invoices)
                ->addColumn('customer_name', function ($invoice) {
                    return $invoice->customer->name ?? '';
                })
                ->addColumn('payment_status_badge', function ($invoice) {
                    $status = $invoice->payment_status;
                    $badgeClass = match($status) {
                        'paid' => 'badge-success',
                        'pending' => 'badge-warning',
                        'overdue' => 'badge-danger',
                        'cancelled' => 'badge-secondary',
                        default => 'badge-secondary'
                    };
                    return '<span class="badge ' . $badgeClass . '">' . trans('invoice.status.' . $status) . '</span>';
                })
                ->addColumn('actions', function ($invoice) {
                    $viewBtn = '<button class="btn btn-sm btn-primary btn-view" title="عرض" data-invoice-id="' . $invoice->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg></button>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger btn-delete" title="حذف" data-invoice-id="' . $invoice->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zm1 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1H14.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/></svg></button>';
                    return  $viewBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['payment_status_badge', 'actions'])
                ->make(true);
        }

        return view('invoices.index');
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('invoices.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'payment_status' => 'required|in:pending,paid,overdue,cancelled',
            'payment_method' => 'nullable|in:cash,bank_transfer,check,credit_card,other',
            'payment_date' => 'nullable|date',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Generate invoice number
            $invoiceNumber = 'INV-' . date('Y') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);

            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'customer_id' => $request->customer_id,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'payment_status' => $request->payment_status,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'tax_amount' => $request->tax_amount ?? 0,
                'discount_amount' => $request->discount_amount ?? 0,
                'notes' => $request->notes,
                'subtotal' => 0,
                'total_amount' => 0,
            ]);

            // Create invoice items
            foreach ($request->items as $item) {
                $totalPrice = $item['quantity'] * $item['unit_price'];

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => $item['service_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $totalPrice,
                ]);
            }

            // Calculate totals
            $invoice->calculateTotals();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $invoice->load(['customer', 'items'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice creation error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء إنشاء الفاتورة'
            ], 500);
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.service']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load(['items.service']);
        $customers = Customer::all();
        $services = Service::all();
        return view('invoices.edit', compact('invoice', 'customers', 'services'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'payment_status' => 'required|in:pending,paid,overdue,cancelled',
            'payment_method' => 'nullable|in:cash,bank_transfer,check,credit_card,other',
            'payment_date' => 'nullable|date',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $invoice->update([
                'customer_id' => $request->customer_id,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'payment_status' => $request->payment_status,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'tax_amount' => $request->tax_amount ?? 0,
                'discount_amount' => $request->discount_amount ?? 0,
                'notes' => $request->notes,
            ]);

            // Delete existing items and create new ones
            $invoice->items()->delete();

            foreach ($request->items as $item) {
                $totalPrice = $item['quantity'] * $item['unit_price'];

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => $item['service_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $totalPrice,
                ]);
            }

            // Calculate totals
            $invoice->calculateTotals();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $invoice->load(['customer', 'items'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice update error: ' . $e->getMessage());

            
            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء تحديث الفاتورة'
            ], 500);
        }
    }

    public function destroy(Invoice $invoice)
    {
        try {
            $invoice->delete();

            return response()->json([
                'success' => true,
                'data' => null
            ]);

        } catch (\Exception $e) {
            Log::error('Invoice deletion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء حذف الفاتورة'
            ], 500);
        }
    }

    public function getServices()
    {
        $services = Service::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->get();
        return response()->json($services);
    }
}
