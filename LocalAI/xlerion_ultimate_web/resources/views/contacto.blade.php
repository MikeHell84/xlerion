@extends('layouts.app')

@section('content')
    {{-- Banner for Contacto --}}
    @include('partials.contact-banner')

    {{-- Palette variables local to this page (from contenido.txt) --}}
    <style>
        :root {
            --xlerion-accent: #00eeff; /* Azul brillante tecnológico */
            --xlerion-deep: #004080;   /* Azul profundo */
            --xlerion-black: #121212;  /* Negro carbón */
            --xlerion-gray-dark: #2C2C2C;
            --xlerion-cyan: #43ffff;   /* Toque de cian brillante */
        }
        /* small helper classes */
        .btn-xlerion { background: linear-gradient(90deg,var(--xlerion-accent),var(--xlerion-cyan)); color: #041024; font-weight:700 }
        .btn-xlerion-ghost { border:1px solid rgba(67,255,255,0.12); color:var(--xlerion-accent); background:transparent }
    </style>

    {{-- Flash success message --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="p-4 rounded-lg bg-green-600 text-white">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Hero Section with Parallax Video --}}
    <div class="relative overflow-hidden video-parallax-container">
        <!-- Video de fondo -->
        <video class="parallax-video filter-subtle" autoplay loop muted playsinline>
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            Tu navegador no soporta el video.
        </video>

        <!-- Capa oscura sobre el video -->
        <div class="absolute inset-0 bg-black/50 z-0"></div>

        <!-- Contenido principal del Hero -->
        <div class="relative z-1 flex flex-col items-center justify-center h-full text-center px-4">
            <img src="{{ asset('img/Contacto.svg') }}" alt="Contacto" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Contacto: row with text and image like other sections --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <div class="flex flex-col md:flex-row items-center gap-12 p-8 bg-gray-800/50 rounded-lg border border-gray-700 content-container">
                <div class="md:w-2/3">
                    <h2 class="text-4xl font-bold mb-4 text-teal-400 uppercase font-heading">📩 Contacto</h2>
                    <p class="text-gray-300 text-lg leading-relaxed">¿Deseas colaborar, invertir o conocer más sobre Xlerion? Estamos abiertos al diálogo y la co-creación.</p>
                </div>
                <div class="md:w-1/3">
                    <img src="{{ asset('images/parallax/contacto-parallax.jpg') }}" alt="Contacto" class="rounded-lg shadow-xl border border-gray-600 w-full h-auto">
                </div>
            </div>
        </section>

        {{-- Cotizar servicio (debe quedar encima del campo de contacto) --}}
        <section id="cotizar-servicio" class="mb-10">
            <div class="content-container p-6 rounded-lg shadow-lg border border-gray-700">
                <h3 class="text-2xl font-semibold mb-4 text-white">Solicitar Cotización</h3>
                @include('quotation.form')
            </div>
        </section>

        {{-- Campo de contacto (formulario) --}}
        <section class="mb-12">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 content-container p-8 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-2xl font-semibold mb-4 text-white">Formulario de contacto</h3>
                    <p class="text-gray-400 mb-4">Envía tu consulta usando el formulario. Campos: Nombre, Correo electrónico y Mensaje.</p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input name="name" type="text" placeholder="Nombre" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
                            <input name="email" type="email" placeholder="Correo electrónico" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
                        </div>
                        <textarea name="message" placeholder="Mensaje" rows="5" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white"></textarea>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="py-3 px-6 rounded-lg btn-xlerion">Enviar Mensaje</button>
                            <a href="https://wa.me/573208605600" target="_blank" class="text-sm text-gray-300 btn-xlerion-ghost py-2 px-3 rounded">Enviar por WhatsApp</a>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-700">
                        <h4 class="mt-6 text-lg font-semibold text-white">Acerca del Creador</h4>
                        <p class="text-gray-300">Miguel Eduardo Rodríguez Martínez es un desarrollador autodidacta con enfoque neurodivergente, especializado en videojuegos, software inteligente y soluciones web. Desde Nocaima, Cundinamarca, ha impulsado proyectos que integran técnica y narrativa.</p>

                        <h4 class="mt-6 text-lg font-semibold text-white">Convocatorias y alianzas</h4>
                        <ul class="text-gray-300 list-disc list-inside">
                            <li>Postulación a CoCrea 2025 (modalidad PAT)</li>
                            <li>Participación en Hackathon IA COL4.0</li>
                            <li>Invitación abierta a inversionistas culturales</li>
                        </ul>
                    </div>
                </div>

                <aside class="lg:col-span-1 content-container p-8 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-2xl font-semibold mb-4 text-white">Correos institucionales</h3>
                    <ul class="list-disc list-inside text-gray-300 space-y-1">
                        <li>contactus@xlerion.com</li>
                        <li>totaldarkness@xlerion.com</li>
                        <li>support@xlerion.com</li>
                        <li>sales@xlerion.com</li>
                        <li>admin@xlerion.com</li>
                        <li>branding@xlerion.com</li>
                        <li>toolkit@xlerion.com</li>
                        <li>neuro@xlerion.com</li>
                        <li>mike@xlerion.com</li>
                    </ul>

                    <h4 class="mt-6 text-lg font-semibold text-white">WhatsApp</h4>
                    <p class="text-gray-300"><a href="https://wa.me/573208605600" target="_blank" class="text-teal-300 hover:underline">+57 320 860 5600 — Botón directo</a></p>

                    <h4 class="mt-6 text-lg font-semibold text-white">Redes</h4>
                    <ul class="mt-2 text-gray-300 list-none space-y-1">
                        <li>LinkedIn: <a href="https://www.linkedin.com/company/xlerion" target="_blank" class="text-teal-300 hover:underline">https://www.linkedin.com/company/xlerion</a></li>
                        <li>Indiegogo: <a href="https://www.indiegogo.com/es/profile/miguel_rodriguez-martinez_edb9?redirect_reason#/overview" target="_blank" class="text-teal-300 hover:underline">Indiegogo</a></li>
                        <li>Kickstarter: <a href="https://www.kickstarter.com/profile/xlerionstudios" target="_blank" class="text-teal-300 hover:underline">Kickstarter</a></li>
                        <li>Patreon: <a href="https://www.patreon.com/xlerionstudios" target="_blank" class="text-teal-300 hover:underline">https://www.patreon.com/xlerionstudios</a></li>
                        <li>Instagram: <a href="https://www.instagram.com/ultimatexlerion/" target="_blank" class="text-teal-300 hover:underline">https://www.instagram.com/ultimatexlerion/</a></li>
                        <li>Facebook: <a href="https://www.facebook.com/xlerionultimate" target="_blank" class="text-teal-300 hover:underline">https://www.facebook.com/xlerionultimate</a></li>
                        <li>Behance: <a href="https://www.behance.net/xlerionultimate" target="_blank" class="text-teal-300 hover:underline">https://www.behance.net/xlerionultimate</a></li>
                    </ul>
                </aside>
            </div>
        </section>
    </div>

{{-- legacy script removed - quotation form includes its own scripts --}}
@endsection