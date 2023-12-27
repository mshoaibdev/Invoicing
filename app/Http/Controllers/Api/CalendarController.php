<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Estimate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getCalendarEvents()
    {

        $services = Service::query()->with([
            'customer',
            'createdBy',
        ])->get();

        $events = [];

        foreach ($services as $service) {
            $events[] = [
                'id' => $service->id,
                'calendar' => 'service', // 'estimate' or 'service
                'title' => $service->title,
                'customer' => optional($service->customer)->name,
                'created_by' => optional($service->createdBy)->name,
                'start' => $service->start_date,
                'end' => $service->end_date,
                'notes' => $service->notes,
                'services' => $service->services,
                'backgroundColor' => '#007bff',
                'borderColor' => '#007bff',
                'textColor' => '#fff'
            ];
        }

        $estimates = Estimate::query()->with([
            'customer',
            'createdBy',
        ])->get();

        foreach ($estimates as $estimate) {
            $events[] = [
                'id' => $estimate->id,
                'calendar' => 'estimate', // 'estimate' or 'service
                'customer' => optional($estimate->customer)->name,
                'title' => $estimate->title,
                'created_by' => optional($estimate->createdBy)->name,
                'start' => $estimate->estimate_date,
                'end' => $estimate->expiry_date,
                'notes' => $estimate->notes,
                'services' => $estimate->items,
                'backgroundColor' => '#28a745',
                'borderColor' => '#28a745',
                'textColor' => '#fff'
            ];
        }


        return response()->json($events);
    }

    // getItemsServices 


}
