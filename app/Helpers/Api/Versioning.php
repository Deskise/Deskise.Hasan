<?php


    namespace App\Helpers\Api;


    class Versioning
    {
        public static function getVersion($version, &$prefix=Null, &$namespace=Null, $defaultApiNamespace='App\Http\Controllers\Api')
        {
            if ($version[0] === 'v')
            {
                $version = ltrim($version,'v');
            }

            $version = explode('.',$version);
            $prefix = 'api/v'.$version[0];

            for ($i=1;$i<3;$i++)
            {
                if (!isset($version[$i]))
                {
                    $version[$i] = 0;
                }else {
                    $prefix.='.'.$version[$i];
                }
            }
            $version = 'v'.implode('.',$version);

            $namespace = "{$defaultApiNamespace}\\".str_replace('.','_',strtoupper($version));
            return strtolower($version);
        }

        public static function getAllowedVersions()
        {
            $versions = [];
            foreach (explode(',', env('API_ALLOWED_VERSIONS')) as $ver)
            {
                $versions[] = self::getVersion($ver);
            }

            return $versions;
        }
    }
