## 声明
本仓库代码，是学习练习使用。学习的教程是慕课网[《玩转数据结构
                         更适合0算法基础入门到进阶》](https://coding.imooc.com/class/chapter/207.html#Anchor)

用php 把课程中java代码 写了一遍。

## 环境

php 7.4 

## 杂谈

array 是关键字不能做类名。用了arrays

php 不加类型限定，就可以理解为泛型。

php的数组没有长度限制。故使用SplFixedArray。

php对象不支持compareTo操作。可以自己建立一个interface去实现。compareTo方法放到了Utils类中了。