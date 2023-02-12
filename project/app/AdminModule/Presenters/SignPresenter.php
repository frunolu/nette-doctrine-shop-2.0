<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;


/**
 * Class SignPresenter
 * @package App\CustomerModule\Presenters
 */
class SignPresenter extends BasePresenter
{

    /**
     * @return Form
     */
    protected function createComponentSignInForm()
    {
        $form = new Form();

        $form->addText('username', 'administration.sign.form.fields.user-name')
            ->setRequired('administration.sign.messages.required.user-name');

        $form->addPassword('password', 'administration.sign.form.fields.password')
            ->setRequired('administration.sign.messages.required.password');

        $form->addSubmit('send', 'administration.sign.form.fields.submit');

        $form->onValidate[] = [$this, 'signInValidate'];
        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    /**
     * @param Form $form
     */
    public function signInValidate(Form $form)
    {
        $values = $form->getValues();
        try {
            $this->getUser()->login($values->username, $values->password);
        } catch (\Exception $e) {
            $this->flashMessage('Uživateľské meno alebo heslo je nesprávne');
        }
    }

    /**
     * @param $form
     * @param $values
     * @throws \Nette\Application\AbortException
     */
    public function signInFormSucceeded($form, $values)
    {
        try {
            $this->getUser()->login($values->username, $values->password);
            $this->redirect('Homepage:');
        } catch (AuthenticationException $e) {
            $form->addError('error.sign.' . $e->getCode());
        }
    }

    /**
     * @throws \Nette\Application\AbortException
     */
    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl jste odhlášen');
        $this->redirect('in');
    }

}

