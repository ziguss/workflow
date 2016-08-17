<?php

namespace ziguss\workflow\extension;

use ziguss\fsm\TransitionEvent;
use ziguss\workflow\OperationExtension;

/**
 * The most important extension, it's the key to implements the Workflow Patterns.
 *
 *  - Sequence: just one new task is created
 *  - Parallel Split: more than one tasks are created
 *  - Synchronization: after more than one tasks are finished, we create one new task
 *  - Exclusive Choice: pick one task to create in a task list 
 *
 * @author ziguss <yudoujia@163.com>
 */
abstract class NextExtension extends OperationExtension
{
    /**
     * {@inheritdoc}
     */
    public function after(TransitionEvent $event)
    {
        $this->createNewTasks();
    }

    /**
     * Creates new tasks by parsing the extension config.
     *
     * When new tasks are creating, the workflow is flowing.
     */
    abstract public function createNewTasks();
}
