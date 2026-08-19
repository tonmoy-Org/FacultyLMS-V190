import paramiko
import os

host = '145.223.22.69'
username = 'root'
password = r"Ti13xphE'5ZU&7Vx"
app_dir = '/var/www/profreelancersacademy.com'
local_file = r'e:\PHP SaaS\FacultyLMS-V190\app\Models\User.php'
remote_file = f'{app_dir}/app/Models/User.php'

try:
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(host, username=username, password=password)

    sftp = client.open_sftp()
    sftp.put(local_file, remote_file)
    sftp.close()
    print("User.php successfully uploaded to VPS!")

    client.close()
except Exception as e:
    print(f"Error: {e}")
