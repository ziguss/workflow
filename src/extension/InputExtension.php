<?php

namespace ziguss\workflow\extension;

use ziguss\workflow\OperationExtension;
use ziguss\workflow\OperationInterface;
use ziguss\fsm\TransitionEvent;
use ziguss\workflow\InvalidOperationExecuteException;

/**
 * @author ziguss <yudoujia@163.com>
 */
abstract class InputExtension extends OperationExtension
{
    /**
     * @var mixed
     */
    protected $input;

    /**
     * Assigns an input object to the operation.
     *
     * @param $config
     * @param OperationInterface $operation
     */
    public function load($config, OperationInterface $operation)
    {
        parent::load($config, $operation);
        $this->input = $this->loadInput();
        $operation->setInput($this->input);
    }

    /**
     * {@inheritdoc}
     */
    public function before(TransitionEvent $event)
    {
        if (!$this->validate()) {
            $event->setRejected();
            throw new InvalidOperationExecuteException(sprintf(
                'The input of the operation "%s" with task type "%s" is invalid.',
                $this->getOperation()->getName(),
                $this->getOperation()->getTask()->getTaskType()
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function after(TransitionEvent $event)
    {
        $this->collectInformation();
    }

    /**
     * Returns the input object.
     * 
     * @return object
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Creates an new input object by parsing the extension config.
     *
     * @return object
     */
    abstract public function loadInput();

    /**
     * Validates the input object.
     *
     * @return bool
     */
    abstract public function validate();

    /**
     * Collects information from the input object.
     */
    abstract public function collectInformation();
}
