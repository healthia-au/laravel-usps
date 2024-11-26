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
	
	class AddressVerify extends USPSBase
	{
	    /**
	     * @var string - the api version used for this type of call
	     */
	    protected string $apiVersion = 'Verify';
	    /**
	     * @var array - list of all addresses added so far
	     */
	    protected array $addresses = [];
		
		/**
		 * Perform the API call to verify the address
		 *
		 * @return string
		 * @throws Exception
		 */
	    public function verify(): string
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
	     * Add Address to the stack
	     *
	     * @param Address $data
	     * @param string|null $id the address unique id
	     */
	    public function addAddress(Address $data, string $id = null): void
	    {
	        $packageId = $id !== null ? $id : ((count($this->addresses) + 1));
	
	        $this->addresses['Address'][] = array_merge(['@attributes' => ['ID' => $packageId]], $data->getAddressInfo());
	    }
	}
