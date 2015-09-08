该框架功能比较少，比较适合用于个人小型网站。
该框架的目录结构如下：

```
/command	//该目录用于存放cli模式下的command类
/controller	//该目录用于存放cgi模式下的controller类
/frame	//该目录用于存放框架的核心代码
	BlakeFez.php //这是框架的核心文件
	Command.php //command的基类，所有的command类都要继承该类
	CommonMysql.php //实现的一个mysql类
	CommonRequest.php //实现的一个获取url请求类，最好使用
				//CommonRequest::getRequest('option')来代替
				//$_GET['option']和$_POST['option']
	Controller.php //controller类的基类，所有的controller类都要
				//继承该类
	Model.php //model类的基类，所有的model都要继承该类
/model	//该目录用于存放model类
/service //该目录用于存放公用的service类
/static	//该目录用于存放js、css、图片等
/view //该目录用于存放前端模板文件
```

该框架支持CGI和CLI两种模式。

在CGI模式下，使用方法如下：
①、路由方式
比方有这样一个url：http://host/index.php?c=index&a=welcome
则实际会请求/controller目录下IndexController类的welcome方法。

②、前端渲染
在controller里面，使用：

```
$this->out['title'] = 'welcome to china';
```
则会把变量title输出到前端。在前端模板文件中，可以这样使用该变量：

```
<title><?php echo $title;?></title>
```
前端文件的命名方式是这样的：
比如IndexController类的welcome方法对应的前端文件是：
/view/index/welcome.php

如果是异步请求的，不需要前端渲染，可以在controller中这样写：

```
$this->outType = 'json';
```

在CGI模式下，使用方法如下：
php SRC_PATH/index.php -c index -a index
这行命名将会执行command目录下IndexCommand类的index方法。
