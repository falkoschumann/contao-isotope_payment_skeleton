<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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


/**
 * Skeleton of payment implementation for Isotope webshop for Contao using postsale.php script.
 *
 * @copyright  2013, Falko Schumann <http://www.muspellheim.de>
 * @author     Falko Schumann <falko.schumann@muspellheim.de> 
 * @package    Controller
 */
class PaymentSkeletonWithHiddenTrigger extends IsotopePayment
{

	public function processPayment()
	{
		$objOrder = new IsotopeOrder();
		
		if (!$objOrder->findBy('id', $this->Input->post('orderid')))
		{
			$this->log('Order ID "' . $this->Input->post('orderid') . '" not found', __METHOD__, TL_ERROR);
			return false;
		}
		
		$objOrder->date_paid = time();
		$objOrder->save();
		
		return true;
	}


	public function processPostSale()
	{
		$objOrder = new IsotopeOrder();
		
		if (!$objOrder->findBy('id', $this->Input->post('orderid')))
		{
			$this->log('Order ID "' . $this->Input->post('orderid') . '" not found', __METHOD__, TL_ERROR);
			return;
		}

		if (!$objOrder->checkout())
		{
			$this->log('Post-Sale checkout for Order ID "' . $objOrder->id . '" failed', __METHOD__, TL_ERROR);
			return;
		}

		$objOrder->date_paid = time();
		$objOrder->updateOrderStatus($this->new_order_status);
		$objOrder->save();
	}


	public function checkoutForm()
	{
		$objOrder = new IsotopeOrder();

		if (!$objOrder->findBy('cart_id', $this->Isotope->Cart->id))
		{
			$this->redirect($this->addToUrl('step=failed', true));
		}

		$arrParam = array
		(
			'orderid'		=> $objOrder->id,
			'amount'		=> round(($this->Isotope->Cart->grandTotal * 100)),
			'currency'		=> $this->Isotope->Config->currency,
			'accepturl'		=> $this->Environment->base . IsotopeFrontend::addQueryStringToUrl('uid=' . $objOrder->uniqid, $this->addToUrl('step=complete', true)),
			'declineurl'	=> $this->Environment->base . $this->addToUrl('step=failed', true)
		);
		
		// TODO set params to activate hidden trigger
		// TODO create new payment service stub handling hidden trigger

		$objTemplate = new FrontendTemplate('iso_payment_skeleton');
		$objTemplate->action = $this->Environment->base . 'system/modules/isotope_payment_skeleton/paymentservicewithhiddentriggerstub.php';
		$objTemplate->params = $arrParam;
		$objTemplate->submitLabel = $GLOBALS['TL_LANG']['MSC']['ipayment_submit_label'];
		$objTemplate->id = $this->id;
		return $objTemplate->parse();
	}

}

?>