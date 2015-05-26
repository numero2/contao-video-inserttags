<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   video_inserttags
 * @author    numero2 - Agentur für Internetdienstleistungen
 * @license   LGPL
 * @copyright 2015
 */


/**
 * Namespace
 */
namespace numero2\VideoInsertTags;


class VideoInsertTags extends \Controller {
	
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
                if( preg_match_all("#".VideoInsertTags::ID_REGEX_YOUTUBE."#", $aParams[1], $aBuffer) ) {

                    $player = '<iframe allowfullscreen style="border:0;" ';

                    if( !empty($styles['width']) )
                        $player .= 'width="'.$styles['width'].'" ';

                    if( !empty($styles['height']) )
                        $player .= 'height="'.$styles['height'].'" ';

                    $player .= 'src="//www.youtube.com/embed/'.$aBuffer[0][0].'"></iframe>';
                }

                // VIMEO
                if( preg_match_all("#".VideoInsertTags::ID_REGEX_VIMEO."#", $aParams[1], $aBuffer) ) {

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