<?php
	/**
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	class RatePackage extends Rate
	{
	    /**
	     * @var array - list of all packages added so far
	     */
	    protected array $packageInfo = [];
	    /**
	     * Services constants
	     */
	    const string SERVICE_FIRST_CLASS = 'FIRST CLASS';
	    const string SERVICE_FIRST_CLASS_COMMERCIAL = 'FIRST CLASS COMMERCIAL';
	    const string SERVICE_FIRST_CLASS_HFP_COMMERCIAL = 'FIRST CLASS HFP COMMERCIAL';
	    const string SERVICE_PRIORITY = 'PRIORITY';
	    const string SERVICE_PRIORITY_COMMERCIAL = 'PRIORITY COMMERCIAL';
	    const string SERVICE_PRIORITY_HFP_COMMERCIAL = 'PRIORITY HFP COMMERCIAL';
	    const string SERVICE_EXPRESS = 'EXPRESS';
	    const string SERVICE_EXPRESS_COMMERCIAL = 'EXPRESS COMMERCIAL';
	    const string SERVICE_EXPRESS_SH = 'EXPRESS SH';
	    const string SERVICE_EXPRESS_SH_COMMERCIAL = 'EXPRESS SH COMMERCIAL';
	    const string SERVICE_EXPRESS_HFP = 'EXPRESS HFP';
	    const string SERVICE_EXPRESS_HFP_COMMERCIAL = 'EXPRESS HFP COMMERCIAL';
	    const string SERVICE_PARCEL = 'PARCEL';
	    const string SERVICE_MEDIA = 'MEDIA';
	    const string SERVICE_LIBRARY = 'LIBRARY';
	    const string SERVICE_ALL = 'ALL';
	    const string SERVICE_ONLINE = 'ONLINE';
	    /**
	     * First class mail type
	     * required when you use one of the first class services
	     */
	    const string MAIL_TYPE_LETTER = 'LETTER';
	    const string MAIL_TYPE_FLAT = 'FLAT';
	    const string MAIL_TYPE_PARCEL = 'PARCEL';
	    const string MAIL_TYPE_POSTCARD = 'POSTCARD';
	    const string MAIL_TYPE_PACKAGE = 'PACKAGE';
	    const string MAIL_TYPE_PACKAGE_SERVICE = 'PACKAGE SERVICE';
	    /**
	     * Container constants
	     */
	    const string CONTAINER_VARIABLE = 'VARIABLE';
	    const string CONTAINER_FLAT_RATE_ENVELOPE = 'FLAT RATE ENVELOPE';
	    const string CONTAINER_PADDED_FLAT_RATE_ENVELOPE = 'PADDED FLAT RATE ENVELOPE';
	    const string CONTAINER_LEGAL_FLAT_RATE_ENVELOPE = 'LEGAL FLAT RATE ENVELOPE';
	    const string CONTAINER_SM_FLAT_RATE_ENVELOPE = 'SM FLAT RATE ENVELOPE';
	    const string CONTAINER_WINDOW_FLAT_RATE_ENVELOPE = 'WINDOW FLAT RATE ENVELOPE';
	    const string CONTAINER_GIFT_CARD_FLAT_RATE_ENVELOPE = 'GIFT CARD FLAT RATE ENVELOPE';
	    const string CONTAINER_FLAT_RATE_BOX = 'FLAT RATE BOX';
	    const string CONTAINER_SM_FLAT_RATE_BOX = 'SM FLAT RATE BOX';
	    const string CONTAINER_MD_FLAT_RATE_BOX = 'MD FLAT RATE BOX';
	    const string CONTAINER_LG_FLAT_RATE_BOX = 'LG FLAT RATE BOX';
	    const string CONTAINER_REGIONALRATEBOXA = 'REGIONALRATEBOXA';
	    const string CONTAINER_REGIONALRATEBOXB = 'REGIONALRATEBOXB';
	    const string CONTAINER_REGIONALRATEBOXC = 'REGIONALRATEBOXC';
	    const string CONTAINER_RECTANGULAR = 'RECTANGULAR';
	    const string CONTAINER_NONRECTANGULAR = 'NONRECTANGULAR';
	    /**
	     * Size constants
	     */
	    const string SIZE_LARGE = 'LARGE';
	    const string SIZE_REGULAR = 'REGULAR';
	
	    /**
	     * Set the service property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setService(int|string $value): object
	    {
	        return $this->setField('Service', $value);
	    }
	
	    /**
	     * Set the first class mail type property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setFirstClassMailType(int|string $value): object
	    {
	        return $this->setField('FirstClassMailType', $value);
	    }
	
	    /**
	     * Set the zip origin property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setZipOrigination(int|string $value): object
	    {
	        return $this->setField('ZipOrigination', $value);
	    }
	
	    /**
	     * Set the zip destination property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setZipDestination(int|string $value): object
	    {
	        return $this->setField('ZipDestination', $value);
	    }
	
	    /**
	     * Set the pounds property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setPounds(int|string $value): object
	    {
	        return $this->setField('Pounds', $value);
	    }
	
	    /**
	     * Set the ounces property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setOunces(int|string $value): object
	    {
	        return $this->setField('Ounces', $value);
	    }
	
	    /**
	     * Set the container property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setContainer(int|string $value): object
	    {
	        return $this->setField('Container', $value);
	    }
	
	    /**
	     * Set the size property
	     *
	     * @param int|string $value
	     * @return object RatePackage
	     */
	    public function setSize(int|string $value): object
	    {
	        return $this->setField('Size', $value);
	    }
	    
	    public function setMachinable(int|string $value): object
	    {
	        return $this->setField('Machinable', $value);
	    }
	
	    /**
	     * Add an element to the stack
	     *
	     * @param int|string $key
	     * @param int|string $value
	     * @return object USPSAddress
	     */
	    public function setField(int|string $key, int|string $value): object
	    {
	        $this->packageInfo[ucwords($key)] = $value;
	
	        return $this;
	    }
	
	    /**
	     * Returns a list of all the info we gathered so far in the current package object
	     *
	     * @return array
	     */
	    public function getPackageInfo(): array
	    {
	        return $this->packageInfo;
	    }
	}
