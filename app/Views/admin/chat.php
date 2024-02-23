<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('admin/layout/header'); ?>
    <title><?= $title ?></title>    
    
</head>

  <body
    x-data
    x-bind="$store.global.documentBody"
    class="has-min-sidebar is-sidebar-open is-header-blur"
  >
    <!-- App preloader-->
    <div
      class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
    >
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div
      id="root"
      class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
      x-cloak
    >
      <!-- Sidebar -->
      <div class="sidebar print:hidden">
        <!-- Main Sidebar -->
        <?= $this->include('admin/layout/sidebar'); ?>


        <!-- Sidebar Panel -->
        <div class="sidebar-panel">
          <div
            class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750"
          >
            <!-- Sidebar Panel Header -->
            <div
              class="flex h-18 w-full items-center justify-between pl-4 pr-1"
            >
              <div class="flex items-center">
                <div class="avatar mr-3 hidden h-9 w-9 lg:flex">
                  <div
                    class="is-initial rounded-full bg-warning/10 text-warning"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                      />
                    </svg>
                  </div>
                </div>
                <p
                  class="text-md font-medium tracking-wider text-slate-800 line-clamp-1 dark:text-navy-100"
                >
                  Recent Message
                </p>
              </div>
              
            </div>

            <!-- Sidebar Panel Body -->
            <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
              <div class="is-scrollbar-hidden grow overflow-y-auto">                
                <ul
                  class="mt-4 space-y-1.5 px-2 font-inter text-xs+ font-medium"
                >
                  <?php $count = 1; ?>
                  <?php foreach($users->getResultObject() as $user) : ?>
                    <?php if ($userid == $user->oauth_uid) : ?>
                        <li>
                            <a
                            class="group flex justify-between space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                            href="/admin/chat/<?= $user->oauth_uid ?>"
                            >
                            <div class="flex items-center space-x-2">
                                <em class="fas fa-user"></em>
                                <span><?= $user->name ?></span>
                            </div>                            
                            </a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600" 
                            href="/admin/chat/<?= $user->oauth_uid ?>"
                            >
                            <div class="flex items-center space-x-2">
                                <em class="fas fa-user"></em>
                                <span class="text-slate-800 dark:text-navy-100"><?= $user->name ?></span>
                            </div>
                            </a>
                        </li>
                    <?php endif ?>
                  
                  <?php endforeach ?>
                  
                </ul>
                <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                
              </div>

              <div class="flex flex-col p-4">
                
              </div>
            </div>
          </div>
        </div>

        <!-- Minimized Sidebar Panel -->        
      </div>
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
            <?= $this->include('admin/layout/topbar'); ?>
          </div>
        </div>
      </nav>

      
      <!-- Main Content Wrapper -->
      <main class="main-content mail-app w-full px-[var(--margin-x)] pb-6">        
        <div
          :class="$store.breakpoints.smAndUp && 'scrollbar-sm'"w
          class="grow overflow-y-auto px-[calc(var(--margin-x)-.5rem)] py-5 transition-all duration-[.25s] message-container"
        >            
          <?php $id = ""; ?>
          <?php if ($userid == null) : ?>
              <div class="flex items-start justify-center mt-16 space-x-2.5 sm:space-x-5">
                  <div class="flex flex-col items-center space-y-3.5">                     
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16"> <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/> </svg>
                    <p>Quickprep Messanger</p>
                  </div>                            
              </div>
          <?php else : ?>
            <?php foreach($messages->getResultObject() as $message) : ?>              
              <?php if ($message->author == session()->get('oauth_uid')) : ?>
                <?php $id = $message->receiver  ?>
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
                <?php $id = $message->receiver  ?>
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
          <?php endif ?>
          
          </div>
          <?php if ($userid != null) : ?>
            <div
              class="chat-footer relative flex h-12 shrink-0 items-center justify-between border-t border-slate-150 bg-white px-[calc(var(--margin-x)-.25rem)] transition-[padding,width] duration-[.25s] dark:border-navy-600 dark:bg-navy-800"
              style="position: fixed; bottom: 0; width: 75%"
            >
              <div class="-ml-1.5 flex flex-1 space-x-2">          
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
          <?php endif ?>
      </main>

      <div
        class="fixed rounded-full bg-white dark:bg-navy-700"
      >
     
      </div>
    </div>
    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
      var url = "<?= $_SERVER['REQUEST_URI']; ?>";
      var id = "<?= $id ?>";
      console.log(url);
      console.log(id);
      $(document).on('click', '.send', function() {
            const message = $('.message').val();
            $.post('/send-message', {message: message, id: id})
                .done(function(data) {
                    const resp = JSON.parse(data);
                    $('.message-container').append('<div class="flex items-start space-x-2.5 sm:space-x-5"><div class="flex flex-col items-start space-y-3.5"><div class="mr-4 max-w-lg sm:mr-10"><div class="rounded-2xl rounded-tl-none bg-white p-3 text-slate-700 shadow-sm dark:bg-navy-700 dark:text-navy-100 message-sent">'+ message +'</div><p class="mt-1 ml-auto text-right text-xs text-slate-400 dark:text-navy-300 date-sent">'+ resp['sent'] +'</p></div></div></div>');
                    $('.message').val('');
                    
                });
            
        });    

        function scrollBottom() {
            var scrollableDiv = $('.grow');
            scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));
        }
        scrollBottom(); 

           
    </script>
  </body>
</html>
