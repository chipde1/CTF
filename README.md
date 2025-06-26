# 🐞	주요 취약점
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
XOR 변환기 http://kor.pe.kr/util/4/xor_convert.htm

/list.php 에서 얻은 M1,M2,M3,M4 값과 /H10000.txt 에서 얻은 $H_{10000}$ 값으로 XOR 연산

이 과정은 총 2가지로 풀 수 있다.

1번 방법: 

192.168.56.143/index.php에서 다음과 같은 식을 제공하였다. 이때 P=Password다. 

$M_{1}=userID ⨁ K ⨁ H_{9999}$

$M_{2}=serverID ⨁ K ⨁ H_{9999}$

$M_{3}=H_{10000} ⨁ P$

$M_{4}=H_{9999} ⨁ P$

$P=H_{10000}⨁M_{3}$를 통해 $Password$=df93ef64167b2334664ff59a5b8185f5값을 구하면 $M_{4}$를 통해 $H_{9999}$를 구할 수 있다. $H_{9999}=M_{4}⨁P$ 이후 $M_{1}$을 이용하여 $K$를 구할 수 있다. 이때 $userID$는 위의 SQL Injection으로 찾아낸 $userID$ 중 하나씩 다 대입하면 $userID$=Ocean777Timewarp를 넣어서 계산하다보면 그럴듯한 $K$=secretpassword12값이 나온다. 그 다음 $M_{2}$에서 $serverID=M_{2}⨁H_{9999}$를 구할 수 있다. $serverID$=cr0sss1tescr1pt9 이제 서버의 ID와 Password를 전부 찾았다.

2번 방법: 

$M_{1}=userID ⨁ K ⨁ H_{9999}$

$M_{2}=serverID ⨁ K ⨁ H_{9999}$

$M_{3}=H_{10000} ⨁ P$

$M_{4}=H_{9999} ⨁ P$

$P=H_{10000}⨁M_{3}$를 통해 $Password$=df93ef64167b2334664ff59a5b8185f5를 구한 후 $M_{1}⨁M_{2}=userID⨁serverID$가 나오고 SQL Injection으로 찾아낸 $userID$를 하나씩 대입하면 $serverID$= cr0sss1tescr1pt9가 나온다. 이렇게 하면 굳이 $H_{9999}$값과 $K$값을 구하지 않아도 $serverID$값을 구할 수 있다.
