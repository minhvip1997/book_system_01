<?php

namespace App\Exports;

use App\Models\Statistic;
use App\Enums\CartStatus;
use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class StatisticExport implements FromCollection,WithHeadings, ShouldQueue
{
    use Exportable;

    public function headings(): array
    {
        return [
            __('message.order'),
            __('message.order-done'),
            __('message.total-revenue'),
            __('message.Users'),

        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Statistic::statisticMonth();
        $orders = Cart::where('status',CartStatus::DONE)->whereYear('updated_at',date('Y'))
        ->whereMonth('updated_at',date('m'))->get();
        $data = array([
            $data['orders'],
            $data['ordersdone'],
            $data['total'],
            $data['users'],
        ]);
        $data = collect($data);
        return $data;
    }
}
