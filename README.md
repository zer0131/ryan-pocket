# ryan-pocket

## 项目简介
这是一个接入[Pocket](https://getpocket.com)测试程序, 该程序基于[OneFox](https://github.com/zer0131/OneFox)框架。

## OneFox简介
**OneFox**是小弟开发的一个轻量级的PHP框架, 详情见: [https://github.com/zer0131/OneFox](https://github.com/zer0131/OneFox)

## 部署说明

### nginx配置示例
```
server {
    listen  80;
    server_name  www.appryan.com appryan.com;
    index index.php index.html index.html;
    root /home/project/app/public;
    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    location ~ .*\.(php|php5)?$ {
        fastcgi_pass  127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi.conf;
    }
    #图片缓存时间设置
    location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$ {
        #expires 30d;
    }
    #JS和CSS缓存时间设置
    location ~ .*\.(js|css)?$ {
        #expires 1h;
    }
    access_log  /usr/local/nginx/logs/OneFox.log;
}
```

### 邮件提醒脚本部署(基于Linux)

#### 1、计划任务
使用**crontab**配置计划任务, 每天10点发送邮件提醒, 配置如下:
```
* 10 * * * /your-php-path/php /your-project-path/app/daemon/notice.php
```

#### 2、邮件配置
邮件服务配置在app/config/config.php文件中, 需要自行设置

#### 3、依赖数据库配置
数据库配置在app/config/database.php文件中

### 前端部署
前端页面使用**React**开发, 源文件在**websrc**目录下

#### 1、安装依赖库
```
cd websrc
npm install
```

#### 2、开发运行
```
npm run dev
```

#### 3、编译
```
npm run build
```

**注意: 发布的代码已经编译过, 可直接使用**

