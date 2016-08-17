<?php

namespace ziguss\workflow;

use ziguss\fsm\TransitionEvent;

/**
 * @author ziguss <yudoujia@163.com>
 */
abstract class Operation implements OperationInterface
{
    /**
     * @var OperationExtensionInterface[]
     */
    private $extensions = array();

    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $config;

    /**
     * @var mixed
     */
    private $operator;

    /**
     * @var mixed
     */
    private $input;

    /**
     * @param TaskInterface $task
     * @param string        $name
     * @param array         $config
     */
    public function __construct(TaskInterface $task, $name, array $config)
    {
        $this->task = $task;
        $this->name = $name;
        $this->config = $config;
        $this->registerExtensions();
    }

    /**
     * {@inheritdoc}
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * {@inheritdoc}
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * {@inheritdoc}
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * {@inheritdoc}
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtension($alias)
    {
        return isset($this->extensions[$alias]) ? $this->extensions[$alias] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * {@inheritdoc}
     */
    public function registerExtension(OperationExtensionInterface $extension)
    {
        $alias = $extension->getAlias();
        $this->extensions[$alias] = $extension;
        $extension->load(isset($this->config[$alias]) ? $this->config[$alias] : null, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function process(TransitionEvent $event, $position)
    {
        foreach ($this->extensions as $extension) {
            $extension->$position($event, $this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->getTask()->getStateMachine()->apply($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function executable()
    {
        return $this->getTask()->getStateMachine()->isEnabled($this->getName());
    }

    /**
     * Registers extensions.
     */
    abstract protected function registerExtensions();
}
