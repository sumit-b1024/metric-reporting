<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @if(Auth::guard('employee')->check() === false)
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRoles" aria-expanded="false" aria-controls="collapseRoles">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Roles & Permissions   
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseRoles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                        <a class="nav-link" href="{{route('permissions.index')}}">Permissions</a>
                    </nav>
                </div>
                
                <div class="sb-sidenav-menu-heading">Employee Management</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEmployee" aria-expanded="false" aria-controls="collapseEmployee">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Employees List   
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEmployee" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('employees.index')}}">List</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAirport" aria-expanded="false" aria-controls="collapseAirport">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Airport SIDA Badge
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAirport" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('airport-badge.index')}}">List</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSecurity" aria-expanded="false" aria-controls="collapseSecurity">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Security Guard License
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSecurity" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('security-guard-licenses.index')}}">List</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDriving" aria-expanded="false" aria-controls="collapseDriving">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Driving License
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDriving" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('driving-licenses.index')}}">List</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEightHours" aria-expanded="false" aria-controls="collapseEightHours">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    8 Hours Certificate
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEightHours" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('eight-hours-certificates.index')}}">List</a>
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </nav>
</div>