<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Mail;
use Validator;

class ContactController extends Controller
{
    /**
     * Send contact request email
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required|recaptcha',
            ]
        );

        if ($validator->fails()) {
            return redirect('/#contact')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        Mail::to('patrique.ouimet@gmail.com')->send(
            new ContactMe(
                $request->get('name', ''),
                $request->get('email', ''),
                $request->get('phone', ''),
                $request->get('message', '')
            )
        );

        flash('Thank you! I\'ll be in touch!');

        return redirect('/');
    }
}
