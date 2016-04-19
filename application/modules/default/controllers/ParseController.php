<?php
//parse games by api
class ParseController extends Saffron_AbstractController
{

	public function indexAction()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$mlbs = new Saffron_Model_Mlb();

		$mlbs->saveMlbs();
	}

}