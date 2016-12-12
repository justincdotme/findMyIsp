<?php namespace nearMe\Lib\Session;

use nearMe\Lib\Session\Persistence\HttpPersistence;
use nearMe\Lib\Session\Persistence\ArrayPersistence;

/**
 * Class Session
 * @package nearMe\Lib\Session
 */
class Session implements SessionInterface
{
    /**
     * @var ArrayPersistence
     */
    protected $_sessionPersistence;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        //TODO - Use DI to set classes based on app context
        //For the web...
        $this->_sessionPersistence = new HttpPersistence();

        //Alternately for testing...
        $this->_sessionPersistence = new ArrayPersistence();
    }

    public function store($value)
    {
        return $this->_sessionPersistence->store($value);
    }

    public function flash($value)
    {
        return $this->_sessionPersistence->flash($value);
    }

    public function pull($value)
    {
        return $this->_sessionPersistence->pull($value);
    }

    public function delete($value)
    {
        return $this->_sessionPersistence->delete($value);
    }

    public function get($value)
    {
        return $this->_sessionPersistence->get($value);
    }

    public function destroy()
    {
        return $this->_sessionPersistence->destroy();
    }
}