<x-mail::message>
# Bonjour {{ $user->name }}

Bienvenue sur **{{ config('app.name') }}** 🎉<br /><br />
Votre compte a été créé avec succès !  
Vous pouvez dès maintenant vous connecter avec votre adresse e-mail :

<x-mail::panel>
## Adresse e-mail : {{ $user->email }}
</x-mail::panel>

<x-mail::button :url="route('login')">
Se connecter
</x-mail::button>

Si vous ne parvenez pas à cliquer sur le bouton, copiez et collez l’URL suivante dans votre navigateur Web :  
[{{ route('login') }}]({{ route('login') }})
</x-mail::message>
