<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  $customer_data_groups_id = Text::input($_GET['cdgID']);

  $first_language_id = key($_POST['customer_data_groups_name']);
  foreach ($_POST['customer_data_groups_name'] as $language_id => $customer_data_groups_name) {
// if use_first was checked, get all the values other than the name from the first group
    $index = empty($_POST['use_first']) ? $language_id : $first_language_id;

    $sql_data = [
      'customer_data_groups_name' => Text::prepare($customer_data_groups_name),
      'cdg_vertical_sort_order' => Text::input($_POST['cdg_vertical_sort_order'][$index]),
      'cdg_horizontal_sort_order' => Text::input($_POST['cdg_horizontal_sort_order'][$index]),
      'customer_data_groups_width' => Text::input($_POST['customer_data_groups_width'][$index]),
    ];

    $db->perform('customer_data_groups', $sql_data, 'update', "customer_data_groups_id = " . (int)$customer_data_groups_id . " AND language_id = " . (int)$language_id);
  }

  return $link->set_parameter('cdgID', $customer_data_groups_id);
