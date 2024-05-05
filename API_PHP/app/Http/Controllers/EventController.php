<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class EventController extends Controller
{
    public function index(){
        try{
            $events = Event::all();
            return response()->json($events);
        }catch(Exception $e){
            return response()->json(['error'=> 'Server error'], 500);
        }
       
    }

   
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'data' => 'required|date',
            'location' => 'required|string|max:255',
            'organizador' => 'required|exists:users,id',
            'capacity' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $event = Event::create($request->all());
            return response()->json($event, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

 
    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event);
        } catch (Exception $e) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

   
    public function update(Request $request, $id){
        try {
            $event = Event::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'string|max:255',
                'description' => 'string',
                'data' => 'date',
                'location' => 'string|max:255',
                'organizador' => 'exists:users,id',
                'capacity' => 'integer',
                'price' => 'numeric'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $event->update($request->all());
            return response()->json($event);
        } catch (Exception $e) {
            return response()->json(['error' => 'Event not found or update failed'], 404);
        }
    }


    public function destroy($id){
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Event not found or delete failed'], 404);
        }
    }
}