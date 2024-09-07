<nav class="navbar navbar-expand-lg navbar-dark osahan-nav">
    <div class="container">
        {{-- <a class="navbar-brand" href="index.html"><img alt="logo" src="img/favicon.png"></a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="offers.html"><i class="icofont-sale-discount"></i> Offers <span
                            class="badge badge-warning">New</span></a>
                </li> --}}

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Login / Register --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                    {{-- <a class="dropdown-item" href="track-order.html">Track Order</a>
                        <a class="dropdown-item" href="invoice.html">Invoice</a> --}}
                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    {{-- <a class="dropdown-item" href="404.html">404</a>
                        <a class="dropdown-item" href="extra.html">Extra :)</a> --}}
                </div>
                </li>

                @auth
                    @php
                        $id = Auth::user()->id;
                        $profileData = App\Models\User::find($id);
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img alt="Generic placeholder image"
                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                class="nav-osahan-pic rounded-pill"> My Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="icofont-food-cart"></i>
                                Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="icofont-sale-discount"></i>
                                Logout </a>

                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('login') }}" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            Login
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('register') }}" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            Register
                        </a>
                    </li>

                @endauth

                {{-- <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="orders.html#orders"><i class="icofont-food-cart"></i>
                            Orders</a>
                        <a class="dropdown-item" href="orders.html#offers"><i class="icofont-sale-discount"></i>
                            Offers</a>
                        <a class="dropdown-item" href="orders.html#favourites"><i class="icofont-heart"></i>
                            Favourites</a>
                        <a class="dropdown-item" href="orders.html#payments"><i class="icofont-credit-card"></i>
                            Payments</a>
                        <a class="dropdown-item" href="orders.html#addresses"><i class="icofont-location-pin"></i>
                            Addresses</a>
                    </div> --}}
                </li>
                {{-- <li class="nav-item dropdown dropdown-cart">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-basket"></i> Cart
                        <span class="badge badge-success">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                        <div class="dropdown-cart-top-header p-4">
                            <img class="img-fluid mr-3" alt="osahan" src="img/cart.jpg">
                            <h6 class="mb-0">Gus's World Famous Chicken</h6>
                            <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                            <small><a class="text-primary font-weight-bold" href="#">View Full
                                    Menu</a></small>
                        </div>
                        <div class="dropdown-cart-top-body border-top p-4">
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken
                                Tikka Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span>
                            </p>
                            <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn &
                                Peas Salad x 1 <span class="float-right text-secondary">$209</span></p>
                            <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg
                                Seekh Sub 6" (15 cm) x 1 <span class="float-right text-secondary">$133</span>
                            </p>
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken
                                Tikka Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span>
                            </p>
                            <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn &
                                Peas Salad x 1 <span class="float-right text-secondary">$209</span></p>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-4">
                            <p class="mb-0 font-weight-bold text-secondary">Sub Total <span
                                    class="float-right text-dark">$499</span></p>
                            <small class="text-info">Extra charges may apply</small>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-2">
                            <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
