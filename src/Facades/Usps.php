<?php
	namespace Johnpaulmedina\Usps\Facades;
	
	use Illuminate\Support\Facades\Facade;
	
	class Usps extends Facade
	{
	    /**
	     * Get the registered name of the component.
	     *
	     * @return string
	     */
	    protected static function getFacadeAccessor(): string
	    {
			return 'usps';
		}
	
	}
