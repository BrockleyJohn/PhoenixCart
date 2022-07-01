<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  $sInfo = $GLOBALS['table_definition']['info'];
  switch ($GLOBALS['saction']) {
    case 'new':
      $heading = TEXT_INFO_HEADING_NEW_SUB_ZONE;
      $link = $GLOBALS['link']->set_parameter('zID', (int)$_GET['zID'])->set_parameter('action', 'list')->set_parameter('sID', $sInfo->association_id);

      $contents = ['form' => new Form('zones', (clone $link)->set_parameter('saction', 'insert_sub'))];
      $contents[] = ['text' => TEXT_INFO_NEW_SUB_ZONE_INTRO];
      $contents[] = ['text' => TEXT_INFO_COUNTRY . '<br>' . new Select('zone_country_id', array_merge([['id' => '', 'text' => TEXT_ALL_COUNTRIES]], Country::fetch_options()), ['onchange' => 'update_zone(this.form);'])];
      $contents[] = ['text' => TEXT_INFO_COUNTRY_ZONE . '<br>' . new Select('zone_id', [['id' => '', 'text' => TYPE_BELOW]])];
      $contents[] = [
        'class' => 'text-center',
        'text' => new Button(IMAGE_SAVE, 'fas fa-save', 'btn-success mr-2')
                . $GLOBALS['Admin']->button(IMAGE_CANCEL, 'fas fa-times', 'btn-light', $link),
      ];
      break;
    case 'edit':
      $heading = TEXT_INFO_HEADING_EDIT_SUB_ZONE;
      $link = $GLOBALS['link']->set_parameter('zID', (int)$_GET['zID'])->set_parameter('action', 'list')->set_parameter('sID', $sInfo->association_id);

      $contents = ['form' => new Form('zones', (clone $link)->set_parameter('saction', 'save_sub'))];
      $contents[] = ['text' => TEXT_INFO_EDIT_SUB_ZONE_INTRO];
      $contents[] = ['text' => TEXT_INFO_COUNTRY . '<br>' . (new Select('zone_country_id', array_merge([['id' => '', 'text' => TEXT_ALL_COUNTRIES]], Country::fetch_options()), ['onchange' => 'update_zone(this.form);']))->set_selection($sInfo->zone_country_id)];
      $contents[] = ['text' => TEXT_INFO_COUNTRY_ZONE . '<br>' . (new Select('zone_id', array_merge([['id' => '', 'text' => PLEASE_SELECT]], Zone::fetch_by_country($sInfo->zone_country_id))))->set_selection($sInfo->zone_id)];
      $contents[] = [
        'class' => 'text-center',
        'text' => new Button(IMAGE_SAVE, 'fas fa-save', 'btn-success mr-2')
                . $GLOBALS['Admin']->button(IMAGE_CANCEL, 'fas fa-times', 'btn-light', $link),
      ];
      break;
    case 'delete':
      $heading = TEXT_INFO_HEADING_DELETE_SUB_ZONE;
      $link = $GLOBALS['link']->set_parameter('zID', (int)$_GET['zID'])->set_parameter('action', 'list')->set_parameter('sID', $sInfo->association_id);

      $contents = ['form' => new Form('zones', (clone $link)->set_parameter('saction', 'delete_confirm_sub'))];
      $contents[] = ['text' => TEXT_INFO_DELETE_SUB_ZONE_INTRO];
      $contents[] = ['class' => 'text-center text-uppercase font-weight-bold', 'text' => $sInfo->countries_name];
      $contents[] = [
        'class' => 'text-center',
        'text' => new Button(IMAGE_DELETE, 'fas fa-trash', 'btn-danger mr-2')
                . $GLOBALS['Admin']->button(IMAGE_CANCEL, 'fas fa-times', 'btn-light', $link),
      ];
      break;
    default:
      if (isset($sInfo->association_id)) {
        $heading = $sInfo->countries_name;
        $link = $GLOBALS['link']->set_parameter('zID', (int)$_GET['zID'])->set_parameter('action', 'list')->set_parameter('sID', $sInfo->association_id);

        $contents[] = [
          'class' => 'text-center',
          'text' => $GLOBALS['Admin']->button(IMAGE_EDIT, 'fas fa-cogs', 'btn-warning mr-2', (clone $link)->set_parameter('saction', 'edit'))
                  . $GLOBALS['Admin']->button(IMAGE_DELETE, 'fas fa-trash', 'btn-danger', $link->set_parameter('saction', 'delete')),
        ];
        $contents[] = ['text' => sprintf(TEXT_INFO_DATE_ADDED, null) . ' ' . Date::abridge($sInfo->date_added)];
        if (!Text::is_empty($sInfo->last_modified)) {
          $contents[] = ['text' => sprintf(TEXT_INFO_LAST_MODIFIED, null) . ' ' . Date::abridge($sInfo->last_modified)];
        }
      }
      break;
  }
