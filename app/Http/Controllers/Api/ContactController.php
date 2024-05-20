<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ], [
            'email.required' => 'La mail è obbligatoria',
            'email.email' => 'La mail non è valida',
            'subject.required' => 'L\'oggetto della mail è obbligatorio',
            'message.required' => 'Il contenuto della mail è obbligatoria',
        ]);

        if($validator->fails()){
            $errors = [];
            foreach($validator->errors()->messages() as $field => $messages){
                $errors[$field] = $messages[0];
            }

            return response()->json(compact('errors'), 422);
        }

        $mail = new ContactMessageMail(
            sender: $data['email'], 
            subject: $data['subject'], 
            content: $data['message']);

        Mail::to('andrea.scaranari.93@gmail.com')->send($mail);

        return response(null, 204)->json($mail);
    }
}
