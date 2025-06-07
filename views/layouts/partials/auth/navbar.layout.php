<?php

use App\Core\Helpers\Csrf;

?>
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-8">
                <div class="text-xl font-bold text-blue-600">MyApp</div>
                <a href="/home" class="text-sm font-medium hover:text-blue-600">Home</a>
                <a href="/clients" class="text-sm font-medium hover:text-blue-600">Clients</a>
            </div>

            <div class="flex items-center">
                <form action="/logout" method="POST">
                    <input type="hidden" name="_csrf" value="<?= Csrf::getToken() ?>">
                    <button type="submit" title="Logout" class="text-gray-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 12h-9m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
