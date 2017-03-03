<?php

namespace Core\Services\View;

use Core\Services\Config\ConfigFacade;

class View {

    protected $templatesExtension;
    protected $twigLoader;
    protected $twigEnvironment;

    /**
     * View constructor.
     *
     * @param string $templatesPath
     * @param string $templatesExtension
     * @param array $engineOptions
     */
    public function __construct(string $templatesPath, string $templatesExtension, array $engineOptions) {
        $this->templatesExtension = $templatesExtension;

        $this->twigLoader = $this->initTwigLoader($templatesPath);
        $this->twigEnvironment = $this->initTwigEnvironment($this->twigLoader, $engineOptions);
    }

    /**
     * Render template.
     *
     * @param string $templateFile
     * @param array $data
     * @return string
     */
    public function make(string $templateFile, array $data) {
        return $this->twigEnvironment->render($templateFile . $this->templatesExtension, $data);
    }

    /**
     * Init Twig Loader.
     *
     * @param string $templatesPath
     * @return \Twig_Loader_Filesystem
     */
    private function initTwigLoader(string $templatesPath) {
        return new \Twig_Loader_Filesystem($templatesPath);
    }

    /**
     * Init Twig Environment.
     *
     * @param \Twig_Loader_Filesystem $twigLoader
     * @param array $settings
     * @return \Twig_Environment
     */
    private function initTwigEnvironment(\Twig_Loader_Filesystem $twigLoader, array $settings) {

        // Init Twig Environment
        $twigEnvironment = new \Twig_Environment($twigLoader, $settings);

        // Extend Twig - add functions
        $twigEnvironment->addFunction(new \Twig_Function('public', function (string $file) {
            return ConfigFacade::get('appConfig', 'url') . '/' . $file;
        }));

        return $twigEnvironment;
    }
}
