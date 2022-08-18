<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // count invoice
        $invoice = Invoice::all();
        $pending = $invoice->where('status', 'pending')->count();
        $success = $invoice->where('status', 'success')->count();
        $expired = $invoice->where('status', 'expired')->count();
        $failed = $invoice->where('status', 'failed')->count();

        // year and month
        $year = date('Y');

        // chart
        $transactions = DB::table('invoices')
            ->addSelect(DB::raw('SUM(grand_total) as grand_total'))
            ->addSelect(DB::raw('extract(month from "created_at") as month'))
            ->addSelect(DB::raw('extract(monthname from "created_at") as month_name'))
            ->addSelect(DB::raw('extract(year from "created_at") as year'))
            ->whereYear('created_at', '=', $year)
            ->where('status', 'success')
            ->groupBy('invoices.created_at', 'month')
            ->orderByRaw('month ASC')
            ->get();

        if (count($transactions)) {
            foreach ($transactions as $result) {
                $month_name[] = $result->month_name;
                $grand_total[] = (int) $result->grand_total;
            }
        } else {
            $month_name[] = "";
            $grand_total[] = "";
        }

        // response
        return response()->json([
            'success' => true,
            'message' => 'Statistik Data',
            'data' => [
                'count' => [
                    'pending' => $pending,
                    'success' => $success,
                    'expired' => $expired,
                    'failed' => $failed,
                ],
                'chart' => [
                    'month_name' => $month_name,
                    'grand_total' => $grand_total,
                ],
            ],
        ], 200);
    }
}
