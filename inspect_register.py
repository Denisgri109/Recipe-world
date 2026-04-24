import re
import requests

url = "https://recipe-world-roman.vercel.app/register"
r = requests.get(url, timeout=30)
print("status", r.status_code)
print(r.text[:1500])
print("token_pattern_1", bool(re.search(r'name="_token"\s+value="[^"]+"', r.text)))
print("token_pattern_2", bool(re.search(r'name=\'_token\'\s+value=\'[^\']+\'', r.text)))
print("meta_csrf", bool(re.search(r'<meta[^>]+name="csrf-token"[^>]+content="[^"]+"', r.text)))
