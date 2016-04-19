<?php

class IndexController extends Saffron_AbstractController
{

	public function indexAction()
	{
		$mlbs = new Saffron_Model_Mlb();

		$games = $mlbs->retrieveMlbs();
		$this->view->assign('mlbs', $games);

		$this->view->headTitle('Sport data');
	}

}