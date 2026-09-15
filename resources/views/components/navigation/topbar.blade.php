{{-- resources/views/components/navigation/topbar.blade.php --}}

<header
    class="fixed left-0 right-0 top-0 z-30 h-16
        border-b border-slate-200 bg-white
        lg:left-64 lg:h-20"
>
    <div class="flex h-full w-full items-center justify-between gap-4 px-4 sm:px-6">

        {{-- Mobile : menu --}}
        <div class="lg:hidden">
            <x-navigation.mobile-menu />
        </div>

        {{-- Recherche desktop --}}
        <div class="hidden flex-1 lg:block">
            <x-navigation.search />
        </div>

        {{-- Actions --}}
        <div class="ml-auto flex items-center gap-2 sm:gap-3">

            <x-navigation.notifications />

            <x-navigation.profile-menu />

        </div>

    </div>
</header>
