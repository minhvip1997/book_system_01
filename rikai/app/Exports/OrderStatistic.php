<?php

namespace App\Exports;

use App\Models\Statistic;
use App\Enums\CartStatus;
use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderStatistic implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            __('message.name'),
            __('message.Email_Address'),
            __('message.Name_of_Card'),
            __('message.Credit_card_number'),
            __('message.total_price'),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Cart::where('status',CartStatus::DONE)->whereYear('updated_at',date('Y'))
        ->whereMonth('updated_at',date('m'))->get();
        $i = 0;
        foreach($orders as $order){
            $data[$i] = array([
                $order->user()->value('name'),
                $order->user()->value('email'),
                $order->name_of_card,
                $order->credit_card_number,
                langTotalCurency($order->total_price),
            ]);
            $i++;
        }
        $data = collect($data);
        return $data;
    }
}
