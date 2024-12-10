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
        $this->validate();

        // Data for the email to be sent to admin
        $mailDataToAdmin = [
            'subject' => 'You have received a contact email',
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];

        // Send email to the admin
        Mail::to('nofileexistshere@gmail.com')->send(new ContactEmail($mailDataToAdmin));

        // Data for the email to be sent to the client (user who submitted the form)
        $mailDataToClient = [
            'subject' => 'Thanks for contacting us',
            'name' => $this->name,
            'email' => $this->email,
            'message' => 'We have received your message and will get back to you soon.',
        ];

        // Send feedback email to the client
        Mail::to($this->email)->send(new ContactEmail($mailDataToClient));

        // Flash success message
        session()->flash('success', 'Thanks for contacting us, we will get back to you soon.');

        // Redirect back to the contact page
        $this->redirect('/contact');
    }

    public function render()
    {
        return view('livewire.show-contact-page');
    }
}
