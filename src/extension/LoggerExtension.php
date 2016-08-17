<?php

namespace ziguss\workflow\extension;

use ziguss\fsm\TransitionEvent;
use ziguss\workflow\OperationExtension;

/**
 * @author ziguss <yudoujia@163.com>
 */
abstract class LoggerExtension extends OperationExtension
{
    /**
     * {@inheritdoc}
     */
    public function after(TransitionEvent $event)
    {
        $this->log($event);
    }

    /**
     * Saves the operation executing history.
     *
     * @param TransitionEvent $event
     *
     * @return mixed
     */
    abstract public function log(TransitionEvent $event);
}
