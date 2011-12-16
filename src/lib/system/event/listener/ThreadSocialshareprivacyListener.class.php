<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * This listener adds the socialshareprivacy container.
 * @author Jim Martens
 * @copyright 2011 Jim Martens
 * @license http://opensource.org/licenses/lgpl-license.php GNU Lesser General Public License
 * @package de.plugins-zum-selberbauen.socialWBB
 * @subpackage system.event.listener
 * @category Burning Board
 */
class ThreadSocialshareprivacyListener implements EventListener {
    
    /**
     * Adds the socialshareprivacy container to the end of a thread.
     * @see EventListener::execute()
     */
    public function execute($eventObj, $className, $eventName) {
        if ($eventName == 'assignVariables' || $eventName == 'shouldDisplay') {
            $this->assignVariables($eventName);
        }
    }
    
    /**
     * Appends the socialshareprivacy container.
     *
     * @param String $eventName
     */
    protected function assignVariables($eventName) {
        if (!defined('MODULE_SOCIALSHAREPRIVACY') || !MODULE_SOCIALSHAREPRIVACY) return;
        if (WCF::getUser()->getUserOption('seeSocialshareprivacy') !== null && !WCF::getUser()->getUserOption('seeSocialshareprivacy')) return;
        WCF::getTPL()->assign('eventName', $eventName);
        $templateName = 'socialshareprivacy';
        $content = WCF::getTPL()->fetch($templateName);
        if ($eventName == 'assignVariables' && GENERAL_SOCIALSHAREPRIVACY_GENERAL_LOCATION == 'thread') {
            WCF::getTPL()->append('additionalBoxes', $content);
        }
        elseif ($eventName == 'shouldDisplay' && GENERAL_SOCIALSHAREPRIVACY_GENERAL_LOCATION == 'header') {
            WCF::getTPL()->append('additionalHeaderContents', $content);
        }
    }
}
