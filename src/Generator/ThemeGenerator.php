<?php

/**
 * @file
 * Contains \WP\Console\Generator\ThemeGenerator.
 */

namespace WP\Console\Generator;

use WP\Console\Core\Generator\Generator;
use WP\Console\Utils\Site;

/**
 * Class ThemeGenerator
 *
 * @package WP\Console\Generator
 */
class ThemeGenerator extends Generator
{
    /**
     * @param Site           $site
     * @param $Theme
     * @param $machineName
     * @param $dir
     * @param $description
     * @param $author
     * @param $authorUrl
     * @param $template_files
     * @param screenshot
     * @param $test
     */
    public function generate(
        $site,
        $theme,
        $machineName,
        $dir,
        $description,
        $author,
        $authorUrl,
        $template_files,
        $screenshot,
        $package,
        $test
    ) {
        if (file_exists($dir)) {
            if (!is_dir($dir)) {
                throw new \RuntimeException(
                    sprintf(
                        'Unable to generate the theme as the target directory "%s" exists but is a file.',
                        realpath($dir)
                    )
                );
            }
            $files = scandir($dir);
            if ($files != ['.', '..']) {
                throw new \RuntimeException(
                    sprintf(
                        'Unable to generate the module as the target directory "%s" is not empty.',
                        realpath($dir)
                    )
                );
            }
            if (!is_writable($dir)) {
                throw new \RuntimeException(
                    sprintf(
                        'Unable to generate the module as the target directory "%s" is not writable.',
                        realpath($dir)
                    )
                );
            }
        }
        
        $parameters = [
            'theme' => $theme,
            'theme_uri' => '',
            'machine_name' => $machineName,
            'type' => 'module',
            'version' => $site->getBlogInfo('version'),
            'description' => $description,
            'author' => $author,
            'author_uri' => $authorUrl,
            'package' => $package,
            'test' => $test
        ];
        
        foreach ($template_files as $template) {
            $this->renderFile(
                'theme/template.php.twig',
                $dir.'/'.$template.'.php',
                ['template' => $template, 'theme' => $theme, 'package' => $package]
            );
        }
        
        $this->renderFile(
            'theme/style.css.twig',
            $dir.'/style.css',
            $parameters
        );
    
        $this->renderFile(
            'theme/index.php.twig',
            $dir.'/index.php',
            $parameters
        );
        
        if (file_exists($screenshot)) {
            $file = explode(".", $screenshot);
            copy($screenshot, $dir.'/screenshot.'.end($file));
        }
    }
}
