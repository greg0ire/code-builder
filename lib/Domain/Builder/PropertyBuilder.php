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
use Phpactor\CodeBuilder\Domain\Builder\PropertyBuilder;

class PropertyBuilder
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
     * @var Visibility
     */
    private $visibility;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var DefaultValue
     */
    private $defaultValue;

    public function __construct(ClassBuilder $parent, string $name)
    {
        $this->parent = $parent;
        $this->name = $name;
    }

    public function visibility(string $visibility): PropertyBuilder
    {
        $this->visibility = Visibility::fromString($visibility);

        return $this;
    }

    public function type(string $type): PropertyBuilder
    {
        $this->type = Type::fromString($type);

        return $this;
    }

    public function defaultValue($value): PropertyBuilder
    {
        $this->defaultValue = DefaultValue::fromValue($value);

        return $this;
    }

    public function build(): Property
    {
        return new Property(
            $this->name,
            $this->visibility,
            $this->defaultValue,
            $this->type
        );
    }

    public function end(): ClassBuilder
    {
        return $this->parent;
    }
}
