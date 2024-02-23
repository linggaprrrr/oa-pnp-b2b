<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('b2b/layout/header'); ?>
    <title>Chat</title>
    
</head>
    <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->


    <!-- Page Wrapper -->
    <div
        id="root"
        class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
        x-cloak
    >
        <!-- Sidebar -->
        <?= $this->include('b2b/layout/sidebar'); ?>
    
        <!-- App Header Wrapper-->
        <nav class="header before:bg-white dark:before:bg-navy-750 print:hidden">
            <!-- App Header  -->
            <div
                class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden"
            >
                <!-- Header Items -->
                <div class="flex w-full items-center justify-between">
                <!-- Left: Sidebar Toggle Button -->
                <div class="h-7 w-7">                
                </div>

                <!-- Right: Header buttons -->
                <?= $this->include('b2b/layout/topbar'); ?>
                </div>
            </div>
        </nav>

        <!-- Mobile Searchbar -->
        

        <!-- Main Content Wrapper -->
        <main        
          class="main-content h-100vh chat-app mt-0 flex w-full flex-col"        
          style="margin-right: 20px;"
      >
        <div
          class="chat-header relative z-10 flex h-[61px] w-full shrink-0 items-center justify-between border-b border-slate-150 bg-white px-[calc(var(--margin-x)-.5rem)] shadow-sm transition-[padding,width] duration-[.25s] dark:border-navy-700 dark:bg-navy-800"
        >
          <div class="flex items-center space-x-5">
            <div class="ml-1 h-7 w-7">
              <button
                class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-primary outline-none focus:outline-none dark:text-accent-light/80"
                :class="$store.global.isSidebarExpanded && 'active'"
                @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded"
              >
                <span></span>
                <span></span>
                <span></span>
              </button>
            </div>     
          </div>
          <div class="-mr-1 flex items-center">
            <button
              class="btn hidden h-9 w-9 rounded-full p-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:flex"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5.5 w-5.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                />
              </svg>
            </button>
            <button
              class="btn h-9 w-9 rounded-full p-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5.5 w-5.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
              </svg>
            </button>
      
            <div
              x-data="usePopper({placement:'bottom-end',offset:4})"
              @click.outside="isShowPopper && (isShowPopper = false)"
              class="inline-flex"
            >
              <button
                x-ref="popperRef"
                @click="isShowPopper = !isShowPopper"
                class="btn h-9 w-9 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5.5 w-5.5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                  />
                </svg>
              </button>

              <div
                x-ref="popperRoot"
                class="popper-root"
                :class="isShowPopper && 'show'"
              >
               
              </div>
            </div>
          </div>
        </div>

        <div
          :class="$store.breakpoints.smAndUp && 'scrollbar-sm'"
          class="grow overflow-y-auto px-[calc(var(--margin-x)-.5rem)] py-5 transition-all duration-[.25s] message-container"
        >            
            <?php foreach($messages->getResultObject() as $message) : ?>              
              <?php if ($message->author == session()->get('oauth_uid')) : ?>
                <div class="flex items-start space-x-2.5 sm:space-x-5">             
                  <div class="flex flex-col items-start space-y-3.5">
                    <div class="mr-4 max-w-lg sm:mr-10">
                      <div
                        class="rounded-2xl rounded-tl-none bg-white p-3 text-slate-700 shadow-sm dark:bg-navy-700 dark:text-navy-100"
                      >
                      <?= $message->message ?>
                      </div>
                      <?php if (date('Y-m-d') == date('Y-m-d', strtotime($message->created_at))) : ?>
                        <p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300">
                          <?= date('H:i', strtotime($message->created_at)) ?>
                        </p>
                      <?php else : ?>
                        <p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300">
                            <?= date('m/d/Y H:i', strtotime($message->created_at)) ?>
                          </p>
                      <?php endif ?>
                    </div>                
                  </div>
                </div>
              <?php else : ?>
                <div class="flex items-start justify-end space-x-2.5 sm:space-x-5">
                    <div class="flex flex-col items-end space-y-3.5">                     
                        <div class="ml-4 max-w-lg sm:ml-10">
                            <div
                                class="rounded-2xl rounded-tr-none bg-info/10 p-3 text-slate-700 shadow-sm dark:bg-accent dark:text-white"
                            >                                    
                            <?= $message->message ?>
                            </div>
                            <p
                                class="mt-1 ml-auto text-left text-xs text-slate-400 dark:text-navy-300"
                            >
                            <?php if (date('Y-m-d') == date('Y-m-d', strtotime($message->created_at))) : ?>
                              <p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300">
                                <?= date('H:i', strtotime($message->created_at)) ?>
                              </p>
                            <?php else : ?>
                              <p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300">
                                  <?= date('m/d/Y H:i', strtotime($message->created_at)) ?>
                                </p>
                            <?php endif ?>
                            </p>
                        </div>
                    </div>                            
                </div>
              <?php endif ?>
            <?php endforeach ?>
          
          </div>
        
          </div>
          
        </div>

        <div
          class="chat-footer relative flex h-12 w-full shrink-0 items-center justify-between border-t border-slate-150 bg-white px-[calc(var(--margin-x)-.25rem)] transition-[padding,width] duration-[.25s] dark:border-navy-600 dark:bg-navy-800"
        >
          <div class="-ml-1.5 flex flex-1 space-x-2">
            <button
              type="button"
              class="btn h-9 w-9 shrink-0 rounded-full p-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5.5 w-5.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                />
              </svg>
            </button>

            <input
              type="text"
              class="form-input h-9 w-full bg-transparent placeholder:text-slate-400/70 message"
              placeholder="Write the message"
            />
          </div>

          <div class="-mr-1.5 flex">
        
            <button
              type="button"
              class="btn send h-9 w-9 shrink-0 rounded-full p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5.5 w-5.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m9.813 5.146 9.027 3.99c4.05 1.79 4.05 4.718 0 6.508l-9.027 3.99c-6.074 2.686-8.553.485-5.515-4.876l.917-1.613c.232-.41.232-1.09 0-1.5l-.917-1.623C1.26 4.66 3.749 2.46 9.813 5.146ZM6.094 12.389h7.341"
                />
              </svg>
            </button>
          </div>
        </div>

        </main>
    </div>
    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
    
    </body>
    
    
    <script>
        
        $(document).ready(function() {    
            let url = window.location.href;        
            switch (true) {
                case url.includes('dashboard') :                                     
                        $('#dashboard').removeClass();
                        $('#dashboard').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');   
                    break;
                case url.includes('leads-list') :                                       
                        $('#leads-list').removeClass();
                        $('#leads-list').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('selections') :                                    
                        $('#selections').removeClass();
                        $('#selections').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');   
                    break;
                case url.includes('purchases-list') :                                   
                        $('#purchases-list').removeClass();
                        $('#purchases-list').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                break; 
                case url.includes('open-purchased-list') :                                   
                        $('#purchases-list').removeClass();
                        $('#purchases-list').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                break;                    
                    case url.includes('inventories') :                                         
                        $('#inventories').removeClass();
                        $('#inventories').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');   
                    break;
                case url.includes('master-list') :                            
                        $('#master-list').removeClass();
                        $('#master-list').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('assignments') :             
                        $('#assignments').removeClass();
                        $('#assignments').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');   
                    break;
                    
                case url.includes('need-to-upload') :             
                        $('#need-to-upload').removeClass();
                        $('#need-to-upload').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('shipments') :             
                        $('#shipments').removeClass();
                        $('#shipments').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('clients') :             
                        $('#clients').removeClass();
                        $('#clients').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('file-parameter') :             
                        $('#file-parameter').removeClass();
                        $('#file-parameter').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('backup-and-restore') :             
                        $('#backup-restore').removeClass();
                        $('#backup-restore').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('refunds') :             
                        $('#refunds').removeClass();
                        $('#refunds').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                    break;
                case url.includes('history') :             
                    $('#history').removeClass();
                    $('#history').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                break;
                    
            }


            function scrollBottom() {
              var scrollableDiv = $('.grow');
              scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));
            } 

            scrollBottom();
        });


        $(document).on('click', '.send', function() {
            const message = $('.message').val();
            $.post('/send-message', {message: message})
                .done(function(data) {
                    const resp = JSON.parse(data);
                    $('.message-container').append('<div class="flex items-start space-x-2.5 sm:space-x-5"><div class="flex flex-col items-start space-y-3.5"><div class="mr-4 max-w-lg sm:mr-10"><div class="rounded-2xl rounded-tl-none bg-white p-3 text-slate-700 shadow-sm dark:bg-navy-700 dark:text-navy-100 message-sent">'+ message +'</div><p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300 date-sent">'+ resp['sent'] +'</p></div></div></div>');
                    $('.message').val('');
                    
                });
            
        });        
        
    </script>
</html>
