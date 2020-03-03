<?php

namespace SFS\Locations\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;
use SFS\Locations\Helper\GoogleMaps;

class GetLocationCoordinates implements ObserverInterface
{
    private $logger;
    private $googleMaps;

    /**
     * GetLocationCoordinates constructor.
     * @param LoggerInterface $logger
     * @param GoogleMaps $googleMaps
     */
    public function __construct(LoggerInterface $logger, GoogleMaps $googleMaps)
    {
        $this->logger = $logger;
        $this->googleMaps = $googleMaps;
    }

    public function execute(Observer $observer)
    {
        // Get the store model from the observer data
        $store = $observer->getData('store');

        try {

            // Check that data includes a valid store
            if ($store->getId()) {
                // Get store's address as comma separated string
                $address = implode(",", $store->getAddressAsArray());

                // Get geo coordinates from Google Maps
                $geo = $this->googleMaps->getGeoCoordinates($address);

                if (isset($geo['latitude']) && isset($geo['longitude'])) {
                    // Save coordinates to store model
                    $store->setLatitude($geo['latitude']);
                    $store->setLongitude($geo['longitude']);
                    $store->save();
                }

            } else {
                throw new \Exception('Unable to get location coordinates because store model is not valid.');
            }

        } catch (\Exception $e) {
            $this->logger->critical('Error message', ['exception' => $e]);
        }
    }

}
