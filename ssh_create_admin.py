import paramiko

host = '145.223.22.69'
username = 'root'
password = r"Ti13xphE'5ZU&7Vx"
app_dir = '/var/www/profreelancersacademy.com'

try:
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(host, username=username, password=password)

    command = f"cd {app_dir} && php artisan tinker --execute=\"\$user = new App\\Models\\User(); \$user->first_name = 'Demo'; \$user->last_name = 'Admin'; \$user->email = 'admin@demo.com'; \$user->phone = '01700000000'; \$user->phone_country_id = 19; \$user->password = bcrypt('123456'); \$user->role_id = 1; \$user->user_type = 'admin'; \$user->status = 1; \$user->email_verified_at = now(); \$user->save(); echo 'Admin created';\""
    
    print(f"Running command on VPS: {command}")
    stdin, stdout, stderr = client.exec_command(command)
    print("STDOUT:", stdout.read().decode())
    print("STDERR:", stderr.read().decode())

    client.close()
except Exception as e:
    print(f"Error: {e}")
