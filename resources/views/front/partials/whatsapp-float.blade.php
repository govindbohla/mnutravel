@php
    $waNumber = preg_replace('/[^0-9]/', '', $siteSettings['whatsapp_number']);
    $waText = rawurlencode('Hello MNU Travels, I want to book a cab.');
@endphp

<a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>
