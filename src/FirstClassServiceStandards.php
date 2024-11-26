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
	
	class FirstClassServiceStandards extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'FirstClassMail';
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
	    public function getServiceStandard(): string
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
		 * Add route to the stack.
		 *
		 * @param string|int $origin_zip
		 * @param string|int $destination_zip
		 */
	    public function addRoute(string|int $origin_zip, string|int $destination_zip): void
	    {
	        $this->route = [
	            'OriginZip'      => $origin_zip,
	            'DestinationZip' => $destination_zip,
	        ];
	    }
	}
