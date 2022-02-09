<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class OSCOM_PayPal_PS_Cfg_pdt_identity_token {
    var $default = '';
    var $title;
    var $description;
    var $sort_order = 650;

    function __construct() {
      global $OSCOM_PayPal;

      $this->title = $OSCOM_PayPal->getDef('cfg_ps_pdt_identity_token_title');
      $this->description = $OSCOM_PayPal->getDef('cfg_ps_pdt_identity_token_desc');
    }

    function getSetField() {
      $input = new Input('pdt_identity_token', ['value' => OSCOM_APP_PAYPAL_PS_PDT_IDENTITY_TOKEN, 'id' => 'inputPsPdtIdentityToken']);

      $result = <<<EOT
<h5>{$this->title}</h5>
<p>{$this->description}</p>

<div class="mb-3">{$input}</div>
EOT;

      return $result;
    }
  }
