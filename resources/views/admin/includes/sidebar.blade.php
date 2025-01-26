<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('ships.index') }}" class="nav-link">
        <i class="nav-icon fas fa-solid fa-ship"></i>
          <p>
            Корабли
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('cabins.index') }}" class="nav-link">
        <i class="nav-icon fas fa-solid fa-list"></i>
          <p>
            Каюты
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('gallery.index') }}" class="nav-link">
        <i class="nav-icon fas fa-image"></i>
          <p>
            Галерея
          </p>
        </a>
      </li>
    </ul>
  </div>
</aside>
