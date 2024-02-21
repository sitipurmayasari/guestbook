<header class="sticky top-0 bg-blue-500 dark:bg-[#182235] border-b border-slate-200 dark:border-slate-700 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">

            <!-- Header: Left side -->
            <div class="flex">

                <!-- Hamburger button -->
                <button class="text-slate-500 hover:text-slate-600 lg:hidden" @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>
                <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
                    <div class="px-3 py-2">
                        <button @click="sidebarExpanded = !sidebarExpanded">
                            <span class="sr-only">Expand / collapse sidebar</span>
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <rect x="4" y="5" width="16" height="2" />
                                <rect x="4" y="11" width="16" height="2" />
                                <rect x="4" y="17" width="16" height="2" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <!-- text-black Header: Right side -->
            <div class="flex items-center space-x-3">



                <!-- Dark mode toggle -->
                {{-- <x-theme-toggle /> --}}

                <!-- Divider -->
                {{-- <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none" /> --}}

                <!-- User button -->
                <x-dropdown-profile align="right" />

            </div>

        </div>
    </div>
</header>
