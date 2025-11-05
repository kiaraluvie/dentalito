<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <!-- =========================
         AUTH MANAGEMENT
    ========================== -->
    <li class="nav-header">{{ __('sidebar.title_auth_management') }}</li>

    @canany(['roles.view', 'users.view'])
    <li class="nav-item {{ menuOpenClass(['auth_management/roles*', 'auth_management/users*']) }}">
        <a href="#" class="nav-link {{ activeClass(['auth_management/roles*', 'auth_management/users*']) }}">
            <i class="nav-icon fas fa-shield-alt"></i>
            <p>
                {{ __('sidebar.menu_auth_management') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('roles.view')
            <li class="nav-item">
                <a href="{{ route('auth_management.roles.index') }}"
                   class="nav-link {{ activeClass(['auth_management/roles*']) }}">
                                        @if(isActiveMenu(['auth_management/roles*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('roles.title') }}</p>
                </a>
            </li>
            @endcan
            @can('users.view')
            <li class="nav-item">
                <a href="{{ route('auth_management.users.index') }}"
                   class="nav-link {{ activeClass(['auth_management/users*']) }}">
                                        @if(isActiveMenu(['auth_management/users*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('sidebar.users') }}</p>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcanany

    <!-- =========================
         DENTAL MANAGEMENT
    ========================== -->
    <li class="nav-header">{{ __('sidebar.title_dental_management') }}</li>
    @canany(['patients.view', 'dentists.view', 'appointments.view', 'procedures.view', 'treatments.view', 'medical_histories.view', 'specialties.view', 'odontogram.view'])
    <li class="nav-item {{ menuOpenClass(['dental_management/*']) }}">
        <a href="#" class="nav-link {{ activeClass(['dental_management/*']) }}">
            <i class="nav-icon fas fa-tooth"></i>
            <p>
                {{ __('sidebar.menu_dental_management') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <!-- Patients -->
            @can('patients.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.patients.index') }}"
                   class="nav-link {{ activeClass(['dental_management/patients*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.patients') }}</p>
                </a>
            </li>
            @endcan
            <!-- Dentists -->
            @can('dentists.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.dentists.index') }}"
                   class="nav-link {{ activeClass(['dental_management/dentists*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.dentists') }}</p>
                </a>
            </li>
            @endcan
            <!-- Appointments -->
            @can('appointments.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.appointments.index') }}"
                   class="nav-link {{ activeClass(['dental_management/appointments*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.appointments') }}</p>
                </a>
            </li>
            @endcan
            <!-- Procedures -->
            @can('procedures.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.procedures.index') }}"
                   class="nav-link {{ activeClass(['dental_management/procedures*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.procedures') }}</p>
                </a>
            </li>
            @endcan
            <!-- Treatments -->
            @can('treatments.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.treatments.index') }}"
                   class="nav-link {{ activeClass(['dental_management/treatments*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.treatments') }}</p>
                </a>
            </li>
            @endcan
            <!-- Specialties -->
            @can('specialties.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.specialties.index') }}"
                   class="nav-link {{ activeClass(['dental_management/specialties*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.specialties') }}</p>
                </a>
            </li>
            @endcan
            <!-- Medical Histories -->
            @can('medical_histories.view')
            <li class="nav-item">
                <a href="{{ route('dental_management.medical_histories.index') }}"
                   class="nav-link {{ activeClass(['dental_management/medical_histories*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.medical_histories') }}</p>
                </a>
            </li>
            @endcan
            <!-- Odontogram -->
            @can('odontogram.view')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('sidebar.odontogram') }}</p>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcanany

    <!-- =========================
         SETTINGS
    ========================== -->
    <li class="nav-header">{{ __('sidebar.title_setting') }}</li>

    @canany(['system_modules.view', 'languages.view', 'tenants.view', 'regions.view'])
    <li class="nav-item {{ menuOpenClass(['system_management/languages*','system_management/system_modules*','system_management/tenants*','system_management/regions*']) }}">
        <a href="#" class="nav-link {{ activeClass(['system_management/languages*','system_management/system_modules*','system_management/tenants*','system_management/regions*']) }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
                {{ __('sidebar.menu_settings') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('system_modules.view')
            <li class="nav-item">
                <a href="{{ route('system_management.system_modules.index') }}"
                   class="nav-link {{ activeClass(['system_management/system_modules*']) }}">
                    @if(isActiveMenu(['system_management/system_modules*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('system_modules.plural') }}</p>
                </a>
            </li>
            @endcan

            @can('languages.view')
            <li class="nav-item">
                <a href="{{ route('system_management.languages.index') }}"
                   class="nav-link {{ activeClass(['system_management/languages*']) }}">
                    @if(isActiveMenu(['system_management/languages*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('languages.plural') }}</p>
                </a>
            </li>
            @endcan

            @can('tenants.view')
            <li class="nav-item">
                <a href="{{ route('system_management.tenants.index') }}"
                   class="nav-link {{ activeClass(['system_management/tenants*']) }}">
                    @if(isActiveMenu(['system_management/tenants*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('tenants.plural') }}</p>
                </a>
            </li>
            @endcan

            @can('regions.view')
            <li class="nav-item">
                <a href="{{ route('system_management.regions.index') }}"
                   class="nav-link {{ activeClass(['system_management/regions*']) }}">
                    @if(isActiveMenu(['system_management/regions*']))
                        <i class="fas fa-check-circle nav-icon"></i>
                    @else
                        <i class="far fa-circle nav-icon"></i>
                    @endif
                    <p>{{ __('regions.plural') }}</p>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcanany
</ul>