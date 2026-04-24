import re,time,random,requests
s=requests.Session()
base='https://recipe-world-roman.vercel.app'
r=s.get(base+'/register',timeout=30)
t=re.search(r'name="_token"\s+value="([^"]+)"',r.text).group(1)
email=f"probe_{int(time.time())}@example.com"
p={'_token':t,'name':'probe','email':email,'password':'Password123!','password_confirmation':'Password123!'}
r2=s.post(base+'/register',data=p,allow_redirects=True,timeout=30)
print('status',r2.status_code)
print(r2.url)
print(r2.text[:1800])
