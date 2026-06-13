<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiInteraction;
use App\Models\Prescription;
use Illuminate\Support\Facades\Http;

class AiController extends Controller {

    private function callGemini(string $prompt): string
{
    $apiKey = env('GEMINI_API_KEY');

    $response = Http::post(
        'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key='.$apiKey,
        [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ]
        ]
    );

    if ($response->successful()) {
    return $response->json('candidates.0.content.parts.0.text')
        ?? 'No response';
}

dd(
    $response->status(),
    $response->body()
);
}

    private function saveInteraction(string $type, string $input, string $response): void {
        AiInteraction::create([
            'user_id' => auth()->id(),
            'type' => $type,
            'input' => $input,
            'response' => $response,
        ]);
    }

    public function symptomChecker() {
        return view('patient.ai.symptom_checker');
    }

    public function checkSymptoms(Request $request) {
        $request->validate(['symptoms' => 'required|string|min:5|max:500']);

        $prompt = "I am a patient experiencing the following symptoms: {$request->symptoms}. 
        Please provide:
        1. Possible health conditions (list 2-3 most likely)
        2. Recommended medical specialist to consult
        3. General advice (what to do next)
        4. Warning signs to watch for
        Please keep the response clear, simple, and in bullet points. Add disclaimer that this is for informational purposes only.";

       $result = $this->callGemini($prompt);
        $this->saveInteraction('symptom_checker', $request->symptoms, $result);

        return back()->with(['ai_result' => $result, 'user_input' => $request->symptoms]);
    }

    public function chatbot() {
        return view('patient.ai.chatbot');
    }

    public function chat(Request $request) {
        $request->validate(['message' => 'required|string|min:2|max:500']);

        $prompt = "You are a helpful AI health assistant for Smart Health System hospital management platform. 
        Answer the following health-related question in a friendly, clear manner: {$request->message}
        Keep response concise and add a note that serious concerns should be discussed with a real doctor.";

        $result = $this->callGemini($prompt);
        $this->saveInteraction('chatbot', $request->message, $result);

        return response()->json(['response' => $result]);
    }

    public function healthRisk() {
        return view('patient.ai.health_risk');
    }

    public function assessRisk(Request $request) {
        $request->validate([
            'age' => 'required|integer|min:1|max:120',
            'weight' => 'required|numeric|min:10|max:300',
            'blood_pressure' => 'required|string',
            'blood_sugar' => 'required|string',
        ]);

        $prompt = "Please assess the health risk for a patient with the following details:
        Age: {$request->age} years
        Weight: {$request->weight} kg
        Blood Pressure: {$request->blood_pressure} mmHg
        Blood Sugar: {$request->blood_sugar} mg/dL
        
        Provide:
        1. Overall Health Risk Level (Low/Medium/High)
        2. Key risk factors identified
        3. Health recommendations
        4. Which type of doctor to consult
        Keep it clear and simple. Add disclaimer this is informational only.";

        $result = $this->callGemini($prompt);
        $this->saveInteraction('health_risk', json_encode($request->only('age','weight','blood_pressure','blood_sugar')), $result);

        return back()->with(['ai_result' => $result]);
    }

    public function explainPrescription(Request $request, $id) {
        $prescription = Prescription::findOrFail($id);

        $prompt = "Please explain this prescription in simple language for a patient:
        Diagnosis: {$prescription->diagnosis}
        Medicines: {$prescription->medicines}
        Instructions: {$prescription->instructions}
        
        Explain:
        1. What the diagnosis means in simple words
        2. What each medicine does
        3. How to take the medicines
        4. Any important precautions
        Keep it very simple and easy to understand.";

        $result = $this->callGemini($prompt);
        $this->saveInteraction('prescription_explain', "Prescription #{$id}", $result);

        return response()->json(['explanation' => $result]);
    }
}