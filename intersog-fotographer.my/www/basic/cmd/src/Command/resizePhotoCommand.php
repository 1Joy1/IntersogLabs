<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Command\ImageResizer;

/**
* resizePhotoCommand
*/
class resizePhotoCommand extends Command
{
    /**
     * Configuration of command
     */
    protected function configure()
    {
        $this
            ->setName("resize:photo")
            ->setDescription("Command resize:photo")
            ->addArgument(
                'jsonFile',
                InputArgument::REQUIRED,
                'Json file with configurations'
            );
    }

    /**
     * Execute method of command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(array("","<info>Execute</info>",""));
        
    //Get configurations file
    //
    //        "serverName":"",
    //        "db":"",
    //        "userName":"",
    //        "password":"",
    //        "size":[],
    //        "imageDir":""
    //        "prefixPathFromDB":""
    //
        $jsonConfigFile = $input->getArgument('jsonFile');

        if (!file_exists($jsonConfigFile)) {
            $output->writeln('Error: Json file does not exists');

            return true;
        }

        $jsonConfigFileContent = file_get_contents($jsonConfigFile);

        $config = json_decode($jsonConfigFileContent, true);
        
        if (!is_array($config)) {
            $output->writeln('Error: Json file does not seams valid');

            return true;
        }

        
        $imageResizer = new ImageResizer($config);
        $imageResizer -> init();
    }
}