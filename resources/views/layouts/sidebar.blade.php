{{-- <div class="sidebar">
    <div class="sidebar-header">
        <img src="{{asset('logo.png')}}" alt="Logo" class="logo" />
    </div>

    <ul class="sidebar-menu">
        <li><a href="#"><i class="icon-home"></i> Dashboard</a></li>
        <li><a href="#"><i class="icon-user-md"></i> Doctor</a></li>
        <li><a href="#"><i class="icon-users"></i> All Patients</a></li>

        <li class="has-submenu">
            <input type="checkbox" id="prescriptions" />
            <label for="prescriptions"><i class="icon-prescription"></i> Prescriptions <span
                class="arrow"></span></label>
                <ul class="submenu">
                <li><a href="#">Create New</a></li>
                <li><a href="#">All Prescriptions</a></li>
            </ul>
        </li>

        <li><a href="#"><i class="icon-users"></i>Diagnostic Tests</a></li>

        <li><a href="#"><i class="icon-coins"></i> Financial Activities</a></li>
        <li class="has-submenu">
            <input type="checkbox" id="settings" />
            <label for="settings"><i class="icon-vial"></i> Settings <span class="arrow"></span></label>
            <ul class="submenu">
                <li><a href="#">General Setting</a></li>
                <li><a href="#">Fiscal Year</a></li>
            </ul>
        </li>
    </ul>
</div> --}}
<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
    </div>

    <ul class="sidebar-menu">
        <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="#"><i class="fas fa-user-md"></i> Doctor</a></li>
        <li><a href="#"><i class="fas fa-users"></i> All Patients</a></li>

        <li class="has-submenu">
            <input type="checkbox" id="prescriptions" />
            <label for="prescriptions"><i class="fas fa-prescription-bottle-alt"></i> Prescriptions <span class="arrow"></span></label>
            <ul class="submenu">
                <li><a href="#">Create New</a></li>
                <li><a href="#">All Prescriptions</a></li>
            </ul>
        </li>

        <li><a href="{{route('test.all')}}"><i class="fas fa-vials"></i> Diagnostic Tests</a></li>
        <li><a href="#"><i class="fas fa-coins"></i> Financial Activities</a></li>

        <li class="has-submenu">
            <input type="checkbox" id="settings" />
            <label for="settings"><i class="fas fa-cog"></i> Settings <span class="arrow"></span></label>
            <ul class="submenu">
                <li><a href="{{route('setting.index')}}">General Setting</a></li>
                <li><a href="#">Fiscal Year</a></li>
            </ul>
        </li>
    </ul>
</div>
