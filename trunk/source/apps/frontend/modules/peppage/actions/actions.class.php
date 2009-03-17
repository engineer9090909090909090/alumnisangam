<?php
// auto-generated by sfPropelCrud
// date: 2009/03/16 07:28:59
?>
<?php

/**
 * peppage actions.
 *
 * @package    sf_sandbox
 * @subpackage peppage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class peppageActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('peppage', 'mylist');
  }

  public function executeList()
  {
    $this->peppages = PeppagePeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->peppage = PeppagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->peppage);
  }

  public function executeCreate()
  {
    $this->peppage = new Peppage();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->peppage = PeppagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->peppage);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $peppage = new Peppage();
      $peppage->setCreatedAt(time());
      $peppage->setUpdatedAt(time());
    }
    else
    {
      $peppage = PeppagePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($peppage);
	  $peppage->setUpdatedAt(time());
    }

    $peppage->setId($this->getRequestParameter('id'));
    $peppage->setTabname($this->getRequestParameter('tabname'));
    $peppage->setContent($this->getRequestParameter('content'));
    $peppage->setSequence($this->getRequestParameter('sequence'));
    $peppage->save();
    
    
    $pepuser = new Pepuser();
    $pepuser->setUserId($this->getUser()->getAttribute('userid'));
    $pepuser->setPeppageId($peppage->getId());
	$peppage->save();
	
    return $this->redirect('peppage/mylist');
  }

  public function executeDelete()
  {
    $peppage = PeppagePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($peppage);

    $peppage->delete();

    return $this->redirect('peppage/list');
  }
  
  public function executeMylist(){
  	$userid = $this->getUser()->getAttribute('userid');
  	$c = new Criteria();
  	$c->add(PepuserPeer::USER_ID, $userid);
  	$c->addAscendingOrderByColumn(PepuserPeer::ID);
  	$this->userpages = PepuserPeer::doSelect($c);
  }

  public function executeSiteview(){
  	$username = $this->getRequestParameter('un');
  	$c = new Criteria();
  	$c->add(UserPeer::USERNAME, $username);
  	$user = UserPeer::doSelectOne($c);
  	
  	$tabid = $this->getRequestParameter('tid');
	$c = new Criteria();
	$c->add(PepuserPeer::USER_ID, $user->getId());
	$c->addAscendingOrderByColumn(PepuserPeer::ID);
	$homepage = PepuserPeer::doSelectOne($c);
	if(!$tabid){
		$tabid = $homepage->getPeppageId(); 
	}
    $this->peppage = PeppagePeer::retrieveByPK($tabid);
  }

}
