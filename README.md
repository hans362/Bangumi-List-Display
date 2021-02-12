# 追番列表展示API

# 本项目已经归档，不再维护，请移步作者基于前端 + Serverless Function 实现的新项目 https://github.com/hans362/Bilibili-Bangumi-JS

For English version, please ...

Sorry, we are currently unable to provide an English version of this file. Maybe sometime in the future we will :-)

![PHP](https://img.shields.io/badge/PHP-5.4.0+-blue.svg) ![License](https://img.shields.io/badge/License-GPL--3.0-brightgreen.svg)

一个快速、轻巧的基于PHP的追番列表展示工具。（目前仅支持 BiliBili ）

## 这是什么？

> 追番列表展示页面API 是  [@Hans362](https://blog.hans362.cn/)  的~~呕心沥血~~之作，其灵感来源于 @ohmyga233 的博客中的“追番”页面，利用BiliBili官方的API实现展示个人追番列表的目的。感谢 @ohmyga233 提供的灵感以及前端页面。

由于作者是条咸鱼并且这是第一次写 PHP 项目，代码中难免有些不妥之处或存在 BUG ，请见谅。如果各位大佬有能力和时间精力的话欢迎开个 Issue 帮助我一起完善这个代码，或者提交个 PR 。

另外本程序中涉及到的前端代码来源于 @ohmyga233 的博客主题，但是迫于 @ohmyga233 的博客主题指向的 GitHub 链接已经失效， @ohmyga233 本人的 GitHub 页面上也不存在该主题，故无法确认前端部分的代码的作者，决定直接拿来使用。如有不妥之处实在抱歉，请尽快与我取得联系，我将删除这部分代码。

### 所以....说了半天这到底是个啥？

> 想在博客或个人主页上展示自己的追番列表？每追一个番剧都要手动更新一次列表？......（编不下去了...）

有了追番列表展示API，以上问题都不存在了。

只需要一个 BiliBili 用户 UID ，一切全帮你搞定。

内置缓存系统，首次获取可能速度略慢，但是之后相关资源会缓存在你的服务器上，增快加载速度。

语言好像只能描述这么多了（嗯....我相信各位的理解能力~）那就上图吧~

![PREVIEW](https://github.com/hans362/Bangumi-List-Display/raw/master/preview.png)

DEMO：http://test.hans362.cn/get_bangumi_list.php?uid=66745436

## 如何部署？

既然是PHP程序，一套 PHP+Web Server 的运行环境肯定是要有的啦~（废话

### 环境要求

- 一台带有 Apache 或 Nginx 或 IIS 或其他 Web 引擎的主机
- PHP 版本≥ 5.4.0
- PHP 的 JSON 扩展

### 部署教程

1. 检查你的主机是否符合运行追番列表展示API的要求

2. 在Release中下载最新版本的追番列表展示API

3. 将所有文件放置在你在 Web 引擎中设置的站点目录（虚拟主机用户是上传至站点根目录）

4. 访问 ``http://your-domain.com/get_bangumi_list.php?uid=66745436`` 检查是否有报错

   是不是很简单呢~（其中66745436请换成你自己的 BiliBili UID ，如何获取请见下文）

### 如何使用？

- 在任何HTML页面中均可调用此API，但是目前我能想到的方法只有嵌套iframe，该方法丑且过时，因此不推荐（如果有更好的方法请务必告诉我）

  ```
  <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" src="http://your-domain.com/get_bangumi_list.php?uid=66745436"></iframe>
  ```

  （其中66745436请换成你自己的 BiliBili UID ，如何获取请见下文）

- 对于各大博客系统，如 WordPress，Typecho，Hexo 等我会封装成相应插件便于使用，但是目前暂时没有时间和精力，请见谅

### 获取 BiliBili UID 方法

电脑端访问你本人的 BiliBili 空间，在地址栏中可以看到类似于``https://space.bilibili.com/66745436``的链接，其中``66745436``即为你本人的BiliBili UID 。

手机或移动端可以在 BiliBili APP 中点开个人空间应该就会显示用户 UID 。

## **To-Do-List**

- [ ] 增加对除 BiliBili 以外其他追番平台的支持
- [ ] 为各大博客程序封装成插件
- [ ] 增加运行效率，优化代码质量

## **版权**

追番列表展示API 是基于 GNU General Public License v3.0 开放源代码的自由软件，你可以遵照 GPLv3 协议来二次开发并发布这一程序。

程序原作者为 [@Hans362](https://blog.hans362.cn/)，转载请注明。
