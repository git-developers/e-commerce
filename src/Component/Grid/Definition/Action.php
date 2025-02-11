<?php

declare(strict_types=1);

namespace Component\Grid\Definition;

class Action
{

    const ACTION = 'Action';

    const CREATE = 'create';
    const CREATE_CHILD = 'createchild';
    const EDIT = 'edit';
    const VIEW = 'view';
    const DELETE = 'delete';
    const INFO = 'info';
    const UPLOAD_FILE = 'upload_info';
    const CHANGE_PASSWORD = 'change_password';
//
//    const ASSIGN = 'assign';
//    const UNASSIGN = 'unassign';
//
//    const BOXLEFT_SEARCH = 'boxleft_search';
//    const BOXRIGHT_SEARCH = 'boxright_search';
//    const BOXLEFT_HAS_BOXRIGHT = 'boxleft_has_boxright';
//
//    const BOXRIGHT_ASSIGN = 'boxright_assign';
//    const BOXRIGHT_UNASSIGN = 'boxright_unassign';
//
//    const ASSOCIATIVE_EDIT = 'associative_edit';
//
//    const BOXRIGHT_ASSIGN_VIEW = 'boxright_assign_view';
//    const BOXRIGHT_ASSIGN_EDIT = 'boxright_assign_edit';
//    const BOXRIGHT_ASSIGN_CHILD = 'boxright_assign_child';
//



    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $label;

    /**
     * @var bool
     */
    private $enabled = true;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var int
     *
     * Position equals to 100 to ensure that wile sorting actions by position ASC
     * the action buttons positioned by default will be last
     */
    private $position = 100;

    /**
     * @param string $name
     * @param string $type
     */
    private function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @param string $name
     * @param string $type
     *
     * @return self
     */
    public static function fromNameAndType(string $name, string $type): self
    {
        return new self($name, $type);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string|null
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
