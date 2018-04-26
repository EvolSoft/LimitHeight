<?php

/*
 * LimitHeight (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 22/02/2018 07:19 PM (UTC)
 * Copyright & License: (C) 2015-2018 EvolSoft
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
    
    /**
     * Translate Minecraft colors
     *
     * @param string $symbol
     * @param string $message
     *
     * @return string
     */
    public function translateColors($symbol, $message){
        $message = str_replace($symbol . "0", TextFormat::BLACK, $message);
        $message = str_replace($symbol . "1", TextFormat::DARK_BLUE, $message);
        $message = str_replace($symbol . "2", TextFormat::DARK_GREEN, $message);
        $message = str_replace($symbol . "3", TextFormat::DARK_AQUA, $message);
        $message = str_replace($symbol . "4", TextFormat::DARK_RED, $message);
        $message = str_replace($symbol . "5", TextFormat::DARK_PURPLE, $message);
        $message = str_replace($symbol . "6", TextFormat::GOLD, $message);
        $message = str_replace($symbol . "7", TextFormat::GRAY, $message);
        $message = str_replace($symbol . "8", TextFormat::DARK_GRAY, $message);
        $message = str_replace($symbol . "9", TextFormat::BLUE, $message);
        $message = str_replace($symbol . "a", TextFormat::GREEN, $message);
        $message = str_replace($symbol . "b", TextFormat::AQUA, $message);
        $message = str_replace($symbol . "c", TextFormat::RED, $message);
        $message = str_replace($symbol . "d", TextFormat::LIGHT_PURPLE, $message);
        $message = str_replace($symbol . "e", TextFormat::YELLOW, $message);
        $message = str_replace($symbol . "f", TextFormat::WHITE, $message);
        
        $message = str_replace($symbol . "k", TextFormat::OBFUSCATED, $message);
        $message = str_replace($symbol . "l", TextFormat::BOLD, $message);
        $message = str_replace($symbol . "m", TextFormat::STRIKETHROUGH, $message);
        $message = str_replace($symbol . "n", TextFormat::UNDERLINE, $message);
        $message = str_replace($symbol . "o", TextFormat::ITALIC, $message);
        $message = str_replace($symbol . "r", TextFormat::RESET, $message);
        return $message;
    }
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getServer()->getLogger()->info($this->translateColors("&", self::PREFIX . "&9LimitHeight &bv" . $this->getDescription()->getVersion() . "&9 developed by &bEvolSoft"));
        $this->getServer()->getLogger()->info($this->translateColors("&", self::PREFIX . "&9Website &b" . $this->getDescription()->getWebsite()));
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
                    $player->sendMessage($this->translateColors("&", $message));
                }
                $event->setCancelled(true);
            }
        }
    }
}