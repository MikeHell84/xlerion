<x-app-layout>
    <div class="relative py-12" style="background-image: url('{{ asset('images/parallax/contacto-parallax.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6">Contacto</h2>

                    <p class="text-lg text-gray-700 mb-8">
                        ¿Quieres colaborar, invertir o conocer más sobre Xlerion? Estamos listos para conversar.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Contact Form -->
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Formulario de contacto:</h3>
                            <form action="#" method="POST" class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label>
                                    <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                </div>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Enviar Mensaje
                                </button>
                            </form>
                        </div>

                        <!-- Additional Contact Info & Social Media -->
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Datos adicionales:</h3>
                            <div class="mb-6">
                                <h4 class="text-xl font-medium text-gray-700 mb-2">Correos electrónicos:</h4>
                                <ul class="list-disc list-inside text-lg text-gray-600 space-y-1">
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
                            </div>

                            <div class="mb-6">
                                <h4 class="text-xl font-medium text-gray-700 mb-2">WhatsApp:</h4>
                                <a href="https://wa.me/573208605600" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.72.45 3.38 1.3 4.85L2 22l4.47-1.24c1.4.76 2.97 1.16 4.61 1.16 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm3.29 13.28c-.14.24-.83.58-1.19.62-.35.04-.66.2-.96.09-.3-.1-.72-.24-1.37-.47-.65-.23-1.26-.58-1.79-.92-.53-.34-.99-.76-1.32-1.1-.33-.35-.69-.69-.92-1.07-.23-.37-.02-.58.18-.78.18-.18.4-.43.58-.66.18-.23.24-.4.35-.62.1-.23.05-.43-.02-.62-.07-.2-.66-1.58-.9-2.16-.23-.58-.47-.49-.66-.49-.18 0-.4-.05-.62-.05-.23 0-.58.09-.83.35-.24.26-.92.9-.92 2.19 0 1.29.94 2.53 1.07 2.71.14.18 1.84 2.8 4.45 3.91 2.61 1.11 2.61.76 3.08.71.47-.05 1.29-.53 1.47-.92.18-.39.18-.72.13-.83-.05-.11-.19-.18-.4-.28z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>

                            <div>
                                <h4 class="text-xl font-medium text-gray-700 mb-2">Redes:</h4>
                                <ul class="list-disc list-inside text-lg text-gray-600 space-y-1">
                                    <li>LinkedIn: <a href="https://www.linkedin.com/company/xlerion" target="_blank" class="text-indigo-600 hover:text-indigo-800">xlerion</a></li>
                                    <li>Indiegogo: <a href="https://www.indiegogo.com/es/profile/miguel_rodriguez-martinez_edb9?redirect_reason#/overview" target="_blank" class="text-indigo-600 hover:text-indigo-800">Miguel Rodríguez-Martínez</a></li>
                                    <li>Kickstarter: <a href="https://www.kickstarter.com/profile/xlerionstudios" target="_blank" class="text-indigo-600 hover:text-indigo-800">xlerionstudios</a></li>
                                    <li>Patreon: <a href="https://www.kickstarter.com/profile/xlerionstudios" target="_blank" class="text-indigo-600 hover:text-indigo-800">xlerionstudios</a></li>
                                    <li>Instagram: <a href="https://www.instagram.com/ultimatexlerion/" target="_blank" class="text-indigo-600 hover:text-indigo-800">@ultimatexlerion</a></li>
                                    <li>Facebook: <a href="https://www.facebook.com/xlerionultimate" target="_blank" class="text-indigo-600 hover:text-indigo-800">xlerionultimate</a></li>
                                    <li>Behance: <a href="https://www.behance.net/xlerionultimate" target="_blank" class="text-indigo-600 hover:text-indigo-800">xlerionultimate</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
