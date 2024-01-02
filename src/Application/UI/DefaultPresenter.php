<?php

declare(strict_types = 1);

namespace Naja\Sandbox\Application\UI;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;


final class DefaultPresenter extends Presenter
{

	public function beforeRender(): void
	{
		parent::beforeRender();
		$this->redrawControl('title');
		$this->redrawControl('content');
	}


	// default view

	public function renderDefault(): void
	{
		$this->template->add('timestamp', $_SERVER['REQUEST_TIME']);
	}

	public function handleRefreshTimestamp(): void
	{
		$this->redrawControl('timestamp');
	}


	// redirecting action

	public function actionRedirectToForm(): void
	{
		$this->redirect('form');
	}


	// form

	private ?string $formResult = null;

	public function renderForm(): void
	{
		$this->template->add('formResult', $this->formResult);
	}

	protected function createComponentForm(): \Nette\Forms\Form
	{
		$form = new Form();
		$form->addText('text', 'Random text');
		$form->addSubmit('Send');

		$form->elementPrototype->setAttribute('class', 'ajax');
		$form->onSuccess[] = $this->processForm(...);
		return $form;
	}

	private function processForm(\Nette\Forms\Form $form): void
	{
		$this->formResult = $form->getValues()['text'];

		$this->redrawControl('result');
		$this->payload->postGet = true;
		$this->payload->url = $this->link('this');
	}

}
