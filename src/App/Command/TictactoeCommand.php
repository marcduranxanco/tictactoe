<?php
namespace App\Command;

use App\Controller\TictactoeAppController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TictactoeCommand extends Command{
    protected function configure(){
        $this->setName('tictactoe');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $Tictactoe = new TictactoeAppController;

        try {
            $output->writeln(sprintf($Tictactoe->run()));
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $output->writeln(sprintf($th->getMessage()));
            return Command::FAILURE;
        } 
    }
}