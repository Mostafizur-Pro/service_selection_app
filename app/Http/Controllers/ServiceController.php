<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceName;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(ServiceName::all());
    }

    public function store(Request $request)
    {
        $service = ServiceName::create($request->all());
        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $service = ServiceName::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = ServiceName::findOrFail($id);
        $service->delete();
        return response()->json('Service deleted successfully');
    }
}
