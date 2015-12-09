<?php


abstract class FormValidation
{
    abstract public function validateForm();
}

class ProductFormValidation extends FormValidation
{

    private $formData = [];
    private $errors = [];

    private static $errorMessages = [
        'name' => "Naam mag niet leeg zijn",
        'description' => "Omschrijving mag niet leeg zijn",
        'category' => "Omschrijving mag niet leeg zijn",
        'price' => "Prijs mag niet leeg zijn",
        'priceIsNumeric' => "Prijs moet een nummerieke waarde zijn"
    ];

    /**
     * ProductFormValidation constructor.
     * @param array $formData
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }


    /**
     * Validate product form data
     * @return array
     */
    public function validateForm()
    {
        $this->validateDescription();
        $this->validateCategory();
        $this->validatePrice();

        return $this->errors;
    }

    /**
     * Validate name. Create error if description is empty.
     */
    private function validateDescription()
    {
        if (empty($this->formData['name'])) {
            $this->errors['name'] = ProductFormValidation::$errorMessages['name'];
        }
    }

    /**
     * Validate description. Create error if description is empty.
     */
    private function validateName()
    {
        if (empty($this->formData['description'])) {
            $this->errors['description'] = ProductFormValidation::$errorMessages['description'];
        }
    }

    /**
     * Validate category. Create error if category is empty.
     */
    private function validateCategory()
    {
        if (empty($this->formData['category'])) {
            $this->errors['category'] = ProductFormValidation::$errorMessages['category'];
        }
    }

    /**
     * Validate price. Create error if price is empty or not numeric.
     */
    private function validatePrice()
    {
        if (empty($this->formData['price'])) {
            $this->errors['price'] = ProductFormValidation::$errorMessages['price'];
        }

        if (!is_numeric($this->formData['price'])) {
            $this->errors['priceIsNumeric'] = ProductFormValidation::$errorMessages['priceIsNumeric'];
        }
    }

}