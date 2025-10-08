<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 py-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Logo + Description -->
            <div class="md:col-span-2">
                <div class="flex items-center mb-4">
                    <img src="{{ url('images/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain" />
                    <span class="text-xl font-bold">{{ config('app.name') }}</span>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed max-w-md">
                    {{ __('app/footer.description') }}
                </p>

                <!-- Social icons -->
                <div class="mt-4">
                    @include('components.social-icons')
                </div>
            </div>

            <!-- Liens rapides -->
            <div>
                <h3 class="text-white font-semibold mb-4">{{ __('app/footer.quick_links') }}</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/menu.home') }}</a>
                    </li>
                    <li><a href="{{ url('/about') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/menu.about') }}</a>
                    </li>
                    <li><a href="{{ url('/reports') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/menu.reports') }}</a>
                    </li>
                    <li><a href="{{ url('/contact') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/menu.contact') }}</a>
                    </li>
                    <li><a href="{{ route('terms') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/footer.terms') }}</a>
                    </li>
                    <li><a href="{{ route('privacy') }}"
                            class="text-gray-300 hover:text-primary-400 transition-colors text-sm">{{ __('app/footer.privacy') }}</a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-4">{{ __('app/footer.contact') }}</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ __('app/footer.address') }}</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:contact@sos-environnement.mr"
                            class="hover:text-primary-400 transition-colors">{{ __('app/footer.email') }}</a>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+22200000000"
                            class="hover:text-primary-400 transition-colors">{{ __('app/footer.phone') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bas de page -->
        <div class="border-t border-gray-700 mt-10 pt-6 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} {{ config('app.name') }} Mauritanie. {{ __('app/footer.rights') }}
            </p>
        </div>
    </div>
</footer>
