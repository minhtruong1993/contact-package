<?php

namespace Mt\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mt\Contact\Models\Contact;
use Mail;
use Session;

class ContactController extends Controller{

    protected $view = 'mt::mail';
    protected $name = 'Visitor';
    protected $subject = 'Visitor Feedback!';

    public function __construct($view = null){
        if($view){
            $this->view = $view;
        }
    }

    public function index(){
        return view('mt::contact');
    }

    public function store(Request $request){
        Contact::create($request->all());

        $this->sendEmail($request->all());

        Session::flash('flash_message', 'Thank you, your mail has been sent successfully.');

        return redirect(route('contact'));
    }

    private function sendEmail($input){
        Mail::send($this->view, array('data' => $input), function($message) use ($input){
	        $message->to($input["email"], $this->name)->subject($this->subject);
	    });

    }
}
