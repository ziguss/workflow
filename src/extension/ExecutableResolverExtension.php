<?php

namespace ziguss\workflow\extension;

use ziguss\fsm\TransitionEvent;
use ziguss\workflow\OperationExtension;

/**
 * @author ziguss <yudoujia@163.com>
 */
abstract class ExecutableResolverExtension extends OperationExtension
{
    /**
     * {@inheritdoc}
     */
    public function test(TransitionEvent $event)
    {
        if (!$this->resolve()) {
            $event->setRejected();
        }
    }

    /**
     * Resolves whether the up operation is executable.
     *
     * @return bool
     */
    abstract public function resolve();
}
