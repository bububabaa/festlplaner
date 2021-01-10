<!DOCTYPE html>
<html>
<head>
<script>
function link1() {
document.cookie="link=1";
}
function link2() {
document.cookie="link=2";
}
function link3() {
document.cookie="link=3";
}
function alertCookie() {
  alert(document.cookie);
}
</script>
</head>
<body>
    <a href="page2.html" onclick="link1()">1 dd</a><!--This would be link 1-->
    <a href="page2.html" onclick="link2()">2</a><!--This would be link 2-->
    <a href="page2.html" onclick="link3()">3</a><!--This would be link 3-->
    <button onclick="alertCookie()">Show cookies</button>
</body>
</html>
