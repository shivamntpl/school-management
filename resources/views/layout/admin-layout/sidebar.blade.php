<!-- Sidebar -->
<aside class="sidebar">
    <button class="close-sidebar">
        <i class="fas fa-times"></i>
    </button>
    <div class="logo">
        <img src="{{ asset('logo1.jpeg/')}}" alt="Logo">
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a></li>

        <li><a href="{{ route('class.list') }}" class="{{ request()->routeIs('class.list') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>Manage Class
            </a></li>

        <li><a href="{{ route('vehicle.list') }}" class="{{ request()->routeIs('vehicle.list') ? 'active' : '' }}">
                <i class="fas fa-bus-alt"></i>Manage Vehicle
            </a></li>

        <li><a href="{{ route('student.list') }}" class="{{ request()->routeIs('student.list') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Student Register
            </a></li>

        <li><a href="{{ route('fees.list') }}" class="{{ request()->routeIs('fees.list') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Fees Management
            </a></li>
        <li>
            <a href="{{ route('admin.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</aside>
<script>
const sidebar = document.querySelector('.sidebar');
const closeBtn = document.querySelector('.close-sidebar');
const toggleBtn = document.querySelector('.toggle-sidebar');

toggleBtn?.addEventListener('click', () => {
    sidebar.classList.add('active');
});

closeBtn?.addEventListener('click', () => {
    sidebar.classList.remove('active');
});
</script>