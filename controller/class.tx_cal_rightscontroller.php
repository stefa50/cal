<?php
	 
/***************************************************************
* Copyright notice
*
* (c) 2005 Mario Matzulla (mario(at)matzullas.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once (PATH_tslib.'class.tslib_pibase.php');
require_once ('class.tx_cal_base_controller.php');

/**
 * This class handles all cal(endar)-rights of a current logged-in user
 *
 * @author	Mario Matzulla <mario(at)matzullas.de>
 */
class tx_cal_rightscontroller extends tx_cal_base_controller {
	
	function tx_cal_rightscontroller(&$controller){
		$this->tx_cal_base_controller($controller);
	}
	
	function isLoggedIn(){
		return $GLOBALS['TSFE']->loginUser;
	}
	
	function getUserGroups(){
		if($this->isLoggedIn()){
			return $GLOBALS['TSFE']->fe_user->groupData['uid'];
		}
		return array();
	}
	
	function getUserId(){
		if($this->isLoggedIn()){
			$val = $GLOBALS['TSFE']->fe_user->user['uid'];
			return $val;
		}
		return -1;
	}
	
	function getUserName(){
		if($this->isLoggedIn()){
			$val = $GLOBALS['TSFE']->fe_user->user['username'];
			return $val;
		}
		return -1;
	}
	
	function isCalEditable(){
		if ($this->conf["rights."]["edit"]==1)
			return true;
		return false;
	}
	
	function isCalAdmin(){
		if($this->isLoggedIn()){
			$users = split(',',$this->conf["rights."]["admin."]["user"]);
			$groups = split(',',$this->conf["rights."]["admin."]["group"]);
			if(array_search($this->getUserId(),$users) !== false)
				return true;
			$userGroups = $this->getUserGroups();
			foreach($groups as $key => $group){
				if(array_search(ltrim($group),$userGroups) !== false)
					return true;
			}
		}
		return false;
	}
	
	function isAllowedToCreateEvents(){
		return $this->checkRights($this->conf["rights."]["create."]["event."]["allowedToCreateEvents."]);
	}
	
