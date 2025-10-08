@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-600 to-accent-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">À propos de SOS Environnement</h1>
            <p class="text-xl max-w-3xl mx-auto">
                Une initiative citoyenne pour la protection de l'environnement en Mauritanie
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre Mission</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        SOS Environnement est une plateforme numérique créée pour donner aux citoyens mauritaniens
                        les moyens de contribuer activement à la protection de leur environnement.
                    </p>
                    <p class="text-lg text-gray-600 mb-6">
                        Notre mission est de faciliter la communication entre les citoyens et les autorités
                        compétentes pour une résolution rapide et efficace des problèmes environnementaux.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Sensibiliser les citoyens aux enjeux environnementaux</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Faciliter le signalement des problèmes environnementaux</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Améliorer la transparence dans le traitement des
                                signalements</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-primary-50 rounded-2xl p-8">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Vision 2030</h3>
                        <p class="text-gray-600">
                            Faire de la Mauritanie un modèle de participation citoyenne
                            dans la protection environnementale en Afrique de l'Ouest.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs</h2>
                <p class="text-xl text-gray-600">Les principes qui guident notre action</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 max-w-6xl mx-auto">

                <!-- Value: Engagement -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-red-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-red-500 to-pink-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-6 group-hover:text-primary-600 transition-colors">
                                Engagement</h3>
                            <p class="text-gray-600 leading-relaxed text-base">
                                Nous nous engageons pleinement dans la protection de l'environnement mauritanien avec
                                passion et détermination.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Value: Transparence -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-blue-500 to-indigo-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-6 group-hover:text-primary-600 transition-colors">
                                Transparence</h3>
                            <p class="text-gray-600 leading-relaxed text-base">
                                Information claire et accessible sur tous nos processus, actions et résultats pour une
                                confiance totale.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Value: Collaboration -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-green-500 to-emerald-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-6 group-hover:text-primary-600 transition-colors">
                                Collaboration</h3>
                            <p class="text-gray-600 leading-relaxed text-base">
                                Travail en équipe avec les citoyens, autorités et partenaires pour maximiser notre
                                impact environnemental.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div
                    class="inline-block bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 px-6 py-2 rounded-full text-sm font-semibold mb-6">
                    Impact réel
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Impact Projeté</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Les résultats concrets de notre engagement collectif pour l'environnement mauritanien
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

                <!-- Impact 1 : Reports -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent">
                                1200+</div>

                            <div class="text-xl font-bold text-gray-900 mb-4">Signalements</div>
                            <div class="text-gray-600 leading-relaxed text-sm">
                                Signalements soumis par les citoyens
                                à travers tout le pays.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Impact: Solved reports -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-green-500 to-green-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-green-500 to-green-700 bg-clip-text text-transparent">
                                892+</div>
                            <div class="text-xl font-bold text-gray-900 mb-4">Problèmes résolus</div>
                            <div class="text-gray-600 leading-relaxed text-sm">Interventions réussies grâce à la
                                mobilisation citoyenne et aux autorités compétentes.</div>
                        </div>
                    </div>
                </div>

                <!-- Impact: Wilayas -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-purple-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-purple-500 to-purple-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-purple-500 to-purple-700 bg-clip-text text-transparent">
                                15</div>
                            <div class="text-xl font-bold text-gray-900 mb-4">Régions couvertes</div>
                            <div class="text-gray-600 leading-relaxed text-sm">Wilayas mauritaniennes où des
                                citoyens utilisent activement notre plateforme.</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 bg-gray-50">
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
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
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

    <!-- Team Section -->
    <section class="py-16 bg-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Rejoignez le Mouvement</h2>
                <p class="text-xl text-gray-600 mb-8">
                    Ensemble, nous pouvons créer un changement durable pour l'environnement mauritanien
                </p>
                <a href="/register" class="btn-primary">
                    Devenir membre
                </a>
            </div>
        </div>
    </section>
@endsection
