<?php

abstract class Block extends Position{
	public static $class = array(
			AIR => "AirBlock",
			STONE => "StoneBlock",
			GRASS => "GrassBlock",
			DIRT => "DirtBlock",
			COBBLESTONE => "CobblestoneBlock",
			PLANKS => "PlanksBlock",
			SAPLING => "SaplingBlock",
			BEDROCK => "BedrockBlock",
			WATER => "WaterBlock",
			STILL_WATER => "StillWaterBlock",
			LAVA => "LavaBlock",
			STILL_LAVA => "StillLavaBlock",
			SAND => "SandBlock",
			GRAVEL => "GravelBlock",
			GOLD_ORE => "GoldOreBlock",
			IRON_ORE => "IronOreBlock",
			COAL_ORE => "CoalOreBlock",
			WOOD => "WoodBlock",
			LEAVES => "LeavesBlock",
			GLASS => "GlassBlock",
			LAPIS_ORE => "LapisOreBlock",
			LAPIS_BLOCK => "LapisBlock",
			SANDSTONE => "SandstoneBlock",
			BED_BLOCK => "BedBlock",
			TALL_GRASS => "TallGrassBlock",
			WOOL => "WoolBlock",
			DANDELION => "DandelionBlock",
			CYAN_FLOWER => "CyanFlowerBlock",
			BROWN_MUSHROOM => "BrownMushroomBlock",
			RED_MUSHROOM => "RedMushRoomBlock",
			GOLD_BLOCK => "GoldBlock",
			IRON_BLOCK => "IronBlock",
			DOUBLE_SLAB => "DoubleSlabBlock",
			SLAB => "SlabBlock",
			BRICKS_BLOCK => "BricksBlock",
			TNT => "TNTBlock",
			BOOKSHELF => "BookshelfBlock",
			MOSS_STONE => "MossStoneBlock",
			OBSIDIAN => "ObsidianBlock",
			TORCH => "TorchBlock",
			FIRE => "FireBlock",
        
			WOOD_STAIRS => "WoodStairsBlock",
			CHEST => "ChestBlock",

			DIAMOND_ORE => "DiamondOreBlock",
			DIAMOND_BLOCK => "DiamondBlock",
			WORKBENCH => "WorkbenchBlock",
			WHEAT_BLOCK => "WheatBlock",
			FARMLAND => "FarmlandBlock",
			FURNACE => "FurnaceBlock",
			BURNING_FURNACE => "BurningFurnaceBlock",
			SIGN_POST => "SignPostBlock",
			WOOD_DOOR_BLOCK => "WoodDoorBlock",
			LADDER => "LadderBlock",
			COBBLESTONE_STAIRS => "CobblestoneStairsBlock",
			WALL_SIGN => "WallSignBlock",

			IRON_DOOR_BLOCK => "IronDoorBlock",
			REDSTONE_ORE => "RedstoneOreBlock",
			GLOWING_REDSTONE_ORE => "GlowingRedstoneOreBlock",

			SNOW_LAYER => "SnowLayerBlock",
			ICE => "IceBlock",
			SNOW_BLOCK => "SnowBlock",
			CACTUS => "CactusBlock",
			CLAY_BLOCK => "ClayBlock",
			SUGARCANE_BLOCK => "SugarcaneBlock",

			FENCE => "FenceBlock",
			NETHERRACK => "NetherrackBlock",
			SOUL_SAND => "SoulSandBlock",
			GLOWSTONE_BLOCK => "GlowstoneBlock",

			INVISIBLE_BEDROCK => "InvisibleBedrockBlock",
			
			CAKE_BLOCK => "CakeBlock",
			
			TRAPDOOR => "TrapdoorBlock",

			STONE_BRICKS => "StoneBricksBlock",

			GLASS_PANE => "GlassPaneBlock",
			MELON_BLOCK => "MelonBlock",
			MELON_STEM => "MelonStemBlock",

			FENCE_GATE => "FenceGateBlock",
			BRICK_STAIRS => "BrickStairsBlock",
			STONE_BRICK_STAIRS => "StoneBrickStairsBlock",

			NETHER_BRICKS => "NetherBricksBlock",

			NETHER_BRICKS_STAIRS => "NetherBricksStairsBlock",

			SANDSTONE_STAIRS => "SandstoneStairsBlock",

			QUARTZ_BLOCK => "QuartzBlock",
			QUARTZ_STAIRS => "QuartzStairsBlock",
			DOUBLE_WOOD_SLAB => "DoubleWoodSlabBlock",
			WOOD_SLAB => "WoodSlabBlock",

			STONECUTTER => "StonecutterBlock",
			GLOWING_OBSIDIAN => "GlowingObsidianBlock",
			NETHER_REACTOR => "NetherReactorBlock",
			INFO_UPDATE => "InfoUpdateBlock",
			INFO_UPDATE2 => "InfoUpdate2Block",
			RESERVED6 => "Reserved6Block",
			COBWEB => "CobwebBlock",
	);
	protected $id;
	protected $meta;
	protected $name;
	protected $breakTime;
	public $boundingBox;
	protected $hardness;
	public $isActivable = false;
	public $breakable = true;
	public $isFlowable = false;
	public $isSolid = true;
	public $isTransparent = false;
	public $isReplaceable = false;
	public $isPlaceable = true;
	public $level = false;
	public $hasPhysics = false;
	public $isLiquid = false;
	public $isFullBlock = true;
	public $x = 0;
	public $y = 0;
	public $z = 0;
	public $slipperiness;
	
