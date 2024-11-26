<?php
	/** @noinspection PhpUnused */
	
	/**
	 * Available Laravel Methods
	 * Add other USPS API Methods
	 * Based on Vincent Gabriel @VinceG USPS PHP-Api https://github.com/VinceG/USPS-php-api
	 *
	 * @since  1.0
	 * @author John Paul Medina
	 * @author Vincent Gabriel
	 */
	
	namespace Johnpaulmedina\Usps;
	
	use Johnpaulmedina\Usps\Exceptions\UspsTrackConfirmException;
	
	class Usps
	{
		private array $config;
		
		public function __construct(array $config)
		{
			$this->config = $config;
		}
		
		public function validate($request): array
		{
			$verify = new AddressVerify($this->config['username']);
			$address = new Address;
			$address->setFirmName('');
			$address->setAddress1((array_key_exists('Apartment', $request) ? $request['Apartment'] : ''));
			$address->setAddress2((array_key_exists('Address', $request) ? $request['Address'] : ''));
			$address->setCity((array_key_exists('City', $request) ? $request['City'] : ''));
			$address->setState((array_key_exists('State', $request) ? $request['State'] : ''));
			$address->setZip5((array_key_exists('Zip', $request) ? $request['Zip'] : ''));
			$address->setZip4('');
			
			// Add the address object to the address verify class
			$verify->addAddress($address);
			
			// Perform the request and return result
			$val2 = $verify->getArrayResponse();
			
			// var_dump($verify->isError());
			
			// See if it was successful
			if ($verify->isSuccess())
			{
				return ['address' => $val2['AddressValidateResponse']['Address']];
			}
			else
			{
				return ['error' => $verify->getErrorMessage()];
			}
		}
		
		/**
		 * @param $ids array|string
		 * @param $sourceId string|null
		 * @return array
		 * @throws UspsTrackConfirmException
		 * @noinspection PhpUndefinedFunctionInspection
		 */
		public function trackConfirm(array|string $ids, string $sourceId = null): array
		{
			$trackConfirm = new TrackConfirm($this->config['username']);
			$trackConfirm->setTestMode(!empty($this->config['testmode']));
			
			if ($sourceId)
			{
				// Assume revision 1 tracking is desired when sourceId supplied
				$trackConfirm->setRevision(request()->getClientIp(), $sourceId);
			}
			
			collect(is_array($ids) ? $ids : [$ids])->each(function ($id) use ($trackConfirm)
			{
				$trackConfirm->addPackage($id);
			});
			
			$trackConfirm->getTracking();
			if ($trackConfirm->isError())
			{
				throw new UspsTrackConfirmException($trackConfirm->getErrorMessage(), $trackConfirm->getErrorCode());
			}
			
			return $trackConfirm->getArrayResponse();
		}
		
		public function rate($request): array
		{
			$rate = new Rate($this->config['username']);
			$ratepackage = new RatePackage();
			$ratepackage->setService((array_key_exists('Service', $request) ? $request['Service'] : null));
			$ratepackage->setFirstClassMailType((array_key_exists('FirstClassMailType',
			                                                      $request) ? $request['FirstClassMailType'] : null));
			$ratepackage->setZipOrigination((array_key_exists('ZipOrigination',
			                                                  $request) ? $request['ZipOrigination'] : null));
			$ratepackage->setZipDestination((array_key_exists('ZipDestination',
			                                                  $request) ? $request['ZipDestination'] : null));
			$ratepackage->setPounds((array_key_exists('Pounds', $request) ? $request['Pounds'] : null));
			$ratepackage->setOunces((array_key_exists('Ounces', $request) ? $request['Ounces'] : null));
			$ratepackage->setContainer((array_key_exists('Container', $request) ? $request['Container'] : null));
			$ratepackage->setSize((array_key_exists('Size', $request) ? $request['Size'] : null));
			$ratepackage->setMachinable((array_key_exists('Machinable', $request) ? $request['Machinable'] : null));
			
			// Add the Package object to the Rate Package class
			$rate->addPackage($ratepackage);
			
			// Perform the request and return result
			$val2 = $rate->getArrayResponse();
			
			// See if it was successful
			if ($rate->isSuccess())
			{
				return ['rate' => $val2];
			}
			else
			{
				return ['error' => $rate->getErrorMessage()];
			}
		}
	}
