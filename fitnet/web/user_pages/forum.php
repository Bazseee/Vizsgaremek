<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Forum</title>
    <style>
        .topic {
            padding: 10px;
            border: 1px solid black;
            border-radius: 10px;
        }

        .userComment {
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h1 class="text-xl mb-3">Forum</h1>
    <h2 class="text-l mb-3">If you have any questions or don't understand something, you can feel free to ask on this
        page, even anonymously!</h2>
    <button onclick="toggleForm()"
        class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600">New
        topic</button>
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-md shadow-md" id="topicForm" style="display: none;">
        <h2 class="text-xl font-semibold mb-4">Create a new topic</h2>
        <form action="create_topic.php" method="POST">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" onclick="change_text()" value="anonymus" name="anonymus" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
                </div>
                <?php echo "<span id='anonim'  class='ms-3 text-sm font-medium text-gray-900 dark:text-gray-300'>" . $_SESSION['username'] . "</span>"; ?>
            </label>

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-1">Name:</label>
                <input type="text" id="title" name="title" required placeholder="Name of topic"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-1">Description:</label>
                <textarea id="description" name="description" rows="4" required placeholder="Description of topic"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"></textarea>
            </div>
            <button type="submit"
                class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Create</button>
        </form>
    </div>
    <section style='background-color: #f9f4f4; padding: 15px; border-radius: 10px; margin-top: 10px;'>

        <h2 style='font-size: 1.5rem;'>Topics:</h2>

        <script>
            var originalText = "";
            var newText = "anonymus";

            function toggleForm() {
                var form = document.getElementById("topicForm");
                if (form.style.display === "none") {
                    form.style.display = "block";
                } else {
                    form.style.display = "none";
                }
            }

            function change_text() {
                var anonim = document.getElementById("anonim");

                if (originalText === "") {
                    originalText = anonim.innerHTML;
                }

                anonim.innerHTML = (anonim.innerHTML === originalText) ? newText : originalText;
            }
        </script>

        <script>
            function toggleComments(topicId) {
                var commentsDiv = document.getElementById("comments_" + topicId);
                var commentForm = document.getElementById("comment_form_" + topicId);

                // Ellenőrizzük, hogy van-e már létrehozva egy űrlap a kommentek beküldéséhez
                if (!commentForm) {
                    // Ha nincs még létrehozva űrlap, akkor létrehozzuk
                    commentForm = document.createElement("form");
                    commentForm.id = "comment_form_" + topicId;
                    commentForm.innerHTML = "<textarea style='width: 60%; max-width: 60%;' id='comment_text_" + topicId + "' placeholder='Your comment' required></textarea><br>" +
                        "<button type='button' class='bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600' onclick='submitComment(" + topicId + ", \"\")'>Add Comment</button>";
                    // Az új kommenteket a form alá jelenítjük meg
                    commentsDiv.insertBefore(commentForm, commentsDiv.firstChild);
                }

                // Megváltoztatjuk az űrlap láthatóságát
                if (commentsDiv.style.display === "none") {
                    commentsDiv.style.display = "block";
                    // Ha a témára kattintottunk, akkor jelenítsük meg a teljes leírást
                    var description = document.getElementById("description_" + topicId);
                    description.innerHTML = description.dataset.fullDescription;
                } else {
                    commentsDiv.style.display = "none";
                    // Ha a témát bezártuk, akkor visszaállítjuk a rövid leírást
                    var description = document.getElementById("description_" + topicId);
                    description.innerHTML = description.dataset.shortDescription;
                }
            }

            function submitComment(topicId, username) {
                var commentText = document.getElementById("comment_text_" + topicId).value;
                // Ellenőrizzük, hogy a komment nem üres
                if (commentText.trim() === "") {
                    alert("Please enter a comment.");
                    return;
                }
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var noComments = document.getElementById("noComments");
                        noComments.innerHTML = "";
                        // Frissítjük az oldalon csak az adott topichoz tartozó kommenteket
                        var commentsDiv = document.getElementById("existing_comments_" + topicId);
                        commentsDiv.innerHTML = this.responseText + commentsDiv.innerHTML;
                        document.getElementById("comment_form_" + topicId).reset();
                    }
                };
                xmlhttp.open("POST", "add_comment.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("topic_id=" + topicId + "&username=" + username + "&comment=" + commentText);
            }


            function deleteComment(commentId) {
                var confirmDelete = confirm("Are you sure you want to delete this comment?");
                if (confirmDelete) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // Frissítjük az oldalt a komment törlése után
                            location.reload();
                        }
                    };
                    xmlhttp.open("GET", "delete_comment.php?comment_id=" + commentId, true);
                    xmlhttp.send();
                }
            }

            function deleteTopic(topicId) {
                var confirmDelete = confirm("Are you sure you want to delete this topic?");
                if (confirmDelete) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // Frissítjük az oldalt a témák törlése után
                            location.reload();
                        }
                    };
                    xmlhttp.open("GET", "delete_topic.php?topic_id=" + topicId, true);
                    xmlhttp.send();
                }
            }
        </script>

        <?php
        include ("db.php");
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
        }
            
        // Lekérdezés a topicokhoz
        $query = "SELECT * FROM topics ORDER BY created_at DESC";
        $result = mysqli_query($conn, $query);

        // Ellenőrizzük, hogy vannak-e topicok
        if (mysqli_num_rows($result) > 0) {
            // Topicok kilistázása
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $topicId = $row['id'];

                if ($user_id != 0) {
                    $user_query = "SELECT username FROM user WHERE id = $user_id";
                    $user_result = mysqli_query($conn, $user_query);
                    $user_row = mysqli_fetch_assoc($user_result);
                    $username = $user_row['username'];
                } else {
                    $username = 'anonymous';
                }

                echo "<div class='topic' style='margin-bottom: 10px; margin-top: 10px;'>";
                echo "<p style='float: right;'>" . $row['created_at'] . "</p>";
                echo "<a href='javascript:void(0);' onclick='toggleComments($topicId)' style='font-size: 1.25rem;'><strong>Topic name: </strong>" . $row['title'] . "</a>";
                if ($_SESSION['username'] == $username) {
                    // Ha igen, megjelenítjük a "Delete topic" gombot
                    echo "<button class='bg-red-600 text-white px-2 rounded-md hover:bg-white hover:text-red-600 mr-3' style='float: right;' onclick='deleteTopic($topicId)'>Delete topic</button>";
                }
                echo "<br><p style='float: right; font-size: 1rem;'><strong>Creator: </strong>" . $username . "</p>";
                // Elmentjük a teljes és rövid leírást adatként a datasetben, majd megjelenítjük a rövid leírást
                echo "<p id='description_$topicId' data-short-description='<strong>Description: </strong>" . substr($row['content'], 0, 30) . "...' data-full-description='<strong>Description: </strong>" . $row['content'] . "'><strong>Description: </strong>" . substr($row['content'], 0, 30) . "...</p>";

                // Kommentek megjelenítése
                echo "<div id='comments_$topicId' style='display:none;'>";
                echo "<br><hr>";
                echo "<h1 style='font-size: 1.5rem; font-style: bold;' class='mt-5'>Comments:</h1>";
                $comment_query = "SELECT comments.*, user.username 
          FROM comments 
          LEFT JOIN user ON comments.user_id = user.id
          WHERE topic_id = $topicId 
          ORDER BY comments.created_at DESC";

                $comment_result = mysqli_query($conn, $comment_query);

                if (mysqli_num_rows($comment_result) > 0) {
                    echo "<div id='existing_comments_$topicId'>";
                    while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                        // Ellenőrizzük, hogy a komment a bejelentkezett felhasználóhoz tartozik-e
                        if ($comment_row['username'] == $_SESSION['username']) {
                            // Ha igen, megjelenítjük a törlés gombot
                            echo "<div class='userComment' style='box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);'><p style='margin-top: 5px; margin-bottom: 10px;'><span>Sender: </span><strong>" . $comment_row['username'] . "</strong><span style='float: right'>" . $comment_row['created_at'] . "</span><br><span>Message: </span>" . $comment_row['content'] . "<button style='float:right' class='bg-red-600 text-white px-2 rounded-md hover:bg-white hover:text-red-600' onclick='deleteComment(" . $comment_row['id'] . ")'>Delete comment</button></p><hr></div>";
                        } else {
                            // Ha nem, nem jelenítünk meg törlés gombot
                            echo "<div class='userComment' style='box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);><p style='margin-top: 5px;'><span>Sender: </span><strong>" . $comment_row['username'] . "</strong><span style='float: right'>" . $comment_row['created_at'] . "</span><br><span>Message: </span>" . $comment_row['content'] . "</p><hr></div>";
                        }
                    }
                    echo "</div>";
                } else {
                    echo "<p id='noComments'>No comments yet.</p>";
                    echo "<div id='existing_comments_$topicId'></div>";
                }

                // Új komment űrlap hozzáadása
                echo "<form id='comment_form_$topicId' style='display:block;'>";
                echo "<textarea style='width: 60%; max-width: 60%; border: 1px solid black; border-radius: 5px; padding: 10px;' id='comment_text_$topicId' placeholder='Your comment here!' required></textarea><br>";
                echo "<button type='button' class='bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600' onclick='submitComment($topicId, \"\")'>Add Comment</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // Ha nincsenek topicok
            echo "<h2>There are no existing topics at the moment.</h2>";
        }

        // Adatbázis kapcsolat bezárása
        mysqli_close($conn);
        ?>

    </section>
</body>

</html>