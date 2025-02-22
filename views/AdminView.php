<?php class AdminView
{
    function displaySidebar($page = "dashboard")
    {
        echo '
        <div class="container d-flex">
        <div class="nav flex-column nav-pills mt-5 fixed" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a href="admin/dashboard"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'dashboard') ? 'active' : '';
        echo '"><i class="bi bi-bar-chart-line"></i>Dashboard </button><a>
                <a href="admin/category"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'category') ? 'active' : '';
        echo '"><i class="bi bi-grid"></i> Category</button><a>
                <a href="admin/product"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'product') ? 'active' : '';
        echo '"><i class="bi bi-archive"></i>Product</button><a>
                <a href="admin/order"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'order') ? 'active' : '';
        echo '"><i class="bi bi-bell"></i>Order </button><a>
                <a href="admin/member"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'member') ? 'active' : '';
        echo '"><i class="bi bi-people"></i>Member </button><a>
                <a href="admin/review"><button class="nav-link d-flex justify-content-start gap-1 ';
        echo ($page == 'review') ? 'active' : '';
        echo '" ><i class="bi bi-brush"></i>Reviews</button><a>
            <!-- <a href="admin/discount"><button class="nav-link d-flex justify-content-start gap-1 --> ';
        // echo ($page == 'discount') ? 'active' : '';
        // echo '"><i class="bi bi-cash-coin"></i>Discount</button><a>
        //         <a href="admin/shipping"><button class="nav-link d-flex justify-content-start gap-1 ';
        // echo ($page == 'shipping') ? 'active' : '';
        // echo '"><i class="bi bi-box"></i>Shipping </button><a>
        echo '<a href="user/account/logout"><button class="nav-link d-flex justify-content-start gap-1"><i class="bi bi-box-arrow-left"></i>Logout</button></a>
            </div>';
    }
    function displayAdminDashboard($orders, $statusOption, $total_pages, $current_page, $limit)
    {
        echo '<main class="main-content p-3">
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
                                        <a href="admin/member" class="btn btn3 btn-sm text-nowrap">See Member</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card text-center warning">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">1-</h4>
                                        <p class="card-text">Reviews</p>
                                        <a href="admin/review" class="btn btn3 btn-sm text-nowrap">See Reviews</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card text-center success">
                                    <div class="card-body">
                                        <h4 class="card-title h2 bold">' . count($orders) . '</h4>
                                        <p class="card-text">Orders</p>
                                        <a href="admin/order" class="btn btn3 btn-sm text-nowrap">See Orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--order-->
                        
                        <div class="row mt-5">
                    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                    ' . $this->formSearch('order') . '
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-check">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;" class="align-middle">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle fw-bold">Order</th>
                                        <th class="align-middle fw-bold">Customer</th>
                                        <th class="align-middle fw-bold">Status</th>
                                        <th class="align-middle fw-bold">Total</th>
                                        <th class="align-middle fw-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ';
        foreach ($orders as $order) {
            echo '<tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="orderidcheck06">
                                                <label class="form-check-label" for="orderidcheck06"></label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#' .
                $order['order_id'] . '</a> </td>
                                        <td>' . formatDate($order['order_created_at']) . '</td>
                                        <td>';
            if ($order['order_status'] == "pending") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer warning">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "processing") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer blue">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "shipped") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer success">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "delivered") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer success">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "cancelled") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer danger">' . $order['order_status'] .
                    '</span>';
            } else {
                echo '<div class="status-unknown">Unknown Status</div>';
            }
            echo '
            ' . $this->modalChangeStatus($order['order_id'], $order['order_status'], $statusOption) . '
            </td>
            <td>
            $' . $order['total_amount'] . '
            </td>
            <td>
            <div class="d-flex gap-1">
            <i class="bi bi-pencil-square link" data-bs-toggle="modal" data-bs-target=".modalOrderDetail' . $order['order_id'] . '">Order details</i>
            ' . $this->modalOrderDetail($order['order_details'], $order['order_id']) . '
                                            </div>
                                            </td>
                                            </tr>';
        }
        echo '</tbody>
                                            </table>
                                            ' . $this->pagination('admin/dashboard/order', $total_pages, $current_page, $limit) . '
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                            </div>
                            <!-- end row -->
                            </div>
                            <!-- order-->
                        
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
                                                        <!-- <div class="simplebar-placeholder"
                                                            style="width: auto; min-height: 390px;">
                                                        </div> -->
                                                    </div>
                                                    <!-- <div class="simplebar-track simplebar-horizontal"
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
                                                    </div> -->
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
                        
                    </main>
                    </div>';
    }
    function displayAdminCategory($allCategory, $categories, $total_pages, $current_page, $limit)
    {
        echo '<div class="main-content p-3">
    <div class="mt-xl-0 text-center display-5 bold title">Category</div>
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                ' . $this->formSearch('category') . '
                                </div>
                                <div class="togle-modal">
                                    <button type="button" class="primary-btn-sm" data-bs-toggle="modal"
                                        data-bs-target=".addNewCategory">
                                        Add New Category
                                    </button>
                                    
<!-- Modal -->

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-check">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;" class="align-middle">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle fw-bold"><img src="assets/img/image-default.png"></th>
                                        <th class="align-middle fw-bold">Name</th>
                                        <th class="align-middle fw-bold">Description</th>
                                        <th class="align-middle fw-bold">Total Product</th>
                                        <th class="align-middle fw-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ';
        foreach ($categories as $c) {
            echo '<tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="orderidcheck06">
                                                <label class="form-check-label" for="orderidcheck06"></label>
                                            </div>
                                        </td>
                                        <td><img src="assets/img/categories/' . $c->getCategoryImage() . '"> </td>
                                        <td>' . $c->getCategoryName() . '</td>
                                        <td class="text-nowrap text-truncate" style="max-width: 500px">' .
                $c->getCategoryDescription() . '</td>
                                        <td>' . $c->total_product . '</td>
                                        <td>
                                            <div class="d-flex gap-1">

                                                <i class="bi bi-brush color-primary cursor-pointer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target=".editCategory' . $c->getCategoryId() . '"></i>
                                                <div class="togle-modal formEdit">
                                                    <!-- Modal -->
                                                    <div class="modal fade editCategory' . $c->getCategoryId() . ' w-100"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-fullscreen h-100">
                                                            <div class="modal-content container my-5">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Category</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                ';
            $this->modalEditCategory($allCategory, $c);
            echo '

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<i class="bi bi-trash3 color-danger cursor-pointer" onclick="showDeleteConfirmModal(' . $c->getCategoryId() . ', \'admin/category/delete/\')"></i>
                                            </div>
                                        </td>
                                    </tr>';
        }
        echo '
                                </tbody>
                            </table>
                            ' . $this->pagination('admin/category', $total_pages, $current_page, $limit) . '
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>';
        $this->modalInsertCategory($categories);
        $this->modalConfirm();
    }
    function displayAdminProduct($products, $total_pages, $current_page, $limit, $categories = [])
    {
        echo '<div class="main-content p-3">
                        <div class="mt-xl-0 text-center display-5 bold title">Product</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                                    ' . $this->formSearch('product') . '
                                                    </div>
                                                    <div class="togle-modal">
                                                        <button type="button"
                                                            class="primary-btn-sm"
                                                            data-bs-toggle="modal" data-bs-target=".addNewProduct">
                                                            Add New Product
                                                        </button>
                                                    </div>
                                                    ';
        echo '</div>
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
                                                            <th class="align-middle fw-bold"><img
                                                                    src="assets/img/image-default.png"
                                                                    alt=""></th>
                                                            <th class="align-middle fw-bold">Name</th>
                                                            <th class="align-middle fw-bold">Description</th>
                                                            <th class="align-middle fw-bold">Price</th>
                                                            <th class="align-middle fw-bold">Stock</th>
                                                            <th class="align-middle fw-bold">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ';
        foreach ($products as $p) {
            echo '<tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td><img src="assets/img/products/' . $p->getProductImage() . '"></td>
                                                            <td>' . $p->getProductName() . '</td>
                                                            <td class="text-nowrap text-truncate" style="max-width: 500px">' . $p->getProductDescription() . '</td>
                                                            <td>
                                                                ' . $p->getProductPrice() . '
                                                            </td>
                                                            <td>
                                                                ' . $p->getProductStock() . '
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-3">
                                                                    <i class="bi bi-brush color-primary cursor-pointer" data-bs-toggle="modal" data-bs-target=".editProduct' . $p->getProductId() . '"></i>';
            $this->modalEditProduct($p, $categories);
            echo '
                                                                    <i class="bi bi-trash3 color-danger cursor-pointer" onclick="showDeleteConfirmModal(' . $p->getProductId() . ', \'admin/product/delete/\')"></i>
                                                                </div>
                                                            </td>
                                                        </tr>';
        }
        echo '
                                                    </tbody>
                                                    </table>
                                                    ' . $this->pagination('admin/product', $total_pages, $current_page, $limit) . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>';
        $this->modalInsertProduct($categories);
        $this->modalConfirm();
    }
    function displayAdminOrder($orders, $statusOption, $total_pages, $current_page, $limit)
    {
        echo '<div class="main-content p-3">
    <div class="mt-xl-0 text-center display-5 bold title">Orders</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                    ' . $this->formSearch('order') . '
                                    <!-- <div class="center gap-1">
                                        <i class="bi bi-clock-history"></i>
                                        <select class="form-select">
                                            <option selected value="1">7 days</option>
                                            <option value="2">14 days</option>
                                            <option value="3">30 days</option>
                                        </select>
                                    </div>
                                    <div class="center gap-1">
                                        <i class="bi bi-eye"></i>
                                        <select class="form-select">
                                            <option selected value="1">7</option>
                                            <option value="2">14</option>
                                            <option value="3">30</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-check">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;" class="align-middle">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle fw-bold">Order</th>
                                        <th class="align-middle fw-bold">Customer</th>
                                        <th class="align-middle fw-bold">Product Name</th>
                                        <th class="align-middle fw-bold">Status</th>
                                        <th class="align-middle fw-bold">Total</th>
                                        <th class="align-middle fw-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ';
        foreach ($orders as $order) {
            echo '<tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="orderidcheck06">
                                                <label class="form-check-label" for="orderidcheck06"></label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#' .
                $order['order_id'] . '</a> </td>
                                        <td>' . $order['order_details'][0]['user_name'] . '</td>
                                        <td>' . $order['order_details'][0]['product_name'] . '</td>
                                        <td>';
            if ($order['order_status'] == "pending") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer warning">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "processing") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer blue">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "shipped") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer success">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "delivered") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer success">' . $order['order_status'] .
                    '</span>';
            } elseif ($order['order_status'] == "cancelled") {
                echo '<span  data-bs-toggle="modal" data-bs-target=".modalChangeStatus' . $order['order_id'] . '" class="badge rounded-pill cursor-pointer danger">' . $order['order_status'] .
                    '</span>';
            } else {
                echo '<div class="status-unknown">Unknown Status</div>';
            }
            if($order['order_status'] !== 'cancelled'){
                echo $this->modalChangeStatus($order['order_id'], $order['order_status'], $statusOption);
            };
            echo '
            </td>
            <td>
            $' . $order['total_amount'] . '
            </td>
            <td>
            <div class="d-flex gap-1">
            <i class="bi bi-pencil-square link" data-bs-toggle="modal" data-bs-target=".modalOrderDetail' . $order['order_id'] . '">Order details</i>
            ' . $this->modalOrderDetail($order['order_details'], $order['order_id']) . '
                                            </div>
                                            </td>
                                            </tr>';
        }
        echo '</tbody>
                                            </table>
                                            ' . $this->pagination('admin/order', $total_pages, $current_page, $limit) . '
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                            </div>
                            <!-- end row -->
                            
                            </div> <!-- container-fluid -->
                            </div>';
    }
    function displayAdminMember($members, $total_pages, $current_page, $limit)
    {
        echo '<div class="main-content p-3">
                        <div class="mt-xl-0 text-center display-5 bold title">Member</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                                    ' . $this->formSearch('member') . '
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
                                                            <th class="align-middle fw-bold">User Name</th>
                                                            <th class="align-middle fw-bold">Name</th>
                                                            <th class="align-middle fw-bold">E-Mail</th>
                                                            <th class="align-middle fw-bold">Role</th>
                                                            <th class="align-middle fw-bold">Orders</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ';
        foreach ($members as $m) {
            echo '<tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td>' . $m->getUserName() . '</td>
                                                            <td>' . $m->getFullName() . '</td>

                                                            <td>
                                                                ' . $m->getEmail() . '
                                                            </td>
                                                            <td>
                                                                ' . $m->getRole() . '
                                                            </td>
                                                            <td>
                                                                ' . $m->total_order . '
                                                            </td>
                                                        </tr>';
        }
        echo '
                                                    </tbody>
                                                </table>
                            ' . $this->pagination('admin/member', $total_pages, $current_page, $limit) . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>';
    }
    function displayAdminReview($reviews = [], $total_pages = 0, $current_page = 0, $limit = 0)
    {
        echo '<div class="main-content p-3">
                        <div class="mt-xl-0 text-center display-5 bold title">Reviews</div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-between">
                                                    <div class="search-box me-2 mb-2 d-flex align-items-center gap-3">
                                                    ' . $this->formSearch('review') . '
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
                                                            <th class="align-middle fw-bold">Author</th>
                                                            <th class="align-middle fw-bold">Rating</th>
                                                            <th class="align-middle fw-bold">Evaluate</th>
                                                            <th class="align-middle fw-bold">Product</th>
                                                            <th class="align-middle fw-bold">Send to</th>
                                                            <th class="align-middle fw-bold">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ';
        foreach ($reviews as $review) {
            echo '<tr>
                                                            <td>
                                                                <div class="form-check font-size-16">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="orderidcheck06">
                                                                    <label class="form-check-label"
                                                                        for="orderidcheck06"></label>
                                                                </div>
                                                            </td>
                                                            <td>' . $review['fullname'] . '</td>
                                                            <td class="m-auto">


                                                            <div class="sin-product-details center">
                                                            <div class="woocommerce-product-rating center p-0 m-0">
                            <div class="star-rating center gap-1 center">';

            for ($i = 1; $i <= 5; $i++) {
                if ($i <= floor($review['rating'])) {
                    echo '<i class="bi bi-star-fill"></i>';
                } else {
                    echo '<i class="bi bi-star"></i>';
                }
            }
            echo '
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </td>
                                                            <td class="text-truncate" style="max-width: 300px">
                                                                ' . $review['comment'] . '
                                                            </td>
                                                            <td>
                                                                ' . $review['product_name'] . '
                                                            </td>
                                                            <td>
                                                                ' . formatDate($review['created_at']) . '
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-1">
                                                                    <a href="shop/product/' . $review['product_id'] . '"><i class="bi bi-eye color-primary"></i></a>

                                                                </div>
                                                            </td>
                                                        </tr>';
        }
        echo '
                                                    </tbody>
                                                </table>
                                                ' . $this->pagination('admin/member', $total_pages, $current_page, $limit) . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                </div>';
    }
    function displayAdminDiscount()
    {
        echo '';
    }
    function displayAdminShipping()
    {
        echo '';
    }
    function modalInsertCategory($categories)
    {
        echo '<!-- Modal -->
                                    <div class="modal fade addNewCategory w-100" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen h-100">
                                            <div class="modal-content container my-5">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form">
                                                        <form action="/gnuh/admin/category/insert" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <input type="text" name="category-name"
                                                                            placeholder="Category Name">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <textarea class="form-control"
                                                                            name="description"
                                                                            placeholder="Enter Description"
                                                                            rows="4"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <select name="parent-id" class="form-select">
                                                                            <option selected value="null">Select Parent
                                                                                Category(If not, leave blank)</option>
                                                                            ';
        foreach ($categories as $c) {
            echo '<option
                                                                                value="' . $c->getCategoryId() . '">' .
                $c->getCategoryName() . '
                                                                            </option>';
        }
        echo '
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="file" class="labelFile">
                                                                            <span><svg xml:space="preserve"
                                                                                    viewBox="0 0 184.69 184.69"
                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    id="Capa_1" version="1.1"
                                                                                    width="60px" height="60px">
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
                                                                                                <path d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
                                                                    c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
                                                                    L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
                                                                    c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
                                                                    C104.91,91.608,107.183,91.608,108.586,90.201z"
                                                                                                    style="fill:#010002;">
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
                                                                        <input class="input-upload" name="image"
                                                                            id="file" type="file" accept="image/*" />
                                                                    </div>
                                                                </div>
                                                                <div class="col text-end">
                                                                    <button type="button" class="danger-btn"
                                                                        data-bs-dismiss="modal" aria-label="Close"> <i
                                                                            class="bi bi-trash3"></i>
                                                                        Cancel </button>
                                                                    <button type="submit" class="success-btn"><i
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
<!-- Modal  -->
';
    }
    function modalEditCategory($allCategory, $c)
    {
        echo '<!-- Form Edit Category  -->
                                                                    <div class="form">
                                                                        <form action="/gnuh/admin/category/edit/' . $c->getCategoryId() . '"
                                                                            method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="mb-3">
                                                                                        <input type="text"
                                                                                            name="category-name"
                                                                                            placeholder="Category Name"
                                                                                            value="' . $c->getCategoryName() . '">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <textarea class="form-control"
                                                                                            name="description"
                                                                                            placeholder="Enter Description"
                                                                                            rows="4">' . $c->getCategoryDescription() . '</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="mb-3">
                                                                                        <select name="parent-id"
                                                                                            class="form-select">
                                                                                            <option selected
                                                                                                value="null">Select
                                                                                                Parent Category(If not,
                                                                                                leave blank) </option>';
        foreach ($allCategory as $cate):
            echo '<option value="' . $cate->getCategoryId() . '">' . $cate->getCategoryName() . '</option>';
        endforeach;
        echo '
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="new-file-' . $c->getCategoryId() . '"
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
                                                                                                                <path d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
                                                                        c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
                                                                        L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
                                                                        c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
                                                                        C104.91,91.608,107.183,91.608,108.586,90.201z"
                                                                                                                    style="fill:#010002;">
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
                                                                                        <input class="input-upload"
                                                                                            name="new-image-' . $c->getCategoryId() . '"
                                                                                            id="new-file-' . $c->getCategoryId() . '"
                                                                                            type="file"
                                                                                            accept="image/*" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col text-end">
                                                                                    <button type="button"
                                                                                        class="danger-btn"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i class="bi bi-trash3"></i>
                                                                                        Cancel </button>
                                                                                    <button type="submit"
                                                                                        class="success-btn"><i
                                                                                            class="bi bi-file-earmark-text"></i>
                                                                                        Save </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
<!-- Form Edit Category  -->';
    }
    function modalInsertProduct($categories)
    {
        echo '
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
                        <form action="admin/product/insert" method="post" enctype="multipart/form-data">
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
                                            rows="4" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text"
                                            name="product-price"
                                            placeholder="Product Price">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="category-id">
                                            <option selected>Select
                                                Category</option>';
        foreach ($categories as $c) {
            echo '<option value="' . $c->getCategoryId() . '">' . $c->getCategoryName() . '</option>';
        }
        echo '</select>
                                    </div>
                                    <div class="mb-3">
                                    <label for="product-image"
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
                                        <input class="input-upload" name="image" id="product-image" type="file" accept="image/*" />
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <button type="button"
                                        class="danger-btn" data-bs-dismiss="modal"
                        aria-label="Close"> <i
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
    </div>';
    }
    function modalEditProduct($p, $categories)
    {
        echo '
    <!-- Modal -->
    <div class="modal fade editProduct' . $p->getProductId() . ' w-100" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen h-100">
            <div class="modal-content container my-5">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <form action="admin/product/edit/' . $p->getProductId() . '" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text"
                                            name="product-name"
                                            placeholder="Product Name" value="' . $p->getProductName() . '">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text"
                                            name="product-stock"
                                            placeholder="Product Stock" value="' . $p->getProductStock() . '">
                                    </div>
                                    <div class="mb-3">
                                        <textarea
                                            class="form-control"
                                            placeholder="Enter Description"
                                            rows="4" name="description">' . $p->getProductDescription() . '</textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text"
                                            name="product-price"
                                            placeholder="Product Price" value="' . $p->getProductPrice() . '">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="category-id">
                                            <option selected value="null">Select Category</option>';
        foreach ($categories as $c) {
            echo '<option value="' . $c->getCategoryId() . '">' . $c->getCategoryName() . '</option>';
        }
        echo '</select>
                                    </div>
                                    <div class="mb-3">
                                    <label for="new-image-product-' . $p->getProductId() . '"
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
                                        <input class="input-upload" name="new-image-product-' . $p->getProductId() . '" id="new-image-product-' . $p->getProductId() . '" type="file" accept="image/*" />
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <button type="button"
                                        class="danger-btn" data-bs-dismiss="modal"
                        aria-label="Close"> <i
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
    </div>';
    }
    function modalConfirm()
    {
        echo '
<!-- Modal Xác Nhận Xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="black-btn" data-bs-dismiss="modal" style="border-radius: 0;">Cancel</button>
                <a href="#" id="confirmDeleteBtn"><button class="danger-btn"> <i class="bi bi-trash3"></i>Delete</button></a>
            </div>
        </div>
    </div>
</div>
';

        echo '<script>
    function showDeleteConfirmModal(id, route) {
    let deleteUrl = route + id;
    document.getElementById("confirmDeleteBtn").href = deleteUrl;
    let deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
    deleteModal.show();
}
    </script>';
    }

    function modalChangeStatus($order_id, $current_status, $statusOption)
    {
        echo '
<!-- Modal change status -->
<div class="modal fade modalChangeStatus' . $order_id . '" tabindex="-1" aria-labelledby="modalChangeStatus' . $order_id . '" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChangeStatus' . $order_id . '">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="admin/order/changestatus" method="post">
            <input type="number" value="' . $order_id . '" name="order_id" hidden>
                <div class="mb-3">
                <select class="form-select" name="order_status">';
        foreach ($statusOption as $option) {
            echo '<option ';
            echo ($current_status == $option) ?
                'selected' : '';
            echo ' value="' . $option . '">' . $option . '</option>';
        }
        echo '</select>
            </div>
            <div class="col text-end">
            <button type="button" class="danger-btn" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
            <button type="submit" class="success-btn"><i class="bi bi-file-earmark-text"></i>Save </button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
';
    }

    function modalOrderDetail($order_details, $order_id)
    {
        echo '
        <!-- Modal -->
        <div class="modal fade modalOrderDetail' . $order_id . '" id="modalOrderDetail" tabindex="-1" aria-labelledby="modalOrderDetailLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="container modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="modalOrderDetailLabel">Order Detail</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="customer-' . $order_details[0]['order_detail_id'] . '" data-bs-toggle="tab" data-bs-target="#nav-customer-' . $order_details[0]['order_detail_id'] . '"
                        type="button" role="tab" aria-controls="nav-customer-' . $order_details[0]['order_detail_id'] . '" aria-selected="true">Customer</button>
                    <button class="nav-link" id="order-' . $order_details[0]['order_detail_id'] . '" data-bs-toggle="tab" data-bs-target="#nav-order-' . $order_details[0]['order_detail_id'] . '" type="button"
                        role="tab" aria-controls="nav-order-' . $order_details[0]['order_detail_id'] . '" aria-selected="true">Order</button>
                    <button class="nav-link" id="product-' . $order_details[0]['order_detail_id'] . '" data-bs-toggle="tab" data-bs-target="#nav-product-' . $order_details[0]['order_detail_id'] . '" type="button"
                        role="tab" aria-controls="nav-product-' . $order_details[0]['order_detail_id'] . '" aria-selected="true">Product</button>
                </div>
                <div class="tab-content  mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-customer-' . $order_details[0]['order_detail_id'] . '" role="tabpanel" aria-labelledby="nav-customer-' . $order_details[0]['order_detail_id'] . '-tab"
                        tabindex="0">
                        <div class="row">
                                <p><strong>Name:</strong> ' . $order_details[0]['user_name'] . '</p>
                                <p><strong>Email:</strong> ' . $order_details[0]['email'] . '</p>
                                <p><strong>Phone:</strong> ' . $order_details[0]['phone'] . '</p>
                                <p><strong>Shipping Address:</strong> ' . $order_details[0]['address'] . '</p>
                                <p><strong>Notes:</strong> Fast delivery, please.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-order-' . $order_details[0]['order_detail_id'] . '" role="tabpanel" aria-labelledby="nav-order-' . $order_details[0]['order_detail_id'] . '-tab" tabindex="0">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Order ID:</strong> #' . $order_details[0]['order_id'] . '</p>
                                <p><strong>Order Date:</strong> ' . formatDate($order_details[0]['created_at']) . '</p>
                                <p><strong>Status:</strong> ' . ucfirst($order_details[0]['order_status']) . '</p>
                                <p><strong>Payment Method:</strong> Cash on delivery</p>
                                <p><strong>Shipping Method:</strong> Standard Delivery</p>
                            </div>
                            <div class="col-6">';
        $fee = 5;
        echo '
                                <p><strong>Sub Total:</strong> $' . calculateSubtotal($order_details) . '</p>
                                
                                <p><strong>Shipping Fee:</strong> $' . getShippingFee() . '</p>
                                <p><strong>Discount:</strong> $' . $order_details[0]['discount_value'] . '</p>
                                <p class="mb-0"><strong>Total Amount: $' . calculateTotalAmount($order_details) . '</strong></p>
                                <p class="form-text text">
(which includes all fees such as tax, shipping, and service charges.)
</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-product-' . $order_details[0]['order_detail_id'] . '" role="tabpanel" aria-labelledby="nav-product-' . $order_details[0]['order_detail_id'] . '-tab" tabindex="0">
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><strong>Product Name</strong></th>
      <th scope="col"><strong>Quantity</strong></th>
      <th scope="col"><strong>Price</strong></th>
      <th scope="col"><strong>Total</strong></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">';
        $i = 0;
        foreach ($order_details as $order_detail) {
            echo '<tr>
<td scope="row">' . ++$i . '</td>
<td>' . $order_detail['product_name'] . '</td>
<td>' . $order_detail['quantity'] . '</td>
<td>' . $order_detail['price'] . '</td>
<td>' . $order_detail['price'] . '</td>
</tr>';
        }
        echo '
    <tr>
    <td colspan="3"></td>
    <td colspan="2" class="text-end"><strong>Total Amount: $' . calculateSubtotal($order_details) . '</strong></td>
    </tr>
  </tbody>
</table>
                    </div>
                </div>
            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="black-btn" data-bs-dismiss="modal" style="border-radius: 0;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    function formSearch($page)
    {
        $filterBy = 'Filter by';
        // Các trường tìm kiếm tùy chỉnh cho từng trang
        $fields = [];
        switch ($page) {
            case 'product':
                $fields = [
                    'name' => 'name',
                    'description' => 'description',
                    'price' => 'price',
                    'stock' => 'stock'
                ];
                break;

            case 'category':
                $fields = [
                    'name' => 'name',
                    'description' => 'description',
                ];
                break;
            case 'order':
                $fields = [
                    'order_id' => 'order',
                    'order_status' => 'status',
                    // 'u.user_name' => 'Customer',
                    // 'products.name' => 'Product',
                ];
                break;
            case 'member':
                $fields = [
                    'username' => 'username',
                    'fullname' => 'fullname',
                    'email' => 'email',
                    'role' => 'role',
                ];
                break;
            case 'review':
                $fields = [
                    'fullname' => 'Author',
                    'comment' => 'Evaluate',
                    'products.name' => 'Product',
                ];
                break;
            default:
                $fields = [];
            // Thêm các case khác nếu cần
        }

        // Bắt đầu tạo form
        $form = '<form action="admin/search/' . $page . '" method="post">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <select class="form-select" name="search_field">';

        // Lặp qua các trường tìm kiếm
        foreach ($fields as $field => $label) {
            $form .= '<option value="' . $field . '" ' . (isset($_POST['search_field']) && $_POST['search_field'] == $field ? 'selected' : '') . '>' . $filterBy . ' ' . $label . '</option>';
        }

        // Thêm input cho tìm kiếm
        $form .= '</select>
            <input type="text" class="form-control" name="search" placeholder="Search..." value="' . (isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '') . '">
            <button class="primary-btn-sm center" type="submit"><i class="bi bi-funnel"></i></button>
            </div>
        </form>';

        return $form;
    }

    function pagination($pageAction = '', $total_pages, $current_page = 1, $limit = 8)
    {
        $output = '<div class="goru-pagination mb-3 text-center clearfix">';

        if ($current_page > 1) {
            $output .= '<a class="prev" href="' . $pageAction . '/' . ($current_page - 1) . '/' . $limit . '"><i class="bi bi-caret-left-fill"></i></a>';
        }

        // Hàm in số trang
        $printPage = function ($i) use ($pageAction, $current_page, $limit) {
            return $i == $current_page
                ? '<span class="current">' . $i . '</span>'
                : '<a href="' . $pageAction . '/' . $i . '/' . $limit . '">' . $i . '</a>';
        };

        if ($total_pages <= 20) {
            for ($i = 1; $i <= $total_pages; $i++)
                $output .= $printPage($i);
        } else {
            for ($i = 1; $i <= 5; $i++)
                $output .= $printPage($i);
            if ($current_page > 7)
                $output .= '<span class="dots">...</span>';
            $start = max(6, $current_page - 2);
            $end = min($total_pages - 5, $current_page + 2);
            for ($i = $start; $i <= $end; $i++)
                $output .= $printPage($i);
            if ($current_page < $total_pages - 6)
                $output .= '<span class="dots">...</span>';
            for ($i = $total_pages - 4; $i <= $total_pages; $i++)
                $output .= $printPage($i);
        }

        if ($current_page < $total_pages) {
            $output .= '<a class="next" href="' . $pageAction . '/' . ($current_page + 1) . '/' . $limit . '"><i class="bi bi-caret-right-fill"></i></a>';
        }
        $output .= '</div>';
        return $output;
    }


} ?>