<!--begin::Page-->
<div class="d-flex flex-row flex-column-fluid page">
	<!--begin::Aside-->
	<!--begin::Aside-->
	<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
		<!--begin::Brand-->
		<div class="brand flex-column-auto" id="kt_brand">
			<!--begin::Logo-->
			<a href="{{url('/home')}}" class="brand-logo">
				<img alt="Logo" src="{{asset('assets/media/login.png')}}" />
			</a>
			<!--end::Logo-->
			<!--begin::Toggle-->
			<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
				<span class="svg-icon svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
							<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</button>
			<!--end::Toolbar-->
		</div>
		<!--end::Brand-->
		<!--begin::Aside Menu-->
		<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
			<!--begin::Menu Container-->
			<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
				<!--begin::Menu Nav-->
				<ul class="menu-nav">
					<li class="menu-item menu-item-active mb-5" aria-haspopup="true">
						<a href="" class="menu-link">
							<span class="svg-icon menu-icon">
								<i class="fas fa-home"></i>
							</span>
							<span class="menu-text">الرئيسية</span>
						</a>
					</li>

					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<i class="fas fa-sliders-h"></i>
							</span>
							<span class="menu-text">الاعدادات</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">
								<li class="menu-item menu-item-parent" aria-haspopup="true">
									<span class="menu-link">
										<span class="menu-text">الاعدادات</span>
									</span>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('states')}}" class="menu-link">
										<span class="menu-text">المحافظات</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('cities')}}" class="menu-link">
										<span class="menu-text">المدن</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('address_types')}}" class="menu-link">
										<span class="menu-text">انواع العناوين</span>
									</a>
								</li>
								<li  class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('services')}}" class="menu-link">
										<span class="menu-text">الخدمات</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('packages')}}" class="menu-link">
										<span class="menu-text">الباقات</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a   href="{{route('cancel_reasons')}}" class="menu-link">
										<span class="menu-text">اسباب الالغاء</span>
									</a>
								</li>

							</ul>
						</div>
					</li>

					<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<i class="fas fa-cubes"></i>
							</span>
							<span class="menu-text">المستخدمين</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu">
							<i class="menu-arrow"></i>
							<ul class="menu-subnav">

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('users')}}" class="menu-link">
                                        <span class="menu-text">العملاء</span>
                                    </a>
                                </li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('barbers')}}" class="menu-link">
										<span class="menu-text">الحلاقيين</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{route('admins')}}"  class="menu-link">
										<span class="menu-text">المديرين</span>
									</a>
								</li>
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a  class="menu-link">
                                        <span class="menu-text">الأدوار</span>
                                    </a>
                                </li>
							</ul>
						</div>
					</li>



                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<i class="fas fa-cubes"></i>
							</span>
                            <span class="menu-text">الحجوزات</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('bookings')}}" class="menu-link">
                                        <span class="menu-text">الحجوزات</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<i class="fas fa-cubes"></i>
							</span>
                            <span class="menu-text">التطبيق</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('sliders')}}" class="menu-link">
                                        <span class="menu-text">الاعلانات</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a  class="menu-link">
                                        <span class="menu-text">اعدادات التطبيق</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<i class="fas fa-cubes"></i>
							</span>
                            <span class="menu-text">الادوار</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('roles')}}" class="menu-link">
                                        <span class="menu-text">الادوار</span>
                                    </a>
                                </li>

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('permissions')}}" class="menu-link">
                                        <span class="menu-text">الصلاحيات</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{route('logout_admin')}}" class="menu-link">
                            <span class="menu-text">تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
				<!--end::Menu Nav-->
			</div>
			<!--end::Menu Container-->
		</div>
		<!--end::Aside Menu-->
	</div>
	<!--end::Aside-->
	<!--begin::Wrapper-->
	<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

		<!--begin::Header-->
		<div id="kt_header" class="header header-fixed">
			<!--begin::Container-->
			<div class="container-fluid d-flex align-items-stretch justify-content-between">
				<!--begin::Header Menu Wrapper-->
				<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
					<!--begin::Header Menu-->
					<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Header Nav-->
						<ul class="menu-nav">
						</ul>
						<!--end::Header Nav-->
					</div>
					<!--end::Header Menu-->
				</div>
				<!--end::Header Menu Wrapper-->
				<!--begin::Topbar-->
				<div class="topbar">
					<!--begin::Languages-->
					<div class="dropdown">
						<!--begin::Toggle-->
						<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
							<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
								<img class="h-20px w-20px rounded-sm" src="{{asset('assets/media/svg/flags/226-united-states.svg')}}" alt="" />
							</div>
						</div>
						<!--end::Toggle-->
						<!--begin::Dropdown-->
						<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
							<!--begin::Nav-->
							<ul class="navi navi-hover py-4">
								<!--begin::Item-->
								<li class="navi-item">
									<a href="#" class="navi-link">
										<span class="symbol symbol-20 mr-3">
											<img src="{{asset('assets/media/svg/flags/226-united-states.svg')}}" alt="" />
										</span>
										<span class="navi-text">English</span>
									</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="navi-item active">
									<a href="#" class="navi-link">
										<span class="symbol symbol-20 mr-3">
											<img src="{{asset('assets/media/svg/flags/008-saudi-arabia.svg')}}" alt="" />
										</span>
										<span class="navi-text">Arabic</span>
									</a>
								</li>
								<!--end::Item-->
							</ul>
							<!--end::Nav-->
						</div>
						<!--end::Dropdown-->
					</div>
					<!--end::Languages-->
					<!--begin::User-->
					<div class="dropdown">
						<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
							<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
								<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
								<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Sean</span>
								<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
									<span class="symbol-label font-size-h5 font-weight-bold">S</span>
								</span>
							</div>
						</div>
						<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
							<ul class="navi navi-hover py-4">
								<!--begin::Item-->
								<li class="navi-item">
									<a href="#" class="navi-link">
										<span class="navi-text">Logout</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!--end::User-->
				</div>
				<!--end::Topbar-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Header-->

		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			@yield("content")
		</div>
		<!--end::Content-->

		<!--begin::Footer-->
		<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
			<!--begin::Container-->
			<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
				<!--begin::Copyright-->
				<div class="text-dark order-2 order-md-1">
					<span class="text-muted font-weight-bold mr-2">2021©</span>
					<a href="#" target="_blank" class="text-dark-75 text-hover-primary">Pickup</a>
				</div>
				<!--end::Copyright-->
				<!--begin::Nav-->
				<div class="nav nav-dark">
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Footer-->
	</div>
	<!--end::Wrapper-->

</div>
