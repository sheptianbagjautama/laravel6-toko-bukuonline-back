<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('assets/dist/img/book-shop.png') }} " alt="AdminLTE Logo" class="brand-image"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Toko Buku Online</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('assets/dist/img/person.png') }} " class="" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">
                    {{ Auth::user()->email }}
                  {{-- Alexander Pierce --}}
                </a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2" id="menu-sidebar">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ (request()->is('users')) ? 'active' : '' }}">
                      <i class="nav-icon fa fa-user-circle"></i>
                      <p>
                        Data Pengguna
                      </p>
                    </a>
                  </li>

            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }}">
                    <i class="nav-icon fa fa-server"></i>
                    <p>
                    Data Kategori
                    </p>
                </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('books.index') }}" class="nav-link {{ (request()->is('books')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                        Data Buku
                        </p>
                    </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ (request()->is('orders')) ? 'active' : '' }}">
                              <i class="nav-icon fa fa-shopping-basket"></i>
                              <p>
                              Data Order
                              </p>
                          </a>
                          </li>

              <li class="nav-item">
                <form action="{{ route("logout") }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-block" style="cursor:pointer"><i class="nav-icon fa fa-sign-out"></i> Sign Out</button>
                </form>
    
                {{-- <a href="{{ route('logout') }}" class="nav-link">
                  <i class="nav-icon fa fa-sign-out"></i>
                  <p>
                    Sign Out
                  </p>
                </a> --}}
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>