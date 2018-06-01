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
                        <a class="nav-link nav-workstation menu-top{{ (Request::segment(1) == "workstation") ? ' active':'' }}" href="#" onclick="clickMenu('workstation');return false;" data-key="workstation">
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
                        <a class="nav-link menu-middle{{ (Request::segment(2) == "customers") ? ' active':'' }}" href="#" onclick="clickSubmenu('manage_customers');return false;" data-clicked="false" data-key="manage_customers">Customer Management</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg main-navbar menu-dropdown{{ (Request::segment(1) != "workstation") ? ' d-none':'' }}" data-pair="workstation">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link menu-middle{{ (Request::segment(2) == "ticketing") ? ' active':'' }}" href="#" onclick="clickSubmenu('ticketing');return false;" data-clicked="false" data-key="ticketing">Ticket Management</a>
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
            <nav class="navbar navbar-expand-lg main-navbar submenu-dropdown{{ (Request::segment(2) != "customers") ? ' d-none':'' }}" data-pair="manage_customers">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "customers") && (Request::segment(3) == "create")) ? ' active':'' }}" href="#">Create Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ ((Request::segment(2) == "customers") && (Request::segment(3) == "manage")) ? ' active':'' }}" href="#">Manage Customers</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Work Station Dropdown -->
            <div id="containerWorkstationDropdown">
                <nav class="navbar navbar-expand-lg main-navbar submenu-dropdown{{ (Request::segment(2) != "ticketing") ? ' d-none':'' }}" data-pair="ticketing">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "ticketing") && (Request::segment(3) == "create")) ? ' active':'' }}" href="#">Create Ticket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "ticketing") && (Request::segment(3) == "manage")) ? ' active':'' }}" href="#">Manage Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ ((Request::segment(2) == "ticketing") && (Request::segment(3) == "lists")) ? ' active':'' }}" href="#">List Tickets</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
