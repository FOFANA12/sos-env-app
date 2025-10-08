@extends('layouts.app')
@section('title', __('app/contact.page_title'))

@section('content')
    @if (session('success'))
        <x-toast type="success" :message="session('success')" :duration="15000" position="top-20 right-5" />
    @endif
    @if (session('error'))
        <x-toast type="danger" :message="session('error')" :duration="15000" position="top-20 right-5" />
    @endif

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-white via-green-50 to-emerald-100">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, rgba(34, 197, 94, 0.3) 1px, transparent 0); background-size: 20px 20px;">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-gray-900">
                {{ __('app/contact.hero_title') }}
            </h1>
            <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-gray-700 leading-relaxed">
                {{ __('app/contact.hero_subtitle') }}
            </p>
        </div>
    </section>

    <!-- Google Maps Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full h-96 md:h-[600px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3792.2831296874156!2d-15.988041423903628!3d18.104711881743086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe964d69c437f815%3A0x7ae01b1d2a087f57!2sStade%20olympique%20de%20Nouakchott!5e0!3m2!1sfr!2s!4v1759882103000!5m2!1sfr!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-full h-full">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="pb-16  bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Left Column - Contact Info -->
                <div class="space-y-4">

                    <div class="bg-white p-4 rounded-xl shadow-sm transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-600/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('app/contact.email_title') }}
                                </h3>
                                <a href="mailto:contact@sos-environnement.mr"
                                    class="text-sm text-gray-600 hover:text-primary-600 transition-colors">
                                    contact@sos-environnement.mr
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-sm transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-600/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('app/contact.phone_title') }}
                                </h3>
                                <a href="tel:+22244249645"
                                    class="text-sm text-gray-600 hover:text-green-600 transition-colors">
                                    (+222) 44 24 96 45
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="bg-white p-4 rounded-xl shadow-sm transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-purple-600/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('app/contact.address_title') }}
                                </h3>
                                <p class="text-sm text-gray-600 leading-snug">
                                    Tevragh Zeina, Nouakchott<br>
                                    Mauritanie
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Réseaux sociaux -->
                    <div class="bg-white p-6 rounded-xl shadow-sm transition-all duration-300">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">{{ __('app/contact.follow_us') }}
                        </h3>
                        <div class="flex justify-center space-x-4">
                            <!-- Facebook -->
                            <a href="#" class="group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </div>
                            </a>

                            <!-- Instagram -->
                            <a href="#" class="group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12.017 0C8.396 0 7.989.013 7.041.048 6.094.082 5.52.204 5.012.388a6.678 6.678 0 0 0-2.414 1.57A6.678 6.678 0 0 0 1.027 4.37C.843 4.878.72 5.452.687 6.399.652 7.347.64 7.753.64 11.374c0 3.62.012 4.027.047 4.974.033.947.156 1.521.34 2.029a6.678 6.678 0 0 0 1.571 2.414 6.678 6.678 0 0 0 2.414 1.57c.508.185 1.082.307 2.029.341.947.035 1.354.047 4.975.047 3.62 0 4.027-.012 4.974-.047.947-.034 1.521-.156 2.029-.341a6.678 6.678 0 0 0 2.414-1.57 6.678 6.678 0 0 0 1.57-2.414c.185-.508.307-1.082.341-2.029.035-.947.047-1.354.047-4.975 0-3.62-.012-4.027-.047-4.974-.034-.947-.156-1.521-.341-2.029a6.678 6.678 0 0 0-1.57-2.414A6.678 6.678 0 0 0 19.028.388C18.52.204 17.946.082 16.999.048 16.051.013 15.645.001 12.017.001zM12.017 2.163c3.557 0 3.98.013 5.385.066.946.043 1.46.2 1.803.331.453.176.776.387 1.115.726.339.339.55.662.726 1.115.131.343.288.857.331 1.803.053 1.404.066 1.828.066 5.385 0 3.557-.013 3.98-.066 5.385-.043.946-.2 1.46-.331 1.803a2.999 2.999 0 0 1-.726 1.115 2.999 2.999 0 0 1-1.115.726c-.343.131-.857.288-1.803.331-1.404.053-1.828.066-5.385.066-3.557 0-3.98-.013-5.385-.066-.946-.043-1.46-.2-1.803-.331a2.999 2.999 0 0 1-1.115-.726 2.999 2.999 0 0 1-.726-1.115c-.131-.343-.288-.857-.331-1.803-.053-1.404-.066-1.828-.066-5.385 0-3.557.013-3.98.066-5.385.043-.946.2-1.46.331-1.803.176-.453.387-.776.726-1.115.339-.339.662-.55 1.115-.726.343-.131.857-.288 1.803-.331 1.404-.053 1.828-.066 5.385-.066z" />
                                        <path
                                            d="M12.017 15.33a3.33 3.33 0 1 1 0-6.66 3.33 3.33 0 0 1 0 6.66zM12.017 7.507a4.823 4.823 0 1 0 0 9.646 4.823 4.823 0 0 0 0-9.646zM18.846 7.142a1.134 1.134 0 1 1-2.269 0 1.134 1.134 0 0 1 2.269 0z" />
                                    </svg>
                                </div>
                            </a>

                            <!-- LinkedIn -->
                            <a href="#" class="group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </div>
                            </a>

                            <!-- TikTok -->
                            <a href="#" class="group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-gray-800 to-black rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact Form -->
                <div>
                    <form action="{{ route('contact.send') }}" method="POST"
                        class="bg-white p-8 rounded-xl shadow-sm space-y-6">
                         @csrf

                        <div class=" mb-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-2">{{ __('app/contact.form_title') }}</h2>
                            <p class="text-sm text-gray-600">{{ __('app/contact.form_subtitle') }}</p>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app/contact.full_name') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:outline-none"
                                placeholder="{{ __('app/contact.full_name_placeholder') }}" required>
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app/contact.email') }}
                                <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:outline-none"
                                placeholder="{{ __('app/contact.email_placeholder') }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('app/contact.phone_optional') }}</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:outline-none"
                                placeholder="{{ __('app/contact.phone_placeholder') }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app/contact.subject') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:outline-none"
                                placeholder="{{ __('app/contact.subject_placeholder') }}" required>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app/contact.message') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="message" rows="6"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-primary-500 focus:outline-none"
                                placeholder="{{ __('app/contact.message_placeholder') }}" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bouton -->
                        <button type="submit"
                            class="w-full border-2 border-primary-600 text-primary-600 font-semibold py-3 px-6 rounded-lg
                            hover:bg-primary-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md">
                            {{ __('app/contact.send_button') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Additional Info Section -->
    <section class="py-12 bg-gradient-to-r from-primary-50 to-accent-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Response Time -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                        {{ __('app/contact.response_time_title') }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ __('app/contact.response_time_desc') }}
                    </p>
                </div>

                <!-- Support -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                        {{ __('app/contact.support_title') }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ __('app/contact.support_desc') }}
                    </p>
                </div>

                <!-- Security -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                        {{ __('app/contact.security_title') }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ __('app/contact.security_desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
