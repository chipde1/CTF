## 🐞	주요 취약점
- SQL Injection
- XSS(Stored)
- XOR의 속성을 이용한 취약점
- sudoedit의 권한상승(CSV-2021-3156)

# index.php
![image](https://github.com/user-attachments/assets/bbecfdd9-a778-4818-a175-6c23c1d8b482)
- XSS(Stored)에 의해서 404가 띄워짐
![image](https://github.com/user-attachments/assets/871bbfc0-7b2c-448c-bfd4-ecd33137163a)
- 원래의 index.php 화면이 보여지고
- XOR 속성을 이용하여 계산하는 문제

# add.php
![image](https://github.com/user-attachments/assets/d7fa3495-1b2e-4080-a6d6-00f040a9ce9e)
- <input type="hidden">을 통해 MySQL 쿼리 입력 폼을 숨김

![image](https://github.com/user-attachments/assets/9354ada2-81d0-4ab5-a60e-49aee20411f4)
- SQL Injection 공격
# list.php
![image](https://github.com/user-attachments/assets/f7d046e7-3b59-4ff6-ba24-1963120dc257)
- XSS 구문이 보이고 내용을 삭제하면 원래의 index.php가 보여짐
- M1, M2, M3, M4에 대한 내용이 적혀있음
# sudoedit의 권한상승(CSV-2021-3156)
- ServerID: cr0sss1tescr1pt9
- password: df93ef64167b2334664ff59a5b8185f5
![image](https://github.com/user-attachments/assets/39ca3bb8-c25f-497d-a4c8-40d73acf13e7)
- Heap buffer overflow 취약점
# XOR 계산
![image](https://github.com/user-attachments/assets/2c6c3a65-b3fe-46d3-b3a2-21387045ab0a)
