window.addEventListener('load', function () {
    const burger = document.getElementById('jb-burger-btn')
    const close = document.getElementById('jb-close-menu')
    const menu = document.getElementById('jb-mobile-menu')

    if (burger && close && menu) {
        const openMenu = function () {
            menu.classList.remove('hidden')
            window.setTimeout(function () {
                menu.classList.remove('translate-x-full')
            }, 10)
            document.body.style.overflow = 'hidden'
            burger.setAttribute('aria-expanded', 'true')
        }

        const closeMenu = function () {
            menu.classList.add('translate-x-full')
            burger.setAttribute('aria-expanded', 'false')
            document.body.style.overflow = ''
            window.setTimeout(function () {
                menu.classList.add('hidden')
            }, 300)
        }

        burger.addEventListener('click', function () {
            openMenu()
        })

        close.addEventListener('click', function () {
            closeMenu()
        })
    }
})
