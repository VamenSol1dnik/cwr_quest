<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Models\Patient;

class MessageController extends Controller
{
    public function index(Request $request) {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 15);

        $messages = Message::orderBy('created_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function store(Request $request) {
        $message = new Message();
        $message->user_id = auth()->id();
        $message->patient_id = $patientId = $request->input('patient_id');
        $message->number_from = $request->phone_number;
        $message->number_to = '+380123456789'; 
        $message->message_text = $request->message;
        $message->save();

        return response()->json($message);
    }

    public function getPatientPhoneNumbers() {
        $patient = Patient::find(1);  // Отримати потрібного пацієнта
        $numbers = [
            $patient->cell_phone,
            $patient->home_phone,
            $patient->work_phone
        ];

        return response()->json($numbers);
    }
}
?>