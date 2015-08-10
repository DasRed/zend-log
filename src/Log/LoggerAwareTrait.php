<?php
namespace DasRed\Zend\Log;

use Zend\Log\Logger;

trait LoggerAwareTrait
{
	use \Zend\Log\LoggerAwareTrait;

	/**
	 * logs a message
	 *
	 * @param string $message
	 * @param string $priority
	 * @param array $extra
	 * @return self
	 */
	protected function log($message, $priority = Logger::DEBUG, array $extra = [])
	{
		if ($this->getLogger() === null)
		{
			return $this;
		}

		$this->getLogger()->log($priority, $message, $extra);

		return $this;
	}
}