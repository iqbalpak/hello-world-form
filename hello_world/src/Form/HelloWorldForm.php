<?php
namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My New Form
 * 
 * @see Drupal\hello_world\Form
 * 
 */
class HelloWorldForm extends FormBase {

    /**
     * Give id to form
     */
    public function getFormId(){
        return 'form_hello_world';
    }

    /**
     * It is build form
     */
    public function buildForm(array $form, FormstateInterface $form_state) {
        $form['description'] = [
            '#type' => 'item',
            '#markup' => $this->t('It is description of the form'),
        ];
        $form['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#description' => $this->t('Title should be greater than 5 characters'),
            '#required' => 'TRUE',
        ];
        $form['actions'] = [
            '#type' => 'actions',
        ];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
        return $form;
    }

    /**
     * It is validate form
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $title = $form_state->getValue('title');
        if(strlen($title) < 5) {
            $form_state->setErrorByName('title', $this->t('Title must be at least 5 characters'));
        }
    }

    /**
     * It is submit form
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $title = $form_state->getValue('title');
        $this->messenger()->AddMessage($this->t('Title is %title .',['%title' => $title]));
    }

}
