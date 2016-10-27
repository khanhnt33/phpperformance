<?php

class UserItemListCreator {
    const DIR = '../data/userlistquantity/';
    const ROW_PATTERN = "%s\t%s\n";

    public static function make($cases, $params) {
        $user_list = $params['user_list'];
        $quantity_list = $params['quantity'];
        try {
            $count_quantity = count($quantity_list);
            $count_users = count($user_list);
            foreach ($cases as $case) {
                $f = fopen(self::DIR . 'list_user_of_' . $case . '.txt', 'w');
                
                for ($i = 0; $i < $case; $i++) {
                    $user_id = $user_list[rand(0, $count_users - 1)];
                    $quantity = $quantity_list[rand(0, $count_quantity - 1)];
                    fwrite($f, sprintf(self::ROW_PATTERN, $user_id, $quantity));
                }
                fclose($f);
            }
        } catch (Exception $exc) {
            print_r( $exc->getTraceAsString());
        }
    }
}

$cases = array (1, 10, 100, 500, 1000, 1500, 2000,);
$items = [10, 11, 12,];
$user_list = [550870, 549895, 549896, 549897, 550825];
$quantity = [1, 2, 3, ];

$params = array (
    'user_list' => $user_list,
    'quantity' => $quantity,
    'items' => $items,
);
UserItemListCreator::make($cases, $params);