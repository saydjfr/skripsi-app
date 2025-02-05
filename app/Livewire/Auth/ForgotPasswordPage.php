<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Forgot Password')]
class ForgotPasswordPage extends Component
{

    public $email;

    public function forgotPassword(){
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);
        // dd($status, Password::sendResetLink(['email' => $this->email]));
        if($status === Password::RESET_LINK_SENT){
            // dd($status);
            session()->flash('success', 'Password reset has been sent to your email.');
            $this->email='';
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
