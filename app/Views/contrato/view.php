<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar PDF</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        #pdf-container {
            width: 95vw;
            height: 95vh;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }

        #pdf-embed {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="pdf-container">
        <embed id="pdf-embed" type="application/pdf" src="<?php echo base_url("public/uploads/pdfs/contratos/") . $id ?>"/>
    </div>
</body>
</html>