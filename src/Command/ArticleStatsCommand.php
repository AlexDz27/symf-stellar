<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Returns some article stats')
            ->addArgument('slug', InputArgument::REQUIRED, 'The article\'s slug')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'The output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $mockArticleStats = [
          'slug' => $slug,
          'likes' => rand(0, 100)
        ];

        switch ($input->getOption('format')) {
          case 'text':
            $rows = [];
            foreach ($mockArticleStats as $key => $value) {
              $rows[] = [$key, $value];
            }
            $io->table(['Key', 'Value'], $rows);
            break;

          case 'json':
            $io->write(json_encode($mockArticleStats));
            break;

          default:
            throw new \Exception('Unknown format');
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
