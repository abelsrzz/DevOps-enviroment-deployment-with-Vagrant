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
			vb.cpus = 4
			vb.memory = 4096
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
	(1..2).each do |n|  
		config.vm.define "dev#{n}", autostart: false do |dev|
			dev.vm.box = "debian/bullseye64"
			dev.vm.hostname = "dev#{n}"
			dev.vm.network "private_network", type: "dhcp", virtualbox__intnet: "IAWlan"
		
			dev.vm.provider :virtualbox do |vb|
				vb.name = "dev#{n}"
				vb.cpus = 3
				vb.memory = 4096
				vb.gui = true
			end
			dev.vm.provision "shell", inline: <<-SHELL
				apt update && apt install -y expect xdotool tasksel cifs-utils psmisc wget apt-transport-https

				wget -qO- https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > packages.microsoft.gpg
				sudo install -D -o root -g root -m 644 packages.microsoft.gpg /etc/apt/keyrings/packages.microsoft.gpg
				sudo sh -c 'echo "deb [arch=amd64,arm64,armhf signed-by=/etc/apt/keyrings/packages.microsoft.gpg] https://packages.microsoft.com/repos/code stable main" > /etc/apt/sources.list.d/vscode.list'
				rm -f packages.microsoft.gpg

				apt update && apt install -y code

				mkdir /media/developers

				echo "//samba.abel.org/developers /media/developers cifs user=developers,pass=developers 0 0" >> /etc/fstab
				mount -av

				setxkbmap -layout es
				echo "Instalando entorno gráfico, este proceso puede tardar varios minutos..."
				tasksel install Debian desktop environment GNOME

				cp /vagrant/conf/startx/daemon.conf /etc/gdm3/daemon.conf
			SHELL
		end
	end
end
