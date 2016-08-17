<?php

namespace ziguss\workflow;

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
            $config['callbacks'][$position][] = array($this->getObject(), 'process');
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
}
