<?php

namespace Test;

use Test\AbstractTestCase;

abstract class AbstractMailTestCase extends AbstractTestCase
{
    public static function setUpBeforeClass()
    {
        self::rrmdir(__DIR__ . '/views');
        mkdir(__DIR__ . '/views');
    }

    public static function tearDownAfterClass()
    {
        self::rrmdir(__DIR__ . '/views');
    }

    public static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        self::rrmdir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Copied from https://github.com/orchestral/testbench
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        config(['app' => [
            'key' => 'SomeRandomStringWith32Characters',
            'cipher' => 'AES-256-CBC'
        ]]);
        config(['mail' => require __DIR__ . '/config/mail.php']);
        config(['view' => require __DIR__ . '/config/view.php']);
    }

    public function getPackageProviders($app)
    {
        $array = parent::getPackageProviders($app);
        return $array + [
            \Illuminate\Mail\MailServiceProvider::class,
        ];
    }

}