<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      @foreach ($items as $item )
      <li class="nav-item">
        <a href="{{ route($item['route']) }}" class="nav-link">
          <i class="nav-icon {{$item['icon']}}"></i>
          <p>
            {{$item['title']}}
          </p>
        </a>
      </li>
      @endforeach
       <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item menu">
        <a href="#" class="nav-link ">
          <i class="fas fa-file-alt"></i>
          <p>
            Reports
          <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="{{ route('reports.leads_by_stage') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Reports Leads By Stage</p>
               </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('reports.agent_performance') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reports Agent Performance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('reports.tasks') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reports Tasks</p>
              </a>
            </li>  
            <li class="nav-item">
              <a href="{{ route('reports.custom') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reports Custom</p>
              </a>
            </li>
          </ul>
    </li>
    </ul>
  </nav>
