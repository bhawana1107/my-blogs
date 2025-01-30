<?php
require_once './includes/header.php';
@include '../private.php';
$ck_editor_key = defined('CK_EDITOR_KEY') ? CK_EDITOR_KEY : 'nhi h';

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

<!-- FORM OF CONTENT  -->
<div class="container-fluid">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Add Blogs</div>
                </div>
                <form method="post" action="">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="blogName" class="form-label">Blog Name</label>
                            <input type="text" class="form-control" id="blogName">
                        </div>
                        <div class="mb-3">
                            <label for="blogCategory" class="form-label">Blog Category</label>
                            <select class="form-select" id="blogCategory">
                                <option selected="" disabled="" value="">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="blogContent" class="form-label">Blog Content</label>
                            <div id="editor">
                                <p>Hello from CKEditor 5!</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        Paragraph,
        Heading,
        BlockQuote,
        Link,
        List,
        Alignment,
        Image,
        ImageUpload,
        Code,
        CodeBlock,
        Strikethrough,
        Subscript,
        Superscript,
        TodoList,

    } = CKEDITOR;

    ClassicEditor
        .create(document.querySelector('#editor'), {
            licenseKey: '<?= $ck_editor_key ?>',
            plugins: [
                Essentials, Bold, Italic, Font, Paragraph, Heading, BlockQuote,
                Link, List, Alignment, Image, ImageUpload, Code, CodeBlock,
                Strikethrough, Subscript, Superscript, TodoList
            ],

            toolbar: {
                items: [
                    'undo', 'redo',
                    '|',
                    'heading',
                    '|',
                    'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|',
                    'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '|',
                    'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|',
                    'alignment',
                    '|',
                    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: true
            },
        })
        .then(editor => {
            console.log("Editor loaded successfully", editor);
        })
        .catch(error => {
            console.error("Editor error:", error);
        });
</script>