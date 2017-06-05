<?php
/**
 * @author Doctor <doctor.netpeak@gmail.com>
 *
 *
 * Date: 05.06.2017
 * Time: 12:53
 */

namespace Ufo\JsonRpcBundle\Server;


use Monolog\Logger;
use Zend\Json\Server\Error;
use Zend\Json\Server\Server;

class UfoZendServer extends Server
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * UfoZendServer constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger = null)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * Indicate fault response
     *
     * @param  string $fault
     * @param  int $code
     * @param  mixed $data
     * @return Error
     */
    public function fault($fault = null, $code = 404, $data = null)
    {
        $error = parent::fault($fault, $code, $data);
        if ($this->logger instanceof Logger) {
            $this->logger->error((string)$error, [$data]);
        }
        return $error;
    }

}