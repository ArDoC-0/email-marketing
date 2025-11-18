<?php

namespace Domain\Shared\ViewModels;

use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Filters\DateFilters;
use Domain\Shared\Models\User;
use Domain\Shared\ValueObject\Percent;
use Domain\Subscriber\DataTransferObjects\DailySubscribersData;
use Domain\Subscriber\DataTransferObjects\NewSubscriberCountData;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Support\Facades\DB;

class GetDashboardReportsViewModel extends ViewModel
{

    public function __construct(
        private readonly User $user
    )
    {
        
    }
    public function newSubscribersCount()
    {
        return new NewSubscriberCountData(

            total: Subscriber::count(),

            this_month: Subscriber::whereSubscribeedBetween(
                DateFilters::thisMonth()
            )
            ->count(),

            this_week: Subscriber::whereSubscribeedBetween(
                DateFilters::thisWeek()
            )
            ->count(),

            today: Subscriber::whereSubscribeedBetween(
                DateFilters::today()
            )
            ->count(),
        );
    }

    public function performance()
    {

        $total = SentMail::count();

        return new PerformanceData(
            total : $total,
            click_rate: self::averageClickRate($total),
            open_rate: self::averageOpenRate($total)
        );
    }

    public static function averageOpenRate(int $total)
    {
        $opened = SentMail::whereOpened()->count();

        return Percent::from(
            $opened, 
            $total
        );
    }

    public static function averageClickRate(int $total)
    {
        $clicked = SentMail::whereClicked()->count();

        return Percent::from(
            $clicked, 
            $total
        );
    }

    public function dailySubscribers()
    {
        return DB::table('subscribers')
        ->select(
            Db::raw("count(*) count, date_format(subscribed_at, '%Y-%m-%d') day")
        )
        ->groupBy('day')
        ->orderByDesc('day')
        ->where('user_id', $this->user->id)
        ->get()
        ->map(fn(Object $data) => DailySubscribersData::from((array) $data));
    }

    public function recentSubscribers()
    {
        return Subscriber::with(['tags', 'form'])
        ->orderByDesc('subscribed_at')
        ->take(10)
        ->get()
        ->map
        ->getData();
    }
    
}