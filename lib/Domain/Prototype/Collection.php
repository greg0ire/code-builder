<?php

namespace Phpactor\CodeBuilder\Domain\Prototype;

abstract class Collection implements \IteratorAggregate, \Countable
{
    protected $items = [];

    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    abstract protected function singularName(): string;

    public static function empty()
    {
        return new static([]);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function isLast($item): bool
    {
        return end($this->items) === $item;
    }

    /**
     * Return first
     *
     * @return static
     */
    public function first()
    {
        return reset($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->items);
    }

    public function get(string $name)
    {
        if (!isset($this->items[$name])) {
            throw new \InvalidArgumentException(sprintf(
                'Unknown %s "%s", known items: "%s"',
                $this->singularName(), $name, implode('", "', array_keys($this->items))
            ));
        }

        return $this->items[$name];
    }
}
