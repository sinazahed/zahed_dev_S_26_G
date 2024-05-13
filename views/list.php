<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping_list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/blue/pace-theme-minimal.min.css" integrity="sha512-4chYZ6A4vvq/i1Aihe1dEkNNLEjy0zuZqTL65CncfJoKxxMPDwrEpD9jB9kJY+Fa35sA8YbAowsdFGHNf5re+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        <?php include('assets/style.css') ?>
    </style> <!--  internal css -->

<body>
    <?php include('search.php') ?>
    <?php include('alerts.php') ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="" style="margin-top: -10px;"><i style="color: #75b798; font-size: 37px; margin-left: 20px; margin-right: 20px;" class="bi bi-cart-plus-fill"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="https://shopping.sinazahed.bio/Api-Collection-Shopping-List.json" target="_blank">Download Api</a>
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">About</a>
                    <a class="nav-link" href="https://github.com/sinazahed/zahed_dev_S_26_G" target="_blank">Github</a>
                </div>
            </div>
            <i id="darkModeButton" style="margin-right:30px;cursor:pointer" class="bi bi-brightness-high"></i></a>
            <i style="margin-right:30px;cursor:pointer" onclick="showSearch()" class="bi bi-search"></i>
            <?php if (isset($_SESSION['name'])) : ?>
                <p>Welcome, <?php echo $_SESSION['name']; ?></p>
            <?php else : ?>
                <button id="LoginRegister" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-login">
                    Login or Register
                </button>
            <?php endif; ?>

            <?php include('modal/login.php') ?>
        </div>
    </nav>
    <?php include('about.php') ?>
    <br>
    <div class="container" style="border-radius: 20px">
        <div class="row" style="border-radius: 20px">
            <form method="post" action="<?php echo siteUrl('list/add') ?>" class="row g-3">
                <div class="col-lg-5">
                    <input type="text" name="title" class="form-control" placeholder="Add new product to shopping list">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Add new</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">checked</th>
                        <th scope="col">Setting</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists as $list) { ?>
                        <tr>
                            <td><?php echo $list->id ?></td>
                            <td><?php echo $list->title ?></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $list->id ?>" <?php if ($list->checked == 1) echo "checked" ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $list->checked == 0 ? "mark as checked" : "checked"; ?></label>
                                </div>
                            </td>
                            <td>
                                <a href='<?php echo siteUrl("list/delete/$list->id") ?>' class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Delete
                                </a>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $list->id ?>" type="button" class="btn btn-warning" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Edit item
                                </button>
                                <?php include('modal/modal.php') ?>
                            </td>

                        </tr>
                    <?php } ?>


                </tbody>
            </table>
            <ul>

            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadDoc(id, checked) {
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", '<?php echo siteUrl('list/toggle') ?>');
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                const checkedValue = checked ? 1 : 0;
                xhttp.send("id=" + id + "&checked=" + checkedValue);
            }
            // Select all checkboxes
            const checkboxes = document.querySelectorAll('.form-check-input');
            // Attach change event listener to each checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    const id = this.id;
                    // Call the loadDoc function with checkbox id and checked status
                    loadDoc(id, isChecked);
                    const label = this.nextElementSibling; // Get the next sibling element (label)
                    if (isChecked) {
                        label.textContent = "checked"; // Update label text to "checked" if checkbox is checked
                    } else {
                        label.textContent = "mark as checked"; // Update label text to "mark as checked" if checkbox is unchecked
                    }
                });
            });
        });

        // Get the element by class name
        var element = document.querySelector('.alert');
        // Hide the alerts after 3 seconds
        setTimeout(function() {
            element.style.display = 'none';
        }, 1500); // 3000 milliseconds = 3 seconds


        // Dark mode

        const darkModeButton = document.getElementById('darkModeButton');
        const body = document.body;

        darkModeButton.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            if (darkModeButton.classList.contains('bi-brightness-high')) {
                darkModeButton.classList.remove('bi-brightness-high');
                darkModeButton.classList.add('bi-moon');
            } else {
                darkModeButton.classList.remove('bi-moon');
                darkModeButton.classList.add('bi-brightness-high');
            }
        });

        //Live search

        function showResult(str) {
            var searchText = document.getElementById('livesearch').value;

            // Check if the input value is empty
            if (searchText.trim() === '') {
                document.getElementById("searchResult").innerHTML = ""; // Clear the search result
                return;
            }
            if (str.length == 0) {
                document.getElementById("livesearch").innerHTML = "";
                document.getElementById("livesearch").style.border = "0px";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var results = JSON.parse(this.responseText);
                    // Generate HTML for the search results
                    var html = '';
                    results.forEach(function(item) {
                        html += '<div>';
                        html += '<p>' + item.title + '</p>';
                        html += '<hr>';
                        html += '</div>';
                    });
                    // Display the HTML in the livesearch div
                    document.getElementById("searchResult").innerHTML = html;
                }
            }
            // Make an AJAX request to your PHP endpoint
            xmlhttp.open("GET", "<?php echo siteUrl('search/item/') ?>" + str, true);
            xmlhttp.send();
        }

        function hideSearch() {
            var searchDiv = document.getElementById('search');
            searchDiv.style.display = 'none';
        }

        function showSearch() {
            var searchDiv = document.getElementById('search');
            searchDiv.style.display = 'block';
        }
    </script>
</body>

</html>