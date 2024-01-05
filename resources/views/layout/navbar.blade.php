<nav class="bg-gray-900">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Profile dropdown -->
            <div class="ml-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div class="grid grid-rows-2 grid-flow-col">
                        <p class="text-gray-100 text-end">{{ Auth::user()->name }}</p>
                        <p class="text-gray-500 text-end">{{ Auth::user()->role }}</p>
                    </div>
                    <button type="button"
                        class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <a href="{{route('logout')}}" class="block px-7 py-3 text-sm text-white" role="menuitem" tabindex="-1"
                            id="user-menu-item-2">Log out</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
