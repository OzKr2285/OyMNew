
<div class="sidebar">
<div class="page-wrapper legacy-theme toggled">

<!-- <a id="toggle-sidebar" class="btn btn-sm btn-dark " href="#">
    <i class="icon-menu"></i>
</a> -->
<nav id="sidebar" class="sidebar-wrapper sidebar-nav">

    <div class="sidebar-content ">
        <div class="sidebar-brand">
            <!-- <a href="#">Software OYM</a> -->
            <!-- <button id="toggle-sidebar" class="navbar-toggler sidebar-toggler d-md-down-none" type="button"> -->
            <!-- <img src="img\Publiservicios.png" class="card-img-left" alt="Cinque Terre" width="50%" height="50%">  -->
            <h5>Software OYM</h5>
          <!-- <span class="navbar-toggler-icon"></span> -->
        </button>
        </div>
    <div class="sidebar-header">
        <div class="user-pic">
            <img class="img-avatar img-responsive img-rounded" src="img/avatars/6.png"
            alt="User picture">
        </div>
        <div class="user-info">
            <span class="user-name">
            <strong>{{Auth::user()->usuario}}</strong>
            </span>
            <span class="user-role">Sala de Control</span>
            <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
            </span>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-dropdown ">
                <ul>
                    {{-- <li class="header-menu">
                        <span>TABLAS MAESTRAS</span>
                    </li> --}}
 
                    {{-- <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-clipboard"></i>
                            <span class="menu-text">Mantenimiento</span>                         
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                            <li @click="menu=58" >
                                <a  href="#"><i class="icon-bag"></i>Diámetros</a>
                            </li> 

                            <li @click="menu=76" >
                                <a  href="#"><i class="icon-bag"></i>Redes</a>
                            </li>
                            <li @click="menu=10" >
                                <a  href="#"><i class="icon-bag"></i>Material Redes</a>
                            </li>
                       
                            </ul>                            
                        </div>                        
                    </li> --}}
  
                    <li class="header-menu">
                        <span>MANTENIMIENTO</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="far fa-newspaper"></i>
                            <span class="menu-text">Gestionar Fichas</span>
                        </a>                                        
                        <div class="sidebar-submenu">
                            <ul>
                                <li @click="menu=81" >
                                    <a  href="#"><i class="fas fa-tools"></i>Equipos y Herramientas</a>
                                </li>
                                {{-- <li @click="menu=9" >
                                    <a  href="#"><i class="fas fa-project-diagram"></i>Redes</a>
                                </li>    
                                <li @click="menu=32" >
                                    <a  href="#"><i class="icon-user-following"></i>Insumos x Equipos</a>
                                </li> 
                                <li @click="menu=35" >
                                    <a  href="#"><i class="icon-user-following"></i>Act. x Equipo</a>
                                </li>  
                                <li @click="menu=82" >
                                    <a  href="#"><i class="icon-bag"></i>Eq-Trab x Equipos</a>
                                </li>   --}}
             
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="far fa-calendar-alt"></i>
                            <span class="menu-text">Programar  Mantenimiento</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>                                    

                                <li @click="menu=83" >
                                    <a  href="#"><i class="fas fa-tools"></i>Equipos y Herramientas</a>
                                </li>
     
                            </ul>
                        </div>
                    </li>
     
    
                        
                        <li class="header-menu">
                            <span></span>
                         </li>
<!--                 
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span class="menu-text">Gestión PQR´S</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                        
                    </li> -->
                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="menu-text">Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-folder"></i>
                            <span class="menu-text">Examples</span>
                        </a>
                    </li> -->
                
                </ul>
            </div>
    </div>
<div class="sidebar-footer">
  <a href="#">
    <i class="fa fa-bell"></i>
    <span class="badge badge-pill badge-warning notification">3</span>
  </a>
  <a href="#">
    <i class="fa fa-envelope"></i>
    <span class="badge badge-pill badge-success notification">7</span>
  </a>
  <a href="#">
    <i class="fa fa-cog"></i>
    <span class="badge-sonar"></span>
  </a>
  <div>
      
  </div>
  <a href="#">
    <i class="fa fa-power-off"></i>
  </a>
</div>
</nav>

 <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
</div>

