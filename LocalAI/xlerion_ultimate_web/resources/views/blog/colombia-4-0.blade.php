@extends('layouts.app')

@section('content')
    {{-- Hero Section with Post Title and Banner Image --}}
    <div class="relative overflow-hidden video-parallax-container" style="background-image: url('{{ asset('images/parallax/convocatorias-alianzas-parallax.jpg') }}'); background-size: cover; background-position: center;">
        <!-- Capa oscura sobre la imagen -->
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        <!-- Contenido principal del Hero -->
        <div class="relative z-1 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white uppercase font-heading">Participación en Colombia 4.0</h1>
        </div>
    </div>

    {{-- Main Content for the Blog Post --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <article class="prose prose-invert lg:prose-xl mx-auto">
            <p class="text-left leading-relaxed">
                Relato de la experiencia y aprendizajes obtenidos durante la participación en este evento clave para la innovación tecnológica y cultural en Colombia.
            </p>
            
            {{-- Placeholder for more content --}}
            <p class="text-left leading-relaxed mt-4">
                (Aquí iría el resto del contenido del artículo del blog, con más párrafos, imágenes y detalles sobre la participación en Colombia 4.0).
            </p>

            <figure class="mt-8">
                <img src="{{ asset('images/parallax/noticias-eventos-parallax.jpg') }}" alt="Evento Colombia 4.0" class="rounded-lg shadow-xl border border-gray-700">
                <figcaption class="text-center text-sm text-gray-500 mt-2">Momentos destacados de la participación de Xlerion en Colombia 4.0.</figcaption>
            </figure>

        </article>

        <div class="mt-12 text-center">
            <a href="{{ url('/blog') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver al Blog
            </a>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .prose-invert {
        color: #d1d5db; /* text-gray-300 */
    }
    .prose-invert h1, .prose-invert h2, .prose-invert h3, .prose-invert h4, .prose-invert strong {
        color: #ffffff;
    }
    .prose-invert a {
        color: #2dd4bf; /* text-teal-400 */
    }
    .prose-invert a:hover {
        color: #14b8a6; /* text-teal-500 */
    }
    .prose-invert blockquote {
        border-left-color: #2dd4bf; /* border-teal-400 */
        color: #d1d5db;
    }
</style>
@endpush
