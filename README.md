> 站在巨人的肩膀上，并不是高的表现，反而使自己变得渺小~只有吸收了巨人的营养，茁壮自己才是真正的高大！ --笔者


# LaravelAPI



## 前端页面
前后端完全分离的项目，前端采用Vue构建，如需要可视化配置的请移步：[ApiAdmin-WEB](https://gitee.com/apiadmin/ApiAdmin-WEB)

## 快速安装

> 第一步：安装代码

```
先获取基础代码 git clone https://github.com/clowniii/laravel-api-admin  再使用composer安装 composer install
```

> 第二步：执行数据库迁移

```
 php artisan migrate
```

> 第三步：获取管理后台账号密码

```
cat install/lock.ini
```

## 愿 景

> 希望有人用它，希望更多的人用它。
> 希望它能帮助到你，希望它能帮助到更多的你。

## 项目简介

**系统需求**

- PHP >= 8.0
- MySQL >= 5.7
- Redis

**项目构成**

- laravel v9.0.*
- Vue 2.*
- ...

**功能简介**

1. 接口文档自动生成
2. 接口输入参数自动检查
3. 接口输出参数数据类型自动规整
4. 灵活的参数规则设定
5. 支持三方Api无缝融合
6. 本地二次开发友好
7. ...

 ```
 ApiAdmin（PHP部分）
 ├─ 系统维护
 |  ├─ 菜单管理 - 编辑访客权限，处理菜单父子关系，被权限系统依赖（极为重要）
 |  ├─ 用户管理 - 添加新用户，封号，删号以及给账号分配权限组
 |  ├─ 权限管理 - 权限组管理，给权限组添加权限，将用户提出权限组
 |  └─ 操作日志 - 记录管理员的操作，用于追责，回溯和备案
 |  ...
 ```

**页面截图**

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095358_19cb42d0_110856.png "api.png")

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095410_55dc23e1_110856.png "app.png")

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095420_bddff990_110856.png "auth1.png")

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095427_fa86e42d_110856.png "auth2.png")

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095436_3600de17_110856.png "lock.png")

![输入图片说明](https://gitee.com/uploads/images/2018/0224/095444_d2a88da0_110856.png "user.png")

**项目特性**

- 开放源码
- 保持生机
- 不断更新
- 响应市场

**开源，我们在路上！**

