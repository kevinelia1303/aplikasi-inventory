        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('user*','finished-goods*','benang*','greige*','supplier*','gudang*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('user*','finished-goods*','benang*','greige*','supplier*','gudang*') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/user" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                  <i class="far fa-user nav-icon"></i>
                  <p>01 User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/finished-goods" class="nav-link {{ request()->is('finished-goods*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    02 Finished Goods
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/greige" class="nav-link {{ request()->is('greige*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    03 Greige
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/benang" class="nav-link {{ request()->is('benang*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    04 Benang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/supplier" class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}">
                  <i class="far far fa-handshake nav-icon"></i>
                  <p>
                    05 Supplier
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gudang" class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}">
                  <i class="far  	fas fa-warehouse  nav-icon"></i>
                  <p>
                    06 Gudang
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('stockfg','stockbenang','stockgreige') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('stockfg','stockbenang','stockgreige') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Stock Information
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/stockfg" class="nav-link {{ request()->is('stockfg') ? 'active' : '' }}">
                  <i class="far fas fa-info nav-icon"></i>
                  <p>Stock Finished Goods</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/stockgreige" class="nav-link {{ request()->is('stockgreige') ? 'active' : '' }}">
                  <i class="far fas fa-info nav-icon"></i>
                  <p>
                    Stock Greige
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/stockbenang" class="nav-link {{ request()->is('stockbenang') ? 'active' : '' }}">
                  <i class="far fas fa-info nav-icon"></i>
                  <p>
                    Stock Benang
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('pobenang*','pogreige*','maklontwisting*','maklondf*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('pobenang*','pogreige*','maklontwisting*','maklondf*') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Purchase Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pobenang" class="nav-link {{ request()->is('pobenang*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>PO Benang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pogreige" class="nav-link {{ request()->is('pogreige*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>PO Greige</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/maklontwisting" class="nav-link {{ request()->is('maklontwisting*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/maklondf" class="nav-link {{ request()->is('maklondf*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('gipenjualan','gitwisting','gidyeingfinishing') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('gipenjualan','gitwisting','gidyeingfinishing') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-truck-loading"></i>
              <p>
                Goods Issue
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/gipenjualan" class="nav-link {{ request()->is('gipenjualan') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>Goods Issue Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gitwisting" class="nav-link {{ request()->is('gitwisting') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    GI Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gidyeingfinishing" class="nav-link {{ request()->is('gidyeingfinishing') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    GI Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('grpobenang','grpogreige','grtwisting','grdyeingfinishing') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('grpobenang','grpogreige','grtwisting','grdyeingfinishing') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-truck fa-flip-horizontal"></i>
              <p>
                Goods Receipt
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/grpobenang" class="nav-link {{ request()->is('grpobenang') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>GR PO Benang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grpogreige" class="nav-link {{ request()->is('grpogreige') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>GR PO Greige</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grtwisting" class="nav-link {{ request()->is('grtwisting') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    GR Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grdyeingfinishing" class="nav-link {{ request()->is('grdyeingfinishing') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    GR Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>   
        </ul>