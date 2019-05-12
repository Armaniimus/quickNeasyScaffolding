<?php
/**
 *
 */
class Router {
    private $packets;
    private $filteredPackets;

    public function __construct ($rootUrl = "/") {
        // set urlOffset
        $this->rootUrl = count(explode("/", $rootUrl));

        // getPayload
        $url = $_SERVER['REQUEST_URI'];
        $this->packets = explode("/", $url);
        $this->filteredPackets = array_slice($this->packets, $this->rootUrl);

        echo '<br>';
        echo $this->rootUrl;
        echo '<br>';

        var_dump($this->packets);
        echo '<br>';

        var_dump($this->filteredPackets);
        echo '<br>';
    }

    /**
     * this method is used to kick off the start of the router and handle the errormessages
     * @return string/bool a string is returned or false is returned if there was an error
     */
    public function run() {
        //if no errors encountered return results
        if ($result = $this->determineDestination()) {
            return $result;
        }
    }

    /**
     * this method is used to get the destination information from the filtered packets and properties
     * and set it into the class then call the errorchecking Method.
     * if everything is oke then send it to the sendToDestination method.
     * @return string/bool if there was no error return the content from the controller
     */
    private function determineDestination() {
        $filteredPackets  = $this->filteredPackets;
        $this->controller = array_shift($filteredPackets);
        $this->method     = array_shift($filteredPackets);
        $this->params     = $filteredPackets;

        return $this->sendToDestination();
    }

    /**
     * this method is used to send the request to a the controller given in the parameter
     * and send the given info to it
     * @return string a return to be given back to index.php
     */
    private function sendToDestination() {
        $ctrlName   = $this->controller . '_Controller';
        $ctrlPath   = "Controller/$ctrlName.php";
        $method     = $this->method;
        $params     = $this->params;

        // checks if params are defined and choose run mode based on that
        if (isset($ctrlName)) {

            if (file_exists ($ctrlPath) ) {
                require_once "$ctrlPath";
                $controller = new $ctrlName();

                if (isset($params[0])) {
                    if ($params[0]) {
                        return $controller->$method($params);
                    }
                }

                if (isset($method)) {
                    if (!method_exists($this->controller, $method) ) {
                        return $controller->$method();
                    }
                }
            }

        } else {
            return false;
        }
    }
}

?>
