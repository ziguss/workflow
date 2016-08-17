<?php

namespace ziguss\workflow;

use ziguss\fsm\TransitionEvent;

/**
 * @author ziguss <yudoujia@163.com>
 */
class StateMachine extends \ziguss\fsm\StateMachine
{
    /**
     * @param TaskInterface $object
     * @param array         $config
     */
    public function __construct(TaskInterface $object, array $config)
    {
        foreach (array('test', 'before', 'after') as $position) {
            $config['listeners'][$position][] = array($this, 'callOperationProcess');
        }

        if (empty($config['transitions']) && !empty($config['operations'])) {
            $config['transitions'] = $config['operations'];
            unset($config['operations']);
        }

        parent::__construct($object, $config);
    }

    /**
     * Retrieves the specified operation config.
     * 
     * @param string $name the operation name
     *
     * @return array
     */
    public function getOperationConfig($name)
    {
        if (isset($this->config['transitions'][$name])) {
            return $this->config['transitions'][$name];
        }

        return array();
    }

    /**
     * @param TransitionEvent $event
     * @param $position
     */
    protected function callOperationProcess(TransitionEvent $event, $position)
    {
        $this->getObject()->getOperation($event->getTransition())->process($event, $position);
    }
}
