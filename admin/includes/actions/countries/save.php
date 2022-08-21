<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  $country_id = Text::input($_GET['cID']);

  $sql_data = [
    'countries_name' => Text::prepare($_POST['countries_name']),
    'countries_iso_code_2' => Text::input($_POST['countries_iso_code_2']),
    'countries_iso_code_3' => Text::input($_POST['countries_iso_code_3']),
    'address_format_id' => Text::input($_POST['address_format_id'])
  ];

  $db->perform('countries', $sql_data, 'update', "countries_id = " . (int)$country_id);

  return $link->set_parameter('cID', (int)$country_id);
