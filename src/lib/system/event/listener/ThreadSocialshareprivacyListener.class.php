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
        if ($className == 'assignVariables') $this->assignVariables();
    }
    
    /**
     * Appends the socialshareprivacy container.
     */
    protected function assignVariables() {
        $templateName = 'socialshareprivacy';
        $content = WCF::getTPL()->fetch($templateName);
        WCF::getTPL()->append('additionalBoxes', $content);
    }
}
