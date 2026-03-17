                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                            @php
                                use App\Models\Notification;
                                $orderNotifs = Notification::with('order')->where('type', 'order')->where('is_read', false)->latest()->get();
                                
                                $messageNotifs = Notification::with('contactMessage')->where('type', 'message')->where('is_read', false)->get();
                            @endphp
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{$orderNotifs->count()}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">New Orders</h6>
                                @forelse ($orderNotifs as $orderNotify)
                                <a class="dropdown-item d-flex align-items-center" href="{{route('show_order_details' , $orderNotify->related_id)}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $orderNotify->created_at->diffForHumans() }}</div>
                                        
                                        @if($orderNotify->order)
                                            <strong>Client Name:</strong> {{ $orderNotify->order->first_name }} {{ $orderNotify->order->last_name }}
                                        @else
                                            <strong>Client Name:</strong> Unknown
                                        @endif
                                        
                                        <br>
                                        {{ $orderNotify->body }}
                                    </div>
                                </a>
                                @empty
                                    <span>no new orders</span>
                                @endforelse
                                @if ($orderNotifs->count() > 0)
                                    <a class="dropdown-item text-center small text-gray-500" href="{{route('hide_order_notification')}}">Discernible All As Readable</a>
                                @endif
                                    <a class="dropdown-item text-center small text-gray-500" href="{{route('showorders')}}">Show All Orders</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">{{$messageNotifs->count()}}</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">Message Center</h6>

                                @forelse($messageNotifs as $messageNotify)
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('show-client-message',$messageNotify->related_id) }}">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('backend/img/undraw_profile_2.svg') }}" alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                            <div>
                                                <div class="text-truncate"><strong>From :</strong> {{ $messageNotify->contactMessage->name }}</div>
                                                <div class="small text-gray-500">Subject: {{ $messageNotify->body }}</div>
                                            </div>
                                    </a>
                                @empty
                                    <span class="dropdown-item">No new messages</span>
                                @endforelse

                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('show-all-clients-messages') }}">
                                    Show All Messages
                                </a>
                            </div>

                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->username}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{Storage::url(Auth::user()->user_image)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admin.adminprofile.show')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.logout')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->