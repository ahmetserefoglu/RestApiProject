 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/superadmin" class="brand-link">
    <!--dist/img/AdminLTELogo.png -->
    <img src="dist/img/AdminLTELogox.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Y.Panel({{Auth::user()->rolename}})</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="/profile" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                Muhasebe
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/faturalar" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faturalar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gelir" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gelirler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/odemeler" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ödemeler</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/arizabildirim" class="nav-link">
              <i class="nav-icon far fa-sad-tear"></i>
              <p>
                Arıza Bildirimi
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/siparis" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Sipariş Sistemi
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/degerlendirme" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Değerlendirme Sistemi
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/aracplaka" class="nav-link">
              <i class="nav-icon fas fa-car-alt"></i>
              <p>
                Araç Plaka Kaydı
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Ayarlar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/siteyonetim" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Yönetim Ayarları</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="/sitesakinleri" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Sakinleri Ayarları</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="/kullanicilar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kullanıcı Ayarları</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/yetkiler" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yetkiler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/ayarlarim" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ayarlarım</p>
                </a>
              </li>
            </ul>
          </li>
         <li class="nav-item">
            <a href="/sosyal" class="nav-link">
              <i class="nav-icon  fas fa-copy"></i>
              <p>
               Sosyal Paylaşımlar
               <span class="right badge badge-danger"></span>
             </p>
           </a>
         </li>
        <li class="nav-item">

          <a href="/logout"  class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Çıkış Yap</p>
          </a>

          <form id="logout-form" action="/logout" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
