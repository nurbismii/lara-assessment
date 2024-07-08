<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Bonus & Tunjangan</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard 仪表板</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Menu
  </div>

  <li class="nav-item {{ request()->routeIs('employee.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('employee.index') }}">
      <i class="fas fa-fw fa-user-circle"></i>
      <span>Karyawan 工人</span>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.index') }}">
      <i class="fas fa-fw fa-user-check"></i>
      <span>Pengguna 用户</span>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('evaluation.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('evaluation.index') }}">
      <i class="fas fa-fw fa-pen"></i>
      <span>Penilaian 评估</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  @if(Auth::user()->level_access == 1)
  <!-- Heading -->
  <div class="sidebar-heading">
    Pengaturan 设置
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ request()->routeIs('group.index') || request()->routeIs('group-member.index') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrup" aria-expanded="true" aria-controls="collapseGrup">
      <i class="fas fa-fw fa-users"></i>
      <span>Grup 团体</span>
    </a>
    <div id="collapseGrup" class="collapse {{ request()->routeIs('group.index') || request()->routeIs('group-member.index') ? 'show' : '' }}" aria-labelledby="headingGrup" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom komponen:</h6>
        <a class="collapse-item {{ request()->routeIs('group.index') ? 'active' : '' }}" href="{{ route('group.index') }}">Grup 团体</a>
        <a class="collapse-item {{ request()->routeIs('group-member.index') ? 'active' : '' }}" href="{{ route('group-member.index') }}">Anggota Grup 团队成员</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ request()->routeIs('assessment-aspect.index') || request()->routeIs('perform-achievement.index') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenyesuaian" aria-expanded="true" aria-controls="collapsePenyesuaian">
      <i class="fas fa-fw fa-cog"></i>
      <span>Penyesuaian 设置</span>
    </a>
    <div id="collapsePenyesuaian" class="collapse {{ request()->routeIs('assessment-aspect.index') || request()->routeIs('perform-achievement.index') ? 'show' : '' }}" aria-labelledby="headingPenyesuaian" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom komponen:</h6>
        <a class="collapse-item {{ request()->routeIs('assessment-aspect.index') ? 'active' : '' }}" href="{{ route('assessment-aspect.index') }}">Aspek Penilaian 评估方面</a>
        <a class="collapse-item {{ request()->routeIs('perform-achievement.index') ? 'active' : '' }}" href="{{ route('perform-achievement.index') }}">Pencapaian Kinerja 业绩成就</a>
      </div>
    </div>
  </li>
  @endif

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>