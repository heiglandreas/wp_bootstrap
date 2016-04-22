<?php
/**
 * Copyright (c) 2015-2015} Andreas Heigl<andreas@heigl.org>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2015-2015 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     03.12.2015
 * @link      http://github.com/heiglandreas/wpcomposertest
 */

namespace Org_Heigl\Wordpress\Bootstrap;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Installer
{
    public static function postCreateProject(Event $event)
    {
        $configfile =__DIR__ . '/../wp-config.php';
        if (file_exists($configfile)) {
            return true;
        }
        $config = $event->getComposer()->getConfig();
        $io = $event->getIO();
        if (! $io) {
            return;
        }

        $values = [
            'DB_COLLATE' => 'utf8_bin',
            'DB_CHARSET' => 'utf8',
            'DB_HOST' => '',
            'DB_USER' => '',
            'DB_PASSWORD' => '',
            'DB_NAME' => '',
            'PORT' => '8080'
        ];

        $values['DB_HOST'] = $io->askAndValidate(
            "Please provide the FQDN for the database-server (localhost): ",
            function($value){
                if (! filter_var($value, FILTER_SANITIZE_STRING)) {
                    throw new \UnexpectedValueException('Not an URL');
                }

                return $value;
            },
            5,
            'localhost'
            );
            // ok, continue on to composer install

        $values['DB_NAME'] = $io->askAndValidate(
            "Please provide the name of the database for wordpress (wordpress): ",
            function($value){
                if (! filter_var($value, FILTER_SANITIZE_STRING)) {
                    throw new \UnexpectedValueException('Invalid');
                }

                return $value;
            },
            5,
            'wordpress'
        );

        $values['DB_USER'] = $io->askAndValidate(
            "Please provide a username with access to the database (wpuser): ",
            function($value){
                if (! filter_var($value, FILTER_SANITIZE_STRING)) {
                    throw new \UnexpectedValueException('Invalid');
                }

                return $value;
            },
            5,
            'wpuser'
        );

        $values['DB_PASSWORD'] = $io->askAndHideAnswer(
            "Please provide the password for this user (wppass): "
        );

        if (! $values['DB_PASSWORD']) {
            $values['DB_PASSWORD'] == 'wppass';
        }

        $values['PORT'] = $io->askAndValidate(
            "Please provide a port to the webserver if you do not want to use the default (8080): ",
            function($value){
                if (! filter_var($value, FILTER_SANITIZE_NUMBER_INT)) {
                    throw new \UnexpectedValueException('Invalid');
                }

                return $value;
            },
            5,
            8080
        );

        $dist = file_get_contents($configfile . '.dist');
        $dist = str_replace(
            array_map(function($item){
                return '%' . $item . '%';
            },array_keys($values)),
            array_values($values),
            $dist
        );
        $fh = fopen($configfile, 'w+');
        fwrite($fh, $dist);
        fclose($fh);

        $vagrant = file_get_contents(__DIR__ . '/../Vagrantfile.dist');
        $vagrant = str_replace(
            array_map(function($item){
                return '%' . $item . '%';
            },array_keys($values)),
            array_values($values),
            $vagrant
        );
        $fh = fopen(__DIR__ . '/../Vagrantfile', 'w+');
        fwrite($fh, $vagrant);
        fclose($fh);

        $io->write('Starting virtual machine');
        exec("vagrant up", $output, $returnVal);

        if (0 == $returnVal) {
            $io->write(sprintf(
                'You can now open the URL <success>http://127.0.0.1:%s</success> in your favourite WebBrowser',
                $values['PORT']
            ));
        } else {
            $io->write(implode("\n", $output));
        }

        return true;

    }

}