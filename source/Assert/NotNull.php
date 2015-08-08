<?php namespace Apishka\Validator\Assert;

use Apishka\Validator\AssertAbstract;
use Apishka\Validator\Exception;

/**
 * Not null
 *
 * @uses AssertAbstract
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class NotNull extends AssertAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */

    public function getSupportedNames()
    {
        return array(
            'Assert/NotNull',
        );
    }

    /**
     * Process
     *
     * @param mixed $value
     * @param array $options
     *
     * @return mixed
     */

    public function process($value, array $options = array())
    {
        if ($value === null)
            throw new Exception($this->getErrorMessage($options, 'error'));

        return $value;
    }

    /**
     * Get default error messages
     *
     * @return array
     */

    protected function getDefaultErrorMessages()
    {
        return array(
            'error' => 'is null',
        );
    }
}