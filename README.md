#注意：
##主机（物理\虚拟）环境配置
####该项目一直在Apache5.4环境下测试，其他环境暂且未知妥否。
####该项目暂时不需要数据库。
####为了让FilestableModel.class.php中的scandir()函数成功获取当前目录下的所有目录名而动态生成数组，务必确保在主机（物理\虚拟）的apache配置中Index开启（+Index）。
####如果需要用当前主机域名显示更目录以外目录，请确保主机（物理\虚拟）的apache配置中FollowSymLinks开启（+FollowSymLinks）。
eg：
<pre><code><Directory /your/root/path/>
    Options +Indexes +FollowSymLinks
    #Directory-Indexes-enabled, I have test it.
    AllowOverride None 
    Order Deny,Allow
    Allow from all
</Directory></code></pre>
##其他配置
####如果在A和B目录，你希望通过此项目方式在web上显示目录列表，请确保A和B目录下都有和项目目录下一样(或类似)的index.html文件。
####在很多配置环境下，只要不是在网站根目录，并且开启了FollowSymLinks开启了（+FollowSymLinks）,不需要该项目也可显示目录详情,该项目方便定制。


#文件角色扮演：
##index.html
####index.html文件是设计为被请求的前端页面，后续会做一些样式，也可能会加一js的动态效果。
####index.html定义了$APP_PATH（项目目录）和$abs_current_dir(动态获取的当前请求的目录绝对路径)。
####index.html中嵌入php代码语句require了IndexController.class.php。

####IndexController.class.php
####IndexController.class.php是模仿Thinkphp名的名，但是目前没有按照thinkphp的控制器内容来写，还有待后续摸索。
####IndexController.class.php的主要作用是生成$url_current_dir(供用户点击跳转的地址),经测试可知（无意中发现）这个的变量可以不是RUL，只需要是网站更目录下的相对目录(当前目录是更目录或者外部符号连接就不输出字符串)就行了，换句话说，如果不作其他输出的话，这个文件只有一句话就就能完成任务了：

<pre><code>//当前目录是更目录或者外部符号连接就不输出字符串
$url_current_dir = substr($abs_current_dir, length($_SERVER['SERVER_NAME']));</code></pre>

######考虑到兼容性方面的可能情况，放弃对IndexController.class.php作这样的简化。
####IndexController.class.php中require了FilestableModel.class.php。

####ListModle.class.php
####FilestableModel.class.php是模仿Thinkphp名的名，但是目前没有按照thinkphp的控制器内容来写，还有待后续摸索。
####ListModle.class.php目前主要是动态输出了$abs_current_dir的所有目录名，并将其嵌入<a>标签对中，将<a>标签的href属性定义为$url_current_dir。
####"在FilestableModel.class中用is_link()函数判断该文件或目录是否符号连接，如是则是用lstate()函数，else用stat()函数获取该文件或目录的详细信息数组，同时为$link_yes_string变量赋值，并在table中嵌入td标签显示。"

##非源码(测试)文件。
####file是个测试文件，普通文本，内容是'hello',点击file文件就会到显示hello的页面。
####file.7z是个测试文件，把file压缩生成的.7z文件，点击file.7z浏览器就会下载该文件。
####test.png是个测试文件，.png格式的图片目前发现的除了test.png之外，啥名字都不能显示，应该是apache的配置上的问题。后续会解决。
