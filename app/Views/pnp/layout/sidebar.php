<!-- Sidebar -->
<div class="sidebar print:hidden">
        <!-- Main Sidebar -->
    <div class="main-sidebar">
        <div
        class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800"
        >
        <!-- Application Logo -->
            <div class="flex pt-4">
                <a href="/pnp/dashboard">
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
                <!-- Dashobards -->
                <a
                href="/pnp/dashboard"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="dashboard"
                x-tooltip.placement.right="'Dashboards'"
                >
                    <svg
                        class="h-7 w-7"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                        fill="currentColor"
                        fill-opacity=".3"
                        d="M5 14.059c0-1.01 0-1.514.222-1.945.221-.43.632-.724 1.453-1.31l4.163-2.974c.56-.4.842-.601 1.162-.601.32 0 .601.2 1.162.601l4.163 2.974c.821.586 1.232.88 1.453 1.31.222.43.222.935.222 1.945V19c0 .943 0 1.414-.293 1.707C18.414 21 17.943 21 17 21H7c-.943 0-1.414 0-1.707-.293C5 20.414 5 19.943 5 19v-4.94Z"
                        />
                        <path
                        fill="currentColor"
                        d="M3 12.387c0 .267 0 .4.084.441.084.041.19-.04.4-.204l7.288-5.669c.59-.459.885-.688 1.228-.688.343 0 .638.23 1.228.688l7.288 5.669c.21.163.316.245.4.204.084-.04.084-.174.084-.441v-.409c0-.48 0-.72-.102-.928-.101-.208-.291-.355-.67-.65l-7-5.445c-.59-.459-.885-.688-1.228-.688-.343 0-.638.23-1.228.688l-7 5.445c-.379.295-.569.442-.67.65-.102.208-.102.448-.102.928v.409Z"
                        />
                        <path
                        fill="currentColor"
                        d="M11.5 15.5h1A1.5 1.5 0 0 1 14 17v3.5h-4V17a1.5 1.5 0 0 1 1.5-1.5Z"
                        />
                        <path
                        fill="currentColor"
                        d="M17.5 5h-1a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5Z"
                        />
                    </svg>
                </a>

                <!-- Upload File -->
                <!-- <a
                href="/pnp/leads-list"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="leads-list"
                x-tooltip.placement.right="'Upload Files'"
                >
                    <i class="fas fa-file-upload fa-xl"></i>
                </a> -->

                <!-- Selection -->
                <a
                href="/pnp/selections"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="selections"
                x-tooltip.placement.right="'Selections'"
                >
                    <i class="fas fa-clipboard-list fa-xl"></i>
                </a>

                <!-- Forms -->
                <a
                href="/pnp/purchases-list"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="purchases-list"
                x-tooltip.placement.right="'Purchase Lists'"
                >
                    <i class="fas fa-shopping-basket fa-xl"></i>
                </a>

                <!-- Components -->
                <a
                href="/pnp/inventories"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="inventories"
                x-tooltip.placement.right="'Inventory'"
                >
                    <i class="fas fa-cubes fa-xl"></i>
                </a>

                <!-- Elements -->
                <a
                href="/pnp/master-lists"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="master-list"
                x-tooltip.placement.right="'Master List'"
                >
                    <i class="fas fa-tasks fa-xl"></i>
                </a>

                <!-- Elements -->
                <a
                href="/pnp/assignments"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="assignments"
                x-tooltip.placement.right="'Assignments'"
                >
                    <i class="fas fa-user-check fa-xl"></i>
                </a>
                <a
                    href="/pnp/clients"
                    id="clients"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    x-tooltip.placement.right="'Clients'"
                    >
                    <i class="fas fa-users fa-xl"></i>
                </a>
                <a
                href="/pnp/need-to-upload"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                id="need-to-upload"
                x-tooltip.placement.right="'Need to Upload'"
                >
                    <i class="fas fa-clipboard-check fa-xl"></i>
                </a>
                
                <a
                    href="/pnp/shipments"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="shipments"
                    x-tooltip.placement.right="'Shipments'"
                    >
                    <i class="fas fa-shipping-fast fa-xl"></i>
                </a>
                <a
                    href="/pnp/refunds"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="refunds"
                    x-tooltip.placement.right="'Refunds  Page'"
                >
                    <i class="fas fa-hand-holding-usd fa-xl"></i>
                </a>
                <hr>                                
                <a
                    href="/pnp/backup-and-restore"
                    class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    id="backup-restore"
                    x-tooltip.placement.right="'Backup & Restore'"
                >
                    <i class="fas fas fa-database fa-xl"></i>
                </a>

            </div>

            <!-- Bottom Links -->
            <div class="flex flex-col items-center space-y-3 py-3">
                <!-- History -->                
                <a
                href="/pnp/history"
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