{{-- resources/views/components/navigation/topbar.blade.php --}}

<header
    class="fixed right-0 top-0 z-30 hidden h-20 border-b border-slate-200 bg-white lg:flex"
    style="left: 16rem;"
>
    <div class="flex w-full items-center justify-between gap-6 px-6">

        {{-- Recherche --}}
        <x-navigation.search />

        {{-- Actions --}}
        <div class="flex items-center gap-3">

            <x-navigation.notifications />

            <x-navigation.profile-menu />

        </div>

    </div>
</header>