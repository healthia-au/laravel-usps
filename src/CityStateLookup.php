<?php
	/** @noinspection PhpUnused */
	
	/**
	 * USPS City/State lookup
	 * used to find a city/state by a zipcode lookup
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	use Exception;
	
	class CityStateLookup extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'CityStateLookup';
	    /**
	     * @var array - list of all addresses added so far
	     */
	    protected array $addresses = [];
		
		/**
		 * Perform the API call
		 *
		 * @return string
		 * @throws Exception
		 */
	    public function lookup(): string
	    {
	        return $this->doRequest();
	    }
	
	    /**
	     * returns array of all addresses added so far
	     *
	     * @return array
	     */
	    public function getPostFields(): array
	    {
	        return $this->addresses;
	    }
	
	    /**
	     * Add zip zip code to the stack
	     *
	     * @param string $zip5 - zip code 5 integers
	     * @param string $zip4 - optional 4 integers zip code
	     * @param string|null $id   the address unique id
	     * @return void
	     */
	    public function addZipCode(string $zip5, string $zip4 = '', string $id = null): void
	    {
	        $packageId = $id !== null ? $id : ((count($this->addresses) + 1));
	        $zipCodes  = ['Zip5' => $zip5];
	        if ($zip4) {
	            $zipCodes['Zip4'] = $zip4;
	        }
	        $this->addresses['ZipCode'][] = array_merge(['@attributes' => ['ID' => $packageId]], $zipCodes);
	    }
	}
