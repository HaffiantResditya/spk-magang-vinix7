<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-vinix-bg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'SPK Vinix7') }} | PT Vinix Seven Aurum</title>

        <!-- Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-slate-800 bg-vinix-bg min-h-full flex flex-col selection:bg-vinix-aurum selection:text-slate-900">
        <!-- Navigation Header -->
        @include('layouts.navigation')

        <!-- Page Sub-Header / Breadcrumb -->
        @isset($header)
            <header class="bg-white border-b border-slate-200/80 shadow-xs">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Global Toast Alerts -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
                <div class="p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center shadow-xs">
                    <svg class="w-5 h-5 mr-3 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (window.Swal) {
                            window.Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: @json(session('success')),
                                confirmButtonColor: '#0F172A',
                                confirmButtonText: 'Lanjutkan',
                                customClass: {
                                    popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
                                    title: 'text-xl font-bold text-slate-900',
                                    confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm bg-slate-900 text-white shadow-md'
                                }
                            });
                        }
                    });
                </script>
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm flex items-center shadow-xs">
                    <svg class="w-5 h-5 mr-3 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (window.Swal) {
                            window.Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: @json(session('error')),
                                confirmButtonColor: '#0F172A',
                                confirmButtonText: 'Tutup',
                                customClass: {
                                    popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
                                    title: 'text-xl font-bold text-slate-900',
                                    confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm bg-slate-900 text-white shadow-md'
                                }
                            });
                        }
                    });
                </script>
            @endif

            @if(session('warning'))
                <div class="p-4 mb-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm flex items-center shadow-xs">
                    <svg class="w-5 h-5 mr-3 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('warning') }}</span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (window.Swal) {
                            window.Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: @json(session('warning')),
                                confirmButtonColor: '#0F172A',
                                confirmButtonText: 'Mengerti',
                                customClass: {
                                    popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
                                    title: 'text-xl font-bold text-slate-900',
                                    confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm bg-slate-900 text-white shadow-md'
                                }
                            });
                        }
                    });
                </script>
            @endif
        </div>

        <!-- Main Content Slot -->
        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-vinix-aurum"></span>
                    <span>&copy; {{ date('Y') }} PT Vinix Seven Aurum (VINIX7) - Decision Support System</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="https://vinix7.id" target="_blank" class="hover:text-vinix-navy transition font-medium">vinix7.id</a>
                    <span>&bull;</span>
                    <span>SAW Algorithm Engine</span>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
