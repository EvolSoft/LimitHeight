<?php

/*
 * LimitHeight (v1.0) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 18/04/2015 02:55 PM (UTC)
 * Copyright & License: (C) 2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/LimitHeight/blob/master/LICENSE)
 */

namespace LimitHeight;

use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
	
	//About Plugin Const
	
	/** @var string PRODUCER Plugin producer */
	const PRODUCER = "EvolSoft";
	
	/** @var string VERSION Plugin version */
	const VERSION = "1.0";
	
	/** @var string MAIN_WEBSITE Plugin producer website */
	const MAIN_WEBSITE = "http://www.evolsoft.tk";
	
	//Other Const
	
	/** @var string PREFIX Plugin prefix */
	const PREFIX = "&3[LimitHeight] ";
	
    
    /**
     * Translate Minecraft colors
     * 
     * @param char $symbol Color symbol
     * @param string $message The message to be translated
     * 
     * @return string The translated message
     */
    public function translateColors($symbol, $message){
    
    	$message = str_replace($symbol."0", TextFormat::BLACK, $message);
    	$message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
    	$message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
    	$message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
    	$message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
    	$message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
    	$message = str_replace($symbol."6", TextFormat::GOLD, $message);
    	$message = str_replace($symbol."7", TextFormat::GRAY, $message);
    	$message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
    	$message = str_replace($symbol."9", TextFormat::BLUE, $message);
    	$message = str_replace($symbol."a", TextFormat::GREEN, $message);
    	$message = str_replace($symbol."b", TextFormat::AQUA, $message);
    	$message = str_replace($symbol."c", TextFormat::RED, $message);
    	$message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
    	$message = str_replace($symbol."e", TextFormat::YELLOW, $message);
    	$message = str_replace($symbol."f", TextFormat::WHITE, $message);
    
    	$message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
    	$message = str_replace($symbol."l", TextFormat::BOLD, $message);
    	$message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
    	$message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
    	$message = str_replace($symbol."o", TextFormat::ITALIC, $message);
    	$message = str_replace($symbol."r", TextFormat::RESET, $message);
    
    	return $message;
    }
    
    public function onEnable(){
	    @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
        $this->logger = Server::getInstance()->getLogger();
        $this->logger->info($this->translateColors("&", Main::PREFIX . "&9LimitHeight &bv" . Main::VERSION . " &9developed by&b " . Main::PRODUCER));
        $this->logger->info($this->translateColors("&", Main::PREFIX . "&9Website &b" . Main::MAIN_WEBSITE));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function isLimitDisabled($level){
    	$level = strtolower($level);
    	$cfg = $this->getConfig()->getAll();
    	$tmp = array();
    	for($i = 0; $i < count($cfg["disabled-in-worlds"]); $i++){
    		$name = strtolower($cfg["disabled-in-worlds"][$i]);
    		$tmp[$name] = "";
    	}
    	return isset($tmp[$level]);
    }
    
    
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
    					$player->sendMessage($this->translateColors("&", Main::PREFIX . $message));
    				}else{
    					$player->sendMessage($this->translateColors("&", $message));
    				}
    			}
    			$event->setCancelled(true);
    		}
    	}
    }
}
?>
