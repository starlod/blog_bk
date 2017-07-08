Vagrant.configure("2") do |config|
  config.vm.box = "starlod/blog"
  config.vm.hostname = "blog.dev"

  # ネットワーク設定
  config.vm.network :private_network, ip: "192.168.33.10"
  # config.vm.network :public_network, ip: "192.168.0.120", bridge: "en0: Ethernet" # 他の人と被らないIPにすること

  # 共有フォルダ
  config.vm.synced_folder ".", "/vagrant", disabled: true

  # 共有フォルダ(インストール時はapacheユーザーがいないので無効化する)
  config.vm.synced_folder ".", "/home/vagrant/laravel", create: true, owner: 'apache', group: 'apache', mount_options: ['dmode=777', 'fmode=775'], nfs: false

  # プロビジョン
  if ARGV.include? '--provision-with'
    # オプションが明示的に指定されたときのみ実行する
    config.vm.provision "install", type: :shell, :path => "shell/install.sh", run: "never"
    config.vm.provision "bootstrap", type: :shell, :path => "shell/bootstrap.sh", run: "never"
    config.vm.provision "update", type: :shell, :path => "shell/update.sh", run: "never"
  end
  config.vm.provision "provision", type: :shell, :path => "shell/provision.sh", run: "always"

  # VirtualBox設定
  config.vm.provider :virtualbox do |vb|
    vb.cpus = 1
    vb.memory = 1024
    vb.linked_clone = true
  end

  # タイムアウト時間設定(default: 300 seconds)
  config.vm.boot_timeout = 100

  # プラグイン設定
  if Vagrant.has_plugin?("vagrant-vbguest") then
   config.vbguest.auto_update = true
  end
end
