<?php

/**
 * @file
 * Contains \DrupalProject\composer\ScriptPoS.
 */

namespace DrupalProject\composer;

use Composer\Script\Event;
use Composer\Semver\Comparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

class ScriptPoS {

  public static function renameLibrariesFolders(Event $event) {
    $fs = new Filesystem();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());
    $drupalRoot = $drupalFinder->getDrupalRoot();

    $dirs = [
      'JSON-js',
      'Pause',
    ];

    // Required for unit testing
    foreach ($dirs as $dir) {
      if ($fs->exists($drupalRoot . '/libraries/'. $dir)) {

      	$oldname = $drupalRoot . '/libraries/'. $dir;

      	if ($dir=='JSON-js') {
      		$newdir = 'json2';
      	}
      	else if ($dir=='Pause') {
      		$newdir = 'jquery.pause';	
      	}
      	$newname = $drupalRoot . '/libraries/'. $newdir;
      	
      	if ($fs->exists($newname)) {
      		system("rm -rf ".escapeshellarg($newname));

		}

		rename($oldname, $newname);
		
      }
    }


  }



}
