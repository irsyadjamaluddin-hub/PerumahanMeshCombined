@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Thank you for registering to Mesh! A new adventure is waiting for you.  

Brought to you by,  
Muhammad Nur Al-Hafiz bin Haji Hamidi  
i-Ready Project Officer  
Unit Sumber Digital dan Inovasi  
Developer of Mesh System.  

Click below to start working right now
@component('mail::button', ['url' => $link])
Login to MesH
@endcomponent
Sincerely,
MesH Admin.
@endcomponent