<?php


abstract class FormValidation
{
    protected $errors = [];
    protected $formData = [];

    protected static $errorMessages = [
        'name' => "Naam mag niet leeg zijn"
    ];

    abstract public function validateForm();

    /**
     * Validate name. Create error if description is empty.
     */
    protected function validateName()
    {
        if (empty($this->formData['name'])) {
            $this->errors['name'] = FormValidation::$errorMessages['name'];
        }
    }
}

class CommentFormValidation extends FormValidation
{


    /**
     * CommentFormValidation constructor.
     * @param array $formData
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;

        $errorMessages = [
            'comment' => "Commentaar mag niet leeg zijn",
            'emailEmpty' => 'Email mag niet leeg zijn',
            'emailNotValid' => 'Email adres is niet geldig'
        ];

        parent::$errorMessages = array_merge(parent::$errorMessages, $errorMessages);

    }

    /**
     * Validate product form data
     * @return array
     */
    public function validateForm()
    {
        $this->validateName();
        $this->validateComment();
        $this->validateEmail();

        return $this->errors;
    }


    /**
     * Validate comment. Create error if description is empty.
     */
    private function validateComment()
    {
        if (empty($this->formData['comment'])) {
            $this->errors['comment'] = CommentFormValidation::$errorMessages['comment'];
        }
    }

    /**
     * Validate email. Create error if email is empty.
     */
    private function validateEmail()
    {
        if (empty($this->formData['email'])) {
            $this->errors['emailEmpty'] = CommentFormValidation::$errorMessages['emailEmpty'];
        }

        if (!filter_var($this->formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['emailNotValid'] = CommentFormValidation::$errorMessages['emailNotValid'];
        }
    }
}

class ProductFormValidation extends FormValidation
{



    /**
     * ProductFormValidation constructor.
     * @param array $formData
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;

        $errorMessages = [
            'description' => "Omschrijving mag niet leeg zijn",
            'category' => "Omschrijving mag niet leeg zijn",
            'price' => "Prijs mag niet leeg zijn",
            'priceIsNumeric' => "Prijs moet een nummerieke waarde zijn"
        ];

        parent::$errorMessages = array_merge(parent::$errorMessages, $errorMessages);
    }


    /**
     * Validate product form data
     * @return array
     */
    public function validateForm()
    {
        $this->validateDescription();
        $this->validateName();
        $this->validateCategory();
        $this->validatePrice();

        return $this->errors;
    }

    /**
     * Validate description. Create error if description is empty.
     */
    private function validateDescription()
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