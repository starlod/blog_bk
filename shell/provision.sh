#! /bin/sh -x

# CentOS7ではnetwork.serviceをrestartしないと、private_networkで指定したIPがアタッチされないため。
systemctl restart network
# 共有フォルダをドキュメントルートすると、vagrant up時マウントされてなくてコケるため、Apacheを再起動させる。
systemctl restart httpd
