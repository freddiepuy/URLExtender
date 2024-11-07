<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>shortenedURL Extender</title>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <p id="extendedURL"></p>
    <div class="container" style="max-width: 400px;">
        <form class="bg-primary-subtle p-4 rounded shadow">
            <div class="form-group required">
                <label for="url" class="form-label">
                    <h5><b>Enter shortened URL</b></h5>
                </label>
                <input type="text" name="url" id="url" class="form-control" placeholder="Enter the shortened URL here"
                    required>
                <label class="mt-4"><b>Extended URL</b></label>
                <small class="float-end mt-4" id='status'></small> <!--Status message -->
                <input type="text" name="extended" id="extended" class="form-control"
                    placeholder="Extended shortened url" disabled>
                <button type="button" class="btn btn-success mt-3 w-100" id="submit" onclick="urlFunc()">
                    <h5><strong>SUBMIT</strong></h5>
                </button>
            </div>
        </form>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    let urlFunc = () => {
        console.log("hello")
        let shortenedURL = document.getElementById('url').value; //getting the value of the entered url
        console.log("world")
        $.ajax({
            url: "process.php",
            method: 'post',
            data: { url: shortenedURL },
            dataType: "json",
            success: function (data) {
                let urlStatus = data.status;
                console.log(data.url);
                console.log("Success!")
                $('#extended').val(data.url);
                if (urlStatus) {
                    // If the status of expanding the url is true
                    document.getElementById('status').innerHTML = "<b>Success</b>";
                    document.getElementById('status').classList.add('text-success');
                } else {
                    // If the status of expanding the url is false
                    document.getElementById('status').innerHTML = "<b>Failed</b>"
                    document.getElementById('status').classList.add('text-danger')
                }

            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(`Status: ${textStatus}`);
                console.log(`Error: ${errorThrown}`);
            }
        })
    }
</script>

</html>