	public static function onRandomTick(Level $level, $x, $y, $z){}
	public static function fallOn(Level $level, $x, $y, $z, Entity $entity, $fallDistance){}
	public static function getCollisionBoundingBoxes(Level $level, $x, $y, $z, Entity $entity){
		return [new AxisAlignedBB($x, $y, $z, $x, $y, $z)];
	}
	public function __construct($id, $meta = 0, $name = "Unknown"){
		$this->id = (int) $id;
		$this->meta = (int) $meta;
		$this->name = $name;
		$this->breakTime = 0.20;
		$this->hardness = 10;
		$this->slipperiness = 0.6;
		$this->boundingBox = new AxisAlignedBB($this->x, $this->y, $this->z, $this->x + 1, $this->y + 1, $this->z + 1);
	}
	
	final public function getHardness(){
		return ($this->hardness);
	}
	
	final public function getName(){
		return $this->name;
	}
	
	final public function getID(){
		return $this->id;
	}
	public function setMetadata($i){
		$this->meta = $i;
	}
	final public function getMetadata(){
		return $this->meta & 0x0F;
	}
	
	final public function position(Position $v){
		$this->level = $v->level;
		$this->x = (int) $v->x;
		$this->y = (int) $v->y;
		$this->z = (int) $v->z;
		$this->boundingBox->setBounds($this->x, $this->y, $this->z, $this->x + 1, $this->y + 1, $this->z + 1);
	}
	
	public function getDrops(Item $item, Player $player){
		if(!isset(Block::$class[$this->id])){ //Unknown blocks
			return array();
		}else{
			return array(
				array($this->id, $this->meta, 1),
			);
		}
	}
	
	public function getBreakTime(Item $item, Player $player){
		if(($player->gamemode & 0x01) === 0x01){
			return 0.15;
		}
		return $this->breakTime;
	}
	
	public function getSide($side, $step = 1){
		$v = parent::getSide($side, $step);
		if($this->level instanceof Level){
			return $this->level->getBlock($v);
		}
		return $v;
	}
	
	final public function __toString(){
		return "Block ". $this->name ." (".$this->id.":".$this->meta.")";
	}
	
	abstract function isBreakable(Item $item, Player $player);
	
	abstract function onBreak(Item $item, Player $player);
	
	abstract function place(Item $item, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz);
	
	abstract function onActivate(Item $item, Player $player);
	
	abstract function onUpdate($type);
}

/***REM_START***/
require_once("block/GenericBlock.php");
require_once("block/SolidBlock.php");
require_once("block/TransparentBlock.php");
require_once("block/FallableBlock.php");
require_once("block/LiquidBlock.php");
require_once("block/StairBlock.php");
require_once("block/DoorBlock.php");
/***REM_END***/
