<x-mail::message>
# Bonjour {{ $user->name }}

Vous recevez cet email car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.<br /><br />
Ce code de réinitialisation de mot de passe expirera dans {{ config('auth.passwords.users.expire') }} minutes.
Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.

<x-mail::button :url="route('password.reset', ['token' => $token, 'email' => $user->email])">
Réinitialiser mon mot de passe
</x-mail::button>


Si vous ne parvenez pas à cliquer sur le bouton, copiez et collez l’URL suivant dans votre navigateur Web : <br/>
[{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}]({{ route('password.reset', ['token' => $token, 'email' => $user->email]) }})

</x-mail::message>
