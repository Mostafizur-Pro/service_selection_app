<?php

namespace App\Services;

use App\Models\Selected;
use App\Models\Unselected;

class ServiceMatcher
{
    public function findMatch($userId)
    {
        $selectedService = Selected::where('user_id', $userId)->first();
        $unselectedServices = Unselected::where('user_id', $userId)->get();

        foreach ($unselectedServices as $unselectedService) {
            if ($unselectedService->service_id == $selectedService->service_id) {
                return $unselectedService->service;
            }
        }

        return null;
    }
}
