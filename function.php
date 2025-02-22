<?php
function formatDate($datetime)
{
    // Chuyển đổi chuỗi datetime thành đối tượng DateTime
    $date = new DateTime($datetime);

    // Định dạng ngày giờ theo yêu cầu: d-m-Y
    return $date->format('F j, Y');
}
function formatDateHours($datetime)
{
    // Chuyển đổi chuỗi datetime thành đối tượng DateTime
    $date = new DateTime($datetime);

    // Định dạng ngày giờ theo yêu cầu: d-m-Y
    return $date->format('l, F j, Y h:i A');
}

function getShippingFee(){
    return 5;
}
function getTaxRate(){
    return 0.1;
}
function getServiceFee(){
    return 10;
}

function calculateSubtotal($items)
{
    $subtotal = 0;

    foreach ($items as $item) {
        $subtotal += $item['quantity'] * $item['price'];
    }

    return $subtotal;
}

function calculateTotalAmount($items)
{
    $shippingFee = getShippingFee();
    $taxRate = getTaxRate();
    $serviceFee = getServiceFee();
    // Tính tổng tiền các sản phẩm
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item['quantity'] * $item['price'];
    }

    // Tính thuế
    $tax = $subtotal * $taxRate;

    // Tính tổng số tiền
    $totalAmount = $subtotal + $shippingFee + $tax + $serviceFee;

    return $totalAmount;
}

?>