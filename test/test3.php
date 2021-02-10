
<!DOCTYPE html>
<html lang="en">
<body><div class="wrap">
   <div class="search">
    <input placeholder="Suchen nach..." type="text" id="search" class="searchTerm">

    <input type="button" id="#searchbtn" value="Suchen" onclick="search(document.getElementById('search').value)" class="searchButton">
       </div>
</div>
    <p>Hallo</p>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <p>foo</p>
    <p>bar</p>
    <p>hello world</p>


    <script>
   /* function search(string){
        window.find(string);
    }*/
    </script>

    <p>----------------------------------------</p>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    <script>
        function search(string)
        {
            {
                window.find(string);
            }
        }

</script>
    <style>
  .search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}


    </style>
   </body>
</html>
