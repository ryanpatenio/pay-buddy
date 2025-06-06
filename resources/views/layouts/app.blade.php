<!DOCTYPE html>
<html lang="en" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="Webinning" name="author">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Theme CSS -->
        
        <link rel="stylesheet" href="{{asset('assets/css/theme.bundle.css')}}" id="stylesheetLTR">
        <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap">
        <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap">
         {{-- Css style for 144hz up --}}
        <style>
            /* 1. Fix collapsing animation for high refresh rates */
            .collapsing {
                transition: height 0.2s cubic-bezier(0.4, 0, 0.2, 1); /* Smoother curve */
                will-change: height; /* Helps browsers optimize */
            }

            /* 2. Stabilize dropdown positioning */
            .navbar-collapse {
                transform: translate3d(0, 0, 0);
                backface-visibility: hidden;
            }

            /* 3. Smoother dropdown appearance with fade */
            .dropdown-menu {              
                transition: opacity 0.2s ease, transform 0.2s ease; /* Fade + slide */             
            }

            .dropdown-menu.show {
                opacity: 1;
                visibility: visible;
            }

            /* 4. Fix for navbar-toggler animation */
            .navbar-toggler {
                 transition: transform 0.2s ease;
            }

            .navbar-toggler[aria-expanded="true"] {
                 transform: rotate(90deg);
            }
        </style>
        <!-- no-JS fallback -->
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap">
        </noscript>
        <script>
            // Theme switcher

            let themeSwitcher = document.getElementById('themeSwitcher');

            const getPreferredTheme = () => {
                if (localStorage.getItem('theme') != null) {
                    return localStorage.getItem('theme');
                }

                return document.documentElement.dataset.theme;
            }
            ;

            const setTheme = function(theme) {
                if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                } else {
                    document.documentElement.dataset.theme = theme;
                }

                localStorage.setItem('theme', theme);
            };

            const showActiveTheme = theme => {
                const activeBtn = document.querySelector(`[data-theme-value="${theme}"]`);

                document.querySelectorAll('[data-theme-value]').forEach(element => {
                    element.classList.remove('active');
                }
                );

                activeBtn && activeBtn.classList.add('active');

                // Set button if demo mode is enabled
                document.querySelectorAll('[data-theme-control="theme"]').forEach(element => {
                    if (element.value == theme) {
                        element.checked = true;
                    }
                }
                );
            }
            ;

            function reloadPage() {
                window.location = window.location.pathname;
            }

            setTheme(getPreferredTheme());

            if (typeof themeSwitcher != 'undefined') {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (localStorage.getItem('theme') != null) {
                        if (localStorage.getItem('theme') == 'auto') {
                            reloadPage();
                        }
                    }
                }
                );

                window.addEventListener('load', () => {
                    showActiveTheme(getPreferredTheme());

                    document.querySelectorAll('[data-theme-value]').forEach(element => {
                        element.addEventListener('click', () => {
                            const theme = element.getAttribute('data-theme-value');

                            localStorage.setItem('theme', theme);
                            reloadPage();
                        }
                        )
                    }
                    )
                }
                );
            }
        </script>
        <!-- Favicon -->
        <link rel="icon" href="./assets/favicon/favicon.ico" sizes="any">
        <!-- Demo script -->
        <script>
            var themeConfig = {
                theme: JSON.parse('"light"'),
                isRTL: JSON.parse('false'),
                isFluid: JSON.parse('true'),
                sidebarBehaviour: JSON.parse('"fixed"'),
                navigationColor: JSON.parse('"inverted"')
            };

            var isRTL = localStorage.getItem('isRTL') === 'true'
              , isFluid = localStorage.getItem('isFluid') === 'true'
              , theme = localStorage.getItem('theme')
              , sidebarSizing = localStorage.getItem('sidebarSizing')
              , linkLTR = document.getElementById('stylesheetLTR')
              , linkRTL = document.getElementById('stylesheetRTL')
              , html = document.documentElement;

            if (isRTL) {
                // linkLTR.setAttribute('disabled', '');
                // linkRTL.removeAttribute('disabled');
                // html.setAttribute('dir', 'rtl');
            } else {
                // linkRTL.setAttribute('disabled', '');
                // linkLTR.removeAttribute('disabled');
                html.removeAttribute('dir');
            }
        </script>

    <script>
        let themeAttrs = document.documentElement.dataset;

        for (let attr in themeAttrs) {
            if (localStorage.getItem(attr) != null) {
                document.documentElement.dataset[attr] = localStorage.getItem(attr);

                if (theme === 'auto') {
                    document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        e.matches ? document.documentElement.dataset.theme = 'dark' : document.documentElement.dataset.theme = 'light';
                    }
                    );
                }
            }
        }
    </script>
    
    <!--Jquery-->
    <script src="{{asset('assets/js/jquery.js')}}"></script>

        <!-- Page Title -->
        <title>@yield('title', 'Pay Buddy')</title>

        <script src="{{ asset('assets/js/axios/axios.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script src="{{asset('assets/swal/sweet.js')}}"></script> {{--Sweet alert Lib--}}
        <script src="{{asset('assets/js/custom_helper/helper.js')}}"></script>  {{--helper--}}

    </head>
    <body>
          <!-- Loading Spinner -->
          <div id="loading-container" style="display: none !important;">
            <div id="loading-spinner" class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
        </div> 
        {{-- Header --}}
        @include('users.layouts.nav')

        <!-- MAIN CONTENT -->
        <main>
            @include('users.layouts.header')

            @yield('content')
        </main>

        {{-- Footer --}}
       
        @include('users.layouts.footer') <!-- Reusable footer -->


        <script src="{{URL::asset('assets/js/theme.bundle.js')}}"></script>
        <script src="{{asset('assets/js/userUi_updates/ui.js')}}"></script>

    </body>
    </html>
