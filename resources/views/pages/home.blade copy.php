@extends('layouts.app')

@section('content')
    @if (session('success'))
        <x-toast type="success" :message="session('success')" />
    @endif

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-primary-600 to-accent-600 text-white">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Protégeons ensemble notre <br>
                    <span class="text-yellow-300">environnement</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-gray-100">
                    Signalez les problèmes environnementaux, suivez leur traitement et contribuez à un avenir plus propre
                    pour la Mauritanie.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 sm:space-x-4 sm:gap-0 justify-center">
                    <a href="{{ url('/register') }}"
                        class="bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                        Commencer maintenant
                    </a>
                    <a href="{{ url('/reports') }}"
                        class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-600 transition-colors inline-block">
                        Voir les signalements
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <!-- Reports -->
                <div class="text-center">
                    <div class="text-2xl md:text-4xl font-bold text-primary-600 mb-2">
                        {{ $stats['reports'] ?? 0 }}
                    </div>
                    <div class="text-sm md:text-base text-gray-600">Signalements effectués</div>
                </div>

                <!-- Resolved -->
                <div class="text-center">
                    <div class="text-2xl md:text-4xl font-bold text-accent-600 mb-2">
                        {{ $stats['resolved'] ?? 0 }}
                    </div>
                    <div class="text-sm md:text-base text-gray-600">Problèmes résolus</div>
                </div>

                <!-- Citizens -->
                <div class="text-center">
                    <div class="text-2xl md:text-4xl font-bold text-green-600 mb-2">
                        {{ $stats['users'] ?? 0 }}
                    </div>
                    <div class="text-sm md:text-base text-gray-600">Citoyens engagés</div>
                </div>

                <!-- Districts -->
                <div class="text-center">
                    <div class="text-2xl md:text-4xl font-bold text-blue-600 mb-2">
                        {{ $stats['districts'] ?? 0 }}
                    </div>
                    <div class="text-sm md:text-base text-gray-600">Quartiers couverts</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section header -->
            <div class="text-center mb-12">
                <div class="inline-block bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    Un processus simple et efficace
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Comment ça marche ?</h2>
                <p class="text-xl text-gray-600 mx-auto">
                    Signalez et résolvez les problèmes environnementaux en quelques étapes simples
                </p>
            </div>

            <!-- Steps grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center relative">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-1 -right-1 md:-top-2 md:-right-2 w-5 h-5 md:w-6 md:h-6 bg-gray-800 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            1
                        </span>
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9zM15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Photographiez</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Prenez une photo du problème environnemental que vous observez. Notre système géolocalise
                        automatiquement votre signalement.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center relative">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-1 -right-1 md:-top-2 md:-right-2 w-5 h-5 md:w-6 md:h-6 bg-gray-800 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            2
                        </span>
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Décrivez</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Ajoutez une description détaillée du problème, sélectionnez la catégorie et définissez le niveau de
                        priorité.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center relative">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-1 -right-1 md:-top-2 md:-right-2 w-5 h-5 md:w-6 md:h-6 bg-gray-800 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            3
                        </span>
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Suivez</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Recevez des notifications sur l'avancement de votre signalement et suivez sa résolution en temps
                        réel.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div
                    class="inline-block bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 px-6 py-2 rounded-full text-sm font-semibold mb-4">
                    Nos partenaires
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ils soutiennent notre mission</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Des organisations engagées qui nous accompagnent dans la protection de l'environnement mauritanien
                </p>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">

                <!-- Partner 1 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2L15.09 8H21L16.18 12.26L18.18 19L12 15.77L5.82 19L7.82 12.26L3 8H8.91L12 2Z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-1.jpg') }}" alt="Partner 1"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 1
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Partner 2 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-2.jpg') }}" alt="Partner 2"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 2
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Partner 3 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-yellow-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-3.jpg') }}" alt="Partner 3"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 3
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-accent-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Rejoignez la communauté environnementale
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Ensemble, nous pouvons faire la différence pour un environnement plus propre et plus sain en Mauritanie.
            </p>
            <a href="{{ url('/register') }}"
                class="bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                Rejoindre maintenant
            </a>
        </div>
    </section>
@endsection
