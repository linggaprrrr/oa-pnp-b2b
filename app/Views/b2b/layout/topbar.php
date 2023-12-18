<div class="-mr-1.5 flex items-center space-x-2">
    <!-- Mobile Search Toggle -->
    <!--<?php if ($subscription['plan'] == 'free' || $subscription['plan'] == 0) : ?>-->
    <!--    <div x-data="{showModal:false}">-->
    <!--        <button-->
    <!--        @click="showModal = true"-->
    <!--        class="btn space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90"-->
    <!--        >-->
    <!--        <em class="mr-1	fab fa-paypal"> </em>-->
    <!--        Upgrade Plan-->
    <!--        </button>-->
    <!--        <template x-teleport="#x-teleport-target">-->
    <!--            <div-->
    <!--                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"-->
    <!--                x-show="showModal"-->
    <!--                role="dialog"-->
    <!--                @keydown.window.escape="showModal = false"-->
    <!--            >-->
    <!--                <div-->
    <!--                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"-->
    <!--                @click="showModal = false"-->
    <!--                x-show="showModal"-->
    <!--                x-transition:enter="ease-out"-->
    <!--                x-transition:enter-start="opacity-0"-->
    <!--                x-transition:enter-end="opacity-100"-->
    <!--                x-transition:leave="ease-in"-->
    <!--                x-transition:leave-start="opacity-100"-->
    <!--                x-transition:leave-end="opacity-0"-->
    <!--                ></div>-->
    <!--                <div-->
    <!--                class="relative w-full max-w-screen-lg origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"-->
    <!--                x-show="showModal"-->
    <!--                x-transition:enter="easy-out"-->
    <!--                x-transition:enter-start="opacity-0 scale-95"-->
    <!--                x-transition:enter-end="opacity-100 scale-100"-->
    <!--                x-transition:leave="easy-in"-->
    <!--                x-transition:leave-start="opacity-100 scale-100"-->
    <!--                x-transition:leave-end="opacity-0 scale-95"-->
    <!--                >-->
    <!--                <div-->
    <!--                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"-->
    <!--                >-->
    <!--                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">-->
                        
    <!--                    </h3>-->
    <!--                    <button-->
    <!--                    @click="showModal = !showModal"-->
    <!--                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 close-plan"-->
    <!--                    >-->
    <!--                    <svg-->
    <!--                        xmlns="http://www.w3.org/2000/svg"-->
    <!--                        class="h-4.5 w-4.5"-->
    <!--                        fill="none"-->
    <!--                        viewBox="0 0 24 24"-->
    <!--                        stroke="currentColor"-->
    <!--                        stroke-width="2"-->
    <!--                    >-->
    <!--                        <path-->
    <!--                        stroke-linecap="round"-->
    <!--                        stroke-linejoin="round"-->
    <!--                        d="M6 18L18 6M6 6l12 12"-->
    <!--                        ></path>-->
    <!--                    </svg>-->
    <!--                    </button>-->
    <!--                </div>-->
    <!--                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">-->
    <!--                    <div class="" style="text-align: -webkit-center;">-->
    <!--                        <div class="py-5 text-center lg:py-6">-->
    <!--                            <p class="text-sm uppercase">Are you new here?</p>-->
    <!--                            <h3 class="mt-1 text-xl font-semibold text-slate-600 dark:text-navy-100">-->
    <!--                                Welcome. Where do you like to Start?-->
    <!--                            </h3>-->
    <!--                        </div>-->
    <!--                        <div class="grid max-w-4xl grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">-->
    <!--                            <div class="card p-4 text-center sm:p-5">-->
    <!--                                <div class="mt-8">-->
    <!--                                <i class="fa fa-car text-6xl text-primary dark:text-accent-light"></i>-->
    <!--                                </div>-->
    <!--                                <div class="mt-5">-->
    <!--                                <h4 class="text-xl font-semibold text-slate-600 dark:text-navy-100">-->
    <!--                                    Monthly-->
    <!--                                </h4>-->
    <!--                                <p>the starter choise</p>-->
    <!--                                </div>-->
    <!--                                <div class="mt-5">-->
    <!--                                <span class="text-4xl tracking-tight text-primary dark:text-accent-light">$300</span>/month-->
    <!--                                </div>-->
    <!--                                <div class="mt-8 space-y-4 text-left">-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem ipsum</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem set</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem ipsum dolor.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum dolor sit amet, consectetur.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Only lorem</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum dolor.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum.</span>-->
    <!--                                </div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-8">-->
    <!--                                    <button class="btn plan1 rounded-full border border-slate-200 font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">-->
    <!--                                            Choose Plan-->
    <!--                                        </button>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="card p-4 text-center sm:p-5">-->
    <!--                                <div class="absolute top-0 right-0 p-3">                                                      -->
    <!--                                </div>-->
    <!--                                <div class="mt-8">-->
    <!--                                <i class="fa fa-plane text-6xl text-primary dark:text-accent-light"></i>-->
    <!--                                </div>-->
    <!--                                <div class="mt-5">-->
    <!--                                <h4 class="text-xl font-semibold text-slate-600 dark:text-navy-100">-->
    <!--                                    Annualy-->
    <!--                                </h4>-->
    <!--                                <p>the starter choise</p>-->
    <!--                                </div>-->
    <!--                                <div class="mt-5">-->
    <!--                                <span class="text-4xl tracking-tight text-primary dark:text-accent-light">$3600</span>/year-->
    <!--                                </div>-->
    <!--                                <div class="mt-8 space-y-4 text-left">-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem ipsum</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem set</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium"> Lorem ipsum dolor.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum dolor sit amet, consectetur.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Only lorem</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum dolor.</span>-->
    <!--                                </div>-->
    <!--                                <div class="flex items-start space-x-3">-->
    <!--                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">-->
    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">-->
    <!--                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
    <!--                                    </svg>-->
    <!--                                    </div>-->
    <!--                                    <span class="font-medium">Lorem ipsum.</span>-->
    <!--                                </div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-8">-->
    <!--                                        <button class="btn plan2 rounded-full border border-slate-200 font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">-->
    <!--                                            Choose Plan-->
    <!--                                        </button>-->
    <!--                                </div>-->
    <!--                            </div>-->
                                
    <!--                            </div>-->
    <!--                    </div>-->
    <!--                </div>                    -->
    <!--            </div>                -->
    <!--        </template>-->
    <!--    </div>-->
    <!--<?php else : ?>-->
    <!--    <div x-data="{showModal:false}">-->
    <!--        <button-->
    <!--        @click="showModal = true"-->
    <!--        class="btn space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90"-->
    <!--        >-->
    <!--        <em class="mr-1	fab fa-paypal"> </em>-->
    <!--        <?= ucfirst($subscription['plan']) ?> Plan-->
    <!--        </button>-->
    <!--        <template x-teleport="#x-teleport-target">-->
    <!--            <div-->
    <!--                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"-->
    <!--                x-show="showModal"-->
    <!--                role="dialog"-->
    <!--                @keydown.window.escape="showModal = false"-->
    <!--            >-->
    <!--                <div-->
    <!--                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"-->
    <!--                @click="showModal = false"-->
    <!--                x-show="showModal"-->
    <!--                x-transition:enter="ease-out"-->
    <!--                x-transition:enter-start="opacity-0"-->
    <!--                x-transition:enter-end="opacity-100"-->
    <!--                x-transition:leave="ease-in"-->
    <!--                x-transition:leave-start="opacity-100"-->
    <!--                x-transition:leave-end="opacity-0"-->
    <!--                ></div>-->
    <!--                <div-->
    <!--                class="relative w-full max-w-screen-lg origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"-->
    <!--                x-show="showModal"-->
    <!--                x-transition:enter="easy-out"-->
    <!--                x-transition:enter-start="opacity-0 scale-95"-->
    <!--                x-transition:enter-end="opacity-100 scale-100"-->
    <!--                x-transition:leave="easy-in"-->
    <!--                x-transition:leave-start="opacity-100 scale-100"-->
    <!--                x-transition:leave-end="opacity-0 scale-95"-->
    <!--                >-->
    <!--                <div-->
    <!--                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"-->
    <!--                >-->
    <!--                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">-->
                        
    <!--                    </h3>-->
    <!--                    <button-->
    <!--                    @click="showModal = !showModal"-->
    <!--                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 close-plan"-->
    <!--                    >-->
    <!--                    <svg-->
    <!--                        xmlns="http://www.w3.org/2000/svg"-->
    <!--                        class="h-4.5 w-4.5"-->
    <!--                        fill="none"-->
    <!--                        viewBox="0 0 24 24"-->
    <!--                        stroke="currentColor"-->
    <!--                        stroke-width="2"-->
    <!--                    >-->
    <!--                        <path-->
    <!--                        stroke-linecap="round"-->
    <!--                        stroke-linejoin="round"-->
    <!--                        d="M6 18L18 6M6 6l12 12"-->
    <!--                        ></path>-->
    <!--                    </svg>-->
    <!--                    </button>-->
    <!--                </div>-->
    <!--                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">-->
    <!--                    <div class="" style="text-align: -webkit-center;">-->
    <!--                        <div class="py-2 text-center lg:py-2">-->
    <!--                        </div>-->
    <!--                        <div class="grid max-w-4xl grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">                                -->
    <!--                            <div class="" style="text-align: -webkit-center;">                                    -->
    <!--                                <div class="grid max-w-4xl grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">-->
    <!--                                    <div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:px-5">-->
    <!--                                        <div class="flex items-center justify-between py-3">-->
    <!--                                        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">-->
    <!--                                            Your Plan-->
    <!--                                        </h2>-->
    <!--                                        <div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="isShowPopper &amp;&amp; (isShowPopper = false)" class="inline-flex">-->
    <!--                                            <button x-ref="popperRef" @click="isShowPopper = !isShowPopper" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">-->
    <!--                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
    <!--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>-->
    <!--                                            </svg>-->
    <!--                                            </button>-->

    <!--                                            <div x-ref="popperRoot" class="popper-root" :class="isShowPopper &amp;&amp; 'show'" style="position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 304px);" data-popper-placement="bottom-end">-->
    <!--                                            <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">-->
    <!--                                                <ul>-->
    <!--                                                    <li>-->
    <!--                                                        <a href="#" class="remove-plan flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Remove</a>-->
    <!--                                                    </li>                                                                                                                -->
    <!--                                                </ul>-->
    <!--                                            </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="space-y-4">-->
                                            
    <!--                                        <div>-->
    <!--                                            <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">-->
    <!--                                            <?= ucfirst($subscription['plan']) ?>-->
    <!--                                            </h3>-->
    <!--                                            <p class="text-xs text-slate-400 dark:text-navy-300">-->
                                                    
    <!--                                            </p>-->
    <!--                                        </div>-->
    <!--                                        <div class="space-y-3 text-xs+">-->
    <!--                                            <div class="flex justify-between">-->
    <!--                                                <p class="font-medium text-slate-700 dark:text-navy-100">-->
    <!--                                                    Start Date-->
    <!--                                                </p>-->
    <!--                                                <p class="text-right"><?= date('d M Y', strtotime($subscription['start'])) ?></p>-->
    <!--                                            </div>-->
    <!--                                            <div class="flex justify-between">-->
    <!--                                                <p class="font-medium text-slate-700 dark:text-navy-100">-->
    <!--                                                    Expiry Date-->
    <!--                                                </p>-->
    <!--                                                <p class="text-right"><?= date('d M Y', strtotime($subscription['exp'])) ?></p>-->
    <!--                                            </div>-->
                                                
    <!--                                        </div>-->
    <!--                                        </div>-->
    <!--                                    </div>    -->
    <!--                                </div>-->
    <!--                            </div>-->
                                
    <!--                            </div>-->
    <!--                    </div>-->
    <!--                </div>                    -->
    <!--            </div>                -->
    <!--        </template>-->
    <!--    </div>-->
    <!--<?php endif ?>-->
    <div style="display: none;" x-data="{showModal:false}">
        <button
        @click="showModal = true"
        class="btn h-6 mt-2 upgrade-plan rounded bg-primary space-x-2 shadow-lg px-3 text-white text-xs shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 plan-choosed"
        >
        
        </button>
        <template x-teleport="#x-teleport-target">
            <div
                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModal"
                role="dialog"
                @keydown.window.escape="showModal = false"
            >
                <div
                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                @click="showModal = false"
                x-show="showModal"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                ></div>
                <div
                class="relative w-full max-w-screen-lg origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
                x-show="showModal"
                x-transition:enter="easy-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="easy-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                >
                <div
                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
                >
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">
                    
                    </h3>
                    <button
                    @click="showModal = !showModal"
                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 close-plan-choosed"
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
                        d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                    </button>
                </div>
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <div class="card px-5 py-4 sm:px-18">
                        <div>
                            <div class="text-center sm:text-left">
                                <h2 class="text-2xl font-semibold uppercase text-primary dark:text-accent-light">
                                OA
                                </h2>
                                <div class="space-y-1 pt-2">
                                <p>Sparksuite, Inc.</p>
                                <p>12345 Sunny Road</p>
                                <p>Sunnyville, CA 12345</p>
                                </div>
                            </div>
                        </div>                                                
                        <div class="is-scrollbar-hidden my-2 min-w-full overflow-x-auto">
                        <table class="is-zebra w-full text-left">
                            <thead>
                            <tr>
                                <th class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    #
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    DESCRIPTION
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-3 py-3 text-right font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    MONTH
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-3 py-3 text-right font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    RATE
                                </th>
                                <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 text-right font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    SUBTOTAL
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5">
                                        1
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div>
                                            <p class="plan-description font-medium text-slate-600 dark:text-navy-100">
                                                
                                            </p>
                                            <p class="text-xs+">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit. Perferendis
                                            </p>
                                        </div>
                                    </td>
                                    <td class="w-3/12 whitespace-nowrap px-4 py-3 text-right sm:px-5">
                                        1
                                    </td>
                                    <td class="w-3/12 plan-rate whitespace-nowrap px-4 py-3 text-right sm:px-5">
                                        
                                    </td>
                                    <td class="w-3/12 plan-subtotal whitespace-nowrap rounded-r-lg px-4 py-3 text-right font-semibold sm:px-5">
                                    
                                    </td>
                                </tr>                                                    
                            </tbody>
                        </table>
                        </div>
                        <div class="my-2 h-px bg-slate-200 dark:bg-navy-500"></div>
                        <div class="flex flex-col justify-between sm:flex-row">
                        <div class="text-center sm:text-left">
                            <p class="text-lg font-medium text-slate-600 dark:text-navy-100">
                            Payment Method:
                            </p>
                            <div class="space-y-1 pt-2">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                        <div class="mt-4 text-center sm:mt-0 sm:text-right">
                            <p class="text-lg font-medium text-slate-600 dark:text-navy-100">
                            Total:
                            </p>
                            <div class="space-y-1 pt-2">
                            <p>Summary : <span class="font-medium plan-summary"></span></p>
                            <p>Discount : <span class="font-medium">-</span></p>
                            <p class="text-lg text-primary dark:text-accent-light">
                                Total: <span class="font-medium plan-total"></span>
                            </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>                    
            </div>                
        </template>
    </div>    

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
                onerror="this.onerror=null;this.src='photos/<?= session()->get('photo') ?>';"        
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
                    onerror="this.onerror=null;this.src='photos/<?= session()->get('photo') ?>';"        
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
                    href="/b2b/logout"
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