<?php

namespace Domain\Shared\ViewModels;

use Domain\Mail\DataTransferObjects\PerformanceData;
use Domain\Mail\Models\SentMail;
use Domain\Shared\Filters\DateFilters;
use Domain\Shared\ValueObject\Percent;
use Domain\Subscriber\DataTransferObjects\NewSubscriberCountData;
use Domain\Subscriber\Models\Subscriber;

class GetDashboardReportsViewModel extends ViewModel
{

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
}