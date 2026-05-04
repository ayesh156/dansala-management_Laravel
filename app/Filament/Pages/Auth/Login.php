<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected static string $view = 'filament.login';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('විද්‍යුත් තැපෑල')
                    ->email()
                    ->required()
                    ->autocomplete('off')
                    ->placeholder('ඔබගේ email ලිපිනය')
                    ->extraInputAttributes(['autocomplete' => 'off']),

                TextInput::make('password')
                    ->label('මුරපදය')
                    ->password()
                    ->required()
                    ->autocomplete('new-password')
                    ->placeholder('ඔබගේ මුරපදය')
                    ->extraInputAttributes(['autocomplete' => 'new-password']),
            ]);
    }
}
