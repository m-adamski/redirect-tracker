<?php

namespace Core\Services\Validator;

class ValidatorResult {

    /**
     * Validation Status.
     *
     * @var bool
     */
    protected $validationStatus;

    /**
     * Validation errors.
     *
     * @var array
     */
    protected $validationErrors;

    /**
     * ValidatorResult constructor.
     *
     * @param bool $validationStatus
     * @param array $validationErrors
     */
    public function __construct(bool $validationStatus, array $validationErrors) {
        $this->validationStatus = $validationStatus;
        $this->validationErrors = $validationErrors;
    }

    /**
     * Validation status.
     *
     * @return bool
     */
    public function status() {
        return $this->validationStatus;
    }

    /**
     * Validation pass.
     *
     * @return bool
     */
    public function pass() {
        return $this->validationStatus;
    }

    /**
     * Validation fails.
     *
     * @return bool
     */
    public function fails() {
        return !$this->validationStatus;
    }

    /**
     * Validation errors.
     *
     * @return array
     */
    public function errors() {
        return $this->validationErrors;
    }
}
