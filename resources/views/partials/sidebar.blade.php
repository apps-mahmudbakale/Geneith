  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('app.dashboard') }}" class="brand-link">
          <img src="{{ !empty(app(App\Settings\StoreSettings::class)->store_logo) ? asset('storage/settings/store/' . app(App\Settings\StoreSettings::class)->store_logo) : asset('assets/img/logo.png') }}"
              alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span
              class="brand-text font-weight-light">{{ app(App\Settings\StoreSettings::class)->store_name ?: 'Storeify' }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('app.dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  @can('read-users')
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-lock"></i>
                          <p>
                              Authentication
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('app.users.index') }}" class="nav-link">
                                  <i class="fa fa-users nav-icon"></i>
                                  <p>Users</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('app.roles.index') }}" class="nav-link">
                                  <i class="fa fa-universal-access nav-icon"></i>
                                  <p>Roles</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('app.stations.index') }}" class="nav-link">
                                  <i class="fa fa-building nav-icon"></i>
                                  <p>Stations</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endcan
                  @can('read-products')
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Products
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        @can('read-store')
                          <li class="nav-item">
                              <a href="{{ route('app.stores.index') }}" class="nav-link">
                                  <i class="fa fa-warehouse nav-icon"></i>
                                  <p>Stores</p>
                              </a>
                          </li>
                          @endcan
                          @can('read-products')
                          <li class="nav-item">
                              <a href="{{ route('app.products.index') }}" class="nav-link">
                                  <i class="fa fa-table nav-icon"></i>
                                  <p>Products</p>
                              </a>
                          </li>
                          @endcan
                          @can('read-request')
                          <li class="nav-item">
                              <a href="{{ route('app.requests.index') }}" class="nav-link">
                                  <i class="fa fa-random nav-icon"></i>
                                  <p>Requests</p>
                              </a>
                          </li>
                          @endcan
                      </ul>
                  </li>
                  @endcan
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-shopping-cart"></i>
                          <p>
                              Sales
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @can('create-sales')
                              <li class="nav-item">
                                  <a href="{{ route('app.sales.create') }}" class="nav-link">
                                      <i class="fa fa-cart-plus nav-icon"></i>
                                      <p>New Sale</p>
                                  </a>
                              </li>
                          @endcan
                          @can('read-return')
                          <li class="nav-item">
                              <a href="{{ route('app.returns.index') }}" class="nav-link">
                                  <i class="fa fa-ban nav-icon"></i>
                                  <p>Return Sale</p>
                              </a>
                          </li>
                          @endcan
                           <li class="nav-item">
                            <a href="{{ route('app.sales.index') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>Manage Sales</p>
                            </a>
                        </li>

                      </ul>
                  </li>
                  @can('read-reports')
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-chart-pie"></i>
                              <p>
                                  Reports
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('app.general.report') }}" class="nav-link">
                                      <i class="fa fa-table nav-icon"></i>
                                      <p>General Report</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('app.endofDay.view') }}" class="nav-link">
                                      <i class="fa fa-calendar nav-icon"></i>
                                      <p>End of Day Report</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('app.custom.report.view') }}" class="nav-link">
                                      <i class="fa fa-clock nav-icon"></i>
                                      <p>Custom Report</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  @endcan
                  @can('read-invoice')
                  <li class="nav-item">
                      <a href="{{ route('app.invoices.index') }}" class="nav-link">
                          <i class="nav-icon fa fa-file-invoice"></i>
                          <p>Invoices</p>
                      </a>
                  </li>
                  @endcan
                  @can('read-settings')
                      <li class="nav-item">
                          <a href="{{ route('app.settings.index') }}" class="nav-link">
                              <i class="nav-icon fa fa-cogs"></i>
                              <p>Settings</p>
                          </a>
                      </li>
                  @endcan
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
