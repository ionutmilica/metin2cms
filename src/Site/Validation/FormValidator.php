<?php namespace Metin2CMS\Site\Validation;

use Illuminate\Validation\Factory as Validator;

class FormValidator {

    /**
     * Rules for form validation. Will be overwritten in subclasses
     *
     * @var array
     */
    protected $rules = array();

    /**
     * Messages for validation. Will be overwritten in subclasses.
     *
     * @var array
     */
    protected $messages = array();

    /**
     * @var
     */
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Rules getter
     *
     * @return array
     */

    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Messages getter
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Method that validates the input according to the rules.
     * Throw an exception if it fails.
     *
     * @param $input
     * @return bool
     * @throws FormValidationException
     */
    public function validate($input)
    {
        $validator = $this->validator->make($input, $this->getRules(), $this->getMessages());

        if ($validator->fails())
        {
            throw new FormValidationException('Validation failed', $validator->errors());
        }

        return true;
    }
}