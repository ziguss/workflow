<?php

namespace ziguss\workflow;

use ziguss\fsm\TransitionEvent;

/**
 * OperationInterface is the interface implemented by operation classes.
 * 
 * @author ziguss <yudoujia@163.com>
 */
interface OperationInterface
{
    /**
     * Returns the task which owns this operation.
     *
     * @return TaskInterface
     */
    public function getTask();

    /**
     * Returns tis operation name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the config of this operation.
     *
     * @return array
     */
    public function getConfig();

    /**
     * Returns the operator of this operation.
     *
     * @return mixed
     */
    public function getOperator();

    /**
     * Sets the operator of this operation.
     *
     * @param $operator
     */
    public function setOperator($operator);

    /**
     * Returns the input of this operation.
     *
     * @return mixed
     */
    public function getInput();

    /**
     * Sets the input of this operation.
     *
     * @param $input
     */
    public function setInput($input);

    /**
     * Retrieves the extension of the specified alias.
     *
     * @param string $alias
     *
     * @return OperationExtensionInterface|null
     */
    public function getExtension($alias);

    /**
     * Returns all extensions in this operation.
     *
     * @return OperationExtensionInterface[]
     */
    public function getExtensions();

    /**
     * Registers an extension.
     *
     * @param OperationExtensionInterface $extension
     */
    public function registerExtension(OperationExtensionInterface $extension);

    /**
     * Processes state machine transition event.
     *
     * @param TransitionEvent $event
     * @param string          $position
     */
    public function process(TransitionEvent $event, $position);

    /**
     * Executes this operation.
     */
    public function execute();

    /**
     * Checks whether this operation is now executable.
     *
     * @return bool
     */
    public function executable();
}
