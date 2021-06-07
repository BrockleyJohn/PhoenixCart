<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  $_SESSION['customer_id'] = (int)Text::input($_GET['cID']);
  $customer_details = $customer_data->process($page_fields);
  unset($_SESSION['customer_id']);

  $admin_hooks->cat('injectFormVerify');

  if (Form::is_valid()) {
    $customer_details['id'] = (int)Text::input($_GET['cID']);
    if (empty($customer_details['password'])) {
      unset($customer_details['password']);
    }

    $customer_data->update($customer_details, [
      'id' => $customer_details['id'],
      'address_book_id' => (int)$_POST['default_address_id'],
    ]);

    return $Admin->link('customers.php')->retain_query_except(['action'])->set_parameter('cID', $customer_details['id']);
  }

// if we reach here, we did not redirect, so there was some kind of error
  $action = 'edit';
