<?php
//shows json data
class GetController extends Saffron_AbstractController
{
	public function indexAction()
	{
		$mlbs = new Saffron_Model_Mlb();

		$json = $mlbs->retrieveMlbsJson();

		$this->view->assign('mlbs', $json);
	}
}