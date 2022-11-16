<!-- Sidebar -->
<div class="w-64 absolute sm:relative bg-gray-800 shadow md:h-screen flex-col hidden sm:flex">
    <div class="px-4">
        <div class="h-16 w-full flex items-center justify-center">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg1.svg" alt="Logo">
        </div>
    </div>
    <div class="px-4 overflow-y-auto">
        <ul class="mt-6">
            <li class="flex w-full justify-between text-gray-300 cursor-pointer items-center mb-6">
                <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                    </svg>
                    <span class="text-sm ml-2">Dashboard</span>
                </a>
                <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">5</div>
            </li>
            <li class="mb-6">
                <div class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center" aria-controls="menu-dropdown" data-collapse-toggle="dropdown-example">
                    <button class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <polyline points="12 4 4 8 12 12 20 8 12 4" />
                            <polyline points="4 12 12 16 20 12" />
                            <polyline points="4 16 12 20 20 16" />
                        </svg>
                        <span class="text-sm ml-2">Blog</span>
                    </button>
                    <div class="flex gap-2">
                    <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>
                    <svg class="w-6 h-6 transition duration-300 -rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-controls="menu-dropdown-icon">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    </div>
                </div>
                <ul id="dropdown-example" class="flex flex-col gap-3 pt-3 ml-5 hidden">
                    <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 items-center">
                        <a href="{{ route('blog.index') }}" class="flex items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="text-sm ml-2">Blog</span>
                        </a>
{{--                        <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>--}}
                    </li>
                    <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 items-center">
                        <a href="{{ route('blog-category.index') }}" class="flex items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="text-sm ml-2">Blog Category</span>
                        </a>
{{--                        <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>--}}
                    </li>
                </ul>
            </li>
        </ul>
        {{--                <div class="flex justify-center mt-48 mb-4 w-full">--}}
        {{--                    <div class="relative">--}}
        {{--                        <div class="text-gray-300 absolute ml-4 inset-0 m-auto w-4 h-4">--}}
        {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg2.svg" alt="Search">--}}
        {{--                        </div>--}}
        {{--                        <input class="bg-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-100 rounded w-full text-sm text-gray-300 placeholder-gray-400 bg-gray-100 pl-10 py-2" type="text" placeholder="Search" />--}}
        {{--                    </div>--}}
        {{--                </div>--}}
    </div>
    {{--            <div class="px-4 border-t border-gray-700">--}}
    {{--                <ul class="w-full flex items-center justify-between bg-gray-800">--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="show notifications" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg3.svg" alt="notifications">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open chats" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg4.svg" alt="chat">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open settings" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg5.svg" alt="settings">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open logs" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg6.svg" alt="drawer">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
</div>
<div class="overflow-y-auto w-64 z-40 absolute bg-gray-800 shadow h-screen flex-col justify-between sm:hidden translate-x-[-260px] transition duration-150 ease-in-out" id="mobile-nav">
    <div class="px-4">
        <div class="h-16 w-full flex items-center justify-center">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg1.svg" alt="Logo">
        </div>
        <ul class="mt-6">
            <li class="flex w-full justify-between text-gray-300 cursor-pointer items-center mb-6">
                <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                    </svg>
                    <span class="text-sm ml-2">Dashboard</span>
                </a>
                <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">5</div>
            </li>
            <li class="mb-6">
                <div class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center" aria-controls="menu-dropdown" data-collapse-toggle="dropdown-example">
                    <button class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <polyline points="12 4 4 8 12 12 20 8 12 4" />
                            <polyline points="4 12 12 16 20 12" />
                            <polyline points="4 16 12 20 20 16" />
                        </svg>
                        <span class="text-sm ml-2">Blog</span>
                    </button>
                    <div class="flex gap-2">
                        <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>
                        <svg class="w-6 h-6 transition duration-300 -rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-controls="menu-dropdown-icon">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <ul id="dropdown-example" class="flex flex-col gap-3 pt-3 ml-5 hidden">
                    <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 items-center">
                        <a href="{{ route('blog.index') }}" class="flex items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="text-sm ml-2">Blog</span>
                        </a>
                        {{--                        <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>--}}
                    </li>
                    <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 items-center">
                        <a href="{{ route('blog-category.index') }}" class="flex items-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="text-sm ml-2">Blog Category</span>
                        </a>
                        {{--                        <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">8</div>--}}
                    </li>
                </ul>
            </li>
        </ul>
        {{--                <div class="flex justify-center mt-48 mb-4 w-full">--}}
        {{--                    <div class="relative">--}}
        {{--                        <div class="text-gray-300 absolute ml-4 inset-0 m-auto w-4 h-4">--}}
        {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg2.svg" alt="Search">--}}
        {{--                        </div>--}}
        {{--                        <input class="bg-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-100  rounded w-full text-sm text-gray-300 placeholder-gray-400 bg-gray-100 pl-10 py-2" type="text" placeholder="Search" />--}}
        {{--                    </div>--}}
        {{--                </div>--}}
    </div>
    {{--            <div class="px-8 border-t border-gray-700">--}}
    {{--                <ul class="w-full flex items-center justify-between bg-gray-800">--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="show notifications" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg3.svg" alt="notifications">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open chats" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg4.svg" alt="chat">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open settings" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg5.svg" alt="settings">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                    <li class="cursor-pointer text-white pt-5 pb-3">--}}
    {{--                        <button aria-label="open logs" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">--}}
    {{--                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg6.svg" alt="drawer">--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
</div>
<!-- End Sidebar -->
