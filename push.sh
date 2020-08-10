#!/usr/bin/env bash

msg=$1

echo '>>> 添加所有文件'
git add .
echo '>>> 写入备注'
git commit -m "${msg}"
echo '>>> 开始PUSH'
git push
echo '>>> PUSH成功'