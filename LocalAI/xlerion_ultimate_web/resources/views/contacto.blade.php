@extends('layouts.app')

@section('content')
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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Contacto</h1>
        </div>
    </div>

    {{-- Main Content for Contacto --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">📩 Contacto</h2>
            <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                ¿Deseas colaborar, invertir o conocer más sobre Xlerion? Estamos abiertos al diálogo y la co-creación.
            </p>

            <div class="grid lg:grid-cols-3 gap-8">
                
                {{-- Columna 1: Formulario --}}
                <div class="lg:col-span-2 bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-2xl font-semibold mb-6 text-white">Envíanos un mensaje</h3>
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

                {{-- Columna 2: Datos de Contacto --}}
                <div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
                    <h3 class="text-2xl font-semibold mb-6 text-white">Conexiones Directas</h3>
                    
                    <ul class="space-y-3">
                        <li>
                            <a href="mailto:contactus@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>contactus@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:totaldarkness@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>totaldarkness@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:support@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>support@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:sales@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>sales@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:admin@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>admin@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:branding@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>branding@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:toolkit@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>toolkit@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:neuro@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>neuro@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:mike@xlerion.com" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-solid fa-envelope w-6 text-center mr-3"></i>
                                <span>mike@xlerion.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/573208605600" target="_blank" class="flex items-center text-gray-300 hover:text-teal-400 transition duration-200">
                                <i class="fa-brands fa-whatsapp w-6 text-center mr-3"></i>
                                <span>+57 320 860 5600</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection