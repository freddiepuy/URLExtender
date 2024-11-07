<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hubot+Sans:ital,wght@0,200..900;1,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat';
        }
    </style>
    <title>shortenedURL Extender</title>
</head>

<body class="bg-dark bg-gradient d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col">
            <div class="container">
                <h1 class="text-end text-danger fs-2">shortenedURL<br><b class="fs-1">Extender</b></h1>
            </div>
        </div>
        <div class="col">
            <div class="container-md" style="max-width: 1200px;">
                <form class="bg-primary-subtle p-4 rounded shadow">
                    <div class="form-group required">
                        <label for="url" class="form-label">
                            <h5><b>Enter shortened URL</b></h5>
                        </label>
                        <input type="text" name="url" id="url" class="form-control"
                            placeholder="Enter the shortened URL here" required>
                        <label class="mt-4"><b>Extended URL</b></label>

                        <!-- Field that displays the output of extending the shortened url -->
                        <div class="form-floating">
                            <textarea name="extended" id="extended" class="form-control" disabled></textarea>
                            <label for="extended">Extended URL</label>
                        </div>
                        <small class="mt-4 ml-2" id='status'></small> <!--Status message -->

                        <!-- Buttons -->
                        <!-- Submit button -->
                        <button type="button" class="btn btn-success bg-gradient mt-3 w-100 pb-1 pt-2" id="submit"
                            onclick="urlFunc()">
                            <h5><strong>SUBMIT</strong></h5>
                        </button>
                        <!-- Reset button -->
                        <button type="button" class="btn btn-secondary bg-gradient mt-3 w-100 pb-1 pt-2" id="clear"
                            onclick="clearUrl()">
                            <h5><strong>Clear</strong></h5>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    let urlFunc = () => {
        let shortenedURL = document.getElementById('url').value; //getting the value of the entered url
        // Passing the data to php using ajax
        $.ajax({
            url: "process.php",
            method: 'post',
            data: { url: shortenedURL },
            dataType: "json",
            success: function (data) {
                let urlStatus = data.status;

                // For debugging purposes
                console.log(data.url);
                console.log("Success!");

                // Displaying the processed data of the url
                $('#extended').val(data.url);
                if (urlStatus) {
                    // If the status of expanding the url is true
                    document.getElementById('status').innerHTML = "<b>Success</b>";
                    document.getElementById('status').classList.add('text-success');
                } else {
                    // If the status of expanding the url is false
                    document.getElementById('status').innerHTML = "<b>URL cannot be extended</b>"
                    document.getElementById('status').classList.add('text-danger')
                }

            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(`Status: ${textStatus}`);
                console.log(`Error: ${errorThrown}`);
            }
        })
    }

    // Function to reset the page or clear the fields
    let clearUrl = () => {
        window.location.href = "index.php";
    }
</script>

</html>