Vagrant.configure("2") do |config|
  config.vm.define "ubuntu_VM1" do |ubuntu_VM1|
    ubuntu_VM1.vm.box = "ubuntu/bionic64"
    ubuntu_VM1.vm.network "private_network", ip:"192.168.56.101"
    ubuntu_VM1.vm.provider "virtualbox" do |vb|
      vb.memory = "1024"
      vb.cpus = 1
    end
    ubuntu_VM1.vm.provision :shell, path: "install_lamp.sh"
  end

  config.vm.define "ubuntu_VM2" do |ubuntu_VM2|
    ubuntu_VM2.vm.box = "ubuntu/bionic64"
    ubuntu_VM2.vm.network "private_network", ip:"192.168.56.102"
    ubuntu_VM2.vm.provider "virtualbox" do |vb|
      vb.memory = "1024"
      vb.cpus = 1
    end
    ubuntu_VM2.vm.provision :shell, path: "install_lamp.sh"
  end
  
end