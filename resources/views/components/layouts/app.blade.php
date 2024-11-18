<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>


</head>
<body class="font-sans antialiased">
    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width>
        <x-slot:brand>
                {{-- Drawer toggle for "main-drawer" --}}
                <label for="main-drawer" class="lg:hidden mr-3">
                    <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                </label>

                {{-- Brand --}}
                <div>App</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-mary-nav>

        {{-- The main content with `full-width` --}}
        <x-mary-main with-nav full-width>

            {{-- This is a sidebar that works also as a drawer on small screens --}}
            {{-- Notice the `main-drawer` reference here --}}
            <x-slot:sidebar drawer="main-drawer" collapsible class="bg-orange-50">

                {{-- User --}}
                @if($user = auth()->user())
                    <x-mary-list-item :item="$user" value="name" no-separator no-hover class="pt-2">
                        <x-slot:actions>
                            <!-- Trigger logout via form submission -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <x-mary-button
                                icon="o-power"
                                class="btn-circle btn-ghost btn-xs"
                                tooltip-left="logoff"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            />
                        </x-slot:actions>
                    </x-mary-list-item>
                @endif

                {{-- Activates the menu item when a route matches the `link` property --}}
                <x-mary-menu activate-by-route>
                    <x-mary-menu-item title="Home" icon="o-home" link="/dashboard" />
                    <x-mary-menu-item title="Add Crime" icon="o-envelope" link="/crimes" />
                    <x-mary-menu-item title="Stat" icon="o-envelope" link="/stats" />
                    <x-mary-menu-sub title="Create Location" icon="o-cog-6-tooth">
                        <x-mary-menu-item title="Zilla" icon="o-wifi" link="/zilla" />
                        <x-mary-menu-item title="PS" icon="o-wifi" link="/ps" />
                        <x-mary-menu-item title="Union" icon="o-archive-box" link="/unions" />
                    </x-mary-menu-sub>
                </x-mary-menu>
            </x-slot:sidebar>

            {{-- The `$slot` goes here --}}
            <x-slot:content>
                {{ $slot }}
            </x-slot:content>
        </x-mary-main>

    @stack('scripts')
</body>
</html>
