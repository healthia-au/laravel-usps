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
	use Illuminate\Support\Facades\Config;
	use Illuminate\Support\ServiceProvider;
	
	class UspsServiceProvider extends ServiceProvider {
	
	    /**
	     * Indicates if loading of the provider is deferred.
	     *
	     * @var bool
	     */
	    protected bool $defer = false;
	
	    /**
	     * Register the service provider.
	     *
	     * @return void
	     */
	    public function register(): void
	    {
	        // Register manager for usage with the Facade.
	        $this->app->singleton('usps', function()
	        {
	            $config = Config::get('services.usps');
	            if (!array($config)) {
	                throw new Exception('USPS: Invalid configuration defined in services.php.');
	            }
	            return new Usps($config);
	        });
	    }
	
	    /**
	     * Get the services provided by the provider.
	     *
	     * @return array
	     */
	    public function provides(): array
	    {
	        return array('usps');
	    }
	
	}
