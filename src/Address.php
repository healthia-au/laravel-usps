<?php
	/**
	 * USPS Address Class
	 * used across other class to create addresses represented as objects
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	class Address
	{
	    /**
	     * @var array list of all key=>value pairs we added so far for the current address
	     */
	    protected array $addressInfo = [];
	
	    /**
	     * Set the address2 property
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setAddress2(int|string $value): object
	    {
	        return $this->setField('Address2', $value);
	    }
	
	    /**
	     * Set the address1 property usually the apt or suit number
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setAddress1(int|string $value): object
	    {
	        return $this->setField('Address1', $value);
	    }
	
	    /**
	     * Set the city property
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setCity(int|string $value): object
	    {
	        return $this->setField('City', $value);
	    }
	
	    /**
	     * Set the state property
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setState(int|string $value): object
	    {
	        return $this->setField('State', $value);
	    }
	
	    /**
	     * Set the zip4 property - zip code value represented by 4 integers
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setZip4(int|string $value): object
	    {
	        return $this->setField('Zip4', $value);
	    }
	
	    /**
	     * Set the zip5 property - zip code value represented by 5 integers
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setZip5(int|string $value): object
	    {
	        return $this->setField('Zip5', $value);
	    }
	
	    /**
	     * Set the firmname property
	     *
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setFirmName(int|string $value): object
	    {
	        return $this->setField('FirmName', $value);
	    }
	
	    /**
	     * Add an element to the stack
	     *
	     * @param int|string $key
	     * @param int|string $value
	     * @return object Address
	     */
	    public function setField(int|string $key, int|string $value): object
	    {
	        $this->addressInfo[ucwords($key)] = $value;
	
	        return $this;
	    }
	
	    /**
	     * Returns a list of all the info we gathered so far in the current address object
	     *
	     * @return array
	     */
	    public function getAddressInfo(): array
	    {
	        return $this->addressInfo;
	    }
	}
