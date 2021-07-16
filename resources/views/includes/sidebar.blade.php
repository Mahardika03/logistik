<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile position-relative" style="background: url(material-pro/src/assets/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ url('material-pro/src/assets/images/users/profile.png') }}" alt="user" class="w-100" /> </div>
            <!-- User profile text-->
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{ url('/') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i
                            class="mdi mdi-code-not-equal"></i><span class="hide-menu">Messages</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{ url('message') }}"
                                class="sidebar-link"><span
                                    class="hide-menu"> Message Data </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('message-type') }}"
                                class="sidebar-link"><span
                                class="hide-menu"> Message Code </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{ url('product') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-package-variant-closed"></i>
                        <span class="hide-menu">Product </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{ url('addresses') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-book-open"></i>
                        <span class="hide-menu">Addresses</span>
                    </a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i
                            class="mdi mdi-map-marker-circle"></i><span class="hide-menu">Locations</span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item"><a href="{{ url('location') }}"
                                class="sidebar-link"><span
                                class="hide-menu"> Location </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('location-type') }}"
                                class="sidebar-link"><span
                                class="hide-menu"> Location Type </span></a></li>
                        </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{ url('shipments') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-package-up"></i>
                        <span class="hide-menu">Shipments</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-lg ml-2" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></button>
        </form>
    </div>
    <!-- End Bottom points-->
</aside>