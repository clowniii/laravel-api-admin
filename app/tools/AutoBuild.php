<?php
/**
 * 数据类型维护
 * 特别注意：这里的数据类型包含但不限于常规数据类型，可能会存在系统自己定义的数据类型
 */

namespace App\tools;

use App\Models\Admin\AdminMenu;

class AutoBuild
{
    private array $config = [
        'model'     => 0,  // 是否需要构建模型
        'control'   => 1,  // 是否需要构建控制器
        'menu'      => 1,  // 是否需要构建目录
        'route'     => 1,  // 是否需要构建路由
        'name'      => '', // 唯一标识
        'module'    => 1,  // 构建类型 1：admin；2：api
        'table'     => 0,  // 是否创建表
        'modelName' => '', // 表名称
        'fid'       => 0   // 父级ID
    ];

    /**
     * 自动构建
     * @param array $config
     */
    public function run(array $config = [])
    {
        $this->config = array_merge($this->config, $config);

        if ($this->config['model'] == 1) {
            $this->buildModel();

            if ($this->config['table'] == 1) {
                $this->createTable();
            }
        }
        if ($this->config['control'] && $this->config['name']) {
            $this->buildControl();

            if ($this->config['menu'] && $this->config['module'] == 1) {
                $this->buildMenu();
            }

            if ($this->config['route'] && $this->config['module'] == 1) {
                $this->buildRoute();
            }
        }
    }

    /**
     * 驼峰命名转下划线命名
     * @param $camelCaps
     * @param string $separator
     * @return string
     */
    private function unCamelize($camelCaps, string $separator = '_'): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }

    /**
     * 构建控制器
     */
    private function buildControl()
    {
        $tplPath = base_path() . 'install' . DIRECTORY_SEPARATOR;
        if ($this->config['module'] == 1) {
            $module = 'admin';
        } else {
            $module = 'api';
        }

        $controlStr = str_replace(
            ['{$MODULE}', '{$NAME}'],
            [$module, $this->config['name']],
            file_get_contents($tplPath . 'control.tpl')
        );
        file_put_contents(
            base_path() . 'controller' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $this->config['name'] . '.php',
            $controlStr
        );
    }

    /**
     * 构建模型
     * @author double
     */
    private function buildModel()
    {
        $modelStr = '<?php' . PHP_EOL;
        $modelStr .= '/**' . PHP_EOL;
        $modelStr .= ' * 由程序自动构建' . PHP_EOL;
        $modelStr .= ' * @author' . PHP_EOL;
        $modelStr .= ' */' . PHP_EOL;
        $modelStr .= 'namespace app\model;' . PHP_EOL;
        $modelStr .= 'class ' . $this->config['modelName'] . ' extends Base {' . PHP_EOL;
        $modelStr .= '}' . PHP_EOL;

        file_put_contents(
            base_path() . 'model' . DIRECTORY_SEPARATOR . $this->config['modelName'] . '.php',
            $modelStr
        );
    }

    /**
     * 构建表
     */
    private function createTable()
    {
        $tableName = $this->unCamelize($this->config['modelName']);
        $cmd       = "CREATE TABLE `{$tableName}` (`id` int NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`)) COMMENT='自动构建';";
        Db::execute($cmd);
    }

    /**
     * 构建菜单
     */
    private function buildMenu()
    {
        $menus = [
            [
                'title'      => '新增',
                'fid'        => $this->config['fid'],
                'url'        => "admin/{$this->config['name']}/add",
                'auth'       => 1,
                'sort'       => 0,
                'show'       => 1,
                'icon'       => '',
                'level'      => 3,
                'component'  => '',
                'router'     => '',
                'log'        => 1,
                'permission' => 1,
                'method'     => 2
            ],
            [
                'title'      => '编辑',
                'fid'        => $this->config['fid'],
                'url'        => "admin/{$this->config['name']}/edit",
                'auth'       => 1,
                'sort'       => 0,
                'show'       => 1,
                'icon'       => '',
                'level'      => 3,
                'component'  => '',
                'router'     => '',
                'log'        => 1,
                'permission' => 1,
                'method'     => 2
            ],
            [
                'title'      => '删除',
                'fid'        => $this->config['fid'],
                'url'        => "admin/{$this->config['name']}/del",
                'auth'       => 1,
                'sort'       => 0,
                'show'       => 1,
                'icon'       => '',
                'level'      => 3,
                'component'  => '',
                'router'     => '',
                'log'        => 1,
                'permission' => 1,
                'method'     => 1
            ],
            [
                'title'      => '列表',
                'fid'        => $this->config['fid'],
                'url'        => "admin/{$this->config['name']}/index",
                'auth'       => 1,
                'sort'       => 0,
                'show'       => 1,
                'icon'       => '',
                'level'      => 3,
                'component'  => '',
                'router'     => '',
                'log'        => 1,
                'permission' => 1,
                'method'     => 1
            ]
        ];
        (new AdminMenu())->insert($menus);
    }

    /**
     * 构建路由
     */
    private function buildRoute()
    {
        RouterTool::buildAdminRouter();
    }
}
