<div x-data="{ open: false }" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">

    <!-- Floating Button -->
    <button @click="open = !open"
        style="background-color: #25d366; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none;">
        <img
            src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
            alt="Chat via WhatsApp"
            style="width: 30px; height: 30px;"
        />
    </button>

    <!-- Chatbox -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        style="margin-top: 10px; background: white; border-radius: 8px; padding: 16px; width: 250px; box-shadow: 0 10px 15px rgba(0,0,0,0.1); position: absolute; bottom: 70px; right: 0;"
        x-cloak
    >
        <strong style="color: #075e54;">Butuh pertanyaan lebih lanjut?</strong>
        <p style="font-size: 14px; color: #444; margin-top: 8px;">Klik tombol di bawah untuk chat dengan team kami via WhatsApp.</p>
        <a
            href="https://wa.me/{{ config('services.whatsapp.number') }}?text=Halo%2C%20saya%20ingin%20bertanya%20lebih%20lanjut"
            target="_blank"
            rel="noopener"
            style="margin-top: 12px; display: inline-block; background: #25d366; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; font-size: 14px;"
        >Mulai Chat</a>
    </div>
</div>