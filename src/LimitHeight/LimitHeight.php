<?php

/*
 * LimitHeight v1.6 by EvolSoft
 * Developer: Flavius12
 * Website: https://www.evolsoft.tk
 * Copyright (C) 2015-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/LimitHeight/blob/master/LICENSE)
 */

namespace LimitHeight;

use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class LimitHeight extends PluginBase implements Listener {
    
    /** @var string */
    const PREFIX = "&3[LimitHeight] ";
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    /**
     * Check if the height limit is disabled on the specified world
     * 
     * @param string
     * 
     * @return bool
     */
    private function isLimitDisabled($level) : bool {
        $cfg = $this->getConfig()->getAll();
        foreach($cfg["disabled-in-worlds"] as $item){
            if(strcasecmp($item, $level) == 0){
                return true;
            }
        }
        return false;
    }
    
    /**
     * @param BlockPlaceEvent $event
     */
    public function onBlockPlace(BlockPlaceEvent $event){
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $cfg = $this->getConfig()->getAll();
        if(!$player->hasPermission("limitheight.bypass") && !$this->isLimitDisabled($player->getLevel()->getName())){
            if($block->y > $cfg["height-limit"]){
                if($cfg["show-message"]){
                    $message = $cfg["message"];
                    $message = str_replace("{LIMIT}", $cfg["height-limit"], $message);
                    if($cfg["show-prefix"]){
                        $message = self::PREFIX . $message;
                    }
                    $player->sendMessage(TextFormat::colorize($message));
                }
                $event->setCancelled(true);
            }
        }
    }
}