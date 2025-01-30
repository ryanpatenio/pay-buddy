<!-- NAVIGATION -->
<nav id="mainNavbar" class="navbar navbar-vertical navbar-expand-lg scrollbar bg-dark navbar-dark">
    <!-- Theme configuration (navbar) -->
    <script>
        let navigationColor = localStorage.getItem('navigationColor')
          , navbar = document.getElementById('mainNavbar');

        if (navigationColor != null && navbar != null) {
            if (navigationColor == 'inverted') {
                navbar.classList.add('bg-dark', 'navbar-dark');
                navbar.classList.remove('bg-white', 'navbar-light');
            } else {
                navbar.classList.add('bg-white', 'navbar-light');
                navbar.classList.remove('bg-dark', 'navbar-dark');
            }
        }
    </script>
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="/Dashboard-admin">
           
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cloud-moon" viewBox="0 0 16 16">
                <path d="M7 8a3.5 3.5 0 0 1 3.5 3.555.5.5 0 0 0 .625.492A1.503 1.503 0 0 1 13 13.5a1.5 1.5 0 0 1-1.5 1.5H3a2 2 0 1 1 .1-3.998.5.5 0 0 0 .509-.375A3.5 3.5 0 0 1 7 8m4.473 3a4.5 4.5 0 0 0-8.72-.99A3 3 0 0 0 3 16h8.5a2.5 2.5 0 0 0 0-5z"/>
                <path d="M11.286 1.778a.5.5 0 0 0-.565-.755 4.595 4.595 0 0 0-3.18 5.003 5.5 5.5 0 0 1 1.055.209A3.6 3.6 0 0 1 9.83 2.617a4.593 4.593 0 0 0 4.31 5.744 3.58 3.58 0 0 1-2.241.634q.244.477.394 1a4.59 4.59 0 0 0 3.624-2.04.5.5 0 0 0-.565-.755 3.593 3.593 0 0 1-4.065-5.422z"/>
              </svg>
              <span class="h1">Pay Buddy</span>
        </a>
        <!-- Navbar toggler -->
        <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenavCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav mb-lg-7">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-admin') ? 'active' : '' }}" href="/Dashboard-admin" >
                        <!--Icons-->
                        <svg viewBox="0 0 24 24" class="nav-link-icon" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.753,13.944v8.25h6v-6a1.5,1.5,0,0,1,1.5-1.5h1.5a1.5,1.5,0,0,1,1.5,1.5v6h6v-8.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            <path d="M.753,12.444,10.942,2.255a1.5,1.5,0,0,1,2.122,0L23.253,12.444" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        </svg>
                        <span>Dashboards</span>
                    </a>
                   
                </li>

                <!---Transactions-->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-Transactions') ? 'active' : '' }} " href="/Dashboard-Transactions">
                        
                            <svg viewBox="0 0 24 24" class="nav-link-icon" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.75,14.25H16.717a1.342,1.342,0,0,0-.5,2.587l2.064.826a1.342,1.342,0,0,1-.5,2.587H15.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25 14.25L17.25 13.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25 21L17.25 20.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M11.250 17.250 A6.000 6.000 0 1 0 23.250 17.250 A6.000 6.000 0 1 0 11.250 17.250 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M3.75 14.25L8.25 14.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M8.25 14.25L8.25 6.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M11.25 9.75L11.25 8.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M5.25 14.25L5.25 9.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M7.5,20.25H2.25a1.43,1.43,0,0,1-1.5-1.415V2.335A1.575,1.575,0,0,1,2.25.75H12.879a1.5,1.5,0,0,1,1.06.439l2.872,2.872a1.5,1.5,0,0,1,.439,1.06V7.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                        
                        <span>Transactions</span>
                    </a>
                </li>
                <!--End of Transactions-->

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-Requests') ? 'active' : '' }} " href="/Dashboard-Requests">
                       
                            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill-exclamation text-primary" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                              </svg>
                       
                        <span>Requests</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-Users') ? 'active' : '' }} " href="/Dashboard-Users">
                       
                            <svg class="nav-link-icon" viewBox="0 0 24 24" height="18" width="18" class="text-primary" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.250 6.000 A2.250 2.250 0 1 0 6.750 6.000 A2.250 2.250 0 1 0 2.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M4.5,9.75A3.75,3.75,0,0,0,.75,13.5v2.25h1.5l.75,6H6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.250 6.000 A2.250 2.250 0 1 0 21.750 6.000 A2.250 2.250 0 1 0 17.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M19.5,9.75a3.75,3.75,0,0,1,3.75,3.75v2.25h-1.5l-.75,6H18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M9.000 3.750 A3.000 3.000 0 1 0 15.000 3.750 A3.000 3.000 0 1 0 9.000 3.750 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25,13.5a5.25,5.25,0,0,0-10.5,0v2.25H9l.75,7.5h4.5l.75-7.5h2.25Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                       
                        <span>Users</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-Api-keys') ? 'active' : '' }} " href="/Dashboard-Api-keys">                      
                        <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench" viewBox="0 0 16 16">
                            <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z"/>
                            </svg>                        
                        <span>Api Keys</span>
                    </a>
                </li>
  
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Dashboard-Logs') ? 'active' : '' }} " href="/Dashboard-Logs">                      
                        <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                          </svg>                      
                        <span>Api Logs</span>
                    </a>
                </li>

              
                <li class="nav-item w-100">
                    <hr>
                </li>

                <!--Settings--->
                <li class="nav-item">
                <a class="nav-link {{ request()->is('Dashboard-Profile-Account')  ? 'active' : '' }} " href="#pagesCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pagesCollapse">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="nav-link-icon" width="18" height="18" fill="currentColor" class="bi bi-gear" >
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>

                      </svg>
                    <span> Settings</span>
                </a>
                <div class="collapse " id="pagesCollapse">
                    <ul class="nav flex-column">
                        <li class="nav-item ">
                            <a href="/Dashboard-Profile-Account" class="nav-link ">
                                <span>Account</span>
                            </a>
                        </li>
                  
                       
                       
                        {{-- <li class="nav-item">
                            <a href="./connect-apps.html" class="nav-link ">
                                <span>Connect Apps</span>
                            </a>
                        </li> --}}
                        
                    </ul>
                </div>
            </li>
            <!--End of Settings-->
 
            </ul>
            <!-- End of Navigation -->
          
        </div>
        <!-- End of Collapse -->
    </div>
</nav>
