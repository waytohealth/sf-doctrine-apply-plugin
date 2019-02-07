<?php

/**
 * sfApply components.
 *
 * @package    5seven5
 * @subpackage sfApply
 * @author     Tom Boutell, tom@punkave.com
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BasesfApplyComponents extends sfComponents
{
  public function executeLogin()
  {
    $this->loggedIn = $this->getUser()->isAuthenticated();
    if (!$this->loggedIn)
    {
      $class = sfConfig::get('app_sf_guard_plugin_signin_form', 
        'sfGuardFormSignin');
      $this->form = new $class();
      // If there is a signin parameter, bind it to the
      // form and validate so that errors can be presented
      // via the component. Then signinSuccess can be empty
      // except for logic to display the component if the
      // developer so desires. This promotes a single
      // consistent login interface on the site
      $request = $this->getRequest();
      if ($request->hasParameter('signin'))
      {
        $this->form->bind($request->getParameter('signin'));
        $this->form->isValid();
      }
    }
  }
}
