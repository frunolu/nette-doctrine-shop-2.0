<?php

namespace App\FrontModule\Presenters;

use App\Model\User\UserRepository;
use App\Presenters\BasePresenter;
use Nette\Application\UI\Form;
use Nette\DI\Attributes\Inject;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;
use Tracy\Debugger;


/**
 * Class SignPresenter
 * @package App\CustomerModule\Presenters
 */
class SignPresenter extends BasePresenter
{


    #[Inject]
    public UserRepository $userRepository;


    /**
     * @return Form
     */
    protected function createComponentSignInForm()
    {
        $form = new Form();

        $form->addText ('username', 'sign.form.fields.user-name')
            ->setRequired ('sign.messages.required.user-name');

        $form->addPassword ('password', 'sign.form.fields.password')
            ->setRequired ('sign.messages.required.password');

        $form->addSubmit ('send', 'administration.sign.form.fields.submit');

        $form->onValidate[] = [$this, 'signInValidate'];
        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    /**
     * @param Form $form
     */
    public function signInValidate(Form $form)
    {
        $values = $form->getValues ();
        Debugger::bardump ($values);
        try {
            $this->getUser ()->login ($values->username, $values->password);
        } catch (\Exception $e) {
            $this->flashMessage ('Uživateľské meno alebo heslo je nesprávne');
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
            $this->getUser ()->login ($values->username, $values->password);
            $this->flashMessage ('Byl jste přihlášen');
            $this->redirect ('Homepage:');

        } catch (AuthenticationException $e) {
            $form->addError ('error.sign.' . $e->getCode ());
        }
    }

    /**
     * @throws \Nette\Application\AbortException
     */
    public function actionOut()
    {
        $this->getUser ()->logout ();
        $this->flashMessage ('Byl jste odhlášen');
        $this->redirect ('in');
    }

    public function createComponentRegisterForm()
    {
        $form = new Form();
        $form->addText ('username', 'sign.form.fields.user-name')
            ->setRequired ('sign.messages.required.user-name');
//
//        $form->addEmail ('email', 'sign.form.fields.email')
//            ->setRequired ('sign.messages.required.email');

        $form->addPassword ('password', 'sign.form.fields.password')
            ->setRequired ('sign.messages.required.password');

        $form->addPassword ('password_repeat', 'sign.form.fields.password-repeat')
            ->setRequired ('sign.messages.required.password-repeat')
            ->addRule (Form::EQUAL, 'sign.messages.required.password-repeat', $form['password']);

//        $form->addCheckbox ('conditions', 'sign.form.fields.conditions')
//            ->setRequired ('sign.messages.required.conditions');

        $form->addSubmit ('send', 'sign.form.fields.submit');

//        $form->onValidate[] = [$this, 'registerValidate'];
        $form->onSuccess[] = [$this, 'registerFormSucceeded'];
        return $form;

    }

    public function registerFormSucceeded(Form $form)
    {
        $values = $form->getValues ();
        Debugger::barDump ($values);
        $pwd = (new \Nette\Security\Passwords)->hash ($values->password);
        $this->userRepository->register ($values->username, $pwd);


        $this->flashMessage ('Registrace proběhla úspěšně');
        $this->redirect ('in');
    }
    public function actionRegister(){
        $this->template->title = 'Registrace';

    }
}

