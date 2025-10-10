<x-mail::message>
# 📩 Nouveau message reçu depuis la plateforme **{{ config('app.name') }}**

<x-mail::panel>
**Nom :** {{ $data['full_name'] }}  
**Email :** {{ $data['email'] }}  
@if (isset($data['phone']))
**Téléphone :** {{ $data['phone'] }}  
@endif
**Sujet :** {{ $data['subject'] }}
</x-mail::panel>

{{ $data['message'] }}

---

Ce message a été envoyé via le formulaire de contact de la plateforme **{{ config('app.name') }}**.  
Vous pouvez répondre directement à cet email pour contacter l'expéditeur.
</x-mail::message>
