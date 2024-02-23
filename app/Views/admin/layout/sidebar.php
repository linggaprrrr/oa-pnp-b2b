<!-- Sidebar -->
<div class="sidebar print:hidden">
        <!-- Main Sidebar -->
    <div class="main-sidebar">
        <div
        class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800"
        >
        <!-- Application Logo -->
            <div class="flex pt-4">
                <a href="/admin/users">
                <img
                    class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                    src="/assets/img/quickprep-logo-only.png"
                    alt="logo"
                    style="border-radius: 50%"
                />
                </a>
            </div>

            <!-- Main Sections Links -->
            <div
                class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6"
            >
                <a
                    href="/admin/users"
                    id="users"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    x-tooltip.placement.right="'Users'"
                    >
                    <i class="fas fa-users fa-xl"></i>
                </a>
                <!-- <a
                    href="/admin/master-lists"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="master-list"
                    x-tooltip.placement.right="'Master List'"
                    >
                    <i class="fas fa-tasks fa-xl"></i>
                </a> -->

            </div>

            <!-- <div
                class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6"
            >
                <a
                    href="/admin/chat"
                    id="users"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    x-tooltip.placement.right="'Users'"
                    >
                    <i class="fas fa-users fa-xl"></i>
                </a>
                <a
                    href="/admin/master-lists"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="master-list"
                    x-tooltip.placement.right="'Master List'"
                    >
                    <i class="fas fa-tasks fa-xl"></i>
                </a>

            </div> -->

            <!-- Bottom Links -->
            <div class="flex flex-col items-center space-y-3 py-3">
                <!-- Chat  -->
                <a
                    href="/admin/chat"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="backup-restore"
                    x-tooltip.placement.right="'Chat With Users'"
                >
                    <i class="fab fa-rocketchat fa-xl"></i>
                </a>
                     
            </div>
            <div class="flex flex-col items-center space-y-3 py-3">
                <!-- History -->
                <a
                href="/admin/history"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="history"
                >
                <i class="fas fa-history fa-xl"></i>
                </a>                
            </div>
        </div>
    </div>

    <!-- Sidebar Panel -->
    <div class="sidebar-panel">
        
    </div>
</div>
