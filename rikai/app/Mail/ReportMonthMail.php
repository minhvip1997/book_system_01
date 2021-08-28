<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportMonth;
use App\Exports\StatisticExport;
use App\Exports\OrderStatistic;

class ReportMonthMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        $date = date('m-Y');
        Excel::store(new StatisticExport,'public/report-statistic-month-'.$date.'.xlsx');
        Excel::store(new OrderStatistic,'public/report-order-month-'.$date.'.xlsx');
        $pathstatistic = storage_path('app\public\report-statistic-month-'.$date.'.xlsx');
        $pathorder = storage_path('app\public\report-order-month-'.$date.'.xlsx');
        return $this->view('admin.email.report',['date'=> $date])
        ->subject(__('message.report-month, :date', ['date' => $date]))
        ->attach($pathstatistic)
        ->attach($pathorder);
    }
}
