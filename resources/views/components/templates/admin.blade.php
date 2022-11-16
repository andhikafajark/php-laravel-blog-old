@include('components.organisms.header.admin')

<main>
    <div class="flex flex-no-wrap">

        @include('components.organisms.sidebar.admin')

        <div class="w-full">

            @include('components.organisms.topbar.admin')

            <div class="h-[calc(100vh-4rem)] w-full px-6 py-10 overflow-y-scroll">

                @include('components.organisms.breadcrumb.admin')

                @yield('content')

            </div>
        </div>
    </div>
</main>
<div id="overlay" class="hidden"></div>

@include('components.organisms.footer.admin')
