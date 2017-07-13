<?php

namespace Phpactor\CodeBuilder\Domain\Builder;

use Phpactor\CodeBuilder\Domain\Prototype\ClassPrototype;
use Phpactor\CodeBuilder\Domain\Prototype\ExtendsClass;
use Phpactor\CodeBuilder\Domain\Prototype\Properties;
use Phpactor\CodeBuilder\Domain\Prototype\Type;
use Phpactor\CodeBuilder\Domain\Builder\ClassBuilder;
use Phpactor\CodeBuilder\Domain\Prototype\Visibility;
use Phpactor\CodeBuilder\Domain\Prototype\DefaultValue;
use Phpactor\CodeBuilder\Domain\Prototype\Property;

class ParameterBuilder
{
    /**
     * @var SourceCodeBuilder
     */
    private $parent;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var DefaultValue
     */
    private $defaultValue;

    public function __construct(MethodBuilder $parent, string $name)
    {
        $this->parent = $parent;
        $this->name = $name;
    }

    public function type(string $type): ParameterBuilder
    {
        $this->type = Type::fromString($type);

        return $this;
    }

    public function defaultValue($value): ParameterBuilder
    {
        $this->defaultValue = DefaultValue::fromValue($value);

        return $this;
    }

    public function build()
    {
        return new Property(
            $this->name,
            $this->defaultValue,
            $this->type
        );
    }

    public function end(): MethodBuilder
    {
        return $this->parent;
    }
}