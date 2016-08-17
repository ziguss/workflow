<?php

namespace ziguss\workflow;

use ziguss\fsm\StatefulInterface;

/**
 * WorkflowInterface is the interface implemented by workflow instance.
 * 
 * @author ziguss <yudoujia@163.com>
 */
interface WorkflowInterface
{
    /**
     * Startup this workflow.
     *
     * Usually through to create an new task.
     */
    public function startup();

    /**
     * Retrieves all current unfinished tasks of the specified type.
     *
     * When the $taskType is null, we return all unfinished task.
     *
     * @param string|null $taskType
     *
     * @return StatefulInterface[]
     */
    public function getUnfinishedTasks($taskType = null);

    /**
     * Retrieves all finished tasks of the specified type.
     *
     * When the $taskType is null, we return all finished task.
     *
     * @param string|null $taskType
     *
     * @return StatefulInterface[]
     */
    public function getFinishedTasks($taskType = null);

    /**
     * Creates a new specified type of task for this workflow instance.
     *
     * @param string             $taskType
     * @param TaskInterface|null $parent
     *
     * @return TaskInterface
     */
    public function createTask($taskType, TaskInterface $parent = null);

    /**
     * Retrieves the specified type of task config.
     *
     * This task config is use to configure the underlying state machine of the corresponding type of task.
     *
     * @param string $taskType
     *
     * @return array
     */
    public function getTaskConfig($taskType);
}
