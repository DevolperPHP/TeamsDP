<?php

namespace TeamsDP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\level\Position;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\inventory\InventoryBase;
use pocketmine\utils\TextFormat as Color;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\Server;

class teamsdp extends PluginBase implements Listene{
  
  	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("TeamsDP By JUZEXMOD is Enabled");
		@mkdir($this->getDataFolder());
		$teams = [
				
				'xteamyellow' => 0,
				'yteamyellow' => 0,
				'zteamyellow' => 0,
				'worldteamyellow' => 'world',
				'xteamred' => 0,
				'yteamred' => 0,
				'zteamred' => 0,
				'worldteamred' => 'world',
				'xteamblue' => 0,
				'yteamblue' => 0,
				'zteamblue' => 0,
				'worldteamblue' => 'world',
				'xteamgreen' => 0,
				'yteamgreen' => 0,
				'zteamgreen' => 0,
				'worldteamgreen' => 'world',
        'game' => 'world'
		];
		$cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, $teams);
		$cfg->save();
	}
  
  public function onDisable(){
    $this->getConfig()->save();
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    if($sender->isOp()){
     switch($cmd->getName()){
      case 'team':
        
        if(isset($args[0])){
          switch($args[0])){
              
            case 'set':
              
              if(isset($args[1])){
                switch($args[1]){
                    
                  case 'yellow':
                    $worldteamyellow = $sender->getLevel()->getName();
		    $xteamyellow = $sender->getFloorX();
	       	    $yteamyellow = $sender->getFloorY();
		    $zteamyellow = $sender->getFloorZ();
										
		    $this->getConfig()->set("xteamyellow", $xteamyellow);
		    $this->getConfig()->set("yteamyellow", $yteamyellow);
		    $this->getConfig()->set("zteamyellow", $zteamyellow);
	            $this->getConfig()->set("worldteamyellow", $worldteamyellow);
				
		    $sender->sendMessage(Color::YELLOW."[TeamsDP] Yellow Team Spawn Now in [$xteamyellow, $yteamyellow, $zteamyellow]");
		    $sender->sendMessage(Color::YELLOW."[TeamsDP] World [$worldteamyellow]");
			return true;
                    
                  case 'red':
                    $worldteamred = $sender->getLevel()->getName();
		    $xteamred = $sender->getFloorX();
	            $yteamred = $sender->getFloorY();
		    $zteamred = $sender->getFloorZ();
										
		    $this->getConfig()->set("xteamred", $xteamred);
	            $this->getConfig()->set("yteamred", $yteamred);
		    $this->getConfig()->set("zteamred", $zteamred);
	            $this->getConfig()->set("worldteamred", $worldteamred);
										
		    $sender->sendMessage(Color::RED."[TeamsDP] RED Team Spawn Now in [$xteamred, $yteamred, $zteamred]");
		    $sender->sendMessage(Color::RED."[TeamsDP] World [$worldteamred]");
			return true;
                    
                  case 'blue':
                    $worldteamblue = $sender->getLevel()->getName();
		    $xteamblue = $sender->getFloorX();
		    $yteamblue = $sender->getFloorY();
		    $zteamblue = $sender->getFloorZ();
										
		    $this->getConfig()->set("xteamblue", $xteamblue);
		    $this->getConfig()->set("yteamblue", $yteamblue);
	            $this->getConfig()->set("zteamblue", $zteamblue);
		    $this->getConfig()->set("worldteamblue", $worldteamblue);
										
		    $sender->sendMessage(Color::AQUA."[TeamsDP] Blue Team Spawn Now in [$xteamblue, $yteamblue, $zteamblue]");
		    $sender->sendMessage(Color::AQUA."[TeamsDP] World [$worldteamblue]");
			return true;
                    
                  case 'green':
                    $worldteamgreen = $sender->getLevel()->getName();
		    $xteamgreen = $sender->getFloorX();
		    $yteamgreen = $sender->getFloorY();
		    $zteamgreen = $sender->getFloorZ();
										
		    $this->getConfig()->set("xteambgreen", $xteamgreen);
		    $this->getConfig()->set("yteamgreen", $yteamgreen);
		    $this->getConfig()->set("zteamgreen", $zteamgreen);
		    $this->getConfig()->set("worldteamblue", $worldteamgreen);
										
		    $sender->sendMessage(Color::AQUA."[TeamsDP] Blue Team Spawn Now in [$xteamgreen, $yteamgreen, $zteamgreen]");
		    $sender->sendMessage(Color::AQUA."[TeamsDP] World [$worldteamgreen]");
			return true;
                    
                  case 'game':
                    $game = $sender->getLevel()->getName();
                    
                    $this->getConfig()->set("game", $game);
                    
                    $sender->sendMessage(Color::GREEN."[TeamsDP] Game Word Name [$game]");
                }
              }
          }
        }
    }
  }
    }
  
  public function onTouch(PlayerInteractEvent $event){
    $player = $event->getPlayer();
    $name = $player->getName();
    $block = $event->getBlock()->getId();
    
    $tytag = "[YELLOW]";
    $trtag = "[RED]";
    $tbtag = "[BLUE]";
    $tgtag = "[GREEN]";
    
    $xty = $this->getConfig()->get("xteamyellow");
    $yty = $this->getConfig()->get("yteamyellow");
    $zty = $this->getConfig()->get("zteamyellow");
    $wty = $this->getConfig()->get("worldteamyellow");
    
    $xtr = $this->getConfig()->get("xteamred");
    $ytr = $this->getConfig()->get("yteamred");
    $ztr = $this->getConfig()->get("zteamred");
    $wtr = $this->getConfig()->get("worldteamred");
    
    $xtb = $this->getConfig()->get("xteamblue");
    $ytb = $this->getConfig()->get("yteamblue");
    $ztb = $this->getConfig()->get("zteamblue");
    $wtb = $this->getConfig()->get("worldteamblue");
    
    $xtg = $this->getConfig()->get("xteamgreen");
    $ytg = $this->getConfig()->get("yteamgreen");
    $ztg = $this->getConfig()->get("zteamgreen");
    $wtg = $this->getConfig()->get("worldteamgreen");
    
    $game = $this->getConfig()->get("game");
    
    foreach($game is $p){
      
      if($block == 103){
        
        switch(mt_rand(1,4)){
            
          case 1:
            $p->setNameTag("$tytag" . $name);
            break;
          case 2:
            $p->setNameTag("trtag" . $name);
            break;
          case 3:
            $p->setNameTag("tbtag" . $name);
            break;
          case 4:
            $p->setNameTag("tgtag" . $name);
            break;
        }
      }
    }
  }
  
  public function onEntityDamage(EntityDamageEvent $event){
		if ($event instanceof EntityDamageByEntityEvent) {
			if ($event->getEntity() instanceof Player && $event->getDamager() instanceof Player) {
				$golpeado = $event->getEntity()->getNameTag();
				$golpeador = $event->getDamager()->getNameTag();
				if ((strpos($golpeado, "[YELLOW]") !== false) && (strpos($golpeador, "[YELLOW]") !== false)) {
	
					$event->setCancelled();
				}
	
				else if ((strpos($golpeado, "[RED]") !== false) && (strpos($golpeador, "[RED]") !== false)) {
	
					$event->setCancelled();
				}
	
				else if ((strpos($golpeado, "[BLUE]") !== false) && (strpos($golpeador, "[BLUE]") !== false)) {
	
					$event->setCancelled();
				}
	
				else if ((strpos($golpeado, "[GREEN]") !== false) && (strpos($golpeador, "[GREEN]") !== false)) {
	
					$event->setCancelled();
				}
			}
	
		}
	}
}
