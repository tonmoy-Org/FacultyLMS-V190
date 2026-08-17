import paramiko
import sys

host = '145.223.22.69'
user = 'root'
password = r"Ti13xphE'5ZU&7Vx"

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())

try:
    client.connect(hostname=host, username=user, password=password, timeout=10)
    
    commands = [
        "cd /var/www/profreelancersacademy.com && git pull origin complete-responsive-for-mobile-device",
        "cd /var/www/profreelancersacademy.com && php artisan optimize:clear"
    ]
    
    for cmd in commands:
        print(f"Running: {cmd}")
        stdin, stdout, stderr = client.exec_command(cmd)
        print("STDOUT:", stdout.read().decode())
        print("STDERR:", stderr.read().decode())
        
except Exception as e:
    print(f"Error: {e}")
finally:
    client.close()
