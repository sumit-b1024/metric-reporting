<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">Rednirus</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
              <span class="badge badge-center rounded-pill bg-danger ms-auto">5</span>
            </a>
          </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('users.index')}}" class="menu-link">
                        <div class="text-truncate" data-i18n="List">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-check-shield'></i>
                <div class="text-truncate" data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('roles.index')}}" class="menu-link">
                        <div class="text-truncate" data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('permissions.index')}}" class="menu-link">
                        <div class="text-truncate" data-i18n="Permission">Permission</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-check-shield'></i>
                <div class="text-truncate" data-i18n="Lead Management">Lead Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('lead-type.index')}}" class="menu-link">
                        <div class="text-truncate" data-i18n="Lead Type">Lead Type</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('lead-source.index')}}" class="menu-link">
                        <div class="text-truncate" data-i18n="Lead Source">Lead Source</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>