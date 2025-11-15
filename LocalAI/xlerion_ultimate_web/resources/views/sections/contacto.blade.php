<section class="banner-section">
    <div class="parallax-background rellax" data-rellax-speed="-7">
        <img src="{{ asset('images/parallax/contacto-parallax.jpg') }}" alt="Fondo Parallax Contacto" class="parallax-image">
    </div>
    <div class="banner-content">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Contacto</h1>
    </div>
</section>

<section>
    <h2 class="text-4xl font-bold text-center mb-6 text-teal-400">🤝 Contáctanos</h2>
    <p class="text-center mb-10 text-gray-400 max-w-xl mx-auto">
        ¿Quieres colaborar, invertir o conocer más sobre Xlerion? Estamos listos para conversar.
    </p>

    <div class="grid lg:grid-cols-3 gap-8">
        
        {{-- Columna 1: Formulario --}}
        <div class="lg:col-span-2 bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
            <h3 class="text-2xl font-semibold mb-6">Envíanos un mensaje</h3>
            <form action="#" method="POST" class="space-y-4">
                {{-- Esto sería un placeholder. En Laravel, usarías @csrf --}}
                <input type="text" placeholder="Nombre" class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-teal-400 focus:border-teal-400 text-white">
                <input type="email" placeholder="Correo electrónico" class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-teal-400 focus:border-teal-400 text-white">
                <textarea placeholder="Mensaje" rows="4" class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-teal-400 focus:border-teal-400 text-white"></textarea>
                <button type="submit" class="w-full py-3 bg-teal-500 hover:bg-teal-600 rounded-lg font-semibold text-gray-900 transition duration-200">
                    Enviar Mensaje
                </button>
            </form>
        </div>

        {{-- Columna 2: Datos y Redes --}}
        <div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
            <h3 class="text-2xl font-semibold mb-6">Conexiones Directas</h3>
            
            {{-- WhatsApp --}}
            <a href="https://wa.me/573208605600" target="_blank" class="flex items-center space-x-3 p-3 bg-green-600 rounded-lg hover:bg-green-700 mb-4 transition duration-200">
                <span class="text-xl">📞</span>
                <span class="font-bold">+57 320 8605600</span>
            </a>

            {{-- Emails --}}
            <div class="space-y-2 mb-6">
                <p class="text-teal-400 font-semibold mt-4">Correos Especializados:</p>
                <p class="text-sm text-gray-400">contactus@xlerion.com</p>
                <p class="text-sm text-gray-400">toolkit@xlerion.com</p>
                <p class="text-sm text-gray-400">support@xlerion.com</p>
                {{-- Se pueden añadir los demás emails aquí --}}
            </div>

            {{-- Redes Sociales --}}
            <div class="mt-6">
                <p class="text-teal-400 font-semibold mb-3">Redes Sociales:</p>
                <div class="flex flex-wrap gap-3">
                    <a href="https://www.linkedin.com/company/xlerion" target="_blank" class="text-white hover:text-teal-400 text-2xl transition duration-200" title="LinkedIn">in</a>
                    <a href="https://www.instagram.com/ultimatexlerion/" target="_blank" class="text-white hover:text-teal-400 text-2xl transition duration-200" title="Instagram">ig</a>
                    {{-- Y los demás enlaces (Facebook, Behance, etc.) --}}
                </div>
            </div>
        </div>
    </div>
</section>