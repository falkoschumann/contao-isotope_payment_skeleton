<?php

/**
 * Isotope Payment Skeleton Extension for Contao
 * Copyright (c) 2013, Falko Schumann <http://www.muspellheim.de>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *   - Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright notice,
 *     this list of conditions and the following disclaimer in the documentation
 *     and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PHP version 5
 * @copyright  2013, Falko Schumann <http://www.muspellheim.de>
 * @author     Falko Schumann <falko.schumann@muspellheim.de> 
 * @package    IsotopeIpayment 
 * @license    BSD-2-Clause 
 * @filesource
 */

if (!empty($_POST['hidden_trigger'])) :
	$data = array(
		'cc_name'		=> $_POST['cc_name'],
		'cc_number'		=> $_POST['cc_number'],
		'orderid'		=> $_POST['orderid'],
		'REQUEST_TOKEN'	=> $_POST['REQUEST_TOKEN'],
	);
	http_post_fields($_POST['hidden_trigger'], $data);
?>	
<html>
<head>
<title>Payment Service Stub</title>
</head>
<body>
<form action="<?php echo $_POST['accepturl']; ?>" method="post">
  <input type="submit" value="Back to shop">
  <input type="hidden" name="cc_name" value="<?php echo $_POST['cc_name']; ?>">
  <input type="hidden" name="cc_number" value="<?php echo $_POST['cc_number']; ?>">
  <input type="hidden" name="orderid" value="<?php echo $_POST['orderid']; ?>">
  <input type="hidden" name="REQUEST_TOKEN" value="<?php echo $_POST['REQUEST_TOKEN']; ?>">
<?php if ($_POST['use_hidden_trigger']) :?>
  <input type="hidden" name="hidden_trigger" value="<?php echo $_POST['hidden_trigger']; ?>">
  <input type="hidden" name="accepturl" value="<?php echo $_POST['accepturl']; ?>">
<?php endif;?>
</form>
</body>
</html>
<?php else : ?>
<html>
<head>
<title>Payment Service Stub</title>
</head>
<body>
<form action="<?php echo $_POST['use_hidden_trigger'] ? $_SERVER['PHP_SELF'] : $_POST['accepturl']; ?>" method="post">
  <table>
    <tr>
      <td><label for="cc_name">Credit Card Owner</label></td>
      <td><input type="text" name="cc_name" value="Foo Bar"></td>
    </tr>
    <tr>
      <td><label for="cc_number">Credit Card No.</label></td>
      <td><input type="text" name="cc_number"value="1234567890"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
  </table>
  <input type="hidden" name="orderid" value="<?php echo $_POST['orderid']; ?>">
  <input type="hidden" name="REQUEST_TOKEN" value="<?php echo $_POST['REQUEST_TOKEN']; ?>">
<?php if ($_POST['use_hidden_trigger']) :?>
  <input type="hidden" name="hidden_trigger" value="<?php echo $_POST['hidden_trigger']; ?>">
  <input type="hidden" name="accepturl" value="<?php echo $_POST['accepturl']; ?>">
<?php endif;?>
</form>
</body>
</html>
<?php endif; ?>