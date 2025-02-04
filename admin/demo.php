<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
</head>

<body>
    <label for="blogContent" class="form-label">Blog Content</label>
    <textarea id="editor" >
                              
</textarea>
</body>

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
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // ... Other configuration options ...
            ckfinder: {
                // Upload the images to the server using the CKFinder QuickUpload command.
                uploadUrl: 'https://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json',

                // Define the CKFinder configuration (if necessary).
                options: {
                    resourceType: 'Images'
                }
            }
        })
        .then( /* ... */ )
        .catch( /* ... */ );
</script>

<script src="https://example.com/ckfinder/ckfinder.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>

</html>