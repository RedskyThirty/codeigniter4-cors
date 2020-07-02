<?php namespace App\Libraries\CodeIgniterCORS;

use App\Libraries\HTTPStatusCodes;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

/**
 * Class CodeIgniter CORS
 *
 * @author Manuel Piton
 * @copyright Copyright 2020 Redsky Thirty
 * @version 1.0.0
 *
 * @package App\Libraries\CodeIgniterCORS
 */
class CodeIgniterCORS
{
	/**
	 * @var array|null
	 */
	private ?array $_config = null;
	
	/**
	 * @var array|null
	 */
	private ?array $_requestConfig = null;
	
	
	//
	// Public Methods
	//
	
	/**
	 * CodeIgniterCORS constructor.
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		if (file_exists(__DIR__.'/Config/Config.php'))
		{
			$this->_config = include_once __DIR__.'/Config/Config.php';
		}
		
		if (empty($this->_config))
		{
			throw new Exception('CodeIgniterCORS: Please verify that the configuration file exists and contains at least one path.');
		}
	}
	
	
	/**
	 * @param RequestInterface $request
	 * @param ResponseInterface $response
	 */
	public function handle(RequestInterface $request, ResponseInterface $response): void
	{
		$this->_initRequestConfigWithPath($request->uri->getPath());
		
		if (!$this->_shouldRun())
		{
			return;
		}
		
		if ($this->_requestConfig['allowed_origins'][0] === '*')
		{
			$response->setHeader('Access-Control-Allow-Origin', '*');
		}
		else
		{
			$origin = $_SERVER['HTTP_ORIGIN']; // $request->getHeader('Origin') ===> Doesn't work
			
			if (!empty($origin) && in_array($origin, $this->_requestConfig['allowed_origins']))
			{
				$response->setHeader('Access-Control-Allow-Origin', $origin);
			}
			
			$origin = null;
		}
		
		if (!empty($this->_requestConfig['exposed_headers']))
		{
			$response->setHeader('Access-Control-Expose-Headers', implode(', ', $this->_requestConfig['exposed_headers']));
		}
		
		if ($this->_requestConfig['supports_credentials'])
		{
			$response->setHeader('Access-Control-Allow-Credentials', 'true');
		}
		else
		{
			$response->setHeader('Access-Control-Allow-Credentials', 'false');
		}
		
		$response->setHeader('Access-Control-Max-Age', $this->_requestConfig['max_age']);
		
		if ($this->_isPreflightRequest($request))
		{
			$response->setStatusCode(HTTPStatusCodes::NO_CONTENT);
			
			$response->setHeader('Access-Control-Allow-Headers', implode(', ', $this->_requestConfig['allowed_headers']));
			$response->setHeader('Access-Control-Allow-Methods', implode(', ', $this->_requestConfig['allowed_methods']));
			
			$response->sendHeaders();
			
			exit();
		}
		
		$response->sendHeaders();
	}
	
	
	//
	// Private Methods
	//
	
	/**
	 * @param string $path
	 */
	private function _initRequestConfigWithPath(string $path): void
	{
		/**
		 * Cette méthode-ci va chercher dans la config si
		 * il y en a une qui match avec le path de la requête.
		 */
		
		$explodedPath = explode('/', $path);
		$numPathSegments = count($explodedPath);
		
		$foundPath = null;
		$wildcardConfig = null;
		
		foreach ($this->_config as $configPath => $configData)
		{
			if ($configPath === '*')
			{
				$wildcardConfig = $configData;
				continue;
			}
			
			$explodedConfigPath = explode('/', $configPath);
			$length = min($numPathSegments, count($explodedConfigPath));
			$matchingSegments = [];
			
			for ($i = 0; $i < $length; $i++)
			{
				if ($explodedPath[$i] === $explodedConfigPath[$i])
				{
					$matchingSegments[] = $explodedConfigPath[$i];
				}
				else
				{
					break;
				}
			}
			
			$fp = implode('/', $matchingSegments);
			
			if (
				($foundPath == null) ||
				(
					(strlen($fp) > strlen($foundPath)) &&
					(strlen($fp) == strlen($configPath))
				)
			)
			{
				$foundPath = $fp;
			}
			
			$explodedConfigPath = null;
			$length = null;
			$matchingSegments = null;
			$fp = null;
			$i = null;
		}
		
		if ($foundPath != null) $this->_requestConfig = $this->_config[$foundPath];
		else if ($wildcardConfig != null) $this->_requestConfig = $wildcardConfig;
	}
	
	
	/**
	 * @return bool
	 */
	private function _shouldRun(): bool
	{
		return (
			($this->_requestConfig != null) &&
			(count($this->_requestConfig['allowed_origins']) > 0) &&
			(count($this->_requestConfig['allowed_methods']) > 0) &&
			(count($this->_requestConfig['allowed_headers']) > 0) &&
			($this->_requestConfig['max_age'] >= 0)
		);
	}
	
	
	/**
	 * @param RequestInterface $request
	 *
	 * @return bool
	 */
	private function _isPreflightRequest(RequestInterface $request): bool
	{
		return (($request->getMethod(true) === 'OPTIONS') && !empty($request->getHeader('Access-Control-Request-Method')));
	}
}