	function isAllowedToCreateEventHidden(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventCategory(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateCategory."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventCalendar(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateCalendar."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventDateTime(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateDateTime."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventTitle(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventOrganizer(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateOrganizer."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventLocation(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateLocation."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventDescription(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventRecurring(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateRecurring."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventCreator(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateCreator."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventNotify(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateNotify."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateEventException(){
		if($this->checkRights($this->conf["rights."]["create."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["event."]["fields."]["allowedToCreateException."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEvents(){
		return $this->checkRights($this->conf["rights."]["edit."]["event."]["allowedToEditEvents."]);
	}
	
	function isAllowedToEditStartedEvents(){
		return $this->checkRights($this->conf["rights."]["edit."]["event."]["allowedToEditStartedEvents."]);
	}

	function isAllowedToEditOnlyOwnEvents(){
		return $this->checkRights($this->conf["rights."]["edit."]["event."]["allowedToEditOnlyOwnEvents."]);
	}

	function isAllowedToEditEventHidden(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventCalendar(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditCalendar."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventCategory(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditCategory."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventDateTime(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditDateTime."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventTitle(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventOrganizer(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditOrganizer."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventLocation(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditLocation."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventDescription(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventRecurring(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditRecurring."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventCreator(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditCreator."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventNotify(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditNotify."]))
			return true;
		return false;
	}
	
	function isAllowedToEditEventException(){
		if($this->checkRights($this->conf["rights."]["edit."]["event."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["event."]["fields."]["allowedToEditException."]))
			return true;
		return false;
	}
	
	function isAllowedToDeleteEvents(){
		return $this->checkRights($this->conf["rights."]["delete."]["event."]["allowedToDeleteEvents."]);
	}
	
	function isAllowedToDeleteOnlyOwnEvents(){
		return $this->checkRights($this->conf["rights."]["delete."]["event."]["allowedToDeleteOnlyOwnEvents."]);
	}
	
	function isAllowedToDeleteStartedEvents(){
		return $this->checkRights($this->conf["rights."]["delete."]["event."]["allowedToDeleteStartedEvents."]);
	}
	
	function isAllowedToCreateExceptionEvents(){
		return $this->checkRights($this->conf["rights."]["create."]["exceptionEvent."]["allowedToCreateExceptionEvents."]);
	}
	
	function isAllowedToEditExceptionEvents(){
		return $this->checkRights($this->conf["rights."]["edit."]["exceptionEvent."]["allowedToEditExceptionEvents."]);
	}
	
	function isAllowedToDeleteExceptionEvents(){
		return $this->checkRights($this->conf["rights."]["delete."]["exceptionEvent."]["allowedToDeleteExceptionEvents."]);
	}
	
	function isAllowedToCreateLocations(){
		return $this->checkRights($this->conf["rights."]["create."]["location."]["allowedToCreateLocations."]);
	}
	
	function isAllowedToCreateLocationHidden(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationTitle(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationDescription(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationName(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateName."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationStreet(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateStreet."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationZip(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateZip."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationCity(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateCity."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationPhone(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreatePhone."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationEmail(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateEmail."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationLogo(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateLogo."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateLocationHomepage(){
		if($this->checkRights($this->conf["rights."]["create."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["location."]["fields."]["allowedToCreateHomepage."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocations(){
		
		return $this->checkRights($this->conf["rights."]["edit."]["location."]["allowedToEditLocations."]);
	}
	
	function isAllowedToEditLocationHidden(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditLocationHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationTitle(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditLocationTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationDescription(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationName(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditName."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationStreet(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditStreet."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationZip(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditZip."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationCity(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditCity."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationPhone(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditPhone."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationEmail(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditEmail."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationLogo(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditLogo."]))
			return true;
		return false;
	}
	
	function isAllowedToEditLocationHomepage(){
		if($this->checkRights($this->conf["rights."]["edit."]["location."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["location."]["fields."]["allowedToEditHomepage."]))
			return true;
		return false;
	}
	
	function isAllowedToDeleteLocations(){
		return $this->checkRights($this->conf["rights."]["delete."]["location."]["fields."]["allowedToDeleteLocations."]);
	}
	
	function isAllowedToCreateOrganizer(){
		return $this->checkRights($this->conf["rights."]["create."]["organizer."]["allowedToCreateOrganizer."]);
	}
	
	function isAllowedToCreateOrganizerHidden(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerTitle(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerDescription(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerName(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateName."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerStreet(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateStreet."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerZip(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateZip."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerCity(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateCity."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerPhone(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreatePhone."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerEmail(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateEmail."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerLogo(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateLogo."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateOrganizerHomepage(){
		if($this->checkRights($this->conf["rights."]["create."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["organizer."]["fields."]["allowedToCreateHomepage."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizer(){
		return $this->checkRights($this->conf["rights."]["edit."]["organizer."]["allowedToEditOrganizer."]);
	}
	
	function isAllowedToEditOrganizerHidden(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditOrganizerHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerTitle(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditOrganizerTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerDescription(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditDescription."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerName(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditName."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerStreet(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditStreet."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerZip(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditZip."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerCity(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditCity."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerPhone(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditPhone."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerEmail(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditEmail."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerLogo(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditLogo."]))
			return true;
		return false;
	}
	
	function isAllowedToEditOrganizerHomepage(){
		if($this->checkRights($this->conf["rights."]["edit."]["organizer."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["organizer."]["fields."]["allowedToEditHomepage."]))
			return true;
		return false;
	}
	
	function isAllowedToDeleteOrganizer(){
		return $this->checkRights($this->conf["rights."]["delete."]["organizer."]["allowedToDeleteOrganizer."]);
	}
	
	function isAllowedToCreateCalendar(){
		return $this->checkRights($this->conf["rights."]["create."]["calendar."]["allowedToCreateCalendar."]);
	}
	
	function isAllowedToCreateCalendarHidden(){
		if($this->checkRights($this->conf["rights."]["create."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["calendar."]["fields."]["allowedToCreateHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCalendarTitle(){
		if($this->checkRights($this->conf["rights."]["create."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["calendar."]["fields."]["allowedToCreateTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCalendarFeUser(){
		if($this->checkRights($this->conf["rights."]["create."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["calendar."]["fields."]["allowedToCreateFeUser."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCalendar(){
		return $this->checkRights($this->conf["rights."]["edit."]["calendar."]["allowedToEditCalendar."]);
	}
	
	function isAllowedToEditCalendarHidden(){
		if($this->checkRights($this->conf["rights."]["edit."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["calendar."]["fields."]["allowedToEditHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCalendarTitle(){
		if($this->checkRights($this->conf["rights."]["edit."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["calendar."]["fields."]["allowedToEditTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCalendarFeUser(){
		if($this->checkRights($this->conf["rights."]["edit."]["calendar."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["calendar."]["fields."]["allowedToEditFeUser."]))
			return true;
		return false;
	}
	
	function isAllowedToDeleteCalendar(){
		return $this->checkRights($this->conf["rights."]["delete."]["calendar."]["allowedToDeleteCalendar."]);
	}
	
	function isAllowedToCreateCategory(){
		return $this->checkRights($this->conf["rights."]["create."]["category."]["allowedToCreateCategory."]);
	}
	
	function isAllowedToCreateCategoryHidden(){
		if($this->checkRights($this->conf["rights."]["create."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["category."]["fields."]["allowedToCreateHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCategoryTitle(){
		if($this->checkRights($this->conf["rights."]["create."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["category."]["fields."]["allowedToCreateTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCategoryHeaderStyle(){
		if($this->checkRights($this->conf["rights."]["create."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["category."]["fields."]["allowedToCreateHeaderstyle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCategoryBodyStyle(){
		if($this->checkRights($this->conf["rights."]["create."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["category."]["fields."]["allowedToCreateBodystyle."]))
			return true;
		return false;
	}
	
	function isAllowedToCreateCategoryFeUser(){
		if($this->checkRights($this->conf["rights."]["create."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["create."]["category."]["fields."]["allowedToCreateFeUser."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCategory(){
		return $this->checkRights($this->conf["rights."]["edit."]["category."]["allowedToEditCategory."]);
	}
	
	function isAllowedToEditCategoryHidden(){
		if($this->checkRights($this->conf["rights."]["edit."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["category."]["fields."]["allowedToEditHidden."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCategoryTitle(){
		if($this->checkRights($this->conf["rights."]["edit."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["category."]["fields."]["allowedToEditTitle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCategoryHeaderstyle(){
		if($this->checkRights($this->conf["rights."]["edit."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["category."]["fields."]["allowedToEditHeaderstyle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCategoryBodystyle(){
		if($this->checkRights($this->conf["rights."]["edit."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["category."]["fields."]["allowedToEditBodystyle."]))
			return true;
		return false;
	}
	
	function isAllowedToEditCategoryFeUser(){
		if($this->checkRights($this->conf["rights."]["edit."]["category."]["enableAllFields."]) ||
		$this->checkRights($this->conf["rights."]["edit."]["category."]["fields."]["allowedToEditFeUser."]))
			return true;
		return false;
	}
	
	function isAllowedToDeleteCategory(){
		return $this->checkRights($this->conf["rights."]["delete."]["category."]["allowedToDeleteCalendar."]);
	}	
	
	
	

	function checkRights($category){
		if($this->isCalAdmin())
			return true;
		if($this->isLoggedIn()){
			$users = split(',',$category["user"]);
			$groups = split(',',$category["group"]);
		
			if(array_search($this->getUserId(),$users) !== false)
				return true;
			$userGroups = $this->getUserGroups();
			foreach($groups as $key => $group){
				if(array_search(ltrim($group),$userGroups) !== false)
					return true;
			}
		}
		return false;
	}
}

	

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/controller/class.tx_cal_rightscontroller.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/controller/class.tx_cal_rightscontroller.php']);
}
	 
?>