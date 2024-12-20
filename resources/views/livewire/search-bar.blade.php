<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Basic UI Elements</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('basic-ui.buttons') }}">Buttons</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('basic-ui.typography') }}">Typography</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('icons') }}">
                    <span class="menu-title">Icons</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('forms') }}">
                    <span class="menu-title">Forms</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('charts') }}">
                    <span class="menu-title">Charts</span>
                    <i class="mdi mdi-chart-bar menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tables') }}">
                    <span class="menu-title">Tables</span>
                    <i class="mdi mdi-table-large menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                    <span class="menu-title">Sample Pages</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-medical-bag menu-icon"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Blank Page </a></li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Login </a></li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Register </a></li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> 404 </a></li>
                        <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> 500 </a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item sidebar-actions">
                <span class="nav-link">
                    <div class="border-bottom">
                        <h6 class="font-weight-normal mb-3">Projects</h6>
                    </div>
                    <x-template.button color="primary" variant="gradient" size="lg" :block="true" class="mt-4"> + Add a project </x-template.button>
                    <div class="mt-4">
                        <div class="border-bottom">
                            <p class="text-secondary">Categories</p>
                        </div>
                        <ul class="gradient-bullet-list mt-4">
                            <li>Free</li>
                            <li>Pro</li>
                        </ul>
                    </div>
                </span>
            </li>
        </ul>
    </nav>