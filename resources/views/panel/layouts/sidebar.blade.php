  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">
          @php
              $PermissionDashboard = App\Models\PermissionRoleModel::getPermission('Dashboard', Auth::user()->role_id);
              $PermissionKontrak = App\Models\PermissionRoleModel::getPermission('Kontrak', Auth::user()->role_id);
              $PermissionP1 = App\Models\PermissionRoleModel::getPermission('P1', Auth::user()->role_id);
              $PermissionP2 = App\Models\PermissionRoleModel::getPermission('P2', Auth::user()->role_id);
              $PermissionP3 = App\Models\PermissionRoleModel::getPermission('P3', Auth::user()->role_id);
              $PermissionP4 = App\Models\PermissionRoleModel::getPermission('P4', Auth::user()->role_id);
              $PermissionP5 = App\Models\PermissionRoleModel::getPermission('P5', Auth::user()->role_id);
              $PermissionP6 = App\Models\PermissionRoleModel::getPermission('P6', Auth::user()->role_id);
              $PermissionP7 = App\Models\PermissionRoleModel::getPermission('P7', Auth::user()->role_id);
              $PermissionP8 = App\Models\PermissionRoleModel::getPermission('P8', Auth::user()->role_id);
              $PermissionKL = App\Models\PermissionRoleModel::getPermission('KL', Auth::user()->role_id);
              $PermissionBASO = App\Models\PermissionRoleModel::getPermission('BASO', Auth::user()->role_id);
              $PermissionBAST = App\Models\PermissionRoleModel::getPermission('BAST', Auth::user()->role_id);
              $PermissionBAUT = App\Models\PermissionRoleModel::getPermission('BAUT', Auth::user()->role_id);
              $PermissionBARD = App\Models\PermissionRoleModel::getPermission('BARD', Auth::user()->role_id);
              $PermissionBAA = App\Models\PermissionRoleModel::getPermission('BAA', Auth::user()->role_id);
              $PermissionBAI = App\Models\PermissionRoleModel::getPermission('BAI', Auth::user()->role_id);
              $PermissionBA = App\Models\PermissionRoleModel::getPermission('BA', Auth::user()->role_id);
              $PermissionRole = App\Models\PermissionRoleModel::getPermission('Role', Auth::user()->role_id);

              $getRoleName = App\Models\User::getRecord();
          @endphp

          @if (!empty($PermissionDashboard))
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(2) != 'user') collapsed @endif " href="{{ url('panel/user') }}">
                      <i class="bi bi-grid-1x2"></i>
                      <span>Dashboard</span>
                  </a>
              </li><!-- End Dashboard Nav -->
          @endif
          @if (!empty($PermissionKontrak))
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(2) != 'kontrak') collapsed @endif"
                      href="{{ url('panel/kontrak') }}">
                      <i class="bi bi-journal-text"></i>
                      <span>Kontrak</span>
                  </a>
              </li>
          @endif

          <li class="nav-item">
              <a class="nav-link @if (Request::segment(2) != 'obl') collapsed @endif" data-bs-target="#components-nav"
                  data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>OBL</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  @if (!empty($PermissionP1))
                      <li>
                          <a href="{{ url('panel/obl/p1') }}" class="@if (Request::segment(2) != 'p1') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P1</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP2))
                      <li>
                          <a href="{{ url('panel/obl/p2') }}" class="@if (Request::segment(2) != 'p2') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P2</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP3))
                      <li>
                          <a href="{{ url('panel/obl/p3') }}" class="@if (Request::segment(2) != 'p3') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P3</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP4))
                      <li>
                          <a href="{{ url('panel/obl/p4') }}" class="@if (Request::segment(2) != 'p4') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P4</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP5))
                      <li>
                          <a href="{{ url('panel/obl/p5') }}" class="@if (Request::segment(2) != 'p5') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P5</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP6))
                      <li>
                          <a href="{{ url('panel/obl/p6') }}" class="@if (Request::segment(2) != 'p6') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P6</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP7))
                      <li>
                          <a href="{{ url('panel/obl/p7') }}" class="@if (Request::segment(2) != 'p7') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P7</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionP8))
                      <li>
                          <a href="{{ url('panel/obl/p8') }}" class="@if (Request::segment(2) != 'p8') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>P8</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionKL))
                      <li>
                          <a href="{{ url('panel/obl/kl') }}" class="@if (Request::segment(2) != 'kl') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>KL/SP/WO</span>
                          </a>
                      </li>
                  @endif
              </ul>
          </li><!-- End OBL Nav -->

          <li class="nav-item">
              <a class="nav-link @if (Request::segment(2) != 'closing') collapsed @endif" data-bs-target="#forms-nav"
                  data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Closing</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  @if (!empty($PermissionBASO))
                      <li>
                          <a href="{{ url('panel/closing/baso') }}" class="@if (Request::segment(2) != 'baso') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BASO</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionBAST))
                      <li>
                          <a href="{{ url('panel/closing/bast') }}" class="@if (Request::segment(2) != 'bast') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BAST</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionBAUT))
                      <li>
                          <a href="{{ url('panel/closing/baut') }}" class="@if (Request::segment(2) != 'baut') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BAUT</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionBARD))
                      <li>
                          <a href="{{ url('panel/closing/bard') }}" class="@if (Request::segment(2) != 'bard') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BARD</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionBAA))
                      <li>
                          <a href="{{ url('panel/closing/baa') }}" class="@if (Request::segment(2) != 'baa') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BAA</span>
                          </a>
                      </li>
                  @endif
                  @if (!empty($PermissionBAI))
                      <li>
                          <a href="{{ url('panel/closing/bai') }}" class="@if (Request::segment(2) != 'bai') collapsed @endif">
                              <i class="bi bi-circle-fill"></i><span>BAI</span>
                          </a>
                      </li>
                  @endif
              </ul>
          </li><!-- End Closing Nav -->

          @if (!empty($PermissionBA))
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(2) != 'ba') collapsed @endif" href="{{ url('panel/ba') }}">
                      <i class="bi bi-journal-text"></i>
                      <span>Berita Acara</span>
                  </a>
              </li>
          @endif
          @if (!empty($PermissionRole))
              <li class="nav-item">
                  <a class="nav-link @if (Request::segment(2) != 'role') collapsed @endif"
                      href="{{ url('panel/role') }}">
                      <i class="bi bi-gear-wide-connected"></i>
                      <span>Role</span>
                  </a>
              </li>
          @endif

          <li class="nav-item">
              <a class="nav-link collapsed nav-logout" href="{{ url('logout') }}">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Logout</span>
              </a>
          </li>
      </ul>


  </aside><!-- End Sidebar-->
