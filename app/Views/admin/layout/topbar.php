<div class="-mr-1.5 flex items-center space-x-2">
    <!-- Mobile Search Toggle -->
    
    

    <!-- Dark Mode Toggle -->
    <button
    @click="$store.global.isDarkModeEnabled = !$store.global.isDarkModeEnabled"
    class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
    >
    <svg
        x-show="$store.global.isDarkModeEnabled"
        x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
        x-transition:enter-start="scale-75"
        x-transition:enter-end="scale-100 static"
        class="h-6 w-6 text-amber-400"
        fill="currentColor"
        viewBox="0 0 24 24"
    >
        <path
        d="M11.75 3.412a.818.818 0 01-.07.917 6.332 6.332 0 00-1.4 3.971c0 3.564 2.98 6.494 6.706 6.494a6.86 6.86 0 002.856-.617.818.818 0 011.1 1.047C19.593 18.614 16.218 21 12.283 21 7.18 21 3 16.973 3 11.956c0-4.563 3.46-8.31 7.925-8.948a.818.818 0 01.826.404z"
        />
    </svg>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        x-show="!$store.global.isDarkModeEnabled"
        x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
        x-transition:enter-start="scale-75"
        x-transition:enter-end="scale-100 static"
        class="h-6 w-6 text-amber-400"
        viewBox="0 0 20 20"
        fill="currentColor"
    >
        <path
        fill-rule="evenodd"
        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
        clip-rule="evenodd"
        />
    </svg>
    </button>  
    <!-- Profile -->
    <div
    x-data="usePopper({placement:'right-end',offset:12})"
    @click.outside="isShowPopper && (isShowPopper = false)"
    class="flex"
    >
    <button
        @click="isShowPopper = !isShowPopper"
        x-ref="popperRef"
        class="avatar h-12 w-12"
    >
        <?php if (empty(session()->get('photo'))) : ?>
            <img
                class="rounded-full"
                src="/lineone/images/200x200.png"
                alt="avatar"
            />
        <?php else : ?>
            <img
                class="rounded-full"
                src="<?= session()->get('photo') ?>"        
                onerror="this.onerror=null;this.src='/photos/<?= session()->get('photo') ?>';"        
                alt="avatar"
            />
        <?php endif ?>
        <span
        class="absolute right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"
        ></span>
    </button>

    <div
        :class="isShowPopper && 'show'"
        class="popper-root fixed"
        x-ref="popperRoot"
    >
    
        <div
        class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700"
        >
        <div
            class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800"
        >
            <div class="avatar h-14 w-14">
            <?php if (empty(session()->get('photo'))) : ?>
                <img
                    class="rounded-full"
                    src="/lineone/images/200x200.png"
                    alt="avatar"
                />
            <?php else : ?>
                <img
                    class="rounded-full"
                    src="<?= session()->get('photo') ?>"
                    onerror="this.onerror=null;this.src='/photos/<?= session()->get('photo') ?>';"        
                    alt="avatar"
                />
            <?php endif ?>
            </div>
            <div>
            <a
                href="#"
                class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
            >
                <?= ucfirst(session()->get('username')) ?>
            </a>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                <?= strtoupper(session()->get('role')) ?> ACCOUNT
            </p>
            </div>
        </div>
        <div class="flex flex-col pt-2 pb-5">
            <a
            href="/profile"
            class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
            >
            <div
                class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning text-white"
            >
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4.5 w-4.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
                </svg>
            </div>

            <div>
                <h2
                class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light"
                >
                Profile
                </h2>
                <div
                class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                >
                Your profile setting
                </div>
            </div>
            </a>                    
            <div class="mt-3 px-4">
                <a
                    href="/pnp/logout"
                    class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                    </svg>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        </div>
    </div>
    </div>        
</div>
