Vagrant.configure("2") do |config|
  config.vm.define "servidor" do |subconfig|
    	subconfig.vm.box = "debian/bullseye64"
        subconfig.vm.hostname = "servidor"
        subconfig.vm.network :private_network, ip: "192.168.1.10", virtualbox__intnet: "IAWlan"
		subconfig.vm.network "forwarded_port", guest: 80, host: 80
	subconfig.vm.network :public_network, type: "dhcp"

		subconfig.vm.provider :virtualbox do |vb|
			vb.name = "servidor"
			vb.gui = false
		end
		subconfig.vm.provision "shell", inline: <<-SHELL
			apt update && apt install -y docker.io docker-compose samba
			
			mkdir -p /vagrant/developers
			
			echo "[developers]
				path = /vagrant/developers
				writeable = yes
				browseable = yes
			" >> /etc/samba/smb.conf
			useradd developers 
			(echo developers; echo developers ) | smbpasswd -s -a developers
			chown -R developers:developers /vagrant/developers
			chmod 755 /vagrant/developers
			
			cp /vagrant/conf/docker-compose.yml $PWD

			docker-compose up -d
			
			
			apt install -y iptables
			echo "net.ipv4.ip_forward=1" >> /etc/sysctl.conf
			sysctl -p	

			
			apt install -y bind9
			cp /vagrant/conf/bind/db.abel.org /etc/bind/
			cat /vagrant/conf/bind/local.zones >> /etc/bind/named.conf.local
			cat /vagrant/conf/bind/named.conf.options > /etc/bind/named.conf.options
			systemctl restart named


			apt install -y isc-dhcp-server
			
			cp /vagrant/conf/dhcp/dhcpd.conf /etc/dhcp/dhcpd.conf
			cp /vagrant/conf/dhcp/isc-dhcp-server /etc/default/isc-dhcp-server
			
			systemctl restart isc-dhcp-server

		SHELL
		subconfig.vm.provision "shell", run: "always", inline: "iptables -t nat -A POSTROUTING -s 192.168.1.0/24 -o eth2 -j MASQUERADE"
		subconfig.vm.provision "shell", run: "always", inline: "echo 'nameserver 192.168.1.10' > /etc/resolv.conf"
		subconfig.vm.provision "shell", run: "always", inline: "echo 'nameserver 8.8.8.8' >> /etc/resolv.conf"
		
	end
end

