<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

class ShowContactPage extends Component
{

    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email'
    ];

    public function submit() {
        $this-> validate();

        $mailData = [
            'subject' => 'You have received a contact email',
            'name' => $this-> name,
            'email' => $this-> email,
            'message' => $this-> message,
            
        ];

        Mail::to('nofileexistshere@gmail.com')-> send(new ContactEmail($mailData));

        session()->flash('success', 'Thanks for contacting us, we will get back to you soon.');
        $this->redirect('/contact');
    }

    public function render()
    {
        return view('livewire.show-contact-page');
    }
}
