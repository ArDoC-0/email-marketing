<?php

namespace Domain\Shared\ViewModels;

use Domain\Shared\Filters\DateFilters;
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


}