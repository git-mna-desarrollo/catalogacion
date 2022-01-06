<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
	<!--begin::Menu Container-->
	<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
		<!--begin::Menu Nav-->
		<ul class="menu-nav">
			{{-- <li class="menu-item" aria-haspopup="true">
				<a href="index.html" class="menu-link">
					<span class="menu-icon"><i class="far fa-images"></i></span>
					<span class="menu-text">Panel</span>
				</a>
			</li>
			<li class="menu-section">
				<h4 class="menu-text">Administracion</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
			</li> --}}

			<li>
				<div class="text-center mb-10">
					<div class="symbol symbol-60 symbol-circle">
						<div class="symbol-label" style="background-image:url('{{ url('assets/media/users/fotoPerfil.jpg') }}')"></div>
						<i class="symbol-badge symbol-badge-bottom bg-success"></i>
					</div>
					@auth
						
					
					<h4 class="font-weight-bold my-2">{{ Auth::user()->name }}</h4>
					<div class="text-light mb-2">{{ Auth::user()->perfil }}</div>
					<a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="label label-light-danger label-inline font-weight-bold label-lg">Salir</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
					@endauth
				</div>
			</li>

			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="{{ url('panel/inicio') }}" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="fas fa-chart-bar"></i></span>
					<span class="menu-text">PANEL DE CONTROL</span>
				</a>
			</li>
		
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="far fa-images"></i></span>
					<span class="menu-text">PATRIMONIO</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('patrimonio/formulario/0') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Nuevo</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('patrimonio/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
			
					</ul>
				</div>
			</li>

			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="{{ url('patrimonio/revisiones') }}" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="far fa-check-square"></i></span>
					<span class="menu-text">REVISIONES</span>
				</a>
			</li>

			@if (Auth::user()->perfil == 'Administrador')
				
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="fas fa-user-friends"></i></span>
					<span class="menu-text">USUARIOS</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
			
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('user/formulario/0') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Nuevo</span>
							</a>
						</li>
			
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('user/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Listado</span>
							</a>
						</li>
			
					</ul>
				</div>
			</li>
			@endif

			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="menu-icon"><i class="fas fa-cog"></i></span>
					<span class="menu-text">CONFIGURACIONES</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
			
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('especialidad/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Especialidades</span>
							</a>
						</li>
			
						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('tecnicamaterial/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Tecnicas/Materiales</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('estilo/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Estilos</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('ubicacion/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Ubicaciones</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('sitio/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Sitios</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('inmueble/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Inmuebles</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('tecnica/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Tecnicas</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('material/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Materiales</span>
							</a>
						</li>

						<li class="menu-item" aria-haspopup="true">
							<a href="{{ url('cuenta/listado') }}" class="menu-link">
								<i class="menu-bullet menu-bullet-dot">
									<span></span>
								</i>
								<span class="menu-text">Cuentas</span>
							</a>
						</li>
			
					</ul>
				</div>
			</li>

		</ul>
		<!--end::Menu Nav-->
	</div>
	<!--end::Menu Container-->
</div>