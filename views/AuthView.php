<?php
class AuthView
{
    public function login($errors = null, $username = null, $password = null)
    {
        echo '<!-- Login -->
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 m-auto">
                    <h3 class="sec-title">Login your account</h3>
                    <p class="sec-desc">
                        Login to your account to discovery all great features in this item
                    </p>
                    <div class="form-text error-text">';
        echo isset($errors['login']) ? $errors['login'] : '';
        ;
        echo '</div>
                    <div class="login-form">
                        <form action="checkLogin" method="post">
                            <input type="text" name="username" placeholder="User Name" value="' . $username . '" tabindex="1">
                            <div class="form-text error-text">';
        echo isset($errors['username']) ? $errors['username'] : '';
        ;
        echo '</div>
                            <input type="password" name="password" placeholder="Your Password" value="' . $password . '" tabindex="2">
                            <div class="form-text error-text">';
        echo isset($errors['password']) ? $errors['password'] : '';
        ;
        echo '</div>
                            <div class="keep-log-regi">
                            <input type="radio" id="login" name="keep-login" value="keep-login">
                            <label for="login">Keep me logged in</label>   
                            </div>
                            <a href="#">Forgot your password?</a>
                            <div>
                                <button type="submit" class="btn2" name="submit" value="login" tabindex="4">login</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-log-regi">
                        <h5>OR LOGIN WITH</h5>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-google"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                    <div class="mt-3"><span>You have no account?</span> <a class="link" href="register">Register now</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login -->';
    }
    public function register($errors = null)
    {
        echo '<!-- Register -->
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 m-auto">
                    <h3 class="sec-title">Register account now</h3>
                    <p class="sec-desc">
                        Pellentesque habitant morbi tristique senectus et netus et
                    </p>
                    <div class="register-form">
                        <form action="checkRegister" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" placeholder="Your Name" value="';
        if (isset($_POST['fullname'])) {
            echo $_POST['fullname'];
        }
        echo '">
        <div class="form-text error-text">';
        echo isset($errors['fullname']) ? $errors['fullname'] : '';
        ;
        echo '</div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="username" placeholder="User Name" value="';
        if (isset($_POST['username'])) {
            echo $_POST['username'];
        }
        ;
        echo '">
        <div class="form-text error-text">';
        echo isset($errors['username']) ? $errors['username'] : '';
        echo '</div>
        </div>
                                <div class="col-lg-6">
                                    <input type="number" name="phone" placeholder="Phone" value="';
        if (isset($_POST['phone'])) {
            echo $_POST['phone'];
        }
        ;
        echo '">
        <div class="form-text error-text">';
        echo isset($errors['phone']) ? $errors['phone'] : '';
        echo '</div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email" value="';
        if (isset($_POST['email'])) {
            echo $_POST['email'];
        }
        ;
        echo '"><div class="form-text error-text">';
        echo isset($errors['email']) ? $errors['email'] : '';
        echo '</div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="Password" value="';
        if (isset($_POST['password'])) {
            echo $_POST['password'];
        }
        ;
        echo
            '">
            <div class="form-text error-text">';
        echo isset($errors['password']) ? $errors['password'] : '';
        echo '</div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="repassword" placeholder="Re Password" value="';
        if (isset($_POST['repassword'])) {
            echo $_POST['repassword'];
        }
        ;
        echo
            '"><div class="form-text error-text">';
        echo isset($errors['repassword']) ? $errors['repassword'] : '';
        echo '</div>
                                </div>
                            </div>
                            <div class="keep-log-regi">
                                <input type="radio" id="register" name="accept" value="keep-register" required>
                                <label for="register">
                                    I accept the terms and conditions, including the Privacy Policy
                                </label>  ';
        echo
            '<div class="form-text error-text">';
        echo isset($errors['accept']) ? $errors['accept'] : '';
        echo '</div>
                            </div>
                            <div>
                                <button type="submit" class="btn2" name="submit" value="register">register</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-log-regi">
                        <h5>OR Register WITH</h5>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-google"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                    <div class="mt-3"><span>You have a account?</span> <a class="link" href="login">Login now</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register -->';
    }

