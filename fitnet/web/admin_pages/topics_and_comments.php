<title>FitNet - Topics & Comments</title>
<style>
    .topic {
        padding: 10px;
        border: 1px solid black;
        border-radius: 10px;
    }
</style>

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
                commentsDiv.insertBefore(commentForm, commentsDiv.firstChild);
            }

            // Megváltoztatjuk az űrlap láthatóságát
            if (commentsDiv.style.display === "none") {
                commentsDiv.style.display = "block";
                // Ha a témára kattintottunk, akkor jelenítsük meg a teljes leírást
                var description = document.getElementById("description_" + topicId);
                description.innerHTML = "Description: " + description.dataset.fullDescription;
            } else {
                commentsDiv.style.display = "none";
                // Ha a témát bezártuk, akkor visszaállítjuk a rövid leírást
                var description = document.getElementById("description_" + topicId);
                description.innerHTML = "Description: " + description.dataset.shortDescription;
            }
        }

        function deleteTopic(topicId) {
            var confirmDelete = confirm("Are you sure you want to delete this topic?");
            if (confirmDelete) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Frissítjük az oldalt a komment törlése után
                        location.reload();
                    }
                };
                xmlhttp.open("GET", "delete_topic.php?topic_id=" + topicId, true);
                xmlhttp.send();
            }
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
    </script>


    <?php
    include("db.php");
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

            echo "<div class='topic' style='margin-bottom: 10px;'>";
            echo "<p style='float: right;'>" . $row['created_at'] . "</p>";
            echo "<a href='javascript:void(0);' onclick='toggleComments($topicId)' style='font-size: 1.25rem;'>Topic name: " . $row['title'] . "</a>";
            echo "<br><p style='float: right; font-size: 0.8rem;'>" . $username . "</p>";
            // Elmentjük a teljes és rövid leírást adatként a datasetben, majd megjelenítjük a rövid leírást
            echo "<p id='description_$topicId' data-short-description='" . substr($row['content'], 0, 30) . "...' data-full-description='" . $row['content'] . "'>Description: " . substr($row['content'], 0, 30) . "...</p>";

            // Kommentek megjelenítése
            echo "<div id='comments_$topicId' style='display:none;'>";
            echo "<hr>";
            echo "<h1 style='font-size: 1.5rem; font-style: bold;'>Comments:</h1>";
            $comment_query = "SELECT comments.*, user.username 
          FROM comments 
          LEFT JOIN user ON comments.user_id = user.id
          WHERE topic_id = $topicId 
          ORDER BY comments.created_at DESC";

            $comment_result = mysqli_query($conn, $comment_query);

            if (mysqli_num_rows($comment_result) > 0) {
                echo "<div id='existing_comments_$topicId'>";
                while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                    // Minden kommenthez hozzáadunk egy törlés gombot
                    echo "<p style='margin-top: 5px;'><strong>" . $comment_row['username'] . "</strong><span style='float: right'>" . $comment_row['created_at'] . "</span><br>" . $comment_row['content'] . "<button style='float:right' class='bg-red-600 text-white px-2 rounded-md hover:bg-white hover:text-red-600' onclick='deleteComment(" . $comment_row['id'] . ")'>Delete</button></p><hr>";
                }
                echo "</div>";
            } else {
                echo "<p>No comments yet.</p>";
            }

            // Új komment űrlap hozzáadása
            echo "<button type='button' class='bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 mt-2' onclick='deleteTopic($topicId, \"\")'>Delete topic</button>";
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