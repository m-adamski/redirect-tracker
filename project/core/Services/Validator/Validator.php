<?php

namespace Core\Services\Validator;

use Symfony\Component\HttpFoundation\Request;
use Valitron\Validator as ValitronValidator;

class Validator {

    /**
     * Validator.
     *
     * @var ValitronValidator
     */
    protected $validator;

    /**
     * Rules Separator.
     *
     * @var string
     */
    protected $rulesSeparator = '|';

    /**
     * Settings Separator.
     *
     * @var string
     */
    protected $ruleSettingsSeparator = ':';

    /**
     * Get Validation Result of specified Request
     *
     * @param Request $request
     * @param array $rules
     * @return ValidatorResult
     */
    public function validate(Request $request, array $rules) {
        return $this->make($request->request->all(), $rules);
    }

    /**
     * Get Validation Result of specified Data
     *
     * @param array $data
     * @param array $rules
     * @return ValidatorResult
     */
    public function make(array $data, array $rules) {

        // Set data to Validator
        $this->validator = new ValitronValidator($data);

        // Generate correct & formatted rules array
        $generatedRulesArray = $this->generateRulesArray($rules);

        // Add Rules to Validator
        $this->addValidatorRules($this->validator, $generatedRulesArray);

        // Validate data & return Validation Result
        $validationStatus = $this->validator->validate();
        $validationErrors = $this->validator->errors();

        return new ValidatorResult($validationStatus, $validationErrors);
    }

    /**
     * Generate formatted rules array.
     *
     * @param array $userRules
     * @return array
     */
    private function generateRulesArray(array $userRules) {

        // Define response array
        $rulesArray = [];

        foreach ($userRules as $userField => $userRule) {

            // Add userField to rulesArray
            $rulesArray[$userField] = [];

            // Check if $userRule contain Rules Separator
            if (strpos($userRule, $this->rulesSeparator) !== false) {

                // Separator found - we need to explode this rule
                $mainRules = explode($this->rulesSeparator, $userRule);

                // Move every mainRules
                foreach ($mainRules as $mainRule) {

                    // Check if $mainRule contain Settings Separator
                    if (strpos($mainRule, $this->ruleSettingsSeparator) !== false) {

                        // Separator found - we need to explode this rule
                        $ruleSettings = explode($this->ruleSettingsSeparator, $mainRule);
                        $ruleSettingsRule = $ruleSettings[0];
                        $ruleSettingsOptions = array_splice($ruleSettings, -1, 1);

                        // Add to Rules Array
                        $rulesArray[$userField][$ruleSettingsRule] = $ruleSettingsOptions;
                    } else {

                        // Add to Rules Array
                        $rulesArray[$userField][$mainRule] = null;
                    }
                }
            } else {

                // Add to Rules Array
                $rulesArray[$userField][$userRule] = null;
            }
        }

        return $rulesArray;
    }

    /**
     * Assign new rules to specified Validator
     *
     * @param ValitronValidator $validator
     * @param array $formattedRules
     */
    private function addValidatorRules(ValitronValidator &$validator, array $formattedRules) {

        // Move every Formatted Rule
        foreach ($formattedRules as $ruleField => $ruleRules) {
            if (is_array($ruleRules) && count($ruleRules) > 0) {

                // Move every rule
                foreach ($ruleRules as $ruleName => $ruleRule) {
                    $validator->rule($ruleName, $ruleField, $ruleRule);
                }
            }
        }
    }
}
