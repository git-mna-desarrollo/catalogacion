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
							<a href="{{ url('patrimonio/formulario') }}" class="menu-link">
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
		</ul>
		<!--end::Menu Nav-->
	</div>
	<!--end::Menu Container-->
</div>