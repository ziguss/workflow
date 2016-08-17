<?php

namespace ziguss\workflow;

use ziguss\fsm\StatefulInterface;

/**
 * TaskInterface is the interface implemented by task classes.
 * 
 * @author ziguss <yudoujia@163.com>
 */
interface TaskInterface extends StatefulInterface
{
    /**
     * Returns the type of this task.
     *
     * @return string
     */
    public function getTaskType();

    /**
     * Returns the workflow instance.
     *
     * @return WorkflowInterface
     */
    public function getWorkflow();

    /**
     * Returns the underlying state machine.
     *
     * @return StateMachine
     */
    public function getStateMachine();

    /**
     * Checks whether the specified operation is exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasOperation($name);

    /**
     * Retrieves the specified extension.
     *
     * @param string $name
     *
     * @return OperationInterface
     */
    public function getOperation($name);

    /**
     * Returns all current executable operations.
     *
     * @param bool $runTest whether to perform additional checks 
     *
     * @return OperationInterface[]
     */
    public function getExecutableOperations($runTest = true);
}
