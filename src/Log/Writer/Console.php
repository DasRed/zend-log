<?php
namespace DasRed\Zend\Log\Writer;

use Zend\Log\Logger;
use Zend\Log\Writer\AbstractWriter;
use Zend\Console\Adapter\AdapterInterface;

class Console extends AbstractWriter
{

	const QUIET = - 1;

	/**
	 *
	 * @var int
	 */
	const ALWAYS = Logger::ERR;

	/**
	 *
	 * @var int
	 */
	const NOTICE = Logger::WARN;

	/**
	 *
	 * @var int
	 */
	const INFO = Logger::INFO;

	/**
	 *
	 * @var int
	 */
	const DEBUG = Logger::DEBUG;

	/**
	 *
	 * @var AdapterInterface
	 */
	protected $console;

	/**
	 *
	 * @var int
	 */
	protected $level = Logger::ERR;

	/**
	 *
	 * @param AdapterInterface $console
	 * @param int $level
	 * @param string $options
	 */
	public function __construct(AdapterInterface $console, $level = Logger::ERR, $options = null)
	{
		$this->setConsole($console)->setLevel($level);

		parent::__construct($options);
	}

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\Log\Writer\AbstractWriter::doWrite()
	 */
	protected function doWrite(array $event)
	{
		if ($event['priority'] > $this->getLevel())
		{
			return;
		}

		$writeLine = true;
		if (array_key_exists('extra', $event) === true && is_array($event['extra']) === true && array_key_exists('writeLine', $event['extra']) === true)
		{
			$writeLine = (bool)$event['extra']['writeLine'];
		}

		$this->getConsole()->write($event['message']);

		if ($writeLine === true)
		{
			$this->getConsole()->writeLine();
		}
	}

	/**
	 *
	 * @return AdapterInterface
	 */
	public function getConsole()
	{
		return $this->console;
	}

	/**
	 *
	 * @return int
	 */
	public function getLevel()
	{
		return $this->level;
	}

	/**
	 *
	 * @param AdapterInterface $console
	 * @return self
	 */
	public function setConsole(AdapterInterface $console)
	{
		$this->console = $console;

		return $this;
	}

	/**
	 *
	 * @param int $level
	 * @return self
	 */
	public function setLevel($level)
	{
		$this->level = (int)$level;

		return $this;
	}

	/**
	 *
	 * @return self
	 */
	public function setQuiet($value)
	{
		if ((bool)$value === true)
		{
			$this->setLevel(self::QUIET);
		}

		return $this;
	}

	/**
	 *
	 * @param int $verboseLevel
	 * @return self
	 */
	public function setVerboseLevel($verboseLevel)
	{
		switch ($verboseLevel)
		{
			case - 1:
				$this->setLevel(self::QUIET);
				break;

			case 0:
				$this->setLevel(self::ALWAYS);
				break;

			case 1:
				$this->setLevel(self::NOTICE);
				break;

			case 2:
				$this->setLevel(self::INFO);
				break;

			case 3:
			default:
				$this->setLevel(self::DEBUG);
				break;
		}

		return $this;
	}
}