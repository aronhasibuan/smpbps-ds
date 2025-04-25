<ul>
    <li class="mb-5">
        <a href="/profile" class="block w-full px-10 rounded-md p-2 text-sm text-left {{ Request::is('profile') ? 'bg-gray-100' : 'text-gray-500 hover:bg-gray-100' }}">
            General
        </a>
    </li>
    <li>
        <a href="/profile/password" class="block w-full px-10 rounded-md p-2 text-sm text-left {{ Request::is('profile/password') ? 'bg-gray-50' : 'text-gray-500 hover:bg-gray-100' }}">
            Password
        </a>
    </li>
</ul>