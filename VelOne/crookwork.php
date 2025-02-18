<?php 
    // -----------------------------------------------------  DIVTYPE -----------------------------------------------------   
    class Com {
        private $type;
        private $objectStyle;
        private $className;
        private $endArray = [];
        private $lastEndArray;
        private $link;

        function __construct($type, $className = "", $objectStyle = "", $link = ""){
            $this->setType($type);
            $this->setClassName($className);
            $this->setObjectStyle($objectStyle);
        }

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SETTER/VALIDATOR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        function setType($var){
            $typeArray = ["div", "h1", "h2", "h3", "h4", "p", "a", "img"];
            if(in_array($var, $typeArray) !== false){
                $this->type = $var;
            }else{
                $this->type = "div";
            }
        }
        function setClassName($var){
            $type = $this->type;
            if($type == "div"){
                switch ($var){
                    case "mb":
                        $this->type = "middle_body";
                        break;
                    case "dfr":
                        $this->type = "display_type_flex_row";
                        break;
                    case "dfc":
                        $this->type = "display_type_flex_column";
                        break;
                    case "dgc":
                        $this->type = "display_type_grid_column";
                        break;
                }
            }else{
                $this->type = $var;
            }
        }
        function setObjectStyle($var){
            $this->type = $var;
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SETTER/VALIDATOR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END TAG ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        function comB($type){

        }function comE($endArray){

        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END TAG ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
    }
    // -----------------------------------------------------  DIVTYPE -----------------------------------------------------   

    // -----------------------------------------------------  BETTER COMPILER -----------------------------------------------------   
    class compiler {
        private $type;
        private $typeArray = [];
        private $style;
        private $className;
        private $id;
        private $href;


        function __construct($type = "", $className = "", $id = "", $style = "", $href = ""){
            $this->setType($type);
            $this->setClassName($className);
            $this->setId($id);
            $this->setStyle($style);
            $this->setLink($href);
        }

        private function setType($value){
            $compilerTypes = ["div", "h1", "h2", "h3", "h4", "p", "a", "img"];
            $this->type = "div";
            if(in_array($value, $compilerTypes) !== false){
                $this->type = $value;
            }
        }

        function setClassName($className){
            $type = $this->type;
            $this->className = "";
            if($type == "div"){
                switch($className){
                    case "mb":
                        $this->className = "class='middle_body'";
                        break;
                    case "dfr":
                        $this->className = "class='display_type_flex_row'";
                        break;
                    case "dfc":
                        $this->className = "class='display_type_flex_column'";
                        break;
                    case "dgc":
                        $this->className = "class='display_type_grid_column'";
                        break;
                    default:
                        $this->className = "class='$className'";
                }
            }else if(!empty($className)){
                $this->className = "class='$className'";
            }
        }

        function setId($id){
            $this->id = "";
            if(!empty($id)){
                $this->id = "id='$id'";
            }
        }

        function setStyle($style){
            $this->style = "";
            if(!empty($style)){
                $this->style = "style='$style'";
            }
        }

        function setLink($href){
            $this->href = "";
            if(!empty($href)){
                $this->href = "href='$href'";
            }
        }

        function open($type = $this->type, $className = $this->className, $id = $this->id, $style = $this->style, $href = $this->href){
            $this->typeArray[] = $type;
            echo"<$type $className $id $style $href>";

        }
        function close(){
            if(!empty($this->typeArray)){
                $lastType = array_pop($this->typeArray);
                echo"</$lastType>";
            }
        }
    }
    // -----------------------------------------------------  BETTER COMPILER -----------------------------------------------------   

    // -----------------------------------------------------  ICON AND BUTTONS -----------------------------------------------------
    $globalIconCounter = 1;
    class Icons{
        private $size;
        private $margin;
        private $radius;
        private $onClick;
        private $pcol;
        private $ccol;
        private $pacol;
        private $count;
        private $withAnim;
        private $nonToggle;
        private $value;

        
        function __construct($size, $radius, $pcol, $ccol){
            global $globalIconCounter;
            $this->size = $this->checkNum($size);
            $this->radius = $this->checkNum($radius);
            $this->pcol = $this->checkColor($pcol) ?? "white";
            $this->ccol = $this->checkColor($ccol) ?? "black";
            $this->pacol = "";
            $this->nonToggle = "";
            $this->withAnim = true;
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SETTER ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        function setSize($size){
            $this->size = $this->checkNum($size);
        }function setMargin($mar){
            $this->margin =  "--mar:" . $this->checkNum($mar) . ";";
        }function setRadius($radius){
            $this->radius = $this->checkNum($radius);
        }function setOnclick($OC){
            $this->onClick = $OC . ";";
        }function setBGPA($col){
            $pac = $this->checkColor($col) ?? "#3d3d3d";
            $this->pacol = "--BGPA: " .  $pac . ";";
        }function setBGP($col){
            $pc = $this->checkColor($col) ?? "#3d3d3d";
            $this->pcol = "--BGP: " .  $pc . ";";
        }function setDataValue($val){
            $this->value = $val;
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SETTER ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ VALIDATOR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        private function checkNum($size){
            return is_numeric($size) ? $size : 50;
        }
        private function checkColor($col){
            $colAry = ["white", "black", "grey", "red", "orange", "yellow", "green",  "blue", "indigo", "violet", "transparent"];
            if(in_array($col, $colAry) || preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $col)){
                return $col;
            }
            return null;
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ VALIDATOR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GETTER ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        function getID(){
            global $globalIconCounter;
            $this->count = $globalIconCounter;
            return "icon_check_{$this->count}";
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GETTER ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ START/END ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        private function iconStart($title, $ltitle){
            $title.= $this->nonToggle;
            $ltitle.= $this->nonToggle;
            global $globalIconCounter;
            $this->count = $globalIconCounter;
            $forWho = "for=\"icon_check_{$this->count}\"";
            echo "<label class=\"label_icon_{$ltitle}\" $forWho onclick=\"{$this->onClick} togle_icon('icon_cross_{$this->count}', 'icon_check_{$this->count}');\" style=\"{$this->margin} $this->pacol $this->pcol\">
                <input type=\"checkbox\" id=\"icon_check_{$this->count}\" class=\"chk_{$ltitle}\" data-value=\"{$this->value}\">
                <div class=\"{$title}\" style=\"--HW: {$this->size}px; --bRad: {$this->radius}px; $this->pacol\">";
        }
        private function iconEnd(){
            global $globalIconCounter;
            echo'</div></label>';
            $this->count++;
            $globalIconCounter++;
            
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ START/END ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WHAT ICON ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        function what_icon($type){
            $pathArray = ["", "", ""];
            switch($type){
                case "menu":
                    $pathArray = [
                        "M10 12 L90 12 A2 2 0 1 1 90 30 L10 30 A2 2 0 1 1 10 12", 
                        "M10 41 L90 41 A2 2 0 1 1 90 59 L10 59 A2 2 0 1 1 10 41", 
                        "M10 70 L90 70 A2 2 0 1 1 90 88 L10 88 A2 2 0 1 1 10 70"
                    ];
                    break;
                case "bell":
                    $pathArray = [
                        "M0 70 L100 70 L100 60 Q80 50 80 30 Q80 0 50 0 Q20 0 20 30 Q20 50 0 60 Z", 
                        "M30 75 A18 18 0 1 0 70 75 Z", 
                        ""
                    ];
                    break;
                case "mess":
                    $pathArray = [
                        "M15 15 L85 15 Q95 16 95 25 L95 30 L50 45 L5 30 L5 25 Q5 16 15 15",
                        "M5 35 L50 50 L95 35 L95 75 Q95 85 85 85 L15 85 Q5 85 5 75 L5 35",
                        "M10 16 L10 80 L90 80 L90 16 L85 16 L85 85 L15 85 L15 16"
                    ];
                    break;
                case "pass":
                    $pathArray = [
                        "M15 45 A1 1 0 1 1 85 45 L75 45 A1 1 0 1 0 25 45",
                        "M20 40 L80 40 Q90 40 90 50 L90 80 Q90 90 80 90 L20 90 Q10 90 10 80 L10 50 Q10 40 20 40",
                        ""
                    ];
                    break;
                case "bookmark":
                    $pathArray = [
                        "M15 5 L85 5 Q95 5 95 15 L95 85 Q95 95 85 95 L50 60 L15 95 Q5 95 5 85 L5 15 Q5 5 15 5",
                        "M15 80 L50 45 L85 80 L85 20 Q85 15 75 15 L20 15 Q15 15 15 20",
                        ""
                    ];
                    break;
                case "heart":
                    $pathArray = [
                        "M5 35 A1 1 0 1 1 50 35 A1 1 0 1 1 95 35 Q95 55 50 95 Q5 55 5 35",
                        "M15 35 A1 1 0 1 1 40 35 A1 1 0 1 0 60 35 A1 1 0 1 1 85 35 Q85 50 50 80 Q15 50 15 35",
                        ""
                    ];
                    break;
                case "blackUser":
                    $pathArray = [
                        "M50 45 A1 1 0 1 1 50 5 A1 1 0 1 1 50 45",
                        "M10 85 Q50 110 90 85 Q100 60 70 40 Q50 60 30 40 Q0 60 10 85",
                        ""
                    ];
                    break;
                case "home":
                    $pathArray = [
                        "M5 45 L42 10 Q50 6 58 10 L95 45 L85 45 L85 85 Q85 95 75 95 L60 95 L60 70 L40 70 L40 95 L25 95 Q15 95 15 85 L15 45",
                        "",
                        ""
                    ];
                    break;
                case "cale":
                    $pathArray = [
                        "M10 60 L90 60 L90 65 L10 65 Z M27 10 A1 1 0 1 1 38 10 L38 20 A1 1 0 1 1 27 20 Z M73 10 A1 1 0 1 0 62 10 L62 20 A1 1 0 1 0 73 20",
                        "M15 20 L25 20 A1 1 0 1 0 40 20 L60 20 A1 1 0 1 0 75 20 L85 20 Q95 20 95 30 L95 85 Q95 95 85 95 L15 95 Q5 95 5 85 L5 30 Q5 20 15 20 L15 85 L85 85 L85 40 L15 40",
                        "M35 30 L35 90 L40 90 L40 30 Z M65 30 L65 90 L60 90 L60 30"
                    ];
                    break;
                case "dashboard":
                    $pathArray = [
                        "M5 15 Q5 5 15 5 L32 5 Q42 5 42 15 L42 32 Q42 42 32 42 L15 42 Q5 42 5 32 L5 15 L15 15 L15 32 L32 32 L32 15 Z M48 15 Q48 5 58 5 L85 5 Q95 5 95 15 L95 32 Q95 42 85 42 L58 42 Q48 42 48 32 L48 15 L58 15 L58 32 L85 32 L85 15",
                        "M5 58 Q5 48 15 48 L42 48 Q52 48 52 58 L52 85 Q52 95 42 95 L15 95 Q5 95 5 85 L5 58 L15 58 L15 85 L42 85 L42 58",
                        "M58 58 Q58 48 68 48 L85 48 Q95 48 95 58 L95 85 Q95 95 85 95 L68 95 Q58 95 58 85 L58 58 L68 58 L68 85 L85 85 L85 58"
                    ];
                    break;
                case "send":
                    $pathArray = [
                        "M5 15 Q5 5 30 15 L85 40 Q110 50 85 60 L30 85 Q5 95 5 85 L10 55 L75 50 L10 45",
                        "",
                        ""
                    ];
                    break;
                case "trash":
                    $pathArray = [
                        "M15 30 A1 1 0 1 1 15 15 L35 15 Q40 5 50 5 Q60 5 65 15 L85 15 A1 1 0 1 1 85 30 L85 85 Q85 95 75 95 L25 95 Q15 95 15 85 L15 30 L25 30 L25 80 Q25 85 35 85 L65 85 Q75 85 75 80 L75 30 Z",
                        "M35 45 A1 1 0 1 1 45 45 L45 70 A1 1 0 1 1 35 70",
                        "M65 45 A1 1 0 1 0 55 45 L55 70 A1 1 0 1 0 65 70"
                    ];
                    break;
                case "edit":
                    $pathArray = [
                        "M15 5 L50 5 A1 1 0 1 1 50 15 L20 15 Q15 15 15 20 L15 80 Q15 85 25 85 L80 85 Q85 85 85 80 L85 45 A1 1 0 1 1 95 45 L95 85 Q95 95 85 95 L15 95 Q5 95 5 85 L5 15 Q5 5 15 5",
                        "M65 15 A1 1 0 1 1 85 35 L45 75 L25 75 25 55",
                        ""
                    ];
                    break;
                case "atEmail":
                    $pathArray = [
                        "M30 50 A1 1 0 1 1 70 50 A1 1 0 1 1 30 50",
                        "M70 50 L70 65 A1 1 0 1 0 90 65 L90 50 A1 1 0 1 0 10 50 Q12 88 50 90 Q55 90 65 88",
                        ""
                    ];
                    break;
                case "left":
                case "top":
                case "right":
                case "bottom":
                    $pathArray = [
                        "M65 10 L25 50 L65 90",
                        "",
                        ""
                    ];
                    break;
                case "info":
                    $pathArray = [
                        "M5 50 A1 1 0 1 1 95 50 A1 1 0 1 1 5 50 L15 50 A1 1 0 1 0 85 50 A1 1 0 1 0 15 50",
                        "M50 25 A1 1 0 1 1 50 35 A1 1 0 1 1 50 25",
                        "M45 45 A1 1 0 1 1 55 45 L55 70 A1 1 0 1 1 45 70"
                    ];
                    break;
                case "logout":
                    $pathArray = [
                        "M10 5 L45 5 Q50 5 50 10 L50 30 A1 1 0 1 1 40 30 L40 20 Q40 15 35 15 L20 15 Q15 15 15 20 L15 80 Q15 85 20 85 L35 85 Q40 85 40 80 L40 70 A1 1 0 1 1 50 70 L50 90 Q50 95 45 95 L10 95 Q5 95 5 90 L5 10 Q5 5 10 5",
                        "M30 50 L70 50",
                        "M80 70 L90 50 L80 30"
                    ];
                    break;
                case "download":
                    $pathArray = [
                        "M5 65 A1 1 0 1 1 15 65 L15 80 Q15 85 20 85 L80 85 Q85 85 85 80 L85 65 A1 1 0 1 1 95 65 L95 90 Q95 95 90 95 L10 95 Q5 95 5 90",
                        "M50 75 L75 65 L75 55 L55 62 L55 10 A1 1 0 1 0 45 10 L45 62 L25 55 L25 65",
                        ""
                    ];
                    break;
                case "add":
                case "minus":
                case "times":
                    $pathArray = [
                        "M10 50 L90 50",
                        "M50 10 L50 90",
                        ""
                    ];
                    break;
                case "smallAdd":
                case "smallMinus":
                case "smallTimes":
                    $pathArray = [
                        "M25 50 L75 50",
                        "M50 25 L50 75",
                        ""
                    ];
                    break;
                case "roundAdd":
                case "roundMinus":
                case "roundTimes":
                    $pathArray = [
                        "M25 50 L75 50",
                        "M50 25 L50 75",
                        "M5 50 A1 1 0 1 1 95 50 A1 1 0 1 1 5 50"
                    ];
                    break;
                case "search":
                    $pathArray = [
                        "M10 45 A1 1 0 1 1 80 50 A1 1 0 1 1 10 45",
                        "M90 90 L75 75",
                        ""
                    ];
                    break;
                case "location":
                    $pathArray = [
                        "M13 46 A1 1 0 1 1 87 46 Q80 80 50 95 Q20 80 13 46 L23 46 Q29 75 50 83 Q71 75 77 46 A1 1 0 1 0 23 46",
                        "M50 30 A1 1 0 1 1 50 60 A1 1 0 1 1 50 30",
                        ""
                    ];
                    break;
                case "setting":
                    $pathArray = [
                        "M25 50 A1 1 0 1 1 75 50 A1 1 0 1 1 25 50 L35 50 A1 1 0 1 0 65 50 A1 1 0 1 0 35 50",
                        "M45 30 L45 15 A1 1 0 1 1 55 15 L55 30 Z M70 45 L85 45 A1 1 0 1 1 85 55 L70 55 Z M45 70 L45 85 A1 1 0 1 0 55 85 L55 70 Z M30 45 L15 45 A1 1 0 1 0 15 55 L30 55",
                        "M45 30 L45 15 A1 1 0 1 1 55 15 L55 30 Z M70 45 L85 45 A1 1 0 1 1 85 55 L70 55 Z M45 70 L45 85 A1 1 0 1 0 55 85 L55 70 Z M30 45 L15 45 A1 1 0 1 0 15 55 L30 55"
                    ];
                    break;
                case "stats":
                    $pathArray = [
                        "M5 15 A1 1 0 1 1 15 15 L15 75 Q15 85 25 85 L85 85 A1 1 0 1 1 85 95 L15 95 Q5 95 5 85",
                        "M25 70 L25 50 A1 1 0 1 1 35 50 L35 70 A1 1 0 1 1 25 70 Z M45 70 L45 30 A1 1 0 1 1 55 30 L55 70 A1 1 0 1 1 45 70 Z M65 70 L65 40 A1 1 0 1 1 75 40 L75 70 A1 1 0 1 1 65 70",
                        ""
                    ];
                    break;
                case "chart":
                    $pathArray = [
                        "M5 15 A1 1 0 1 1 15 15 L15 75 Q15 85 25 85 L85 85 A1 1 0 1 1 85 95 L15 95 Q5 95 5 85",
                        "M25 40 L45 25 L60 35 L80 18",
                        "M35 70 L35 50 A1 1 0 1 1 45 50 L45 70 A1 1 0 1 1 35 70 Z M55 70 L55 60 A1 1 0 1 1 65 60 L65 70 A1 1 0 1 1 55 70 Z M75 70 L75 40 A1 1 0 1 1 85 40 L85 70 A1 1 0 1 1 75 70"
                    ];
                    break;
                case "user":
                    $pathArray = [
                        "M50 10 A1 1 0 1 1 50 40 A1 1 0 1 1 50 10",
                        "M15 90 A1 1 0 1 1 85 90",
                        ""
                    ];
                    break;
                case "twoUsers":
                    $pathArray = [
                        "M30 25 A1 1 0 1 1 30 50 A1 1 0 1 1 30 25 Z M70 10 A1 1 0 1 1 70 35 A1 1 0 1 1 70 10",
                        "M10 85 A1 1 0 1 1 50 85",
                        "M55 60 Q60 52 70 50 Q90 49 95 70"
                    ];
                    break;
            
                case "threeUsers":
                    $pathArray = [
                        "M50 40 A1 1 0 1 1 50 50 A1 1 0 1 1 50 40 Z M32 83 A1 1 0 1 1 68 83",
                        "M25 20 A1 1 0 1 1 25 30 A1 1 0 1 1 25 20 Z M10 60 Q15 45 30 45",
                        "M75 20 A1 1 0 1 1 75 30 A1 1 0 1 1 75 20 Z M90 60 Q85 45 70 45"
                    ];
                    break;
            
                case "exclamation":
                    $pathArray = [
                        "M10 50 A1 1 0 1 1 90 50 A1 1 0 1 1 10 50",
                        "M50 30 L50 60",
                        "M50 72 L50 72"
                    ];
                    break;
            
                case "question":
                    $pathArray = [
                        "M10 50 A1 1 0 1 1 90 50 A1 1 0 1 1 10 50",
                        "M30 50 Q30 30 50 30 Q70 30 70 45 Q50 49 50 59",
                        "M50 72 L50 72"
                    ];
                    break;
            
                case "globe":
                    $pathArray = [
                        "M10 50 A1 1 0 1 1 90 50 A1 1 0 1 1 10 50",
                        "M50 10 Q20 50 50 90 Q80 50 50 10",
                        "M10 50 L90 50"
                    ];
                    break;
            
                case "eye":
                    $pathArray = [
                        "M10 50 Q50 0 90 50 Q50 100 10 50",
                        "M35 50 A1 1 0 1 1 65 50 A1 1 0 1 1 35 50",
                        ""
                    ];
                    break;
            
                case "comment":
                    $pathArray = [
                        "M10 50 Q10 10 50 10 Q90 10 90 50 L90 90 L50 90 Q10 90 10 50",
                        "M30 40 L50 40",
                        "M30 60 L70 60"
                    ];
                    break;
            
                case "altComment":
                    $pathArray = [
                        "M10 60 L10 25 Q10 10 25 10 L75 10 Q90 10 90 25 L90 60 Q90 75 70 75 L50 90 L30 75 Q10 75 10 60",
                        "M30 33 L50 33",
                        "M30 55 L70 55"
                    ];
                    break;
            
                case "play":
                    $pathArray = [
                        "M20 80 L20 20 L85 50 L20 80",
                        "M35 20 L35 80",
                        "M65 20 L65 80"
                    ];
                    break;
            
                case "pause":
                    $pathArray = [
                        "M20 80 L20 20 L85 50 L20 80",
                        "M35 20 L35 80",
                        "M65 20 L65 80"
                    ];
                    break;
            
                case "retry":
                    $pathArray = [
                        "M80 50 A1 1 0 1 1 20 50 Q21 21 50 20 Q55 20 60 22",
                        "M60 20 L45 35 L70 30 L67 5",
                        ""
                    ];
                    break;
            
                case "telephone":
                    $pathArray = [
                        "M10 50 Q10 10 40 10 Q50 25 40 40 Q30 35 30 50 Q30 65 40 60 Q50 75 40 90 Q10 90 10 50",
                        "M60 40 Q75 50 60 60",
                        "M75 25 Q100 50 75 75"
                    ];
                    break;

            }
            return $pathArray;
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WHAT ICON ~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GET ICON ECHO ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        function get_icon_only($type = "default"){
            $pathAry = $this->what_icon($type);
            echo'<div class="icnOnly_'.$type.'" style="'.$this->pcol.'">';
            echo "<svg style='--HW: {$this->size}px;' viewBox='0 0 100 100'>
                <path d='".$pathAry[0]."'/>
                <path d='".$pathAry[1]."'/>
                <path d='".$pathAry[2]."'/>
            </svg>";
            echo'</div>';
        }
        function get_icon_btn($type = "default"){
            $this->iconStart("icn_".$type, $type);
            $pathAry = $this->what_icon($type);
            echo "<svg style='--HW: {$this->size}px;' viewBox='0 0 100 100'>
                <path d='".$pathAry[0]."'/>
                <path d='".$pathAry[1]."'/>
                <path d='".$pathAry[2]."'/>
            </svg>";
            $this->iconEnd();
        }
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GET ICON ECHO ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    }
    // -----------------------------------------------------  ICON AND BUTTONS ----------------------------------------------------- 
?>
