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
	
	class Rate extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'RateV4';
	    /**
	     * @var array - list of all addresses added so far
	     */
	    protected array $packages = [];
		
		/**
		 * Perform the API call
		 *
		 * @return string
		 * @throws Exception
		 */
	    public function getRate(): string
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
	        return $this->packages;
	    }
	
	    /**
	     * sets the type of call to perform domestic or international
	     *
	     * @param $status
	     */
	    public function setInternationalCall($status): void
	    {
	        $this->apiVersion = $status === true ? 'IntlRateV2' : 'RateV4';
	    }
	
	    /**
	     * Add other option for International & Insurance
	     *
	     * @param int|string $key
	     * @param int|string $value
	     */
	    public function addExtraOption(int|string $key, int|string $value): void
	    {
	        $this->packages[$key][] = $value;
	    }
	
	    /**
	     * Add Package to the stack
	     *
	     * @param RatePackage $data
	     * @param string|null $id the address unique id
	     */
	    public function addPackage(RatePackage $data, string $id = null): void
	    {
	        $packageId = $id !== null ? $id : ((count($this->packages) + 1));
	
	        $this->packages['Package'][] = array_merge(['@attributes' => ['ID' => $packageId]], $data->getPackageInfo());
	    }
	}
