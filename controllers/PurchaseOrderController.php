<?php 
class PurchaseOrderController{
    private $purchaseOrderModel;
    private $purchaseOrderView;
    private $componentView;
    public function __construct()
    {
        $this->purchaseOrderModel = new PurchaseOrderModel();
        $this->purchaseOrderView = new PurchaseOrderView();
        $this->componentView = new ComponentView();
    }
    function purchaseOrder(){
        $userId = $_SESSION['user_id'];
        $purchaseOrders = $this->purchaseOrderModel->getOrdersByPage($userId);
        $this->componentView->displaySidebarUser("purchaseOrder");
        $this->purchaseOrderView->purchaseOrder($purchaseOrders);
    }
    function purchaseOrderDetail($order_id){
        $userId = $_SESSION['user_id'];
        $purchaseOrder = $this->purchaseOrderModel->getPurchaseOrderDetail($userId, $order_id);
        $order = $this->purchaseOrderModel->getOrderById($order_id);
        $this->componentView->displaySidebarUser("purchaseOrder");
        $this->purchaseOrderView->purchaseOrderDetail($purchaseOrder, $order);
    }
}
?>