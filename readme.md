### LMBlog
一个URL中转统计程序

### 环境要求
`PHP >= 7.0.0`

### 安装

执行
```
git clone git@github.com:lanmeng-org/LMBall.git
cd LMBall
composer install
```

编辑 `.env` 配置数据库等相关信息

执行 `./artisan migrate` 迁移数据库信息

### 默认信息
*默认后台地址*  
`/admin`

*默认账号*  
`admin`

*默认密码*  
`lanmeng.org`

### 后台地址修改方法
修改 `.env` 文件中的 `SITE_ADMIN_PATH=admin` , 把 `admin` 改为你需要的路径.