import sys

file_path = r'C:\Users\sebas\OneDrive\Desktop\w-login-DLSL-CITE-Website\index.html'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Fix Activity 1
bad_activity = '<img src="assets/Aguirre.jpg" class="dev-img" alt="Aguirre">ek'
good_activity = '<img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"\n                    class="card-img" alt="CITE Week">'
content = content.replace(bad_activity, good_activity)

# Fix Aguirre
fb_link = 'https://scontent.fmnl7-1.fna.fbcdn.net/v/t39.30808-1/774105649_1450879763769459_7762879738473547173_n.jpg?stp=cp6_dst-jpg_tt6&cstp=mx1900x1900&ctp=s200x200&_nc_cat=107&ccb=1-7&_nc_sid=e99d92&_nc_ohc=mXSt43UQ3AUQ7kNvwFmoF5G&_nc_oc=AdrWX351KVUOXGqupWU4WpUXu_f5aoJsXfim38M8KuPpow1eQ_jFyyg5OFhODSmXI0s&_nc_zt=24&_nc_ht=scontent.fmnl7-1.fna&_nc_gid=ZMgtz1rQLjQwVocURyzU6Q&_nc_ss=7b2a8&oh=00_AQE2R3Vx8qYuq8BjK-2ewCo5cNYiJdv5CJmbrfTM9B9cAw&oe=6A8C7696'

old_aguirre = f'<img src="{fb_link}"\n                        class="dev-img" alt="Aguirre">'
new_aguirre = '<img src="assets/Aguirre.jpg" class="dev-img" alt="Aguirre">'

content = content.replace(old_aguirre, new_aguirre)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)
