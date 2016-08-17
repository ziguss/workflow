<?php

namespace ziguss\workflow;

use ziguss\fsm\TransitionEvent;

/**
 * OperationExtensionInterface is the interface implemented by operation extension classes.
 *
 * @author ziguss <yudoujia@163.com>
 */
interface OperationExtensionInterface
{
    /**
     * Returns the alias of this extension.
     *
     * @return string
     */
    public function getAlias();

    /**
     * Returns the operation which owns this extension.
     *
     * @return OperationInterface
     */
    public function getOperation();

    /**
     * This method is invoked when this extension is register to an operation.
     *
     * @param $config
     * @param OperationInterface $operation
     */
    public function load($config, OperationInterface $operation);

    /**
     * This method is invoked when operation is testing.
     *
     * @param TransitionEvent $event
     */
    public function test(TransitionEvent $event);

    /**
     * This method is invoked right before operation is executed.
     *
     * @param TransitionEvent $event
     */
    public function before(TransitionEvent $event);

    /**
     * This method is invoked right after operation is executed.
     *
     * @param TransitionEvent $event
     */
    public function after(TransitionEvent $event);
}
