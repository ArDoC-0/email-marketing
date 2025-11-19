<?php

namespace Domain\Automation\Actions;

use Domain\Automation\DataTransferObjects\AutomationData;
use Domain\Automation\DataTransferObjects\AutomationStepData;
use Domain\Automation\Enums\AutomationStepType;
use Domain\Automation\Models\Automation;
use Domain\Automation\Models\AutomationStep;
use Domain\Shared\Models\User;
use Illuminate\Support\Facades\DB;

class UpsertAutomationActions
{
    public static function execute(
        AutomationData $data,
        User $user
    )
    {
        return DB::transaction(function () use ($data,$user){
            $automation = self::upsertAutomation($data, $user);

            self::upsertEvent($automation, $data);

            self::upsertActions($automation, $data);

            return $automation->load('steps');
        
        });
    }

    private static function upsertAutomation(AutomationData $data, User $user) : Automation
    {
        return Automation::updateOrCreate(
            [
                'id'=> $data->id
            ],
            [
                ...$data->toArray(),
                'user_id' => $user->id 
            ]
            );
    }

    private static function upsertEvent(Automation $automation, AutomationData $data)
    {
        $automation->steps()->updateOrCreate([
            [
                'id' => $data->event->id
            ],
            [
                'type' => AutomationStepType::Event,
                'name' => $data->event->name,
                'value' => ['id' => $data->event->value]
            ]
        ]);
    }

    private static function upsertActions(Automation $automation, AutomationData $data)
    {
        $data->actions->toCollection()->each(fn (AutomationStepData $stepData) => 
        $automation->steps()->updateOrCreate([
            [
                'id' => $data->event->id
            ],
            [
                'type' => AutomationStepType::Action,
                'name' => $stepData->name,
                'value' => ['id' => $stepData->value]
            ]
        ])
        );
    }
}