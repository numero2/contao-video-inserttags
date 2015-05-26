<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2013 numero2 - Agentur für Internetdienstleistungen
 * @author     numero2 (http://www.numero2.de)
 * @package    Video Inserttags
 * @license    LGPL
 */
 
class ModuleVideoInsertTags extends Controller {
	
    const ID_REGEX_YOUTUBE = '(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+';
    const ID_REGEX_VIMEO   = 'vimeo.com/([0-9]+)(/|)';

	protected function replaceInsertTags($strBuffer, $blnCache=false) {

	
		global $objPage;
		$this->import('Database');
	
        $aParams = explode('::', $strBuffer);
 
        switch( $aParams[0] ) {
        
            case 'video' :

                $aParams[2] = str_replace('[&]', '&', $aParams[2]);
                parse_str($aParams[2],$styles);
                $player = NULL;

                // YOUTUBE
                if( preg_match_all("#".ModuleVideoInsertTags::ID_REGEX_YOUTUBE."#", $aParams[1], $aBuffer) ) {

                    $player = '<iframe allowfullscreen style="border:0;" ';

                    if( !empty($styles['width']) )
                        $player .= 'width="'.$styles['width'].'" ';

                    if( !empty($styles['height']) )
                        $player .= 'height="'.$styles['height'].'" ';

                    $player .= 'src="//www.youtube.com/embed/'.$aBuffer[0][0].'"></iframe>';
                }

                // VIMEO
                if( preg_match_all("#".ModuleVideoInsertTags::ID_REGEX_VIMEO."#", $aParams[1], $aBuffer) ) {

                    $player = '<iframe allowfullscreen style="border:0;" ';

                    if( !empty($styles['width']) )
                        $player .= 'width="'.$styles['width'].'" ';

                    if( !empty($styles['height']) )
                        $player .= 'height="'.$styles['height'].'" ';

                    $player .= 'src="//player.vimeo.com/video/'.$aBuffer[1][0].'?title=0&amp;byline=0&amp;portrait=0"></iframe>';
                }

                $styles = array(
                    !empty($styles['width']) ? 'width:'.$styles['width'].'px' : null
                ,   !empty($styles['height']) ? 'height:'.$styles['height'].'px;' : null
                );

                if( $player )
                    return sprintf(
                        '<span class="inline_video" style="display:inline-block; %s">%s</span>'
                    ,   implode('; ',$styles)
                    ,   $player
                    );
                else
                    return false;

            break;
            
            // not our insert tag?
            default :
                return false;
            break;
        }

        return false;
    
    }
}

?>