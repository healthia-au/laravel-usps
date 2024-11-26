<?php
	/** @noinspection PhpUnused */
	
	/**
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	use Exception;
	
	class ServiceDeliveryCalculator extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'SDCGetLocations';
		
	    /**
	     * @var array - route added so far.
	     */
	    protected array $route = [];
		
		/**
		 * Perform the API call.
		 *
		 * @return string
		 * @throws Exception
		 */
	    public function getServiceDeliveryCalculation(): string
	    {
	        return $this->doRequest();
	    }
	
	    /**
	     * returns array of all routes added so far.
	     *
	     * @return array
	     */
	    public function getPostFields(): array
	    {
	        return $this->route;
	    }
		
		/**
		 * @param      $mail_class      integer from 0 to 6 indicating the class of mail.
		 *                              “0” = All Mail Classes
		 *                              “1” = Express Mail
		 *                              “2” = Priority Mail
		 *                              “3” = First Class Mail
		 *                              “4” = Standard Mail
		 *                              “5” = Periodicals
		 *                              “6” = Package Services
		 * @param string $origin_zip 5 digit zip code.
		 * @param string $destination_zip 5 digit zip code.
		 * @param string|null $accept_date string in the format dd-mmm-yyyy.
		 * @param string|null $accept_time string in the format HHMM.
		 */
	    public function addRoute(int $mail_class,
	                             string $origin_zip,
	                             string $destination_zip,
	                             string $accept_date = null,
	                             string $accept_time = null): void
	    {
	        $route = [
	            'MailClass'      => $mail_class,
	            'OriginZIP'      => $origin_zip,
	            'DestinationZIP' => $destination_zip,
	        ];
	        if (! empty($accept_date)) {
	            $route['AcceptDate'] = $accept_date;
	        }
	        if (! empty($accept_time)) {
	            $route['AcceptTime'] = $accept_time;
	        }
	        $this->route = $route;
	    }
	}
