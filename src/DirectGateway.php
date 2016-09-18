<?php

namespace Omnipay\SagePay;

use Omnipay\Common\AbstractGateway;

/**
 * Sage Pay Direct Gateway
 */
class DirectGateway extends AbstractGateway
{
    // Gateway identification.

    public function getName()
    {
        return 'Sage Pay Direct';
    }

    public function getDefaultParameters()
    {
        return array(
            'vendor' => '',
            'testMode' => false,
            'referrerId' => '',
        );
    }

    // Vendor identification.

    public function getVendor()
    {
        return $this->getParameter('vendor');
    }

    public function setVendor($value)
    {
        return $this->setParameter('vendor', $value);
    }
    
    public function setUseOldBasketFormat($value)
    {
        $value = (bool)$value;

        return $this->setParameter('useOldBasketFormat', $value);
    }

    public function getUseOldBasketFormat()
    {
        return $this->getParameter('useOldBasketFormat');
    }

    // Access to the HTTP client for debugging.
    // NOTE: this is likely to be removed or replaced with something
    // more appropriate.

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    // Available services.
    public function getReferrerId()
    {
        return $this->getParameter('referrerId');
    }

    public function setReferrerId($value)
    {
        return $this->setParameter('referrerId', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectCompleteAuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectCaptureRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectVoidRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectRefundRequest', $parameters);
    }

    /**
     * @deprecated use repeatAuthorize() or repeatPurchase()
     */
    public function repeatPayment(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectRepeatPaymentRequest', $parameters);
    }

    /**
     * Create a new authorization against a previous payment.
     */
    public function repeatAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\SharedRepeatAuthorizeRequest', $parameters);
    }

    /**
     * Create a new purchase against a previous payment.
     */
    public function repeatPurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\SharedRepeatPurchaseRequest', $parameters);
    }
}
