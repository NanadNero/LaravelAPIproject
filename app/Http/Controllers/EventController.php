<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        try {
            $events = Event::get()->all();
            return response()->json(data: [
                'success' => true,
                'message' => "Berhasil menampilkan semua kegiatan",
                'data' => $events
            ],status: 200);
        } catch (\Exception $e) {
            return response()->json(data: [
                'success' => false,
                'message' => "Gagal menampilkan semua kegiatan",
                'error' => $e->getMessage()
            ],status: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(data: $request->all(),rules: [
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'date|required'
        ]);
        if($validator->fails()){
            return response()->json(data: [
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ],status: 422);

        }
        try {
            $event = Event::create($request->all());
            return response()->json(data: [
                'success' => true,
                'message' => 'Kegiatan berhasil disimpan',
                'data' => $event
            ],status: 201);
        } catch (\Exception $e) {
            return response()->json(data: [
                'success' => false,
                'message' => 'Gagal membuat Kegiatan',
                'error' => $e->getMessage()
            ],status: 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}