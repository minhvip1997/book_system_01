<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Statistic;
use App\Enums\CartStatus;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatisticExport;
use App\Exports\OrderStatistic;
use App\Exports\ReportMonth;
use App\Jobs\ExportExcel;



class ChartController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders= Cart::countOrders();
        $data = Statistic::statisticAll();
        $ordersdone = Cart::countOrdersDone();
        return view('admin.chart.index',compact(['orders', 'data','ordersdone']));
    }

    public function export() 
    {
        return Excel::download(new StatisticExport, 'statistic-'.date('d-m-Y').'.xlsx');

    }

    public function exportorder() 
    {
        return Excel::download(new OrderStatistic, 'order-statistic-'.date('d-m-Y').'.xlsx');
    }
}
