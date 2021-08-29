<?php

namespace App\Library\Services;

use App\Library\Services\Contracts\TagServiceInterface;
use App\Models\Tag;
use App\Enums\CartStatus;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\DB;
use stdClass;
use Carbon\Carbon;
use App\Enums\Time;

class TagService implements TagServiceInterface
{
    public function getTag($date)
    {
        $now = Carbon::now();
        if($date == Time::Week){
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            $data = Tag::whereBetween('updated_at',[$weekStartDate,$weekEndDate])
            ->orderby('count','desc')
            ->paginate(10);
        }else{
            $now = Carbon::now();
            $firstDay = $now->firstOfMonth()->format('Y-m-d H:i');
            $lastday =  $now->endOfMonth()->format('Y-m-d H:i');
            $data = Tag::whereBetween('updated_at',[$firstDay,$lastday])->orderby('count','desc')
            ->paginate(10);
        }
        return $data;
    }

}
