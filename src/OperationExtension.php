<?php

namespace ziguss\workflow;

use BadMethodCallException;
use ziguss\fsm\TransitionEvent;

/**
 * @author ziguss <yudoujia@163.com>
 */
class OperationExtension implements OperationExtensionInterface
{
    /**
     * @var mixed
     */
    protected $config;

    /**
     * @var OperationInterface
     */
    protected $operation;

    /**
     * Returns the alias of this extension.
     *
     * @return string
     *
     * @throws BadMethodCallException When the extension name does not follow conventions
     */
    public function getAlias()
    {
        $className = get_class($this);
        if (substr($className, -9) != 'Extension') {
            throw new BadMethodCallException('This extension does not follow the naming convention.');
        }
        $classBaseName = substr(strrchr($className, '\\'), 1, -9);

        return lcfirst($classBaseName);
    }

    /**
     * {@inheritdoc}
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Saves the config and operation.
     * 
     * @param $config
     * @param OperationInterface $operation
     */
    public function load($config, OperationInterface $operation)
    {
        $this->config = $config;
        $this->operation = $operation;
    }

    /**
     * {@inheritdoc}
     */
    public function test(TransitionEvent $event)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function before(TransitionEvent $event)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function after(TransitionEvent $event)
    {
    }
}
