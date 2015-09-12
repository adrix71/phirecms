<?php

namespace Phire\Model;

use Phire\Table;
use Pop\Http\Client\Curl;
use Pop\Web\Server;

class Config extends AbstractModel
{

    /**
     * Create a new config model object
     *
     * @param array $data
     * @return Config
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $server = new Server();
        $config = Table\Config::getConfig();
        $distro = $server->getDistro();

        $this->data['overview'] = [
            'version'          => \Phire\Module::VERSION,
            'domain'           => $config['domain'],
            'document_root'    => $config['document_root'],
            'base_path'        => (BASE_PATH == '') ? '&nbsp;' : BASE_PATH,
            'application_path' => (APP_PATH == '') ? '&nbsp;' : APP_PATH,
            'content_path'     => CONTENT_PATH,
            'modules_path'     => MODULES_PATH,
            'operating_system' => $server->getOs() . (!empty($distro) ? ' (' . $distro . ')' : null),
            'software'         => $server->getServer() . ' ' . $server->getServerVersion(),
            'database_version' => Table\Config::db()->version(),
            'php_version'      => $server->getPhp(),
            'installed_on'     => (($config['installed_on'] != '0000-00-00 00:00:00') ?
                date($config['datetime_format'], strtotime($config['installed_on'])) : ''),
            'updated_on'       => (($config['updated_on'] != '0000-00-00 00:00:00') ?
                date($config['datetime_format'], strtotime($config['updated_on'])) : '')
        ];

        $config['datetime_formats'] = [
            'M j Y', 'F d, Y', 'm/d/Y', 'Y/m/d', 'F d, Y g:i A',
            'M j Y g:i A', 'm/d/Y g:i A', 'Y/m/d g:i A'
        ];

        $this->data['config']  = $config;
        $this->data['modules'] = Table\Modules::findAll(['order' => 'id DESC', 'limit' => 5])->rows();
    }

    /**
     * Get configuration data
     *
     * @return \ArrayObject
     */
    public function getAll()
    {
        return new \ArrayObject(Table\Config::getConfig(), \ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Get configuration data by id
     *
     * @param  string $id
     * @return mixed
     */
    public function getById($id)
    {
        return Table\Config::findById($id)->value;
    }

    /**
     * Save the config data
     *
     * @param  array $post
     * @return void
     */
    public function save(array $post)
    {
        $config = Table\Config::findById('domain');
        if (isset($_SERVER['HTTP_HOST']) && ($config->value != $_SERVER['HTTP_HOST'])) {
            $config->value = $_SERVER['HTTP_HOST'];
            $config->save();
        }

        $config = Table\Config::findById('document_root');
        if (isset($_SERVER['DOCUMENT_ROOT']) && ($config->value != $_SERVER['DOCUMENT_ROOT'])) {
            $config->value = $_SERVER['DOCUMENT_ROOT'];
            $config->save();
        }

        $config = Table\Config::findById('datetime_format');
        $config->value = (!empty($post['datetime_format'])) ? $post['datetime_format'] : $post['datetime_format_custom'];
        $config->save();

        $config = Table\Config::findById('pagination');
        $config->value = (int)$post['pagination'];
        $config->save();
    }

    /**
     * Get update info
     *
     * @param  \Pop\Web\Session $sess
     * @return string
     */
    public function getUpdates($sess)
    {
        if (!isset($sess->updates)) {
            $updates = [
                'phire'   => null,
                'modules' => []
            ];
            $curl    = new Curl('https://api.github.com/repos/phirecms/phirecms/releases/latest', [
                CURLOPT_HTTPHEADER => [
                    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT']
                ]
            ]);
            $curl->send();

            if ($curl->getCode() == 200) {
                $json = json_decode($curl->getBody(), true);
                $updates['phire'] = $json['tag_name'];
            }

            $modules = Table\Modules::findAll();
            if ($modules->hasRows()) {
                foreach ($modules->rows() as $module) {
                    $curl    = new Curl('https://api.github.com/repos/phirecms/' . $module->folder . '/releases/latest', [
                        CURLOPT_HTTPHEADER => [
                            'User-Agent: ' . $_SERVER['HTTP_USER_AGENT']
                        ]
                    ]);
                    $curl->send();

                    if ($curl->getCode() == 200) {
                        $json = json_decode($curl->getBody(), true);
                        $updates['modules'][$module->folder] = $json['tag_name'];
                    }
                }
            }

            $sess->updates = new \ArrayObject($updates, \ArrayObject::ARRAY_AS_PROPS);
        }
    }

}