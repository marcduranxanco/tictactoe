<?php

namespace App\RobotMission\Controller;

use \Exeption;
use App\Mission\Planet\PlanetController;
use App\Mission\Robot\RobotController;
use Utils\Search;

class TictactoeController
{
    private PlanetController $planet;
    private array $planetMap = [];
    private array $planetObstacles = [];
    private array $robotRoute = [];
    private bool $robotCrashed = false;
    private string $crashMessage = "";
    
    private RobotController $robot;

    public function run(): string
    {
        $this->planet = new PlanetController($_ENV["PLANET_H"],$_ENV["PLANET_W"]);
        $this->defineMap();

        // Obstacle definitions
        $this->planetObstacles[0] = ["h" => 1, "w" => 7];
        $this->planetObstacles[1] = ["h" => 5, "w" => 6];
        $this->planet->addObstacles($this->planetObstacles);

        $this->addObstaclesToMap();

        $this->robot = new RobotController($_ENV["INIT_H"], $_ENV["INIT_W"], $_ENV["ROUTE"]);
        $this->robotRoute = $this->robot->getRoute();
        $this->addRouteRoMap();

        return $this->cliRuoute();
    }

    public function defineMap(): array
    {
        $size = $this->planet->getSize();
        $h = 0;
        $w = 0;
        while ($h <= $size["h"]) {
            while ($w <= $size["w"]){
                array_push($this->planetMap, ["h" => $h, "w" => $w, "value" => "-"]);
                $w++;
            }
            $w = 0;
            $h++;  
        }
        return $this->planetMap;
    }

    public function addObstaclesToMap(): void
    {
        foreach($this->planetObstacles as $obstacle){
            $search = (Search::multi_array_search($this->planetMap, ["h" => $obstacle["h"], "w" => $obstacle["w"]]))[0];
            if($search){
                $this->planetMap[$search]["value"] = "•";
            }
        }
    }

    public function addRouteRoMap(): void
    {
        foreach($this->robotRoute as $step){
            if($step["h"] > $_ENV["PLANET_H"] || $step["w"] > $_ENV["PLANET_W"]){
                throw new \Exception("With this route, the robot reaches the limit of the planet", 1);
            }

            $collision = array_search($step, $this->planetObstacles);
            if(!$collision){
                $this->robotCrashed = true;
                $this->crashMessage = "The robot has crashed with an obstacle at row " . $step["h"] . ", column: " . $step["w"];
            }

            $search = (Search::multi_array_search($this->planetMap, ["h" => $step["h"], "w" => $step["w"]]))[0];
            if($search){
                $this->planetMap[$search]["value"] = ">";
            }
        }
    }

    public function cliRuoute(): string
    {
        $route = "";
        $size = $this->planet->getSize();
        $h = 0;
        $w = 0;
        while ($h <= $size["h"]) {
            while ($w <= $size["w"]){
                $search = Search::multi_array_search($this->planetMap, ["h" => $h, "w" => $w]);
                $value = $this->planetMap[$search[0]]["value"];
                $route = $route . $value;
                $w++;
            }
            $route = $route . "\n";
            $w = 0;
            $h++;  
        }
        $route = $route . "\n" . $this->crashMessage;
        return $route;
    }
}
