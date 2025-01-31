        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          @if (auth()->user()->id_divisi == 2)
              
          @endif
          <li class="nav-item {{ request()->is('user*','finished-goods*','benang*','greige*','supplier*','gudang*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('user*','finished-goods*','benang*','greige*','supplier*','gudang*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (auth()->user()->id_jabatan == 1 OR auth()->user()->id_jabatan == 3 OR auth()->user()->id_jabatan == 5)
                  <li class="nav-item">
                <a href="/user" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                  <i class="far fa-user nav-icon"></i>
                  <p>01 User</p>
                </a>
              </li>
              @endif
              
              
              <li class="nav-item">
                <a href="/finished-goods" class="nav-link {{ request()->is('finished-goods*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    02 Finished Goods
                  </p>
                </a>
              </li>
              @if (auth()->user()->id_divisi == 1 OR auth()->user()->id_divisi == 3 )
              <li class="nav-item">
                <a href="/benang" class="nav-link {{ request()->is('benang*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    03 Benang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/greige" class="nav-link {{ request()->is('greige*') ? 'active' : '' }}">
                  <i class="far fas fa-box nav-icon"></i>
                  <p>
                    04 Greige
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
              @endif
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
                  <p>01 Finished Goods</p>
                </a>
              </li>
              @if (auth()->user()->id_divisi == 1 OR auth()->user()->id_divisi == 3 )
              <li class="nav-item">
                <a href="/stockgreige" class="nav-link {{ request()->is('stockgreige') ? 'active' : '' }}">
                  <i class="far fas fa-info nav-icon"></i>
                  <p>
                    02 Greige
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/stockbenang" class="nav-link {{ request()->is('stockbenang') ? 'active' : '' }}">
                  <i class="far fas fa-info nav-icon"></i>
                  <p>
                    03 Benang
                  </p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if (auth()->user()->id_divisi == 1 )
          <li class="nav-item {{ request()->is('pobenang*','pogreige*','pomaklontwisting*','pomaklondf*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('pobenang*','pogreige*','pomaklontwisting*','pomaklondf*') ? 'active' : '' }}">
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
                  <p>01 Benang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pogreige" class="nav-link {{ request()->is('pogreige*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>02 Greige</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pomaklontwisting" class="nav-link {{ request()->is('pomaklontwisting*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    03 Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pomaklondf" class="nav-link {{ request()->is('pomaklondf*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    04 Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('gipenjualan*','gitwisting*','gidf*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('gipenjualan*','gitwisting*','gidf*') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-truck-loading"></i>
              <p>
                Goods Issue
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/gipenjualan" class="nav-link {{ request()->is('gipenjualan*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>01 Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gitwisting" class="nav-link {{ request()->is('gitwisting*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    02 Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gidf" class="nav-link {{ request()->is('gidf*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    03 Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('grpobenang*','grpogreige*','grtwisting*','grdyeingfinishing*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('grpobenang*','grpogreige*','grtwisting*','grdyeingfinishing*') ? 'active' : '' }}"">
              <i class="nav-icon fas fa-truck fa-flip-horizontal"></i>
              <p>
                Goods Receipt
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/grpobenang" class="nav-link {{ request()->is('grpobenang*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>01 Benang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grpogreige" class="nav-link {{ request()->is('grpogreige*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>02 Greige</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grtwisting" class="nav-link {{ request()->is('grtwisting*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    03 Maklon Twisting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/grdyeingfinishing" class="nav-link {{ request()->is('grdyeingfinishing*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    04 Maklon Dyeing Finishing
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('returbeli','returjual') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('returbeli','returjual') ? 'active' : '' }}">
              <i class="nav-icon fas fa-redo-alt"></i>
              <p>
                Retur
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/returjual" class="nav-link {{ request()->is('returjual') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>01 Retur Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/returbeli" class="nav-link {{ request()->is('returbeli') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>
                    02 Retur Pembelian/Maklon
                  </p>
                </a>
              </li>
            </ul>
          </li>
          @endif 
            @if (auth()->user()->id_divisi == 1 OR auth()->user()->id_divisi == 3 )
          <li class="nav-item {{ request()->is('kartustok*','stokopname*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('kartustok*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-invoice fa-flip-horizontal"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/kartustok" class="nav-link {{ request()->is('kartustok*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>01 Kartu Stok</p>
                </a>
              </li>
            </ul>
            @endif 
            @if (auth()->user()->id_divisi == 1 )
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/stokopname" class="nav-link {{ request()->is('stokopname*') ? 'active' : '' }}">
                  <i class="far fab fa-adobe nav-icon"></i>
                  <p>02 Stock Opname Awal</p>
                </a>
              </li>
            </ul>
            @endif 
          </li>
            
        </ul>