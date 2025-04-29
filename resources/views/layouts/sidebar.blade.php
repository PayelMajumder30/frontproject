
<aside class="sidebar navbar-default" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('dashboard')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('users') }}">
                        <i class="fa fa-envelope fa-fw"></i> User List
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.userdetails')}}">
                        <i class="fa fa-solid fa-info-circle"></i> User Details
                    </a>
                </li>
                <li>
                    <a href="{{ route('designation.list.all')}}">
                        <i class="fa fa-briefcase"></i> Designation
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.list')}}">
                        <i class="fa fa-shopping-cart"></i> Total Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.userLedgers')}}">
                        <i class="fa fa-google-wallet"></i> All Ledgers
                    </a>
                </li>
                
            @endif
            
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('flot')}}">Flot Charts</a>
                    </li>
                    <li>
                        <a href="{{route('morris')}}">Morris.js Charts</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{route('table')}}"><i class="fa fa-table fa-fw"></i> Tables</a>
            </li>
            <li>
                <a href="{{route('forms')}}"><i class="fa fa-edit fa-fw"></i> Forms</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('panels-wells')}}">Panels and Wells</a>
                    </li>
                    <li>
                        <a href="{{route('buttons')}}">Buttons</a>
                    </li>
                    <li>
                        <a href="{{route('notifications')}}">Notifications</a>
                    </li>
                    <li>
                        <a href="{{route('typography')}}">Typography</a>
                    </li>
                    <li>
                        <a href="icons.html"> Icons</a>
                    </li>
                    <li>
                        <a href="grid.html">Grid</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @if(auth()->check() && auth()->user()->role === 'user')
                <li>
                    <a href="{{route('users.chat', ['userId' => auth()->id()])}}" ><i class="fa fa-envelope fa-fw"></i> Chat with Admin</a>
                </li>
                <li>
                    <a href="{{route('users.orderHistory')}}" ><i class="fa fa-history fa-fw"></i> Order History</a>
                </li>
            @endif

            @if(auth()->check() && auth()->user()->is_team_leader)
                <li>
                    <a href="{{ route('team.create')}}">
                        <i class="fa fa-users"></i> Create a Team
                    </a>
                </li>
            @endif

            @if(auth()->check() && auth()->user()->is_team_leader)
                <li><a href="{{ route('team.view')}}">My Teams</a></li>
            @endif

            @if(auth()->check() && auth()->user()->role === 'user')
                <li>
                    <a href="{{route('product.view', auth()->user()->id)}}" ><i class="fa fa-shopping-cart"></i> Products </a>
                </li>
                <li>
                    <a href="{{ route('wallet.show', auth()->user()->id)}}"><i class="fa fa-money"></i> Wallet</a>
                </li>
                <li>
                    <a href="{{ route('ledger.show', auth()->user()->id)}}"><i class="fa fa-google-wallet"></i> ledger</a>
                </li>
            @endif

            {{-- <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li> --}}
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="login.html">Login Page</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
</aside>