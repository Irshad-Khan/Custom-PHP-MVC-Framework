<?php

/**
 * App Core Class
 * Create URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core{

    /**
     * It indicate that if user not pass any controler name in URL then 
     * Default controller is Page
     */
    protected $currentController = "Pages";

    /**
     * It indicate that if user not pass any controler method name in URL then 
     * Default controller method name is index
     */
    protected $currentMethod = "index";

    /**
     * Params sending from URL
     */
    protected $parames = [];


    public function __construct()
    {
        $url = $this->getUrl();
        /**
         * It first check if controller exist as our rule at first parameter of url
         * is controller name
         */
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){

            /**
             * Assign controller name that override Pages controller
             */
            $this->currentController = ucwords($url[0]);
            
            /**
             * Remove index 0 and its value
             */
            unset($url[0]);
        }

        /**
         * It include requested controlelr
         */
        require_once '../app/controllers/'.$this->currentController.'.php';

        $this->currentController = new $this->currentController;

        /**
         * Override Method name
         */
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        /**
         * Set New parameter value
         */
        $this->params = $url ? array_values($url) : [];

        /**
         * Call Controller Method and pass parameter
         */
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        
    }

    /**
     * In this function in if we check url keyword in URL exist or not
     * If exist we should remov / from url mean When user enter URL
     * It look like domain/post/edit/1 here we get /post/edit/1
     * so rteim method is use to remove / from start mean from /post it become post/edit/1
     * filter_var make this in uurl form
     * explode make array of string
     * @return void
     */
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
    }
}