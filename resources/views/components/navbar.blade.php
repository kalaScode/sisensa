<nav class="fixed top-0 z-50 w-full lg:px-32 sm:px-6 bg-[#122036]/90 backdrop-blur-md shadow-lg z-50" >
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <a href="/menu_utama" class="flex ms-2 md:me-24">
          <img src="img/logo-sisensa.png" class="h-9 me-3" alt="sisensa" />
        </a>
      </div>
      <div class="flex items-center">
            <div>
              <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400 my-1" type="button">
                <svg class="w-6 h-6 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                  <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                </svg>
                <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-3.5 dark:border-gray-900"></div>
              </button>
              <!-- Dropdown menu -->
              <div id="dropdownNotification" class="z-20 hidden max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
                <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                  Notifications
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                  <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex-shrink-0">
                      <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                      <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                        <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                          <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                          <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                        </svg>
                      </div>
                    </div>
                    <div class="w-full ps-3">
                      <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                        New message from <span class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey, what's up? All set for the presentation?"
                      </div>
                      <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>
                    </div>
                  </a>
                  <!-- Add more notification items as needed -->
                </div>
                <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                  <div class="inline-flex items-center">
                    <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                      <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                    </svg>
                    View all
                  </div>
                </a>
              </div>
            </div>
            <!-- Profile menu -->
            <div class="flex items-center">
              <div class="flex items-center ms-3">
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                  <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900 dark:text-white" role="none">Wilfa Afriyani</p>
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">wilfa@example.com</p>
                  </div>
                  <ul class="py-1" role="none">
                    <li>
                      <a href="/profil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profil</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Keluar</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</nav>
