<?php
class Order {
    private $databaseConnector;
    private $authentication;

    public function __construct(DatabaseConnector $databaseConnector) {
        $this->databaseConnector = $databaseConnector;
        $this->authentication = new Authentication($databaseConnector);
    }

    public function getCartItemsDetails() {
        $currentUser = $this->authentication->getCurrentUser();
        if ($currentUser === null) {
            return ["status" => 0, "message" => "User must be logged in to view cart."];
        }

        $cartItems = $currentUser->cart->getCartItems();
        $itemsDetails = [];
        foreach ($cartItems as $item) {
            $query = "SELECT * FROM products WHERE id = ?";

            $queryResult = $this->databaseConnector->executeQuery($query, [$item['itemId']]);
            $row = $queryResult->fetch_assoc();
            if ($row) {
                $itemsDetails[] = array_merge($row, ['qty' => $item['count']]);
            }
        }
        return ["status" => 1, "items" => $itemsDetails];
    }

    public function checkout() {
        $currentUser = $this->authentication->getCurrentUser();
        if ($currentUser === null) {
            return ["status" => 0, "message" => "User must be logged in to checkout."];
        }

        $userId = $currentUser->id;
        $itemsDetails = $this->getCartItemsDetails()['items'];

        if(count($itemsDetails) == 0) {
            return ["status" => 0, "message" => "No Items to checkout."];
        }

        $totalCost = 0;
        foreach ($itemsDetails as $item) {
            $totalCost += $item['price'] * $item['qty'];
        }

        $query = "INSERT INTO orders (user_id, order_items, total_cost) VALUES (?, ?, ?)";
        $this->databaseConnector->executeQuery($query, [$userId, json_encode($itemsDetails), $totalCost]);
        $orderId = $this->databaseConnector->getLastInsertId();

        // Clear cart after checkout
        $currentUser->cart->clearCart();

        return ["status" => 1, "message" => "Order successfully checked out.", "orderId" => $orderId];
    }
}
