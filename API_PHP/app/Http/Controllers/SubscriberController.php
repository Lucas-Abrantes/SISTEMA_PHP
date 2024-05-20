<?php

namespace App\Http\Controllers;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubscriberController extends Controller{
   
    public function index(){
        try{
            $subscribers = Subscriber::with('event' )->get();
            return response()->json($subscribers);
        }catch(Exception $e){
            return response()->json(['error'=> 'Server error'], 500);
        }
       
    }

 
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            $subscriber = Subscriber::create($request->all() + ['subscribe_data' => now()]);
            return response()->json($subscriber, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }


    public function show($id){
        try {
            $subscriber = Subscriber::with('event')->findOrFail($id);
            return response()->json($subscriber);
        } catch (Exception $e) {
            return response()->json(['error' => 'Subscriber not found'], 404);
        }
    }

  
    public function update(Request $request, $id){
        try {
            $subscriber = Subscriber::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'event_id' => 'exists:events,id',
                'status' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $subscriber->update($request->all());
            return response()->json($subscriber);
        } catch (Exception $e) {
            return response()->json(['error' => 'Subscriber not found or update failed'], 404);
        }
    }

   
    public function destroy($id){
        try {
            $subscriber = Subscriber::findOrFail($id);
            $subscriber->delete();
            return response()->json(['message' => 'Subscriber deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Subscriber not found or delete failed'], 404);
        }
    }
}