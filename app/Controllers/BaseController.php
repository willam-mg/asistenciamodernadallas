<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	private $maxAgeCache = ENVIRONMENT == 'production'?31536000:3600;
	private $sMaxAge = ENVIRONMENT == 'production'?31536000:9000;
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [
		'cookie',
		'date'
	];

	/**
     * @var string
     * Holds the session instance
     */
    protected $session;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

        if(session_status() == PHP_SESSION_NONE)
        {
            $this->session = Services::session();
        }

		// set cache control
		$this->response->setCache([
				'max-age'  => $this->maxAgeCache,
				's-maxage' => $this->sMaxAge,
				'etag'     => 'abcde'
		]);
		// $this->cachePage($this->maxAgeCache);
	}

	protected function selectDb($sucursal) {
		switch ($sucursal) {
			case 'quillacollo':
				return \Config\Database::connect(); // by default quillacollo
				break;
			case 'sacaba':
				return \Config\Database::connect('sacaba');
				break;
			case 'cochabamba':
				return \Config\Database::connect('cochabamba');
				break;
			default:
				return null;
				break;
		}
	}

	protected function sucursal() {
		return get_cookie('sucursal', true);
	}

	protected function getDb() {
		$sucursal = $this->sucursal();
		if ( $sucursal ) {
			$db = $this->selectDb($sucursal);
			if (!$db) {
				return null;
			}
			return $db;
		}
		return null;
	}
}