    function myProfile($user, $errors = null)
    {
        echo '
        <div class="main-content mb-5">
            <div>
                <div class="hero-section is-width-constrained" data-type="type-1">
                    <header class="entry-header">
                        <h3 class="page-title">My account</h3>
                    </header>
                </div>
                <div class="row p-0 m-0">
                    <div class="col-12">
                        <div class="register-form">';
        echo isset($errors['success']) ? '<script>showAlert("success", "Profile updated<strong> successfully!</strong>");</script>' : '';
        echo '<form action="user/account/update" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="mt-3 label" for="full-name">Your Name</label>
                                        <input type="text" name="full-name" placeholder="Your Name" value="';
        echo isset($_POST['full-name']) ? htmlspecialchars($_POST['full-name']) : htmlspecialchars($user['fullname']);
        echo '">';

        echo '<div class="form-text error-text">';
        echo isset($errors['fullname']) ? htmlspecialchars($errors['fullname']) : '';
        echo '</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="mt-3 label" for="name">User Name</label>
                                        <input type="text" name="name" placeholder="User Name" value="' . $user['username'] . '" disabled>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="mt-3 label" for="phone">Number Phone</label>
                                        <input type="number" name="phone" placeholder="Phone" value="';
        echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : htmlspecialchars($user['phone']);
        echo '">';

        echo '<div class="form-text error-text">';
        echo isset($errors['phone']) ? htmlspecialchars($errors['phone']) : '';
        echo '</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="mt-3 label" for="email">Your Email</label>
                                        <input type="text" name="email" placeholder="Email" value="';
        echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($user['email']);
        echo '">';
        echo '<div class="form-text error-text">';
        echo isset($errors['email']) ? htmlspecialchars($errors['email']) : '';
        echo '</div>
                                    </div>
                                </div>
                                <div class="password-change-form">
                                    <h3>Change password</h3>
                                    <!-- Mật khẩu hiện tại -->
                                    <label class="mt-3" for="current-password">Current password (
                                        Leave blank if unchanged)</label>
                                    <input class="m-0 mt-2" id="password" type="password" name="password"
                                        placeholder="Current password">';
        echo '<div class="form-text error-text">';
        echo isset($errors['password']) ? $errors['password'] : '';
        echo '</div>
                                    <!-- Mật khẩu mới -->
                                    <label class="mt-3" for="new-password">New password (
                                        Leave blank if unchanged)</label>
                                    <input class="m-0 mt-2" type="password" name="new-password"
                                        placeholder="New password">';
        echo '<div class="form-text error-text">';
        echo isset($errors['new-password']) ? $errors['new-password'] : '';
        echo '</div>
                                    <!-- Xác nhận mật khẩu mới -->
                                    <label class="mt-3" for="confirm-password">Confirm password</label>
                                    <input class="m-0 mt-2" type="password" name="confirm-password"
                                        placeholder="Confirm password">';
        echo '<div class="form-text error-text">';
        echo isset($errors['confirm-password']) ? $errors['confirm-password'] : '';
        echo '</div>
                                </div>
                                <div class="mt-3 center">
                                    <button type="submit" class="btn2" name="submit" value="updateUser">update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    public function showAdminPage()
    {
        echo '  <section class="container">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills mt-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link d-flex justify-content-start gap-1 active" id="v-pills-dashboard-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab"
                    aria-controls="v-pills-dashboard" aria-selected="true"><i class="bi bi-bar-chart-line"></i>Dashboard
                </button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-category-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-category" type="button" role="tab"
                    aria-controls="v-pills-category" aria-selected="false"><i class="bi bi-grid"></i> Category</button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-products-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-products" type="button" role="tab"
                    aria-controls="v-pills-products" aria-selected="false"><i class="bi bi-archive"></i>Product</button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-orders-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-orders" type="button" role="tab"
                    aria-controls="v-pills-orders" aria-selected="false"><i class="bi bi-bell"></i>Order </button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-member-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-member" type="button" role="tab"
                    aria-controls="v-pills-member" aria-selected="false"><i class="bi bi-people"></i>Member </button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-reviews-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-reviews" type="button" role="tab"
                    aria-controls="v-pills-reviews" aria-selected="false"><i class="bi bi-brush"></i>Reviews</button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-discounts-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-discounts" type="button" role="tab"
                    aria-controls="v-pills-discounts" aria-selected="false"><i
                        class="bi bi-cash-coin"></i>Discount</button>
                <button class="nav-link d-flex justify-content-start gap-1" id="v-pills-shipping-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-shipping" type="button" role="tab"
                    aria-controls="v-pills-shipping" aria-selected="false"><i class="bi bi-box"></i>Shipping </button>
                <a href=""><button class="nav-link d-flex justify-content-start gap-1" id="v-pills-logout-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-logout" type="button" role="tab"
                        aria-controls="v-pills-logout" aria-selected="false"><i
                            class="bi bi-box-arrow-left"></i>Logout</button></a>
            </div>
            <div class="tab-content ms-3 overflow-x-scroll w-100" id="v-pills-tabContent">
                <!-- content dashboard -->
                <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                    aria-labelledby="v-pills-dashboard-tab" tabindex="0">
                    <main class="main-content p-3">
                        <div class="mt-xl-0 text-center display-5 bold title">Dashboard</div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 ">
                            <div class="col mt-4">
                                <div class="card text-center blue">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">Welcome!</h4>
                                        <p class="card-text">Admin</p>
                                        <a href="user/account/profile" class="btn btn3 btn-sm text-nowrap">Update Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card text-center danger">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">120</h4>
                                        <p class="card-text">Members</p>
                                        <button class="btn btn3 btn-sm text-nowrap" onclick="switchTab(\'member\')">See Member</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card text-center warning">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">1-</h4>
                                        <p class="card-text">Reviews</p>
                                        <button class="btn btn3 btn-sm text-nowrap" onclick="switchTab(\'reviews\')">See Reviews</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card text-center success">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">1</h4>
                                        <p class="card-text">Orders</p>
                                        <button class="btn btn3 btn-sm text-nowrap" onclick="switchTab(\'orders\')">See Orders</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <h5 class="card-title mb-0">Order Activity</h5>
                                                    <div class="ms-auto">
                                                        <div class="dropdown">
                                                            <a class="font-size-16 text-muted dropdown-toggle" href="#"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body px-0">
                                                <ol class="activity-feed mb-0 px-4" data-simplebar="init"
                                                    style="max-height: 377px;">
                                                    <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset"
                                                                style="right: -16.8px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper"
                                                                    style="height: auto; overflow: hidden scroll;">
                                                                    <div class="simplebar-content"
                                                                        style="padding: 0px 24px;">
                                                                        <li class="feed-item mb-5">
                                                                            <div
                                                                                class="d-flex justify-content-between feed-item-list">
                                                                                <div>
                                                                                    <h5 class="font-size-15 mb-1">Your
                                                                                        Manager
                                                                                        Posted</h5>
                                                                                    <p class="text-muted mt-0 mb-0">
                                                                                        James
                                                                                        Raphael
                                                                                    </p>
                                                                                </div>
                                                                                <div>
                                                                                    <p class="text-muted mb-0">1 hour
                                                                                        ago
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="feed-item mb-5">
                                                                            <div
                                                                                class="d-flex justify-content-between feed-item-list">
                                                                                <div>
                                                                                    <h5 class="font-size-15 mb-1">Your
                                                                                        Manager
                                                                                        Posted</h5>
                                                                                    <p class="text-muted mt-0 mb-0">In
                                                                                        Transit</p>
                                                                                </div>
                                                                                <div>
                                                                                    <p class="text-muted mb-0">Yesterday
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>

                                                                        <li class="feed-item mb-5">
                                                                            <div
                                                                                class="d-flex justify-content-between feed-item-list">
                                                                                <div>
                                                                                    <h5 class="font-size-15 mb-1">You
                                                                                        have 1
                                                                                        pending
                                                                                        order.</h5>
                                                                                    <p class="text-muted mt-0 mb-0">
                                                                                        Dispatched</p>
                                                                                </div>
                                                                                <div>
                                                                                    <p class="text-muted mb-0">2 hour
                                                                                        ago
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="feed-item pb-1">
                                                                            <div
                                                                                class="d-flex justify-content-between feed-item-list">
                                                                                <div>
                                                                                    <h5 class="font-size-15 mb-1">New
                                                                                        Order
                                                                                        Received
                                                                                    </h5>
                                                                                    <p class="text-muted mt-0 mb-0">
                                                                                        Order
                                                                                        Received
                                                                                    </p>
                                                                                </div>
                                                                                <div>
                                                                                    <p class="text-muted mb-0">Today</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-placeholder"
                                                            style="width: auto; height: 390px;">
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-horizontal"
                                                        style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar simplebar-visible"
                                                            style="transform: translate3d(0px, 0px, 0px); display: none;">
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-vertical"
                                                        style="visibility: visible;">
                                                        <div class="simplebar-scrollbar simplebar-visible"
                                                            style="height: 364px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                        </div>
                                                    </div>
                                                </ol>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1">Top Users</h4>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown">
                                                            <a class=" dropdown-toggle" href="#"
                                                                id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted">All Members<i
                                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end"
                                                                aria-labelledby="dropdownMenuButton2">
                                                                <a class="dropdown-item" href="#">Members</a>
                                                                <a class="dropdown-item" href="#">New Members</a>
                                                                <a class="dropdown-item" href="#">Old Members</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body px-0 pt-2">
                                                <div class="table-responsive px-3" data-simplebar="init"
                                                    style="max-height: 393px;">
                                                    <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset"
                                                                style="right: -16.8px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper"
                                                                    style="height: auto; overflow: hidden scroll;">
                                                                    <div class="simplebar-content"
                                                                        style="padding: 0px 16px;">
                                                                        <table
                                                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="width: 20px;"><img
                                                                                            src="assets/images/users/avatar-4.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Glenn
                                                                                            Holden
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            Nevada
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-up icon-xs icon me-2 text-success">
                                                                                            <polyline
                                                                                                points="23 6 13.5 15.5 8.5 10.5 1 18">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 6 23 6 23 12">
                                                                                            </polyline>
                                                                                        </svg>$250.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-danger font-size-12">Cancel</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-5.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Lolita
                                                                                            Hamill
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            Texas
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-down icon-xs icon me-2 text-danger">
                                                                                            <polyline
                                                                                                points="23 18 13.5 8.5 8.5 13.5 1 6">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 18 23 18 23 12">
                                                                                            </polyline>
                                                                                        </svg>$110.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-success font-size-12">Success</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-6.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Robert
                                                                                            Mercer
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            California
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-up icon-xs icon me-2 text-success">
                                                                                            <polyline
                                                                                                points="23 6 13.5 15.5 8.5 10.5 1 18">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 6 23 6 23 12">
                                                                                            </polyline>
                                                                                        </svg>$420.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-info font-size-12">Active</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-7.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Marie
                                                                                            Kim</h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            Montana
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-down icon-xs icon me-2 text-danger">
                                                                                            <polyline
                                                                                                points="23 18 13.5 8.5 8.5 13.5 1 6">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 18 23 18 23 12">
                                                                                            </polyline>
                                                                                        </svg>$120.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-warning font-size-12">Pending</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-8.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Sonya
                                                                                            Henshaw
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            Colorado
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-up icon-xs icon me-2 text-success">
                                                                                            <polyline
                                                                                                points="23 6 13.5 15.5 8.5 10.5 1 18">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 6 23 6 23 12">
                                                                                            </polyline>
                                                                                        </svg>$112.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-info font-size-12">Active</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-2.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Marie
                                                                                            Kim</h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            Australia
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-down icon-xs icon me-2 text-danger">
                                                                                            <polyline
                                                                                                points="23 18 13.5 8.5 8.5 13.5 1 6">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 18 23 18 23 12">
                                                                                            </polyline>
                                                                                        </svg>$120.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-success font-size-12">Success</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><img src="assets/images/users/avatar-1.jpg"
                                                                                            class="avatar-sm rounded-circle "
                                                                                            alt="..."></td>
                                                                                    <td>
                                                                                        <h6 class="font-size-15 mb-1">
                                                                                            Sonya
                                                                                            Henshaw
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-muted font-size-13 mb-0">
                                                                                            <i
                                                                                                class="mdi mdi-map-marker"></i>
                                                                                            India
                                                                                        </p>
                                                                                    </td>
                                                                                    <td class="text-muted"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="feather feather-trending-up icon-xs icon me-2 text-success">
                                                                                            <polyline
                                                                                                points="23 6 13.5 15.5 8.5 10.5 1 18">
                                                                                            </polyline>
                                                                                            <polyline
                                                                                                points="17 6 23 6 23 12">
                                                                                            </polyline>
                                                                                        </svg>$112.00</td>
                                                                                    <td><span
                                                                                            class="badge badge-soft-danger font-size-12">Cancel</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="dropdown">
                                                                                            <a class="text-muted dropdown-toggle font-size-20"
                                                                                                role="button"
                                                                                                data-bs-toggle="dropdown"
                                                                                                aria-haspopup="true">
                                                                                                <i
                                                                                                    class="mdi mdi-dots-vertical"></i>
                                                                                            </a>

                                                                                            <div
                                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Another
                                                                                                    action</a>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Something
                                                                                                    else
                                                                                                    here</a>
                                                                                                <div
                                                                                                    class="dropdown-divider">
                                                                                                </div>
                                                                                                <a class="dropdown-item"
                                                                                                    href="#">Separated
                                                                                                    link</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-placeholder"
                                                            style="width: auto; height: 473px;">
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-horizontal"
                                                        style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"
                                                            style="transform: translate3d(0px, 0px, 0px); display: none;">
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-vertical"
                                                        style="visibility: visible;">
                                                        <div class="simplebar-scrollbar"
                                                            style="height: 326px; transform: translate3d(0px, 67px, 0px); display: block;">
                                                        </div>
                                                    </div>
                                                </div> <!-- enbd table-responsive-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title mb-0">Earnings By Item</h5>
                                            <div class="ms-auto">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted font-size-12">Sort By:</span> <span
                                                            class="fw-medium">Weekly<i
                                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-xl-0" style="position: relative;">
                                        <div id="earning-item" data-colors="[&quot;#33a186&quot;,&quot;#3980c0&quot;]"
                                            class="apex-chart" style="min-height: 396px;">
                                            <div id="apexchartsq1ul3jya"
                                                class="apexcharts-canvas apexchartsq1ul3jya apexcharts-theme-light"
                                                style="width: 355px; height: 381px;"><svg id="SvgjsSvg3232" width="355"
                                                    height="381" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev"
                                                    class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                                    transform="translate(0, 0)" style="background: transparent;">
                                                    <g id="SvgjsG3234" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(69.10761642456055, 30)">
                                                        <defs id="SvgjsDefs3233">
                                                            <clipPath id="gridRectMaskq1ul3jya">
                                                                <rect id="SvgjsRect3270" width="279.89238357543945"
                                                                    height="313.99519938278195" x="-2" y="0" rx="0"
                                                                    ry="0" opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskq1ul3jya"></clipPath>
                                                            <clipPath id="nonForecastMaskq1ul3jya"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskq1ul3jya">
                                                                <rect id="SvgjsRect3271" width="279.89238357543945"
                                                                    height="317.99519938278195" x="-2" y="-2" rx="0"
                                                                    ry="0" opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <line id="SvgjsLine3239" x1="0" y1="0" x2="0"
                                                            y2="313.99519938278195" stroke-dasharray="3"
                                                            stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                                            y="0" width="1" height="313.99519938278195" fill="#b1b9c4"
                                                            filter="none" fill-opacity="0.9" stroke-width="0"></line>
                                                        <g id="SvgjsG3311"
                                                            class="apexcharts-yaxis apexcharts-xaxis-inversed" rel="0">
                                                            <g id="SvgjsG3312"
                                                                class="apexcharts-yaxis-texts-g apexcharts-xaxis-inversed-texts-g"
                                                                transform="translate(0, 0)"><text id="SvgjsText3313"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="28.545018125707454" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3314">Iphone</tspan>
                                                                    <title>Iphone</title>
                                                                </text><text id="SvgjsText3315"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="80.87755135617111" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3316">Android</tspan>
                                                                    <title>Android</title>
                                                                </text><text id="SvgjsText3317"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="133.21008458663476" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3318">Watch 8</tspan>
                                                                    <title>Watch 8</title>
                                                                </text><text id="SvgjsText3319"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="185.54261781709843" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3320">Books</tspan>
                                                                    <title>Books</title>
                                                                </text><text id="SvgjsText3321"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="237.8751510475621" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3322">Speaker</tspan>
                                                                    <title>Speaker</title>
                                                                </text><text id="SvgjsText3323"
                                                                    font-family="Helvetica, Arial, sans-serif" x="-15"
                                                                    y="290.20768427802574" text-anchor="end"
                                                                    dominant-baseline="auto" font-size="11px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3324">Cover</tspan>
                                                                    <title>Cover</title>
                                                                </text></g>
                                                            <line id="SvgjsLine3325" x1="0" y1="1" x2="0"
                                                                y2="313.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG3288"
                                                            class="apexcharts-xaxis apexcharts-yaxis-inversed">
                                                            <g id="SvgjsG3289" class="apexcharts-xaxis-texts-g"
                                                                transform="translate(0, -8)"><text id="SvgjsText3291"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="5.164705420532226" y="343.99519938278195"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3293">Oct \'21</tspan>
                                                                    <title>Oct \'21</title>
                                                                </text><text id="SvgjsText3295"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="62.373750078735355" y="343.99519938278195"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3297">07 Oct</tspan>
                                                                    <title>07 Oct</title>
                                                                </text><text id="SvgjsText3299"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="119.5827947369385" y="343.99519938278195"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3301">13 Oct</tspan>
                                                                    <title>13 Oct</title>
                                                                </text><text id="SvgjsText3303"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="176.79183939514164" y="343.99519938278195"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3305">19 Oct</tspan>
                                                                    <title>19 Oct</title>
                                                                </text><text id="SvgjsText3307"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="234.00088405334478" y="343.99519938278195"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                                    <tspan id="SvgjsTspan3309">25 Oct</tspan>
                                                                    <title>25 Oct</title>
                                                                </text></g>
                                                            <line id="SvgjsLine3310" x1="0" y1="313.99519938278195"
                                                                x2="275.89238357543945" y2="313.99519938278195"
                                                                stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"
                                                                stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG3326" class="apexcharts-grid">
                                                            <g id="SvgjsG3327" class="apexcharts-gridlines-horizontal">
                                                                <line id="SvgjsLine3334" x1="0" y1="0"
                                                                    x2="275.89238357543945" y2="0" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine3335" x1="0" y1="52.33253323046366"
                                                                    x2="275.89238357543945" y2="52.33253323046366"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine3336" x1="0" y1="104.66506646092732"
                                                                    x2="275.89238357543945" y2="104.66506646092732"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine3337" x1="0" y1="156.99759969139097"
                                                                    x2="275.89238357543945" y2="156.99759969139097"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine3338" x1="0" y1="209.33013292185464"
                                                                    x2="275.89238357543945" y2="209.33013292185464"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine3339" x1="0" y1="261.6626661523183"
                                                                    x2="275.89238357543945" y2="261.6626661523183"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine3340" x1="0" y1="313.99519938278195"
                                                                    x2="275.89238357543945" y2="313.99519938278195"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                            </g>
                                                            <g id="SvgjsG3328" class="apexcharts-gridlines-vertical">
                                                            </g>
                                                            <line id="SvgjsLine3329" x1="5.164705420532226"
                                                                y1="314.99519938278195" x2="5.164705420532226"
                                                                y2="320.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-xaxis-tick"></line>
                                                            <line id="SvgjsLine3330" x1="62.373750078735355"
                                                                y1="314.99519938278195" x2="62.373750078735355"
                                                                y2="320.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-xaxis-tick"></line>
                                                            <line id="SvgjsLine3331" x1="119.5827947369385"
                                                                y1="314.99519938278195" x2="119.5827947369385"
                                                                y2="320.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-xaxis-tick"></line>
                                                            <line id="SvgjsLine3332" x1="176.79183939514164"
                                                                y1="314.99519938278195" x2="176.79183939514164"
                                                                y2="320.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-xaxis-tick"></line>
                                                            <line id="SvgjsLine3333" x1="234.00088405334478"
                                                                y1="314.99519938278195" x2="234.00088405334478"
                                                                y2="320.99519938278195" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-xaxis-tick"></line>
                                                            <line id="SvgjsLine3342" x1="0" y1="313.99519938278195"
                                                                x2="275.89238357543945" y2="313.99519938278195"
                                                                stroke="transparent" stroke-dasharray="0"
                                                                stroke-linecap="butt"></line>
                                                            <line id="SvgjsLine3341" x1="0" y1="1" x2="0"
                                                                y2="313.99519938278195" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG3272"
                                                            class="apexcharts-rangebar-series apexcharts-plot-series">
                                                            <g id="SvgjsG3273" class="apexcharts-series"
                                                                seriesName="seriesx1" rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath3277"
                                                                    d="M 14.655403415526962 18.31638663066228L 90.93412962646107 18.31638663066228Q 90.93412962646107 18.31638663066228 90.93412962646107 18.31638663066228L 90.93412962646107 34.016146599801374Q 90.93412962646107 34.016146599801374 90.93412962646107 34.016146599801374L 90.93412962646107 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374z"
                                                                    fill="rgba(51,161,134,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 14.655403415526962 18.31638663066228L 90.93412962646107 18.31638663066228Q 90.93412962646107 18.31638663066228 90.93412962646107 18.31638663066228L 90.93412962646107 34.016146599801374Q 90.93412962646107 34.016146599801374 90.93412962646107 34.016146599801374L 90.93412962646107 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374z"
                                                                    pathFrom="M 14.655403415526962 18.31638663066228L 14.655403415526962 18.31638663066228L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 34.016146599801374L 14.655403415526962 18.31638663066228"
                                                                    data-range-y1="1633132800000"
                                                                    data-range-y2="1633824000000" cy="18.31638663066228"
                                                                    cx="90.93412962646107" j="0" val="1633824000000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="76.27872621093411"></path>
                                                                <path id="SvgjsPath3279"
                                                                    d="M 110.0038111791946 70.64891986112593L 195.81737816651003 70.64891986112593Q 195.81737816651003 70.64891986112593 195.81737816651003 70.64891986112593L 195.81737816651003 86.34867983026503Q 195.81737816651003 86.34867983026503 195.81737816651003 86.34867983026503L 195.81737816651003 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503z"
                                                                    fill="rgba(57,128,192,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 110.0038111791946 70.64891986112593L 195.81737816651003 70.64891986112593Q 195.81737816651003 70.64891986112593 195.81737816651003 70.64891986112593L 195.81737816651003 86.34867983026503Q 195.81737816651003 86.34867983026503 195.81737816651003 86.34867983026503L 195.81737816651003 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503z"
                                                                    pathFrom="M 110.0038111791946 70.64891986112593L 110.0038111791946 70.64891986112593L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 86.34867983026503L 110.0038111791946 70.64891986112593"
                                                                    data-range-y1="1633996800000"
                                                                    data-range-y2="1634774400000" cy="70.64891986112593"
                                                                    cx="195.81737816651003" j="1" val="1634774400000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="85.81356698731543"></path>
                                                                <path id="SvgjsPath3281"
                                                                    d="M 52.79476652099402 122.9814530915896L 148.14317428466165 122.9814530915896Q 148.14317428466165 122.9814530915896 148.14317428466165 122.9814530915896L 148.14317428466165 138.6812130607287Q 148.14317428466165 138.6812130607287 148.14317428466165 138.6812130607287L 148.14317428466165 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287z"
                                                                    fill="rgba(51,161,134,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 52.79476652099402 122.9814530915896L 148.14317428466165 122.9814530915896Q 148.14317428466165 122.9814530915896 148.14317428466165 122.9814530915896L 148.14317428466165 138.6812130607287Q 148.14317428466165 138.6812130607287 148.14317428466165 138.6812130607287L 148.14317428466165 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287z"
                                                                    pathFrom="M 52.79476652099402 122.9814530915896L 52.79476652099402 122.9814530915896L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 138.6812130607287L 52.79476652099402 122.9814530915896"
                                                                    data-range-y1="1633478400000"
                                                                    data-range-y2="1634342400000" cy="122.9814530915896"
                                                                    cx="148.14317428466165" j="2" val="1634342400000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="95.34840776366764"></path>
                                                                <path id="SvgjsPath3283"
                                                                    d="M 110.0038111791946 175.31398632205327L 205.35221894286224 175.31398632205327Q 205.35221894286224 175.31398632205327 205.35221894286224 175.31398632205327L 205.35221894286224 191.01374629119238Q 205.35221894286224 191.01374629119238 205.35221894286224 191.01374629119238L 205.35221894286224 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238z"
                                                                    fill="rgba(57,128,192,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 110.0038111791946 175.31398632205327L 205.35221894286224 175.31398632205327Q 205.35221894286224 175.31398632205327 205.35221894286224 175.31398632205327L 205.35221894286224 191.01374629119238Q 205.35221894286224 191.01374629119238 205.35221894286224 191.01374629119238L 205.35221894286224 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238z"
                                                                    pathFrom="M 110.0038111791946 175.31398632205327L 110.0038111791946 175.31398632205327L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 191.01374629119238L 110.0038111791946 175.31398632205327"
                                                                    data-range-y1="1633996800000"
                                                                    data-range-y2="1634860800000"
                                                                    cy="175.31398632205327" cx="205.35221894286224"
                                                                    j="3" val="1634860800000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="95.34840776366764"></path>
                                                                <path id="SvgjsPath3285"
                                                                    d="M 43.2599257446127 227.6465195525169L 148.14317428466165 227.6465195525169Q 148.14317428466165 227.6465195525169 148.14317428466165 227.6465195525169L 148.14317428466165 243.34627952165602Q 148.14317428466165 243.34627952165602 148.14317428466165 243.34627952165602L 148.14317428466165 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602z"
                                                                    fill="rgba(51,161,134,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 43.2599257446127 227.6465195525169L 148.14317428466165 227.6465195525169Q 148.14317428466165 227.6465195525169 148.14317428466165 227.6465195525169L 148.14317428466165 243.34627952165602Q 148.14317428466165 243.34627952165602 148.14317428466165 243.34627952165602L 148.14317428466165 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602z"
                                                                    pathFrom="M 43.2599257446127 227.6465195525169L 43.2599257446127 227.6465195525169L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 243.34627952165602L 43.2599257446127 227.6465195525169"
                                                                    data-range-y1="1633392000000"
                                                                    data-range-y2="1634342400000" cy="227.6465195525169"
                                                                    cx="148.14317428466165" j="4" val="1634342400000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="104.88324854004895"></path>
                                                                <path id="SvgjsPath3287"
                                                                    d="M 157.67801506101387 279.9790527829806L 243.4915820483293 279.9790527829806Q 243.4915820483293 279.9790527829806 243.4915820483293 279.9790527829806L 243.4915820483293 295.6788127521197Q 243.4915820483293 295.6788127521197 243.4915820483293 295.6788127521197L 243.4915820483293 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197z"
                                                                    fill="rgba(57,128,192,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="square"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-rangebar-area" index="0"
                                                                    clip-path="url(#gridRectMaskq1ul3jya)"
                                                                    pathTo="M 157.67801506101387 279.9790527829806L 243.4915820483293 279.9790527829806Q 243.4915820483293 279.9790527829806 243.4915820483293 279.9790527829806L 243.4915820483293 295.6788127521197Q 243.4915820483293 295.6788127521197 243.4915820483293 295.6788127521197L 243.4915820483293 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197z"
                                                                    pathFrom="M 157.67801506101387 279.9790527829806L 157.67801506101387 279.9790527829806L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 295.6788127521197L 157.67801506101387 279.9790527829806"
                                                                    data-range-y1="1634428800000"
                                                                    data-range-y2="1635206400000" cy="279.9790527829806"
                                                                    cx="243.4915820483293" j="5" val="1635206400000"
                                                                    barHeight="15.699759969139098"
                                                                    barWidth="85.81356698731543"></path>
                                                                <g id="SvgjsG3275"
                                                                    class="apexcharts-rangebar-goals-markers"
                                                                    style="pointer-events: none">
                                                                    <g id="SvgjsG3276"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG3278"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG3280"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG3282"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG3284"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG3286"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG3274" class="apexcharts-datalabels"
                                                                data:realIndex="0"></g>
                                                        </g>
                                                        <line id="SvgjsLine3343" x1="0" y1="0" x2="275.89238357543945"
                                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                                            stroke-width="1" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine3344" x1="0" y1="0" x2="275.89238357543945"
                                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                                            stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                                        </line>
                                                        <g id="SvgjsG3345" class="apexcharts-yaxis-annotations"></g>
                                                        <g id="SvgjsG3346" class="apexcharts-xaxis-annotations"></g>
                                                        <g id="SvgjsG3347" class="apexcharts-point-annotations"></g>
                                                        <rect id="SvgjsRect3348" width="0" height="0" x="0" y="0" rx="0"
                                                            ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fefefe"
                                                            class="apexcharts-zoom-rect"></rect>
                                                        <rect id="SvgjsRect3349" width="0" height="0" x="0" y="0" rx="0"
                                                            ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fefefe"
                                                            class="apexcharts-selection-rect"></rect>
                                                    </g>
                                                    <rect id="SvgjsRect3238" width="0" height="0" x="0" y="0" rx="0"
                                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe"></rect>
                                                    <g id="SvgjsG3235" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend" style="max-height: 190.5px;"></div>
                                                <div class="apexcharts-tooltip apexcharts-theme-light">
                                                    <div class="apexcharts-tooltip-title"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    </div>
                                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                            class="apexcharts-tooltip-marker"
                                                            style="background-color: rgb(0, 143, 251);"></span>
                                                        <div class="apexcharts-tooltip-text"
                                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                            <div class="apexcharts-tooltip-y-group"><span
                                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                                    class="apexcharts-tooltip-text-y-value"></span>
                                                            </div>
                                                            <div class="apexcharts-tooltip-goals-group"><span
                                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                                    class="apexcharts-tooltip-text-goals-value"></span>
                                                            </div>
                                                            <div class="apexcharts-tooltip-z-group"><span
                                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                                    class="apexcharts-tooltip-text-z-value"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                    <div class="apexcharts-yaxistooltip-text"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="resize-triggers d-none">
                                            <div class="expand-trigger">
                                                <div style="width: 396px; height: 397px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title mb-0">Manage Orders</h5>
                                            <div class="ms-auto">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted font-size-12">Sort By: </span> <span
                                                            class="fw-medium"> Weekly<i
                                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-xl-1">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-centered align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Product Name</th>
                                                        <th>Variant</th>
                                                        <th>Type</th>
                                                        <th>Stock</th>
                                                        <th>Price</th>
                                                        <th>Sales</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1.</td>
                                                        <td><a href="javascript: void(0);" class="text-body">Iphone 12
                                                                Max
                                                                Pro</a> </td>
                                                        <td>
                                                            <i
                                                                class="mdi mdi-circle font-size-10 me-1 align-middle text-secondary"></i>
                                                            Gray
                                                        </td>
                                                        <td>
                                                            Electronic
                                                        </td>
                                                        <td>
                                                            1,564 Items
                                                        </td>
                                                        <td>
                                                            $1200
                                                        </td>
                                                        <td>
                                                            900
                                                        </td>

                                                        <td style="width: 130px;">
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar progress-bar-striped bg-success"
                                                                    role="progressbar" style="width: 75%"
                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else
                                                                        here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>2.</td>
                                                        <td><a href="javascript: void(0);" class="text-body">New Red and
                                                                White jacket </a> </td>
                                                        <td>
                                                            <i
                                                                class="mdi mdi-circle font-size-10 me-1 align-middle text-danger"></i>
                                                            Red
                                                        </td>
                                                        <td>
                                                            Fashion
                                                        </td>
                                                        <td>
                                                            568 Items
                                                        </td>
                                                        <td>
                                                            $300
                                                        </td>
                                                        <td>
                                                            650
                                                        </td>

                                                        <td style="width: 130px;">
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar progress-bar-striped bg-success"
                                                                    role="progressbar" style="width: 70%"
                                                                    aria-valuenow="70" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else
                                                                        here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>3.</td>
                                                        <td><a href="javascript: void(0);" class="text-body">Latest
                                                                Series
                                                                Watch OS 8</a> </td>
                                                        <td>
                                                            <i
                                                                class="mdi mdi-circle font-size-10 me-1 align-middle text-primary"></i>
                                                            Dark
                                                        </td>
                                                        <td>
                                                            Electronic
                                                        </td>
                                                        <td>
                                                            1,232 Items
                                                        </td>
                                                        <td>
                                                            $250
                                                        </td>
                                                        <td>
                                                            350
                                                        </td>

                                                        <td style="width: 130px;">
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar progress-bar-striped bg-primary"
                                                                    role="progressbar" style="width: 75%"
                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else
                                                                        here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td><a href="javascript: void(0);" class="text-body">New Horror
                                                                Book</a> </td>
                                                        <td>
                                                            <i
                                                                class="mdi mdi-circle font-size-10 me-1 align-middle text-success"></i>
                                                            Green
                                                        </td>
                                                        <td>
                                                            Book
                                                        </td>
                                                        <td>
                                                            1,564 Items
                                                        </td>
                                                        <td>
                                                            $1200
                                                        </td>
                                                        <td>
                                                            900
                                                        </td>

                                                        <td style="width: 130px;">
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar progress-bar-striped bg-success"
                                                                    role="progressbar" style="width: 50%"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else
                                                                        here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td><a href="javascript: void(0);" class="text-body">Smart 4k
                                                                Android TV</a> </td>
                                                        <td>
                                                            <i
                                                                class="mdi mdi-circle font-size-10 me-1 align-middle text-primary"></i>
                                                            Gray
                                                        </td>
                                                        <td>
                                                            Electronic
                                                        </td>
                                                        <td>
                                                            5,632 Items
                                                        </td>
                                                        <td>
                                                            $700
                                                        </td>
                                                        <td>
                                                            600
                                                        </td>

                                                        <td style="width: 130px;">
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar progress-bar-striped bg-pricing"
                                                                    role="progressbar" style="width: 90%"
                                                                    aria-valuenow="90" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else
                                                                        here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <!-- content category -->
                <div class="tab-pane fade" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-category-tab"
                    tabindex="0">
                    <div class="main-content">
                        <div class="mt-xl-0 text-center display-5 bold title">Category</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-inline-block">
                                                        <div
                                                            class="position-relative d-flex justify-content-end align-items-center">
                                                            <input type="text" class="form-control"
                                                                placeholder="Search...">
                                                            <i class="bi bi-search search-icon position-absolute"
                                                                style="right: 10px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="togle-modal">
                                                        <button type="button"
                                                            class="primary-btn-sm"
                                                            data-bs-toggle="modal" data-bs-target=".addNewCategory">
                                                            Add New Category
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade addNewCategory w-100" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-fullscreen h-100">
                                                                <div class="modal-content container my-5">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add New Category</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form">
                                                                            <form action="" method="post">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <input type="text"
                                                                                                name="category-name"
                                                                                                placeholder="Category Name">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                placeholder="Enter Description"
                                                                                                rows="4"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <select class="form-select">
                                                                                                <option selected>Not
                                                                                                    available</option>
                                                                                                <option value="1">One
                                                                                                </option>
                                                                                                <option value="2">Two
                                                                                                </option>
                                                                                                <option value="3">Three
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="file"
                                                                                                class="labelFile">
                                                                                                <span><svg
                                                                                                        xml:space="preserve"
                                                                                                        viewBox="0 0 184.69 184.69"
                                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        id="Capa_1"
                                                                                                        version="1.1"
                                                                                                        width="60px"
                                                                                                        height="60px">
                                                                                                        <g>
                                                                                                            <g>
                                                                                                                <g>
                                                                                                                    <path
                                                                                                                        d="M149.968,50.186c-8.017-14.308-23.796-22.515-40.717-19.813
                                                                    C102.609,16.43,88.713,7.576,73.087,7.576c-22.117,0-40.112,17.994-40.112,40.115c0,0.913,0.036,1.854,0.118,2.834
                                                                    C14.004,54.875,0,72.11,0,91.959c0,23.456,19.082,42.535,42.538,42.535h33.623v-7.025H42.538
                                                                    c-19.583,0-35.509-15.929-35.509-35.509c0-17.526,13.084-32.621,30.442-35.105c0.931-0.132,1.768-0.633,2.326-1.392
                                                                    c0.555-0.755,0.795-1.704,0.644-2.63c-0.297-1.904-0.447-3.582-0.447-5.139c0-18.249,14.852-33.094,33.094-33.094
                                                                    c13.703,0,25.789,8.26,30.803,21.04c0.63,1.621,2.351,2.534,4.058,2.14c15.425-3.568,29.919,3.883,36.604,17.168
                                                                    c0.508,1.027,1.503,1.736,2.641,1.897c17.368,2.473,30.481,17.569,30.481,35.112c0,19.58-15.937,35.509-35.52,35.509H97.391
                                                                    v7.025h44.761c23.459,0,42.538-19.079,42.538-42.535C184.69,71.545,169.884,53.901,149.968,50.186z"
                                                                                                                        style="fill:#010002;">
                                                                                                                    </path>
                                                                                                                </g>
                                                                                                                <g>
                                                                                                                    <path
                                                                                                                        d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
                                                                    c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
                                                                    L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
                                                                    c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
                                                                    C104.91,91.608,107.183,91.608,108.586,90.201z" style="fill:#010002;">
                                                                                                                    </path>
                                                                                                                </g>
                                                                                                            </g>
                                                                                                        </g>
                                                                                                    </svg></span>
                                                                                                <p>drag and drop your
                                                                                                    file here or
                                                                                                    click to upload
                                                                                                    image!</p>
                                                                                            </label>
                                                                                            <input
                                                                                                class="input-upload d-none"
                                                                                                name="text" id="file"
                                                                                                type="file" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col text-end">
                                                                                        <button type="submit"
                                                                                            class="danger-btn"> <i
                                                                                                class="bi bi-trash3"></i>
                                                                                            Cancel </button>
                                                                                        <button type="submit" 
                                                                                            class="success-btn"><i
                                                                                                class="bi bi-file-earmark-text"></i>
                                                                                            Save </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-check">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 20px;" class="align-middle">
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="checkAll">
                                                                    <label class="form-check-label"
                                                                        for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th class="align-middle">Image</th>
                                                            <th class="align-middle">Name</th>
                                                            <th class="align-middle">Description</th>
                                                            <th class="align-middle">Total Product</th>
                                                            <th class="align-middle">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript: void(0);"
                                                                    class="text-body fw-bold">#SK2545</a> </td>
                                                            <td>Jacob Hunter</td>
                                                            <td>
                                                                04 Oct, 2019
                                                            </td>
                                                            <td>
                                                                $392
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-3">
                                                                    <a href=""><i class="bi bi-brush color-primary"></i></a>
                                                                    <a href=""><i class="bi bi-trash3 color-danger"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- content product  -->
                <div class="tab-pane fade" id="v-pills-products" role="tabpanel" aria-labelledby="v-pills-products-tab"
                    tabindex="0">
                    <div class="main-content">
                        <div class="mt-xl-0 text-center display-5 bold title">Product</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-inline-block">
                                                        <div
                                                            class="position-relative d-flex justify-content-end align-items-center">
                                                            <input type="text" class="form-control"
                                                                placeholder="Search...">
                                                            <i class="bi bi-search search-icon position-absolute"
                                                                style="right: 10px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="togle-modal">
                                                        <button type="button"
                                                            class="primary-btn-sm"
                                                            data-bs-toggle="modal" data-bs-target=".addNewProduct">
                                                            Add New Product
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade addNewProduct w-100" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-fullscreen h-100">
                                                                <div class="modal-content container my-5">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add New Product</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form">
                                                                            <form action="" method="post">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <input type="text"
                                                                                                name="product-name"
                                                                                                placeholder="Product Name">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <input type="text"
                                                                                                name="product-stock"
                                                                                                placeholder="Product Stock">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                placeholder="Enter Description"
                                                                                                rows="4"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <input type="text"
                                                                                                name="product-price"
                                                                                                placeholder="Product Price">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <select class="form-select">
                                                                                                <option selected>select
                                                                                                    category</option>
                                                                                                <option value="1">One
                                                                                                </option>
                                                                                                <option value="2">Two
                                                                                                </option>
                                                                                                <option value="3">Three
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                        <label for="file"
                                                                                        class="labelFile">
                                                                                                <svg
                                                                                                        xml:space="preserve"
                                                                                                        viewBox="0 0 184.69 184.69"
                                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        id="Capa_1"
                                                                                                        version="1.1"
                                                                                                        width="60px"
                                                                                                        height="60px">
                                                                                                        <g>
                                                                                                            <g>
                                                                                                                <g>
                                                                                                                    <path
                                                                                                                        d="M149.968,50.186c-8.017-14.308-23.796-22.515-40.717-19.813
                                                                    C102.609,16.43,88.713,7.576,73.087,7.576c-22.117,0-40.112,17.994-40.112,40.115c0,0.913,0.036,1.854,0.118,2.834
                                                                    C14.004,54.875,0,72.11,0,91.959c0,23.456,19.082,42.535,42.538,42.535h33.623v-7.025H42.538
                                                                    c-19.583,0-35.509-15.929-35.509-35.509c0-17.526,13.084-32.621,30.442-35.105c0.931-0.132,1.768-0.633,2.326-1.392
                                                                    c0.555-0.755,0.795-1.704,0.644-2.63c-0.297-1.904-0.447-3.582-0.447-5.139c0-18.249,14.852-33.094,33.094-33.094
                                                                    c13.703,0,25.789,8.26,30.803,21.04c0.63,1.621,2.351,2.534,4.058,2.14c15.425-3.568,29.919,3.883,36.604,17.168
                                                                    c0.508,1.027,1.503,1.736,2.641,1.897c17.368,2.473,30.481,17.569,30.481,35.112c0,19.58-15.937,35.509-35.52,35.509H97.391
                                                                    v7.025h44.761c23.459,0,42.538-19.079,42.538-42.535C184.69,71.545,169.884,53.901,149.968,50.186z"
                                                                                                                        style="fill:#010002;">
                                                                                                                    </path>
                                                                                                                </g>
                                                                                                                <g>
                                                                                                                    <path
                                                                                                                        d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
                                                                    c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
                                                                    L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
                                                                    c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
                                                                    C104.91,91.608,107.183,91.608,108.586,90.201z" style="fill:#010002;">
                                                                                                                    </path>
                                                                                                                </g>
                                                                                                            </g>
                                                                                                        </g>
                                                                                                    </svg></span>
                                                                                                <p>Drag and drop your
                                                                                                    file here or
                                                                                                    click to upload
                                                                                                    image!</p>
                                                                                            </label>
                                                                                            <input
                                                                                                class="input-upload d-none"
                                                                                                name="text" id="file"
                                                                                                type="file" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col text-end">
                                                                                        <button type="submit"
                                                                                            class="danger-btn"> <i
                                                                                                class="bi bi-trash3"></i>
                                                                                            Cancel </button>
                                                                                        <button type="submit" 
                                                                                            class="success-btn"><i
                                                                                                class="bi bi-file-earmark-text"></i>
                                                                                            Save </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-check">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 20px;" class="align-middle">
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="checkAll">
                                                                    <label class="form-check-label"
                                                                        for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th class="align-middle"><img
                                                                    src="https://cdn-icons-png.flaticon.com/128/739/739249.png"
                                                                    alt="" style="height: 20px; width: 20px;"></th>
                                                            <th class="align-middle">Name</th>
                                                            <th class="align-middle">Description</th>
                                                            <th class="align-middle">price</th>
                                                            <th class="align-middle">Stock</th>
                                                            <th class="align-middle">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript: void(0);"
                                                                    class="text-body fw-bold">#SK2545</a> </td>
                                                            <td>Jacob Hunter</td>
                                                            <td>
                                                                04 Oct, 2019
                                                            </td>
                                                            <td>
                                                                $392
                                                            </td>
                                                            <td>
                                                                1
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-3">
                                                                    <a href=""><i class="bi bi-brush color-primary"></i></a>
                                                                    <a href=""><i class="bi bi-trash3 color-danger"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- content order  -->
                <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab"
                    tabindex="0">
                    <div class="main-content">
                        <div class="mt-xl-0 text-center display-5 bold title">Orders</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-inline-block">
                                                        <div
                                                            class="position-relative d-flex justify-content-end align-items-center">
                                                            <input type="text" class="form-control"
                                                                placeholder="Search...">
                                                            <i class="bi bi-search search-icon position-absolute"
                                                                style="right: 10px;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-check">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 20px;" class="align-middle">
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="checkAll">
                                                                    <label class="form-check-label"
                                                                        for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th class="align-middle">Order</th>
                                                            <th class="align-middle">Day</th>
                                                            <th class="align-middle">Status</th>
                                                            <th class="align-middle">Total</th>
                                                            <th class="align-middle">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript: void(0);"
                                                                    class="text-body fw-bold">#SK2545</a> </td>
                                                            <td>04 Oct, 2019</td>

                                                            <td>
                                                                <span
                                                                    class="badge rounded-pill success">Paid</span>
                                                            </td>
                                                            <td>
                                                                $392
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-3">
                                                                    <a href=""><i class="bi bi-brush color-primary"></i></a>
                                                                    <a href=""><i class="bi bi-trash3 color-danger"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- content member  -->
                <div class="tab-pane fade" id="v-pills-member" role="tabpanel" aria-labelledby="v-pills-member-tab"
                    tabindex="0">
                    <div class="main-content">
                        <div class="mt-xl-0 text-center display-5 bold title">Member</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-inline-block">
                                                        <div
                                                            class="position-relative d-flex justify-content-end align-items-center">
                                                            <input type="text" class="form-control"
                                                                placeholder="Search...">
                                                            <i class="bi bi-search search-icon position-absolute"
                                                                style="right: 10px;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-check">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 20px;" class="align-middle">
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="checkAll">
                                                                    <label class="form-check-label"
                                                                        for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th class="align-middle">User Name</th>
                                                            <th class="align-middle">Name</th>
                                                            <th class="align-middle">E-Mail</th>
                                                            <th class="align-middle">Role</th>
                                                            <th class="align-middle">Orders</th>
                                                            <th class="align-middle">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="" class="text-body fw-bold">#SK2545</a> </td>
                                                            <td>Gnuh</td>

                                                            <td>
                                                                gnuh@gamil.com
                                                            </td>
                                                            <td>
                                                                $392
                                                            </td>
                                                            <td>
                                                                11
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-3">
                                                                    <a href=""><i class="bi bi-brush color-primary"></i></a>
                                                                    <a href=""><i class="bi bi-trash3 color-danger"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"
                    tabindex="0">Logout</div>
            </div>
        </div>
    </section>
    <script>function switchTab(tabName) {

    var tab = new bootstrap.Tab(document.getElementById(`v-pills-${tabName}-tab`));
    tab.show();
}</script>';
    }
}
?>