<?php
	/**
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	use Exception;
	
	class TrackConfirm extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'TrackV2';
	    /**
	     * @var array - additional request parameters for Revision 1
	     */
	    protected array $requestData = [];
	    /**
	     * @var array - list of all packages added so far
	     */
	    protected array $packages = [];
	
	    public function getEndpoint(): string
	    {
	        return self::$testMode ? 'https://production.shippingapis.com/ShippingAPITest.dll' : 'https://production.shippingapis.com/ShippingAPI.dll';
	    }
		
		/**
		 * Perform the API call
		 *
		 * @return string
		 * @throws Exception
		 */
	    public function getTracking(): string
	    {
	        return $this->doRequest();
	    }
	
	    /**
	     * returns array of all packages added so far
	     *
	     * @return array
	     */
	    public function getPostFields(): array
	    {
	        return array_merge($this->requestData, $this->packages);
	    }
	
	    /**
	     * Add Package to the stack
	     *
	     * @param string $id the address unique id
	     * @return void
	     */
	    public function addPackage(string $id): void
	    {
	        $this->packages['TrackID'][] = ['@attributes' => ['ID' => $id]];
	    }
	
	    /**
	     * Set revision ID and additional required fields
	     *
	     * @param string $clientIp
	     * @param string $sourceId
	     * @param int $revisionId
	     * @return void
	     */
	    public function setRevision(string $clientIp, string $sourceId, int $revisionId = 1): void
	    {
	        $this->requestData['Revision'] = $revisionId;
	        $this->requestData['ClientIp'] = $clientIp;
	        $this->requestData['SourceId'] = $sourceId;
	    }
	}
