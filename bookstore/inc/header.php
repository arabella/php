<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title><?= $pageTitle ?></title>
</head>
<body>
<div id="wrap"> 
  <div id="main"> 
  	<header class="fixed">
	  <div class="center">				
				<h1 class = "center">Bookstore</h1>	
        <nav>
          <ul>
            <li><a href = "index.php">Home</a></li>
          </ul>          
          <ul>
            <li><a href = "add_book.php">Add Book</a></li>
          </ul>
          <ul>
            <li><a href = "add_author.php">Add Author</a></li>
          <li>  
             <form name="search" method="post" action="search.php">
             Seach for: <input type="text" name="find" /> in 
             <Select NAME="field">
             <Option VALUE="book_title">Books</option>
             <Option VALUE="author_name">Authors</option>
             </Select>
             <input type="hidden" name="searching" value="yes" />
             <input type="submit" name="search" value="Search" />
             </form> 
             </li>             
          </ul>

        </nav>				
			<div class="clear"></div>				
        </div> 
	</header>
	<div id = "content">