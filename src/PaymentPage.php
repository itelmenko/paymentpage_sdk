<?php

namespace ecommpay;

/**
 * Payment page URL Builder
 */
class PaymentPage
{
    /**
     * Base URL for payment
     *
     * @var string
     */
    private $baseUrl = 'https://paymentpage.ecommpay.com/payment';

    /**
     * Signature Handler
     *
     * @var SignatureHandler $signatureHandler
     */
    private $signatureHandler;

    /**
     * @param SignatureHandler $signatureHandler
     * @param string $baseUrl
     */
    public function __construct(SignatureHandler $signatureHandler, $baseUrl = NULL)
    {
        $this->signatureHandler = $signatureHandler;

        if ($baseUrl) {
            $this->baseUrl = $baseUrl;
        }
    }

    /**
     * Get full URL for payment
     *
     * @param Payment $payment
     *
     * @return string
     */
    public function getUrl(Payment $payment)
    {
        return $this->baseUrl . '?'. http_build_query($this->getData($payment));
    }

    /**
     * Get parameters for payment
     * @param Payment $payment
     * @return array
     */
    protected function getData(Payment $payment) {
        $data = $payment->getParams();
        $data['signature'] = $this->signatureHandler->sign($payment->getParams());
		return array_map('rawurlencode', $data);
    }
}
