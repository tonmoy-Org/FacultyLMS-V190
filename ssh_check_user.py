import paramiko

host = '145.223.22.69'
username = 'root'
password = r"Ti13xphE'5ZU&7Vx"
app_dir = '/var/www/profreelancersacademy.com'

try:
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(host, username=username, password=password)

    command = f"cd {app_dir} && php artisan tinker --execute=\"\$user = App\\Models\\User::where('first_name', 'like', '%Tanvir%')->first(); echo json_encode(['phone' => \$user->phone, 'phone_country_id' => \$user->phone_country_id]);\""
    
    stdin, stdout, stderr = client.exec_command(command)
    print("STDOUT:", stdout.read().decode())
    print("STDERR:", stderr.read().decode())

    client.close()
except Exception as e:
    print(f"Error: {e}")
