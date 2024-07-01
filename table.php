<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Record</title>
    <link rel="stylesheet" href="table.css">

</head>

<body>
    <h1>RECORD</h1>
<div id="con-addAndSearch">

<div class="dropdown">
    <button class="dropbtn">MENU</button>
    <div class="dropdown-content">
        <a href="contact_form.php">ADD</a>
        <a href="archive.php">VIEW ARCHIVE</a>
    </div>
</div>

<div id="wrapperForSearchFieldAndIcon">
    <div id="wrapperSearchIcon">
        <img src="images/search.svg" alt="magnifying glass">
    </div>

    <input class="nosubmit" id="searchField" name="searchField" type="search" placeholder="search here...">

    <select id="searchBy" name="searchBy">
        <option value="1" selected>Search by ID</option>
        <option value="2">By First name</option>
        <option value="3">By Last name</option>
        <option value="4">By Email</option>
    </select>

</div>

</div>

    <div id="parent">
        

        <div id="child">
            <table id="myTable">
                <thead>
                    <th>Action</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Gender</th>
                    <th>Topic</th>
                    <th>Message</th>
                </thead>
                <tbody>
                    <?php
                    require_once "connection.php";
                    $sql = mysqli_query($con, "select*from user order by userID desc");
                    $count = 1;
                    $row = mysqli_num_rows($sql);

                    if ($row > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                    ?>

                            <tr>
                                <td>
                                    <a href="update.php?editId=<?php echo htmlentities($row['userID']); ?>"><button class="button" id="editButton">UPDATE</button></a>
                                    <a href="table.php?deleteId=<?php echo htmlentities($row['userID']); ?>" onclick="return confirm('Are you sure you want to delete this record?')"><button class="button" id="deleteButton">DELETE</button></a>
                                </td>
                                <td><?php echo $row['userID']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['message']; ?></td>
                            </tr>
                    <?php
                            $count = $count + 1;
                        }
                    }

                    ?>

                </tbody>

            </table>
        </div>
    </div>
</body>
<!-- for search -->
<script>
    document.querySelector('#searchField').addEventListener('keyup', function() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;

        var searchBy = document.querySelector('#searchBy').value;

        input = document.getElementById("searchField");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[searchBy];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
                else tr[i].style.display = "none";
            }
        }
    })

    document.querySelector('#searchBy').addEventListener('keyup', function() {
        var searchBy = document.querySelector('#searchBy').value;
        var placeholderCon = document.querySelector('#searchField');
        if (searchBy == 2) placeholderCon.placeholder = 'search by First name';
        else if (searchBy == 3) placeholderCon.placeholder = 'search by Last name';
        else if (searchBy == 4) placeholderCon.placeholder = 'search by Email';
    })
</script>

</html>

<?php
require_once "connection.php";

if (isset($_GET['deleteId'])) {
    $ID = intval($_GET['deleteId']);

    $sql = mysqli_query($con, "select*from user where userID='$ID'");
    while ($row = mysqli_fetch_array($sql)) {
        $query = "INSERT INTO archive(firstname, lastname, email, subject, gender, topic, message)
        VALUES ('$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]')";
    }
    mysqli_query($con, $query);

    // dfgdsfgsdfgdsfg

    $sql = mysqli_query($con, "delete from user where userID='$ID' ");
    if ($sql) {
        echo "<script>window.alert('The record has been deleted successfully!');</script>";
        echo "<script>window.location = 'table.php';</script>";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
}
?>