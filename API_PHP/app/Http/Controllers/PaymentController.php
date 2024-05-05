<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Certifique-se de que você tem um modelo Payment
use Illuminate\Support\Facades\Validator;
use Exception;

class PaymentController extends Controller
{
    // Método para listar todos os pagamentos
    public function index(){
        try {
            $payments = Payment::all();
            return response()->json($payments);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // Método para registrar um novo pagamento
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'payment_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $payment = Payment::create([
                'value' => $request->value,
                'payment_method' => $request->payment_method,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);
            return response()->json($payment, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // Método para buscar um pagamento por ID
    public function show($id){
        try {
            $payment = Payment::findOrFail($id);
            return response()->json($payment);
        } catch (Exception $e) {
            return response()->json(['error' => 'Payment not found'], 404);
        }
    }

    // Método para atualizar um pagamento
    public function update(Request $request, $id){
        try {
            $payment = Payment::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'value' => 'numeric',
                'payment_method' => 'string|max:255',
                'status' => 'string|max:255',
                'payment_date' => 'date'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $payment->update($request->all());
            return response()->json($payment);
        } catch (Exception $e) {
            return response()->json(['error' => 'Payment not found or update failed'], 404);
        }
    }

    // Método para deletar um pagamento
    public function destroy($id){
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();
            return response()->json(['message' => 'Payment deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Payment not found or delete failed'], 404);
        }
    }
}
