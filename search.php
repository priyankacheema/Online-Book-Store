<?php
    include 'header.php';
    $pdo = new PDO("mysql:host=localhost:3306;dbname=cheapbooks","root","");
    //$pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=cheapbooks","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $resultset = array();
    $searchTerm = null;
    $query = null;
    
    if (isset($_POST['search'])) {
       searchBooks();
   }

     function searchBooks(){
      global $query;
             $filter=$_POST['filterradio'];
             if ($filter=="Onauthor") {
               $value=$_POST["SearchBook"];
               $query = "Select author.ssn, author.name, book.ISBN, book.price, book.title, Sum(stocks.number) as number from author, book, stocks, writtenby where author.ssn = writtenby.ssn && writtenby.ISBN = book.ISBN && book.ISBN = stocks.ISBN && author.name like '%" .$value. "%' && stocks.number > 0 GROUP BY book.ISBN";
             }
             else if ($filter=="Ontitle"){
                $value=$_POST["SearchBook"];
                $query = "Select book.ISBN, stocks.ISBN, book.title, Sum(stocks.number) as number, book.price, author.name from book, author, writtenby, stocks where book.ISBN = stocks.ISBN && book.ISBN=writtenby.ISBN && writtenby.ssn=author.ssn && title like '%" .$value. "%' && stocks.number > 0 GROUP BY book.ISBN";
              }
         }

    $statement = $pdo->prepare($query);
    $statement->execute();
    while($row = $statement->fetch()){  
    $resultset[] = $row;
    }
?>
  <h2 class="margin-left-30">Search Books</h2>
  <hr>
  <form id="search-form" class="margin-left-30" method ='post'>
    <input type="text" class="searchTextBox form-control" name="SearchBook">
  	<input type="radio" class="radioAuthor" value="Onauthor" name="filterradio"> Search by Author: <br>
    <input type="radio" class="radioTitle" value="Ontitle" name="filterradio"> Search by Title: <br><br>
    <button type="submit" name="search" class="btn btn-primary">Search</button>
  </form>



   <table id="searchResults" class="table table-responsive resultsTable">     
      <?php
      if(!empty($resultset)) {
                          echo "<tr>
                           <th><strong>ISBN No.</strong></th>
                           <th><strong>Book Title</strong></th>
                           <th><strong>Number of books</strong></th>
                           <th><strong>Quantity</strong></th>
                           <th></th>
                           </tr>";
                          }
         foreach ($resultset as $result) { 
          echo "<form>";
                   echo "<tr>
                   <td width='290px'>" . $result['ISBN'] . "</td>
                   <input name='ISBN' type='hidden' value= '".$result['ISBN']."'/>
                   <td width='290px'>" . $result['title'] . "</td>
                   <input name='title' type='hidden' value= '".$result['title']."'/>
                   <td width='290px'>" . $result['number'] . "</td>
                   <input name='number' type='hidden' value= '".$result['number']."'/>
                   <td><input type='text' name='quantity' id='".$result['ISBN']."'/></td>
                   <td><label> <input type='button' class='btn btn-primary addtocartBtn' name='Add' data-isbn='".$result['ISBN']."' data-number='".$result['number']."' data-title='".$result['title']."' data-price='".$result['price']."' data-authorname='".$result['name']."' value='Add to Cart' /></label></td>
                   </tr>";
                   echo "</form>";
                }
      ?>
  </table>
 
</body>
</html>