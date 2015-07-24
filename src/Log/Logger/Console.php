<?php
namespace DasRed\Zend\Log\Logger;

use Zend\Log\Logger;
use DasRed\Zend\Log\Writer\Console as Writer;

class Console extends Logger
{

	/**
	 *
	 * @param string $message
	 * @param bool $writeLine
	 * @return self
	 */
	public function always($message, $writeLine = true)
	{
		return $this->log(Writer::ALWAYS, $message, [
			'writeLine' => $writeLine
		]);
	}

	/**
	 *
	 * @param string $message
	 * @param bool $writeLine
	 * @return self
	 */
	public function debug($message, $writeLine = true)
	{
		return $this->log(Writer::ALWAYS, $message, [
			'writeLine' => $writeLine
		]);
	}

	/**
	 *
	 * @param string $message
	 * @param bool $writeLine
	 * @return self
	 */
	public function info($message, $writeLine = true)
	{
		return $this->log(Writer::ALWAYS, $message, [
			'writeLine' => $writeLine
		]);
	}

	/**
	 *
	 * @param string $message
	 * @param bool $writeLine
	 * @return self
	 */
	public function notice($message, $writeLine = true)
	{
		return $this->log(Writer::ALWAYS, $message, [
			'writeLine' => $writeLine
		]);
	}
}