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

		$this->getConsole()->writeLine($event['message']);
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
			case 0:
				$this->setLevel(Logger::ERR);
				break;

			case 1:
				$this->setLevel(Logger::WARN);
				break;

			case 2:
				$this->setLevel(Logger::INFO);
				break;

			case 3:
			default:
				$this->setLevel(Logger::DEBUG);
				break;
		}

		return $this;
	}
}