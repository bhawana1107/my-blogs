<?php
require_once './includes/header.php';
?>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />


<!-- HEADER OF THE PAGE -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

                <h3 class="mb-0">Manage Blogs</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item btn btn-primary btn-lg">
                        <a href="blogs.php" class="text-white">Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="editor">
    <p>Hello from CKEditor 5!</p>
</div>


<?php
require_once './includes/footer.php';
?>


<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
<script>
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } = CKEDITOR;

    ClassicEditor
        .create(document.querySelector('#editor'), {
            licenseKey: '<YOUR_LICENSE_KEY>',
            plugins: [Essentials, Bold, Italic, Font, Paragraph],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        })
        .then( /* ... */ )
        .catch( /* ... */ );

        
</script>