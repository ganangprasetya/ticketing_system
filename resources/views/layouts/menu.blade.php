<div class="sticky-top">
    <div class="container-fluid nav-top" id="navTop">
        <nav class="navbar navbar-expand-lg main-navbar">
            <div class="btn-rooms ml-2">
                ticketing system
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-profile menu-top{{ ((Request::segment(1) == "dashboard") OR (Request::segment(1) == "home")) ? ' active':'' }}"
                            href="{{ route('home') }}" onclick="clickMenu('dashboard');" data-key="dashboard">
                            <div class="icon-profile"></div> Dashboard
                        </a>
                    </li>
                    @role('administrator')
                    <li class="nav-item">
                        <a class="nav-link nav-location menu-top{{ (Request::segment(1) == "administration") ? ' active':'' }}"
                            href="#" onclick="clickMenu('administration');return false;" data-key="administration">
                            <div class="icon-location"></div> Administration
                        </a>
                    </li>
                    @endrole
                    <li class="nav-item">
                        <a class="nav-link nav-workstation menu-top{{ (Request::segment(1) == "monitoring") ? ' active':'' }}" href="#" onclick="clickMenu('monitoring');return false;" data-key="monitoring">
                            <div class="icon-workstation"></div> Monitoring
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Workstation Submenu -->
    <div class="container-fluid nav-middle{{ ((Request::segment(1) == '') || (Request::segment(1) == 'home')) ? ' d-none':'' }}" id="navMiddle">
        <nav class="navbar navbar-expand-lg main-navbar menu-dropdown{{ (Request::segment(1) != "administration") ? ' d-none':'' }}" data-pair="administration">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link menu-middle{{ (Request::segment(2) == "users") ? ' active':'' }}" href="#" onclick="clickSubmenu('manage_users');return false;" data-clicked="false" data-key="manage_users">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-middle{{ (Request::segment(2) == "companies") ? ' active':'' }}" href="#" onclick="clickSubmenu('manage_companies');return false;" data-clicked="false" data-key="manage_companies">Company Management</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg main-navbar menu-dropdown{{ (Request::segment(1) != "monitoring") ? ' d-none':'' }}" data-pair="monitoring">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link menu-middle{{ (Request::segment(2) == "tickets") ? ' active':'' }}" href="#" onclick="clickSubmenu('manage_tickets');return false;" data-clicked="false" data-key="manage_tickets">Ticket Management</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
        <div class="container-fluid nav-bottom{{ (Request::segment(2) == '') ? ' d-none':'' }}" id="navBottom">
            {{-- User Submenu --}}
            <nav class="navbar navbar-expand-lg main-navbar submenu-dropdown{{ (Request::segment(2) != "users") ? ' d-none':'' }}" data-pair="manage_users">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "users") && (Request::segment(3) == "create")) ? ' active':'' }}" href="{{ route('users.create') }}">Create User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "users") && (Request::segment(3) == "manage")) ? ' active':'' }}" href="{{ route('users.manage') }}">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "users") && (Request::segment(3) == "lists")) ? ' active':'' }}" href="{{ route('users.list') }}">List Users</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg main-navbar submenu-dropdown{{ (Request::segment(2) != "companies") ? ' d-none':'' }}" data-pair="manage_companies">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "companies") && (Request::segment(3) == "create")) ? ' active':'' }}" href="{{ route('companies.create') }}">Create Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "companies") && (Request::segment(3) == "manage")) ? ' active':'' }}" href="{{ route('companies.manage') }}">Manage Companies</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Work Station Dropdown -->
            <div id="containerWorkstationDropdown">
                <nav class="navbar navbar-expand-lg main-navbar submenu-dropdown{{ (Request::segment(2) != "tickets") ? ' d-none':'' }}" data-pair="manage_tickets">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "tickets") && (Request::segment(3) == "create")) ? ' active':'' }}" href="{{ route('tickets.create') }}">Create Ticket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "tickets") && (Request::segment(3) == "manage")) ? ' active':'' }}" href="#">Manage Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "tickets") && (Request::segment(3) == "lists")) ? ' active':'' }}" href="#">List Tickets</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
