<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    LGPL
 */


$GLOBALS['TL_DCA']['tl_member']['list']['operations']['files'] = array
(
	'label'               => &$GLOBALS['TL_LANG']['tl_member']['files'],
	'href'                => 'table=tl_member_files',
	'icon'                => 'system/modules/memberfiles/html/icon.gif',
	'button_callback'     => array('tl_member_memberfiles', 'filesButton'),
);


class tl_member_memberfiles extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	
	public function filesButton($row, $href, $label, $title, $icon, $attributes)
	{
		if (!$this->User->isAdmin && (!is_array($this->User->fop) || !in_array('f2', $this->User->fop)))
			return '';
		
		return ($row['assignDir'] && strlen($row['homeDir'])) ? '<a href="'.$this->addToUrl($href.'&amp;member='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
}