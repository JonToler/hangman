<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/hangman.php';

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    session_start();
    if (empty($_SESSION['game'])) {
      $_SESSION['words'] = array('test');
      $_SESSION['game'] = new Hangman('test');
    }

    $app->get('/', function() use ($app) {
        return $app['twig']->render('display.twig.html', array('game' => $_SESSION['game']));
    });

    $app->post('/guess_letter', function() use ($app){
        $game = $_SESSION['game'];
        $letter = $_POST['letter'];
        $game->guessLetter($letter);

        return $app->redirect('/');
    });

    $app->get('/reset', function() use ($app) {
        $_SESSION['game'] = new Hangman('test');
        return $app->redirect('/');
    });

    return $app;
?>
