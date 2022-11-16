</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        globalInit()
    })

    function globalInit() {
        globalHandler()
    }

    function globalHandler() {
        $('#toogleSideBar').on('click', function () {
            $('#mobile-nav').removeClass('translate-x-[-260px]')
            $('#overlay').removeClass('hidden')
        })

        $('#overlay').on('click', function () {
            $('#mobile-nav').addClass('translate-x-[-260px]')
            $('#overlay').addClass('hidden')
        })

        $('[aria-controls="menu-dropdown"]').on('click', function () {
            const target = $(this).data('collapse-toggle')

            $(this).find('[aria-controls="menu-dropdown-icon"]').toggleClass('-rotate-90')

            const targetElement = $(this).siblings(`#${target}`)

            targetElement.toggleClass('hidden')
        })
    }
</script>

@stack('scripts')

</html>
