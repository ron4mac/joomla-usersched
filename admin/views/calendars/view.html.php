<?php
defined('_JEXEC') or die;

/**
 * View class for a list of group schedulers.
 */
class UserschedViewCalendars extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	// Display the view
	public function display ($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');	//var_dump($this->state);

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	// Add the page title and toolbar.
	protected function addToolbar ()
	{
		$canDo	= UserSchedHelper::getActions();

		JToolBarHelper::title(JText::_('COM_USERSCHED_MENU').' : '.JText::_('COM_USERSCHED_MANAGER_GSCHEDS'), 'calendar usersched');

		JToolBarHelper::deleteList(JText::_('COM_USERSCHED_MANAGER_DELETEOK'));
		//JToolBarHelper::trash('usersched.trash');

	//	if ($canDo->get('core.edit.state')) {
	//		JToolBarHelper::custom('scheds.reset', 'refresh.png', 'refresh_f2.png', 'JUSERSCHED_RESET', false);
	//	}

		JToolBarHelper::divider();
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_usersched');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help('group_schedulers', true);
	}

	protected function state ($vari, $set=false, $val='', $glb=false)
	{
		$stvar = ($glb?'':'com_usersched.').$vari;
		$app = JFactory::getApplication();
		if ($set) {
			$app->setUserState($stvar, $val);
			return;
		}
		return $app->getUserState($stvar, '');
	}

}
