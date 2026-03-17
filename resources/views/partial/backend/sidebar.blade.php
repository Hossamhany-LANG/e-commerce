        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("admin.index_route")}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Home(Admin)</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            {{-- {{dd($admin_side_menu)}} --}}

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route("frontend.index")}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home(TechZone)</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Languages -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLanguages"
                    aria-expanded="true" aria-controls="collapseLanguages">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Languages</span> 
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Language::count()}}</span>
                </a>
                <div id="collapseLanguages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Languages:</h6>
                        <a class="collapse-item" href="{{route('admin.languages.index')}}">show all</a>
                        <a class="collapse-item" href="{{route('admin.languages.create')}}">add a new language</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemaincategories"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Main Categories</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Main_Category::where('translation_of' , 0)->count()}}</span>
                </a>
                <div id="collapsemaincategories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Categories:</h6>
                        <a class="collapse-item" href="{{route('admin.main_categories.index')}}">show all</a>
                        <a class="collapse-item" href="{{route('admin.main_categories.create')}}">add a new category</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesubcategories"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-table"></i>
                    <span>SubCategories</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\SubCategory::count()}}</span>
                </a>
                <div id="collapsesubcategories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom SubCategories:</h6>
                        <a class="collapse-item" href="{{route('admin.subcategories.index')}}">show all</a>
                        <a class="collapse-item" href="{{route('admin.subcategories.create')}}">add a new category</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                    aria-expanded="true" aria-controls="collapseStores">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Products</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Product::count()}}</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Products:</h6>
                        <a class="collapse-item" href="{{route('admin.products.index')}}">show all</a>
                        <a class="collapse-item" href="{{route('admin.products.create')}}">add a new product</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStores"
                    aria-expanded="true" aria-controls="collapseStores">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Stores</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Vendor::count()}}</span>
                </a>
                <div id="collapseStores" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Stores:</h6>
                        <a class="collapse-item" href="{{route('admin.vendors.index')}}">show all</a>
                        <a class="collapse-item" href="{{route('admin.vendors.create')}}">add a new store</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Informations Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInformations"
                    aria-expanded="true" aria-controls="collapseInformations">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Informations</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Aboutus::count()}}</span>
                </a>
                <div id="collapseInformations" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Informations:</h6>
                        <a class="collapse-item" href="{{route('admin.about-us.index')}}">show informations</a>
                        <a class="collapse-item" href="{{route('admin.about-us.create')}}">add information</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Orders Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
                    aria-expanded="true" aria-controls="collapseOrders">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Orders Management</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Order::count()}}</span>
                </a>
                <div id="collapseOrders" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Orders:</h6>
                        <a class="collapse-item" href="{{route('showorders')}}">show all</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - ReturnOrders Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReturnOrders"
                    aria-expanded="true" aria-controls="collapseReturnOrders">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>ReturnOrders Management</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\ReturnOrder::count()}}</span>
                </a>
                <div id="collapseReturnOrders" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom ReturnOrders:</h6>
                        <a class="collapse-item" href="{{route('show-return-orders')}}">show all</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - ClientsMessages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ClientsMessages"
                    aria-expanded="true" aria-controls="ClientsMessages">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Clients Messages</span>
                    <span  class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\ContactUs::count()}}</span>
                </a>
                <div id="ClientsMessages" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom ClientsMessages:</h6>
                        <a class="collapse-item" href="{{route('show-all-clients-messages')}}">show all</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="{{route('admin.adminprofile.show')}}">Admin Profile</a>
                        <a class="collapse-item" href="{{route("admin.logout")}}">Login</a>
                        <a class="collapse-item" href="">Register</a>
                        <a class="collapse-item" href="{{route("admin.forgot_password")}}">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.blade.php">Blank Page</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->
        